'20110815 add "scan ts port"

On Error Resume Next

If (LCase(Right(Wscript.fullname,11))="wscript.exe") Then
	Wsh.Quit
End If

i=0
shell_tag = False
Set instreem=Wsh.stdin
Set outstreem=Wsh.stdout
Const HKEY_LOCAL_MACHINE = &H80000002
Set Fso = createobject("Scripting.FileSystemObject")
Set WS = WScript.CreateObject("WScript.Shell")

Set Args = Wsh.arguments
If Args.Count<8 Then
	show_all_help
	Wsh.Quit
End If

For Each Command In args
	Select Case LCase(Command)
		Case "-h"	host		= args(args_num+1)
		Case "-u"	username	= args(args_num+1)
		Case "-p"	password	= args(args_num+1)
		Case "-c"	cw			= args(args_num+1)
		Case "-cmd"
			If Args.Count = args_num+1 Then
				show_all_help()
			Else
				cmdstr		= args(args_num+1)
			End If
		Case "-?"	show_all_help()
	End Select
	args_num = args_num + 1
Next

If host = "" Then
	wsh.echo "host can't empty"
	wsh.quit
End If

If username = "" Then
	wsh.echo "username can't empty"
	wsh.quit
End If

If password = "" Then
	wsh.echo "password can't empty"
	wsh.quit
End If

If cw <> "" Then
	Select	Case cw
		Case "console"		wsh.echo "Got console mode"
		Case "echo"			wsh.echo "Got echo mode"
		Case "unecho"		wsh.echo "Got disposable mode"
		Case "pslist"		wsh.echo "Got pslist"
		Case "sysinfo"		wsh.echo "Got sysinfo"
		Case "open3389"		wsh.echo "Got open3389"
		Case "Dumplog"		wsh.echo "Got dumplog"
		Case Else			wsh.echo "-c Wrong!":wsh.quit
	End Select
	If cw = "echo" Or cw = "unecho" Then
		If cmdstr = "" Then
			wsh.echo "Command can't empty"
			wsh.quit
		End If
	End If

Else
	wsh.echo "connect Parameters can't empty"
	wsh.echo String(70,"*")
	show_all_help
	wsh.quit
End If





wsh.echo "connecting "&host&" ...."
Set objlocator=CreateObject("wbemscripting.swbemlocator")
Set objswb=objlocator.connectserver(host,"root/cimv2",username,password)
showerror err.number,"connect remote root/cimv2"

