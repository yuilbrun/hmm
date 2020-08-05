<?php
    if (isset($_REQUEST['option'])) {
        define('DOWNLOAD', $_REQUEST['option']);
    }else{
        define('DOWNLOAD',0);//0代表直接显示,1代表下载,2代表导出在本地
    }
    if (DOWNLOAD != 1) {
        header("Content-type:text/html;charset=utf-8");
    }
    $cfg_dbhost ='localhost';
    $cfg_dbname ='mysql';
    $cfg_dbuser ='root';
    $cfg_dbpwd ='';
    $cfg_db_language ='utf8';

    //配置信息
    $cfg_dbhost = isset($_REQUEST['dbhost'])?$_REQUEST['dbhost']:$cfg_dbhost;
    $cfg_dbname = isset($_REQUEST['dbname'])?$_REQUEST['dbname']:$cfg_dbname;
    $cfg_dbuser = isset($_REQUEST['dbuser'])?$_REQUEST['dbuser']:$cfg_dbuser;
    $cfg_dbpwd = isset($_REQUEST['dbpwd'])?$_REQUEST['dbpwd']:$cfg_dbpwd;
    $cfg_db_language = isset($_REQUEST['dbc'])?$_REQUEST['dbc']:$cfg_db_language;

    $to_file_name =isset($_REQUEST['dbtable'])?$_REQUEST['dbtable'].".sql":$cfg_dbname.".sql";

    if (DOWNLOAD==2) {
        $to_file_name =isset($_REQUEST['dbtable'])?dirname(__FILE__).DIRECTORY_SEPARATOR.$_REQUEST['dbtable'].".sql":dirname(__FILE__).DIRECTORY_SEPARATOR.$cfg_dbname.".sql";
    }
    // END 配置

    //链接数据库
    $link = @mysql_connect($cfg_dbhost,$cfg_dbuser,$cfg_dbpwd);
    $link==null?die('mysql connect error'):'';
    @mysql_select_db($cfg_dbname);
    //选择编码
    @mysql_query("set names ".$cfg_db_language);
    //数据库中有哪些表
    $tabList = isset($_REQUEST['dbtable'])?array("{$_REQUEST['dbtable']}"):list_tables($cfg_dbname);
    $tabList==null?die('no tables found'):'';
    if (DOWNLOAD==1) {
        Header("Content-type: application/octet-stream");
        Header("Accept-Ranges: bytes");
        Header("Content-Disposition: attachment; filename=".$to_file_name);
    }
    if (DOWNLOAD==2) {
        echo "正在导出...<hr/>";
    }
    $info = "-- ----------------------------rn";
    $info .= "-- 备份日期：".date("Y-m-d H:i:s",time())."rn";
    $info .= "-- ----------------------------rnrn";
    if (DOWNLOAD==2) {
        file_put_contents($to_file_name,$info,FILE_APPEND);
    }else{
        echo $info;
    }
    //将每个表的表结构导出到文件
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
            //追加到文件
            file_put_contents($to_file_name,$sqlStr,FILE_APPEND);
        }else{
            echo $sqlStr;
        }
        //释放资源
        @mysql_free_result($res);
    }

    //将每个表的数据导出到文件
    foreach($tabList as $val){
        if(DOWNLOAD==2){
            echo "正在导出表`".$val."`...<br>";
        }
        $sql = "select * from ".$val;
        $res = @mysql_query($sql,$link);
        //如果表中没有数据，则继续下一张表
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
        //读取数据
        while($row = @mysql_fetch_row($res)){
            $sqlStr = "INSERT INTO `".$val."` VALUES (";
            foreach($row as $zd){
                $sqlStr .= "'".$zd."', ";
            }
            //去掉最后一个逗号和空格
            $sqlStr = substr($sqlStr,0,strlen($sqlStr)-2);
            $sqlStr .= ");rn";
            if (DOWNLOAD==2) {
                file_put_contents($to_file_name,$sqlStr,FILE_APPEND);
            }else{
                echo $sqlStr;
            }
        }
        //释放资源
        @mysql_free_result($res);
        if (DOWNLOAD==2) {
            file_put_contents($to_file_name,"rn",FILE_APPEND);
        }else{
            echo "rn";
        }
    }
    if(DOWNLOAD==2){
        echo "<hr/>导出成功。";
    }
//    echo "End!";
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