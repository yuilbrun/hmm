#!/usr/bin/python
#-*- coding: UTF-8 -*-
import threading, time, socket, optparse, sys, string

def help():
    print '''portscan.py 192.168.1.1 192.168.1.254 80
portscan.py 192.168.1.1/24 80,443,3389
portscan.py 192.168.1.1 192.168.1.254 80,443,3389
portscan.py 192.168.1.1 192.168.1.254 1-8000
portscan.py 192.168.1.1 192.168.1.254 80,443,3389 -t 300 -o 5 --save
'''

def myprint(str):
    if lock.acquire():
        print str
        if(g_is_save):
            g_file.writelines(str+"\n")
        lock.release()

def bytetoint(buf):
    return int(buf.encode('hex'), 16)

def BuildPortList(strport):
    if string.find(strport, ",") != -1: #80,443,3389
        listport = string.split(strport, ",")
    elif string.find(strport, "-") != -1:   #1-10000
        t1 = string.split(strport, "-")
        listport = range(int(t1[0]), int(t1[1])+1)
    else:
        listport = [strport]
    return listport

def CIDRToIpRange(str):
    if string.find(str, "/") == -1: #No /24
        return (str, str)
    parts = str.split("/")
    strIp = parts[0]
    bit = int(parts[1])
    rangex = 0xFFFFFFFF >> bit          #
    submask = 0xFFFFFFFF << (32-bit)    #FFFFFF00
    if submask:
        start = (bytetoint(socket.inet_aton(strIp)) & submask ) + 1
        end = (bytetoint(socket.inet_aton(strIp)) & submask ) + rangex - 1
        return (start, end)

def dqtoi(dq):  #Return an integer value given an IP address as dotted-quad string.
    octets = string.split(dq, ".")
    if len(octets) != 4:
        raise ValueError
    for octet in octets:
        if int(octet) > 255:
            raise ValueError
    return (long(octets[0]) << 24) + (int(octets[1]) << 16) + (int(octets[2]) << 8) + (int(octets[3]))       
    
def itodq(intval): #Return a dotted-quad string given an integer. 
    return "%u.%u.%u.%u" % ((intval >> 24) & 0x000000ff, 
                            ((intval & 0x00ff0000) >> 16), 
                            ((intval & 0x0000ff00) >> 8), 
                            (intval & 0x000000ff))

def scan(ip,port):  #Scan function
    s = socket.socket()
    s.settimeout(3)     #connect Timeout
    try:
        r = s.connect_ex((ip, port))
        if(r==0):
            myprint (ip+":"+str(port)+" open")
    except socket.error:
        myprint ("error scan ["+ip+":"+str(port))
    s.close()
    sem.release()

#Main   ---------------
lock = threading.Lock()
logfile = ".log"
param = optparse.OptionParser()
param.add_option('-t', '--thread', action="store", type="int", dest="threads", default="200", help="Threads")
param.add_option('-o', '--timeout', action="store", type="int", dest="timeout", default="3", help="Timeout")
param.add_option('-s', '--save', action="store_true", dest="is_save", default=False, help="Save")
(options, args) = param.parse_args()

if len(args)<2:
    print "Run portscan.py -h to see help!"
    help()
    sys.exit(0)
if string.find(args[1], ".") == -1: #No end ip
    if string.find(args[0], "/") == -1: #No /24
        g_startip = g_endip = dqtoi(args[0])
    else:
        (g_startip, g_endip) = CIDRToIpRange(args[0])
    g_portlist = args[1]
else:
    g_startip = dqtoi(args[0])
    g_endip = dqtoi(args[1])
    g_portlist = args[2]
g_timeout = options.timeout
g_threads = options.threads
g_is_save = options.is_save

sem=threading.Semaphore(g_threads)    #Init Threads
print "Scaning [%s-%s] using max threads, timeout:" % (itodq(g_startip), itodq(g_endip))

listport = BuildPortList(g_portlist)
if(g_is_save):
    g_file = open(logfile, "a+")
    newline = "\n---------- [ " + itodq(g_startip) + " - " + itodq(g_endip) + " ] -----------\n"
    g_file.writelines(newline)
for x in range (g_startip, g_endip+1):
    for y in listport:
        sem.acquire()
        t = threading.Thread(target=scan,args=(itodq(x),int(y)))
        t.start()

while (sem._Semaphore__value!=g_threads):
    time.sleep(0.2)
print "Finished!"