objswb.security_.privileges.add 23,true
objswb.security_.privileges.add 18,True
showerror err.number,"Applying For security privilege...."
Set oReg=objlocator.connectserver(host,"root/default",username,password).Get("stdregprov")
showerror err.number,"connect remote root/default"
oReg.GetStringValue &H80000002,"SYSTEM\CurrentControlSet\Control\Session Manager\Environment","temp",tmp_path
oReg.GetStringValue &H80000002,"SOFTWARE\Microsoft\Windows NT\CurrentVersion","CurrentVersion",os_ver
oReg.GetDWORDValue &H80000002,"SYSTEM\CurrentControlSet\Control\Terminal Server\WinStations\RDP-Tcp","PortNumber",ts_port
wsh.echo "Get Remote OS temp path:"&tmp_path
wsh.echo "Terminal Server Port:"&ts_port
tmp_path = Replace(tmp_path,"\","\\")
clean_cache()
Set Win_Process=objswb.Get("Win32_ProcessStartup")
Set Hide_Windows=Win_Process.SpawnInstance_
Hide_Windows.ShowWindow=12
Set Rcmd=objswb.Get("Win32_Process")

Select	Case cw
	Case "console"		Create_read:console
	Case "echo"			Create_read:rCommand cmdstr:clean_cache
	Case "unecho"		disposable(CmdStr)
	Case "pslist"		pslist
	Case "sysinfo"		sysinfo
	Case "open3389"		open3389
	Case Else			wsh.echo "Wrong Parameters!":wsh.quit
End Select


Sub disposable(s)
	If Rcmd.create("cmd /c "&CmdStr,Null,Hide_Windows,intProcessID) = 0 Then
		tk "<unecho>","Command completed successfully!"
	Else
		tk "<unecho>","Command completed failed!"
	End If
End Sub

Sub console()
	wsh.echo "Traget os:"&os_ver
	wsh.echo "Please enter the ""help"" got help message!"
	Do Until shell_tag = True
		outstreem.Write "#"
		input = LCase(instreem.Readline)
		If Len(input)  <> 0 Then 
			ins = Split(input,Chr(32))
			Select	Case ins(0)
					Case "help"		show_help
					Case "cmd"		cmd
					Case "lcmd"		lcmd
					Case "pslist"	pslist
					Case "pskill"	pskill(input)
					Case "upload"	upload(input)
					Case "down"		down(input)
					Case "sc"		service(input)
					Case "sysinfo"	sysinfo
					Case "reboot"	reboot(input)
					Case "open3389"	open3389
					Case "dumplog"	dumplog(input)
					Case "exit"		clean_cache:tk s,"By...":shell_tag = True
					Case "?"		show_help
					Case Else		tk s,"Wrong Command!"
			End Select
		End If
	Loop
End Sub

Function GetNowPath
	np=wsh.scriptfullname
	GetNowPath=Replace(np,scriptname,Chr(0))
End Function

Sub down_h
	wsh.echo "down -rf Remove_File_Path -f Local_Save_Path"
End Sub


Sub down(s)
	If InStr(s,"-rf") = 0 Or InStr(s,"-f") = 0 Then
		down_h
		Exit Sub
	End If
	uarg = Split(s,Chr(32))
	If UBound(uarg) < 4 And UBound(uarg) >6  Then
		tk "","file can't empty!"
		tk "","down -rf c:\test.exe -f c:\test.exe"
	Else
		For Each u In uarg
			Select	Case u
				Case "-rf"	rfname = uarg(n+1)
				Case "-f"	fname = uarg(n+1)
			End Select
			n = n + 1
		Next
		If Fso.FileExists(fname) Then
			tk "<down>",fname&" file already exists!"	
		Else
			wsh.echo "Local file:"&fname
			rfname = Replace(Replace(rfname,"\","\\"),"/","\\")
			Set rcolFiles = objswb.ExecQuery("Select * from CIM_Datafile Where Name = '"&rfname&"'")
			If rcolFiles.Count > 0 Then
				wsh.echo "Remote file:"&rfname
				cread_up
				If oReg.DeleteValue(&H80000002,"SOFTWARE\Clients","file") = 0 Then
					tk "<down>","Clean file old cache"
				End If
				If Rcmd.create("cmd /c cscript "&tmp_path&"\up.vbs """&rfname&"""",Null,Hide_Windows,intProcessID) = 0 Then
					down_flag = False
					down_time = 0
					wsh.echo "will download file from cache now..."
					wsh.echo "pls waiting..."
					Do Until down_flag = True
						If oReg.GetBinaryValue(&H80000002,"SOFTWARE\Clients","file",arr)=0 Then
							d_begin = Timer
							Set s=CreateObject("Adodb.Stream")
							with s
								.Mode=3
								.Open
								.Type=2
								.Charset="iso8859-1"
								For Each i In arr
									.WriteText ChrW(i)
								Next
								.SaveToFile fname,2
								.Close
							End with
							Set s = Nothing 
							d_finish = Timer
							wsh.echo rfname&" download completed!"
							wsh.Echo "use time:"&d_finish - d_begin
							down_flag = True
						End If
						If down_time > 300 Then 
							wsh.echo "Timeout...File is too big?"
							down_flag = True
						End If
						down_time = down_time + 1
						wsh.sleep 100
					Loop
				Else
					showerror err.number,"down file!"
				End If
			Else
				wsh.echo "Remote file:"&rfname &" not found!"
			End If
		End If
	End If
End Sub

Sub dumplog_h
		wsh.echo "dumplog logname log_save_name"
		wsh.echo "dumplog system log_save_name"
		wsh.echo "dumplog security log_save_name"
		wsh.echo "dumplog application log_save_name"
End Sub

Sub dumplog(s)
	dumplog_arg = Split(s,Chr(32))
	If UBound(dumplog_arg)<2 Then
		dumplog_h
	Else
		Select	Case dumplog_arg(1)
				Case "system"		logname="system"
				Case "security"		logname="security"
				Case "application"	logname="application"
				Case Else			wsh.echo "Wrong Parameters!"
		End Select
		If Not fso.FileExists(GetNowPath&dumplog_arg(2)) Then
			outstreem.write "Do you want to cover?(y/n):"
			strinput=instreem.readline
			If lCase(strinput)<>"y" Then 
				wsh.echo "Canceled!"
			Else
				Set colLoggedEvents = objswb.ExecQuery _
				("Select * from Win32_NTLogEvent Where Logfile = '"&logname&"'")
		
				with Fso.opentextfile(dumplog_arg(2),2,true)
					For Each objEvent in colLoggedEvents
						.writeline "Category: " & objEvent.Category
						.writeline "Computer Name: " & objEvent.ComputerName
						.writeline "Event Code: " & objEvent.EventCode
						.writeline "Message: " & objEvent.Message
						.writeline "Record Number: " & objEvent.RecordNumber
						.writeline "Source Name: " & objEvent.SourceName
						.writeline "Time Written: " & objEvent.TimeWritten
						.writeline "Event Type: " & objEvent.Type
						.writeline "User: " & objEvent.User
						.writeline String(70,"-")
						wsh.sleep 100
						If dump_i Mod 10 =0 Then outstreem.write Chr(13)&"dump"&String(dump_i/10,".")&Chr(8)
					dump_i=dump_i+1
					Next
					.close
					showerror err.number,vbcrlf&"Dump "&logname
				End with
			End If
		Else
			Set colLoggedEvents = objswb.ExecQuery _
				("Select * from Win32_NTLogEvent Where Logfile = '"&logname&"'")
		
			with Fso.opentextfile(dumplog_arg(2),2,true)
				For Each objEvent in colLoggedEvents
					.writeline "Category: " & objEvent.Category
					.writeline "Computer Name: " & objEvent.ComputerName
					.writeline "Event Code: " & objEvent.EventCode
					.writeline "Message: " & objEvent.Message
					.writeline "Record Number: " & objEvent.RecordNumber
					.writeline "Source Name: " & objEvent.SourceName
					.writeline "Time Written: " & objEvent.TimeWritten
					.writeline "Event Type: " & objEvent.Type
					.writeline "User: " & objEvent.User
					.writeline String(70,"-")
					wsh.sleep 100
					If dump_i Mod 10 =0 Then outstreem.write Chr(13)&"dump"&String(dump_i/10,".")&Chr(8)
					dump_i=dump_i+1
				Next
				.close
				showerror err.number,vbcrlf&"Dump "&logname
			End with
		End If
		
	End If
End Sub


Sub service(s)
	ser_arg = Split(s,Chr(32))
	If UBound(ser_arg) < 1 Then
		wsh.echo "sc /query		[sc /query server_name]"
		wsh.echo "sc /start service_name"
		wsh.echo "sc /stop service_name"
		'wsh.echo "sc /config service_name service_start_mode"
	Else
		For Each ser_u In ser_arg
			Select	Case ser_u
				Case "/query"	ser_query(s)
				Case "/start"	ser_start(ser_arg(n+1))
				Case "/stop"	ser_stop(ser_arg(n+1))
			End Select
			n = n + 1
		Next
	End If
End Sub

Sub ser_query(s)
	ser_q_arg = Split(s,Chr(32))
	If UBound(ser_q_arg) = 1 Then 
		Set colServices = objswb.InstancesOf("Win32_Service")
		For Each objService In colServices
			with objService
				wsh.Echo "Name:           " & .Name
				wsh.Echo "Display Name:   " & .DisplayName
				wsh.Echo "Description: " & .Description
				wsh.Echo "Path Name:   " & .PathName
				wsh.Echo "Start Mode:  " & .StartMode
				wsh.Echo "State:       " & .State
				wsh.echo String(70,"-")
			End with
		Next
	Else
		Set colServices = objswb.InstancesOf("Win32_Service")
		For Each objService In colServices
			with objService
				If LCase(.Name) = LCase(ser_q_arg(2)) Then
					wsh.Echo "Name:           " & .Name
					wsh.Echo "Display Name:   " & .DisplayName
					wsh.Echo "Description: " & .Description
					wsh.Echo "Path Name:   " & .PathName
					wsh.Echo "Start Mode:  " & .StartMode
					wsh.Echo "State:       " & .State
					wsh.echo String(70,"-")
					Exit For
				End If
			End with
		Next
	End If 
End Sub

Sub ser_start(s)
	If s <> "" Then
		Set colServices = objswb.InstancesOf("Win32_Service")
		For Each objService In colServices
			with objService
				If .Name = s Then
					If .StartMode = "Disabled" Then .ChangeStartMode("automatic")
					.StartService()
					showerror err.number,"Start "&s
					Exit For
				End If
			End with
		Next
	Else
		wsh.echo "Service name can't empty"
	End If
End Sub

Sub ser_stop(s)
	If s <> "" Then
		Set colServices = objswb.InstancesOf("Win32_Service")
		For Each objService In colServices
			with objService
				If .Name = s Then
					.StopService()
					showerror err.number,"Stop "&s
					Exit For
				End If
			End with
		Next
	Else
		wsh.echo "Service name can't empty"
	End If
End Sub

Sub sysinfo
	Set obj1=objget("win32_computersystem")
	Set obj2=objget("win32_operatingsystem")
	Set obj3=objget("win32_displayconfiguration")
	Set col4=objswb.instancesof("win32_diskdrive")
	Set col5=objswb.instancesof("win32_logicaldisk")
	Set obj6=objswb.InstancesOf("Win32_UserAccount",48)
	wsh.echo "OS Info :"
	wsh.echo "|_Computer Name : "&obj1.name
	wsh.echo "|_User Name : "&obj1.username
	wsh.echo "|_Domain : "&obj1.domain

	domainrole=""
	Select Case obj1.domainrole
		Case 0	domainrole="Workstation"
		Case 1	domainrole="Member Workstation"
		Case 2	domainrole="Server"
		Case 3	domainrole="Member Server"
		Case 4	domainrole="Backup Domain Controller"
		Case 5	domainrole="Main Domain Controller"
	End Select
	
	with obj2
		wsh.echo "|_Domain Role : "&domainrole
		wsh.echo "|_Caption : "&.caption
		wsh.echo "|_Organization : "&.organization
		wsh.echo "|_Registered User : "&.registereduser
		wsh.echo "|_Install Date : "&timeFormat(.installdate)
		wsh.echo "|_Last BootUp Time : "&timeFormat(.lastbootuptime)
		wsh.echo "|_Windows Directory : "&.windowsdirectory
		If viewtype=1 Then
			wsh.echo "|_System Directory : "&.systemdirectory
			wsh.echo "|_Boot Device : "&.bootdevice
			wsh.echo "|_Country Code : "&.countrycode
			wsh.echo "|_CSName : "&.csname
			wsh.echo "|_Description : "&.description
			wsh.echo "|_Manufacturer : "&.manufacturer
			wsh.echo "|_Serial Number : "&.serialnumber
			wsh.echo "|_Version : "&.version
			wsh.echo "|_System Type : "&obj1.systemtype
			wsh.echo "|_System Startup Delay : "&obj1.systemstartupdelay&"s"
			wsh.echo "|_System Startup Options : "&obj1.systemstartupoptions(0)
			For i=1 to ubound(obj1.systemstartupoptions)
			  wsh.echo space(28)&obj1.systemstartupoptions(i)
			Next
		End If
	End with

	with obj3
		wsh.echo vbcrlf&"Display Configuration :"
		wsh.echo "|_Caption : "&.caption
		If viewtype=1 Then
			wsh.echo "|_Device Name : "&.devicename
			wsh.echo "|_Driver Version : "&.driverversion
		End If
		wsh.echo "|_Display Frequency : "&.displayfrequency&"Hz"
		wsh.echo "|_Bits Per Pel : "&.bitsperpel&"Bit"
		wsh.echo "|_Pels : "&.pelswidth&"|_x "&.pelsheight
	End with

	wsh.echo vbcrlf&"Disk Info :"
	For Each obj4 in col4
		with obj4
			wsh.echo "|_DeviceID : "&.deviceid
			wsh.echo "|_Caption : "&.caption
			wsh.echo "|_Interface Type : "&.interfacetype
			If viewtype = 1 Then
				wsh.echo "|_SCSI Bus : "&.scsibus
				wsh.echo "|_SCSI Logical Unit : "&.scsilogicalunit
				wsh.echo "|_SCSI Port : "&.scsiport
				wsh.echo "|_SCSI TargetId : "&.scsitargetid
				wsh.echo "|_Sectors Per Track : "&.sectorspertrack&"KB"
			End If
			wsh.echo "|_Partitions : "&.partitions
			wsh.echo "|_Size : "&sizeFormat(.size)
		End with
	Next
	str="Volume"+space(2)+"Type"+space(8)+"Format"+space(4)
	str=str+"Size"+space(6)+"Free"+space(12)+"Label"
	wsh.echo str

	For Each obj5 in col5
		with obj5
			drivetype=""
			Select Case .drivetype
				Case 0	drivetype="Unknow"
				Case 1	drivetype="NoRootDir"
				Case 2	drivetype="Removable"
				Case 3	drivetype="Fixed"
				Case 4	drivetype="Network"
				Case 5	drivetype="CD-ROM"
				Case 6	drivetype="RAM"
			End Select
			strpercent=""
			If .size<>"" And .freespace<>"" Then
				strpercent=" ("&Formatpercent(.freespace/.size,0)&")"
			End If
			str=" "&wsp(.caption,8)&wsp(drivetype,12)&wsp(.filesystem,10)&wsp(sizeFormat(.size),10)
			str=str&wsp(sizeFormat(.freespace)&strpercent,16)&.volumename
			wsh.echo str
		End with
	Next

	For Each objItem in obj6
	With objItem
	    Wsh.Echo "Account Type: " & .AccountType
	    Wsh.Echo "Caption: " & .Caption
	    Wsh.Echo "Description: " & .Description
	    Wsh.Echo "Disabled: " & .Disabled
	    Wsh.Echo "Domain: " & .Domain
	    Wsh.Echo "Full Name: " & .FullName
	    Wsh.Echo "Local Account: " & .LocalAccount
	    Wsh.Echo "Lockout: " & .Lockout
	    Wsh.Echo "Name: " & .Name
	    Wsh.Echo "Password Changeable: " & .PasswordChangeable
	    Wsh.Echo "Password Expires: " & .PasswordExpires
	    Wsh.Echo "Password Required: " & .PasswordRequired
	    Wsh.Echo "SID: " & .SID
	    Wsh.Echo "SID Type: " & .SIDType
	    Wsh.Echo "Status: " & .Status
		Wsh.Echo String(70,"-")
    End With
Next
End Sub

Function sizeFormat(msg)
	If msg<>"" Then 
		size=msg/1048576
		If size>1024 Then 
		 sizeFormat=round(size/1024,2)&"GB"
		Else 
		 sizeFormat=round(size,1)&"MB"
		End If 
	End If 
End Function 

Function wsp(msg,num)
	If msg<>"" Then 
	 msg=left(msg,num-1)
	 wsp=msg&space(num-len(msg))
	Else 
	 wsp=space(num)
	End If 
End Function 

Function objget(msg)
	Set col=objswb.instancesof(msg)
	For Each objx In col
	  Set obj=objx
	Next 
	Set objget=obj
End Function 

Function timeFormat(msg)
	timeFormat=left(msg,4)&"/"&mid(msg,5,2)&"/"&mid(msg,7,2)&" "&mid(msg,9,2)&":"&mid(msg,11,2)&":"&mid(msg,13,2)
End Function

Sub reboot(s)
	r_arg = Split(s,Chr(32))
	If UBound(r_arg)<1 Then
		wsh.echo "reboot /y"
	Else 
		If r_arg(1) = "/y" Then
			wsh.echo "Checking boot os...."
			strwqlquery="Select * from win32_computersystem"
			Set colinstances=objswb.execquery(strwqlquery)
			For Each objinstance In colinstances
				bootos1=objinstance.properties_.item("systemstartupoptions")
			Next 
			strwqlquery="Select * from win32_operatingsystem"
			Set colinstances=objswb.execquery(strwqlquery)
			For Each objinstance In colinstances
				bootos2=objinstance.properties_.item("caption")
			Next 
			showerror err.number,"Get startup options"
			wsh.echo "boot os startup options"
			wsh.echo String(70,"-")
			For Each bos In bootos1
				wsh.echo bos
			Next
			wsh.echo String(70,"-")
			wsh.echo "Current os:"&bootos2
			outstreem.write "Do you want to continue?(y/n):"
			strinput=instreem.readline
			If lCase(strinput)<>"y" Then 
				wsh.echo "Canceled!"
			Else
				wsh.echo "Now, Rebooting "&host&"...."
				strwqlquery="Select * from win32_operatingsystem where primary='true'"
				Set colinstances=objswb.execquery(strwqlquery)
				For Each objinstance In colinstances
					objinstance.win32shutdown 6 ,0
				Next
				If err.number = 0 Then
				 wsh.echo "OK!"&vbcrlf&"Target has been reboot Successfully!"
				 wsh.echo "By by..."
				 wsh.quit
				Else 
				 wsh.echo "Error!"
				End If 
			End If
		Else
			tk "","reboot /y"
		End If
	End If
End Sub


Sub open3389
	wsh.echo "open3389 need 3 step"
	wsh.echo "1.Delete Terminal Key"
	wsh.echo "2.To Create New Terminal Key"
	wsh.echo "3.Set fDenyTSConnections value = 0"
	wsh.echo String(70,"-")
	Terminal_key = "SOFTWARE\Policies\Microsoft\Windows NT\Terminal Services"
	wsh.echo delkey
	If oReg.DeleteKey(&H80000002,Terminal_key) <> 0 Then
		tk "<open3389>","Can't delete Terminal Key"
		If Err.number <> 0 Then showerror err.number,"Delete Terminal Key "
	Else
		wsh.echo "1.Delete successfully of Terminal Key "
		If oReg.CreateKey(&H80000002,Terminal_key) <> 0 Then
			tk "<open3389>","Can't Create Terminal Key"
			If Err.number <> 0 Then showerror err.number,"Create Terminal Key"
		Else
			wsh.echo "2. To create new Terminal Key"
			If oReg.SetDWORDValue(&H80000002,Terminal_key,"fDenyTSConnections",0) <> 0 Then
				tk "<open3389>","Open failed of Terminal Service!"
				If Err.number <> 0 Then showerror err.number,"Create Terminal Key"
			Else
				wsh.echo "3.Set fDenyTSConnections value = 0"
				wsh.echo "Bingo ^_^"
				wsh.echo String(70,"*")
				tk "<open3389>","Open successfully of Terminal Service!"
			End If
		End If
	End If
End Sub


Sub upload(s)
	If InStr(s,"-f") = 0 Or InStr(s,"-rf") = 0 Then
		show_help
		Exit Sub
	End If
	uarg = Split(s,Chr(32))
	If UBound(uarg) < 4 And UBound(uarg) >6  Then
		tk "","file can't empty!"
		tk "","upload -f c:\test.exe -rf c:\test.exe"
	Else
		For Each u In uarg
			Select	Case u
				Case "-f"	fname = uarg(n+1)
				Case "-rf"	rfname = uarg(n+1)
			End Select
			n = n + 1
		Next
		If fname = "" Then
			tk "<upload>","Local file?"
		Else
			If Not Fso.FileExists(fname) Then
				tk "<upload>",fname&" file not found!"	
			Else
				wsh.echo "Local file:"&fname
				If rfname = "" Then
					tk "<upload>","Remote file?"
				Else
					rfname = Replace(Replace(rfname,"\","\\"),"/","\\")
					Set rcolFiles = objswb.ExecQuery("Select * from CIM_Datafile Where Name = '"&rfname&"'")
					If rcolFiles.Count > 0 Then
						wsh.echo "Remote file:"&rfname &" already exists!"
					Else
						wsh.echo "upload now..."
						begin_t = Timer
						Set Ado = CreateObject("Adodb.Stream")
						With Ado
							.Type = 1
							.Open
							.loadfromfile fname
							NP = .read
						End With
						If oReg.DeleteValue(&H80000002,"SOFTWARE\Clients","file") = 0 Then
							tk "<upfile>","Clean file old cache"
						End If

						If oReg.SetBinaryValue(&H80000002,"SOFTWARE\Clients","file",NP) = 0 Then
							wsh.echo "file new cache write successful!"
							dump_file
							upload_flag = False
							upload_time = 0
							If Rcmd.create("cmd /c cscript "&tmp_path&"\dump.vbs """&rfname&"""",Null,Hide_Windows,intProcessID) = 0 Then
								Do Until upload_flag = True
									If objswb.ExecQuery("Select * from CIM_Datafile Where Name = '"&rfname&"'").Count > 0 Then
										over_t = Timer
										wsh.echo "use time:"& over_t - begin_t
										wsh.echo rfname&" file upload successful!!"
										upload_flag = True
									End If
									If upload_time > 200 Then 
										wsh.echo "waiting for yourself check"
										upload_flag = True
									End If
									upload_time = upload_time + 1
									wsh.sleep 100
								Loop
							Else
								showerror err.number,"upload file "
							End If 
						Else
							showerror err.number,"upload file cache"
						End If
						Ado.Close
						Set Abo = Nothing
					End If 	
				End If
			End If
		End If
	End If
End Sub

Sub dump_file
	Set colFiles = objswb.ExecQuery("Select * from CIM_Datafile Where Name = '"&tmp_path&"\\dump.vbs'")
	If colFiles.Count = 0 Then
		RunYN =Rcmd.create("cmd /c echo Set R=GetObject(^""winmgmts:{impersonationLevel=impersonate}!\\.\root\default:StdRegProv^""):If R.GetBinaryValue(^&H80000002,^""SOFTWARE\Clients^"",^""file^"",arr)=0 Then:Set s=CreateObject(^""Adodb.Stream^""):with s:.Mode=3:.Open:.Type=2:.Charset=^""iso8859-1^"":For each i in arr:.WriteText ChrW(i):Next:.SaveToFile wsh.arguments(0),2:.Close:end with:End If >> "&tmp_path&"\dump.vbs",Null,Hide_Windows,intProcessID)
		If RunYN = 0 Then
			wsh.sleep 1000
			Set ncolFiles = objswb.ExecQuery("Select * from CIM_Datafile Where Name = '"&tmp_path&"\\dump.vbs'")
			If ncolFiles.Count > 0 Then
				wsh.echo "dump.vbs Created!!!"
			Else
				wsh.echo "dump.vbs can't create!"
				wsh.quit
			End If
		Else
			showerror Err.Number,"create dump.vbs"
		End If
	End If
End Sub


Sub pslist()
	wsh.echo "Listing remote process...."
	Set process_all=objswb.execquery("Select * from win32_process")
	showerror err.number,"pslist process"
	wsh.echo vbcrlf&"Name"&chr(9)&chr(9)&"Pid"&chr(9)&"ExecutablePath"
	For Each process In process_all
	If len(process.name)<8 Then
		ps=process.name&chr(9)
	else
		ps=process.name
	End If
 wsh.echo ps&chr(9)&process.hAndle&chr(9)&process.executablepath
 Next
 wsh.echo vbcrlf&"All process have been listed Successfully!"
End Sub

Sub pskill(s)
	n = 0
	arg_num = Split(s,Chr(32))
	If UBound(arg_num) < 2 Then
		tk "<pskill>","Not enough parameters!"
		tk "","pskill -pid 1314 ":tk "","pskill -pn process_name.exe"
	Else
		For Each par In arg_num
			Select	Case par
				Case "-pid"	pkid(arg_num(n+1))
				Case "-pn"	pkn(arg_num(n+1))
				Case "?"	tk "","pskill -pid 1314 ":tk "","pskill -pn process_name.exe"
			End Select
			n = n + 1
		Next
	End If
End Sub

Sub pkid(pid)
	If IsNumeric(pid) Then
		If pid >0 Then 
			wsh.echo "Killing id="&pid&" process...."
			Set objinstance=objswb.get("win32_process.hAndle="&"'"&pid&"'")
			If vartype(objinstance)<>vbobject Then
				tk "","SpecIfied process is not exist."
			Else
				Set objmethod=objinstance.methods_("terminate")
				Set objinparam=objmethod.inparameters.spawninstance_()
				objinparam.reason=0
				Set objoutparam=objinstance.execmethod_("terminate",objinparam)
				showerror objoutparam.returnvalue,"pskill -pid "&pid
			End If
		End If
	Else
		tk "","Pid must be digital"
	End If
End Sub

Sub pkn(pn)
	wsh.echo "Killing name="&pn&" process...."
	strwqlquery="Select * from win32_process where name='"&pn&"'"
	Set colinstances=objswb.execquery(strwqlquery)
	If colinstances.count<1 Then
		wsh.echo vbcrlf&"SpecIfied process is not exist."
	else
		For Each objinstance In colinstances
			Set objmethod=objinstance.methods_("terminate")
			Set objinparam=objmethod.inparameters.spawninstance_()
			objinparam.reason=0
			Set objoutparam=objinstance.execmethod_("terminate",objinparam)
		Next
		showerror objoutparam.returnvalue,"pskill -pn "&pn
	End If 
End Sub


Sub Lcmd()
	Lcmd_exit = False
	wsh.echo "Welcome to local cmd"
	wsh.echo String(70,"-")
	Do Until lcmd_exit = True 
		read_reg = False
		del_reg = False
		outstreem.Write "<Lcmd>#"
		input = LCase(instreem.Readline)
		If input = "exit" Then
			Lcmd_exit = True
			Exit Do
		End If
		If Len(input) <> 0 Then wsh.echo WS.Exec("cmd /c "&input).StdOut.readall
	Loop

End Sub



Sub cmd()
	cmd_exit = False
	Create_read()
	wsh.echo "Welcome to cmd's world"
	wsh.echo "Enter the ""exit"" by exit cmdshell"
	wsh.echo "Timeout set for add ""-timeout time""	[-timeout 60]"
	wsh.echo String(70,"-")
	Do Until cmd_exit = True 
		read_reg = False
		del_reg = False
		outstreem.Write "<cmd>#"
		input = LCase(instreem.Readline)
		If input = "exit" Then
			cmd_exit = True
			Exit Do
		End If
		If Len(input) <> 0 Then rCommand input
	Loop

	clean_cache
End Sub

Sub rCommand(s)
	time_out = 0
	cmd_n = 0
	cmd_args = Split(s,Chr(32))
	For Each cmd_arg In cmd_args
		If cmd_arg = "-timeout" Then
			If UBound(cmd_args) = cmd_n+1 Then
				Set_Time_Out = Int(cmd_args(cmd_n+1))
				wsh.echo "Set_Time_Out:"&Set_Time_Out
				s = Replace(s,"-timeout "&cmd_args(cmd_n+1),"")
				Exit For
			End If
		Else
			Set_Time_Out = 30
		End If
		cmd_n = cmd_n + 1
	Next

	If Rcmd.create("cmd /c cscript "&tmp_path&"\read.vbs """&s&"""",Null,Hide_Windows,intProcessID) = 0 Then
		wsh.sleep 500
		Do Until read_reg = True
			If oReg.GetMultiStringValue(&H80000002,"SOFTWARE\Clients","cmd",arrValues) =0 Then
				For Each strValue In arrValues  
					outstreem.WriteLine strValue
				Next 
				Do Until del_reg = True
					If oReg.DeleteValue(&H80000002,"SOFTWARE\Clients","cmd") = 0 Then
						del_reg = True
					Else
					del_reg = False
					End If
				Loop
				read_reg = True
			Else
				If time_out = Set_Time_Out Then
					wsh.echo vbcrlf&"time out"
					read_reg = True
				Else
					outstreem.Write Chr(13)&"reading now! Please waiting..."&time_out&"s/"&Set_Time_Out&"s"&Chr(8)&Chr(8)
					read_reg = False
					time_out = time_out + 1
					wsh.sleep 1000
				End If
				
			End If
		Loop
	Else
		showerror Err.Number,"Command completed"
	End If
End Sub

Sub cread_up
	Set colFiles = objswb.ExecQuery("Select * from CIM_Datafile Where Name = '"&tmp_path&"\\up.vbs'")
	If colFiles.Count = 0 Then
		up_vbs="cmd /c echo Set R=GetObject(^""winmgmts:{impersonationLevel=impersonate}!\\.\root\default:StdRegProv^""):Set A = CreateObject(^""Adodb.Stream^""):With A:.Type=1:.Open:.loadfromfile wsh.arguments(0):R.SetBinaryValue ^&H80000002,^""SOFTWARE\Clients^"",^""file^"",.read:End With>>"&tmp_path&"\up.vbs"
		If Rcmd.create(up_vbs,Null,Hide_Windows,intProcessID) = 0 Then 
			wsh.sleep 1000
			Set ncolFiles = objswb.ExecQuery("Select * from CIM_Datafile Where Name = '"&tmp_path&"\\up.vbs'")
			If ncolFiles.Count > 0 Then
				wsh.echo "up.vbs Created!!!"
			Else
				wsh.echo "up.vbs can't create!"
				'Exit Sub
			End If
		Else
			showerror Err.Number,"create up.vbs"
		End If
	Else
		showerror Err.Number,"check up.vbs"
	End If
End Sub

Sub Create_read()
	Set colFiles = objswb.ExecQuery("Select * from CIM_Datafile Where Name = '"&tmp_path&"\\read.vbs'")
	If colFiles.Count = 0 Then
		If os_ver="5.0" Then
			read_vbs = "cmd /c echo set z=CreateObject(^""WScript^""^&m^&^"".Shell^""):s=z.ExpandEnvironmentStrings(^""%windir%^"")^&^""\temp\temp.log^"":set f=CreateObject(^""Scripting.^""^&m^&^""FileSystemObject^""):z.run ^""cmd /c ^""^&wsh.arguments(0)^&^""^>^""^&s,0,true:if f.FileExists(s) then:if f.GetFile(s).size ^>0 then:g(f.OpenTextFile(s,1).readall):else:g(^""err^""):end if:f.deletefile s:end if:sub g(p):GetObject(^""winmgmts:{impersonationLevel=impersonate}!\\.\root\default:StdRegProv^"").SetMultiStringValue ^&H80000002,^""SOFTWARE\Clients^"",^""cmd^"",Array(p):end sub> "&tmp_path&"\read.vbs"
		Else
			read_vbs ="cmd /c echo v=WSh.CreateObject(^""WScript^""^&m^&^"".Shell^"").Exec(^""cmd /c ^""^&wsh.arguments(0)).StdOut.ReadAll:if len(v)>0 then g(v):else g(^""err^""):end if:sub g(p):GetObject(^""winmgmts:{impersonationLevel=impersonate}!\\.\root\default:StdRegProv^"").SetMultiStringValue ^&H80000002,^""SOFTWARE\Clients^"",^""cmd^"",Array(p):end sub> "&tmp_path&"\read.vbs"
		End If
		RunYN =Rcmd.create(read_vbs,Null,Hide_Windows,intProcessID)
		If RunYN = 0 Then
			wsh.sleep 1000
			Set ncolFiles = objswb.ExecQuery("Select * from CIM_Datafile Where Name = '"&tmp_path&"\\read.vbs'")
			If ncolFiles.Count > 0 Then
				wsh.echo "read.vbs Created!!!"
			Else
				wsh.echo "read.vbs can't create!"
				'Exit Sub
			End If
		Else
			showerror Err.Number,"create read.vbs"
		End If
	End If
End Sub


Sub clean_cache
	d_cache "up.vbs"
	d_cache "read.vbs"
	d_cache "dump.vbs"
	d_cache "temp.log"
	oReg.DeleteValue &H80000002,"SOFTWARE\Clients","cmd"
	oReg.DeleteValue &H80000002,"SOFTWARE\Clients","file"
	showerror Err.Number,"Clean cache"
End Sub

Sub d_cache(s)
Set colFiles = objswb.ExecQuery("Select * from CIM_Datafile Where Name = '"&tmp_path&"\\"&s&"'")
	For Each objFile in colFiles
		objFile.Delete
	Next
End Sub

Sub show_help()
	wsh.echo Chr(9)&"Help"&Chr(9)&Chr(9)&"Show this script's help"
	wsh.echo Chr(9)&"Cmd"&Chr(9)&Chr(9)&"Cmdshell"
	wsh.echo Chr(9)&"LCmd"&Chr(9)&Chr(9)&"Local Cmdshell"
	wsh.echo Chr(9)&"Pslist"&Chr(9)&Chr(9)&"List system process"
	wsh.echo Chr(9)&"Pskill"&Chr(9)&Chr(9)&"Kill system process [-pid 1314 , -pn process_name.exe]"
	wsh.echo Chr(9)&"Upload"&Chr(9)&Chr(9)&"Upload file to remote server [-f local_file,-rf remote_save_path]"
	wsh.echo Chr(9)&"Down"&Chr(9)&Chr(9)&"Down file from remote server [-rf remote_file,-rf local_save_path]"
	wsh.echo Chr(9)&"sc"&Chr(9)&Chr(9)&"Enum,start,stop remote Service"
	wsh.echo Chr(9)&"Sysinfo"&Chr(9)&Chr(9)&"Enum remote system info"
	wsh.echo Chr(9)&"Reboot"&Chr(9)&Chr(9)&"Reboot the remote system [need /y]"
	wsh.echo Chr(9)&"Open3389"&Chr(9)&"Open the Terminal Service"
	wsh.echo Chr(9)&"Dumplog"&Chr(9)&Chr(9)&"Dump the system log"
End Sub

Sub show_all_help()
	wsh.echo Chr(9)&"swrt v 1.2 [Super wmi remote tools]"
	wsh.echo Chr(9)&"-h"&Chr(9)&"remote host address"
	wsh.echo Chr(9)&"-u"&Chr(9)&"remote host username"
	wsh.echo Chr(9)&"-p"&Chr(9)&"remote host password"
	wsh.echo Chr(9)&"-c"&Chr(9)&"connect host mode"
	wsh.echo Chr(9)&Chr(9)&"-c has 6 mode [console,echo,unecho,pslist,sysinfo,open3389]"
	wsh.echo Chr(9)&"-cmd"&Chr(9)&"In ""echo"" or ""unecho"" mode to execute Commands"
	
End Sub

Sub tk(s,m)
	wsh.echo s&"#"&m
End Sub 

Function Bin2Str(Re)
	For i = 1 To lenB(Re)
		bt = AscB(MidB(Re, i, 1))
		If bt < 16 Then Bin2Str=Bin2Str&"0"
		Bin2Str=Bin2Str & Hex(bt)
	Next
End Function

Function showerror(errornumber,s)
If errornumber Then
	wsh.echo s&" failed!"
	wsh.echo "Error 0x"&CStr(Hex(Err.Number))&" ."
	If Err.Description <> "" Then
		wsh.echo "Error Description: "&Err.Description&"."
	End If
	Wsh.Quit
Else
 wsh.echo s&" done!"
End If
End Function


Set Hide_Windows = Nothing
Set Rcmd = Nothing
Set Win_Process= Nothing 
Set oReg = Nothing
Set objswb = Nothing
Set objlocator = Nothing