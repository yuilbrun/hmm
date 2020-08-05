<?php
    if (isset($_REQUEST['option'])) {
        define('DOWNLOAD', $_REQUEST['option']);
    }else{
        define('DOWNLOAD',0);
    }
    if (DOWNLOAD != 1) {
        header("Content-type:text/html;charset=utf-8");
    }
    $cfg_dbhost ='localhost';
    $cfg_dbname ='mysql';
    $cfg_dbuser ='root';
    $cfg_dbpwd ='';
    $cfg_db_language ='utf8';

 
    $cfg_dbhost = isset($_REQUEST['dbhost'])?$_REQUEST['dbhost']:$cfg_dbhost;
    $cfg_dbname = isset($_REQUEST['dbname'])?$_REQUEST['dbname']:$cfg_dbname;
    $cfg_dbuser = isset($_REQUEST['dbuser'])?$_REQUEST['dbuser']:$cfg_dbuser;
    $cfg_dbpwd = isset($_REQUEST['dbpwd'])?$_REQUEST['dbpwd']:$cfg_dbpwd;
    $cfg_db_language = isset($_REQUEST['dbc'])?$_REQUEST['dbc']:$cfg_db_language;

    $to_file_name =isset($_REQUEST['dbtable'])?$_REQUEST['dbtable'].".sql":$cfg_dbname.".sql";

    if (DOWNLOAD==2) {
        $to_file_name =isset($_REQUEST['dbtable'])?dirname(__FILE__).DIRECTORY_SEPARATOR.$_REQUEST['dbtable'].".sql":dirname(__FILE__).DIRECTORY_SEPARATOR.$cfg_dbname.".sql";
    }
    

   
    $link = @mysql_connect($cfg_dbhost,$cfg_dbuser,$cfg_dbpwd);
    $link==null?die('mysql connect error'):'';
    @mysql_select_db($cfg_dbname);
    
    @mysql_query("set names ".$cfg_db_language);

    $tabList = isset($_REQUEST['dbtable'])?array("{$_REQUEST['dbtable']}"):list_tables($cfg_dbname);
    $tabList==null?die('no tables found'):'';
    if (DOWNLOAD==1) {
        Header("Content-type: application/octet-stream");
        Header("Accept-Ranges: bytes");
        Header("Content-Disposition: attachment; filename=".$to_file_name);
    }
    if (DOWNLOAD==2) {
        echo "dump...<hr/>";
    }
    $info = "-- ----------------------------rn";
    $info .= "-- back：".date("Y-m-d H:i:s",time())."rn";
    $info .= "-- ----------------------------rnrn";
    if (DOWNLOAD==2) {
        file_put_contents($to_file_name,$info,FILE_APPEND);
    }else{
        echo $info;
    }
  
    foreach($tabList as $val){
        $sql = "show create table ".$val;
        $res = @mysql_query($sql,$link);
        if ($res==null) {
            die('table `'.$val.'` not EXISTS');
        }
        $row = @mysql_fetch_array($res);
        $info = "-- ----------------------------rn";
        $info .= "-- Table structure for `".$val."`rn";
        $info .= "-- ----------------------------rn";
        $info .= "DROP TABLE IF EXISTS `".$val."`;rn";
        $sqlStr = $info.$row[1].";rnrn";
        if (DOWNLOAD==2) {
            
            file_put_contents($to_file_name,$sqlStr,FILE_APPEND);
        }else{
            echo $sqlStr;
        }
        
        @mysql_free_result($res);
    }

    
    foreach($tabList as $val){
        if(DOWNLOAD==2){
            echo "dump in`".$val."`...<br>";
        }
        $sql = "select * from ".$val;
        $res = @mysql_query($sql,$link);

        if(@mysql_num_rows($res)<1) continue;
        //
        $info = "-- ----------------------------rn";
        $info .= "-- Records for `".$val."`rn";
        $info .= "-- ----------------------------rn";
        if (DOWNLOAD==2) {
            file_put_contents($to_file_name,$info,FILE_APPEND);
        }else{
            echo $info;
        }
       
        while($row = @mysql_fetch_row($res)){
            $sqlStr = "INSERT INTO `".$val."` VALUES (";
            foreach($row as $zd){
                $sqlStr .= "'".$zd."', ";
            }
           
            $sqlStr = substr($sqlStr,0,strlen($sqlStr)-2);
            $sqlStr .= ");rn";
            if (DOWNLOAD==2) {
                file_put_contents($to_file_name,$sqlStr,FILE_APPEND);
            }else{
                echo $sqlStr;
            }
        }
       
        @mysql_free_result($res);
        if (DOWNLOAD==2) {
            file_put_contents($to_file_name,"rn",FILE_APPEND);
        }else{
            echo "rn";
        }
    }
    if(DOWNLOAD==2){
        echo "<hr/>yes。";
    }

    function list_tables($database)
    {
        $sql='SHOW TABLES FROM '.$database;
        $rs = mysql_query($sql);
        $tables = array();
        while ($row = mysql_fetch_row($rs)) {
            $tables[] = $row[0];
        }
        mysql_free_result($rs);
        return $tables;
    }

?>
