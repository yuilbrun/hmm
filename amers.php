<?php
/** Adminer - Compact database management
* @link https://www.adminer.org/
* @author Jakub Vrana, https://www.vrana.cz/
* @copyright 2007 Jakub Vrana
* @license https://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
* @license https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
* @version 4.7.1
*/error_reporting(6135);$Tc=!preg_match('~^(unsafe_raw)?$~',ini_get("filter.default"));if($Tc||ini_get("filter.default_flags")){foreach(array('_GET','_POST','_COOKIE','_SERVER')as$X){$Ei=filter_input_array(constant("INPUT$X"),FILTER_UNSAFE_RAW);if($Ei)$$X=$Ei;}}if(function_exists("mb_internal_encoding"))mb_internal_encoding("8bit");function
connection(){global$g;return$g;}function
adminer(){global$b;return$b;}function
version(){global$ia;return$ia;}function
idf_unescape($v){$le=substr($v,-1);return
str_replace($le.$le,$le,substr($v,1,-1));}function
escape_string($X){return
substr(q($X),1,-1);}function
number($X){return
preg_replace('~[^0-9]+~','',$X);}function
number_type(){return'((?<!o)int(?!er)|numeric|real|float|double|decimal|money)';}function
remove_slashes($ng,$Tc=false){if(get_magic_quotes_gpc()){while(list($z,$X)=each($ng)){foreach($X
as$be=>$W){unset($ng[$z][$be]);if(is_array($W)){$ng[$z][stripslashes($be)]=$W;$ng[]=&$ng[$z][stripslashes($be)];}else$ng[$z][stripslashes($be)]=($Tc?$W:stripslashes($W));}}}}function
bracket_escape($v,$Na=false){static$qi=array(':'=>':1',']'=>':2','['=>':3','"'=>':4');return
strtr($v,($Na?array_flip($qi):$qi));}function
min_version($Vi,$_e="",$h=null){global$g;if(!$h)$h=$g;$ih=$h->server_info;if($_e&&preg_match('~([\d.]+)-MariaDB~',$ih,$B)){$ih=$B[1];$Vi=$_e;}return(version_compare($ih,$Vi)>=0);}function
charset($g){return(min_version("5.5.3",0,$g)?"utf8mb4":"utf8");}function
script($th,$pi="\n"){return"<script".nonce().">$th</script>$pi";}function
script_src($Ji){return"<script src='".h($Ji)."'".nonce()."></script>\n";}function
nonce(){return' nonce="'.get_nonce().'"';}function
target_blank(){return' target="_blank" rel="noreferrer noopener"';}function
h($P){return
str_replace("\0","&#0;",htmlspecialchars($P,ENT_QUOTES,'utf-8'));}function
nl_br($P){return
str_replace("\n","<br>",$P);}function
checkbox($C,$Y,$eb,$ie="",$pf="",$jb="",$je=""){$I="<input type='checkbox' name='$C' value='".h($Y)."'".($eb?" checked":"").($je?" aria-labelledby='$je'":"").">".($pf?script("qsl('input').onclick = function () { $pf };",""):"");return($ie!=""||$jb?"<label".($jb?" class='$jb'":"").">$I".h($ie)."</label>":$I);}function
optionlist($vf,$ch=null,$Ni=false){$I="";foreach($vf
as$be=>$W){$wf=array($be=>$W);if(is_array($W)){$I.='<optgroup label="'.h($be).'">';$wf=$W;}foreach($wf
as$z=>$X)$I.='<option'.($Ni||is_string($z)?' value="'.h($z).'"':'').(($Ni||is_string($z)?(string)$z:$X)===$ch?' selected':'').'>'.h($X);if(is_array($W))$I.='</optgroup>';}return$I;}function
html_select($C,$vf,$Y="",$of=true,$je=""){if($of)return"<select name='".h($C)."'".($je?" aria-labelledby='$je'":"").">".optionlist($vf,$Y)."</select>".(is_string($of)?script("qsl('select').onchange = function () { $of };",""):"");$I="";foreach($vf
as$z=>$X)$I.="<label><input type='radio' name='".h($C)."' value='".h($z)."'".($z==$Y?" checked":"").">".h($X)."</label>";return$I;}function
select_input($Ja,$vf,$Y="",$of="",$Zf=""){$Uh=($vf?"select":"input");return"<$Uh$Ja".($vf?"><option value=''>$Zf".optionlist($vf,$Y,true)."</select>":" size='10' value='".h($Y)."' placeholder='$Zf'>").($of?script("qsl('$Uh').onchange = $of;",""):"");}function
confirm($Je="",$dh="qsl('input')"){return
script("$dh.onclick = function () { return confirm('".($Je?js_escape($Je):'Are you sure?')."'); };","");}function
print_fieldset($u,$qe,$Yi=false){echo"<fieldset><legend>","<a href='#fieldset-$u'>$qe</a>",script("qsl('a').onclick = partial(toggle, 'fieldset-$u');",""),"</legend>","<div id='fieldset-$u'".($Yi?"":" class='hidden'").">\n";}function
bold($Va,$jb=""){return($Va?" class='active $jb'":($jb?" class='$jb'":""));}function
odd($I=' class="odd"'){static$t=0;if(!$I)$t=-1;return($t++%2?$I:'');}function
js_escape($P){return
addcslashes($P,"\r\n'\\/");}function
json_row($z,$X=null){static$Uc=true;if($Uc)echo"{";if($z!=""){echo($Uc?"":",")."\n\t\"".addcslashes($z,"\r\n\t\"\\/").'": '.($X!==null?'"'.addcslashes($X,"\r\n\"\\/").'"':'null');$Uc=false;}else{echo"\n}\n";$Uc=true;}}function
ini_bool($Od){$X=ini_get($Od);return(preg_match('~^(on|true|yes)$~i',$X)||(int)$X);}function
sid(){static$I;if($I===null)$I=(SID&&!($_COOKIE&&ini_bool("session.use_cookies")));return$I;}function
set_password($Ui,$N,$V,$F){$_SESSION["pwds"][$Ui][$N][$V]=($_COOKIE["adminer_key"]&&is_string($F)?array(encrypt_string($F,$_COOKIE["adminer_key"])):$F);}function
get_password(){$I=get_session("pwds");if(is_array($I))$I=($_COOKIE["adminer_key"]?decrypt_string($I[0],$_COOKIE["adminer_key"]):false);return$I;}function
q($P){global$g;return$g->quote($P);}function
get_vals($G,$e=0){global$g;$I=array();$H=$g->query($G);if(is_object($H)){while($J=$H->fetch_row())$I[]=$J[$e];}return$I;}function
get_key_vals($G,$h=null,$lh=true){global$g;if(!is_object($h))$h=$g;$I=array();$H=$h->query($G);if(is_object($H)){while($J=$H->fetch_row()){if($lh)$I[$J[0]]=$J[1];else$I[]=$J[0];}}return$I;}function
get_rows($G,$h=null,$o="<p class='error'>"){global$g;$vb=(is_object($h)?$h:$g);$I=array();$H=$vb->query($G);if(is_object($H)){while($J=$H->fetch_assoc())$I[]=$J;}elseif(!$H&&!is_object($h)&&$o&&defined("PAGE_HEADER"))echo$o.error()."\n";return$I;}function
unique_array($J,$x){foreach($x
as$w){if(preg_match("~PRIMARY|UNIQUE~",$w["type"])){$I=array();foreach($w["columns"]as$z){if(!isset($J[$z]))continue
2;$I[$z]=$J[$z];}return$I;}}}function
escape_key($z){if(preg_match('(^([\w(]+)('.str_replace("_",".*",preg_quote(idf_escape("_"))).')([ \w)]+)$)',$z,$B))return$B[1].idf_escape(idf_unescape($B[2])).$B[3];return
idf_escape($z);}function
where($Z,$q=array()){global$g,$y;$I=array();foreach((array)$Z["where"]as$z=>$X){$z=bracket_escape($z,1);$e=escape_key($z);$I[]=$e.($y=="sql"&&preg_match('~^[0-9]*\.[0-9]*$~',$X)?" LIKE ".q(addcslashes($X,"%_\\")):($y=="mssql"?" LIKE ".q(preg_replace('~[_%[]~','[\0]',$X)):" = ".unconvert_field($q[$z],q($X))));if($y=="sql"&&preg_match('~char|text~',$q[$z]["type"])&&preg_match("~[^ -@]~",$X))$I[]="$e = ".q($X)." COLLATE ".charset($g)."_bin";}foreach((array)$Z["null"]as$z)$I[]=escape_key($z)." IS NULL";return
implode(" AND ",$I);}function
where_check($X,$q=array()){parse_str($X,$cb);remove_slashes(array(&$cb));return
where($cb,$q);}function
where_link($t,$e,$Y,$rf="="){return"&where%5B$t%5D%5Bcol%5D=".urlencode($e)."&where%5B$t%5D%5Bop%5D=".urlencode(($Y!==null?$rf:"IS NULL"))."&where%5B$t%5D%5Bval%5D=".urlencode($Y);}function
convert_fields($f,$q,$L=array()){$I="";foreach($f
as$z=>$X){if($L&&!in_array(idf_escape($z),$L))continue;$Ga=convert_field($q[$z]);if($Ga)$I.=", $Ga AS ".idf_escape($z);}return$I;}function
cookie($C,$Y,$te=2592000){global$ba;return
header("Set-Cookie: $C=".urlencode($Y).($te?"; expires=".gmdate("D, d M Y H:i:s",time()+$te)." GMT":"")."; path=".preg_replace('~\?.*~','',$_SERVER["REQUEST_URI"]).($ba?"; secure":"")."; HttpOnly; SameSite=lax",false);}function
restart_session(){if(!ini_bool("session.use_cookies"))session_start();}function
stop_session($Zc=false){if(!ini_bool("session.use_cookies")||($Zc&&@ini_set("session.use_cookies",false)!==false))session_write_close();}function&get_session($z){return$_SESSION[$z][DRIVER][SERVER][$_GET["username"]];}function
set_session($z,$X){$_SESSION[$z][DRIVER][SERVER][$_GET["username"]]=$X;}function
auth_url($Ui,$N,$V,$m=null){global$cc;preg_match('~([^?]*)\??(.*)~',remove_from_uri(implode("|",array_keys($cc))."|username|".($m!==null?"db|":"").session_name()),$B);return"$B[1]?".(sid()?SID."&":"").($Ui!="server"||$N!=""?urlencode($Ui)."=".urlencode($N)."&":"")."username=".urlencode($V).($m!=""?"&db=".urlencode($m):"").($B[2]?"&$B[2]":"");}function
is_ajax(){return($_SERVER["HTTP_X_REQUESTED_WITH"]=="XMLHttpRequest");}function
redirect($ve,$Je=null){if($Je!==null){restart_session();$_SESSION["messages"][preg_replace('~^[^?]*~','',($ve!==null?$ve:$_SERVER["REQUEST_URI"]))][]=$Je;}if($ve!==null){if($ve=="")$ve=".";header("Location: $ve");exit;}}function
query_redirect($G,$ve,$Je,$zg=true,$Ac=true,$Lc=false,$ci=""){global$g,$o,$b;if($Ac){$Ah=microtime(true);$Lc=!$g->query($G);$ci=format_time($Ah);}$wh="";if($G)$wh=$b->messageQuery($G,$ci,$Lc);if($Lc){$o=error().$wh.script("messagesPrint();");return
false;}if($zg)redirect($ve,$Je.$wh);return
true;}function
queries($G){global$g;static$sg=array();static$Ah;if(!$Ah)$Ah=microtime(true);if($G===null)return
array(implode("\n",$sg),format_time($Ah));$sg[]=(preg_match('~;$~',$G)?"DELIMITER ;;\n$G;\nDELIMITER ":$G).";";return$g->query($G);}function
apply_queries($G,$S,$xc='table'){foreach($S
as$Q){if(!queries("$G ".$xc($Q)))return
false;}return
true;}function
queries_redirect($ve,$Je,$zg){list($sg,$ci)=queries(null);return
query_redirect($sg,$ve,$Je,$zg,false,!$zg,$ci);}function
format_time($Ah){return
sprintf('%.3f s',max(0,microtime(true)-$Ah));}function
remove_from_uri($Kf=""){return
substr(preg_replace("~(?<=[?&])($Kf".(SID?"":"|".session_name()).")=[^&]*&~",'',"$_SERVER[REQUEST_URI]&"),0,-1);}function
pagination($E,$Hb){return" ".($E==$Hb?$E+1:'<a href="'.h(remove_from_uri("page").($E?"&page=$E".($_GET["next"]?"&next=".urlencode($_GET["next"]):""):"")).'">'.($E+1)."</a>");}function
get_file($z,$Pb=false){$Rc=$_FILES[$z];if(!$Rc)return
null;foreach($Rc
as$z=>$X)$Rc[$z]=(array)$X;$I='';foreach($Rc["error"]as$z=>$o){if($o)return$o;$C=$Rc["name"][$z];$ki=$Rc["tmp_name"][$z];$yb=file_get_contents($Pb&&preg_match('~\.gz$~',$C)?"compress.zlib://$ki":$ki);if($Pb){$Ah=substr($yb,0,3);if(function_exists("iconv")&&preg_match("~^\xFE\xFF|^\xFF\xFE~",$Ah,$Eg))$yb=iconv("utf-16","utf-8",$yb);elseif($Ah=="\xEF\xBB\xBF")$yb=substr($yb,3);$I.=$yb."\n\n";}else$I.=$yb;}return$I;}function
upload_error($o){$Ge=($o==UPLOAD_ERR_INI_SIZE?ini_get("upload_max_filesize"):0);return($o?'Unable to upload a file.'.($Ge?" ".sprintf('Maximum allowed file size is %sB.',$Ge):""):'File does not exist.');}function
repeat_pattern($Xf,$re){return
str_repeat("$Xf{0,65535}",$re/65535)."$Xf{0,".($re%65535)."}";}function
is_utf8($X){return(preg_match('~~u',$X)&&!preg_match('~[\0-\x8\xB\xC\xE-\x1F]~',$X));}function
shorten_utf8($P,$re=80,$Ih=""){if(!preg_match("(^(".repeat_pattern("[\t\r\n -\x{10FFFF}]",$re).")($)?)u",$P,$B))preg_match("(^(".repeat_pattern("[\t\r\n -~]",$re).")($)?)",$P,$B);return
h($B[1]).$Ih.(isset($B[2])?"":"<i>â¦</i>");}function
format_number($X){return
strtr(number_format($X,0,".",','),preg_split('~~u','0123456789',-1,PREG_SPLIT_NO_EMPTY));}function
friendly_url($X){return
preg_replace('~[^a-z0-9_]~i','-',$X);}function
hidden_fields($ng,$Dd=array()){$I=false;while(list($z,$X)=each($ng)){if(!in_array($z,$Dd)){if(is_array($X)){foreach($X
as$be=>$W)$ng[$z."[$be]"]=$W;}else{$I=true;echo'<input type="hidden" name="'.h($z).'" value="'.h($X).'">';}}}return$I;}function
hidden_fields_get(){echo(sid()?'<input type="hidden" name="'.session_name().'" value="'.h(session_id()).'">':''),(SERVER!==null?'<input type="hidden" name="'.DRIVER.'" value="'.h(SERVER).'">':""),'<input type="hidden" name="username" value="'.h($_GET["username"]).'">';}function
table_status1($Q,$Mc=false){$I=table_status($Q,$Mc);return($I?$I:array("Name"=>$Q));}function
column_foreign_keys($Q){global$b;$I=array();foreach($b->foreignKeys($Q)as$r){foreach($r["source"]as$X)$I[$X][]=$r;}return$I;}function
enum_input($T,$Ja,$p,$Y,$rc=null){global$b;preg_match_all("~'((?:[^']|'')*)'~",$p["length"],$Be);$I=($rc!==null?"<label><input type='$T'$Ja value='$rc'".((is_array($Y)?in_array($rc,$Y):$Y===0)?" checked":"")."><i>".'empty'."</i></label>":"");foreach($Be[1]as$t=>$X){$X=stripcslashes(str_replace("''","'",$X));$eb=(is_int($Y)?$Y==$t+1:(is_array($Y)?in_array($t+1,$Y):$Y===$X));$I.=" <label><input type='$T'$Ja value='".($t+1)."'".($eb?' checked':'').'>'.h($b->editVal($X,$p)).'</label>';}return$I;}function
input($p,$Y,$s){global$U,$b,$y;$C=h(bracket_escape($p["field"]));echo"<td class='function'>";if(is_array($Y)&&!$s){$Ea=array($Y);if(version_compare(PHP_VERSION,5.4)>=0)$Ea[]=JSON_PRETTY_PRINT;$Y=call_user_func_array('json_encode',$Ea);$s="json";}$Ig=($y=="mssql"&&$p["auto_increment"]);if($Ig&&!$_POST["save"])$s=null;$id=(isset($_GET["select"])||$Ig?array("orig"=>'original'):array())+$b->editFunctions($p);$Ja=" name='fields[$C]'";if($p["type"]=="enum")echo
h($id[""])."<td>".$b->editInput($_GET["edit"],$p,$Ja,$Y);else{$sd=(in_array($s,$id)||isset($id[$s]));echo(count($id)>1?"<select name='function[$C]'>".optionlist($id,$s===null||$sd?$s:"")."</select>".on_help("getTarget(event).value.replace(/^SQL\$/, '')",1).script("qsl('select').onchange = functionChange;",""):h(reset($id))).'<td>';$Qd=$b->editInput($_GET["edit"],$p,$Ja,$Y);if($Qd!="")echo$Qd;elseif(preg_match('~bool~',$p["type"]))echo"<input type='hidden'$Ja value='0'>"."<input type='checkbox'".(preg_match('~^(1|t|true|y|yes|on)$~i',$Y)?" checked='checked'":"")."$Ja value='1'>";elseif($p["type"]=="set"){preg_match_all("~'((?:[^']|'')*)'~",$p["length"],$Be);foreach($Be[1]as$t=>$X){$X=stripcslashes(str_replace("''","'",$X));$eb=(is_int($Y)?($Y>>$t)&1:in_array($X,explode(",",$Y),true));echo" <label><input type='checkbox' name='fields[$C][$t]' value='".(1<<$t)."'".($eb?' checked':'').">".h($b->editVal($X,$p)).'</label>';}}elseif(preg_match('~blob|bytea|raw|file~',$p["type"])&&ini_bool("file_uploads"))echo"<input type='file' name='fields-$C'>";elseif(($ai=preg_match('~text|lob~',$p["type"]))||preg_match("~\n~",$Y)){if($ai&&$y!="sqlite")$Ja.=" cols='50' rows='12'";else{$K=min(12,substr_count($Y,"\n")+1);$Ja.=" cols='30' rows='$K'".($K==1?" style='height: 1.2em;'":"");}echo"<textarea$Ja>".h($Y).'</textarea>';}elseif($s=="json"||preg_match('~^jsonb?$~',$p["type"]))echo"<textarea$Ja cols='50' rows='12' class='jush-js'>".h($Y).'</textarea>';else{$Ie=(!preg_match('~int~',$p["type"])&&preg_match('~^(\d+)(,(\d+))?$~',$p["length"],$B)?((preg_match("~binary~",$p["type"])?2:1)*$B[1]+($B[3]?1:0)+($B[2]&&!$p["unsigned"]?1:0)):($U[$p["type"]]?$U[$p["type"]]+($p["unsigned"]?0:1):0));if($y=='sql'&&min_version(5.6)&&preg_match('~time~',$p["type"]))$Ie+=7;echo"<input".((!$sd||$s==="")&&preg_match('~(?<!o)int(?!er)~',$p["type"])&&!preg_match('~\[\]~',$p["full_type"])?" type='number'":"")." value='".h($Y)."'".($Ie?" data-maxlength='$Ie'":"").(preg_match('~char|binary~',$p["type"])&&$Ie>20?" size='40'":"")."$Ja>";}echo$b->editHint($_GET["edit"],$p,$Y);$Uc=0;foreach($id
as$z=>$X){if($z===""||!$X)break;$Uc++;}if($Uc)echo
script("mixin(qsl('td'), {onchange: partial(skipOriginal, $Uc), oninput: function () { this.onchange(); }});");}}function
process_input($p){global$b,$n;$v=bracket_escape($p["field"]);$s=$_POST["function"][$v];$Y=$_POST["fields"][$v];if($p["type"]=="enum"){if($Y==-1)return
false;if($Y=="")return"NULL";return+$Y;}if($p["auto_increment"]&&$Y=="")return
null;if($s=="orig")return(preg_match('~^CURRENT_TIMESTAMP~i',$p["on_update"])?idf_escape($p["field"]):false);if($s=="NULL")return"NULL";if($p["type"]=="set")return
array_sum((array)$Y);if($s=="json"){$s="";$Y=json_decode($Y,true);if(!is_array($Y))return
false;return$Y;}if(preg_match('~blob|bytea|raw|file~',$p["type"])&&ini_bool("file_uploads")){$Rc=get_file("fields-$v");if(!is_string($Rc))return
false;return$n->quoteBinary($Rc);}return$b->processInput($p,$Y,$s);}function
fields_from_edit(){global$n;$I=array();foreach((array)$_POST["field_keys"]as$z=>$X){if($X!=""){$X=bracket_escape($X);$_POST["function"][$X]=$_POST["field_funs"][$z];$_POST["fields"][$X]=$_POST["field_vals"][$z];}}foreach((array)$_POST["fields"]as$z=>$X){$C=bracket_escape($z,1);$I[$C]=array("field"=>$C,"privileges"=>array("insert"=>1,"update"=>1),"null"=>1,"auto_increment"=>($z==$n->primary),);}return$I;}function
search_tables(){global$b,$g;$_GET["where"][0]["val"]=$_POST["query"];$fh="<ul>\n";foreach(table_status('',true)as$Q=>$R){$C=$b->tableName($R);if(isset($R["Engine"])&&$C!=""&&(!$_POST["tables"]||in_array($Q,$_POST["tables"]))){$H=$g->query("SELECT".limit("1 FROM ".table($Q)," WHERE ".implode(" AND ",$b->selectSearchProcess(fields($Q),array())),1));if(!$H||$H->fetch_row()){$jg="<a href='".h(ME."select=".urlencode($Q)."&where[0][op]=".urlencode($_GET["where"][0]["op"])."&where[0][val]=".urlencode($_GET["where"][0]["val"]))."'>$C</a>";echo"$fh<li>".($H?$jg:"<p class='error'>$jg: ".error())."\n";$fh="";}}}echo($fh?"<p class='message'>".'No tables.':"</ul>")."\n";}function
dump_headers($Ad,$Se=false){global$b;$I=$b->dumpHeaders($Ad,$Se);$Hf=$_POST["output"];if($Hf!="text")header("Content-Disposition: attachment; filename=".$b->dumpFilename($Ad).".$I".($Hf!="file"&&!preg_match('~[^0-9a-z]~',$Hf)?".$Hf":""));session_write_close();ob_flush();flush();return$I;}function
dump_csv($J){foreach($J
as$z=>$X){if(preg_match("~[\"\n,;\t]~",$X)||$X==="")$J[$z]='"'.str_replace('"','""',$X).'"';}echo
implode(($_POST["format"]=="csv"?",":($_POST["format"]=="tsv"?"\t":";")),$J)."\r\n";}function
apply_sql_function($s,$e){return($s?($s=="unixepoch"?"DATETIME($e, '$s')":($s=="count distinct"?"COUNT(DISTINCT ":strtoupper("$s("))."$e)"):$e);}function
get_temp_dir(){$I=ini_get("upload_tmp_dir");if(!$I){if(function_exists('sys_get_temp_dir'))$I=sys_get_temp_dir();else{$Sc=@tempnam("","");if(!$Sc)return
false;$I=dirname($Sc);unlink($Sc);}}return$I;}function
file_open_lock($Sc){$gd=@fopen($Sc,"r+");if(!$gd){$gd=@fopen($Sc,"w");if(!$gd)return;chmod($Sc,0660);}flock($gd,LOCK_EX);return$gd;}function
file_write_unlock($gd,$Jb){rewind($gd);fwrite($gd,$Jb);ftruncate($gd,strlen($Jb));flock($gd,LOCK_UN);fclose($gd);}function
password_file($i){$Sc=get_temp_dir()."/adminer.key";$I=@file_get_contents($Sc);if($I||!$i)return$I;$gd=@fopen($Sc,"w");if($gd){chmod($Sc,0660);$I=rand_string();fwrite($gd,$I);fclose($gd);}return$I;}function
rand_string(){return
md5(uniqid(mt_rand(),true));}function
select_value($X,$A,$p,$bi){global$b;if(is_array($X)){$I="";foreach($X
as$be=>$W)$I.="<tr>".($X!=array_values($X)?"<th>".h($be):"")."<td>".select_value($W,$A,$p,$bi);return"<table cellspacing='0'>$I</table>";}if(!$A)$A=$b->selectLink($X,$p);if($A===null){if(is_mail($X))$A="mailto:$X";if(is_url($X))$A=$X;}$I=$b->editVal($X,$p);if($I!==null){if(!is_utf8($I))$I="\0";elseif($bi!=""&&is_shortable($p))$I=shorten_utf8($I,max(0,+$bi));else$I=h($I);}return$b->selectVal($I,$A,$p,$X);}function
is_mail($oc){$Ha='[-a-z0-9!#$%&\'*+/=?^_`{|}~]';$bc='[a-z0-9]([-a-z0-9]{0,61}[a-z0-9])';$Xf="$Ha+(\\.$Ha+)*@($bc?\\.)+$bc";return
is_string($oc)&&preg_match("(^$Xf(,\\s*$Xf)*\$)i",$oc);}function
is_url($P){$bc='[a-z0-9]([-a-z0-9]{0,61}[a-z0-9])';return
preg_match("~^(https?)://($bc?\\.)+$bc(:\\d+)?(/.*)?(\\?.*)?(#.*)?\$~i",$P);}function
is_shortable($p){return
preg_match('~char|text|json|lob|geometry|point|linestring|polygon|string|bytea~',$p["type"]);}function
count_rows($Q,$Z,$Wd,$ld){global$y;$G=" FROM ".table($Q).($Z?" WHERE ".implode(" AND ",$Z):"");return($Wd&&($y=="sql"||count($ld)==1)?"SELECT COUNT(DISTINCT ".implode(", ",$ld).")$G":"SELECT COUNT(*)".($Wd?" FROM (SELECT 1$G GROUP BY ".implode(", ",$ld).") x":$G));}function
slow_query($G){global$b,$mi,$n;$m=$b->database();$di=$b->queryTimeout();$qh=$n->slowQuery($G,$di);if(!$qh&&support("kill")&&is_object($h=connect())&&($m==""||$h->select_db($m))){$ge=$h->result(connection_id());echo'<script',nonce(),'>
var timeout = setTimeout(function () {
	ajax(\'',js_escape(ME),'script=kill\', function () {
	}, \'kill=',$ge,'&token=',$mi,'\');
}, ',1000*$di,');
</script>
';}else$h=null;ob_flush();flush();$I=@get_key_vals(($qh?$qh:$G),$h,false);if($h){echo
script("clearTimeout(timeout);");ob_flush();flush();}return$I;}function
get_token(){$vg=rand(1,1e6);return($vg^$_SESSION["token"]).":$vg";}function
verify_token(){list($mi,$vg)=explode(":",$_POST["token"]);return($vg^$_SESSION["token"])==$mi;}function
lzw_decompress($Ra){$Xb=256;$Sa=8;$lb=array();$Kg=0;$Lg=0;for($t=0;$t<strlen($Ra);$t++){$Kg=($Kg<<8)+ord($Ra[$t]);$Lg+=8;if($Lg>=$Sa){$Lg-=$Sa;$lb[]=$Kg>>$Lg;$Kg&=(1<<$Lg)-1;$Xb++;if($Xb>>$Sa)$Sa++;}}$Wb=range("\0","\xFF");$I="";foreach($lb
as$t=>$kb){$nc=$Wb[$kb];if(!isset($nc))$nc=$jj.$jj[0];$I.=$nc;if($t)$Wb[]=$jj.$nc[0];$jj=$nc;}return$I;}function
on_help($rb,$nh=0){return
script("mixin(qsl('select, input'), {onmouseover: function (event) { helpMouseover.call(this, event, $rb, $nh) }, onmouseout: helpMouseout});","");}function
edit_form($a,$q,$J,$Hi){global$b,$y,$mi,$o;$Nh=$b->tableName(table_status1($a,true));page_header(($Hi?'Edit':'Insert'),$o,array("select"=>array($a,$Nh)),$Nh);if($J===false)echo"<p class='error'>".'No rows.'."\n";echo'<form action="" method="post" enctype="multipart/form-data" id="form">
';if(!$q)echo"<p class='error'>".'You have no privileges to update this table.'."\n";else{echo"<table cellspacing='0' class='layout'>".script("qsl('table').onkeydown = editingKeydown;");foreach($q
as$C=>$p){echo"<tr><th>".$b->fieldName($p);$Qb=$_GET["set"][bracket_escape($C)];if($Qb===null){$Qb=$p["default"];if($p["type"]=="bit"&&preg_match("~^b'([01]*)'\$~",$Qb,$Eg))$Qb=$Eg[1];}$Y=($J!==null?($J[$C]!=""&&$y=="sql"&&preg_match("~enum|set~",$p["type"])?(is_array($J[$C])?array_sum($J[$C]):+$J[$C]):$J[$C]):(!$Hi&&$p["auto_increment"]?"":(isset($_GET["select"])?false:$Qb)));if(!$_POST["save"]&&is_string($Y))$Y=$b->editVal($Y,$p);$s=($_POST["save"]?(string)$_POST["function"][$C]:($Hi&&preg_match('~^CURRENT_TIMESTAMP~i',$p["on_update"])?"now":($Y===false?null:($Y!==null?'':'NULL'))));if(preg_match("~time~",$p["type"])&&preg_match('~^CURRENT_TIMESTAMP~i',$Y)){$Y="";$s="now";}input($p,$Y,$s);echo"\n";}if(!support("table"))echo"<tr>"."<th><input name='field_keys[]'>".script("qsl('input').oninput = fieldChange;")."<td class='function'>".html_select("field_funs[]",$b->editFunctions(array("null"=>isset($_GET["select"]))))."<td><input name='field_vals[]'>"."\n";echo"</table>\n";}echo"<p>\n";if($q){echo"<input type='submit' value='".'Save'."'>\n";if(!isset($_GET["select"])){echo"<input type='submit' name='insert' value='".($Hi?'Save and continue edit':'Save and insert next')."' title='Ctrl+Shift+Enter'>\n",($Hi?script("qsl('input').onclick = function () { return !ajaxForm(this.form, '".'Saving'."â¦', this); };"):"");}}echo($Hi?"<input type='submit' name='delete' value='".'Delete'."'>".confirm()."\n":($_POST||!$q?"":script("focus(qsa('td', qs('#form'))[1].firstChild);")));if(isset($_GET["select"]))hidden_fields(array("check"=>(array)$_POST["check"],"clone"=>$_POST["clone"],"all"=>$_POST["all"]));echo'<input type="hidden" name="referer" value="',h(isset($_POST["referer"])?$_POST["referer"]:$_SERVER["HTTP_REFERER"]),'">
<input type="hidden" name="save" value="1">
<input type="hidden" name="token" value="',$mi,'">
</form>
';}if(isset($_GET["file"])){if($_SERVER["HTTP_IF_MODIFIED_SINCE"]){header("HTTP/1.1 304 Not Modified");exit;}header("Expires: ".gmdate("D, d M Y H:i:s",time()+365*24*60*60)." GMT");header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");header("Cache-Control: immutable");if($_GET["file"]=="favicon.ico"){header("Content-Type: image/x-icon");echo
lzw_decompress("\0\0\0` \0\0\n @\0´Cè\"\0`EãQ¸àÿ?ÀtvM'JdÁd\\b0\0Ä\"ÀfÓ¤îs5ÏçÑAXPaJ0¥8#RT©z`#.©ÇcíXÃþÈ?À-\0¡Im? .«M¶\0È¯(ÌýÀ/(%\0");}elseif($_GET["file"]=="default.css"){header("Content-Type: text/css; charset=utf-8");echo
lzw_decompress("\n1ÌÙÞl7B14vb0Ífs¼ên2BÌÑ±ÙÞn:#(¼b.\rDc)ÈÈa7E¤Âl¦Ã±èi1Ìs´ç-4fÓ	ÈÎi7³éFÃ©vt2Ó!r0Ïãã£t~½U'3MÉWB¦'cÍPÂ:6T\rc£A¾zr_îWK¶\r-¼VNFS%~Ãc²Ùí&\\^ÊrÀ­æuÅÃôÙ4'7k¶è¯ÂãQÔæh'g\rFB\ryT7SS¥PÐ1=Ç¤cIèÊ:dºm>£S8LJt.M¢	Ï`'C¡¼ÛÐ889¤È QØýî2#8Ð­£6mú²ðj¢h«<°«9/ëç:Jê)Ê¤\0d>!\0Zvì»në¾ð¼o(Úó¥ÉkÔ7½sàù>î!ÐR\"*nSý\0@P\"Áè(#[¶¥£@g¹oü­znþ9k¤8nª1´I*ô=Ín²¤ª¸è0«c(ö;¾Ã Ðè!°üë*cì÷>Î¬E7DñLJ© 1Èä·ã`Â8(áÕ3M¨ó\"Ç39é?Ee=Ò¬ü~ù¾²ôÅîÓ¸7;ÉCÄÁÍE\rd!)Âa*¯5ajo\0ª#`Ê38¶\0Êí]eêÆ2¤	mk×øe]Á­AZsÕStZZ!)BR¨G+Î#Jv2(ã öîc4<¸#sB¯0éú6YL\r²=£¿[×73Æð<Ô:£bxßJ=	m_ ¾ÏÅfªlÙ×tåIªHÚ3x*á6`t6¾Ã%UÔLòeÙ<´\0ÉAQ<P<:#u/¤:T\\> Ë-xJÍQH\nj¡L+jÝzðó°7£«`Ýð³\nk'NÓvX>îC-TË©¶¸4*L%Cj>7ß¨Þ¨­õ`ù®;yØûÆqÁrÊ3#¨Ù} :#ní\rã½^Å=CåAÜ¸ÝÆs&8£K&»ô*0ÑÒtÝSÉÔÅ=¾[×ó:\\]ÃEÝ/Oà>^]ØÃ¸Â<èØ÷gZÔVéqº³ù ñËx\\­èö¹ßÞº´\"J \\Ã®û##Á¡½DÎx6êÚ5xÊÜ¸¶¨\rHøl ñø°bú r¼7áÔ6àöj|Áô¢Û*ôFAquvyO½WeMÖ÷D.Fáö:RÐ\$-¡Þ¶µT!ìDS`°8D~àA`(Çem¦òý¢T@O1@ºX¦â\nLpðPäþÁÓÂm«yf¸£)	«ÂÚGSEI¥xC(s(a?\$`tE¨nñ±­,÷Õ \$aU>,èÐ\$ZñkDm,G\0å \\iú£%Ê¹¢ n¬¥¥±·ìÝÜgÉb	y`òÔËWì· ä¡_CÀÄT\niÏH%ÕdaÀÖiÍ7íAt°,Á®JX4n0oÍ¹»9g\nzmM%`É'IüÐ-èò©Ð7:pð3pÇQrED¤×ì àb2]PF ý¥É>eÉú3j\nß°t!Á?4ftK;£Ê\rÎÐ¸­!àou?ÓúPhÒ0uIC}'~ÅÈ2vþQ¨ÒÎ8)ìÀ7ìDIù=§éy&¢eaàs*hÉjlAÄ(ê\"Ä\\Óêm^i®M)°^	|~Õl¨¶#!YÍf81RS Áµ!è62PÆCôl&íûäxd!| è9°`Ö_OYí=ðÑGà[EÉ-eLñCvT¬ )Ä@j-5¨¶pSg».G=ÐZEÒö\$\0¢ÑKjíU§µ\$ ÀG'IäP©Â~ûÚð ;ÚhNÛG%*áRjñX[XPf^Á±|æèT!µ*NððÐ¸\rU¢^q1V!ÃùUz,ÃI|7°7r,¾¡¬7èÞÄ¾BÖùÈ;é+÷¨©ßAÚpÍÎ½Ç^¡~Ø¼W!3PI8]½vÓJÁfñq£|,êè9Wøf`\0áqAÖwE¬àçÕ´¦FÙTî«QÕGÎù\$0ÇÊ #Ç%By7r¨i{eÍQÔòdìÇ ÌB4;ks(å0ÝÁ=1r)_<¿Ø;Ì¹çSÛr  &YÇ,h,®iiÙÕÁbÉÌ¢Aé ¼åG±´Lz2p(¦ÏÙõ0À°ÂL	¡¹SÅú¨¨EêÀ	<©ÄÇ}_#\\fª¨daÊçKå3¼Y|V+êl@²0`;ÅàËLhÅä±ÁÞ¯j'öàÆ»Yâ+¶QZ-iôyvI5Ú0O|½PÖ]FÜáòÓùñ\0üË2D9Í¢¤Án/ÏQØ³&¦ªI^®=Ól©qfIÆÊ= Ö]xqGRüF¦e¹7éº)ó9*Æ:B²b±>a¦z-µÑ2.¯ö¬¸b{°ð4#¥¼òÄUáÆL7-¼Áv/;Ê5ñôu©ÊöHå§&²#÷³¤jÖ`ÕG8Î 7pùØðÒ YCÁÐ~ÁÈ:À@ÆÞEUJÜÛ;v7v]¶J'ØÞäq1ï·éElôÐi¾ÍÃÏ/íÿ{k<àÖ¡MÜpoí}ðéÁ¤±Ù,ìdÃ¦Ù_uÓïÂpºuÞ½Åùúüú=»·tnþ´	ý~×LxîøæÖ{kàßåÞù\rj~·P+ÿç0ÐuòowÚyu\$Üèß·î\nd¥Ém´ZdÀ8i`¤=ûÛgð<§ùÛìáÍ*+3j¦ÌüÜ<[\0²®ÿ/PÍ­BÿÎr±ö`Ë`½#xå+B?#öÜ^;Ob\r¨èù¯4øÏ\n÷Ìæ¿0\núô¿0\\×0>Pø@ú¯À2lÆÂjÒOªëÿ¨(_î<çW\$Ùgºø G­t×@ûl.hSiÆ¾°¬PH\n¦JëâëèLDãh6ÅÂ¶B	¯ÃrÚâ\r¨6£n¬Ðå°ë0à Fõp-Ðç\rà\r\0àçq±°ã#q`¿ü¨#EÑ(q}¨Ð·úéñ	 4@ïéúÉf|\0``f*â` `Ð×QRvßyÀê\rñ-±B± ¤y7±&ª@Øñ± ¤ª`¿ñ_IÙ1@`)lÁñxàì)±Q±ÞðqÑÜ)­ìÝâêÞ1sQeyqw1ïÇèA 2 ±ò*¨Çq wg>C°®B³ÈºA*Î~pÕPêO`Ï	CÙ\$¢Ò³2M%ÆR²W±%RO&2S\rkàØÒ~²/jÀPÙ\$@¾Ò_)rw&ORq%±*rm)²«'O'Ñ1'R(5(IÙr:im,à¨lQ0\0ÛòD÷ñ'%rÛ-ñ =°Çrë'2K/²X@`è¯Ò:,#*Ò¥+RY3ò~ÇEüÙÑ23'-Q*\r`Ê113s;&cq10ë4Ï.¨A2ë32@7*2f`Òç-Q!ÓEÒ&ò6Ò%­7±bÁ6ñÙ%ÓóÓ1 àóy9²[7Qu9Ó ªs7Ó©À¾\r©;4¹;Ó£!s!c\\e;1<Sq³Ó=s52,±jSñ)ê]ñâóùmp&Q'<±@1®0\"Á:hÐ¡ï³ÔRÊiÍ.JÓ.BÐQ&é\n°0	5¢;±°j©½DðÙ9-\r\"S®ü±1@esãEq¤eÓ&ÌT.*L¼i3Ë:³§Eó¥H³¹ ­GÍ®(ýrEIJi!4Y±yJÔKûKt³;ºT.Ã)ÂÂo)| P;.²°â\nl¼*Îµâ«jþ±¤|½£OÃl²Bâ.hº.ôòò AÌ\rÃ.²88Ö2tÚ#ôÞo¢ANbËN©?ñ!ÀËOBóO,d­¼*");}elseif($_GET["file"]=="functions.js"){header("Content-Type: text/javascript; charset=utf-8");echo
lzw_decompress("f:gCI¼Ü\n8Å3)°Ë781ÐÊx:\nOg#)Ðêr7\n\"è´`ø|2ÌgSiH)N¦Sä§\r\"0¹Ä@ä)`(\$s6O!ÓèV/=' T4æ=iS6IOÊerÙxî9*Åº°ºn3\rÑvCÁ`õÝ2G%¨Yãæáþ1Ífô¹ÑÈl¤Ã1\ny£*pC\r\$ÌnTª3=\\r9O\"ã	Ààl<\rÇ\\³I,s\nA¤Æeh+Mâ!q0ýf»`(¹N{c+wËñÁY£pÙ§33ú+I¦Ôj¹ºýÏk·²n¸qÜzi#^rØÀº´3èâÏ[èºo;®Ë(Ð6#ÀÒ\":cz>ß£C2vÑCXÊ<PÃc*5\nº¨è·/üP97ñ|F»°c0³¨°ä!æ!¨!Ã\nZ%ÃÄ#CHÌ!¨Òr8ç\$¥¡ì¯,ÈRÜ2Èã^0·á@¤2â(ð88P/à¸Ýá\\Á\$La\\å;càHáHX\nÊtá8A<ÏsZô*;IÐÎ3¡Á@Ò2<¢¬!A8G<Ôj¿-K({*\rÅa1¡èN4Tc\"\\Ò!=1^ðÝM9O³:;j\rãXÒàL#HÎ7#TÝª/-´£pÊ;B Â\n¿2!¥Ít]apÎÝî\0RÛCËv¬MÂI,\rö§\0Hv°Ý?kTÞ4£¼óuÙ±Ø;&ò+&ðµ\rÈXbu4Ý¡i88Â2Bä/â4¡N8AÜA)52íúøËåÎ2¨sã8ç5¤¥¡pçWC@è:tã¾´Öeh\"#8_æcp^ãâI]OHþÔ:zdÈ3g£(×Ãk¸î\\6´2ÚÚ÷¹iÃä7²Ï]\rÃxO¾nºpè<¡ÁpïQ®UÐnò|@çËó#G3ðÁ8bA¨Ê6ô267%#¸\\8\rý2Èc\ræÝk®.(	-J;îÑó ÈéLãÏ ¼Wâøã§Ñ¥É¤â÷·nû Ò§»æýMÎÀ9ZÐs]êz®¯¬ëy^[¯ì4-ºU\0ta ¶62^.`¤â.Cßjÿ[á % Q\0`dëM8¿¦¼ËÛ\$O0`4²êÎ\n\0a\rA<@\r!À:ØBA9Ù?h>¤Çº ~Ì6ÈhÜ=Ë-A7XäÀÖ\\¼\rQ<è§q'!XÎ2úT °!D\r§Ò,K´\"ç%HÖqR\rÌ ¢îC =í æäÈ<c\n#<5Mø êEy¡°úo\"°cJKL2ù&£ØeRÀWÐAÎTwÊÑ;åJâá\\`)5¦ÔÞBòqhT3§àR	¸'\r+\": Øðà.ÑZM'|¬et:3%LÜË#Âf!ñhà×e³Ù+Ä¼­Ná¹	Á½_CXGî1µi-Ã£z\$oK@O@TÒ=&0\$	àDA¥ùùDàªSJèx9×FÈml¨Èp»GÕ­¤T6RfÀ@a¾\rs´RªFgih]¥éf.7+Ñ<nhh* ÈSH	P]¡ :Ò¨Áa\"¨Õù¬2¦&R©)ùB¦PÊÓH/õf {r|¨0^ÙhCAÌ0»@æMÎâç2B@©âzªU¾O÷þCppå\\¾L«%è¬ðy«çodÃ¥´p3·7E¸ÐÜA\\°öKÛXnØi.ÐZ×Í ós¡Gým^tIòYJüÙ±G1£R¨³Dcäà6tMihÆä9»9gqRLûMj-TQÍ6i«G_!í.½hªvÞûcN¨ý¸^üÑ0w@n|ý½×VûÜ«AÐ­ÃÀ3ú[Úû]	s7õGP@ :Ì1ÑØbØ µìÝwÏ(i³ø:Òåz\\ûº;Óù´AéPU T^£]9Ý`UX+U îQ+ÃbÌÀñ*Ïs¨¼Î[ßÛxkûF*ôÝ§_w.òÅ6~òbÛÎmKì¾sIÞMKÉ}ïÒ¥ÚøåeHÉ²dµ*mdçlQ°eHô2½ÔL¨ aÒ¯=³sëPøaM\"apÃÀ:<áäGB\r2Ytx&L}}ßAÏÔ±NGÐ¬zaöD4øtÔ4QÉvS©Ã¹S\rÎ;U¸ê¦éäý¸´Æ~pBð{¶ÑÆ,¢O´ãt;ÇJ¡ZC,&Yº:Y\"Ý#ÜãÄt:\nh8r¯¡îÚnéÔÈh>>Zðø`&àaÞpY+¹x¬UÕýA¼<?ãPxWÕ¡¯W	i¬Ë.É\r`÷\$,Àú©Ò¾³V¥]Zrä§H³5Æf\\º-KÆ©¦v¼Zçä®A¸Õ(§{3­oó¿¡l.¿ì¹JéÅ.ç\\t2æ;¯ì2\0´Í>c+|ÁÐ*;-0înÂà[t@ÛÚò¢¤=cQ\n.zÉwC&Ô@ù¦FæÕ'cBS7_*rsÑ¨Ô?jð3@ôÐ!ð.@7s]ÓªòL÷ÎGð@ÿÕ_­qÕ&uûØótª\nÕ´LßEÐT¤ð­}gGþ¸îwëoö(*ªðAí¯-¥Åù¢Õ3¿mk¾÷°¶×¤«t·¢Sø¥Á(ûd±Aî~ïx\n×õô§kÕÏ£:Dø+ gãäh14 Öâ\n.øÏdê«ãì öþéAlYÂ©j©êjJÇÅPN+b D°j¼¬îÔDªÞPäìLQ`Of£@Ø}(ÅÂ6^nB³4Û`ÜeÀ\n	trp!lV¤'}b*r%|\nr\r#°Ä@w®¼-ÔT.Vvâ8ìªæ\nmF¦/Èp¬Ï`úY0¬Ïâë­èP\r8ÀY\rØÝ¤	ÀQ%EÎ/@]\0ÊÀ{@ÌQØá\0bR M\rÙ'|¢è%0SDr¨È f/àÂÜb:Ü­¯¶ÞÃÂ%ßæ3H¦x\0Âl\0ÌÅÚ	Wàß%Ú\nç8\r\0}îDÉ1d#±xä.jEoHrÇ¢lbÀØÚ%tì¦4¸pÀä%Ñ4åÒk®z2\rñ£`îW@Âç%\rJ1X ¤Ú1¾D6!°ô*ä²{4<E¦k.më4Äò×\r\nê^iÀ è³!n«²!2\$§ÈüÌ÷(îfñöÄìÄùk>ï¢ÅËNú5\$àé2T¾,ÖLÄ¬ ¶ Z@ºí*Ð`^PðP%5%ªtHâWÀðonüö«E#föÒ<Ú2@K:ÌoùòÌÏ¦Í-èû2\\Wi+f&Ñòg&²níLõ'eÒ|²´¿nK¥2ûrÚ¶Ëpá*.ánü²Î¦*Ð+ªtBg* òQ1+)1hªî^`Q#ñØân*hòàòv¢Bãñ\0\\F\nWÅr f\$ó=4\$G4ed b:J^!0_àû¦%2ÀË6³.FÑèÒºóEQÁ±²Îdts\"×B(`Ú\rÀ®cR©°°ñV®²óºXêâ:R*2E*sÃ\$¬Ï+Á:bXlÌØtbá-ÄÂS>ù-åd¢=äò\$Sø\$å2ÀÊ7jº\"[Ì\"È] [6SE_>åq.\$@z`í;ô4²3Ê¼ÅCSÕ*ïª[ÀÒÀ{DO´ÞªCJjå³Pò:'èÈ QEÓæ`%rñ¯û7¯þG+hW4E*ÀÐ#TuFj\n¾eùDô^æs§r.ìÅRkæz@¶@»³Dâ`CÂV!Cæå\0ñØÛ)3<Q4@Ù3SPâZB³5FLä¨~G³5ÈÒ:ñÂÓ5\$XÑÔö}ÆfËâIó3S8ñ\0XÔtd³<\nbtNç Q¢;\rÜÑHÕP\0Ô¯&\nà\$VÒ\r:Ò\0]V5gV¦òD`N1:ÓSS4Q4³N5u5Ó`x	Ò<5_FHÜßõ}7­û)SVíÌÄ#ê|Õ< Õ¼ÑË°£ ·\\ Ý-Êz2³\0ü#¡WJU6kv·µÎ#µÒ\rµì·¤§ÀûUõöiÕï_îõ^UVJ|Y.¨É\0u,òðôæ°õ_UQD#µZJuXtñµ_ï&JO,Du`N\r5³Á`«}ZQM^mÌPìG[±Áa»bàNä® ÖreÚ\nÒ%¤4o_(ñ^¶q@Y6t;I\nGSM£3§×^SAYH hB±5 fN?NjWUJÐÂøÖ¯YÖ³ke\"\\B1Ø0º µenÐÄí*<¥O`SL\nÚ.gÍ5Zj¡\0R\$åh÷n÷[¶\\ÝíñrÊ,æ4ð° cP§pq@Rµrw>wCKt¶ }5_uvh¤Ó`/Àúà\$òJ)ÏRõ2Du73Öd\rÂ;­çw´ÝöHùI_\"4±rµ«®¦Ï¿+ê¿&0>É_-eqeDöÍVÔnÄfhüÂ\"ZÀ¨¶óZ¢WÌ6\\Lî¶·ê÷î·ke&ã~àài\$Ï°´Mr×i*×ÄâÔç\0Ì.Q,¶¢8\r±È¸\$×­KÈY ÐioÍe%tÕ2ÿ\0äJýø~×ñ/I/.en«~x!8´À|f¸hÛ-H×åÏ&/Æo­ø.K Ë^jÜÀtµé>('L\ràHsK1´e¤\0\$&3²\0æin3í¨ oä6ôÐ¶ø®÷ô§9j°¸àÈÚ1(b.vC Ý8Ù:wi¬\"®^wµQ©¥Åïzo~Þ/úÒ÷÷`Y2D¬VúÆ³/kã8³¹7ZHø°]2k2r¿ñÏ¯h©=T]O&§\0ÄM\0Ö[8È®æâ8&LÚVm vÀ±êj×ÇFåÄ\\¶	º¾&såQ \\\"òb°	àÄ\rBsIw	YéÂN 7ÇC/*ÙË ¨\n\nÃH[«¹Ô*A ñTEÏVP.UZ(tz/}\n2çyS¢,#É3âi°~W@yCC\nKT¿1\"@|zC\$ü_CZjzHBºLVÔ,Kº£ºOÁÀPà@X´°¨º;DúWZW¥aÙÀ\0ÞÂCG8R  	à¦\nàºÐPÆA£è&º é,ÚpfV|@N¨b¾\$[I­âàð¦´àZ¥@Zd\\\"|¢+¢Û®ìtzðo\$â\0[²èÞ±yE çë³É®bhU1£,r\$ão8D§²F«ÆV&Ú5 h}ÂNÜÍ³&ºçµefÇY¸:»^z©VPu	W¹Z\"rÚ:ûhwµh#1¥´O¥äÃKâhq`å¦óÄ§v| Ë§:wDúj(W¢ºº­¨ï¤»õ?;|Z«%%Ú¡Är@[úÄB»&»³ú#ª©Ù£:)ÂàY6û²è&¹Ü	@¦	àüIÄÒ!©²»¶ Â»â2MäO;²«ÑWÆ¼)êùCãÊFZâp!ÂÄaÄ*FÄb¹I³ÃÍ¾à¤#Ä¤9¡¦åçS©/SüA`zéL*Î8»+¨ÌNùÄ-¸MÄ-kd°®àLiÎJëÂ·þJnÂÃbí Ó>,ÜV¶SP¯8´è>¶wïì\"E.îRz`Þu_ÀèôE\\ùÏÉ«Ð3Pç¬óÓ¥s]goVS±ñ\n ¤	*\r»¸7)ªÊümPWÝUÕßÕÇ°¨·Þf×ÜiÿÆkÐ\rÄ('W`ÞBdã/h*AÌlºMä_\nÀèüú½µëOªäT5Ú&AÀ2Ã©`¸à\\RÑE\"__½.7¥M6d;¶<?ÈÜ)(;¾û}K¸[«Åû»ÆZ?ÕyI ÷á1pªbu\0èé²²£{ó£Å\risÉQQ¦Y§2ª\r×0\0XØ\"@qÍuMböÓuJ6ÉNGÖþ^ÓÔwF/tõ°#P¾p÷Í!7Øý­å!Ã»é^VüM!(â©8ÖÍ=¥\0å¥@¿í80N¬Sà½¾°QÐ_TÏàÄ¥þqSz\"Õ&hã\0R.\0hZÓfx ÜF9¶Q(Ób³=ÄD&xs=Xbu@oÎwd5ñÇÝP1P>k¸HöD6/Ú¿íqë¼¾Î3¥7TÐ¬KÈ~54°	ñt#µM\rctxgçTæX\r2\$í<0øy}*ßÿCbiÆ^ó±ÄL7	bäoùÓÊx71 bXS`OÀàá­0)ù¨Ú\"®/=È¬ ¸lÊáQöpÍ-!ýà{ýõ±©ÖâaÃÈ9bAg¶2,1zf£kàÈjh/o(.4\rýàTz&nw¶Ä7 X!ðûª@,»<	ý`\"@:¼7ÃCX\\	 \$1H\n=Ä¡O5°&ºv*(	àtHÑ#É\nê_X/8k~+tO&<vÍ_Yh.ØMeHxpáI¨aù0ÕM\nhø`r'B¥ÃhÓn8qÑ!	åÖ eu»«]^TW­Öd9{û¾H,ã8ÅüL­a«,!\0;ÆîB#É#ÁÒ`ò)³¯	ÅaèEeòÚÜ/MèPÓ	lðÉa`	¥sâ²<(D\nöá¡À9{06Æ;A8¶¸5!	 ÍÀZ[Tâ© hV »Ü»Åé¯U@än`ÆVp¥h(Rb4ÆVôÆ¼¸ÒÈRp¢Ò\$ªÐÞD3O¡¾õÔ\$öÃÓaQ²¯0xbH` ®ÐâLÃ8i¾èoC½àúð#6xÊ)XHÐ!`÷íÀôÆÔBÖ%wÑÂÇo\nxÌh®ÁH»r¦ Ê¼cóÀmJHáLUðÜäÆe1l`ü(Õ\$\"¾hJÒrvØíÓTPÁÐØ·ó1uï¢HA\0èèH2@(Ê¡Uà\"©Q@qg]l\"¨%©ú*«\0Wj[ ·eÃ4êõÆPúÂNàê5\$H\r¼îIP'@:\0è\"#t^D­0Åèå«>(h· '¼F,sZJôèµAn¯#h ªX³.qYobÚ·Ò2¨Þ?j¼B÷Iôß£¥ÖÛôù0aû(ñ`ZñCÁà¯rHSQîÆ\\W	¼XZ÷Í|¹E@âÂTÔÅqð DD:_yÕ¯Ä°±©B~ßxP±--e_äu|2(³G,Æå-rR KxîÕ d¡ÃhHìA|ôw|PÁ!ÇÒä¬}ÜTùÇÖ<Ñù,1ÑÕvêg*Ù¤ïz¯^«÷¤ñ_pi {ØGÕíÝÿ	LaJJCT%N1ÒI:V@ZÔÁ%É*Ô|@NNxLLzd \$8b#Û!2=cÛ±QDí@½\0±Jàdzpû¯\$Aî|ya4)¤s%!ð¥BIQ]dG´6&E\$H\$Rj\0·ÜGi\$Ø¥â9ÅYúÐ@Ê´0ñ6Ä¦ºXÒÜ1&Lç&2Ì	E^äa8öj¦#¸DEu\$uTÌ*R¥#&P2e¥äK«'E%â¡YWáJô	©öO`Ê·^l+¦`¨	R¹1u&F¸¥Z[)]J¬ZÃEÑ`±¶FN.\r=ÀØ  ³\0´O~ÒÅM,«FATÌbhèz0`-bl\nñÇZ '*In°\$â[,8Dn«¨`°ÒóI0uÊ¼hf¬³¤àààAEy<!ÔÁxdAÀÊô1¬aÆUÀt\$½'p\"óÐjüP6XR)EÎTR°\0SÃ@-ÉT³Ô³.SÁwU\\¿\\(\rìõÑÂÀkÀ¸úg`j}\$Ï`aJsLÂÎéR3ÖTéX}æ£8%ýH@Z\0^UÙ­ |6A¸ÀRT/à¬ÙEÆ@Ä\0Ä¤LØÂîPµ¢ûºRÐ0\0-dI¬Ñæ¯+¨µ,WÀvàßÅô6N4\"mãNÂU9P6Î>r /	tåRvAp©Í4R3LX\0Ð¬S1LOú0<Í|S(+ìâJÅ9`1ÎbsS^Ðâ8³	æe3¶¨Xç9Q´æw*×ÀW2MZaGKÞÅ¹0ÕYè\r³Ä¦fêiêÌH(/ä[ ¼ñ\"Y§øWÃ7ZdµÃJÊ\"Æ\0Ä7DÓÒ¦LEÈ´½.xCvðÆÂã¾O«QÅ,_BÃ±Ö{ç3dÓz¯0ÒÔÌuILZcóøÐÆ\"J%ãÖR¤£ÙÊ¥aãgì^%zÆ5=S)²WZxÕûQZÊ@ &;àu.@ó&F(ä:F{ SÚÒ¡!ÐäM8¹È%B#iäC¼Ù*S\$ÏÀ@oøC§æ9ú¤TgÎsTXæâ\0èÜÓB)áPD´¨'CuÒc£Jp£ÔåiB`D'\0ÉHY*,XfTlziPøÁþÊ¢pÉÈ!H´#:ûÃHuÉP2è\0BHrí«Iâ¡àC	JrèÑÐ2	 Ào\nÅeHJuJÒâS\0æÏVr =!õ*Lv+YT\0002:ê²(¦¨hÓµÊÂV#ÌÄ§Me¡yV@[^øCþ¿¢9/ôÿ\0{§ÞÊçNDfÌ?éÄ\$Üi½J²*qM&V«¬íïhB^évcâSê¬Þ ±QÍ1â<\nvÓ2tåéÂö1¯Þþ¨8QA~S*Õ§ÃÿQzuS-¡	éð/bÃ©jûÆäò÷óÆDl¤)TÐ|é¤<Ã+É6<< Ð0L%h,ªÓZ.ÒWäI¤¤ãª¤d1ßHëdNª`3.'Kô¦þP«Ó>U?âI&¦¢PªÝ!µ[>ÕYÜ£gaÞD\$ )0IÆA2-:gk iÀÆFz§·jý\\ÈÆì\"\"~jùÓWXûÎÕPu¨ÄRèJY:nC|(EÍºð9dàLHÀÀ)­`X'¾¹>\0¢±¢º­ek¤nb=*f¡Bl&|SbÕB,Ñ0ayTØr=jªnzLè@GE'º­\nHPë@à<@gq~@ìp>\$é*@¢ò¬\"ÂGÐ>0^¿\"tK	IÄé¬Ò¾ucz¨õXàÒze\"¬àDü:Ë4~º#&«:ó\0¶1à'NgÕê-ð°@t¦)¨)üCªD­(JNWºHu®ui	Zz´,Òºk¾RTôÂeUvrvbÊÑ´§°¨në¤qºê;Ì>¢Ñ\nÙà®ï·\0r6C½n×aàøTÄÙq\0Nä¦Ü¨eI.ôzÅ}Ua&Ll#Ðm;!Ä¨ È\"~ø@Å]\nÌ\0vwåìõ:h]W6[«.D~\$!{Yí`b£àpZ¡Q¤1\rhp¸,LÍ©``K@\0Àb ->¾\0gX¢ÕMÄóSxí\\ÒòÏv»w2Íf8@ÄÕ\n.xà&,	äJ~ä*é.q	iaNÂ=³´ÒpôÖ¢r;ÀÈÛ7âÂEÊÀË\\Ó°À¦Ù.¶XôíFq[@âªr\rµSm/&rÛeí¶êÔánFÜdÿ®aØ-Ó:û2ÝmÀ·m¨Ä×+xÛDÖð_8'µ5¹D/P®Ð /MíÁñ·ÉKXÞy\nØëç)\nÝI±?vá	¬±ÉU¦!Ê(¡w-\$o(áöJ*ïµlÀ¸PiQ6§E\n¢-TV -Ç>çk;k¦­@ÔcÑÎª£jo8V5/¢¼#ªJ<òÝÚ4	ã=(ßLÐÀT H8tRªôôä_ÅÂ¥&CBë/àÇ.ì¦¤¼*1¡ÖaëHÍ¤ÓÚ¾Z8Æ´ ;%½_\0^îñ¬-xkwúºäWWÇ¦.µi\næò\nHhgëÈX^îâëL&çl@«N\nP£À>íÆÒJDô(65RµâÉ`ÕSXøµ]¯là«ÓÂ¤µ.íçßs6åñÝÖº¹PháPÆÊ°5%`Ð*¹.!ÀÔ¾«?XúÏ24XB\r;4Ù¬)6m4SS¨óY &j­;~ä÷ß*¢½Ðä9DÑÚ]à\\\0iÝíÌ\0¬EwrNzQÓÐþîI=®p{g[AÊ±¾,=áP³Î7\0?¼i)Ë\$¢ÖH?Â½à@eÔç]d 5Ö ïz¤J`À^ãª÷HÂn²q¬>àK(¦R}Õ\\#unÅ@H6«¸F©ñgçñVõ[I+Äþ0¸Ô \0-È¬¹ÿ\npÀhEÕsAøá´AÄü-|IüaDÂ=>Ô}|<Òúú)R/èU?ºPõ¨é	ÕÄBÁÐÜÜTØª3ÿ°çBü¡Ðø¶ñ7ëæ\0 ?¸dÃ5ã\0Y°¦·L	r=«ØÐø¢@¯¼ c¦°½BåbråhBÅHÐÞ\$ /ÝÅ¹NMÄ¾¯E`4¥ñKÏá{©²Lê¨ûJD&¼Ð:	aKo%ºGá-Óq}|h	¥ðàep`±]Ø,ÆÑ³Iö½]BÝÀg·ûð4xÔz\\bì\"¨Hn¹	iÛlÇi°uâæàw#Û±+|KYv è\"`÷ØC\\32\\ê\\\\CÇÂ1õmü#Ê/ãG=¬:¹	Ç4´ÇÓK§Hýê¸Ô\\*±±¢ctÚ#v-äÇZdÑoÃÖ52g­ÿ(Ã¶Êz¥2¢8âù?)LyÊnQ×R§ÜmMn]ñßÄhÅü&\$ãaÕÕ\n×r3]ðguµä\"ëà6»§*ð£@â1GÎËÊ½\\ËK\\,pwrÌ6Têç¤\\8¾b~Û	¯bFH^@|Âk_÷MJÌÒBåÌÏç4í%mn(Ð:H#¹«nhgTØ·6Aº.kÄ­Òbí¸ç``bwÒfÙ.¥³G][û£¨þí@[HPñ0:6© ]\\í§Md\r2Yr¶dî×,ìuØÒdÆIÇ¤}ÜóX\\qA=ìJ.Á©Â¿diÝ7ºUºnmå×ÄfDôYñÆ®HûR<9ú¥XÍóü'L½uVùÉB~ÀÙ¶l®MísÑ¥çJ¤·aÅ(\\öv8¶Íþq:.éð)½ ÿ³ïJRgí<Q§ÎáD\0\rH¸ÄÑ«Òs££æSGVgí9´}¡,üãHZ}§4hGõìaF\$þ´ë¨Â[¹nzlåÕ60¨ØLÔTÑgÿ4ùvgózÜ¿¯Á9_\\5Ò²Ú'78ìÀ¼·c{E#Ý6K¶6nsw bjj8ÊCõÇ§×8¶óF@G 0ÚBÞªÀ´CIêS]ða@.`¦Ë»QjÑ¯Ë\"\0õ=k)`rv¢Èðôµ|©G¹½ºÃÕf;p-ªòM*få%ÍáÄèÀÜBrÅBÀ¸Ra:Î4P¡5´VõS6>î_½ðyQ.Ñ½é'&\rMÃ-~BS×xGNBD%ÿþXqnxêSÉëÛÅ:¾c×\"'kÄ0®ÝZ¯Ô[^îÄ%ôÉ±\\Ïå»¼»²wõ´,_w7ÓHå»ê+¨:¦y=Õ	Ì.õS;¾Ü¨b³;\rÚò®Ñ?iý>UÑù¬>Ñà lSÏìñ|»5*kè%@Ú\né%7wõNWbbv¶ÔpÂþ½ª\$B÷ÚRA²%«ÌjÿY:Ëeòl¶Ñ¬}`G\$hì±ðÊäwE\nÿ	Õ(\"ËP\n§TöÞl]ëÏB|ÂË1:?ßÊ)úÒöÇÀ]>óúgj?H;FÕ-ôØZ6Qdxæµòµg±K°sºQé¸¡¹)æ×j¼ÂnWB¨sÝ^·G¢À>/Wl\$^À}¥\0vÁÇ5AðE\rJ§éy{¾0¨P4ÆÆ-3#³zaÆáTÉy^Ê\nQ9.Èá¼M¤}&¸Îù¤Ëj/2á¬9/\0ï«¤Ù\\Â>RzfË1öêÐø«	äÃ!Ç)éÝrÐÉ¯|\rÉIw·]»TÎÀ,Ëæñ÷e ÉÇw[ÑÐ±O]HçsÅûµAç(@¡ÕÖ¥16b­c¢YÚ¢µ¨­pÑó\0U6¾Èyp=]Ä³µº;Gï(xSÛÌHª¥1ÉË wb\0´{¥¨?Á`eY,?NøY5ÃZo¿ø\$ÎÌ\$ÜÕh'8Lf³F:¶¤k1)@Äï_µ Pûvpøé\$£o¸:fùe¸zÙu¿TÊZ@¼âÖÞ8¹ññìÜb\\¬Úþ4J1#SðÂ/wÇ­ñÍ#X_±AÇ¥Ùw8K:OÔþQáÇx=J4äE¼;òz­l©J®!Øñ.Õ7ûRåTñÒÌ®WN©¹Âe\$²_¼îCjß½äRQyRû¦ñaËç|»2Úx0ì>1«µjDLMÞR7\\lR§céüÕ\rÏiçÅwËÛÏR,ÒÀÛ;ÔÕs«QA!)º|ßØBpo\$]ÚSx:wP¡îEO%ôê·b_C\0Ôì°¬æÔëæ-³¹²8FâèöÐyjårr\\{_è¢Z.D²/¨LÃ8µëÐZ½ @Ip\0(×§³\$g(sw2C`áßAD/7t3Ìdçjux»(_\$\"KI99Ý½#õnå÷TÂs`Ø9¾ÅB]ë/v¾Vs!-3\$OS0^¡\\¼Çm¯Ý³9Í\n¡Ï¥8iå²wí}cî{F-]må³ê[3ó\$û§Ú^9 ¶8L6°Û£óV»Ë¼ò\n&Ù.hïÑ2]ÈE{V2ÎBAhXÓ?8:ºæëDàS5kZ\rYÄ@e\\Õù%°7?Ô`(¶¸ç ë@:¥ÕpvußqÔ~ãç¹©½ÊGfñÍh`Wq®ô^(ï-ÆÎ/«ëèÄÉêäoßq÷èj©®kH¢ûÍ&­eäþ\0ïáùûü`ÃÁa¨ù|¹}X^dûH¹ D×ª¯uå!G\\,q©4¦^xxFøo½4¸×<5Þù&Ð6tPA|k\r9 ®²¸A&£÷JU&!Ú	[´[hÊhn0¡·}vîw ,aóø{³>¨\0*\0O2%,¨áày³+b:aÀSLÜ×X©@n¢ý5>xC~ê\$Ò£0\\ï.J,W 4FÎ_c´<¨Ç­èaiÀÕ¿}y£¿Oo7¼>rÈ¨Å\"vas\"ü¨É-ÂyQYúB`-ôç\0ÚòúÆ©ÛÐàtÈsUêåS(~\n+¹àDÞÐÖ­QtÄ!óÖØ\0(­ûYTÈÔöCXz@À¨Ô¾ °¡Æy®QQ|EZ)8PSÚ_·Jt*;EÚ5·b~AfQ+3@®è>Ê3QïxçÞj÷¬7)Ì¯}Àã'» =\\´ºËý 1è]ÔHsl×Ìò@]à+´Ê¦ÿ½â¸S{O\"b¾×©ÀéðÇè oîÌºÚibß\0§áßÕçÉ¡Õð±?¼rï\"vjeÑêGCEïÃ~LÁTß&/Ê~V­ü¿.¯ÌÍò/¢×æçÒ~v¢x|ôß?Pèo>üÑÎüÁ¿]?Îy¡¯{2»;ø×2kããÞçø*ÂïÀ|^»+jZâÉÁ «Ý¾°ÃG÷¯~Çà_õÁ¥¿_Çüò|)¾÷ò02üì _åñáòàÿ£Òíí@Mmö4¨}\0ßBFxé ¼ß§	:Í_¨àÑõà þ³ë>¨=J-@Wô|ý»ø_CUîÏò¡C÷\"ü¿ò~ì\nuË.X\\Ï¬RÒz£äßÀþó¿XßÇý·é\\(MÙD|âªr#ìÿ/¨ªQêUÞ_åÔJwÖÿé÷B	þÅóÕOI=nxª0èlãÕ¡×ìÿ+Ôjüc-J1&X÷È[øt³¨aüÀo§*ÄÄ	])|Q5à@T d0ü8l/çÊ* ¦¥@V|®À¶îÉÖÎí»îè!ot°f£óéiîµLôÈp'ºÒb(7½ß&æ2êÁÍ¨î.èa<s¿/÷hxH=Vg)Ó	æ°\$h\0\$®ÆãÍ¡4ÆôâmNPÓäÐ¹émAõH%hmë´Êc\"Üéé\n·á#Ì´ÇcâN\rþ= áÛ5a¬	¨@ÓTÍ14Ó\"¢¢*\"YG&Î¤\nË¼¤Ln\r¼°÷qIo:¹aÇ\r\rÈMf D\0è\0²hÜ\r^?B\$à 8#aT` ßbèÍæ¾ØÄPPA¸8jEn¼/¡¾m\"!ðc3æôaÐeðúá_\0Ò§ë¼ûjvEìEt61Ôðs\0N~ù\" @îNÂOÁ0\"(¼0GÀæ%Ë`9áó?B²OaÓxd°CÆX\0§î=T\rì*aX!C A<Þ{rÄ*");}elseif($_GET["file"]=="jush.js"){header("Content-Type: text/javascript; charset=utf-8");echo
lzw_decompress("v0F£©ÌÐ==ÎFS	ÐÊ_6MÆ³èèr:ECI´Êo:CXc\ræØJ(:=E¦a28¡xð¸?Ä'i°SANNùðxsNBáÌVl0çS	ËUl(D|ÒçÊP¦À>Eã©¶yHchäÂ-3Ebå ¸b½ßpEÁpÿ9.Ì~\n?Kb±iw|È`Ç÷d.¼x8EN¦ã!Í23©á\rÑYÌèy6GFmY8o7\n\r³0¤÷\0DbcÓ!¾Q7Ð¨d8Áì~¬N)ùEÐ³`ôNsßð`ÆS)ÐOé·ç/º<xÆ9o»ÔåµÁì3n«®2»!r¼:;ã+Â9CÈ¨®Ã\n<ñ`Èó¯bè\\?`4\r#`È<¯BeãB#¤N Üã\r.D`¬«jê4ÿpéar°øã¢º÷>ò8Ó\$Éc ¾1Éc ¡c êÝê{n7ÀÃ¡AðNÊRLi\r1À¾ø!£(æjÂ´®+Âê62ÀXÊ8+Êâàä.\rÍÎôÎ!x¼åhù'ãâ6Sð\0RïÔôñOÒ\n¼1(W0ãÇ7që:NÃE:68n+äÕ´5_(®s \rãê/m6PÔ@ÃEQàÄ9\n¨V-Áó\"¦.:åJÏ8weÎq½|Ø³XÐ]µÝY XÁeåzWâü 7âûZ1íhQfÙãu£jÑ4Z{p\\AUËJ<õkáÁ@¼ÉÃà@}&L7U°wuYhÔ2¸È@ûu  Pà7ËAhèÌò°Þ3ÃêçXEÍZ]­lá@MplvÂ)æ ÁÁHWÔy>Y-øYè/«ªÁî hC [*ûFã­#~!Ð`ô\r#0PïCËf ·¶¡îÃ\\î¶É^Ã%B<\\½fÞ±ÅáÐÝã&/¦OðL\\jF¨jZ£1«\\:Æ´>N¹¯XaFÃAÀ³²ðÃØÍfh{\"s\n×64ÜøÒ¼?Ä8Ü^p\"ë°ñÈ¸\\Úe(¸PNµìq[g¸Árÿ&Â}PhÊà¡ÀWÙí*Þír_sËPhà¼àÐ\nÛËÃomõ¿¥ÃêÓ#§¡.Á\0@épdW ²\$Òº°QÛ½Tl0 ¾ÃHdHë)ÛÙÀ)PÓÜØHgàýUþªBèe\rt:Õ\0)\"Åtô,´ÛÇ[(DøO\nR8!Æ¬ÖðÜlAüV¨4 hà£Sq<à@}ÃëÊgK±]®àè]â=90°'åâøwA<ÐÑaÁ~òWæD|A´2ÓXÙU2àéyÅ=¡p)«\0P	sµn3îrf\0¢F·ºvÒÌG®ÁI@é%¤+Àö_I`¶ÌôÅ\r. N²ºËKI[ÊSJò©¾aUfSzû«M§ô%¬·\"Q|9¨Bc§aÁq\0©8#Ò<a³:z1Ufª·>îZ¹l¹ÓÀe5#U@iUGÂ©n¨%Ò°s¦Ë;gxL´pP?BçÊQ\\bÿé¾Q=7:¸¯Ý¡Qº\r:tì¥:y(Å ×\nÛd)¹ÐÒ\nÁX; ìêCaA¬\ráÝñP¨GHù!¡ ¢@È9\n\nAl~H úªV\nsªÉÕ«Æ¯ÕbBr£ªö­²ßû3\rP¿%¢Ñ\r}b/Î\$5§PëCä\"wÌB_çÉUÕgAtë¤ôå¤é^QÄåUÉÄÖjÁí Bvhì¡4)¹ã+ª)<j^<Lóà4U* õBg ëÐæè*nÊè-ÿÜõÓ	9O\$´Ø·zyM3\\9Üè.o¶Ìë¸E(iåàÄÓ7	tßé-&¢\nj!\rÀyyàD1gðÒö]«ÜyRÔ7\"ðæ§·~ÀíàÜ)TZ0E9MåYZtXe!Ýf@ç{È¬yl	8;¦R{ë8Ä®ÁeØ+ULñ'F²1ýøæ8PE5-	Ð_!Ô7ó [2JËÁ;HR²éÇ¹8pç²Ý@£0,Õ®psK0\r¿4¢\$sJ¾Ã4ÉDZ©ÕI¢'\$cLRMpY&ü½Íiçz3GÍzÒJ%ÁÌPÜ-[É/xç³T¾{p¶§zCÖvµ¥Ó:V'\\KJa¨ÃM&º°£Ó¾\"à²eo^Q+h^âÐiTð1ªORäl«,5[Ý\$¹·)¬ôjLÆU`£SË`Z^ð|r½=Ð÷nç»TU	1HykÇt+\0váD¿\r	<àÆìñjG­tÆ*3%kYÜ²T*Ý|\"CülhE§(È\rÃ8r×{Üñ0å²×þÙDÜ_.6Ð¸è;ãürBjO'Û¥¥Ï>\$¤Ô`^6Ì9#¸¨§æ4Xþ¥mh8:êûcþ0ø×;Ø/Ô·¿¹Ø;ä\\'( îtú'+òý¯Ì·°^]­±NÑv¹ç#Ç,ëvð×ÃOÏiÏ©>·Þ<SïA\\\\îµü!Ø3*tl`÷u\0p'è7Pà9·bs{Àv®{·ü7\"{ÛÆrîaÖ(¿^æ¼ÝE÷úÿë¹gÒÜ/¡øUÄ9g¶î÷/ÈÔ`Ä\nL\n)À(Aúað\" çØ	Á&PøÂ@O\nå¸«0(M&©FJ'Ú! 0<ïHëîÂçÆù¥*Ì|ìÆ*çOZím*n/bî/ö®Ô¹.ìâ©o\0ÎÊdnÎ)ùi:RÎëP2êmµ\0/vìOX÷ðøFÊ³Ïîè®\"ñ®êöî¸÷0õ0ö¬©í0bËÐgjðð\$ñné0}°	î@ø=MÆ0nîP/pæotì÷°¨ð.ÌÌ½g\0Ð)o\n0È÷\rF¶é b¾i¶Ão}\n°Ì¯	NQ°'ðxòFaÐJîÎôLõéðÐàÆ\rÀÍ\rÖö0Åñ'ð¬Éd	oepÝ°4DÐÜÊ¦q(~ÀÌ ê\rE°ÛprùQVFHl£Kj¦¿äN&­j!ÍH`_bh\r1 ºn!ÍÉ­z°¡ð¥Í\\«¬\ríÃ`V_kÚÃ\"\\×'V«\0Ê¾`ACúÀ±Ï¦VÆ`\r%¢ÂÅì¦\rñâk@NÀ°üBñí¯ ·!È\n\0Z6°\$d ,%à%laíH×\n#¢S\$!\$@¶Ý2±I\$r{!±°J2HàZM\\ÉÇhb,'||cj~gÐr`¼Ä¼º\$ºÄÂ+êA1ðEÇÀÙ <ÊL¨Ñ\$âY%-FDªdLç³ ª\n@bVfè¾;2_(ëôLÄÐ¿Â²<%@Ú,\"êdÄÀNerô\0æ`Ä¤Z¾4Å'ld9-ò#`äóÅà¶Öãj6ëÆ£ãv ¶àNÕÍf Ö@Ü&B\$å¶(ðZ&ßó278I à¿àP\rk\\§2`¶\rdLb@Eö2`P( B'ã¶º0²& ô{Â§:®ªdBå1ò^Ø*\r\0c<K|Ý5sZ¾`ºÀÀO3ê5=@å5ÀC>@ÂW*	=\0N<g¿6s67Sm7u?	{<&LÂ.3~DÄê\rÅ¯x¹í),rîinÅ/ åO\0o{0kÎ]3>m1\0I@Ô9T34+Ô@eGFMCÉ\rE3ËEtm!Û#1ÁD @H(Ón ÃÆ<g,V`R]@úÂÇÉ3Cr7s~ÅGIói@\0vÂÓ5\rVß'¬ ¤ Î£PÀÔ\râ\$<bÐ%(DdPWÄîÐÌbØfO æx\0è} Üâlb &vj4µLS¼¨Ö´Ô¶5&dsF Mó4ÌÓ\".HËM0ó1uL³\"ÂÂ/J`ò{Çþ§ÊxÇYu*\"U.I53Q­3Qô»Jg 5sàú&jÑÕuÙ­ÐªGQMTmGBtl-cù*±þ\r«Z7Ôõó*hs/RUV·ðôªBNË¸ÃóãêÔài¨Lk÷.©´Ätì é¾©rYiÕé-Sµ3Í\\TëOM^­G>ZQjÔ\"¤¬iÖMsSãS\$Ib	f²âÑuæ¦´å:êSB|i¢ YÂ¦à8	vÊ#éDª4`.Ë^óHÅM_Õ¼uÀUÊz`ZJ	eçºÝ@Ceíëa\"mób6Ô¯JRÂÖT?Ô£XMZÜÍÐÍòpèÒ¶ªQv¯jÿjV¶{¶¼ÅC\rµÕ7TÊª úí5{Pö¿]\rÓ?QàAAÀèÍ2ñ¾ V)Ji£Ü-N99fl JmÍò;u¨@<FþÑ ¾ejÒÄ¦I<+CW@ðçÀ¿ZlÑ1É<2ÅiFý7`KG~L&+NàYtWHé£w	ÖòlÒs'gÉãq+Lézbiz«ÆÊÅ¢Ð.ÐÇzW²Ç ùzdW¦Û÷¹(y)vÝE4,\0Ô\"d¢¤\$Bã{²!)1U5bp#Å}m=×È@wÄ	P\0ä\rì¢·`O|ëÆö	ÉüÅõûYôæJÕöE×ÙOu_§\n`F`È}MÂ.#1á¬fì*´Õ¡µ§  ¿zàucû³ xfÓ8kZR¯s2Ê-§Z2­+Ê·¯(åsUõcDòÑ·ÊìÝX!àÍuø&-vPÐØ±\0'LïX øLÃ¹o	Ýô>¸ÕÓ\r@ÙPõ\rxF×üEÌÈ­ï%Àãì®ü=5NÖ¸?7ùNËÃ©w`ØhX«98 Ìø¯q¬£zãÏd%6ÌtÍ/ä¬ëLúÍl¾Ê,ÜKaN~ÏÀÛìú,ÿ'íÇM\rf9£w!x÷x[ÏØG8;xAù-IÌ&5\$D\$ö¼³%ØxÑ¬ÁÈÂ´ÀÂ]¤õ&o-39ÖLù½zü§y6¹;u¹zZ èÑ8ÿ_Éx\0D?X7«y±OY.#38 ÇeQ¨=Ø*Gwm ³ÚYù ÀÚ]YOY¨F¨íÙ)z#\$e)/z?£z;Ù¬^ÛúFÒZg¤ù Ì÷¥§`^Úe¡­¦º#§Øñ©ú?¸e£M£Ú3uÌå0¹>Ê\"?ö@×Xv\"ç¹¬¦*Ô¢\r6v~ÃOV~&×¨^gü ÄÙ'Îf6:-Z~¹O6;zx²;&!Û+{9M³Ù³d¬ \r,9Öí°ä·WÂÆÝ­:ê\rúÙùã@ç+¢·]Ì-[gÛ[s¶[iÙiÈqyéxé+|7Í{7Ë|w³}¢£EûW°Wk¸|JØ¶åxm¸q xwyj»#³e¼ø(²©¸ÀßÃ¾ò³ {èßÚ y »M»¸´@«æÉ°Y(gÍ-ÿ©º©äí¡¡ØJ(¥ü@ó;yÂ#S¼µYÈp@Ï%èsúo9;°ê¿ôõ¤¹+¯Ú	¥;«ÁúZNÙ¯Âº§ k¼V§·u[ñ¼x|q¤ON?ÉÕ	`u¡6|­|X¹¤­Ø³|Oìx!ë:¨ÏY]¬¹c¬À\r¹hÍ9nÎÁ¬¬ëÏ8'ùêà Æ\rS.1¿¢USÈ¸¼XÉ+ËÉz]ÉµÊ¤?©ÊÀCË\r×Ë\\º­¹ø\$Ï`ùÌ)UÌ|Ë¤|Ñ¨x'ÕØÌäÊ<àÌeÎ|êÍ³çâÌéLïÏÝMÎy(Û§ÐlÐº¤O]{Ñ¾×FD®ÕÙ}¡yuÑÄß,XL\\ÆxÆÈ;U×ÉWtvÄ\\OxWJ9È×R5·WiMi[Kf(\0æ¾dÄÒè¿©´\rìMÄáÈÙ7¿;ÈÃÆóÒñçÓ6KÊ¦Iª\rÄÜÃxv\r²V3ÕÛßÉ±.ÌàRùÂþÉá|á¾^2^0ß¾\$ QÍä[ã¿D÷áÜ£å>1'^X~t1\"6Lþ+þ¾AàeáæÞåIç~åâ³â³@ßÕ­õpM>Óm<´ÒSKÊç-HÉÀ¼T76ÙSMfg¨=»ÅGPÊ°PÖ\r¸é>Íö¾¡¥2Sb\$C[Ø×ï(Ä)Þ%Q#G`uð°ÇGwp\rkÞKezhjÓzi(ôèrO«óÄÞÓþØT=·7³òî~ÿ4\"ef~ídôíVÿZ÷U-ëb'VµJ¹Z7ÛöÂ)T£8.<¿RMÿ\$ôÛØ'ßbyï\n5øÝõ_àwñÎ°íUð`eiÞ¿Jb©gðuSÍë?Íå`öáì+¾Ïï Mïgè7`ùïí\0¢_Ô-ûõ_÷?õF°\0õ¸Xå´[²¯J8&~D#Áö{PØô4Ü½ù\"\0ÌÀý§ý@Ò¥\0F ?* ^ñï¹å¯wëÐ:ð¾uàÏ3xKÍ^ów¼¨ß¯y[Ô(æµ#¦/zr_g·æ?¾\0?1wMR&M¿ù?¬StT]Ý´Gõ:I·à¢÷)©Bï vô§½1ç<ôtÈâ6½:W{Àôx:=ÈîÞóø:Â!!\0xÕ£÷q&áè0}z\"]ÄÞoz¥ÒjÃw×ßÊÚÁ6¸ÒJ¢PÛ[\\ }ûª`S\0à¤qHMë/7BP°ÂÄ]FTã8S5±/IÑ\r\n îO¯0aQ\n >Ã2­j;=Ú¬ÛdA=­p£VL)Xõ\nÂ¦`e\$TÆ¦QJÍó®ælJïÔîÑyIÞ	ä:ÑÄÄBùbPÀûZÍ¸n«ª°ÕU;>_Ñ\n	¾õëÐÌ`ÔuMòÂÖm³ÕóÂLwúB\0\\b8¢MÜ[z&©1ý\0ô	¡\rTÖ× +\\»3ÀPlb4-)%Wd#\nÈårÞåMX\"Ï¡ä(Ei11(b`@fÒ´­SÒójåDbf£}rï¾ýDR1´bÓAÛïIy\"µWvàÁgC¸IÄJ8z\"P\\i¥\\m~ZR¹¢vî1ZB5IÃi@x·°-uM\njKÕU°h\$oJÏ¤!ÈL\"#p7\0´ P\0D÷\$	 GK4eÔÐ\$\nGä?ù3£EAJF4àIp\0«×F4±²<f@ %q¸<kãw	àLOp\0xÓÇ(	G>ð@¡ØçÆÆ9\0TÀìGB7 - øâG:<Q #Ã¨ÓÇ´û1Ï&tz£á0*J=à'J>ØßÇ8q¡Ð¥ªà	OÀ¢XôF´àQ,ÀÊÐ\"9®pä*ð66A'ý,yIFR³TÏý\"÷HÀR!´j#kyFÀàe¬z£ëéÈðG\0p£aJ`C÷iù@T÷|\nIx£K\"­´*¨Tk\$c³òÆaAh! \"úE\0OdÄSxò\0T	ö\0à!FÜ\nU|#S&		IvL\"ä\$hÐÈÞEAïN\$%%ù/\nP1²{¤ï) <ð L å-R1¤â6¶<@O*\0J@q¹Ôª#É@Çµ0\$t|]ã`»¡ÄA]èÍìPáCÀp\\pÒ¤\0ÒÅ7°ÄÖ@9©bmr¶oÛC+Ù]¥JrÔfü¶\rì)d¤Ñ­^hßI\\Î. gÊ>¥Í×8ÞÀ'HÀfrJÒ[rçoã¥¯.¹v½ï##yR·+©yËÖ^òùF\0á±]!ÉÒÞ++Ù_Ë,©\0<@M-¤2WòâÙR,ce2Ä*@\0êP Âc°a0Ç\\PÁO ø`I_2Qs\$´w£¿=:Îz\0)Ì`ÌhÂÁç¢\nJ@@Ê«\0ø 6qT¯å4J%N-ºm¤Äåã.É%*cnäËNç6\"\rÍ¸òèûfÒAµÁpõMÛI7\0MÈ>lO4ÅS	7cÍì\"ìß§\0å6îpsÄÝåy.´ã	ò¦ñRKðPAo1FÂtIÄb*ÉÁ<©ý@¾7ÐËp,ï0NÅ÷: ¨N²m ,xO%è!Úv³¨ gz(ÐM´óÀIÃà	à~yËöh\0U:éØOZyA8<2§²ð¸ÊusÞ~lòÆÎEðO0±0]'>¡ÝÉ:ÜêÅ;°/ÂwÒôäì'~3GÎ~Ó­äþ§c.	þòvT\0cØt'Ó;P²\$À\$øÐ-s³òe|º!@dÐObwÓæc¢õ'Ó@`P\"xôµèÀ0O5´/|ãU{:b©R\"û0ÑkÐâ`BD\nkPãc©á4ä^ p6S`Ü\$ëf;Î7µ?lsÅÀßgDÊ'4Xja	AE%	86b¡:qr\r±]C8ÊcÀF\n'Ñf_9Ã%(¦*~ãiSèÛÉ@(85 TË[þJÚ4Il=°QÜ\$dÀ®hä@D	-Ù!ü_]ÉÚHÆk6:·Úò\\M-ÌØðò£\rFJ>\n.qeGú5QZ´' É¢½Û0îzPà#Å¤øöÖéràÒít½ÒÏËþ<QT¸£3D\\¹ÄÓpOE¦%)77Wt[ºô@¼\$F)½5qG0«-ÑW´v¢`è°*)RrÕ¨=9qE*K\$g	íA!åPjBT:Kû§!×÷H R0?6¤yA)B@:Q8B+J5U]`Ò¬:£ðå*%Ip9Ìÿ`KcQúQ.B±LtbªyJñEêTé¥õ7ÎöAmÓä¢Ku:ðSji 5.q%LiFºTr¦Ài©ÕKÒ¨z55T%UUÚIÕ¦µÕY\"\nSÕmÑÄx¨½Ch÷NZ¶UZÄ( Bêô\$YËV²ãu@è»¯¢ª|	\$\0ÿ\0 oZw2Òx2ûk\$Á*I6IÒn ¡I,ÆQU4ü\n¢).øQôÖaIá]À èLâh\"øf¢Ó>:Z¥>L¡`nØ¶Õì7VLZue¨ëXúèºB¿¬¥Bº¡Z`;®øJ]òÑäS8¼«f \nÚ¶#\$ùjM(¹Þ¡¬a­Gí§Ì+Aý!èxL/\0)	Cö\nñW@é4ºáÛ© ÔRZ®â =Çî8`²8~âhÀìP °\r	°ìD-FyX°+Êf°QSj+Xó|È9-øs¬xØüê+VÉcbpì¿o6HÐq °³ªÈ@.l 8g½YMÖWMPÀªU¡·YLß3PaèH2Ð9©:¶a²`¬Æd\0à&ê²YìÞY0Ù¡¶S-%;/TÝBS³PÔ%fØÚý @ßFí¬(´Ö*Ñq +[Z:ÒQY\0Þ´ëJUYÖ/ý¦pkzÈò,´ðªjÚê¥W°×´e©JµFèýVBIµ\r£ÆpFNÙÖ¶*Õ¨Í3kÚ0§D{Ôø`qÒ²Bqµe¥DcÚÚÔVÃE©¬nñ×äFG E>jîèÐú0g´a|¡Shì7uÂÝ\$ì;aô7&¡ë°R[WXÊØ(qÖ#¬P¹Æä×Ýc8!°H¸àØVX§Ä­jøÊZô¡¥°Q,DUaQ±X0ÕÕ¨ÀÝËGbÁÜlBt9-oZüL÷£¥Â­åpËx6&¯¯MyÔÏsÒ¿èð\"ÕÍèRIWU`c÷°à}l<|Â~Äw\"·ðvI%r+Rà¶\n\\ØùÃÑ][Ñ6&Á¸ÝÈ­ÃaÓºìÅj¹(ÚðTÑÀ·C'´ '%de,È\nFCÅÑe9C¹NäÐ-6UeÈµýCX¶ÐV±¹ýÜ+ÔR+ºØË3BÜÚJð¢è±æT2 ]ì\0PèaÇt29Ï×(i#aÆ®1\"S:ö· ÖoF)kÙfôòÄÐª\0ÎÓ¿þÕ,ËÕwêJ@ìÖVòµéq.e}KmZúÛïå¹XnZ{G-»÷ÕZQº¯Ç}Å×¶û6É¸ðµÄ_ØÕà\nÖ@7ß` ÕïC\0]_ ©Êµù¬«ï»}ûGÁWW: fCYk+éÚbÛ¶·¦µ2S,	ÚÞ9\0ï¯+þWÄZ!¯eþ°2ûôàí²k.OcÖ(vÌ®8DeG`ÛÂöL±õ,dË\"CÊÈÖB-Ä°(þp÷íÓp±=àÙü¶!ýkØÒÄ¼ï}(ýÑÊBkr_RîÜ¼08a%ÛL	\0éÀñb¥²ñÅþ@×\"ÑÏr,µ0TÛrV>ÚÈQÐ\"rÞ÷P&3báP²æ- xÒ±uW~\"ÿ*èNâh%7²µþK¡Y^A÷®úÊCèþ»p£áî\0ð..`cÅæ+ÏâGJ£¤¸H¿À®E¤¾l@|I#AcâÿD|+<[c2Ü+*WS<ràãg¸ÛÅ}>iÝ!`f8ñ(c¦èÉQý=fñ\nç2Ñc£h4+q8\na·RãBÜ|°R×ê¿Ýmµ\\qÚõgXÀ Ï0äXä«`nîFîìO pÈîHòCjd¡fµßEuDVbJÉ¦¿å:±ï\\¤!mÉ±?,TIaØaT.L],J??ÏFMct!aÙ§RêFGð!¹Aõ»rr-pX·\r»òC^À7áð&ãRé\0ÎÑf²*àA\nõÕHáã¤yîY=Çúèl<¹AÄ_¹è	+ÎtAú\0B<Ay(fy1Îc§O;pèÅá¦`ç4Ð¡Mìà*îfê 5fvy {?©àË:yøÑ^câÍu'8\0±¼Ó±?«gÓ 8BÎ&p9ÖO\"zÇõrs0ºæB!uÍ3f{×\0£:Á\n@\0ÜÀ£pÙÆ6þv.;àú©Êb«Æ«:J>Ëé-ÃBÏhkR`-ÜñÎðawæxEj©÷Ár8¸\0\\Áïô\\¸Uhm ý(mÕH3Ì´í§SÁæq\0ùNVh³Hy	»5ãMÍe\\g½\nçIP:Sj¦Û¡Ù¶è<¯Ñxó&LÚ¿;nfÍ¶cóq¦\$fð&lïÍþi³àç0%yÎ¾tì/¹÷gUÌ³¬dï\0e:ÃÌhïZ	Ð^@ç ý1Ïm#ÑNów@ßOððzGÎ\$ò¨¦m6é6}ÙÒÒX'¥I×i\\QºY¸4k-.è:yzÑÈÝH¿¦]ææxåGÏÖ3ü¿M\0£@z7¢³6¦-DO34Þ\0ÎÄùÎ°t\"Î\"vC\"JfÏRÊÔúku3MÎæ~ú¤Ó5V àj/3úÓ@gG}Dé¾ºBÓNq´Ù=]\$é¿IõÓ3¨x=_jXÙ¨fk(C]^jÙMÁÍF«ÕÕ¡àÏ£CzÈÒVÁ=]&\r´A<	æµÂÀÜãç6ÙÔ®¶×´Ý`jk7:gÍî4Õ®áëYZqÖftu|hÈZÒÒ6µ­iã°0 ?éõéª­{-7_:°×ÞtÑ¯íck`YÍØ&´éIõlP`:íô j­{hì=Ðf	àÃ[by¢ÊoÐB°RS¼B6°À^@'4æø1UÛDq}ìÃNÚ(Xô6j}¬cà{@8ãòð,À	ÏPFCàðBà\$mv¨Pæ\"ºÛLöÕCS³]ÝàEÙÞÏlUÑfíwh{o(ä)è\0@*a1GÄ ( D4-cØóP8£N|RâVM¸°×n8G`e}!}¥Çp»Üòý@_¸ÍÑnCtÂ9Ñ\0]»u±î¯s»Ý~èr§»#Cn p;·%>wu¸ÞnÃwû¤Ýê.âà[ÇÝhT÷{¸Ýå¼	ç¨Ë·JðÔÆiJÊ6æO¾=¡ûæßE÷Ù´ImÛïÚV'É¿@â&{ªòö¯µ;íop;^Ø6Å¶@2ç¯lûÔÞNï·ºMÉ¿r_Ü°ËÃ´` ì( yß6ç7¹ýëîÇ7/Ápðe>|ßà	ø=½]Ðocûá&åxNm£ç»¬ào·GÃN	p»x¨Ã½Ýðy\\3àøÂ'ÖI`râG÷]Ä¾ñ7\\7Ú49¡]Å^p{<Zá·¸q4uÎ|ÕÛQÛàõpýi\$¶@oxñ_<Àæ9pBU\"\0005 iä×»¸Cûp´\nôi@[ãÆ4¼jÐ6bæP\0&F2~Àù£¼ïU&}¾½¿É	ÌDa<æzx¶k£=ùñ°r3éË(l_FeF4ä1K	\\Óldî	ä1H\r½ùp!%bGæXfÌÀ'\0ÈØ	'6Àps_á\$?0\0~p(H\n1W:9ÕÍ¢¯`æ:hÇBègBk©ÆpÄÆót¼ìEBI@<ò%Ã¸Àù` êyd\\Y@DP?|+!áWÀø.:Lev,Ð>qóAÈçº:îbYé@8d>r/)ÂBç4ÀÐÎ(·`|é¸:t±!«Á¨?<¯@ø«/¥ S¯P\0Âà>\\æâ |é3ï:VÑuw¥ëçx°(®²4ÇZjD^´¥¦Lý'¼ìÄC[×'ú°§®éjÂº[ E¸ó uã°{KZ[s6S1Ìz%1õc£B4B\n3M`0§;çòÌÂ3Ð.&?¡ê!YAÀI,)ðålW['ÆÊIÂTjè>F©¼÷S§ BÐ±Pá»caþÇuï¢NÝÏÀøHÔ	LSôî0ÕY`ÂÆÈ\"il\rçB²ëã/ôãø%PÏÝNGô0JÆX\n?aë!Ï3@MæF&Ã³Öþ¿,°\"îèlbô:KJ\rï`k_êb÷üAáÙÄ¯Ìü1ÑI,ÅÝîü;B,×:ó¾ìY%¼J #v'{ßÑÀã	wx:\ni°¶³}cÀ°eN®Ñï`!wÆ\0ÄBRU#ØSý!à<`&v¬<¾&íqOÒ+Î£¥sfL9QÒBÊÉóäbÓà_+ï«*Su>%0©8@l±?L1po.ÄC&½íÉ BÀÊqh¦ó­Áz\0±`1á_9ð\"è!\$ø¶~~-±.¼*3r?øÃ²Àds\0ÌõÈ>z\nÈ\00 1Ä~ôJð³ðú|SÞô k7gé\0úKÔ d¶ÙaÉîPgº%ãwDôêzmÒûÈõ·)¿ñjÛ×Âÿ`k»ÒQà^ÃÎ1üº+Îå>/wbüGwOkÃÞÓ_Ù'¬-CJ¸å7&¨¢ºðEñ\0L\r>!ÏqÌîÒ7ÝÁ­õo`9O`àö+!}÷P~EåNÈcöQ)ìá#ûï#åòìÌÑøÀ¡¯èJñÄz_u{³ÛK%\0=óáOX«ß¶Cù>\n²|wá?ÆFÅêÕaÏ©UÙåÖb	N¥YïÉh½»é/úû)ÞGÎ2ü¢K|ã±y/\0éä¿Z{éßP÷YG¤;õ?Z}T!Þ0Õ=mN¯«úÃfØ\"%4aö\"!Þúºµ\0çõï©}»î[òçÜ¾³ëbU}»ÚmõÖ2± ö/tþî%#.ÑØÄÿseBÿp&}[ËÇ7ã<aùKýïñ8æúP\0ó¡g¼ò?ù,Ö\0ßßr, >¿ýWÓþïù/Öþ[qýk~®CÓ4ÛûG¯:X÷Gúr\0Ééâ¯÷L%VFLUc¯Þä¢þHÿybPÚ'#ÿ×	\0Ð¿ýÏì¹`9Ø9¿~ïò_¼¬0qä5K-ÙE0àbôÏ­ü¡t`lmêíËÿbàÆ; ,= 'S.bÊçS¾øCcêëÊAR,íÆX@à'8Z0&ìXnc<<È£ð3\0(ü+*À3·@&\r¸+Ð@h, öò\$O¸\0Åèt+>¬¢bªÊ°\r£><]#õ%;Nìsó®Å¢Êð*»ïcû0-@®ªLì >½Yp#Ð-f0îÃÊ±aª,>»Ü`ÆÅàPà:9o·ð°ov¹R)e\0Ú¢\\²°Áµ\nr{Ã®XÒøÎ:A*ÛÇ.Dõº7»¼ò#,ûN¸\rEÔ÷hQK2»Ý©¥½zÀ>P@°°¦	T<ÒÊ=¡:òÀ°XÁGJ<°GAfõ&×A^pã`©ÀÐ{ûÔ0`¼:ûð);U !Ðe\0î£½Ïcp\r³ ¾:(ø@%2	S¯\$Y«Ý3é¯hCÖì:O#ÏÁLóï/éç¬k,¯Kåoo7¥BD0{¡jó ìj&X2Ú«{¯}RÏx¤ÂvÁä÷Ø£À9Aë¸¶¾0;0õáà-5/<Üç° ¾NÜ8E¯Ç	+ãÐÂPd¡;ªÃÀ*n¼&²8/jX°\r>	PÏW>KàO¢VÄ/¬U\n<°¥\0Ù\nIk@ºã¦[àÈÏ¦Â²#?Ùã%ñèË.\0001\0ø¡kè`1T· ©¾ëÉl¼À£îÅp®¢°Á¤³¬³< .£>íØ5Ð\0ä»	O¬>k@Bn¾<\"i%>ºzÄçñáºÇ3ÙP!ð\rÀ\"¬ã¬\r >adàöó¢U?ÚÇ3P×Áj3£ä°>;Óä¡¿>t6Ë2ä[ÂðÞ¾M\r >°º\0äìP®·Bè«Oe*Rn¬§y;« 8\0ÈËÕoæ½0ýÓøiÂøþ3Ê2@Êýà£î¯?xô[÷ÛÃLÿa¯w\ns÷A²¿x\r[Ñaª6Âclc=¶Ê¼X0§z/>+ªøW[´o2Âø)eî2þHQPéDYzG4#YDöºp)	ºHúp&â4*@/:	áT	­¦aH5ëh.A>ï`;.­îYÁa	Âòút/ =3°BnhD?(\n!ÄBús\0ØÌDÑ&DJ)\0jÅQÄyhDh(ôK/!Ð>®h,=Ûõ±ãtJ+¡Sõ±,\"M¸Ä¿´NÑ1¿[;øÐ¢¼+õ±#<ìI¤ZÄP)ÄáLJñDéìP1\$Äîõ¼Q>dO¼vé#/mh8881N:øZ0ZÁèT BóCÇq3%°¤@¡\0Øï\"ñXD	à3\0!\\ì8#h¼vìibÏT!dªÎüV\\2óÀSëÅÅ\nA+Í½pxÈiD(ìº(à<*öÚ+ÅÕE·ÌT®¾ BèS·CÈ¿T´æÙÄ eAï\"á|©u¼v8ÄT\0002@8D^ooø÷|Nùô¥ÊJ8[¬Ï3ÄÂõîJz×³WL\0¶\0È8×:y,Ï6&@À E£Ê¯Ýh;¼!f¼.Bþ;:ÃÊÎ[Z3¥Â«ðn»ìëÈ­éA¨ÓqP4,óºXc8^»Ä`×ôl.®üº¢S±hÞ°O+ª%P#Î¡\n?ÛÜIB½ÊeËO\\]ÎÂ6ö#û¦Û½Ø(!c) Nõ¸ºÑ?EØB##D íDdo½åPAª\0:ÜnÂÆ`  ÚèQ³>!\r6¨\0V%cbHF×)¤m&\0B¨2Ií5Ù#]úØD>¬ì3<\n:MLðÉ9CñÊ0ãë\0¨(á©H\nþ¦ºM\"GR\n@éø`[Ãó\ni*\0ð)üìu©)¤«Hp\0N	À\"®N:9qÛ.\r!´JÖÔ{,Û'æÙ4BúÇlqÅ¨Xc«Â4ßN1É¨5«WmÇ3\nÁF`­'Òxà&>z>N¬\$4?óÃïÂ(\nì¨>à	ëÏµPÔ!CqÍ¼p­qGLqqöG²yÍH.«^à\0zÕ\$AT9FsÐ¢D{ía§øcc_GÈz)ó³ Ü}QÆÅhóÌHBÖ¸<y!L­Û!\\²î ø'H(ä-µ\"in]Ä³­\\¨!Ú`MH,gÈí»*ÒKfë*\0ò>Â6¶à6ÈÖ2óhJæ7Ù{nqÂ8àßôÉHÕ#cHã#\r:¶7Ê8àÜZ²ZrD£þß²`rG\0äl\n®Ii\0<±äãô\0Lg~¨ÃE¬Û\$¹ÒP\$@ÒPÆ¼T03ÉHGH±lÉQ%*\"N?ë%	Î\nñCrWÉC\$¬pñ%uR`ÀË%³òR\$<`ÖIfxª¯÷\$/\$¥\$O(Ë\0æË\0RY*Ù/	ê\rÜC9ï&hhá=IÓ'\$RRIÇ'\\a=EÔòuÂ·'ÌwIå'Tüÿ©¾ãK9%d¢´·!üÀÊÊÀÒjì¡íÓÊ&ÐævÌ²\\=<,Eù`ÛYÁò\\²¤*b0>²r®à,dpdÌ0DD Ì`â,T ­1Ý% P¤/ø\ròb¹(£õJÑèÍîT0ò``Æ¾ÞèíóJt©©Ê((dÇÊªáh+ <É+H%iÈô²#´`­ ÚÊÑ'ô£B>t¯JZ\\`<Jç+hR·ÊÔ8îàhR±,J]gò¨Iäè0\n%J¹*ÐY²¯£JwD°&ÊD±®ÉÐªR§K\"ß1Qò¨Ë ²AJKC,ä´mV»²ÊÙ-±òÏKI*±r¨\0ÇL³\"ÆKb(üªóJ:qKr·dùÊ-)ÁË#Ô¸²Þ¸[ºA»@.[Ò¨Ê¼ß4º¡¯.1ò®J½.Ì®¦u#JÁg\0Æãò§£<Ë&ðK¤+½	M?Í/d£Ê%'/¿2YÈä>­\$Í¬lº\0©+øÁ}-tºÍ*êRä\$ßòÌK».´Á­óJHûÊ2\r¿B½(PÍÓÌ6\"ünf\0#Ð ®Í%\$ÄÊ[\nÐnoLJ°ÅÓÂe'<¯ó1KíÁyÌY1¤Çs¥0À&zLf#üÆ³/%y-²Ë£3-ÂÍK£L¶ÎÉ×0³ë¸[,¤ËÌµ,±«§0±Ó(.DÀ¡@ÏÁ2ïL+.|£÷¤É2è(³L¥*´¹S:\0Ù3´ÌíóG3lÌÁaËl³@L³3z4­Ç½%ÌÍLÝ3»³¼!033=Lù4|È¡à+\"°Êé4´Ëå7Ë,\$¬SPM\\±Î?JYÌ¡¹½+(Âa=K¨ì4¤³CÌ¤<Ð=\$,»³UJ]5h³W &tÖI%é5¬Ò³\\M38g¢Í5HN?W1H±^ÊÙÔ¸YÍØ Í.N3M4Ã³`i/P7ÖdM>d¯/LRÎÜâ=K60>¯I\0[ðõ\0ßÍ\r2ôÔòZ@Ï1Û2ÿ°7È9äFG+ä¯ÒÅ\r)àhQtL}8\$ÊBeC#Ár*HÈÛ«-Hý/ØËÒ6Èß\$øRC9ÂØ¨!Å7ük/PË0Xr5¡3D¼<TÁÔq¯Kô©³nÎH§<µFÿ:1SLÎrÀ%(ÿu)¸Xr1ÑnJÃIÌ´S£\$\$é.Î9Ôé²IÎÒ3 ¨LÃl¯Î9äÅCN #Ô¡ó\$µ/ÔésÉ9«@6Êt²®Nñ9¼´·NÉ:¹Â¡7ó Ó¬Í:DáÓÁM)<#ÓÃM}+ñ2ÎNþñ²O&ð¢JNy*òòÙ¸[;ñóÎO\"mÚÄóÅMõ<c Â´°±8¬K²,´ÓÇN£=07s×JE=Tá³ÆO<Ôô³£Jé=DÓ:ÏC<ÌàË=äèó®KÊ»Ì³ÈL3¬÷­LTÐ3ÊS,.¨ÿÏq-ñsç7Í>?ó¼7O;Ü `ùOA9´óñÏ»\$üÁOÑ;ìý`9ÎnÇIAxpÜöE=O¹<ü²5ÏÎý2¸O?d´´`NòiOÿ>þ3½P	?¤òÔOmúSðMôË¬·=¹(ãdã¤AÈ­9\0í#üä²@­9DÁÉ&Üýò? Ði9»\nà/ñAÝóòÈ­A¤ýSËPo?kuN5¨~4ÜãÆ6Ø=ò*@(®N\0\\ÛdGåüp#è¤> 0À«\$24z )À`ÂWð +\080£è¦ ¤ªäz\"TÐä0Ô:\0\ne \$rM=¡r\n²NP÷Cmt80ðú #¤ØJ= &ÐÆ3\0*Bú6\"éèú#Ì>	 (Q\nðê´8Ñ1C\rt2EC\n`(Çx?j8N¹\0¨È[À¤QN>£©à'\0¬x	cêªð\nÉ3×Chü`&\0²Ð´8Ñ\0ø\näµ¦úO`/¢A`#ÐìXcèÐÏD ÿtR\n>¼ÔdÑBòD´LÐÄÌõäÐÍDt4ÐÖ jpµGAoQoG8,-sÑÖðÔK#);§E5´TQÑGÐ4Ao\0 >ðtMÓD8yRG@'PõC°	ô<PõCå\"K\0xüÔ~\0ªei9Ðìv))ÑµGb6±H\r48Ñ@M:³FØtQÒ!H{R} ôURpÍÔO\0¥It8¤ØðûÎÇ[D4FÑD#ÊÑ+D½'ôMÊÀ>RgIÕ´QïJ¨UÒ)EmàüTZ­Eµ'ãê£iEÝ´£ÒqFzAªº>ý)TQ3HÅ#TLÒqIjNT½¼&CøÒhX\nTÑÙK\0000´5¢JHÑ\0FE@'ÑFp´hS5F\"ÎoÑ®e%aoS E)  DU «QFmÎÑ£M´ÑÑ²e(tnÒ U1Ü£~>\$ñßÇ­(hÕÇGüy`«\0ê 	íGò3Ô5Sp(ýõPãGí\$#¤¨	©©N¨\nôV\$ö]ÔPÖ=\"RÓ¨?Lzt·1L\$\0ÔøG~å ,KNý=ëÒGMÅ¤NS)ÑáO]:ÔS}Ý81àRGe@Cí\0«OPðSõNÍ1ôÝT!P@ÑÝSðÿÕSG`\nÉ:P°j7R @3üÑ\n üã÷â£DÓ æúLÈÏ¼ 	èë\0ùQ5ôµ©CPúµSMP´v4º?h	hëTD0úÑÖàõ>&ÒITxôO¼?@U¤÷R8@%ÔõK§NåKãóRyE­E#ýù @ýÃøä%Là«Q«Q¨µ£ª?N5\0¥R\0úÔTëFåÔRSí!oTEÂC(Ï¶ÈýÄµ\0?3iîSS@U÷QeMµ	KØ\n4PÕCeS\0NC«P­Oõ! \"RTûõS¥NÕÁU5OU>UiIÕPU#UnKPô£UYTè*ÕC«U¥/\0+º¸Å)ÈÚ:ReAà\$\0ø¤xòÇWDº3Ãêà`üÚüçU5ÒIHUYô:°P	õe\0MJiµÃýQø>õ@«T±C{ÕuÑì?Õ^µv\0WR]U}Cöê1-5+Uä?í\rõW<¸?5JU-SXüÕLÔß \\tÕ?ÒsMÕbÕVÜt§T>ÂMU+Ö	EÅcÏÔ9Nm\rRÇCý8SÇX'RÒéXjCI#G|¥!QÙGhtðQ¸ý )<¹YÐ*ÔÐRmX0üôö½M£õOQßYýhÀ«ßduÕ¤ÕZ(ýAo#¥NlyN¬VZ9IÕºM¦V«ZuOÕTÕTÅEÕÖ·SÍeµµÖÊ\nµXµªSÛQERµ³ÔÙ[MF±VçO=/õ­¨>õgÕ¹TíVoUT³ZN*T\\*ÃïÐ×S-pµSÕÃVÕqÒM(ÏQ=\\-UUUV­CÄ×ZØ\nuV\$?M@UÎWJ\r\rUÐÔ\\å'U×W]W£W8ºN '#h=oCóÐýF(üé:9ÕYu¤÷V-UÓ9]ÒC©:U¿\\\nµqWà(TT?5Páª\$ R3ÕâºC}`>\0®E]#Rêà	ÿ#R¥)²W:`#óGõ)4RÀý;õáViD%8À)Ç^¥Qõé#h	´HÂX	þ\$Nýx´#i xûÔXRõ'Ô9`m\\©¨\nEÀ¦Q±`¥bu@×ñN¥dT×#YYýµ®GV]j5#?L¤xt/#¬å#é½O­PÕëQæ¢6££Ï^í ðüÖØM\\R5t´Ópà*XV\"WÅD	oRALm\rdGN	ÕÖÀú6p\$PåºE5Ôý©Tx\n+C[¨ôVýÖ8UDu}Ø»F\$.ªËQ-;4È±NX\n.XñbÍ\0¯b¥)#­NýG4KØÐZS^×´M¶8Øód­\"C¬>ÅÕdHe\nöY8¥Ñ.ê ú°ÒFúD½W1cZ6QâKHü@*\0¿^¸úÖ\\QßF4U3Y|=Ó¤éEÔÛ¤¦?-47YPmhYw_\rVe×±M±ßÙe(0¶ÔFÕ\r !ÒPUIuÑ7QåCèÑ?0ÿµÝgu\rqà¤§Y-Qèó°èú=g\0\0M#÷U×S5Zt®Öae^\$>²ArV¯_\r;tî¬¨HW©Zí@HÕØhzDèÚ\0«S2Jµ HIåO 'ÇeígÉ6¹[µR<¸?È /ÒKM¤öØ\n>½¤HáZ!iö¤TX6Ò×iºC !Óg½à ÒG }Q6Ñ4>äwà!ÚC}§VBÖ>åªUQÚjª8cïUTàû'<>ÈýõôHC]¨VÑ7jj3v¥¤å`0ÃèÈ23ö°Ðòxû@Uk \n:Si5Õ#Yì-wîÕàéM?céÒMQÅGQÕÑb`ò\0@õËÒ§\0M¥à)ZrKXûÖÙWl­²öÍlå³TM×D\r4QsS¥40ÑsQÌõmYãhd¶ÂC`{VgEÈ\n»XkÕà'Óè,4ú¼¹^í¢6Æ#<4éNXnM):¹·OM_6dæõ¸Ãõ[\"KU²nÖ?l´x\0&\0¿R56T~> ôÕ¸?Jn ÏZ/iÒ6ôÎÚglÍ¦ÖUÛáF}´.£¼JLöCTbM4ÍÓcLõTjSD}JtZªµÇ:±L­´d:EzÊ¤ª>ÖV\$2>­µ¢[ãpâ6öÔR9uêW.?1®£RHuèÛR¸?58Ô®¤íDÝÆu£çpûcìZà?r×» Eaf°}5wY´ëåÏÒêÅWwT[Sp7'Ô_aEk \"[/i¥¿#ÿ\$;mfØ£WOüôÔFò\r%\$Íju-t#<Å!·\n:«KEA£íÒÑ]À\nUæQ­KEÀ #¿Xå¨÷5[Ê>`/£ÍDµÊÖ­VEpà)åI%ÏqßÜûníx):¤§le¢´Õ[eÕ\\eV[j£éÑ7 -+ÖßGWEwt¯WkEÅ~uìQ/mõ#ÔW`ýyuÇ£DÝAö'×±\r±ÕOD )ZM^³u-|v8]g½hö×ÅLàW\0øÈû6ËX=YÔd½Q­7ÏÏ9£çÍ²r <ÃÖêD³ºB`c 9¿È`D¬=wx©I%ä,á¬è²àêj[ÑÖíßOÿ´ ``Å|¸òòÆÞø¤¼í.Ì	AOÀÄ	·@å@ 0h2í\\âÐM{eã9^>ôâ@7\0òôËWò\$,íÉÅ¡@ØÒâå×w^fmå,\0ÏyD,×^X.¯Ö©7ã·Ã×2ÝÅf;¥6«\n¤^zC©×§mzén^ô&LFFê,°ö[¥eÈõaXy9h!:zÍ9còQ9bÅ !¦µGw_WÉg¥9©ÓS+t®ÚápÝtÉ\nm+ÞÙ_ð	¡ª\\¼k5£ÒÜ]Æ4_h9 Ù÷NÅ]%|¥7ËÖ];ï|ñµ ßXýÍ9Õ|åñ×ÌG¢¨[×Ô\0}UñçßMCI:ÒqO¨VÔa\0\rñRÍ6ÏÃ\0ø@H¢ÅP+rìS¤Wãèøp7äI~p/ø HÏ^Ýê²ü¤¬E§-%û¥Ì»Í&.ÎÄ+¸JÑ;:³¶«!ýÐNð	Æ~öª/WÄÂ!BèL+Â\$ðíq§=ü¿+Ñ`/Æe\\±ÒÏxÀpElpSÂJSÝ¢½ö6à_¹(Å¯©Äéb\\OÆÊ&ì¼\\Ð59\0ûÂ9nñøD¸{¡\$á¸Kv2	d]èvCÕþÅÕ?tf|WÜ:£Ô¨p&¿àLnÎè³î{;çÚGR9øT.y¹üïI8¹´\rl° ú	Tè n3¼öðT.9´è3 ¼Zès¡¯ÑÒGñþ:	0£¦£zè­Ý.]ÀçÄ£Q?àgT»%ñÕxÕ.ÔÇn<ì£-â8BË³,BòìrgQþ¢íßóÉ`Úá2é:îµ½{gëÄsøgóZ¿ ×<æ×w{¦bU9	`5`4\0BxMpð8qnahé@Ø¼í-â(>S|0®¾¥3á8h\0Ñ«µCÔzLQ@¶\n?¸`AÀ >2Â,÷áñN&«xl8sah1è|BÉDxBÞ#VV×`Wâa'@¬	X_?\nì¾  _â. ØP¼r2®bUarÀI¸~áñSàú\0×\" 2ÖþÀ>b;vPh{[°7a`Ë\0êË²jo~·ûþvÍÙ|fv4[½\$¶«{ó¯P\rvæBKGbpëÈÅøO5Ý 2\0j÷ÙLî)ÇmáÈV¡ejBB.'R{C¤ïV'`Ø %­ÇÐ\$ Oå\0`«4 ÌNò>;4£³¢/ÌÏ´À*Âø\\5ÅÁ!û`X*Þ%îÄNÍ3SõAMôþËÆ,þ1¬²®í\\¯²caÏ§ ³ù@Ø¬Ë¸B/¬Íø0`óv2ï¡§`hDÅJO\$ç@p!9!¥\n1ø7pB,>8F4¯åf Ï:ñ7Âî3£3¿à°T8=+~Øn«Îâ\\Äe¸<br·þ øFØ²° ¹C¡N:c:Ôl<\rã\\3à>ñÀ6ONnä!;áñ@twë^FéLà;×º,^aÈ\ra\"ÞÀÚ®'ú:vàJe4Ã×;ñ_d\r4\rÌ:ÛüÀ¬Sà2[cXÿÊ¦Pl\$¹Þ£iwåd#B bÎ×¤õ`:Ï~ <\0Ñ2Ù·RÂÆPÈ\r¸J8D¡t@ìEè\0\rÍ6öóäÞ7½äYÏ£ú\"åäÀ\rü¦À3¡.+«z3±;_ÊvLÝäÓwJ¿94ÀIJa,A¦ñ¯;s?ÖN\nR!§ÝOmsÈ_æà-zÛ­wÛzÜ­7¡ÍÅzî÷Mo¿¥æ\0¢aÅÝ¹4å8èPfñYå?òieBÎSà1\0ÉjDTeK®UYSå?66R	¦cõ6Ry[c÷°5Ù]BÍÖRù_eA)&ù[åXYRW6VYaeUfYeåwU¹båwEë°Ê;z¤^W«9ä×§äÝõë\0<Þèeê9SåÎ¤daª	_-îáL×8ÇÍQöèTH[!<p\0£Py5|#êP³	×9và2Â|Ç¸áfaoá,j8×\$A@kñ¿aË½bócñÈf4!4¨¶cr,;æöbÆ=Â;\0°øÅºcdÃæX¾bìxaRx0Aãh£+wðxN[ÜB·pÚ¿wTÀ8T%Ml2à½¡ð}¡Ès.kY0\$/èfU=þØsgKÃ¡M õ?ÿç`4c.Ôø!¡&åg°ûfà/þf1=¯V AE<#Ì¹¡f\n») ëNpòã`.\"\"»Aç¤ãüq¸X Ù¬:aÉ8¹f¯VsóGÞr:æVÞÆcÔgVlg=`ãWËýyÒgUÀËªáº¼îeT= ãáÆx 0â M¼@»Â%Îºb½þwÆfÛÙOøç­Ü*0¯®|tá°%±PÈÍpæúgKù¬?pô@JÀ<BÙ#­`1î9þ2çg¶!3~ØÜçînläÅfØVhù¬.ÑàaCÑù?³û-à168>A¤aÈ\r¦y0 ÖiJ«} à¹© Ðz:\r¡)Sþ¡@¢åh@äöY¹ã´mCEg¡cyÏ<õàÍh@¼@«zh<WÙÄ`Â¨±:zOãÎÖ\rÍêW«°V08Ùf7(Gy²`St#ïf#²C(9ÈÂØdùææ8T:¯»0ºè qµ  79·á£phAgÜ6.ãæ7Frbä ÈjèA5îá¡a1úÚhZCh:%¹ÎgU¢ðD9ÖÅÉ×¹Ïé0~vTi;VvSwØ\rÎ?àÇf²£ÿ¥nÏiYìaº¬3 Î9Õ,\nÃr,/,@.:èY>&FÑ)ú¶}b£èiOÝiæ:dèAnc=¤L9Oh{¦ 8hY.ÙÀ®¾®üÇ\r¬Ö£Àé1Q¯U	ChôeÿO°+2oÌÎìÞN÷§øzpè¢(þ]Óhå¢Z|¬O¡cÑzDáþ;õT\0j¡\08#>ÎÁ=bZ8Fjóìé;íÞºTé¡w®Í)¦ýøN`æë¨¤ÃB{ûz\ró¡cÓè|dTGi/ûú!iÊ0±¼ø'`Z:CHï(8Âê`V¥Úãöª\0Üê§©£WïßÇªÕzgG¾½²-[ÃÐ	iêN\rqºé«no	Æ¥fEJý¡apb¹ê}6£Õ=o¤,tèY+ö®EC\rÖPx4=¼¾Ù@¦.F£[¡zqçÜèX6:FG¨ #°û\$@&­ab¤þhE:²å¬ä`¶S­11g1©þ2uhY¬_:Bß¡dcï*ÿ­\0úÆFYF:Ë£ªnØÌ=Û¨H*Z¼Mhk/ë¡zÙ¹ï´]Áh@ôæ©Øã1\0øZKù¢ëÎÆè^+º,vfós®>¤Oã|èÀÊsÃ\0Ö5öXéîÑ¯F÷n¿Ar]|ÏIi4èþ ØÂC° h@Ø¹´cß¥¨6smOÃågX¬V2¦6g?~ÖÃYÕÑ°súcl \\R\0¨cA+1°ùÌé\n(ÑúÃÌ^368cz:=z÷(äø ;è£¨ñsüF¶@`;ì,>yTßï&d½L×ÿ%Ò-ëCHL8\rÇbû°°£úMj]4Ym9üÛüÐZÚBøïP}<ûàX²¯Ì¥á+gÅ^ØMÞ + B_Fd¬XølówÈ~î\râ½è\":ÔêqA1X¾ìæ²Ðø¯3ÖÎEáh±4ßZZÂó¸& ææ1~!Nfã´öo\nMeÜà¬îëXIÎíG@V*X¯;µY5{V\nè»ÏTéz\rF 3}m¶Ôp1í[>©tèe¶wæë@VÖz#2Äï	iôôÎ{ã9pÌ»ghæ+[elU¦ÛAßÙ¶Ó¼i1Ä!¾ommµ*Kàê}¶°!íÆ³í¡®Ý{me·f`mèCÛz=nÞ:}g° TmLu1FÜÚ}=8¸ZáíèOÛmFFMf¤OOðîáÀèøß/¼éõ¸ÞåþVoqj³²èn!+½òµüZ¨ËI¹.Ì9!nG¹\\3a¹~O+Îå::îK@\nÚ@¤Hph´\\BÄõdmfvCèÓPÛ\" æ½Û.nW&ên¢øHYþ+\r¶Äz÷i>MfqÛ¤î­ºùÝQc[­H+æÀo¤Ñ*ú1'¤÷#ÄEwD_Xí)>Ðs£-~\rT=½£à÷à- íy§m§¹æð{hóÌjÚMè)^¹ïÀ'@Vå¡+iÈîÎòåµÉ;F D[Îb!¼¾´B	¦¤:MPîóÛ­oC¼vAE?éC²IiYÍ#þp¶P\$kâJÞq½.É07þöxl¦sC|ï½¾bo2äXª>Mô\rl&»Ç:2ã~ÛÑcQ²îò²æoÑÞdá-þèUÜRoYnM;n©#ß\0P¾fðÚPo×¿(CÚv<Ê¬ø[òoÛ¸û×fÑ¿ÖüÁ;ßáºõ[úY.o®Up¿®pUø. ©B!'\0òã<Tñ:1±À¾ ã¤î<ðnîF³ðI¢Ç´V0ÊÇRO8wøÎ,aFú¼É¥¹[´ÎñYOù«/\0Ùox÷ÇQð?§°:ÙëÆè`h@:«¿öÑ/Mím¼x:Û°c1¤Öàû¯ív²;è^æØÆ@®õ@£úð½ÂÇ\n{¯¼Âîà;ç´B¼í¸8º gåä\\*gåyC)ÛE^ýOÄh	¡³¦Au>Æèü@àDÌYæ¼íâ`o»<>ÀpÄ·q,Y1Q¨Áß¸/qg\0+\0âæåDÿç?¶þ î©Úßîk:ù\$©û¬í×¥6~I¥=@íÑ!¾ùvÚzOñ²â+ÍõÆ9Çi³¼aïðêûgòðôî¿¹ÿ?0Gnq²]{Ò¸,FáÃøO¡âÞ <_>f+¢,ñÌ	»Ôñ±&ôðíÂ·¼yêÇ©Oü:¬UÂ¯LÆ\nÃÃºI:2³¿-;_Ä¢È|%éå´¿!Îõf\$¦Xr\"KniîñÀÐ\$8#g¤t-r@LÓåè@S£<rN\nD/rLdQkà£ªõÄîeðåäãÐ­åø\n=4)BË×ôÌZ-|Hb¡HkÊ*	ÖQ!Ð'êG Ybt!¿Ê(n,ìP³OfqÑ+XY±ÿë\"b F6ÖÌr fò\"ÒÜ³!N¡ó^¼¦r±B_(í\"¨KÊ_-<µò *Q÷ò¨Ù/,)H\0²rç\"z2(¹tÙ.F>#3â®Ø¦268shÙ þ¨ÆI1Sn20¶çÊ-«4ÚÇ2As(¬4ä¼Ë¶\0ÆÝ#årþK'ËÍ·G'7&\n>xßüÜJØGO8,ó0¼âù8ÑÓ\0óW9ÝI?:3nº\r-w:³ÂÌÅ×;3È!Ï;³ÜêZRM+>ÖÜðÊé0/=R'1Ï4Õ8ûÑÏmÿ%È¥}Ï9»;=ÏnQöã=ÏhhLõ·GÏkWÎ\rô	%Ø4ÒsñÎJ3sÛ4@U%\$ÜÑN;Ì?4­»óNÚÏ2|ÊóZÚ3Øh\0Ï35^Àxi2d\r|ûM·Ê£bh|Ý#vÇ` \0ê®äàû\$\r2h#ú¤?³I\n¼+o-?6`á¹½¿.\$µøKY%ØÂJ?¦c°RN#K:°KáELÁ>:Á¥@ãjPÌn_t&slm'æÐ©É¸Ó²½ã;6ÛHU5#ìQ7U ýWYÜU bNµWû_ûª©;TCø[Ý<Ú>ÅÇõWýCUÔ6X#`MI:tùÓµö	u#`­fu«\$«t­öXó`f<Ô;båghöÑÕ9×7ØS58õ¬Ý#^-õ\0êÀúîÕ¹R*Ö'£¨(õðõqZå££êX¹QÝFUvÔW GWíñÓTêÇWô~Ú­^§WöÄÁÕýJ=_ØbmÖÝbV\\l·/ÚMÕÿTmTOXuÊ=_ýITvvua\rL_ÕqR/]]mÒsu=H=uÑg o\\UÕgM×	XVU À%õhý¡53U\\=¡öQßØM¹v¡gåmàõue¡ÙûhÿbÝMÝGCeO5®ÔÖO5ÔYÙi=eÕ	GTURvOa°*ÝivWXJ5<õ¯bu ]×Öðúµ<õÃÙÕ\$u3v#×'eöuÑR5mvD5.võW=U_å(´\\VØÏ_<õ÷SÍn)Ü1M%QháZTf5EÕ'ÕÍW½vÅUmiÕUÔÕ]aW©U§dRváÙ-YUZuÙUVUiRVõ³ÓÇ[£íZMU§\\=Âv{ÛXýµ¼wQ÷huHvÇ×gqÝ´w!Úoqt¢U{TGqý{÷#^G_ubQêåi9Qb>ÚNUdº±k½5hPÙmu[\0¦êÅ_¶é[õY-ðô÷rõÈÕ(ÖCrMeýJõ!h?QrX3 xÿÈÏ#÷xÖ<Û{u5~íÑ-ÝuëYyQ\r-î\0ùuÕ£uuÙ¿pUÚ)PåÜ\r<u«S0ÝÉw¹ß-iÝóÔ!ÌÖøB÷áÆd]ùèÅÔÆEêðvlmQÝ6k¼ÒJ´wí¦ÄØÃãED¶UÙRev:XßcØNW}`-¨tÓH#ebº±uãó	~B7ê ?	OPCWµ×SEÍV>¶×UÛ7ßçÔám»Ó¬zÿ=µÍØ1º+ ¹mÃI,>µX7àä] .½*	^îã°Nº.èÎ/\")Ð	¯s®|à¤çÓÐlÁ}ã¸Íç!óî5n±pj£¾h}½èðmEázHÂaO0d=A|wëß³ãë×Îìu²vùØ¼Gx#®bcSðo-ùtOm`Cò^MÅ@ë´h­n\$k´`þ`HD^PEà[ä]¹¨rR¸m=.ñÙ>Ayi \"úò	Ö·oã-,.\nq+À¥åfXd«¶ã*ß½KÎØ'Üê Ð%aôÿù9pûæøKLMà!þ,èÊË¨zX#VáuH%!À63J¾ryÕíùq_èu	úWù±Æ|@3b1åÈ7|~wï±³þíA7ÒÂè	¼9cS&{ãäÒ%VxðïkZO×wUr?®ªN Î|CÉ#Å°õåÕ¯ ¹/ú9ftEw¸CÁºa¦^\0øO<þW¦{Yã=éeëýnÉígyf0h@ìSÝ\0:C©´^¸VgpE9:85Ã3æÞ§áºð@»áj_ª[Þ+«êÇ©x^ê®~@ÑWª¸ãã9xFC¿­.ãçöük^Iû¡pU9üØSØ÷½\$óóø\r4´ù\0ÎèO°ãÄ)L[Âp?ì.PECSìI1nm{Å?PîWAß²Á;ñìD°;SºaKføò%?´XõÞ+¤B>½ù9¿¯ÙGjczAÍ÷:êa³n0bJ{o¥·!3À­!'ØKÃÅíùÔ}ã\\èÎ3Wøê5îxÏÉÁL;2Î¶na;²í×ºXÓ]Éoºxû{ä¦5ÞjX÷ð¶vÓéãqÞÊEE{Ñ4Á¾öÄ{íÙç	Ì\nöÊ>ùaï¯·¾üì§ïØLûÔûåïÿ½ûìñ'ð½Þé{ë\n>Jøßá¸Ó÷YÏ\rOÊ½ðt¯ÿû¥-OÃ¦ü4Ôÿ9Fü;ð§Á»ÔüGðøIªFßì1ÂoÿßóñO²¾éa{w0Ó»ï¤Æ¯;ñlüoñàJÐTb\rwÇ2®Jµþ=D#ònÁ:ÉyñûSø^ã,.¿?(ÈI\$¯ÊÆ¯í¨á3÷Ãsð4MÊaCRÉÆÍGÌúIß°n<ûzyÑXN¾ð?õâ.Ãî=àñ´DÇ¼\rØé\nÕó¨\roõý\nÐCl%ÁÍYÎû¥ß°ÏàGÑþÚ}#VÐ%ý(ÔÿÒà3æÉrð};ôû×¿GÉÌnö[ª{¥¹_<m4[	I¥¢À¼q°µ?ð0cVýnms³nMõõ\"Nj1õw?@ì\$1¦þ>ðÒ^øÕû¥ö\\Ì{nÂ\\Ìé7¿Ùic1ïÚÿhooê·?j<GöxlÏù©Sèr}ÍÃÚ|\"}÷/Ú?sç¬tIäåê¼&^ý1eóÓtãô,*'F¸ß=/Fkþ,95rVâáøàÀºìÛo9Íø/FÀ_~*^×ã{ÐIÆö¯ã_²^nøþN~øáÅAí¦d©åñþUøwäqY±åî´T¸2ÀéGä?&§æô:yùè%XçJÛCþd	Wèß~úG!´J}¤úìùõÄB-Óï±;îûhÃ*ó¼R´ìöE¶ ~âæó.«~Éçæ SAqDVxÂîÍ='íÉEÙ(^û¢~ùø¿çòéçïo7~M[§Qãî(³Üy¸ùnPÑ>[WX{qÔaÏ¤ÆÉý.&NÚ3]ñúHYïÝûëÛ[¶ÁÙ&ü8?Ñ3¦¶§ÝÚ»¶á#¦ÎBðe6ë@[°¤£ûàÐG\rÎ+ý§}ü÷ÁÿÏ_Ýç7|N§«Þ4~(zÁ~»¹ï§%?±ßÓÈ[¹ø1Sª]xØköÑKxO^éArZ+ºÿ»½*ÂWö¯kþwD(¹ø»R:æý\0§íù'¤óm!OÐ\näÅuèÆó.[ PÆ!¹²}×Ïm Ûï1pñuüâ,T©çL 	Â0}â&PÙ¥\n=Dÿ=¾ñÐ\rÂA/·o@äü2ãt 6àDK³¶\0ÈÂq7l ¼ðBêúÌ(;[ñkr\r;#ÃälÅ\r³<}zb+ÔÐOñ[WrX`Z Å£Pm'Fn ¼îSpß-°\0005À`d¨Ø÷PÁÚÇ¾·Û;²Ìn\05fïP¿EJäwûÛ ¹.?À;¶§NòÞ¥,;Æ¦Ï-[7·ÞeþÚiÅâ-ÖîdÙ<[~6k:&Ð.7]\0ó©ûëù/µ59 ñÁ@eT:ç¯3ÅdsÝú5ä5f\0ÐPµöHBí°½º8JÔLS\0vI\0Ç7DmÆa3e×í?B³ª\$´.EÐfË@ªnúbòGbÁÏq3|üPaËøÏ¯X7Tg>Â.ÚpØï5¸«AHÅµ3Sð,Á@Ô#&wµî3ôm[ÏÀòIíÑ¥Ó^Ì¤J1?©gTá½#ÏS±=__±	«£ÉVq/CÛ¾·ÝÎ|ËôáþD g>Üõëé 6\r7}qÆÅ¤JGïB^î\\g´Ýõü&%­Ø[ª2IxÃ¬ªñ6\03]Á3{É@RUàÙMö v<å1¿¾sz±uP5ªF:Òiî|À`­qÓ÷V| »¦\nkâ}Ð'|gd!¨8¦ <,ëP7m¦»||»ÿ¶IAÓ]BB ÏFö0XÏú³	DÖß`W µÁqm¦OL	ì¸.Í(Áp¼Òä¶\"!ýª\0âÍAïÃôÁV7kM¸\$ÓN0\\Õ§\"fá Çëñ È\0uq, 5ÆãA6×pÎÎÈ\nðÎjY³7[pK°ð4;l5n©Á@â\\fûÐl	¦MöùûPÁç3®C HbÐ©¸cEpPÚÐ4eooeù{\r-à2.ÔÖ¥½P50uÁ²°G}Äâ\0îËõ¨<\rö!¸~Êýµ¾óñ¹\n7F®d¶ýà>·Ôa¢Ù%ºc6Ô§õMÀ¥|òàdû·ìOÓ_¨?JæªC0Ä>ÐÁ&7kM4ª`%fílðÎB~¢wxÑÚZGéP2¯à0ü=*pð@BeÈØÏ|2Ä\r³?q¸Ð8í¸ë±ñÍÐ(·yráö 0àî>>ÀE?wÜ|r]Ö%AvàýÁÅä@+ÝXÁªAgâÉÛÿsû®CÐûAXmNÒú4\0\rÚÍ½8JÝJðÇ¸DÒó´:=	ðóëÆS4¯ñF;	¬\\&ÖèP!6%\$iäxi4c½0Bá;62=ÚÛ1ÂùÌPCØåÂmËÍdpc+Ò5å\$/rCR`£MQ¤6(\\á2A ¦¹\\ªlGòl¬\0Bq°¤P¯r²ûøBµêÑ¹_6LlË!BQIÂGÀåÜØðXRbs¡]BHrã`ÎXä\$på±8ð	nbR,Â±L \"ÂE%\0aYB¦sÍD,!Æ×ÏpN9RbG·4ÆþM¬t¸¬jUô¤À§y\0ìÝ%\$.iL!xÂìÒÅ(Ä.)6T(Iìa%ÒKÈ]mÄt¥ôú&óG7ÇITMóBú\rzaÂØ])va%²41TÁjÍ¹(!¬Þ¡¨\\\\ÆWÂÜ\\t\$¤0Åæ%á\0aK\$èTF(YàC@ºHÏÐHãnDdÃWpÉhZ¯'áZC,/¡\$û¦£J¡FB¨uÜ¬Q:Î¥ÂAö:-a#ì=jb¨§lÕUg;{R°Uº±EWnÔUa»VâîNj¬§uGÉ*¨yÖ¹%ÝÒ@Åï*Ìä«ÕYxê±_ó²§z]ë)v\"£çRÕåL¯VIvê=`¾'ª°UÝ) S\r~R\niÅ)5S¦åD49~Êb;)3,¦9M3¯HsJkTÃ(¢úuJ][\$uf¨íob£µ¹\n.,îYÜµ9j1'µ!ö1\$J¶gÚ¤ÕÄU0­ÓZuah£±·cH¥,ÃYt²ñKbö5ë5/dY¬³AUÒ©[W>¨_Vÿ\r*·õ©j£§-T± zÖYÊdc®mÒ¹±Ø:¹üË[Ut-{ªµýl	£i+a)».[º_:Ú5ähò­WÂ§Ém»¥%JI´[T«h>®µ·°;ËXÌºdêÂSdVæ;\rÆ±!NK&AJu4BÁdgÎ¢.Vp¢ámb)ÇV!U\0Gä¸¨`Ð­\\qâ7Qöb«VL¥Þ:äÕúó¬Z.­NòÄ*ÔU]Z´læzëÎöù®ÇR D1IåÂ£Ñr:\0<1~;#ÀJbà¦ÊMyÝ+Û/\"Ïj<3æ#Ìêñ¡:P.}êe÷ïòD\"qÙyJýGû·sop¯²þX\rÝ³dÞ\rxJ%íÏÆ¼O:%yyãÅ,%{Î3<îXÃ¸ÏÌ÷¯zÂEÎz(\0 D_÷½.2+Ög®bºcÚxìpgÞ¨Áß|9CPûî48U	Q§/Aq®ÝQ¼(4 7e\$Dv:V¡b×ûN4[ùiv°Àê2ñ\rX1¼AJ(<PlFÐ\0¾¨\\zÝ)ÑçW(ü4ôÈÃÚï¢ pÓõÊ`µÇ\r³da6¯üOÖímña´}qÅ`ÂÀ6P'hàç3§|îÃf jÈÿAæzø£+DUWøDíþÞ5ÅÄ%#é°x3{«¶L\r-Í]:jd×P	jüf½q:Z÷\"sadÒ)óGØ3	¤+ðrNKö1Qþ½çx=>û\"¤°-á:ÊFÍõIÙ*í@ÔÇy»Tí\\Uè¨ãY~Âäâ3DåÁã¨f,s¢8HV¯'Ét9v(:ÖB9ñ\\Z¡(&E8¯ÍW\$X\0»\n9«WBÀbÁÃ66j9Ð âÊ?,¬| ùa¾g1²\nPs \0@%#K¸ \r\0Å§\0çÀ0ä?ÀÅ¡,ä\0ÔhµÑh\08\0l\0Ö-ÜZ±jbàÅ¬\0p\0Þ-Ùf`ql¢ä0\0i-Ü\\ps¢è7e\"-ZðlbßEÑ,ä\0ÈÌ]P ¢ÚE¶b\0Ú/,Zðà\rÀ\0000[f-@\rÓ¯EÚÏ/Z8½~\"ÚÅÚ­ö.^ÒÎQwÅÏ\0Ö/t_È¼ÀâèEðÖ\0æ0d]µbúÅ¤|\0ÈÄ\\Ø¼¢íE¤\0af0tZÀÑnJô\0l\0Î0L^´Qj@ÅáJ´^¸¹q#F(1º/ì[µ1¢ãÆIæ.Ü^8»\0[qØÌ[Ãl\"åÆ \0æ0,dè¶ÀÆ\rÌcøµ{cEÁ\0oâ0¬]°\0\rc%ÅÛð8½w¢åÆZµ-Ä\\ºñ{ãÅÖGª/\\bp@1Æ\0a²1ùÈÏÑsã!Å¨/î/Ì]8¹~c\"ÅÛÅþ2ôcÎm£\"9q/\\^fQ~cÆ_£Î-\$i\"Ö\0003Ë¬¤fXºqx#\09Z.´i¸È@F3tZHÉ \rcKb\0j/DjøÉ1¨ââÆIh´aÈñvÆ©OZ4ZòÌÑ#YE¨\0i.hHÒÑsX/F<Ï.äjøËñ­bèÆÍ\0mV/d\\èØñb÷E³£3T^(ÝÑcKFRÕùô]X¶q½¢øÅà6Ô]hÓñc6EÄó66Ühãn\0005sn/dn¸Ô`\r\"ÑF³Ú-D`ÈÕãN2Y¤bxÀñ#\\ÅëV3x·1xFx¾\0Ê6b°q£Ç!8|^ÌÑubåÆàÕ-ôrØäq¼ã:Æé%ö0ppñ#Ç¢\0Æ6ÔfÕÑÇ¢âÅ¬dÒ0qH´±¾£\$Ç@qò-¼^B4±¦\"ú\081ª/lnxÏ âêG3:0tjhÒ~@Æ¼¥¦3¤vHÆñ¹bÜG(e4gØºqÂã2Æ1É-nXËñº\"ãF<Q1\\j¸¸1®ãÈEÇÇä³4m¨Õñªã[ônÁz7üyhÞ1§#ÆÞ/3\\xÐqÍKGÿÆ6äoÑ1{£°FJ×6¼lXéqâ£Æu©Þ9r(¿1ÒãGc\0Åf:rX½ #ÐÅ½\0iÞ<\\}×ñåbîF½\0sÖ7Üy2ÌÑæ#uFe\">4iØÅ¿âÔÆçé\n<{¸ã£âÆJ;¬]ØÄ1Å#ÎÆ0ÙJ;4^èÂD½ãóÇ®¨³4i¨À(H#ÚÆEx/¤nøû1ðã/Ç¡åj6,lÛ1tã/\0005%ï0]xü¶£GG5!0¤¨×ñÚâérq¢2Ì¨ÞÎãNFPo\"4ô_·1×dÇ%e ²3¬s8éüãG5 æ6Ô[HëcØHjY;ô[è¾bë! yò@Ä\\¸½qØ#WHN;ÌcÆQèã:Ç-%ª.kXÆý£ÚGÍÏ1Df¨ßºcWFl¡!0ü²c EÜ©;lÑq\"ëF©ß¢7\\\\¨ùñâ£ÔÆOqþ.T|\"?ñãÆE³f9TyYÑ©ãSG1ûÂA\$f9R\n\"ÞÆx¹>BHÚñß¤\0Ç¶:\$e¹1£³F?=º3Tu)\nq¹béÇ~ËÎ<TøÎ±ÐcH.m~CôwHÊ±¸#/ÈI]~3ä^ºÑ#§Æ>Y®4^¸ÎQjcÊÇK1\"Ò8¬|6Ñåc\"ÇBµ\"b4ãèæ%¢ÔÈG\0e\"/t¨´1r£1Æe!v2yÀ±õä<Ç 8\\o¨ÊÑ#tÅÑ\rz@´}HÂèbïÆèy î1Ì\\¨ðëdeGÁZ3~ér)ã1È¿ÛBl~H½²:£dF£-Î?k8´qèc(FÍKÞ5|myñc1Æ<*@´jØáò1ãÛÅ¾>I´ZèÍQjäÈ2É\$0¤hµQäVFT	\$ÆAl~öqÚ£È±\$Ö>\\pÙ\rq\$/Èu%ï!®Jq \$ ãtE²GN-Tq)ò\"¢ÛHÊË¦=ìXÉ2-£H«8\\nµRW\$Hë\"¢C\\_¹\0»d\$Çf³\".Du	'Q£zEíÙ&0toóqjãúÆ¿³R@døÉä£ùÇu##¶LLkÉ*qó\$*GÄiÎ@TilãòEªÎ5¾r\\dIµ\"/ÌZÉ0j\$TÅþz5Ld3£ëÉoÂ.Tq¹!1{£ÆåÖ9Z¸¾QÕbÓFwJ94nÒÄÖä{É(-8·2h¤uÈé;\$-Dkøårs£H#¡ôY7ò\"Ø/E¿Ó 	\$j¢^ò-£]Ç7[\"N\$èÂ¤WÈ¯Ö/]à\$²+1Ga/&IDnøÂ@\$åÆ!ç\$Î-k!Q¨âùÊ)(N/\$t¸Ý¹äëÆOKzP´tXÜò[\0Gw(*K\$vË1ócÉ'ÞGÌIòxd­È\nAÒ8\\rX·Òa£÷IiNI%\$½ãÆ_÷ª6¤fçQþ#ÈI5#F´ØºñÏ#³Eâ\"î3\$¢IÜcHÝvR|ùQ¤cE¸ñ:Reº±hä¶EÎfK`8þr.#·E³s®0LüRäF©·!\nC\$`Èöñ´\$ôH?ËnPÜe!ñ¥@F'¿/¸¶ÄÖäÿÊ¯%ÂN,hÈÌrF\$öÈþÇ3´tøæÒ¥Åæ!1<ÉCQÏ%ÉÃ¹æJäZØf.Ý6Å·±C¥ÊÔ.²[þBÒ¿xëàè\0NRn`ÈùY\n%+N¨IMs:Ã¹Ydef¬B[¶°ÝnÆ¹Yòm¨ÁR®×ûÉY¯ÚCXëÛj³çU+Vk,¯\0Pëýb@e²¹¥x¬V¾ºyT¤7uî«[JïÈ±\nD¯§eR¿¬mx&°lÀ\0)}ÚJ¼,\0IØZÆµ\$k!µ¨ñYb²Á°RÂe/Q¾Àk°5.Áe­5À¨W`ª¥\0)Yv\"VÂ\0Ã\n%å`Yn¯Õ¡aôÔxÃQ!,õ`\"	_.å©Ætm\$\"²J«¤ÖÀ§vÆ%M9j°	æ§Ä*³KpÖ;\\R ¼ü3(§õ^¯:}Èï|>Âµa-'U%w*#>¤@Ì¬eJÿ¤;Pw/+¹á5E\rjn¡ÐÃdô¢^[ú¯§cÎ°¥uËz\\Ø1mi\"xpåÃ;£ÌîæP)äøªÇ#±Ø¡Ë!Aª;¨ß	4ì³a{`aV{KUàÊ8ã¨0''o2¨¢ycÌ¸9]Ké@ºÒ^ðlBâOrëÔã,du¤¾8¤?õÕ%¼gB»îÆYn+ã%c¬e\0°ñà¤±Yr@fì(]Ö¼¨\nbizîÖnSS2£ÁGdBPj¹Ö@(È¥¦!à-çv²´eÚ*c\0ª4JæçùÕÙ,UÈ	dºÉeðj'TH]ÔÔG!)uÕÖ¯Ò¯ùZËB5ûÌW0\n±á¡ÔR«ÁW\\¦Q jÄ^rÊ%lÌ3,ÒYy×Éf3&ÌÜÕQ:Ïµ2mÉR)T¾(KRÁ 0ªÊ@«ìY´¢Y:£Ùe3\r%´¨°Tö%­XÁ¹STÔ.J\\ë0ÙhôÄD!Ä:uæêÉU\"¾ÅÁo+7\"µf'º­R\0°ÞJõ2S2è#nm »ÁIåý\"Xü³²[ÖÑì} J¨¯c¼9p0ªüÕQ»(U\0£xDEW.LõÁ=<BÔ0+½)ZS V;â\\âµI{5IAôÖÃ,dW²uè5Ew\n\$%Ò½2i_\$ÈÙ+ìæO,¬íX´ÕJg&J¡úGº%\\J·b.ÄÝ^LTòFlè¹]k#f@L·GÄT¼ÙÒÍHÏÌ\"q1SÌ°ùjVÉ(ÎìZVzßÅ³,§ÊèG.1Fû±gNÊ;×1ÃV¬¦5EÍò5`ò\0Ctè=F\ná¹Î±KþÖ\0­Û±%¨ËD]Q\$\r\03J\\,Í³<T4*£Á.ÒYK²D«QéLïS%,gÔÇåª§Ö<Ëëu0ôÍUÄÖ*x(©åNÂYv!þ¥yÍ	wÅ4fdª¥rGM \$äê^;ºéîÝæ)<Pã]DÒ%%Ó;ÔjÊåI0æaÓu^Jp[)¦v©3RhRúEöÀ\næL_#5|Ü¾Õm3Pñ*¨\\Y51X	i³NÈñ\$\"°ºaü­õh*KUÝÌïV8¨åuò±%&ræ¯Ë ²5oÕçg³;ÝrMl[Æ¨ög³ùª·UÍqê¹h|ÔeO2·f MlW2AP×¹ÍÀÍv~eD¬eñ3UÓ«lE62iüÎõìÓUbÌï¬«õU¬©¨îøýªVðêiI!\$i¨Ê­&Z:½xm!Å.ÖOÍfwÒ¯!ÌÓkÝ¤Í6b\"«IJ]]:T6ÒVrú¹}ÜÇ«]®±U¢	ys7fÔMÅÿ3ÜÎYó:T_MÍw%3ÆnÏ¥\nÎæz*í3âh·	»`U²Lÿ,¥ÛÐ5¨óvf»ÃÙ42_Q¼hÝÇÍuD§\no£¹)¤ÄÕ«M9¿7foÛ¼©¤rÖÝÇÎWB~iTÝeyQTâN\nd¦pr§#óM§;4æpª¼têÿ(;³5	|¬àÇ­',AV7ÜÔåUAö&ìÍRP¯\"äÕyÒ·) [nÌÕñ-3VË,?s6ºpù3fµÎAÛ9k|ÝÉ®Sf¬*@5Þg¼¾É¿2·Í}®þUüÝðùæHÎFl%®pÂ«Ie³beMÙSO\r[¼æi²3fÉÎLVá®rÙu®¾¥ÛNA:î%rÚy3Q_Ì¸W.ÑÕÈ^Sl@&ÌÁ5ÖYlÂÌ1åæÎ}VxêgÊ§^SnÕÌÍQ!:5×ZÞiZCÔ:¿3qgé%DáõÝª{U¡3tZ¹`ûÓu%w:ÉZQ:QìÏÇW fîí¿9Jplê)Ö3xÔvÌþK7b#«ù½«çX+J(¢Âh´ìP*Ó´«Îþ¢!×ìÅSLçh*'¤¨\npBùÚªgNÊ§8BuÒªéÂ¯çÎ½8niêIÍs¸USÍI;vvÚ³UõsR7Nu×8©H|íéÅÓ·§Ì«8òq´ÕÙÞ+'ÑßÍ`x¢9R	Õ®ºçMaR8úxä)¸'!Ï;±U¬×YÖÝsNIg:ÕKTëy¯3®gÍYìëÊkäãÉÜ³n'LO(¿3w4ñ4î»¦ÇÏÚêþl¬ñÎJ½ªw½9Ý\\ìçóóhf(¢_~ìòà}9Nö¦Õ\0´åb\"¢Yé¤Th,Ú¤@ú±D¡û\$I·;eüèUÊn¨³·,¹OªÆ	Xÿg´-ÀÉ+>ti'Gölª%\0­8âVBËU1«ye\0KTÆ4ûÁÈmºV2)\r]I/\rFùÔX×Àß¨ña·­GÂ¹ò*§»ÿ>ERì÷ðî®¥ÑZ-)I\$®¹íç:¦aË\0¾FybaÙg«w§­(ß_@§v}öiõÊ³îS^Ë25DÔ³Ð	ÈôURO±JHÖ\\ØisðfÆËKN±qi÷Sg×OÂ\n²F~|«µÏ*@gR_Q<9sÜ¬3i+Ø².Cw²²ê|øyË6aìOÜY9¶¶É\nëÔ½-([®±_}íSû]c¤S=Â¤ÎÙþÎÍÔYÎàU-> <ú©µ\n<ÖsOôQ4F¦^}\0007uäk(/Û/5{Lÿ9µ\0§¬Ð &³[<ÏõsÛ\0&Íè#@hÌéª3©V}ÐH¢*Üw+]'DÐ& @§Ö])µè;TGe3\\Îên®ÑßËd\$:¦uN4Åyktê-dR!7­Ée4(P!-þ9À4ç_PMGbÄ±w«ØÉ6O§S¦Fâí)§yh0+²§qT|·+uÔÿÎ+ A¬?òÞ	öTè3.q 41T´¸e\n:P ø¯{Tî\n³ëh?«TïAùS£­*«åÒ+åu¥>ú\\ê¾ZéíÊîYì·¢wEJö%·sL±¾dªyÀ+\rCèß¡'Añl,Òyå3þç²ËÍ`º	_*ÑPû ThKDV²·~5	à0´+á¼,-?­]ºò3ëÖKå`¯^¸¤I42(]ªw.ærÄÊËê]¬\nYÆ¨B£­Ð	³í}ÐR ¾ÉgØ}:H§ðJÄWP²ê\"ÞµðôV\\¬<? >½åáÿ§Ü¬Ý¿=¦:\n0×è\\+ñS´æfÝU³íU,WCÖèOn¨òÎ¢§.e9|R÷I'©[×/º²ÄÙü2ù«QÓBn:ÆIõ\nö§g¼9Æ\rü,ÓR6³ýçÒQ\$XÝ+¸>©±`\nù)/_8QiÔùµê=êv?5v\0 \n¨çÉLG¥Dmw\\ëFÖÑ¢¯Ádêµ}s\"ÃYv¤|âJ*´9h­¡Ñ@XEUÑ*Þ(oQ]\$B,ûéÜKTv¤AptCÉ\n×C,/<¡­ÚEW-VïP¡¢=Wÿ*%Kê-Q`9	(Êú59Óèm)ËX¸¨@ç2ø ýT@Û\nS¯bd×EÎ´a+DXîá|UÚ		¡F® 2ú%5\njm«WÙ+xêKæVÌ3#¶CTÃek¤&Î,£l¬jbd7)Ó\"\n+ìPüºbèI@è3ÑÜµjUÒÌEsÞÔ)D¢fëõûÇPZ3AÎÕ\nwThð²ªÛÅ4Zäª<Êuß©ßdqâËu(÷bKG±à¥éÀnÓTï®]z¨f%#3IËfS¨®&}µ@D@++ù¤Aíhª¿\nªïUÞ¥|B¡;UmÑÙUEN¥!ôx2±1Ò\0§GmvH~õÁHèTê)öW®³YNý\"åk5©ÑvT#=µÚ¥Ê<\n}#R3YHÅRÍIÍ³Ü¦;ÌÑRl£1léuB%TQJî*ºêÙ'ºEë0i¬dw,¥zÊÍ¥:\$¦;Í? üîj¿)§ô)ÔÊ\$32J}Å&[³\$¨õÌ¤;DnýE×´À+0ÛaZ{¨èC èû(¤ê:¸ ÚO@hø²D£æ\0¡`PTou³ÄïF®\rQvû¨o½Ü¡\$Sîö+Ò#7À¤Izrpk DWFsÍ9 Qê  Ð°1gÀÅ#\0\\Là\$Ø 3g©Xyôy -3hÀþÃ!nXèô]+±	Éc\0È\0¼bØÅ\0\rü-{\0ºQ(ðQÔ\$s0ºém(°[RuòVÆ÷ÒØ>Æ¼+àJ[©6àÒàJ\0Öú\\´¶ã,ÒéK3ý.ê]a_\0RòJ Æ`^Ô¶ClRÛIKîù\n \$®nÅÒä¥ïKj©\nÁ©~/¥ªmn].ª`ô¿ijÒâ¦#K¾f:`\0é6¦7Kâ¨zcôÂ\0Òõ¦/K®­/ªdôÄéFE\0aL¤dZ`JéSÏÊ2ØÍ4Î@/Æ(Lòõ0ª`´Ä©_Lþ]4ZhôÐ©SD¦M4:cÑéSR¥×ME4iòéSG¦EMjå4zdÔÕ©SFKLª%4ªeÔÏ%\$ÓlKM2õ1ÈÚÔi¦Ó©MV­.¸ÚÖi´Ó©Lz/÷ôÛ£Ó¦ÑMæ,`_ôàimS¦gMÆjgòéÇÓ5¦9.9j_òéºS¥µ.Å9ê_±òé¾S¦.7Úrò)ÉÓ%§[2m8ºuTæéS±§3M:]3ºqèänÓ±§KN1|^ÒktÏ\"ÒÓH§gKj-;zcñiÎÓ§\r<ê_²-iÊÓ¸¥ñ\"ÖU.¹´óiëRÚkOFí=:\\ôÏ\$ZÓ©§MLE­5úxôø©ÂÓ»_\"Ö=<\0ñtéÙSç¦9OÒ­1~öi²Óô§¹Oêí>ê~q)òF¸¨ =6:~ÔõãJÔÏP:Í=¨åTÿ)¢Æ«§ÿPJ8õ@êwôô©÷Ç*§ÍOÊ5]>ªt÷£T\n§å!\" 6Y	)ÈH¨/Pª3É	éð/P~ àù	ªÓ®¨!\"CÌÔýj¡ ¨eNJ¡üêñÔ*%Ô4¦1Q¡ÅCZQjTBQ.¢\rE)\0004Ëê\$2¨SM+å<jt¿j0Ô,¦9Q¡}F\0\$±s©Ta¨KÎ£]Ecj*'K»M¾MGx½ÕRÇT1¦#Qê¡¥Gª5ª:Ôz¨L¡4u6z\"j\"TKuNÖ£ýGÚg\$jFSÜ¨ïQ2¤¥Høîµ\"êMT©%R¤HzÕ\$ª,Ôw¨Re.\$rªzµ)©ÛÔ¦©-Qö ÍJ¹Êª@Ô°©=R&/IÊ1*]T³À7¼¾QÒåD&Ó©qN¦_(´q²c[TwQRôå´J\0nâ÷T­¨û.¦956cÔÜÕSz¥HÁ7ªRÔ}Sr8¥NÕ\"bÖTè§ÁQÞ5MNõ#ãçÔè©ESÂ§-HÁ7\"ÜTü©_Sê§}GØÌ?*yÔ©Sò§½P*5#âöÔÜÏT:§]PÊõC*ÔT:¨-K8Æ5CªÕªR¦--MÈ¾HªÕ ª'T¨­HøËõHªÔÑ×T¨íRª£õ,âéÔÜGTÚ©-SJ¤õM*Ô©UTÚ©mMH¸õMªÕ>ªgSD³5MÈÂRªÕHªwU\"©íK8ÕÕRª ÔÚ¡U*ª-U*¨ànÂ¾TÙIR­,t¢Z«ÕêY¶IUF«51ª¬µW)vÕk_KÆ«pJ«5Zj­Å¯©R4r\n¬^jIÓCKºª}UÊ_ª°ÔªãO¬=N·R*¯F-ª½R¬%WÕcê¦Õ\\aV>«EYjµdªªÔÃ«UÎ¬µWXÍ5*ÈÕ¹UyõZ°1kãÕ¨«7V¬R\\HÍ5h*ÖU¢©ÏUÆ§M[²±kêvÕ¸«3Vò­}[(ä5WªzÕ¸«iB­Oº®1¯ê¯Tý«V®;­[øîµpRæGu«;T@0>\0ê/I³ªÿW`í]¦ô\0ªîÆ8«¿P¯]ÈÍ1m*ïÕÇyUz¨mW¡õ|ªÝ[«¡Ö¯]J¬ÑêøU±««ö¯Z*¤5\\jÖ«ëZªô`ZÁ5~ª®Eì¬Wú«4ZÁ5h£QÕ^cXZ®Sú®1o«Vª¹U&«TºÄ5}cU^X°dm*³±kUu¥«SfG=[¹õjäsÕ¿ÏX¦Kc\n®iRâHç«i#±uWt»µª½¥º«»XÂÕcÄ¹«U¬rÚ¢õUZÕNE¢¬Xº¬4ÚÈudê·Eä¬eV^²íKÉànâòV8sXÂ¥ÍfÇõ/ÂhJ³-J]ÓÓÎÁÕzO±<Eh\$å·¡ó\0Kë<bwñ>·øN\")]b£	â+zê.cS.¢iFç	ã£µQNQ«éV*ªéÛÎúÞO[X¤nx¤P	k­§oNø£}<aOò§IßÁh·ºT;òrñ¤VD6Qß;z]j×~':ë[Ivôó7^Ê§ÖÁjëºw[«ùæîºçÊÅ¥:u ÅDs#¦¿Î\\wµ<n|*áhëmÎKv;YÒ±Ú3á]«^#Zªj¥gy³jÄ§Y,%;3¾³ÊÚù×.ÈW\"Ã\$Ù3>gÚºÏÓÏ¦ªVTóZj¥hYÝjkD*!h&XzËiª¥+GV­\"¥æ¸Z:Ò¤§+NoG¥Zjj¥iÉ]ÊkOÐ_­Ö¬ÔmjIª¨§t¯#½[âj\rnãê©×ÐnßZ¥_,ÕéógÎÄ©:¹¼Å9Áÿ«[L2®W=TÔ×0®ãf¶\0P®U6\ns%7isYæ?£¿uá3¾½nb5¡«»X|G~l&×k¤¥·M§ ¯ú¶Ïy¡SÉ)Î]Ü­r·¶Ù¸µ¸æìÖêÅ?Õ}u'n0W-Î¹®æb·´Çªìõk?»vQý7Ü}p\nìõÀÍÙ®Z*»9)Êá5ÞZW­-ZB¸²:ìõã«W\0WZfpGpõîÍÙ®:Fpú¤äUÙëSN/Ï\\©Ü%s9¬S{§ ×8®ÏZÍasÊÛ+¢N^®9MÕ{P5Óç ×Q®ÔîJº¢«y§õÕè;Úîz¸ÂÕYÚV Ä3:ïDÅIÃ+çý¯£19M;º¥ô¨V´®\rQ{êÉÕ®¶Å+£FCLÄ¹N¥©Ô\\ùÞ)\$iÛN'\0¦°PÂõÊÇ]XÌ^s1òf&\"'<OøóÌ¡ËL\0¹\"@Ö¥%ä6úÂUAõ1ýi(zÌèÝ\rÒÕä±ÈbZÀ+IQOï3ºË\r=*Ä )ñ¨!Á Ð`ª¼h°,Ð«mGPCËA Ù²íA(ZÅ°%tì,h/ÁiÈk¬«¡XEJ6ð±IDèÈ¬\"\nïaU- «\nvy°_ÄÂÂÚ«¯k	a½B<ÇVÂÛD»/P»ôaîÁ)9Lã¶(Z°8êvvÃ¹Øk	§oÐZXkäÑå§|´&°.Âæ±C¹Øá°`1]7&Ä+H¤CBcXB7xXó|10¦ãa6°ubpJLÇ(·÷mbl8I¶*Rö@tk0¡¯ÅxXÛÁÓ;ÁÅ al]4s°t¿íÅªð0§c'´ælß`8M8ÀÃD4w`p?@706gÌ~K±\rÛ P´Ùbh\"&¯\nìqPDÈÐÎó\$Ð(Í0QP<÷°àÀã¬Q!X´xúÔ5R·`w/2°2#À¸ `¬»1/Ü\r¡Ö:Â²±¢£B7öV7ZgMYúH3È ÙbÎ	ZÁÓJÅöGâwÙgl^Æ-R-!Íl7Ì²LõÆ°<1 íQC/Õ²h¼à)ÏW6C	÷*dþ6]VK!mìØÜã05G\$Rµ4¯±=Cw&[æ«YP²dÉ³')VK,¨5eÈ\rÞÊèK+ï1X)bÛe)ÄâuF2A#EÑ&g~e¡yfp5¨lYl²Ô5õö¿Ö\nÂÙm}`(¬M Pl9Yÿfø±ýÖ]Vl-4Ã©¦«ÂÁ>`À/û³fPEi\0kvÆ\0ßfhS0±&ÍÂ¦lÍ¼¢#fuåÌû5	i%ÿ:Fdö9ØG<ä	{ö}ìÂs[7\0á¬Î3íft:+.Èp >ØÕ±£@!Pas6q,À³1bÇ¬ÅãZK°ê±Ü-úar`?RxXÁé¡ÏVïú#Ä¤ÔzÂ; ÀD¾H²Á1¥6D`þYê`÷RÅPÖ>-Æ!\$Ùù³ì×~ÏÐÅà`>Ùï³õhÔ0ô1À¬&\0ÃhëûIwlûZ\$\\\r¡8¶~,\nºo_áÀB2D´a1ê³àÇ©=¢v<ÏkF´p``kBF¶6 ÄÖ²hÆÉT TÖ	@?drÑåJÀH@1°G´dnÁÒwÆ%äÚJGÒ0bðTf]m(Øk´qg\\í½ó¸¬ë°ê ÈÑ3vk'ý^d´¨AXÿ~ÇWVsÂ*¼Ê±æd´ûM À¬@?²ÄÓ}§6\\m9<Î±iÝ§Ô¬h½^s}æ-¦[Ks±qãbÎÓ-öOORm8\$ÞywÄì##°@â·\0ôÒØ¤ 5F7ö¨ X\nÓÀ|JË/-SW!fÇ 0¶,w½¨D4Ù¡RU¥T´îÕðZXÇ=í`W\$@âÔ¥(XG§Òµa>Ö*ûY¶²\n³ü\nì!«[mjµ0,mu¬W@ FXúÚÎòðü=­ (¦ý­b¿ý<!\n\"ª83Ã'¦(RÝ\n>ù@¨W¦r!L£HÅkÌ\rE\nWÆÞ\r¢'FH\$£ääÀmÈ=ÔÛ¥{LY&ÑÜ£_\0ÆüÝ#¢ä[9\0¤\"ÔÒ@8ÄiKª¹ö0ÙlÑÐp\ngîÛ'qbFØyá«cl@9Û(#JU«Ý²{io­¥.{ÔÍ³4ÞVÍVnFÉxðÑüzÎ QàÞ\$kSa~Ê¨0s@£À«%y@À5HNÎÍ¦´@x#	Ü« /\\¥Ö?<hÚù¼IT :3Ã\n%¸");}else{header("Content-Type: image/gif");switch($_GET["file"]){case"plus.gif":echo"GIF89a\0\0\0001îîî\0\0\0\0\0!ù\0\0\0,\0\0\0\0\0\0!©ËíMñÌ*)¾oú¯) q¡eµî#ÄòLË\0;";break;case"cross.gif":echo"GIF89a\0\0\0001îîî\0\0\0\0\0!ù\0\0\0,\0\0\0\0\0\0#©Ëí#\naÖFo~yÃ._waá1ç±JîGÂL×6]\0\0;";break;case"up.gif":echo"GIF89a\0\0\0001îîî\0\0\0\0\0!ù\0\0\0,\0\0\0\0\0\0 ©ËíMQN\nï}ôa8yaÅ¶®\0Çò\0;";break;case"down.gif":echo"GIF89a\0\0\0001îîî\0\0\0\0\0!ù\0\0\0,\0\0\0\0\0\0 ©ËíMñÌ*)¾[Wþ\\¢ÇL&ÙÆ¶\0Çò\0;";break;case"arrow.gif":echo"GIF89a\0\n\0\0\0ÿÿÿ!ù\0\0\0,\0\0\0\0\0\n\0\0i±ªÓ²Þ»\0\0;";break;}}exit;}if($_GET["script"]=="version"){$gd=file_open_lock(get_temp_dir()."/adminer.version");if($gd)file_write_unlock($gd,serialize(array("signature"=>$_POST["signature"],"version"=>$_POST["version"])));exit;}global$b,$g,$n,$cc,$kc,$uc,$o,$id,$od,$ba,$Pd,$y,$ca,$ke,$nf,$Yf,$Fh,$td,$mi,$si,$U,$Gi,$ia;if(!$_SERVER["REQUEST_URI"])$_SERVER["REQUEST_URI"]=$_SERVER["ORIG_PATH_INFO"];if(!strpos($_SERVER["REQUEST_URI"],'?')&&$_SERVER["QUERY_STRING"]!="")$_SERVER["REQUEST_URI"].="?$_SERVER[QUERY_STRING]";if($_SERVER["HTTP_X_FORWARDED_PREFIX"])$_SERVER["REQUEST_URI"]=$_SERVER["HTTP_X_FORWARDED_PREFIX"].$_SERVER["REQUEST_URI"];$ba=($_SERVER["HTTPS"]&&strcasecmp($_SERVER["HTTPS"],"off"))||ini_bool("session.cookie_secure");@ini_set("session.use_trans_sid",false);if(!defined("SID")){session_cache_limiter("");session_name("adminer_sid");$Lf=array(0,preg_replace('~\?.*~','',$_SERVER["REQUEST_URI"]),"",$ba);if(version_compare(PHP_VERSION,'5.2.0')>=0)$Lf[]=true;call_user_func_array('session_set_cookie_params',$Lf);session_start();}remove_slashes(array(&$_GET,&$_POST,&$_COOKIE),$Tc);if(get_magic_quotes_runtime())set_magic_quotes_runtime(false);@set_time_limit(0);@ini_set("zend.ze1_compatibility_mode",false);@ini_set("precision",15);function
get_lang(){return'en';}function
lang($ri,$ef=null){if(is_array($ri)){$bg=($ef==1?0:1);$ri=$ri[$bg];}$ri=str_replace("%d","%s",$ri);$ef=format_number($ef);return
sprintf($ri,$ef);}if(extension_loaded('pdo')){class
Min_PDO
extends
PDO{var$_result,$server_info,$affected_rows,$errno,$error;function
__construct(){global$b;$bg=array_search("SQL",$b->operators);if($bg!==false)unset($b->operators[$bg]);}function
dsn($hc,$V,$F,$vf=array()){try{parent::__construct($hc,$V,$F,$vf);}catch(Exception$zc){auth_error(h($zc->getMessage()));}$this->setAttribute(13,array('Min_PDOStatement'));$this->server_info=@$this->getAttribute(4);}function
query($G,$Ai=false){$H=parent::query($G);$this->error="";if(!$H){list(,$this->errno,$this->error)=$this->errorInfo();if(!$this->error)$this->error='Unknown error.';return
false;}$this->store_result($H);return$H;}function
multi_query($G){return$this->_result=$this->query($G);}function
store_result($H=null){if(!$H){$H=$this->_result;if(!$H)return
false;}if($H->columnCount()){$H->num_rows=$H->rowCount();return$H;}$this->affected_rows=$H->rowCount();return
true;}function
next_result(){if(!$this->_result)return
false;$this->_result->_offset=0;return@$this->_result->nextRowset();}function
result($G,$p=0){$H=$this->query($G);if(!$H)return
false;$J=$H->fetch();return$J[$p];}}class
Min_PDOStatement
extends
PDOStatement{var$_offset=0,$num_rows;function
fetch_assoc(){return$this->fetch(2);}function
fetch_row(){return$this->fetch(3);}function
fetch_field(){$J=(object)$this->getColumnMeta($this->_offset++);$J->orgtable=$J->table;$J->orgname=$J->name;$J->charsetnr=(in_array("blob",(array)$J->flags)?63:0);return$J;}}}$cc=array();class
Min_SQL{var$_conn;function
__construct($g){$this->_conn=$g;}function
select($Q,$L,$Z,$ld,$xf=array(),$_=1,$E=0,$jg=false){global$b,$y;$Wd=(count($ld)<count($L));$G=$b->selectQueryBuild($L,$Z,$ld,$xf,$_,$E);if(!$G)$G="SELECT".limit(($_GET["page"]!="last"&&$_!=""&&$ld&&$Wd&&$y=="sql"?"SQL_CALC_FOUND_ROWS ":"").implode(", ",$L)."\nFROM ".table($Q),($Z?"\nWHERE ".implode(" AND ",$Z):"").($ld&&$Wd?"\nGROUP BY ".implode(", ",$ld):"").($xf?"\nORDER BY ".implode(", ",$xf):""),($_!=""?+$_:null),($E?$_*$E:0),"\n");$Ah=microtime(true);$I=$this->_conn->query($G);if($jg)echo$b->selectQuery($G,$Ah,!$I);return$I;}function
delete($Q,$tg,$_=0){$G="FROM ".table($Q);return
queries("DELETE".($_?limit1($Q,$G,$tg):" $G$tg"));}function
update($Q,$O,$tg,$_=0,$M="\n"){$Si=array();foreach($O
as$z=>$X)$Si[]="$z = $X";$G=table($Q)." SET$M".implode(",$M",$Si);return
queries("UPDATE".($_?limit1($Q,$G,$tg,$M):" $G$tg"));}function
insert($Q,$O){return
queries("INSERT INTO ".table($Q).($O?" (".implode(", ",array_keys($O)).")\nVALUES (".implode(", ",$O).")":" DEFAULT VALUES"));}function
insertUpdate($Q,$K,$hg){return
false;}function
begin(){return
queries("BEGIN");}function
commit(){return
queries("COMMIT");}function
rollback(){return
queries("ROLLBACK");}function
slowQuery($G,$di){}function
convertSearch($v,$X,$p){return$v;}function
value($X,$p){return(method_exists($this->_conn,'value')?$this->_conn->value($X,$p):(is_resource($X)?stream_get_contents($X):$X));}function
quoteBinary($Vg){return
q($Vg);}function
warnings(){return'';}function
tableHelp($C){}}$cc["sqlite"]="SQLite 3";$cc["sqlite2"]="SQLite 2";if(isset($_GET["sqlite"])||isset($_GET["sqlite2"])){$eg=array((isset($_GET["sqlite"])?"SQLite3":"SQLite"),"PDO_SQLite");define("DRIVER",(isset($_GET["sqlite"])?"sqlite":"sqlite2"));if(class_exists(isset($_GET["sqlite"])?"SQLite3":"SQLiteDatabase")){if(isset($_GET["sqlite"])){class
Min_SQLite{var$extension="SQLite3",$server_info,$affected_rows,$errno,$error,$_link;function
__construct($Sc){$this->_link=new
SQLite3($Sc);$Vi=$this->_link->version();$this->server_info=$Vi["versionString"];}function
query($G){$H=@$this->_link->query($G);$this->error="";if(!$H){$this->errno=$this->_link->lastErrorCode();$this->error=$this->_link->lastErrorMsg();return
false;}elseif($H->numColumns())return
new
Min_Result($H);$this->affected_rows=$this->_link->changes();return
true;}function
quote($P){return(is_utf8($P)?"'".$this->_link->escapeString($P)."'":"x'".reset(unpack('H*',$P))."'");}function
store_result(){return$this->_result;}function
result($G,$p=0){$H=$this->query($G);if(!is_object($H))return
false;$J=$H->_result->fetchArray();return$J[$p];}}class
Min_Result{var$_result,$_offset=0,$num_rows;function
__construct($H){$this->_result=$H;}function
fetch_assoc(){return$this->_result->fetchArray(SQLITE3_ASSOC);}function
fetch_row(){return$this->_result->fetchArray(SQLITE3_NUM);}function
fetch_field(){$e=$this->_offset++;$T=$this->_result->columnType($e);return(object)array("name"=>$this->_result->columnName($e),"type"=>$T,"charsetnr"=>($T==SQLITE3_BLOB?63:0),);}function
__desctruct(){return$this->_result->finalize();}}}else{class
Min_SQLite{var$extension="SQLite",$server_info,$affected_rows,$error,$_link;function
__construct($Sc){$this->server_info=sqlite_libversion();$this->_link=new
SQLiteDatabase($Sc);}function
query($G,$Ai=false){$Pe=($Ai?"unbufferedQuery":"query");$H=@$this->_link->$Pe($G,SQLITE_BOTH,$o);$this->error="";if(!$H){$this->error=$o;return
false;}elseif($H===true){$this->affected_rows=$this->changes();return
true;}return
new
Min_Result($H);}function
quote($P){return"'".sqlite_escape_string($P)."'";}function
store_result(){return$this->_result;}function
result($G,$p=0){$H=$this->query($G);if(!is_object($H))return
false;$J=$H->_result->fetch();return$J[$p];}}class
Min_Result{var$_result,$_offset=0,$num_rows;function
__construct($H){$this->_result=$H;if(method_exists($H,'numRows'))$this->num_rows=$H->numRows();}function
fetch_assoc(){$J=$this->_result->fetch(SQLITE_ASSOC);if(!$J)return
false;$I=array();foreach($J
as$z=>$X)$I[($z[0]=='"'?idf_unescape($z):$z)]=$X;return$I;}function
fetch_row(){return$this->_result->fetch(SQLITE_NUM);}function
fetch_field(){$C=$this->_result->fieldName($this->_offset++);$Xf='(\[.*]|"(?:[^"]|"")*"|(.+))';if(preg_match("~^($Xf\\.)?$Xf\$~",$C,$B)){$Q=($B[3]!=""?$B[3]:idf_unescape($B[2]));$C=($B[5]!=""?$B[5]:idf_unescape($B[4]));}return(object)array("name"=>$C,"orgname"=>$C,"orgtable"=>$Q,);}}}}elseif(extension_loaded("pdo_sqlite")){class
Min_SQLite
extends
Min_PDO{var$extension="PDO_SQLite";function
__construct($Sc){$this->dsn(DRIVER.":$Sc","","");}}}if(class_exists("Min_SQLite")){class
Min_DB
extends
Min_SQLite{function
__construct(){parent::__construct(":memory:");$this->query("PRAGMA foreign_keys = 1");}function
select_db($Sc){if(is_readable($Sc)&&$this->query("ATTACH ".$this->quote(preg_match("~(^[/\\\\]|:)~",$Sc)?$Sc:dirname($_SERVER["SCRIPT_FILENAME"])."/$Sc")." AS a")){parent::__construct($Sc);$this->query("PRAGMA foreign_keys = 1");return
true;}return
false;}function
multi_query($G){return$this->_result=$this->query($G);}function
next_result(){return
false;}}}class
Min_Driver
extends
Min_SQL{function
insertUpdate($Q,$K,$hg){$Si=array();foreach($K
as$O)$Si[]="(".implode(", ",$O).")";return
queries("REPLACE INTO ".table($Q)." (".implode(", ",array_keys(reset($K))).") VALUES\n".implode(",\n",$Si));}function
tableHelp($C){if($C=="sqlite_sequence")return"fileformat2.html#seqtab";if($C=="sqlite_master")return"fileformat2.html#$C";}}function
idf_escape($v){return'"'.str_replace('"','""',$v).'"';}function
table($v){return
idf_escape($v);}function
connect(){global$b;list(,,$F)=$b->credentials();if($F!="")return'Database does not support password.';return
new
Min_DB;}function
get_databases(){return
array();}function
limit($G,$Z,$_,$D=0,$M=" "){return" $G$Z".($_!==null?$M."LIMIT $_".($D?" OFFSET $D":""):"");}function
limit1($Q,$G,$Z,$M="\n"){global$g;return(preg_match('~^INTO~',$G)||$g->result("SELECT sqlite_compileoption_used('ENABLE_UPDATE_DELETE_LIMIT')")?limit($G,$Z,1,0,$M):" $G WHERE rowid = (SELECT rowid FROM ".table($Q).$Z.$M."LIMIT 1)");}function
db_collation($m,$ob){global$g;return$g->result("PRAGMA encoding");}function
engines(){return
array();}function
logged_user(){return
get_current_user();}function
tables_list(){return
get_key_vals("SELECT name, type FROM sqlite_master WHERE type IN ('table', 'view') ORDER BY (name = 'sqlite_sequence'), name");}function
count_tables($l){return
array();}function
table_status($C=""){global$g;$I=array();foreach(get_rows("SELECT name AS Name, type AS Engine, 'rowid' AS Oid, '' AS Auto_increment FROM sqlite_master WHERE type IN ('table', 'view') ".($C!=""?"AND name = ".q($C):"ORDER BY name"))as$J){$J["Rows"]=$g->result("SELECT COUNT(*) FROM ".idf_escape($J["Name"]));$I[$J["Name"]]=$J;}foreach(get_rows("SELECT * FROM sqlite_sequence",null,"")as$J)$I[$J["name"]]["Auto_increment"]=$J["seq"];return($C!=""?$I[$C]:$I);}function
is_view($R){return$R["Engine"]=="view";}function
fk_support($R){global$g;return!$g->result("SELECT sqlite_compileoption_used('OMIT_FOREIGN_KEY')");}function
fields($Q){global$g;$I=array();$hg="";foreach(get_rows("PRAGMA table_info(".table($Q).")")as$J){$C=$J["name"];$T=strtolower($J["type"]);$Qb=$J["dflt_value"];$I[$C]=array("field"=>$C,"type"=>(preg_match('~int~i',$T)?"integer":(preg_match('~char|clob|text~i',$T)?"text":(preg_match('~blob~i',$T)?"blob":(preg_match('~real|floa|doub~i',$T)?"real":"numeric")))),"full_type"=>$T,"default"=>(preg_match("~'(.*)'~",$Qb,$B)?str_replace("''","'",$B[1]):($Qb=="NULL"?null:$Qb)),"null"=>!$J["notnull"],"privileges"=>array("select"=>1,"insert"=>1,"update"=>1),"primary"=>$J["pk"],);if($J["pk"]){if($hg!="")$I[$hg]["auto_increment"]=false;elseif(preg_match('~^integer$~i',$T))$I[$C]["auto_increment"]=true;$hg=$C;}}$wh=$g->result("SELECT sql FROM sqlite_master WHERE type = 'table' AND name = ".q($Q));preg_match_all('~(("[^"]*+")+|[a-z0-9_]+)\s+text\s+COLLATE\s+(\'[^\']+\'|\S+)~i',$wh,$Be,PREG_SET_ORDER);foreach($Be
as$B){$C=str_replace('""','"',preg_replace('~^"|"$~','',$B[1]));if($I[$C])$I[$C]["collation"]=trim($B[3],"'");}return$I;}function
indexes($Q,$h=null){global$g;if(!is_object($h))$h=$g;$I=array();$wh=$h->result("SELECT sql FROM sqlite_master WHERE type = 'table' AND name = ".q($Q));if(preg_match('~\bPRIMARY\s+KEY\s*\((([^)"]+|"[^"]*"|`[^`]*`)++)~i',$wh,$B)){$I[""]=array("type"=>"PRIMARY","columns"=>array(),"lengths"=>array(),"descs"=>array());preg_match_all('~((("[^"]*+")+|(?:`[^`]*+`)+)|(\S+))(\s+(ASC|DESC))?(,\s*|$)~i',$B[1],$Be,PREG_SET_ORDER);foreach($Be
as$B){$I[""]["columns"][]=idf_unescape($B[2]).$B[4];$I[""]["descs"][]=(preg_match('~DESC~i',$B[5])?'1':null);}}if(!$I){foreach(fields($Q)as$C=>$p){if($p["primary"])$I[""]=array("type"=>"PRIMARY","columns"=>array($C),"lengths"=>array(),"descs"=>array(null));}}$zh=get_key_vals("SELECT name, sql FROM sqlite_master WHERE type = 'index' AND tbl_name = ".q($Q),$h);foreach(get_rows("PRAGMA index_list(".table($Q).")",$h)as$J){$C=$J["name"];$w=array("type"=>($J["unique"]?"UNIQUE":"INDEX"));$w["lengths"]=array();$w["descs"]=array();foreach(get_rows("PRAGMA index_info(".idf_escape($C).")",$h)as$Ug){$w["columns"][]=$Ug["name"];$w["descs"][]=null;}if(preg_match('~^CREATE( UNIQUE)? INDEX '.preg_quote(idf_escape($C).' ON '.idf_escape($Q),'~').' \((.*)\)$~i',$zh[$C],$Eg)){preg_match_all('/("[^"]*+")+( DESC)?/',$Eg[2],$Be);foreach($Be[2]as$z=>$X){if($X)$w["descs"][$z]='1';}}if(!$I[""]||$w["type"]!="UNIQUE"||$w["columns"]!=$I[""]["columns"]||$w["descs"]!=$I[""]["descs"]||!preg_match("~^sqlite_~",$C))$I[$C]=$w;}return$I;}function
foreign_keys($Q){$I=array();foreach(get_rows("PRAGMA foreign_key_list(".table($Q).")")as$J){$r=&$I[$J["id"]];if(!$r)$r=$J;$r["source"][]=$J["from"];$r["target"][]=$J["to"];}return$I;}function
view($C){global$g;return
array("select"=>preg_replace('~^(?:[^`"[]+|`[^`]*`|"[^"]*")* AS\s+~iU','',$g->result("SELECT sql FROM sqlite_master WHERE name = ".q($C))));}function
collations(){return(isset($_GET["create"])?get_vals("PRAGMA collation_list",1):array());}function
information_schema($m){return
false;}function
error(){global$g;return
h($g->error);}function
check_sqlite_name($C){global$g;$Ic="db|sdb|sqlite";if(!preg_match("~^[^\\0]*\\.($Ic)\$~",$C)){$g->error=sprintf('Please use one of the extensions %s.',str_replace("|",", ",$Ic));return
false;}return
true;}function
create_database($m,$d){global$g;if(file_exists($m)){$g->error='File exists.';return
false;}if(!check_sqlite_name($m))return
false;try{$A=new
Min_SQLite($m);}catch(Exception$zc){$g->error=$zc->getMessage();return
false;}$A->query('PRAGMA encoding = "UTF-8"');$A->query('CREATE TABLE adminer (i)');$A->query('DROP TABLE adminer');return
true;}function
drop_databases($l){global$g;$g->__construct(":memory:");foreach($l
as$m){if(!@unlink($m)){$g->error='File exists.';return
false;}}return
true;}function
rename_database($C,$d){global$g;if(!check_sqlite_name($C))return
false;$g->__construct(":memory:");$g->error='File exists.';return@rename(DB,$C);}function
auto_increment(){return" PRIMARY KEY".(DRIVER=="sqlite"?" AUTOINCREMENT":"");}function
alter_table($Q,$C,$q,$ad,$tb,$sc,$d,$La,$Rf){$Mi=($Q==""||$ad);foreach($q
as$p){if($p[0]!=""||!$p[1]||$p[2]){$Mi=true;break;}}$c=array();$Ff=array();foreach($q
as$p){if($p[1]){$c[]=($Mi?$p[1]:"ADD ".implode($p[1]));if($p[0]!="")$Ff[$p[0]]=$p[1][0];}}if(!$Mi){foreach($c
as$X){if(!queries("ALTER TABLE ".table($Q)." $X"))return
false;}if($Q!=$C&&!queries("ALTER TABLE ".table($Q)." RENAME TO ".table($C)))return
false;}elseif(!recreate_table($Q,$C,$c,$Ff,$ad))return
false;if($La)queries("UPDATE sqlite_sequence SET seq = $La WHERE name = ".q($C));return
true;}function
recreate_table($Q,$C,$q,$Ff,$ad,$x=array()){if($Q!=""){if(!$q){foreach(fields($Q)as$z=>$p){if($x)$p["auto_increment"]=0;$q[]=process_field($p,$p);$Ff[$z]=idf_escape($z);}}$ig=false;foreach($q
as$p){if($p[6])$ig=true;}$fc=array();foreach($x
as$z=>$X){if($X[2]=="DROP"){$fc[$X[1]]=true;unset($x[$z]);}}foreach(indexes($Q)as$ee=>$w){$f=array();foreach($w["columns"]as$z=>$e){if(!$Ff[$e])continue
2;$f[]=$Ff[$e].($w["descs"][$z]?" DESC":"");}if(!$fc[$ee]){if($w["type"]!="PRIMARY"||!$ig)$x[]=array($w["type"],$ee,$f);}}foreach($x
as$z=>$X){if($X[0]=="PRIMARY"){unset($x[$z]);$ad[]="  PRIMARY KEY (".implode(", ",$X[2]).")";}}foreach(foreign_keys($Q)as$ee=>$r){foreach($r["source"]as$z=>$e){if(!$Ff[$e])continue
2;$r["source"][$z]=idf_unescape($Ff[$e]);}if(!isset($ad[" $ee"]))$ad[]=" ".format_foreign_key($r);}queries("BEGIN");}foreach($q
as$z=>$p)$q[$z]="  ".implode($p);$q=array_merge($q,array_filter($ad));if(!queries("CREATE TABLE ".table($Q!=""?"adminer_$C":$C)." (\n".implode(",\n",$q)."\n)"))return
false;if($Q!=""){if($Ff&&!queries("INSERT INTO ".table("adminer_$C")." (".implode(", ",$Ff).") SELECT ".implode(", ",array_map('idf_escape',array_keys($Ff)))." FROM ".table($Q)))return
false;$yi=array();foreach(triggers($Q)as$wi=>$ei){$vi=trigger($wi);$yi[]="CREATE TRIGGER ".idf_escape($wi)." ".implode(" ",$ei)." ON ".table($C)."\n$vi[Statement]";}if(!queries("DROP TABLE ".table($Q)))return
false;queries("ALTER TABLE ".table("adminer_$C")." RENAME TO ".table($C));if(!alter_indexes($C,$x))return
false;foreach($yi
as$vi){if(!queries($vi))return
false;}queries("COMMIT");}return
true;}function
index_sql($Q,$T,$C,$f){return"CREATE $T ".($T!="INDEX"?"INDEX ":"").idf_escape($C!=""?$C:uniqid($Q."_"))." ON ".table($Q)." $f";}function
alter_indexes($Q,$c){foreach($c
as$hg){if($hg[0]=="PRIMARY")return
recreate_table($Q,$Q,array(),array(),array(),$c);}foreach(array_reverse($c)as$X){if(!queries($X[2]=="DROP"?"DROP INDEX ".idf_escape($X[1]):index_sql($Q,$X[0],$X[1],"(".implode(", ",$X[2]).")")))return
false;}return
true;}function
truncate_tables($S){return
apply_queries("DELETE FROM",$S);}function
drop_views($Xi){return
apply_queries("DROP VIEW",$Xi);}function
drop_tables($S){return
apply_queries("DROP TABLE",$S);}function
move_tables($S,$Xi,$Vh){return
false;}function
trigger($C){global$g;if($C=="")return
array("Statement"=>"BEGIN\n\t;\nEND");$v='(?:[^`"\s]+|`[^`]*`|"[^"]*")+';$xi=trigger_options();preg_match("~^CREATE\\s+TRIGGER\\s*$v\\s*(".implode("|",$xi["Timing"]).")\\s+([a-z]+)(?:\\s+OF\\s+($v))?\\s+ON\\s*$v\\s*(?:FOR\\s+EACH\\s+ROW\\s)?(.*)~is",$g->result("SELECT sql FROM sqlite_master WHERE type = 'trigger' AND name = ".q($C)),$B);$gf=$B[3];return
array("Timing"=>strtoupper($B[1]),"Event"=>strtoupper($B[2]).($gf?" OF":""),"Of"=>($gf[0]=='`'||$gf[0]=='"'?idf_unescape($gf):$gf),"Trigger"=>$C,"Statement"=>$B[4],);}function
triggers($Q){$I=array();$xi=trigger_options();foreach(get_rows("SELECT * FROM sqlite_master WHERE type = 'trigger' AND tbl_name = ".q($Q))as$J){preg_match('~^CREATE\s+TRIGGER\s*(?:[^`"\s]+|`[^`]*`|"[^"]*")+\s*('.implode("|",$xi["Timing"]).')\s*(.*)\s+ON\b~iU',$J["sql"],$B);$I[$J["name"]]=array($B[1],$B[2]);}return$I;}function
trigger_options(){return
array("Timing"=>array("BEFORE","AFTER","INSTEAD OF"),"Event"=>array("INSERT","UPDATE","UPDATE OF","DELETE"),"Type"=>array("FOR EACH ROW"),);}function
begin(){return
queries("BEGIN");}function
last_id(){global$g;return$g->result("SELECT LAST_INSERT_ROWID()");}function
explain($g,$G){return$g->query("EXPLAIN QUERY PLAN $G");}function
found_rows($R,$Z){}function
types(){return
array();}function
schemas(){return
array();}function
get_schema(){return"";}function
set_schema($Yg){return
true;}function
create_sql($Q,$La,$Gh){global$g;$I=$g->result("SELECT sql FROM sqlite_master WHERE type IN ('table', 'view') AND name = ".q($Q));foreach(indexes($Q)as$C=>$w){if($C=='')continue;$I.=";\n\n".index_sql($Q,$w['type'],$C,"(".implode(", ",array_map('idf_escape',$w['columns'])).")");}return$I;}function
truncate_sql($Q){return"DELETE FROM ".table($Q);}function
use_sql($k){}function
trigger_sql($Q){return
implode(get_vals("SELECT sql || ';;\n' FROM sqlite_master WHERE type = 'trigger' AND tbl_name = ".q($Q)));}function
show_variables(){global$g;$I=array();foreach(array("auto_vacuum","cache_size","count_changes","default_cache_size","empty_result_callbacks","encoding","foreign_keys","full_column_names","fullfsync","journal_mode","journal_size_limit","legacy_file_format","locking_mode","page_size","max_page_count","read_uncommitted","recursive_triggers","reverse_unordered_selects","secure_delete","short_column_names","synchronous","temp_store","temp_store_directory","schema_version","integrity_check","quick_check")as$z)$I[$z]=$g->result("PRAGMA $z");return$I;}function
show_status(){$I=array();foreach(get_vals("PRAGMA compile_options")as$uf){list($z,$X)=explode("=",$uf,2);$I[$z]=$X;}return$I;}function
convert_field($p){}function
unconvert_field($p,$I){return$I;}function
support($Nc){return
preg_match('~^(columns|database|drop_col|dump|indexes|descidx|move_col|sql|status|table|trigger|variables|view|view_trigger)$~',$Nc);}$y="sqlite";$U=array("integer"=>0,"real"=>0,"numeric"=>0,"text"=>0,"blob"=>0);$Fh=array_keys($U);$Gi=array();$sf=array("=","<",">","<=",">=","!=","LIKE","LIKE %%","IN","IS NULL","NOT LIKE","NOT IN","IS NOT NULL","SQL");$id=array("hex","length","lower","round","unixepoch","upper");$od=array("avg","count","count distinct","group_concat","max","min","sum");$kc=array(array(),array("integer|real|numeric"=>"+/-","text"=>"||",));}$cc["pgsql"]="PostgreSQL";if(isset($_GET["pgsql"])){$eg=array("PgSQL","PDO_PgSQL");define("DRIVER","pgsql");if(extension_loaded("pgsql")){class
Min_DB{var$extension="PgSQL",$_link,$_result,$_string,$_database=true,$server_info,$affected_rows,$error,$timeout;function
_error($vc,$o){if(ini_bool("html_errors"))$o=html_entity_decode(strip_tags($o));$o=preg_replace('~^[^:]*: ~','',$o);$this->error=$o;}function
connect($N,$V,$F){global$b;$m=$b->database();set_error_handler(array($this,'_error'));$this->_string="host='".str_replace(":","' port='",addcslashes($N,"'\\"))."' user='".addcslashes($V,"'\\")."' password='".addcslashes($F,"'\\")."'";$this->_link=@pg_connect("$this->_string dbname='".($m!=""?addcslashes($m,"'\\"):"postgres")."'",PGSQL_CONNECT_FORCE_NEW);if(!$this->_link&&$m!=""){$this->_database=false;$this->_link=@pg_connect("$this->_string dbname='postgres'",PGSQL_CONNECT_FORCE_NEW);}restore_error_handler();if($this->_link){$Vi=pg_version($this->_link);$this->server_info=$Vi["server"];pg_set_client_encoding($this->_link,"UTF8");}return(bool)$this->_link;}function
quote($P){return"'".pg_escape_string($this->_link,$P)."'";}function
value($X,$p){return($p["type"]=="bytea"?pg_unescape_bytea($X):$X);}function
quoteBinary($P){return"'".pg_escape_bytea($this->_link,$P)."'";}function
select_db($k){global$b;if($k==$b->database())return$this->_database;$I=@pg_connect("$this->_string dbname='".addcslashes($k,"'\\")."'",PGSQL_CONNECT_FORCE_NEW);if($I)$this->_link=$I;return$I;}function
close(){$this->_link=@pg_connect("$this->_string dbname='postgres'");}function
query($G,$Ai=false){$H=@pg_query($this->_link,$G);$this->error="";if(!$H){$this->error=pg_last_error($this->_link);$I=false;}elseif(!pg_num_fields($H)){$this->affected_rows=pg_affected_rows($H);$I=true;}else$I=new
Min_Result($H);if($this->timeout){$this->timeout=0;$this->query("RESET statement_timeout");}return$I;}function
multi_query($G){return$this->_result=$this->query($G);}function
store_result(){return$this->_result;}function
next_result(){return
false;}function
result($G,$p=0){$H=$this->query($G);if(!$H||!$H->num_rows)return
false;return
pg_fetch_result($H->_result,0,$p);}function
warnings(){return
h(pg_last_notice($this->_link));}}class
Min_Result{var$_result,$_offset=0,$num_rows;function
__construct($H){$this->_result=$H;$this->num_rows=pg_num_rows($H);}function
fetch_assoc(){return
pg_fetch_assoc($this->_result);}function
fetch_row(){return
pg_fetch_row($this->_result);}function
fetch_field(){$e=$this->_offset++;$I=new
stdClass;if(function_exists('pg_field_table'))$I->orgtable=pg_field_table($this->_result,$e);$I->name=pg_field_name($this->_result,$e);$I->orgname=$I->name;$I->type=pg_field_type($this->_result,$e);$I->charsetnr=($I->type=="bytea"?63:0);return$I;}function
__destruct(){pg_free_result($this->_result);}}}elseif(extension_loaded("pdo_pgsql")){class
Min_DB
extends
Min_PDO{var$extension="PDO_PgSQL",$timeout;function
connect($N,$V,$F){global$b;$m=$b->database();$P="pgsql:host='".str_replace(":","' port='",addcslashes($N,"'\\"))."' options='-c client_encoding=utf8'";$this->dsn("$P dbname='".($m!=""?addcslashes($m,"'\\"):"postgres")."'",$V,$F);return
true;}function
select_db($k){global$b;return($b->database()==$k);}function
quoteBinary($Vg){return
q($Vg);}function
query($G,$Ai=false){$I=parent::query($G,$Ai);if($this->timeout){$this->timeout=0;parent::query("RESET statement_timeout");}return$I;}function
warnings(){return'';}function
close(){}}}class
Min_Driver
extends
Min_SQL{function
insertUpdate($Q,$K,$hg){global$g;foreach($K
as$O){$Hi=array();$Z=array();foreach($O
as$z=>$X){$Hi[]="$z = $X";if(isset($hg[idf_unescape($z)]))$Z[]="$z = $X";}if(!(($Z&&queries("UPDATE ".table($Q)." SET ".implode(", ",$Hi)." WHERE ".implode(" AND ",$Z))&&$g->affected_rows)||queries("INSERT INTO ".table($Q)." (".implode(", ",array_keys($O)).") VALUES (".implode(", ",$O).")")))return
false;}return
true;}function
slowQuery($G,$di){$this->_conn->query("SET statement_timeout = ".(1000*$di));$this->_conn->timeout=1000*$di;return$G;}function
convertSearch($v,$X,$p){return(preg_match('~char|text'.(!preg_match('~LIKE~',$X["op"])?'|date|time(stamp)?|boolean|uuid|'.number_type():'').'~',$p["type"])?$v:"CAST($v AS text)");}function
quoteBinary($Vg){return$this->_conn->quoteBinary($Vg);}function
warnings(){return$this->_conn->warnings();}function
tableHelp($C){$ue=array("information_schema"=>"infoschema","pg_catalog"=>"catalog",);$A=$ue[$_GET["ns"]];if($A)return"$A-".str_replace("_","-",$C).".html";}}function
idf_escape($v){return'"'.str_replace('"','""',$v).'"';}function
table($v){return
idf_escape($v);}function
connect(){global$b,$U,$Fh;$g=new
Min_DB;$j=$b->credentials();if($g->connect($j[0],$j[1],$j[2])){if(min_version(9,0,$g)){$g->query("SET application_name = 'Adminer'");if(min_version(9.2,0,$g)){$Fh['Strings'][]="json";$U["json"]=4294967295;if(min_version(9.4,0,$g)){$Fh['Strings'][]="jsonb";$U["jsonb"]=4294967295;}}}return$g;}return$g->error;}function
get_databases(){return
get_vals("SELECT datname FROM pg_database WHERE has_database_privilege(datname, 'CONNECT') ORDER BY datname");}function
limit($G,$Z,$_,$D=0,$M=" "){return" $G$Z".($_!==null?$M."LIMIT $_".($D?" OFFSET $D":""):"");}function
limit1($Q,$G,$Z,$M="\n"){return(preg_match('~^INTO~',$G)?limit($G,$Z,1,0,$M):" $G".(is_view(table_status1($Q))?$Z:" WHERE ctid = (SELECT ctid FROM ".table($Q).$Z.$M."LIMIT 1)"));}function
db_collation($m,$ob){global$g;return$g->result("SHOW LC_COLLATE");}function
engines(){return
array();}function
logged_user(){global$g;return$g->result("SELECT user");}function
tables_list(){$G="SELECT table_name, table_type FROM information_schema.tables WHERE table_schema = current_schema()";if(support('materializedview'))$G.="
UNION ALL
SELECT matviewname, 'MATERIALIZED VIEW'
FROM pg_matviews
WHERE schemaname = current_schema()";$G.="
ORDER BY 1";return
get_key_vals($G);}function
count_tables($l){return
array();}function
table_status($C=""){$I=array();foreach(get_rows("SELECT c.relname AS \"Name\", CASE c.relkind WHEN 'r' THEN 'table' WHEN 'm' THEN 'materialized view' ELSE 'view' END AS \"Engine\", pg_relation_size(c.oid) AS \"Data_length\", pg_total_relation_size(c.oid) - pg_relation_size(c.oid) AS \"Index_length\", obj_description(c.oid, 'pg_class') AS \"Comment\", CASE WHEN c.relhasoids THEN 'oid' ELSE '' END AS \"Oid\", c.reltuples as \"Rows\", n.nspname
FROM pg_class c
JOIN pg_namespace n ON(n.nspname = current_schema() AND n.oid = c.relnamespace)
WHERE relkind IN ('r', 'm', 'v', 'f')
".($C!=""?"AND relname = ".q($C):"ORDER BY relname"))as$J)$I[$J["Name"]]=$J;return($C!=""?$I[$C]:$I);}function
is_view($R){return
in_array($R["Engine"],array("view","materialized view"));}function
fk_support($R){return
true;}function
fields($Q){$I=array();$Ca=array('timestamp without time zone'=>'timestamp','timestamp with time zone'=>'timestamptz',);$Bd=min_version(10)?"(a.attidentity = 'd')::int":'0';foreach(get_rows("SELECT a.attname AS field, format_type(a.atttypid, a.atttypmod) AS full_type, d.adsrc AS default, a.attnotnull::int, col_description(c.oid, a.attnum) AS comment, $Bd AS identity
FROM pg_class c
JOIN pg_namespace n ON c.relnamespace = n.oid
JOIN pg_attribute a ON c.oid = a.attrelid
LEFT JOIN pg_attrdef d ON c.oid = d.adrelid AND a.attnum = d.adnum
WHERE c.relname = ".q($Q)."
AND n.nspname = current_schema()
AND NOT a.attisdropped
AND a.attnum > 0
ORDER BY a.attnum")as$J){preg_match('~([^([]+)(\((.*)\))?([a-z ]+)?((\[[0-9]*])*)$~',$J["full_type"],$B);list(,$T,$re,$J["length"],$wa,$Fa)=$B;$J["length"].=$Fa;$db=$T.$wa;if(isset($Ca[$db])){$J["type"]=$Ca[$db];$J["full_type"]=$J["type"].$re.$Fa;}else{$J["type"]=$T;$J["full_type"]=$J["type"].$re.$wa.$Fa;}if($J['identity'])$J['default']='GENERATED BY DEFAULT AS IDENTITY';$J["null"]=!$J["attnotnull"];$J["auto_increment"]=$J['identity']||preg_match('~^nextval\(~i',$J["default"]);$J["privileges"]=array("insert"=>1,"select"=>1,"update"=>1);if(preg_match('~(.+)::[^)]+(.*)~',$J["default"],$B))$J["default"]=($B[1]=="NULL"?null:(($B[1][0]=="'"?idf_unescape($B[1]):$B[1]).$B[2]));$I[$J["field"]]=$J;}return$I;}function
indexes($Q,$h=null){global$g;if(!is_object($h))$h=$g;$I=array();$Oh=$h->result("SELECT oid FROM pg_class WHERE relnamespace = (SELECT oid FROM pg_namespace WHERE nspname = current_schema()) AND relname = ".q($Q));$f=get_key_vals("SELECT attnum, attname FROM pg_attribute WHERE attrelid = $Oh AND attnum > 0",$h);foreach(get_rows("SELECT relname, indisunique::int, indisprimary::int, indkey, indoption , (indpred IS NOT NULL)::int as indispartial FROM pg_index i, pg_class ci WHERE i.indrelid = $Oh AND ci.oid = i.indexrelid",$h)as$J){$Fg=$J["relname"];$I[$Fg]["type"]=($J["indispartial"]?"INDEX":($J["indisprimary"]?"PRIMARY":($J["indisunique"]?"UNIQUE":"INDEX")));$I[$Fg]["columns"]=array();foreach(explode(" ",$J["indkey"])as$Ld)$I[$Fg]["columns"][]=$f[$Ld];$I[$Fg]["descs"]=array();foreach(explode(" ",$J["indoption"])as$Md)$I[$Fg]["descs"][]=($Md&1?'1':null);$I[$Fg]["lengths"]=array();}return$I;}function
foreign_keys($Q){global$nf;$I=array();foreach(get_rows("SELECT conname, condeferrable::int AS deferrable, pg_get_constraintdef(oid) AS definition
FROM pg_constraint
WHERE conrelid = (SELECT pc.oid FROM pg_class AS pc INNER JOIN pg_namespace AS pn ON (pn.oid = pc.relnamespace) WHERE pc.relname = ".q($Q)." AND pn.nspname = current_schema())
AND contype = 'f'::char
ORDER BY conkey, conname")as$J){if(preg_match('~FOREIGN KEY\s*\((.+)\)\s*REFERENCES (.+)\((.+)\)(.*)$~iA',$J['definition'],$B)){$J['source']=array_map('trim',explode(',',$B[1]));if(preg_match('~^(("([^"]|"")+"|[^"]+)\.)?"?("([^"]|"")+"|[^"]+)$~',$B[2],$Ae)){$J['ns']=str_replace('""','"',preg_replace('~^"(.+)"$~','\1',$Ae[2]));$J['table']=str_replace('""','"',preg_replace('~^"(.+)"$~','\1',$Ae[4]));}$J['target']=array_map('trim',explode(',',$B[3]));$J['on_delete']=(preg_match("~ON DELETE ($nf)~",$B[4],$Ae)?$Ae[1]:'NO ACTION');$J['on_update']=(preg_match("~ON UPDATE ($nf)~",$B[4],$Ae)?$Ae[1]:'NO ACTION');$I[$J['conname']]=$J;}}return$I;}function
view($C){global$g;return
array("select"=>trim($g->result("SELECT view_definition
FROM information_schema.views
WHERE table_schema = current_schema() AND table_name = ".q($C))));}function
collations(){return
array();}function
information_schema($m){return($m=="information_schema");}function
error(){global$g;$I=h($g->error);if(preg_match('~^(.*\n)?([^\n]*)\n( *)\^(\n.*)?$~s',$I,$B))$I=$B[1].preg_replace('~((?:[^&]|&[^;]*;){'.strlen($B[3]).'})(.*)~','\1<b>\2</b>',$B[2]).$B[4];return
nl_br($I);}function
create_database($m,$d){return
queries("CREATE DATABASE ".idf_escape($m).($d?" ENCODING ".idf_escape($d):""));}function
drop_databases($l){global$g;$g->close();return
apply_queries("DROP DATABASE",$l,'idf_escape');}function
rename_database($C,$d){return
queries("ALTER DATABASE ".idf_escape(DB)." RENAME TO ".idf_escape($C));}function
auto_increment(){return"";}function
alter_table($Q,$C,$q,$ad,$tb,$sc,$d,$La,$Rf){$c=array();$sg=array();foreach($q
as$p){$e=idf_escape($p[0]);$X=$p[1];if(!$X)$c[]="DROP $e";else{$Ri=$X[5];unset($X[5]);if(isset($X[6])&&$p[0]=="")$X[1]=($X[1]=="bigint"?" big":" ")."serial";if($p[0]=="")$c[]=($Q!=""?"ADD ":"  ").implode($X);else{if($e!=$X[0])$sg[]="ALTER TABLE ".table($Q)." RENAME $e TO $X[0]";$c[]="ALTER $e TYPE$X[1]";if(!$X[6]){$c[]="ALTER $e ".($X[3]?"SET$X[3]":"DROP DEFAULT");$c[]="ALTER $e ".($X[2]==" NULL"?"DROP NOT":"SET").$X[2];}}if($p[0]!=""||$Ri!="")$sg[]="COMMENT ON COLUMN ".table($Q).".$X[0] IS ".($Ri!=""?substr($Ri,9):"''");}}$c=array_merge($c,$ad);if($Q=="")array_unshift($sg,"CREATE TABLE ".table($C)." (\n".implode(",\n",$c)."\n)");elseif($c)array_unshift($sg,"ALTER TABLE ".table($Q)."\n".implode(",\n",$c));if($Q!=""&&$Q!=$C)$sg[]="ALTER TABLE ".table($Q)." RENAME TO ".table($C);if($Q!=""||$tb!="")$sg[]="COMMENT ON TABLE ".table($C)." IS ".q($tb);if($La!=""){}foreach($sg
as$G){if(!queries($G))return
false;}return
true;}function
alter_indexes($Q,$c){$i=array();$dc=array();$sg=array();foreach($c
as$X){if($X[0]!="INDEX")$i[]=($X[2]=="DROP"?"\nDROP CONSTRAINT ".idf_escape($X[1]):"\nADD".($X[1]!=""?" CONSTRAINT ".idf_escape($X[1]):"")." $X[0] ".($X[0]=="PRIMARY"?"KEY ":"")."(".implode(", ",$X[2]).")");elseif($X[2]=="DROP")$dc[]=idf_escape($X[1]);else$sg[]="CREATE INDEX ".idf_escape($X[1]!=""?$X[1]:uniqid($Q."_"))." ON ".table($Q)." (".implode(", ",$X[2]).")";}if($i)array_unshift($sg,"ALTER TABLE ".table($Q).implode(",",$i));if($dc)array_unshift($sg,"DROP INDEX ".implode(", ",$dc));foreach($sg
as$G){if(!queries($G))return
false;}return
true;}function
truncate_tables($S){return
queries("TRUNCATE ".implode(", ",array_map('table',$S)));return
true;}function
drop_views($Xi){return
drop_tables($Xi);}function
drop_tables($S){foreach($S
as$Q){$Ch=table_status($Q);if(!queries("DROP ".strtoupper($Ch["Engine"])." ".table($Q)))return
false;}return
true;}function
move_tables($S,$Xi,$Vh){foreach(array_merge($S,$Xi)as$Q){$Ch=table_status($Q);if(!queries("ALTER ".strtoupper($Ch["Engine"])." ".table($Q)." SET SCHEMA ".idf_escape($Vh)))return
false;}return
true;}function
trigger($C,$Q=null){if($C=="")return
array("Statement"=>"EXECUTE PROCEDURE ()");if($Q===null)$Q=$_GET['trigger'];$K=get_rows('SELECT t.trigger_name AS "Trigger", t.action_timing AS "Timing", (SELECT STRING_AGG(event_manipulation, \' OR \') FROM information_schema.triggers WHERE event_object_table = t.event_object_table AND trigger_name = t.trigger_name ) AS "Events", t.event_manipulation AS "Event", \'FOR EACH \' || t.action_orientation AS "Type", t.action_statement AS "Statement" FROM information_schema.triggers t WHERE t.event_object_table = '.q($Q).' AND t.trigger_name = '.q($C));return
reset($K);}function
triggers($Q){$I=array();foreach(get_rows("SELECT * FROM information_schema.triggers WHERE event_object_table = ".q($Q))as$J)$I[$J["trigger_name"]]=array($J["action_timing"],$J["event_manipulation"]);return$I;}function
trigger_options(){return
array("Timing"=>array("BEFORE","AFTER"),"Event"=>array("INSERT","UPDATE","DELETE"),"Type"=>array("FOR EACH ROW","FOR EACH STATEMENT"),);}function
routine($C,$T){$K=get_rows('SELECT routine_definition AS definition, LOWER(external_language) AS language, *
FROM information_schema.routines
WHERE routine_schema = current_schema() AND specific_name = '.q($C));$I=$K[0];$I["returns"]=array("type"=>$I["type_udt_name"]);$I["fields"]=get_rows('SELECT parameter_name AS field, data_type AS type, character_maximum_length AS length, parameter_mode AS inout
FROM information_schema.parameters
WHERE specific_schema = current_schema() AND specific_name = '.q($C).'
ORDER BY ordinal_position');return$I;}function
routines(){return
get_rows('SELECT specific_name AS "SPECIFIC_NAME", routine_type AS "ROUTINE_TYPE", routine_name AS "ROUTINE_NAME", type_udt_name AS "DTD_IDENTIFIER"
FROM information_schema.routines
WHERE routine_schema = current_schema()
ORDER BY SPECIFIC_NAME');}function
routine_languages(){return
get_vals("SELECT LOWER(lanname) FROM pg_catalog.pg_language");}function
routine_id($C,$J){$I=array();foreach($J["fields"]as$p)$I[]=$p["type"];return
idf_escape($C)."(".implode(", ",$I).")";}function
last_id(){return
0;}function
explain($g,$G){return$g->query("EXPLAIN $G");}function
found_rows($R,$Z){global$g;if(preg_match("~ rows=([0-9]+)~",$g->result("EXPLAIN SELECT * FROM ".idf_escape($R["Name"]).($Z?" WHERE ".implode(" AND ",$Z):"")),$Eg))return$Eg[1];return
false;}function
types(){return
get_vals("SELECT typname
FROM pg_type
WHERE typnamespace = (SELECT oid FROM pg_namespace WHERE nspname = current_schema())
AND typtype IN ('b','d','e')
AND typelem = 0");}function
schemas(){return
get_vals("SELECT nspname FROM pg_namespace ORDER BY nspname");}function
get_schema(){global$g;return$g->result("SELECT current_schema()");}function
set_schema($Xg){global$g,$U,$Fh;$I=$g->query("SET search_path TO ".idf_escape($Xg));foreach(types()as$T){if(!isset($U[$T])){$U[$T]=0;$Fh['User types'][]=$T;}}return$I;}function
create_sql($Q,$La,$Gh){global$g;$I='';$Ng=array();$hh=array();$Ch=table_status($Q);$q=fields($Q);$x=indexes($Q);ksort($x);$Xc=foreign_keys($Q);ksort($Xc);if(!$Ch||empty($q))return
false;$I="CREATE TABLE ".idf_escape($Ch['nspname']).".".idf_escape($Ch['Name'])." (\n    ";foreach($q
as$Pc=>$p){$Of=idf_escape($p['field']).' '.$p['full_type'].default_value($p).($p['attnotnull']?" NOT NULL":"");$Ng[]=$Of;if(preg_match('~nextval\(\'([^\']+)\'\)~',$p['default'],$Be)){$gh=$Be[1];$vh=reset(get_rows(min_version(10)?"SELECT *, cache_size AS cache_value FROM pg_sequences WHERE schemaname = current_schema() AND sequencename = ".q($gh):"SELECT * FROM $gh"));$hh[]=($Gh=="DROP+CREATE"?"DROP SEQUENCE IF EXISTS $gh;\n":"")."CREATE SEQUENCE $gh INCREMENT $vh[increment_by] MINVALUE $vh[min_value] MAXVALUE $vh[max_value] START ".($La?$vh['last_value']:1)." CACHE $vh[cache_value];";}}if(!empty($hh))$I=implode("\n\n",$hh)."\n\n$I";foreach($x
as$Gd=>$w){switch($w['type']){case'UNIQUE':$Ng[]="CONSTRAINT ".idf_escape($Gd)." UNIQUE (".implode(', ',array_map('idf_escape',$w['columns'])).")";break;case'PRIMARY':$Ng[]="CONSTRAINT ".idf_escape($Gd)." PRIMARY KEY (".implode(', ',array_map('idf_escape',$w['columns'])).")";break;}}foreach($Xc
as$Wc=>$Vc)$Ng[]="CONSTRAINT ".idf_escape($Wc)." $Vc[definition] ".($Vc['deferrable']?'DEFERRABLE':'NOT DEFERRABLE');$I.=implode(",\n    ",$Ng)."\n) WITH (oids = ".($Ch['Oid']?'true':'false').");";foreach($x
as$Gd=>$w){if($w['type']=='INDEX'){$f=array();foreach($w['columns']as$z=>$X)$f[]=idf_escape($X).($w['descs'][$z]?" DESC":"");$I.="\n\nCREATE INDEX ".idf_escape($Gd)." ON ".idf_escape($Ch['nspname']).".".idf_escape($Ch['Name'])." USING btree (".implode(', ',$f).");";}}if($Ch['Comment'])$I.="\n\nCOMMENT ON TABLE ".idf_escape($Ch['nspname']).".".idf_escape($Ch['Name'])." IS ".q($Ch['Comment']).";";foreach($q
as$Pc=>$p){if($p['comment'])$I.="\n\nCOMMENT ON COLUMN ".idf_escape($Ch['nspname']).".".idf_escape($Ch['Name']).".".idf_escape($Pc)." IS ".q($p['comment']).";";}return
rtrim($I,';');}function
truncate_sql($Q){return"TRUNCATE ".table($Q);}function
trigger_sql($Q){$Ch=table_status($Q);$I="";foreach(triggers($Q)as$ui=>$ti){$vi=trigger($ui,$Ch['Name']);$I.="\nCREATE TRIGGER ".idf_escape($vi['Trigger'])." $vi[Timing] $vi[Events] ON ".idf_escape($Ch["nspname"]).".".idf_escape($Ch['Name'])." $vi[Type] $vi[Statement];;\n";}return$I;}function
use_sql($k){return"\connect ".idf_escape($k);}function
show_variables(){return
get_key_vals("SHOW ALL");}function
process_list(){return
get_rows("SELECT * FROM pg_stat_activity ORDER BY ".(min_version(9.2)?"pid":"procpid"));}function
show_status(){}function
convert_field($p){}function
unconvert_field($p,$I){return$I;}function
support($Nc){return
preg_match('~^(database|table|columns|sql|indexes|descidx|comment|view|'.(min_version(9.3)?'materializedview|':'').'scheme|routine|processlist|sequence|trigger|type|variables|drop_col|kill|dump)$~',$Nc);}function
kill_process($X){return
queries("SELECT pg_terminate_backend(".number($X).")");}function
connection_id(){return"SELECT pg_backend_pid()";}function
max_connections(){global$g;return$g->result("SHOW max_connections");}$y="pgsql";$U=array();$Fh=array();foreach(array('Numbers'=>array("smallint"=>5,"integer"=>10,"bigint"=>19,"boolean"=>1,"numeric"=>0,"real"=>7,"double precision"=>16,"money"=>20),'Date and time'=>array("date"=>13,"time"=>17,"timestamp"=>20,"timestamptz"=>21,"interval"=>0),'Strings'=>array("character"=>0,"character varying"=>0,"text"=>0,"tsquery"=>0,"tsvector"=>0,"uuid"=>0,"xml"=>0),'Binary'=>array("bit"=>0,"bit varying"=>0,"bytea"=>0),'Network'=>array("cidr"=>43,"inet"=>43,"macaddr"=>17,"txid_snapshot"=>0),'Geometry'=>array("box"=>0,"circle"=>0,"line"=>0,"lseg"=>0,"path"=>0,"point"=>0,"polygon"=>0),)as$z=>$X){$U+=$X;$Fh[$z]=array_keys($X);}$Gi=array();$sf=array("=","<",">","<=",">=","!=","~","!~","LIKE","LIKE %%","ILIKE","ILIKE %%","IN","IS NULL","NOT LIKE","NOT IN","IS NOT NULL");$id=array("char_length","lower","round","to_hex","to_timestamp","upper");$od=array("avg","count","count distinct","max","min","sum");$kc=array(array("char"=>"md5","date|time"=>"now",),array(number_type()=>"+/-","date|time"=>"+ interval/- interval","char|text"=>"||",));}$cc["oracle"]="Oracle (beta)";if(isset($_GET["oracle"])){$eg=array("OCI8","PDO_OCI");define("DRIVER","oracle");if(extension_loaded("oci8")){class
Min_DB{var$extension="oci8",$_link,$_result,$server_info,$affected_rows,$errno,$error;function
_error($vc,$o){if(ini_bool("html_errors"))$o=html_entity_decode(strip_tags($o));$o=preg_replace('~^[^:]*: ~','',$o);$this->error=$o;}function
connect($N,$V,$F){$this->_link=@oci_new_connect($V,$F,$N,"AL32UTF8");if($this->_link){$this->server_info=oci_server_version($this->_link);return
true;}$o=oci_error();$this->error=$o["message"];return
false;}function
quote($P){return"'".str_replace("'","''",$P)."'";}function
select_db($k){return
true;}function
query($G,$Ai=false){$H=oci_parse($this->_link,$G);$this->error="";if(!$H){$o=oci_error($this->_link);$this->errno=$o["code"];$this->error=$o["message"];return
false;}set_error_handler(array($this,'_error'));$I=@oci_execute($H);restore_error_handler();if($I){if(oci_num_fields($H))return
new
Min_Result($H);$this->affected_rows=oci_num_rows($H);}return$I;}function
multi_query($G){return$this->_result=$this->query($G);}function
store_result(){return$this->_result;}function
next_result(){return
false;}function
result($G,$p=1){$H=$this->query($G);if(!is_object($H)||!oci_fetch($H->_result))return
false;return
oci_result($H->_result,$p);}}class
Min_Result{var$_result,$_offset=1,$num_rows;function
__construct($H){$this->_result=$H;}function
_convert($J){foreach((array)$J
as$z=>$X){if(is_a($X,'OCI-Lob'))$J[$z]=$X->load();}return$J;}function
fetch_assoc(){return$this->_convert(oci_fetch_assoc($this->_result));}function
fetch_row(){return$this->_convert(oci_fetch_row($this->_result));}function
fetch_field(){$e=$this->_offset++;$I=new
stdClass;$I->name=oci_field_name($this->_result,$e);$I->orgname=$I->name;$I->type=oci_field_type($this->_result,$e);$I->charsetnr=(preg_match("~raw|blob|bfile~",$I->type)?63:0);return$I;}function
__destruct(){oci_free_statement($this->_result);}}}elseif(extension_loaded("pdo_oci")){class
Min_DB
extends
Min_PDO{var$extension="PDO_OCI";function
connect($N,$V,$F){$this->dsn("oci:dbname=//$N;charset=AL32UTF8",$V,$F);return
true;}function
select_db($k){return
true;}}}class
Min_Driver
extends
Min_SQL{function
begin(){return
true;}}function
idf_escape($v){return'"'.str_replace('"','""',$v).'"';}function
table($v){return
idf_escape($v);}function
connect(){global$b;$g=new
Min_DB;$j=$b->credentials();if($g->connect($j[0],$j[1],$j[2]))return$g;return$g->error;}function
get_databases(){return
get_vals("SELECT tablespace_name FROM user_tablespaces");}function
limit($G,$Z,$_,$D=0,$M=" "){return($D?" * FROM (SELECT t.*, rownum AS rnum FROM (SELECT $G$Z) t WHERE rownum <= ".($_+$D).") WHERE rnum > $D":($_!==null?" * FROM (SELECT $G$Z) WHERE rownum <= ".($_+$D):" $G$Z"));}function
limit1($Q,$G,$Z,$M="\n"){return" $G$Z";}function
db_collation($m,$ob){global$g;return$g->result("SELECT value FROM nls_database_parameters WHERE parameter = 'NLS_CHARACTERSET'");}function
engines(){return
array();}function
logged_user(){global$g;return$g->result("SELECT USER FROM DUAL");}function
tables_list(){return
get_key_vals("SELECT table_name, 'table' FROM all_tables WHERE tablespace_name = ".q(DB)."
UNION SELECT view_name, 'view' FROM user_views
ORDER BY 1");}function
count_tables($l){return
array();}function
table_status($C=""){$I=array();$Zg=q($C);foreach(get_rows('SELECT table_name "Name", \'table\' "Engine", avg_row_len * num_rows "Data_length", num_rows "Rows" FROM all_tables WHERE tablespace_name = '.q(DB).($C!=""?" AND table_name = $Zg":"")."
UNION SELECT view_name, 'view', 0, 0 FROM user_views".($C!=""?" WHERE view_name = $Zg":"")."
ORDER BY 1")as$J){if($C!="")return$J;$I[$J["Name"]]=$J;}return$I;}function
is_view($R){return$R["Engine"]=="view";}function
fk_support($R){return
true;}function
fields($Q){$I=array();foreach(get_rows("SELECT * FROM all_tab_columns WHERE table_name = ".q($Q)." ORDER BY column_id")as$J){$T=$J["DATA_TYPE"];$re="$J[DATA_PRECISION],$J[DATA_SCALE]";if($re==",")$re=$J["DATA_LENGTH"];$I[$J["COLUMN_NAME"]]=array("field"=>$J["COLUMN_NAME"],"full_type"=>$T.($re?"($re)":""),"type"=>strtolower($T),"length"=>$re,"default"=>$J["DATA_DEFAULT"],"null"=>($J["NULLABLE"]=="Y"),"privileges"=>array("insert"=>1,"select"=>1,"update"=>1),);}return$I;}function
indexes($Q,$h=null){$I=array();foreach(get_rows("SELECT uic.*, uc.constraint_type
FROM user_ind_columns uic
LEFT JOIN user_constraints uc ON uic.index_name = uc.constraint_name AND uic.table_name = uc.table_name
WHERE uic.table_name = ".q($Q)."
ORDER BY uc.constraint_type, uic.column_position",$h)as$J){$Gd=$J["INDEX_NAME"];$I[$Gd]["type"]=($J["CONSTRAINT_TYPE"]=="P"?"PRIMARY":($J["CONSTRAINT_TYPE"]=="U"?"UNIQUE":"INDEX"));$I[$Gd]["columns"][]=$J["COLUMN_NAME"];$I[$Gd]["lengths"][]=($J["CHAR_LENGTH"]&&$J["CHAR_LENGTH"]!=$J["COLUMN_LENGTH"]?$J["CHAR_LENGTH"]:null);$I[$Gd]["descs"][]=($J["DESCEND"]?'1':null);}return$I;}function
view($C){$K=get_rows('SELECT text "select" FROM user_views WHERE view_name = '.q($C));return
reset($K);}function
collations(){return
array();}function
information_schema($m){return
false;}function
error(){global$g;return
h($g->error);}function
explain($g,$G){$g->query("EXPLAIN PLAN FOR $G");return$g->query("SELECT * FROM plan_table");}function
found_rows($R,$Z){}function
alter_table($Q,$C,$q,$ad,$tb,$sc,$d,$La,$Rf){$c=$dc=array();foreach($q
as$p){$X=$p[1];if($X&&$p[0]!=""&&idf_escape($p[0])!=$X[0])queries("ALTER TABLE ".table($Q)." RENAME COLUMN ".idf_escape($p[0])." TO $X[0]");if($X)$c[]=($Q!=""?($p[0]!=""?"MODIFY (":"ADD ("):"  ").implode($X).($Q!=""?")":"");else$dc[]=idf_escape($p[0]);}if($Q=="")return
queries("CREATE TABLE ".table($C)." (\n".implode(",\n",$c)."\n)");return(!$c||queries("ALTER TABLE ".table($Q)."\n".implode("\n",$c)))&&(!$dc||queries("ALTER TABLE ".table($Q)." DROP (".implode(", ",$dc).")"))&&($Q==$C||queries("ALTER TABLE ".table($Q)." RENAME TO ".table($C)));}function
foreign_keys($Q){$I=array();$G="SELECT c_list.CONSTRAINT_NAME as NAME,
c_src.COLUMN_NAME as SRC_COLUMN,
c_dest.OWNER as DEST_DB,
c_dest.TABLE_NAME as DEST_TABLE,
c_dest.COLUMN_NAME as DEST_COLUMN,
c_list.DELETE_RULE as ON_DELETE
FROM ALL_CONSTRAINTS c_list, ALL_CONS_COLUMNS c_src, ALL_CONS_COLUMNS c_dest
WHERE c_list.CONSTRAINT_NAME = c_src.CONSTRAINT_NAME
AND c_list.R_CONSTRAINT_NAME = c_dest.CONSTRAINT_NAME
AND c_list.CONSTRAINT_TYPE = 'R'
AND c_src.TABLE_NAME = ".q($Q);foreach(get_rows($G)as$J)$I[$J['NAME']]=array("db"=>$J['DEST_DB'],"table"=>$J['DEST_TABLE'],"source"=>array($J['SRC_COLUMN']),"target"=>array($J['DEST_COLUMN']),"on_delete"=>$J['ON_DELETE'],"on_update"=>null,);return$I;}function
truncate_tables($S){return
apply_queries("TRUNCATE TABLE",$S);}function
drop_views($Xi){return
apply_queries("DROP VIEW",$Xi);}function
drop_tables($S){return
apply_queries("DROP TABLE",$S);}function
last_id(){return
0;}function
schemas(){return
get_vals("SELECT DISTINCT owner FROM dba_segments WHERE owner IN (SELECT username FROM dba_users WHERE default_tablespace NOT IN ('SYSTEM','SYSAUX'))");}function
get_schema(){global$g;return$g->result("SELECT sys_context('USERENV', 'SESSION_USER') FROM dual");}function
set_schema($Yg){global$g;return$g->query("ALTER SESSION SET CURRENT_SCHEMA = ".idf_escape($Yg));}function
show_variables(){return
get_key_vals('SELECT name, display_value FROM v$parameter');}function
process_list(){return
get_rows('SELECT sess.process AS "process", sess.username AS "user", sess.schemaname AS "schema", sess.status AS "status", sess.wait_class AS "wait_class", sess.seconds_in_wait AS "seconds_in_wait", sql.sql_text AS "sql_text", sess.machine AS "machine", sess.port AS "port"
FROM v$session sess LEFT OUTER JOIN v$sql sql
ON sql.sql_id = sess.sql_id
WHERE sess.type = \'USER\'
ORDER BY PROCESS
');}function
show_status(){$K=get_rows('SELECT * FROM v$instance');return
reset($K);}function
convert_field($p){}function
unconvert_field($p,$I){return$I;}function
support($Nc){return
preg_match('~^(columns|database|drop_col|indexes|descidx|processlist|scheme|sql|status|table|variables|view|view_trigger)$~',$Nc);}$y="oracle";$U=array();$Fh=array();foreach(array('Numbers'=>array("number"=>38,"binary_float"=>12,"binary_double"=>21),'Date and time'=>array("date"=>10,"timestamp"=>29,"interval year"=>12,"interval day"=>28),'Strings'=>array("char"=>2000,"varchar2"=>4000,"nchar"=>2000,"nvarchar2"=>4000,"clob"=>4294967295,"nclob"=>4294967295),'Binary'=>array("raw"=>2000,"long raw"=>2147483648,"blob"=>4294967295,"bfile"=>4294967296),)as$z=>$X){$U+=$X;$Fh[$z]=array_keys($X);}$Gi=array();$sf=array("=","<",">","<=",">=","!=","LIKE","LIKE %%","IN","IS NULL","NOT LIKE","NOT REGEXP","NOT IN","IS NOT NULL","SQL");$id=array("length","lower","round","upper");$od=array("avg","count","count distinct","max","min","sum");$kc=array(array("date"=>"current_date","timestamp"=>"current_timestamp",),array("number|float|double"=>"+/-","date|timestamp"=>"+ interval/- interval","char|clob"=>"||",));}$cc["mssql"]="MS SQL (beta)";if(isset($_GET["mssql"])){$eg=array("SQLSRV","MSSQL","PDO_DBLIB");define("DRIVER","mssql");if(extension_loaded("sqlsrv")){class
Min_DB{var$extension="sqlsrv",$_link,$_result,$server_info,$affected_rows,$errno,$error;function
_get_error(){$this->error="";foreach(sqlsrv_errors()as$o){$this->errno=$o["code"];$this->error.="$o[message]\n";}$this->error=rtrim($this->error);}function
connect($N,$V,$F){global$b;$m=$b->database();$wb=array("UID"=>$V,"PWD"=>$F,"CharacterSet"=>"UTF-8");if($m!="")$wb["Database"]=$m;$this->_link=@sqlsrv_connect(preg_replace('~:~',',',$N),$wb);if($this->_link){$Nd=sqlsrv_server_info($this->_link);$this->server_info=$Nd['SQLServerVersion'];}else$this->_get_error();return(bool)$this->_link;}function
quote($P){return"'".str_replace("'","''",$P)."'";}function
select_db($k){return$this->query("USE ".idf_escape($k));}function
query($G,$Ai=false){$H=sqlsrv_query($this->_link,$G);$this->error="";if(!$H){$this->_get_error();return
false;}return$this->store_result($H);}function
multi_query($G){$this->_result=sqlsrv_query($this->_link,$G);$this->error="";if(!$this->_result){$this->_get_error();return
false;}return
true;}function
store_result($H=null){if(!$H)$H=$this->_result;if(!$H)return
false;if(sqlsrv_field_metadata($H))return
new
Min_Result($H);$this->affected_rows=sqlsrv_rows_affected($H);return
true;}function
next_result(){return$this->_result?sqlsrv_next_result($this->_result):null;}function
result($G,$p=0){$H=$this->query($G);if(!is_object($H))return
false;$J=$H->fetch_row();return$J[$p];}}class
Min_Result{var$_result,$_offset=0,$_fields,$num_rows;function
__construct($H){$this->_result=$H;}function
_convert($J){foreach((array)$J
as$z=>$X){if(is_a($X,'DateTime'))$J[$z]=$X->format("Y-m-d H:i:s");}return$J;}function
fetch_assoc(){return$this->_convert(sqlsrv_fetch_array($this->_result,SQLSRV_FETCH_ASSOC));}function
fetch_row(){return$this->_convert(sqlsrv_fetch_array($this->_result,SQLSRV_FETCH_NUMERIC));}function
fetch_field(){if(!$this->_fields)$this->_fields=sqlsrv_field_metadata($this->_result);$p=$this->_fields[$this->_offset++];$I=new
stdClass;$I->name=$p["Name"];$I->orgname=$p["Name"];$I->type=($p["Type"]==1?254:0);return$I;}function
seek($D){for($t=0;$t<$D;$t++)sqlsrv_fetch($this->_result);}function
__destruct(){sqlsrv_free_stmt($this->_result);}}}elseif(extension_loaded("mssql")){class
Min_DB{var$extension="MSSQL",$_link,$_result,$server_info,$affected_rows,$error;function
connect($N,$V,$F){$this->_link=@mssql_connect($N,$V,$F);if($this->_link){$H=$this->query("SELECT SERVERPROPERTY('ProductLevel'), SERVERPROPERTY('Edition')");if($H){$J=$H->fetch_row();$this->server_info=$this->result("sp_server_info 2",2)." [$J[0]] $J[1]";}}else$this->error=mssql_get_last_message();return(bool)$this->_link;}function
quote($P){return"'".str_replace("'","''",$P)."'";}function
select_db($k){return
mssql_select_db($k);}function
query($G,$Ai=false){$H=@mssql_query($G,$this->_link);$this->error="";if(!$H){$this->error=mssql_get_last_message();return
false;}if($H===true){$this->affected_rows=mssql_rows_affected($this->_link);return
true;}return
new
Min_Result($H);}function
multi_query($G){return$this->_result=$this->query($G);}function
store_result(){return$this->_result;}function
next_result(){return
mssql_next_result($this->_result->_result);}function
result($G,$p=0){$H=$this->query($G);if(!is_object($H))return
false;return
mssql_result($H->_result,0,$p);}}class
Min_Result{var$_result,$_offset=0,$_fields,$num_rows;function
__construct($H){$this->_result=$H;$this->num_rows=mssql_num_rows($H);}function
fetch_assoc(){return
mssql_fetch_assoc($this->_result);}function
fetch_row(){return
mssql_fetch_row($this->_result);}function
num_rows(){return
mssql_num_rows($this->_result);}function
fetch_field(){$I=mssql_fetch_field($this->_result);$I->orgtable=$I->table;$I->orgname=$I->name;return$I;}function
seek($D){mssql_data_seek($this->_result,$D);}function
__destruct(){mssql_free_result($this->_result);}}}elseif(extension_loaded("pdo_dblib")){class
Min_DB
extends
Min_PDO{var$extension="PDO_DBLIB";function
connect($N,$V,$F){$this->dsn("dblib:charset=utf8;host=".str_replace(":",";unix_socket=",preg_replace('~:(\d)~',';port=\1',$N)),$V,$F);return
true;}function
select_db($k){return$this->query("USE ".idf_escape($k));}}}class
Min_Driver
extends
Min_SQL{function
insertUpdate($Q,$K,$hg){foreach($K
as$O){$Hi=array();$Z=array();foreach($O
as$z=>$X){$Hi[]="$z = $X";if(isset($hg[idf_unescape($z)]))$Z[]="$z = $X";}if(!queries("MERGE ".table($Q)." USING (VALUES(".implode(", ",$O).")) AS source (c".implode(", c",range(1,count($O))).") ON ".implode(" AND ",$Z)." WHEN MATCHED THEN UPDATE SET ".implode(", ",$Hi)." WHEN NOT MATCHED THEN INSERT (".implode(", ",array_keys($O)).") VALUES (".implode(", ",$O).");"))return
false;}return
true;}function
begin(){return
queries("BEGIN TRANSACTION");}}function
idf_escape($v){return"[".str_replace("]","]]",$v)."]";}function
table($v){return($_GET["ns"]!=""?idf_escape($_GET["ns"]).".":"").idf_escape($v);}function
connect(){global$b;$g=new
Min_DB;$j=$b->credentials();if($g->connect($j[0],$j[1],$j[2]))return$g;return$g->error;}function
get_databases(){return
get_vals("SELECT name FROM sys.databases WHERE name NOT IN ('master', 'tempdb', 'model', 'msdb')");}function
limit($G,$Z,$_,$D=0,$M=" "){return($_!==null?" TOP (".($_+$D).")":"")." $G$Z";}function
limit1($Q,$G,$Z,$M="\n"){return
limit($G,$Z,1,0,$M);}function
db_collation($m,$ob){global$g;return$g->result("SELECT collation_name FROM sys.databases WHERE name = ".q($m));}function
engines(){return
array();}function
logged_user(){global$g;return$g->result("SELECT SUSER_NAME()");}function
tables_list(){return
get_key_vals("SELECT name, type_desc FROM sys.all_objects WHERE schema_id = SCHEMA_ID(".q(get_schema()).") AND type IN ('S', 'U', 'V') ORDER BY name");}function
count_tables($l){global$g;$I=array();foreach($l
as$m){$g->select_db($m);$I[$m]=$g->result("SELECT COUNT(*) FROM INFORMATION_SCHEMA.TABLES");}return$I;}function
table_status($C=""){$I=array();foreach(get_rows("SELECT name AS Name, type_desc AS Engine FROM sys.all_objects WHERE schema_id = SCHEMA_ID(".q(get_schema()).") AND type IN ('S', 'U', 'V') ".($C!=""?"AND name = ".q($C):"ORDER BY name"))as$J){if($C!="")return$J;$I[$J["Name"]]=$J;}return$I;}function
is_view($R){return$R["Engine"]=="VIEW";}function
fk_support($R){return
true;}function
fields($Q){$I=array();foreach(get_rows("SELECT c.max_length, c.precision, c.scale, c.name, c.is_nullable, c.is_identity, c.collation_name, t.name type, CAST(d.definition as text) [default]
FROM sys.all_columns c
JOIN sys.all_objects o ON c.object_id = o.object_id
JOIN sys.types t ON c.user_type_id = t.user_type_id
LEFT JOIN sys.default_constraints d ON c.default_object_id = d.parent_column_id
WHERE o.schema_id = SCHEMA_ID(".q(get_schema()).") AND o.type IN ('S', 'U', 'V') AND o.name = ".q($Q))as$J){$T=$J["type"];$re=(preg_match("~char|binary~",$T)?$J["max_length"]:($T=="decimal"?"$J[precision],$J[scale]":""));$I[$J["name"]]=array("field"=>$J["name"],"full_type"=>$T.($re?"($re)":""),"type"=>$T,"length"=>$re,"default"=>$J["default"],"null"=>$J["is_nullable"],"auto_increment"=>$J["is_identity"],"collation"=>$J["collation_name"],"privileges"=>array("insert"=>1,"select"=>1,"update"=>1),"primary"=>$J["is_identity"],);}return$I;}function
indexes($Q,$h=null){$I=array();foreach(get_rows("SELECT i.name, key_ordinal, is_unique, is_primary_key, c.name AS column_name, is_descending_key
FROM sys.indexes i
INNER JOIN sys.index_columns ic ON i.object_id = ic.object_id AND i.index_id = ic.index_id
INNER JOIN sys.columns c ON ic.object_id = c.object_id AND ic.column_id = c.column_id
WHERE OBJECT_NAME(i.object_id) = ".q($Q),$h)as$J){$C=$J["name"];$I[$C]["type"]=($J["is_primary_key"]?"PRIMARY":($J["is_unique"]?"UNIQUE":"INDEX"));$I[$C]["lengths"]=array();$I[$C]["columns"][$J["key_ordinal"]]=$J["column_name"];$I[$C]["descs"][$J["key_ordinal"]]=($J["is_descending_key"]?'1':null);}return$I;}function
view($C){global$g;return
array("select"=>preg_replace('~^(?:[^[]|\[[^]]*])*\s+AS\s+~isU','',$g->result("SELECT VIEW_DEFINITION FROM INFORMATION_SCHEMA.VIEWS WHERE TABLE_SCHEMA = SCHEMA_NAME() AND TABLE_NAME = ".q($C))));}function
collations(){$I=array();foreach(get_vals("SELECT name FROM fn_helpcollations()")as$d)$I[preg_replace('~_.*~','',$d)][]=$d;return$I;}function
information_schema($m){return
false;}function
error(){global$g;return
nl_br(h(preg_replace('~^(\[[^]]*])+~m','',$g->error)));}function
create_database($m,$d){return
queries("CREATE DATABASE ".idf_escape($m).(preg_match('~^[a-z0-9_]+$~i',$d)?" COLLATE $d":""));}function
drop_databases($l){return
queries("DROP DATABASE ".implode(", ",array_map('idf_escape',$l)));}function
rename_database($C,$d){if(preg_match('~^[a-z0-9_]+$~i',$d))queries("ALTER DATABASE ".idf_escape(DB)." COLLATE $d");queries("ALTER DATABASE ".idf_escape(DB)." MODIFY NAME = ".idf_escape($C));return
true;}function
auto_increment(){return" IDENTITY".($_POST["Auto_increment"]!=""?"(".number($_POST["Auto_increment"]).",1)":"")." PRIMARY KEY";}function
alter_table($Q,$C,$q,$ad,$tb,$sc,$d,$La,$Rf){$c=array();foreach($q
as$p){$e=idf_escape($p[0]);$X=$p[1];if(!$X)$c["DROP"][]=" COLUMN $e";else{$X[1]=preg_replace("~( COLLATE )'(\\w+)'~",'\1\2',$X[1]);if($p[0]=="")$c["ADD"][]="\n  ".implode("",$X).($Q==""?substr($ad[$X[0]],16+strlen($X[0])):"");else{unset($X[6]);if($e!=$X[0])queries("EXEC sp_rename ".q(table($Q).".$e").", ".q(idf_unescape($X[0])).", 'COLUMN'");$c["ALTER COLUMN ".implode("",$X)][]="";}}}if($Q=="")return
queries("CREATE TABLE ".table($C)." (".implode(",",(array)$c["ADD"])."\n)");if($Q!=$C)queries("EXEC sp_rename ".q(table($Q)).", ".q($C));if($ad)$c[""]=$ad;foreach($c
as$z=>$X){if(!queries("ALTER TABLE ".idf_escape($C)." $z".implode(",",$X)))return
false;}return
true;}function
alter_indexes($Q,$c){$w=array();$dc=array();foreach($c
as$X){if($X[2]=="DROP"){if($X[0]=="PRIMARY")$dc[]=idf_escape($X[1]);else$w[]=idf_escape($X[1])." ON ".table($Q);}elseif(!queries(($X[0]!="PRIMARY"?"CREATE $X[0] ".($X[0]!="INDEX"?"INDEX ":"").idf_escape($X[1]!=""?$X[1]:uniqid($Q."_"))." ON ".table($Q):"ALTER TABLE ".table($Q)." ADD PRIMARY KEY")." (".implode(", ",$X[2]).")"))return
false;}return(!$w||queries("DROP INDEX ".implode(", ",$w)))&&(!$dc||queries("ALTER TABLE ".table($Q)." DROP ".implode(", ",$dc)));}function
last_id(){global$g;return$g->result("SELECT SCOPE_IDENTITY()");}function
explain($g,$G){$g->query("SET SHOWPLAN_ALL ON");$I=$g->query($G);$g->query("SET SHOWPLAN_ALL OFF");return$I;}function
found_rows($R,$Z){}function
foreign_keys($Q){$I=array();foreach(get_rows("EXEC sp_fkeys @fktable_name = ".q($Q))as$J){$r=&$I[$J["FK_NAME"]];$r["table"]=$J["PKTABLE_NAME"];$r["source"][]=$J["FKCOLUMN_NAME"];$r["target"][]=$J["PKCOLUMN_NAME"];}return$I;}function
truncate_tables($S){return
apply_queries("TRUNCATE TABLE",$S);}function
drop_views($Xi){return
queries("DROP VIEW ".implode(", ",array_map('table',$Xi)));}function
drop_tables($S){return
queries("DROP TABLE ".implode(", ",array_map('table',$S)));}function
move_tables($S,$Xi,$Vh){return
apply_queries("ALTER SCHEMA ".idf_escape($Vh)." TRANSFER",array_merge($S,$Xi));}function
trigger($C){if($C=="")return
array();$K=get_rows("SELECT s.name [Trigger],
CASE WHEN OBJECTPROPERTY(s.id, 'ExecIsInsertTrigger') = 1 THEN 'INSERT' WHEN OBJECTPROPERTY(s.id, 'ExecIsUpdateTrigger') = 1 THEN 'UPDATE' WHEN OBJECTPROPERTY(s.id, 'ExecIsDeleteTrigger') = 1 THEN 'DELETE' END [Event],
CASE WHEN OBJECTPROPERTY(s.id, 'ExecIsInsteadOfTrigger') = 1 THEN 'INSTEAD OF' ELSE 'AFTER' END [Timing],
c.text
FROM sysobjects s
JOIN syscomments c ON s.id = c.id
WHERE s.xtype = 'TR' AND s.name = ".q($C));$I=reset($K);if($I)$I["Statement"]=preg_replace('~^.+\s+AS\s+~isU','',$I["text"]);return$I;}function
triggers($Q){$I=array();foreach(get_rows("SELECT sys1.name,
CASE WHEN OBJECTPROPERTY(sys1.id, 'ExecIsInsertTrigger') = 1 THEN 'INSERT' WHEN OBJECTPROPERTY(sys1.id, 'ExecIsUpdateTrigger') = 1 THEN 'UPDATE' WHEN OBJECTPROPERTY(sys1.id, 'ExecIsDeleteTrigger') = 1 THEN 'DELETE' END [Event],
CASE WHEN OBJECTPROPERTY(sys1.id, 'ExecIsInsteadOfTrigger') = 1 THEN 'INSTEAD OF' ELSE 'AFTER' END [Timing]
FROM sysobjects sys1
JOIN sysobjects sys2 ON sys1.parent_obj = sys2.id
WHERE sys1.xtype = 'TR' AND sys2.name = ".q($Q))as$J)$I[$J["name"]]=array($J["Timing"],$J["Event"]);return$I;}function
trigger_options(){return
array("Timing"=>array("AFTER","INSTEAD OF"),"Event"=>array("INSERT","UPDATE","DELETE"),"Type"=>array("AS"),);}function
schemas(){return
get_vals("SELECT name FROM sys.schemas");}function
get_schema(){global$g;if($_GET["ns"]!="")return$_GET["ns"];return$g->result("SELECT SCHEMA_NAME()");}function
set_schema($Xg){return
true;}function
use_sql($k){return"USE ".idf_escape($k);}function
show_variables(){return
array();}function
show_status(){return
array();}function
convert_field($p){}function
unconvert_field($p,$I){return$I;}function
support($Nc){return
preg_match('~^(columns|database|drop_col|indexes|descidx|scheme|sql|table|trigger|view|view_trigger)$~',$Nc);}$y="mssql";$U=array();$Fh=array();foreach(array('Numbers'=>array("tinyint"=>3,"smallint"=>5,"int"=>10,"bigint"=>20,"bit"=>1,"decimal"=>0,"real"=>12,"float"=>53,"smallmoney"=>10,"money"=>20),'Date and time'=>array("date"=>10,"smalldatetime"=>19,"datetime"=>19,"datetime2"=>19,"time"=>8,"datetimeoffset"=>10),'Strings'=>array("char"=>8000,"varchar"=>8000,"text"=>2147483647,"nchar"=>4000,"nvarchar"=>4000,"ntext"=>1073741823),'Binary'=>array("binary"=>8000,"varbinary"=>8000,"image"=>2147483647),)as$z=>$X){$U+=$X;$Fh[$z]=array_keys($X);}$Gi=array();$sf=array("=","<",">","<=",">=","!=","LIKE","LIKE %%","IN","IS NULL","NOT LIKE","NOT IN","IS NOT NULL");$id=array("len","lower","round","upper");$od=array("avg","count","count distinct","max","min","sum");$kc=array(array("date|time"=>"getdate",),array("int|decimal|real|float|money|datetime"=>"+/-","char|text"=>"+",));}$cc['firebird']='Firebird (alpha)';if(isset($_GET["firebird"])){$eg=array("interbase");define("DRIVER","firebird");if(extension_loaded("interbase")){class
Min_DB{var$extension="Firebird",$server_info,$affected_rows,$errno,$error,$_link,$_result;function
connect($N,$V,$F){$this->_link=ibase_connect($N,$V,$F);if($this->_link){$Ki=explode(':',$N);$this->service_link=ibase_service_attach($Ki[0],$V,$F);$this->server_info=ibase_server_info($this->service_link,IBASE_SVC_SERVER_VERSION);}else{$this->errno=ibase_errcode();$this->error=ibase_errmsg();}return(bool)$this->_link;}function
quote($P){return"'".str_replace("'","''",$P)."'";}function
select_db($k){return($k=="domain");}function
query($G,$Ai=false){$H=ibase_query($G,$this->_link);if(!$H){$this->errno=ibase_errcode();$this->error=ibase_errmsg();return
false;}$this->error="";if($H===true){$this->affected_rows=ibase_affected_rows($this->_link);return
true;}return
new
Min_Result($H);}function
multi_query($G){return$this->_result=$this->query($G);}function
store_result(){return$this->_result;}function
next_result(){return
false;}function
result($G,$p=0){$H=$this->query($G);if(!$H||!$H->num_rows)return
false;$J=$H->fetch_row();return$J[$p];}}class
Min_Result{var$num_rows,$_result,$_offset=0;function
__construct($H){$this->_result=$H;}function
fetch_assoc(){return
ibase_fetch_assoc($this->_result);}function
fetch_row(){return
ibase_fetch_row($this->_result);}function
fetch_field(){$p=ibase_field_info($this->_result,$this->_offset++);return(object)array('name'=>$p['name'],'orgname'=>$p['name'],'type'=>$p['type'],'charsetnr'=>$p['length'],);}function
__destruct(){ibase_free_result($this->_result);}}}class
Min_Driver
extends
Min_SQL{}function
idf_escape($v){return'"'.str_replace('"','""',$v).'"';}function
table($v){return
idf_escape($v);}function
connect(){global$b;$g=new
Min_DB;$j=$b->credentials();if($g->connect($j[0],$j[1],$j[2]))return$g;return$g->error;}function
get_databases($Yc){return
array("domain");}function
limit($G,$Z,$_,$D=0,$M=" "){$I='';$I.=($_!==null?$M."FIRST $_".($D?" SKIP $D":""):"");$I.=" $G$Z";return$I;}function
limit1($Q,$G,$Z,$M="\n"){return
limit($G,$Z,1,0,$M);}function
db_collation($m,$ob){}function
engines(){return
array();}function
logged_user(){global$b;$j=$b->credentials();return$j[1];}function
tables_list(){global$g;$G='SELECT RDB$RELATION_NAME FROM rdb$relations WHERE rdb$system_flag = 0';$H=ibase_query($g->_link,$G);$I=array();while($J=ibase_fetch_assoc($H))$I[$J['RDB$RELATION_NAME']]='table';ksort($I);return$I;}function
count_tables($l){return
array();}function
table_status($C="",$Mc=false){global$g;$I=array();$Jb=tables_list();foreach($Jb
as$w=>$X){$w=trim($w);$I[$w]=array('Name'=>$w,'Engine'=>'standard',);if($C==$w)return$I[$w];}return$I;}function
is_view($R){return
false;}function
fk_support($R){return
preg_match('~InnoDB|IBMDB2I~i',$R["Engine"]);}function
fields($Q){global$g;$I=array();$G='SELECT r.RDB$FIELD_NAME AS field_name,
r.RDB$DESCRIPTION AS field_description,
r.RDB$DEFAULT_VALUE AS field_default_value,
r.RDB$NULL_FLAG AS field_not_null_constraint,
f.RDB$FIELD_LENGTH AS field_length,
f.RDB$FIELD_PRECISION AS field_precision,
f.RDB$FIELD_SCALE AS field_scale,
CASE f.RDB$FIELD_TYPE
WHEN 261 THEN \'BLOB\'
WHEN 14 THEN \'CHAR\'
WHEN 40 THEN \'CSTRING\'
WHEN 11 THEN \'D_FLOAT\'
WHEN 27 THEN \'DOUBLE\'
WHEN 10 THEN \'FLOAT\'
WHEN 16 THEN \'INT64\'
WHEN 8 THEN \'INTEGER\'
WHEN 9 THEN \'QUAD\'
WHEN 7 THEN \'SMALLINT\'
WHEN 12 THEN \'DATE\'
WHEN 13 THEN \'TIME\'
WHEN 35 THEN \'TIMESTAMP\'
WHEN 37 THEN \'VARCHAR\'
ELSE \'UNKNOWN\'
END AS field_type,
f.RDB$FIELD_SUB_TYPE AS field_subtype,
coll.RDB$COLLATION_NAME AS field_collation,
cset.RDB$CHARACTER_SET_NAME AS field_charset
FROM RDB$RELATION_FIELDS r
LEFT JOIN RDB$FIELDS f ON r.RDB$FIELD_SOURCE = f.RDB$FIELD_NAME
LEFT JOIN RDB$COLLATIONS coll ON f.RDB$COLLATION_ID = coll.RDB$COLLATION_ID
LEFT JOIN RDB$CHARACTER_SETS cset ON f.RDB$CHARACTER_SET_ID = cset.RDB$CHARACTER_SET_ID
WHERE r.RDB$RELATION_NAME = '.q($Q).'
ORDER BY r.RDB$FIELD_POSITION';$H=ibase_query($g->_link,$G);while($J=ibase_fetch_assoc($H))$I[trim($J['FIELD_NAME'])]=array("field"=>trim($J["FIELD_NAME"]),"full_type"=>trim($J["FIELD_TYPE"]),"type"=>trim($J["FIELD_SUB_TYPE"]),"default"=>trim($J['FIELD_DEFAULT_VALUE']),"null"=>(trim($J["FIELD_NOT_NULL_CONSTRAINT"])=="YES"),"auto_increment"=>'0',"collation"=>trim($J["FIELD_COLLATION"]),"privileges"=>array("insert"=>1,"select"=>1,"update"=>1),"comment"=>trim($J["FIELD_DESCRIPTION"]),);return$I;}function
indexes($Q,$h=null){$I=array();return$I;}function
foreign_keys($Q){return
array();}function
collations(){return
array();}function
information_schema($m){return
false;}function
error(){global$g;return
h($g->error);}function
types(){return
array();}function
schemas(){return
array();}function
get_schema(){return"";}function
set_schema($Xg){return
true;}function
support($Nc){return
preg_match("~^(columns|sql|status|table)$~",$Nc);}$y="firebird";$sf=array("=");$id=array();$od=array();$kc=array();}$cc["simpledb"]="SimpleDB";if(isset($_GET["simpledb"])){$eg=array("SimpleXML + allow_url_fopen");define("DRIVER","simpledb");if(class_exists('SimpleXMLElement')&&ini_bool('allow_url_fopen')){class
Min_DB{var$extension="SimpleXML",$server_info='2009-04-15',$error,$timeout,$next,$affected_rows,$_result;function
select_db($k){return($k=="domain");}function
query($G,$Ai=false){$Lf=array('SelectExpression'=>$G,'ConsistentRead'=>'true');if($this->next)$Lf['NextToken']=$this->next;$H=sdb_request_all('Select','Item',$Lf,$this->timeout);$this->timeout=0;if($H===false)return$H;if(preg_match('~^\s*SELECT\s+COUNT\(~i',$G)){$Jh=0;foreach($H
as$Zd)$Jh+=$Zd->Attribute->Value;$H=array((object)array('Attribute'=>array((object)array('Name'=>'Count','Value'=>$Jh,))));}return
new
Min_Result($H);}function
multi_query($G){return$this->_result=$this->query($G);}function
store_result(){return$this->_result;}function
next_result(){return
false;}function
quote($P){return"'".str_replace("'","''",$P)."'";}}class
Min_Result{var$num_rows,$_rows=array(),$_offset=0;function
__construct($H){foreach($H
as$Zd){$J=array();if($Zd->Name!='')$J['itemName()']=(string)$Zd->Name;foreach($Zd->Attribute
as$Ia){$C=$this->_processValue($Ia->Name);$Y=$this->_processValue($Ia->Value);if(isset($J[$C])){$J[$C]=(array)$J[$C];$J[$C][]=$Y;}else$J[$C]=$Y;}$this->_rows[]=$J;foreach($J
as$z=>$X){if(!isset($this->_rows[0][$z]))$this->_rows[0][$z]=null;}}$this->num_rows=count($this->_rows);}function
_processValue($nc){return(is_object($nc)&&$nc['encoding']=='base64'?base64_decode($nc):(string)$nc);}function
fetch_assoc(){$J=current($this->_rows);if(!$J)return$J;$I=array();foreach($this->_rows[0]as$z=>$X)$I[$z]=$J[$z];next($this->_rows);return$I;}function
fetch_row(){$I=$this->fetch_assoc();if(!$I)return$I;return
array_values($I);}function
fetch_field(){$fe=array_keys($this->_rows[0]);return(object)array('name'=>$fe[$this->_offset++]);}}}class
Min_Driver
extends
Min_SQL{public$hg="itemName()";function
_chunkRequest($Cd,$va,$Lf,$Cc=array()){global$g;foreach(array_chunk($Cd,25)as$hb){$Mf=$Lf;foreach($hb
as$t=>$u){$Mf["Item.$t.ItemName"]=$u;foreach($Cc
as$z=>$X)$Mf["Item.$t.$z"]=$X;}if(!sdb_request($va,$Mf))return
false;}$g->affected_rows=count($Cd);return
true;}function
_extractIds($Q,$tg,$_){$I=array();if(preg_match_all("~itemName\(\) = (('[^']*+')+)~",$tg,$Be))$I=array_map('idf_unescape',$Be[1]);else{foreach(sdb_request_all('Select','Item',array('SelectExpression'=>'SELECT itemName() FROM '.table($Q).$tg.($_?" LIMIT 1":"")))as$Zd)$I[]=$Zd->Name;}return$I;}function
select($Q,$L,$Z,$ld,$xf=array(),$_=1,$E=0,$jg=false){global$g;$g->next=$_GET["next"];$I=parent::select($Q,$L,$Z,$ld,$xf,$_,$E,$jg);$g->next=0;return$I;}function
delete($Q,$tg,$_=0){return$this->_chunkRequest($this->_extractIds($Q,$tg,$_),'BatchDeleteAttributes',array('DomainName'=>$Q));}function
update($Q,$O,$tg,$_=0,$M="\n"){$Sb=array();$Rd=array();$t=0;$Cd=$this->_extractIds($Q,$tg,$_);$u=idf_unescape($O["`itemName()`"]);unset($O["`itemName()`"]);foreach($O
as$z=>$X){$z=idf_unescape($z);if($X=="NULL"||($u!=""&&array($u)!=$Cd))$Sb["Attribute.".count($Sb).".Name"]=$z;if($X!="NULL"){foreach((array)$X
as$be=>$W){$Rd["Attribute.$t.Name"]=$z;$Rd["Attribute.$t.Value"]=(is_array($X)?$W:idf_unescape($W));if(!$be)$Rd["Attribute.$t.Replace"]="true";$t++;}}}$Lf=array('DomainName'=>$Q);return(!$Rd||$this->_chunkRequest(($u!=""?array($u):$Cd),'BatchPutAttributes',$Lf,$Rd))&&(!$Sb||$this->_chunkRequest($Cd,'BatchDeleteAttributes',$Lf,$Sb));}function
insert($Q,$O){$Lf=array("DomainName"=>$Q);$t=0;foreach($O
as$C=>$Y){if($Y!="NULL"){$C=idf_unescape($C);if($C=="itemName()")$Lf["ItemName"]=idf_unescape($Y);else{foreach((array)$Y
as$X){$Lf["Attribute.$t.Name"]=$C;$Lf["Attribute.$t.Value"]=(is_array($Y)?$X:idf_unescape($Y));$t++;}}}}return
sdb_request('PutAttributes',$Lf);}function
insertUpdate($Q,$K,$hg){foreach($K
as$O){if(!$this->update($Q,$O,"WHERE `itemName()` = ".q($O["`itemName()`"])))return
false;}return
true;}function
begin(){return
false;}function
commit(){return
false;}function
rollback(){return
false;}function
slowQuery($G,$di){$this->_conn->timeout=$di;return$G;}}function
connect(){global$b;list(,,$F)=$b->credentials();if($F!="")return'Database does not support password.';return
new
Min_DB;}function
support($Nc){return
preg_match('~sql~',$Nc);}function
logged_user(){global$b;$j=$b->credentials();return$j[1];}function
get_databases(){return
array("domain");}function
collations(){return
array();}function
db_collation($m,$ob){}function
tables_list(){global$g;$I=array();foreach(sdb_request_all('ListDomains','DomainName')as$Q)$I[(string)$Q]='table';if($g->error&&defined("PAGE_HEADER"))echo"<p class='error'>".error()."\n";return$I;}function
table_status($C="",$Mc=false){$I=array();foreach(($C!=""?array($C=>true):tables_list())as$Q=>$T){$J=array("Name"=>$Q,"Auto_increment"=>"");if(!$Mc){$Oe=sdb_request('DomainMetadata',array('DomainName'=>$Q));if($Oe){foreach(array("Rows"=>"ItemCount","Data_length"=>"ItemNamesSizeBytes","Index_length"=>"AttributeValuesSizeBytes","Data_free"=>"AttributeNamesSizeBytes",)as$z=>$X)$J[$z]=(string)$Oe->$X;}}if($C!="")return$J;$I[$Q]=$J;}return$I;}function
explain($g,$G){}function
error(){global$g;return
h($g->error);}function
information_schema(){}function
is_view($R){}function
indexes($Q,$h=null){return
array(array("type"=>"PRIMARY","columns"=>array("itemName()")),);}function
fields($Q){return
fields_from_edit();}function
foreign_keys($Q){return
array();}function
table($v){return
idf_escape($v);}function
idf_escape($v){return"`".str_replace("`","``",$v)."`";}function
limit($G,$Z,$_,$D=0,$M=" "){return" $G$Z".($_!==null?$M."LIMIT $_":"");}function
unconvert_field($p,$I){return$I;}function
fk_support($R){}function
engines(){return
array();}function
alter_table($Q,$C,$q,$ad,$tb,$sc,$d,$La,$Rf){return($Q==""&&sdb_request('CreateDomain',array('DomainName'=>$C)));}function
drop_tables($S){foreach($S
as$Q){if(!sdb_request('DeleteDomain',array('DomainName'=>$Q)))return
false;}return
true;}function
count_tables($l){foreach($l
as$m)return
array($m=>count(tables_list()));}function
found_rows($R,$Z){return($Z?null:$R["Rows"]);}function
last_id(){}function
hmac($Ba,$Jb,$z,$xg=false){$Ua=64;if(strlen($z)>$Ua)$z=pack("H*",$Ba($z));$z=str_pad($z,$Ua,"\0");$ce=$z^str_repeat("\x36",$Ua);$de=$z^str_repeat("\x5C",$Ua);$I=$Ba($de.pack("H*",$Ba($ce.$Jb)));if($xg)$I=pack("H*",$I);return$I;}function
sdb_request($va,$Lf=array()){global$b,$g;list($zd,$Lf['AWSAccessKeyId'],$ah)=$b->credentials();$Lf['Action']=$va;$Lf['Timestamp']=gmdate('Y-m-d\TH:i:s+00:00');$Lf['Version']='2009-04-15';$Lf['SignatureVersion']=2;$Lf['SignatureMethod']='HmacSHA1';ksort($Lf);$G='';foreach($Lf
as$z=>$X)$G.='&'.rawurlencode($z).'='.rawurlencode($X);$G=str_replace('%7E','~',substr($G,1));$G.="&Signature=".urlencode(base64_encode(hmac('sha1',"POST\n".preg_replace('~^https?://~','',$zd)."\n/\n$G",$ah,true)));@ini_set('track_errors',1);$Rc=@file_get_contents((preg_match('~^https?://~',$zd)?$zd:"http://$zd"),false,stream_context_create(array('http'=>array('method'=>'POST','content'=>$G,'ignore_errors'=>1,))));if(!$Rc){$g->error=$php_errormsg;return
false;}libxml_use_internal_errors(true);$kj=simplexml_load_string($Rc);if(!$kj){$o=libxml_get_last_error();$g->error=$o->message;return
false;}if($kj->Errors){$o=$kj->Errors->Error;$g->error="$o->Message ($o->Code)";return
false;}$g->error='';$Uh=$va."Result";return($kj->$Uh?$kj->$Uh:true);}function
sdb_request_all($va,$Uh,$Lf=array(),$di=0){$I=array();$Ah=($di?microtime(true):0);$_=(preg_match('~LIMIT\s+(\d+)\s*$~i',$Lf['SelectExpression'],$B)?$B[1]:0);do{$kj=sdb_request($va,$Lf);if(!$kj)break;foreach($kj->$Uh
as$nc)$I[]=$nc;if($_&&count($I)>=$_){$_GET["next"]=$kj->NextToken;break;}if($di&&microtime(true)-$Ah>$di)return
false;$Lf['NextToken']=$kj->NextToken;if($_)$Lf['SelectExpression']=preg_replace('~\d+\s*$~',$_-count($I),$Lf['SelectExpression']);}while($kj->NextToken);return$I;}$y="simpledb";$sf=array("=","<",">","<=",">=","!=","LIKE","LIKE %%","IN","IS NULL","NOT LIKE","IS NOT NULL");$id=array();$od=array("count");$kc=array(array("json"));}$cc["mongo"]="MongoDB";if(isset($_GET["mongo"])){$eg=array("mongo","mongodb");define("DRIVER","mongo");if(class_exists('MongoDB')){class
Min_DB{var$extension="Mongo",$server_info=MongoClient::VERSION,$error,$last_id,$_link,$_db;function
connect($Ii,$vf){return@new
MongoClient($Ii,$vf);}function
query($G){return
false;}function
select_db($k){try{$this->_db=$this->_link->selectDB($k);return
true;}catch(Exception$zc){$this->error=$zc->getMessage();return
false;}}function
quote($P){return$P;}}class
Min_Result{var$num_rows,$_rows=array(),$_offset=0,$_charset=array();function
__construct($H){foreach($H
as$Zd){$J=array();foreach($Zd
as$z=>$X){if(is_a($X,'MongoBinData'))$this->_charset[$z]=63;$J[$z]=(is_a($X,'MongoId')?'ObjectId("'.strval($X).'")':(is_a($X,'MongoDate')?gmdate("Y-m-d H:i:s",$X->sec)." GMT":(is_a($X,'MongoBinData')?$X->bin:(is_a($X,'MongoRegex')?strval($X):(is_object($X)?get_class($X):$X)))));}$this->_rows[]=$J;foreach($J
as$z=>$X){if(!isset($this->_rows[0][$z]))$this->_rows[0][$z]=null;}}$this->num_rows=count($this->_rows);}function
fetch_assoc(){$J=current($this->_rows);if(!$J)return$J;$I=array();foreach($this->_rows[0]as$z=>$X)$I[$z]=$J[$z];next($this->_rows);return$I;}function
fetch_row(){$I=$this->fetch_assoc();if(!$I)return$I;return
array_values($I);}function
fetch_field(){$fe=array_keys($this->_rows[0]);$C=$fe[$this->_offset++];return(object)array('name'=>$C,'charsetnr'=>$this->_charset[$C],);}}class
Min_Driver
extends
Min_SQL{public$hg="_id";function
select($Q,$L,$Z,$ld,$xf=array(),$_=1,$E=0,$jg=false){$L=($L==array("*")?array():array_fill_keys($L,true));$sh=array();foreach($xf
as$X){$X=preg_replace('~ DESC$~','',$X,1,$Cb);$sh[$X]=($Cb?-1:1);}return
new
Min_Result($this->_conn->_db->selectCollection($Q)->find(array(),$L)->sort($sh)->limit($_!=""?+$_:0)->skip($E*$_));}function
insert($Q,$O){try{$I=$this->_conn->_db->selectCollection($Q)->insert($O);$this->_conn->errno=$I['code'];$this->_conn->error=$I['err'];$this->_conn->last_id=$O['_id'];return!$I['err'];}catch(Exception$zc){$this->_conn->error=$zc->getMessage();return
false;}}}function
get_databases($Yc){global$g;$I=array();$Ob=$g->_link->listDBs();foreach($Ob['databases']as$m)$I[]=$m['name'];return$I;}function
count_tables($l){global$g;$I=array();foreach($l
as$m)$I[$m]=count($g->_link->selectDB($m)->getCollectionNames(true));return$I;}function
tables_list(){global$g;return
array_fill_keys($g->_db->getCollectionNames(true),'table');}function
drop_databases($l){global$g;foreach($l
as$m){$Jg=$g->_link->selectDB($m)->drop();if(!$Jg['ok'])return
false;}return
true;}function
indexes($Q,$h=null){global$g;$I=array();foreach($g->_db->selectCollection($Q)->getIndexInfo()as$w){$Vb=array();foreach($w["key"]as$e=>$T)$Vb[]=($T==-1?'1':null);$I[$w["name"]]=array("type"=>($w["name"]=="_id_"?"PRIMARY":($w["unique"]?"UNIQUE":"INDEX")),"columns"=>array_keys($w["key"]),"lengths"=>array(),"descs"=>$Vb,);}return$I;}function
fields($Q){return
fields_from_edit();}function
found_rows($R,$Z){global$g;return$g->_db->selectCollection($_GET["select"])->count($Z);}$sf=array("=");}elseif(class_exists('MongoDB\Driver\Manager')){class
Min_DB{var$extension="MongoDB",$server_info=MONGODB_VERSION,$error,$last_id;var$_link;var$_db,$_db_name;function
connect($Ii,$vf){$jb='MongoDB\Driver\Manager';return
new$jb($Ii,$vf);}function
query($G){return
false;}function
select_db($k){$this->_db_name=$k;return
true;}function
quote($P){return$P;}}class
Min_Result{var$num_rows,$_rows=array(),$_offset=0,$_charset=array();function
__construct($H){foreach($H
as$Zd){$J=array();foreach($Zd
as$z=>$X){if(is_a($X,'MongoDB\BSON\Binary'))$this->_charset[$z]=63;$J[$z]=(is_a($X,'MongoDB\BSON\ObjectID')?'MongoDB\BSON\ObjectID("'.strval($X).'")':(is_a($X,'MongoDB\BSON\UTCDatetime')?$X->toDateTime()->format('Y-m-d H:i:s'):(is_a($X,'MongoDB\BSON\Binary')?$X->bin:(is_a($X,'MongoDB\BSON\Regex')?strval($X):(is_object($X)?json_encode($X,256):$X)))));}$this->_rows[]=$J;foreach($J
as$z=>$X){if(!isset($this->_rows[0][$z]))$this->_rows[0][$z]=null;}}$this->num_rows=$H->count;}function
fetch_assoc(){$J=current($this->_rows);if(!$J)return$J;$I=array();foreach($this->_rows[0]as$z=>$X)$I[$z]=$J[$z];next($this->_rows);return$I;}function
fetch_row(){$I=$this->fetch_assoc();if(!$I)return$I;return
array_values($I);}function
fetch_field(){$fe=array_keys($this->_rows[0]);$C=$fe[$this->_offset++];return(object)array('name'=>$C,'charsetnr'=>$this->_charset[$C],);}}class
Min_Driver
extends
Min_SQL{public$hg="_id";function
select($Q,$L,$Z,$ld,$xf=array(),$_=1,$E=0,$jg=false){global$g;$L=($L==array("*")?array():array_fill_keys($L,1));if(count($L)&&!isset($L['_id']))$L['_id']=0;$Z=where_to_query($Z);$sh=array();foreach($xf
as$X){$X=preg_replace('~ DESC$~','',$X,1,$Cb);$sh[$X]=($Cb?-1:1);}if(isset($_GET['limit'])&&is_numeric($_GET['limit'])&&$_GET['limit']>0)$_=$_GET['limit'];$_=min(200,max(1,(int)$_));$ph=$E*$_;$jb='MongoDB\Driver\Query';$G=new$jb($Z,array('projection'=>$L,'limit'=>$_,'skip'=>$ph,'sort'=>$sh));$Mg=$g->_link->executeQuery("$g->_db_name.$Q",$G);return
new
Min_Result($Mg);}function
update($Q,$O,$tg,$_=0,$M="\n"){global$g;$m=$g->_db_name;$Z=sql_query_where_parser($tg);$jb='MongoDB\Driver\BulkWrite';$Ya=new$jb(array());if(isset($O['_id']))unset($O['_id']);$Gg=array();foreach($O
as$z=>$Y){if($Y=='NULL'){$Gg[$z]=1;unset($O[$z]);}}$Hi=array('$set'=>$O);if(count($Gg))$Hi['$unset']=$Gg;$Ya->update($Z,$Hi,array('upsert'=>false));$Mg=$g->_link->executeBulkWrite("$m.$Q",$Ya);$g->affected_rows=$Mg->getModifiedCount();return
true;}function
delete($Q,$tg,$_=0){global$g;$m=$g->_db_name;$Z=sql_query_where_parser($tg);$jb='MongoDB\Driver\BulkWrite';$Ya=new$jb(array());$Ya->delete($Z,array('limit'=>$_));$Mg=$g->_link->executeBulkWrite("$m.$Q",$Ya);$g->affected_rows=$Mg->getDeletedCount();return
true;}function
insert($Q,$O){global$g;$m=$g->_db_name;$jb='MongoDB\Driver\BulkWrite';$Ya=new$jb(array());if(isset($O['_id'])&&empty($O['_id']))unset($O['_id']);$Ya->insert($O);$Mg=$g->_link->executeBulkWrite("$m.$Q",$Ya);$g->affected_rows=$Mg->getInsertedCount();return
true;}}function
get_databases($Yc){global$g;$I=array();$jb='MongoDB\Driver\Command';$rb=new$jb(array('listDatabases'=>1));$Mg=$g->_link->executeCommand('admin',$rb);foreach($Mg
as$Ob){foreach($Ob->databases
as$m)$I[]=$m->name;}return$I;}function
count_tables($l){$I=array();return$I;}function
tables_list(){global$g;$jb='MongoDB\Driver\Command';$rb=new$jb(array('listCollections'=>1));$Mg=$g->_link->executeCommand($g->_db_name,$rb);$pb=array();foreach($Mg
as$H)$pb[$H->name]='table';return$pb;}function
drop_databases($l){return
false;}function
indexes($Q,$h=null){global$g;$I=array();$jb='MongoDB\Driver\Command';$rb=new$jb(array('listIndexes'=>$Q));$Mg=$g->_link->executeCommand($g->_db_name,$rb);foreach($Mg
as$w){$Vb=array();$f=array();foreach(get_object_vars($w->key)as$e=>$T){$Vb[]=($T==-1?'1':null);$f[]=$e;}$I[$w->name]=array("type"=>($w->name=="_id_"?"PRIMARY":(isset($w->unique)?"UNIQUE":"INDEX")),"columns"=>$f,"lengths"=>array(),"descs"=>$Vb,);}return$I;}function
fields($Q){$q=fields_from_edit();if(!count($q)){global$n;$H=$n->select($Q,array("*"),null,null,array(),10);while($J=$H->fetch_assoc()){foreach($J
as$z=>$X){$J[$z]=null;$q[$z]=array("field"=>$z,"type"=>"string","null"=>($z!=$n->primary),"auto_increment"=>($z==$n->primary),"privileges"=>array("insert"=>1,"select"=>1,"update"=>1,),);}}}return$q;}function
found_rows($R,$Z){global$g;$Z=where_to_query($Z);$jb='MongoDB\Driver\Command';$rb=new$jb(array('count'=>$R['Name'],'query'=>$Z));$Mg=$g->_link->executeCommand($g->_db_name,$rb);$li=$Mg->toArray();return$li[0]->n;}function
sql_query_where_parser($tg){$tg=trim(preg_replace('/WHERE[\s]?[(]?\(?/','',$tg));$tg=preg_replace('/\)\)\)$/',')',$tg);$hj=explode(' AND ',$tg);$ij=explode(') OR (',$tg);$Z=array();foreach($hj
as$fj)$Z[]=trim($fj);if(count($ij)==1)$ij=array();elseif(count($ij)>1)$Z=array();return
where_to_query($Z,$ij);}function
where_to_query($dj=array(),$ej=array()){global$b;$Jb=array();foreach(array('and'=>$dj,'or'=>$ej)as$T=>$Z){if(is_array($Z)){foreach($Z
as$Fc){list($mb,$qf,$X)=explode(" ",$Fc,3);if($mb=="_id"){$X=str_replace('MongoDB\BSON\ObjectID("',"",$X);$X=str_replace('")',"",$X);$jb='MongoDB\BSON\ObjectID';$X=new$jb($X);}if(!in_array($qf,$b->operators))continue;if(preg_match('~^\(f\)(.+)~',$qf,$B)){$X=(float)$X;$qf=$B[1];}elseif(preg_match('~^\(date\)(.+)~',$qf,$B)){$Lb=new
DateTime($X);$jb='MongoDB\BSON\UTCDatetime';$X=new$jb($Lb->getTimestamp()*1000);$qf=$B[1];}switch($qf){case'=':$qf='$eq';break;case'!=':$qf='$ne';break;case'>':$qf='$gt';break;case'<':$qf='$lt';break;case'>=':$qf='$gte';break;case'<=':$qf='$lte';break;case'regex':$qf='$regex';break;default:continue
2;}if($T=='and')$Jb['$and'][]=array($mb=>array($qf=>$X));elseif($T=='or')$Jb['$or'][]=array($mb=>array($qf=>$X));}}}return$Jb;}$sf=array("=","!=",">","<",">=","<=","regex","(f)=","(f)!=","(f)>","(f)<","(f)>=","(f)<=","(date)=","(date)!=","(date)>","(date)<","(date)>=","(date)<=",);}function
table($v){return$v;}function
idf_escape($v){return$v;}function
table_status($C="",$Mc=false){$I=array();foreach(tables_list()as$Q=>$T){$I[$Q]=array("Name"=>$Q);if($C==$Q)return$I[$Q];}return$I;}function
create_database($m,$d){return
true;}function
last_id(){global$g;return$g->last_id;}function
error(){global$g;return
h($g->error);}function
collations(){return
array();}function
logged_user(){global$b;$j=$b->credentials();return$j[1];}function
connect(){global$b;$g=new
Min_DB;list($N,$V,$F)=$b->credentials();$vf=array();if($V.$F!=""){$vf["username"]=$V;$vf["password"]=$F;}$m=$b->database();if($m!="")$vf["db"]=$m;try{$g->_link=$g->connect("mongodb://$N",$vf);if($F!=""){$vf["password"]="";try{$g->connect("mongodb://$N",$vf);return'Database does not support password.';}catch(Exception$zc){}}return$g;}catch(Exception$zc){return$zc->getMessage();}}function
alter_indexes($Q,$c){global$g;foreach($c
as$X){list($T,$C,$O)=$X;if($O=="DROP")$I=$g->_db->command(array("deleteIndexes"=>$Q,"index"=>$C));else{$f=array();foreach($O
as$e){$e=preg_replace('~ DESC$~','',$e,1,$Cb);$f[$e]=($Cb?-1:1);}$I=$g->_db->selectCollection($Q)->ensureIndex($f,array("unique"=>($T=="UNIQUE"),"name"=>$C,));}if($I['errmsg']){$g->error=$I['errmsg'];return
false;}}return
true;}function
support($Nc){return
preg_match("~database|indexes|descidx~",$Nc);}function
db_collation($m,$ob){}function
information_schema(){}function
is_view($R){}function
convert_field($p){}function
unconvert_field($p,$I){return$I;}function
foreign_keys($Q){return
array();}function
fk_support($R){}function
engines(){return
array();}function
alter_table($Q,$C,$q,$ad,$tb,$sc,$d,$La,$Rf){global$g;if($Q==""){$g->_db->createCollection($C);return
true;}}function
drop_tables($S){global$g;foreach($S
as$Q){$Jg=$g->_db->selectCollection($Q)->drop();if(!$Jg['ok'])return
false;}return
true;}function
truncate_tables($S){global$g;foreach($S
as$Q){$Jg=$g->_db->selectCollection($Q)->remove();if(!$Jg['ok'])return
false;}return
true;}$y="mongo";$id=array();$od=array();$kc=array(array("json"));}$cc["elastic"]="Elasticsearch (beta)";if(isset($_GET["elastic"])){$eg=array("json + allow_url_fopen");define("DRIVER","elastic");if(function_exists('json_decode')&&ini_bool('allow_url_fopen')){class
Min_DB{var$extension="JSON",$server_info,$errno,$error,$_url;function
rootQuery($Vf,$yb=array(),$Pe='GET'){@ini_set('track_errors',1);$Rc=@file_get_contents("$this->_url/".ltrim($Vf,'/'),false,stream_context_create(array('http'=>array('method'=>$Pe,'content'=>$yb===null?$yb:json_encode($yb),'header'=>'Content-Type: application/json','ignore_errors'=>1,))));if(!$Rc){$this->error=$php_errormsg;return$Rc;}if(!preg_match('~^HTTP/[0-9.]+ 2~i',$http_response_header[0])){$this->error=$Rc;return
false;}$I=json_decode($Rc,true);if($I===null){$this->errno=json_last_error();if(function_exists('json_last_error_msg'))$this->error=json_last_error_msg();else{$xb=get_defined_constants(true);foreach($xb['json']as$C=>$Y){if($Y==$this->errno&&preg_match('~^JSON_ERROR_~',$C)){$this->error=$C;break;}}}}return$I;}function
query($Vf,$yb=array(),$Pe='GET'){return$this->rootQuery(($this->_db!=""?"$this->_db/":"/").ltrim($Vf,'/'),$yb,$Pe);}function
connect($N,$V,$F){preg_match('~^(https?://)?(.*)~',$N,$B);$this->_url=($B[1]?$B[1]:"http://")."$V:$F@$B[2]";$I=$this->query('');if($I)$this->server_info=$I['version']['number'];return(bool)$I;}function
select_db($k){$this->_db=$k;return
true;}function
quote($P){return$P;}}class
Min_Result{var$num_rows,$_rows;function
__construct($K){$this->num_rows=count($this->_rows);$this->_rows=$K;reset($this->_rows);}function
fetch_assoc(){$I=current($this->_rows);next($this->_rows);return$I;}function
fetch_row(){return
array_values($this->fetch_assoc());}}}class
Min_Driver
extends
Min_SQL{function
select($Q,$L,$Z,$ld,$xf=array(),$_=1,$E=0,$jg=false){global$b;$Jb=array();$G="$Q/_search";if($L!=array("*"))$Jb["fields"]=$L;if($xf){$sh=array();foreach($xf
as$mb){$mb=preg_replace('~ DESC$~','',$mb,1,$Cb);$sh[]=($Cb?array($mb=>"desc"):$mb);}$Jb["sort"]=$sh;}if($_){$Jb["size"]=+$_;if($E)$Jb["from"]=($E*$_);}foreach($Z
as$X){list($mb,$qf,$X)=explode(" ",$X,3);if($mb=="_id")$Jb["query"]["ids"]["values"][]=$X;elseif($mb.$X!=""){$Yh=array("term"=>array(($mb!=""?$mb:"_all")=>$X));if($qf=="=")$Jb["query"]["filtered"]["filter"]["and"][]=$Yh;else$Jb["query"]["filtered"]["query"]["bool"]["must"][]=$Yh;}}if($Jb["query"]&&!$Jb["query"]["filtered"]["query"]&&!$Jb["query"]["ids"])$Jb["query"]["filtered"]["query"]=array("match_all"=>array());$Ah=microtime(true);$Zg=$this->_conn->query($G,$Jb);if($jg)echo$b->selectQuery("$G: ".print_r($Jb,true),$Ah,!$Zg);if(!$Zg)return
false;$I=array();foreach($Zg['hits']['hits']as$yd){$J=array();if($L==array("*"))$J["_id"]=$yd["_id"];$q=$yd['_source'];if($L!=array("*")){$q=array();foreach($L
as$z)$q[$z]=$yd['fields'][$z];}foreach($q
as$z=>$X){if($Jb["fields"])$X=$X[0];$J[$z]=(is_array($X)?json_encode($X):$X);}$I[]=$J;}return
new
Min_Result($I);}function
update($T,$yg,$tg,$_=0,$M="\n"){$Tf=preg_split('~ *= *~',$tg);if(count($Tf)==2){$u=trim($Tf[1]);$G="$T/$u";return$this->_conn->query($G,$yg,'POST');}return
false;}function
insert($T,$yg){$u="";$G="$T/$u";$Jg=$this->_conn->query($G,$yg,'POST');$this->_conn->last_id=$Jg['_id'];return$Jg['created'];}function
delete($T,$tg,$_=0){$Cd=array();if(is_array($_GET["where"])&&$_GET["where"]["_id"])$Cd[]=$_GET["where"]["_id"];if(is_array($_POST['check'])){foreach($_POST['check']as$cb){$Tf=preg_split('~ *= *~',$cb);if(count($Tf)==2)$Cd[]=trim($Tf[1]);}}$this->_conn->affected_rows=0;foreach($Cd
as$u){$G="{$T}/{$u}";$Jg=$this->_conn->query($G,'{}','DELETE');if(is_array($Jg)&&$Jg['found']==true)$this->_conn->affected_rows++;}return$this->_conn->affected_rows;}}function
connect(){global$b;$g=new
Min_DB;list($N,$V,$F)=$b->credentials();if($F!=""&&$g->connect($N,$V,""))return'Database does not support password.';if($g->connect($N,$V,$F))return$g;return$g->error;}function
support($Nc){return
preg_match("~database|table|columns~",$Nc);}function
logged_user(){global$b;$j=$b->credentials();return$j[1];}function
get_databases(){global$g;$I=$g->rootQuery('_aliases');if($I){$I=array_keys($I);sort($I,SORT_STRING);}return$I;}function
collations(){return
array();}function
db_collation($m,$ob){}function
engines(){return
array();}function
count_tables($l){global$g;$I=array();$H=$g->query('_stats');if($H&&$H['indices']){$Kd=$H['indices'];foreach($Kd
as$Jd=>$Bh){$Id=$Bh['total']['indexing'];$I[$Jd]=$Id['index_total'];}}return$I;}function
tables_list(){global$g;$I=$g->query('_mapping');if($I)$I=array_fill_keys(array_keys($I[$g->_db]["mappings"]),'table');return$I;}function
table_status($C="",$Mc=false){global$g;$Zg=$g->query("_search",array("size"=>0,"aggregations"=>array("count_by_type"=>array("terms"=>array("field"=>"_type")))),"POST");$I=array();if($Zg){$S=$Zg["aggregations"]["count_by_type"]["buckets"];foreach($S
as$Q){$I[$Q["key"]]=array("Name"=>$Q["key"],"Engine"=>"table","Rows"=>$Q["doc_count"],);if($C!=""&&$C==$Q["key"])return$I[$C];}}return$I;}function
error(){global$g;return
h($g->error);}function
information_schema(){}function
is_view($R){}function
indexes($Q,$h=null){return
array(array("type"=>"PRIMARY","columns"=>array("_id")),);}function
fields($Q){global$g;$H=$g->query("$Q/_mapping");$I=array();if($H){$ye=$H[$Q]['properties'];if(!$ye)$ye=$H[$g->_db]['mappings'][$Q]['properties'];if($ye){foreach($ye
as$C=>$p){$I[$C]=array("field"=>$C,"full_type"=>$p["type"],"type"=>$p["type"],"privileges"=>array("insert"=>1,"select"=>1,"update"=>1),);if($p["properties"]){unset($I[$C]["privileges"]["insert"]);unset($I[$C]["privileges"]["update"]);}}}}return$I;}function
foreign_keys($Q){return
array();}function
table($v){return$v;}function
idf_escape($v){return$v;}function
convert_field($p){}function
unconvert_field($p,$I){return$I;}function
fk_support($R){}function
found_rows($R,$Z){return
null;}function
create_database($m){global$g;return$g->rootQuery(urlencode($m),null,'PUT');}function
drop_databases($l){global$g;return$g->rootQuery(urlencode(implode(',',$l)),array(),'DELETE');}function
alter_table($Q,$C,$q,$ad,$tb,$sc,$d,$La,$Rf){global$g;$pg=array();foreach($q
as$Kc){$Pc=trim($Kc[1][0]);$Qc=trim($Kc[1][1]?$Kc[1][1]:"text");$pg[$Pc]=array('type'=>$Qc);}if(!empty($pg))$pg=array('properties'=>$pg);return$g->query("_mapping/{$C}",$pg,'PUT');}function
drop_tables($S){global$g;$I=true;foreach($S
as$Q)$I=$I&&$g->query(urlencode($Q),array(),'DELETE');return$I;}function
last_id(){global$g;return$g->last_id;}$y="elastic";$sf=array("=","query");$id=array();$od=array();$kc=array(array("json"));$U=array();$Fh=array();foreach(array('Numbers'=>array("long"=>3,"integer"=>5,"short"=>8,"byte"=>10,"double"=>20,"float"=>66,"half_float"=>12,"scaled_float"=>21),'Date and time'=>array("date"=>10),'Strings'=>array("string"=>65535,"text"=>65535),'Binary'=>array("binary"=>255),)as$z=>$X){$U+=$X;$Fh[$z]=array_keys($X);}}$cc["clickhouse"]="ClickHouse (alpha)";if(isset($_GET["clickhouse"])){define("DRIVER","clickhouse");class
Min_DB{var$extension="JSON",$server_info,$errno,$_result,$error,$_url;var$_db='default';function
rootQuery($m,$G){@ini_set('track_errors',1);$Rc=@file_get_contents("$this->_url/?database=$m",false,stream_context_create(array('http'=>array('method'=>'POST','content'=>$this->isQuerySelectLike($G)?"$G FORMAT JSONCompact":$G,'header'=>'Content-type: application/x-www-form-urlencoded','ignore_errors'=>1,))));if($Rc===false){$this->error=$php_errormsg;return$Rc;}if(!preg_match('~^HTTP/[0-9.]+ 2~i',$http_response_header[0])){$this->error=$Rc;return
false;}$I=json_decode($Rc,true);if($I===null){$this->errno=json_last_error();if(function_exists('json_last_error_msg'))$this->error=json_last_error_msg();else{$xb=get_defined_constants(true);foreach($xb['json']as$C=>$Y){if($Y==$this->errno&&preg_match('~^JSON_ERROR_~',$C)){$this->error=$C;break;}}}}return
new
Min_Result($I);}function
isQuerySelectLike($G){return(bool)preg_match('~^(select|show)~i',$G);}function
query($G){return$this->rootQuery($this->_db,$G);}function
connect($N,$V,$F){preg_match('~^(https?://)?(.*)~',$N,$B);$this->_url=($B[1]?$B[1]:"http://")."$V:$F@$B[2]";$I=$this->query('SELECT 1');return(bool)$I;}function
select_db($k){$this->_db=$k;return
true;}function
quote($P){return"'".addcslashes($P,"\\'")."'";}function
multi_query($G){return$this->_result=$this->query($G);}function
store_result(){return$this->_result;}function
next_result(){return
false;}function
result($G,$p=0){$H=$this->query($G);return$H['data'];}}class
Min_Result{var$num_rows,$_rows,$columns,$meta,$_offset=0;function
__construct($H){$this->num_rows=$H['rows'];$this->_rows=$H['data'];$this->meta=$H['meta'];$this->columns=array_column($this->meta,'name');reset($this->_rows);}function
fetch_assoc(){$J=current($this->_rows);next($this->_rows);return$J===false?false:array_combine($this->columns,$J);}function
fetch_row(){$J=current($this->_rows);next($this->_rows);return$J;}function
fetch_field(){$e=$this->_offset++;$I=new
stdClass;if($e<count($this->columns)){$I->name=$this->meta[$e]['name'];$I->orgname=$I->name;$I->type=$this->meta[$e]['type'];}return$I;}}class
Min_Driver
extends
Min_SQL{function
delete($Q,$tg,$_=0){return
queries("ALTER TABLE ".table($Q)." DELETE $tg");}function
update($Q,$O,$tg,$_=0,$M="\n"){$Si=array();foreach($O
as$z=>$X)$Si[]="$z = $X";$G=$M.implode(",$M",$Si);return
queries("ALTER TABLE ".table($Q)." UPDATE $G$tg");}}function
idf_escape($v){return"`".str_replace("`","``",$v)."`";}function
table($v){return
idf_escape($v);}function
explain($g,$G){return'';}function
found_rows($R,$Z){$K=get_vals("SELECT COUNT(*) FROM ".idf_escape($R["Name"]).($Z?" WHERE ".implode(" AND ",$Z):""));return
empty($K)?false:$K[0];}function
alter_table($Q,$C,$q,$ad,$tb,$sc,$d,$La,$Rf){foreach($q
as$p){if($p[1][2]===" NULL")$p[1][1]=" Nullable({$p[1][1]})";unset($p[1][2]);}}function
truncate_tables($S){return
apply_queries("TRUNCATE TABLE",$S);}function
drop_views($Xi){return
drop_tables($Xi);}function
drop_tables($S){return
apply_queries("DROP TABLE",$S);}function
connect(){global$b;$g=new
Min_DB;$j=$b->credentials();if($g->connect($j[0],$j[1],$j[2]))return$g;return$g->error;}function
get_databases($Yc){global$g;$H=get_rows('SHOW DATABASES');$I=array();foreach($H
as$J)$I[]=$J['name'];sort($I);return$I;}function
limit($G,$Z,$_,$D=0,$M=" "){return" $G$Z".($_!==null?$M."LIMIT $_".($D?", $D":""):"");}function
limit1($Q,$G,$Z,$M="\n"){return
limit($G,$Z,1,0,$M);}function
db_collation($m,$ob){}function
engines(){return
array('MergeTree');}function
logged_user(){global$b;$j=$b->credentials();return$j[1];}function
tables_list(){$H=get_rows('SHOW TABLES');$I=array();foreach($H
as$J)$I[$J['name']]='table';ksort($I);return$I;}function
count_tables($l){return
array();}function
table_status($C="",$Mc=false){global$g;$I=array();$S=get_rows("SELECT name, engine FROM system.tables WHERE database = ".q($g->_db));foreach($S
as$Q){$I[$Q['name']]=array('Name'=>$Q['name'],'Engine'=>$Q['engine'],);if($C===$Q['name'])return$I[$Q['name']];}return$I;}function
is_view($R){return
false;}function
fk_support($R){return
false;}function
convert_field($p){}function
unconvert_field($p,$I){if(in_array($p['type'],array("Int8","Int16","Int32","Int64","UInt8","UInt16","UInt32","UInt64","Float32","Float64")))return"to$p[type]($I)";return$I;}function
fields($Q){$I=array();$H=get_rows("SELECT name, type, default_expression FROM system.columns WHERE ".idf_escape('table')." = ".q($Q));foreach($H
as$J){$T=trim($J['type']);$cf=strpos($T,'Nullable(')===0;$I[trim($J['name'])]=array("field"=>trim($J['name']),"full_type"=>$T,"type"=>$T,"default"=>trim($J['default_expression']),"null"=>$cf,"auto_increment"=>'0',"privileges"=>array("insert"=>1,"select"=>1,"update"=>0),);}return$I;}function
indexes($Q,$h=null){return
array();}function
foreign_keys($Q){return
array();}function
collations(){return
array();}function
information_schema($m){return
false;}function
error(){global$g;return
h($g->error);}function
types(){return
array();}function
schemas(){return
array();}function
get_schema(){return"";}function
set_schema($Xg){return
true;}function
auto_increment(){return'';}function
last_id(){return
0;}function
support($Nc){return
preg_match("~^(columns|sql|status|table)$~",$Nc);}$y="clickhouse";$U=array();$Fh=array();foreach(array('Numbers'=>array("Int8"=>3,"Int16"=>5,"Int32"=>10,"Int64"=>19,"UInt8"=>3,"UInt16"=>5,"UInt32"=>10,"UInt64"=>20,"Float32"=>7,"Float64"=>16,'Decimal'=>38,'Decimal32'=>9,'Decimal64'=>18,'Decimal128'=>38),'Date and time'=>array("Date"=>13,"DateTime"=>20),'Strings'=>array("String"=>0),'Binary'=>array("FixedString"=>0),)as$z=>$X){$U+=$X;$Fh[$z]=array_keys($X);}$Gi=array();$sf=array("=","<",">","<=",">=","!=","~","!~","LIKE","LIKE %%","IN","IS NULL","NOT LIKE","NOT IN","IS NOT NULL","SQL");$id=array();$od=array("avg","count","count distinct","max","min","sum");$kc=array();}$cc=array("server"=>"MySQL")+$cc;if(!defined("DRIVER")){$eg=array("MySQLi","MySQL","PDO_MySQL");define("DRIVER","server");if(extension_loaded("mysqli")){class
Min_DB
extends
MySQLi{var$extension="MySQLi";function
__construct(){parent::init();}function
connect($N="",$V="",$F="",$k=null,$ag=null,$rh=null){global$b;mysqli_report(MYSQLI_REPORT_OFF);list($zd,$ag)=explode(":",$N,2);$_h=$b->connectSsl();if($_h)$this->ssl_set($_h['key'],$_h['cert'],$_h['ca'],'','');$I=@$this->real_connect(($N!=""?$zd:ini_get("mysqli.default_host")),($N.$V!=""?$V:ini_get("mysqli.default_user")),($N.$V.$F!=""?$F:ini_get("mysqli.default_pw")),$k,(is_numeric($ag)?$ag:ini_get("mysqli.default_port")),(!is_numeric($ag)?$ag:$rh),($_h?64:0));$this->options(MYSQLI_OPT_LOCAL_INFILE,false);return$I;}function
set_charset($bb){if(parent::set_charset($bb))return
true;parent::set_charset('utf8');return$this->query("SET NAMES $bb");}function
result($G,$p=0){$H=$this->query($G);if(!$H)return
false;$J=$H->fetch_array();return$J[$p];}function
quote($P){return"'".$this->escape_string($P)."'";}}}elseif(extension_loaded("mysql")&&!((ini_bool("sql.safe_mode")||ini_bool("mysql.allow_local_infile"))&&extension_loaded("pdo_mysql"))){class
Min_DB{var$extension="MySQL",$server_info,$affected_rows,$errno,$error,$_link,$_result;function
connect($N,$V,$F){if(ini_bool("mysql.allow_local_infile")){$this->error=sprintf('Disable %s or enable %s or %s extensions.',"'mysql.allow_local_infile'","MySQLi","PDO_MySQL");return
false;}$this->_link=@mysql_connect(($N!=""?$N:ini_get("mysql.default_host")),("$N$V"!=""?$V:ini_get("mysql.default_user")),("$N$V$F"!=""?$F:ini_get("mysql.default_password")),true,131072);if($this->_link)$this->server_info=mysql_get_server_info($this->_link);else$this->error=mysql_error();return(bool)$this->_link;}function
set_charset($bb){if(function_exists('mysql_set_charset')){if(mysql_set_charset($bb,$this->_link))return
true;mysql_set_charset('utf8',$this->_link);}return$this->query("SET NAMES $bb");}function
quote($P){return"'".mysql_real_escape_string($P,$this->_link)."'";}function
select_db($k){return
mysql_select_db($k,$this->_link);}function
query($G,$Ai=false){$H=@($Ai?mysql_unbuffered_query($G,$this->_link):mysql_query($G,$this->_link));$this->error="";if(!$H){$this->errno=mysql_errno($this->_link);$this->error=mysql_error($this->_link);return
false;}if($H===true){$this->affected_rows=mysql_affected_rows($this->_link);$this->info=mysql_info($this->_link);return
true;}return
new
Min_Result($H);}function
multi_query($G){return$this->_result=$this->query($G);}function
store_result(){return$this->_result;}function
next_result(){return
false;}function
result($G,$p=0){$H=$this->query($G);if(!$H||!$H->num_rows)return
false;return
mysql_result($H->_result,0,$p);}}class
Min_Result{var$num_rows,$_result,$_offset=0;function
__construct($H){$this->_result=$H;$this->num_rows=mysql_num_rows($H);}function
fetch_assoc(){return
mysql_fetch_assoc($this->_result);}function
fetch_row(){return
mysql_fetch_row($this->_result);}function
fetch_field(){$I=mysql_fetch_field($this->_result,$this->_offset++);$I->orgtable=$I->table;$I->orgname=$I->name;$I->charsetnr=($I->blob?63:0);return$I;}function
__destruct(){mysql_free_result($this->_result);}}}elseif(extension_loaded("pdo_mysql")){class
Min_DB
extends
Min_PDO{var$extension="PDO_MySQL";function
connect($N,$V,$F){global$b;$vf=array(PDO::MYSQL_ATTR_LOCAL_INFILE=>false);$_h=$b->connectSsl();if($_h)$vf+=array(PDO::MYSQL_ATTR_SSL_KEY=>$_h['key'],PDO::MYSQL_ATTR_SSL_CERT=>$_h['cert'],PDO::MYSQL_ATTR_SSL_CA=>$_h['ca'],);$this->dsn("mysql:charset=utf8;host=".str_replace(":",";unix_socket=",preg_replace('~:(\d)~',';port=\1',$N)),$V,$F,$vf);return
true;}function
set_charset($bb){$this->query("SET NAMES $bb");}function
select_db($k){return$this->query("USE ".idf_escape($k));}function
query($G,$Ai=false){$this->setAttribute(1000,!$Ai);return
parent::query($G,$Ai);}}}class
Min_Driver
extends
Min_SQL{function
insert($Q,$O){return($O?parent::insert($Q,$O):queries("INSERT INTO ".table($Q)." ()\nVALUES ()"));}function
insertUpdate($Q,$K,$hg){$f=array_keys(reset($K));$fg="INSERT INTO ".table($Q)." (".implode(", ",$f).") VALUES\n";$Si=array();foreach($f
as$z)$Si[$z]="$z = VALUES($z)";$Ih="\nON DUPLICATE KEY UPDATE ".implode(", ",$Si);$Si=array();$re=0;foreach($K
as$O){$Y="(".implode(", ",$O).")";if($Si&&(strlen($fg)+$re+strlen($Y)+strlen($Ih)>1e6)){if(!queries($fg.implode(",\n",$Si).$Ih))return
false;$Si=array();$re=0;}$Si[]=$Y;$re+=strlen($Y)+2;}return
queries($fg.implode(",\n",$Si).$Ih);}function
slowQuery($G,$di){if(min_version('5.7.8','10.1.2')){if(preg_match('~MariaDB~',$this->_conn->server_info))return"SET STATEMENT max_statement_time=$di FOR $G";elseif(preg_match('~^(SELECT\b)(.+)~is',$G,$B))return"$B[1] /*+ MAX_EXECUTION_TIME(".($di*1000).") */ $B[2]";}}function
convertSearch($v,$X,$p){return(preg_match('~char|text|enum|set~',$p["type"])&&!preg_match("~^utf8~",$p["collation"])&&preg_match('~[\x80-\xFF]~',$X['val'])?"CONVERT($v USING ".charset($this->_conn).")":$v);}function
warnings(){$H=$this->_conn->query("SHOW WARNINGS");if($H&&$H->num_rows){ob_start();select($H);return
ob_get_clean();}}function
tableHelp($C){$ze=preg_match('~MariaDB~',$this->_conn->server_info);if(information_schema(DB))return
strtolower(($ze?"information-schema-$C-table/":str_replace("_","-",$C)."-table.html"));if(DB=="mysql")return($ze?"mysql$C-table/":"system-database.html");}}function
idf_escape($v){return"`".str_replace("`","``",$v)."`";}function
table($v){return
idf_escape($v);}function
connect(){global$b,$U,$Fh;$g=new
Min_DB;$j=$b->credentials();if($g->connect($j[0],$j[1],$j[2])){$g->set_charset(charset($g));$g->query("SET sql_quote_show_create = 1, autocommit = 1");if(min_version('5.7.8',10.2,$g)){$Fh['Strings'][]="json";$U["json"]=4294967295;}return$g;}$I=$g->error;if(function_exists('iconv')&&!is_utf8($I)&&strlen($Vg=iconv("windows-1250","utf-8",$I))>strlen($I))$I=$Vg;return$I;}function
get_databases($Yc){$I=get_session("dbs");if($I===null){$G=(min_version(5)?"SELECT SCHEMA_NAME FROM information_schema.SCHEMATA ORDER BY SCHEMA_NAME":"SHOW DATABASES");$I=($Yc?slow_query($G):get_vals($G));restart_session();set_session("dbs",$I);stop_session();}return$I;}function
limit($G,$Z,$_,$D=0,$M=" "){return" $G$Z".($_!==null?$M."LIMIT $_".($D?" OFFSET $D":""):"");}function
limit1($Q,$G,$Z,$M="\n"){return
limit($G,$Z,1,0,$M);}function
db_collation($m,$ob){global$g;$I=null;$i=$g->result("SHOW CREATE DATABASE ".idf_escape($m),1);if(preg_match('~ COLLATE ([^ ]+)~',$i,$B))$I=$B[1];elseif(preg_match('~ CHARACTER SET ([^ ]+)~',$i,$B))$I=$ob[$B[1]][-1];return$I;}function
engines(){$I=array();foreach(get_rows("SHOW ENGINES")as$J){if(preg_match("~YES|DEFAULT~",$J["Support"]))$I[]=$J["Engine"];}return$I;}function
logged_user(){global$g;return$g->result("SELECT USER()");}function
tables_list(){return
get_key_vals(min_version(5)?"SELECT TABLE_NAME, TABLE_TYPE FROM information_schema.TABLES WHERE TABLE_SCHEMA = DATABASE() ORDER BY TABLE_NAME":"SHOW TABLES");}function
count_tables($l){$I=array();foreach($l
as$m)$I[$m]=count(get_vals("SHOW TABLES IN ".idf_escape($m)));return$I;}function
table_status($C="",$Mc=false){$I=array();foreach(get_rows($Mc&&min_version(5)?"SELECT TABLE_NAME AS Name, ENGINE AS Engine, TABLE_COMMENT AS Comment FROM information_schema.TABLES WHERE TABLE_SCHEMA = DATABASE() ".($C!=""?"AND TABLE_NAME = ".q($C):"ORDER BY Name"):"SHOW TABLE STATUS".($C!=""?" LIKE ".q(addcslashes($C,"%_\\")):""))as$J){if($J["Engine"]=="InnoDB")$J["Comment"]=preg_replace('~(?:(.+); )?InnoDB free: .*~','\1',$J["Comment"]);if(!isset($J["Engine"]))$J["Comment"]="";if($C!="")return$J;$I[$J["Name"]]=$J;}return$I;}function
is_view($R){return$R["Engine"]===null;}function
fk_support($R){return
preg_match('~InnoDB|IBMDB2I~i',$R["Engine"])||(preg_match('~NDB~i',$R["Engine"])&&min_version(5.6));}function
fields($Q){$I=array();foreach(get_rows("SHOW FULL COLUMNS FROM ".table($Q))as$J){preg_match('~^([^( ]+)(?:\((.+)\))?( unsigned)?( zerofill)?$~',$J["Type"],$B);$I[$J["Field"]]=array("field"=>$J["Field"],"full_type"=>$J["Type"],"type"=>$B[1],"length"=>$B[2],"unsigned"=>ltrim($B[3].$B[4]),"default"=>($J["Default"]!=""||preg_match("~char|set~",$B[1])?$J["Default"]:null),"null"=>($J["Null"]=="YES"),"auto_increment"=>($J["Extra"]=="auto_increment"),"on_update"=>(preg_match('~^on update (.+)~i',$J["Extra"],$B)?$B[1]:""),"collation"=>$J["Collation"],"privileges"=>array_flip(preg_split('~, *~',$J["Privileges"])),"comment"=>$J["Comment"],"primary"=>($J["Key"]=="PRI"),);}return$I;}function
indexes($Q,$h=null){$I=array();foreach(get_rows("SHOW INDEX FROM ".table($Q),$h)as$J){$C=$J["Key_name"];$I[$C]["type"]=($C=="PRIMARY"?"PRIMARY":($J["Index_type"]=="FULLTEXT"?"FULLTEXT":($J["Non_unique"]?($J["Index_type"]=="SPATIAL"?"SPATIAL":"INDEX"):"UNIQUE")));$I[$C]["columns"][]=$J["Column_name"];$I[$C]["lengths"][]=($J["Index_type"]=="SPATIAL"?null:$J["Sub_part"]);$I[$C]["descs"][]=null;}return$I;}function
foreign_keys($Q){global$g,$nf;static$Xf='(?:`(?:[^`]|``)+`)|(?:"(?:[^"]|"")+")';$I=array();$Db=$g->result("SHOW CREATE TABLE ".table($Q),1);if($Db){preg_match_all("~CONSTRAINT ($Xf) FOREIGN KEY ?\\(((?:$Xf,? ?)+)\\) REFERENCES ($Xf)(?:\\.($Xf))? \\(((?:$Xf,? ?)+)\\)(?: ON DELETE ($nf))?(?: ON UPDATE ($nf))?~",$Db,$Be,PREG_SET_ORDER);foreach($Be
as$B){preg_match_all("~$Xf~",$B[2],$th);preg_match_all("~$Xf~",$B[5],$Vh);$I[idf_unescape($B[1])]=array("db"=>idf_unescape($B[4]!=""?$B[3]:$B[4]),"table"=>idf_unescape($B[4]!=""?$B[4]:$B[3]),"source"=>array_map('idf_unescape',$th[0]),"target"=>array_map('idf_unescape',$Vh[0]),"on_delete"=>($B[6]?$B[6]:"RESTRICT"),"on_update"=>($B[7]?$B[7]:"RESTRICT"),);}}return$I;}function
view($C){global$g;return
array("select"=>preg_replace('~^(?:[^`]|`[^`]*`)*\s+AS\s+~isU','',$g->result("SHOW CREATE VIEW ".table($C),1)));}function
collations(){$I=array();foreach(get_rows("SHOW COLLATION")as$J){if($J["Default"])$I[$J["Charset"]][-1]=$J["Collation"];else$I[$J["Charset"]][]=$J["Collation"];}ksort($I);foreach($I
as$z=>$X)asort($I[$z]);return$I;}function
information_schema($m){return(min_version(5)&&$m=="information_schema")||(min_version(5.5)&&$m=="performance_schema");}function
error(){global$g;return
h(preg_replace('~^You have an error.*syntax to use~U',"Syntax error",$g->error));}function
create_database($m,$d){return
queries("CREATE DATABASE ".idf_escape($m).($d?" COLLATE ".q($d):""));}function
drop_databases($l){$I=apply_queries("DROP DATABASE",$l,'idf_escape');restart_session();set_session("dbs",null);return$I;}function
rename_database($C,$d){$I=false;if(create_database($C,$d)){$Hg=array();foreach(tables_list()as$Q=>$T)$Hg[]=table($Q)." TO ".idf_escape($C).".".table($Q);$I=(!$Hg||queries("RENAME TABLE ".implode(", ",$Hg)));if($I)queries("DROP DATABASE ".idf_escape(DB));restart_session();set_session("dbs",null);}return$I;}function
auto_increment(){$Ma=" PRIMARY KEY";if($_GET["create"]!=""&&$_POST["auto_increment_col"]){foreach(indexes($_GET["create"])as$w){if(in_array($_POST["fields"][$_POST["auto_increment_col"]]["orig"],$w["columns"],true)){$Ma="";break;}if($w["type"]=="PRIMARY")$Ma=" UNIQUE";}}return" AUTO_INCREMENT$Ma";}function
alter_table($Q,$C,$q,$ad,$tb,$sc,$d,$La,$Rf){$c=array();foreach($q
as$p)$c[]=($p[1]?($Q!=""?($p[0]!=""?"CHANGE ".idf_escape($p[0]):"ADD"):" ")." ".implode($p[1]).($Q!=""?$p[2]:""):"DROP ".idf_escape($p[0]));$c=array_merge($c,$ad);$Ch=($tb!==null?" COMMENT=".q($tb):"").($sc?" ENGINE=".q($sc):"").($d?" COLLATE ".q($d):"").($La!=""?" AUTO_INCREMENT=$La":"");if($Q=="")return
queries("CREATE TABLE ".table($C)." (\n".implode(",\n",$c)."\n)$Ch$Rf");if($Q!=$C)$c[]="RENAME TO ".table($C);if($Ch)$c[]=ltrim($Ch);return($c||$Rf?queries("ALTER TABLE ".table($Q)."\n".implode(",\n",$c).$Rf):true);}function
alter_indexes($Q,$c){foreach($c
as$z=>$X)$c[$z]=($X[2]=="DROP"?"\nDROP INDEX ".idf_escape($X[1]):"\nADD $X[0] ".($X[0]=="PRIMARY"?"KEY ":"").($X[1]!=""?idf_escape($X[1])." ":"")."(".implode(", ",$X[2]).")");return
queries("ALTER TABLE ".table($Q).implode(",",$c));}function
truncate_tables($S){return
apply_queries("TRUNCATE TABLE",$S);}function
drop_views($Xi){return
queries("DROP VIEW ".implode(", ",array_map('table',$Xi)));}function
drop_tables($S){return
queries("DROP TABLE ".implode(", ",array_map('table',$S)));}function
move_tables($S,$Xi,$Vh){$Hg=array();foreach(array_merge($S,$Xi)as$Q)$Hg[]=table($Q)." TO ".idf_escape($Vh).".".table($Q);return
queries("RENAME TABLE ".implode(", ",$Hg));}function
copy_tables($S,$Xi,$Vh){queries("SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO'");foreach($S
as$Q){$C=($Vh==DB?table("copy_$Q"):idf_escape($Vh).".".table($Q));if(!queries("CREATE TABLE $C LIKE ".table($Q))||!queries("INSERT INTO $C SELECT * FROM ".table($Q)))return
false;foreach(get_rows("SHOW TRIGGERS LIKE ".q(addcslashes($Q,"%_\\")))as$J){$vi=$J["Trigger"];if(!queries("CREATE TRIGGER ".($Vh==DB?idf_escape("copy_$vi"):idf_escape($Vh).".".idf_escape($vi))." $J[Timing] $J[Event] ON $C FOR EACH ROW\n$J[Statement];"))return
false;}}foreach($Xi
as$Q){$C=($Vh==DB?table("copy_$Q"):idf_escape($Vh).".".table($Q));$Wi=view($Q);if(!queries("CREATE VIEW $C AS $Wi[select]"))return
false;}return
true;}function
trigger($C){if($C=="")return
array();$K=get_rows("SHOW TRIGGERS WHERE `Trigger` = ".q($C));return
reset($K);}function
triggers($Q){$I=array();foreach(get_rows("SHOW TRIGGERS LIKE ".q(addcslashes($Q,"%_\\")))as$J)$I[$J["Trigger"]]=array($J["Timing"],$J["Event"]);return$I;}function
trigger_options(){return
array("Timing"=>array("BEFORE","AFTER"),"Event"=>array("INSERT","UPDATE","DELETE"),"Type"=>array("FOR EACH ROW"),);}function
routine($C,$T){global$g,$uc,$Pd,$U;$Ca=array("bool","boolean","integer","double precision","real","dec","numeric","fixed","national char","national varchar");$uh="(?:\\s|/\\*[\s\S]*?\\*/|(?:#|-- )[^\n]*\n?|--\r?\n)";$_i="((".implode("|",array_merge(array_keys($U),$Ca)).")\\b(?:\\s*\\(((?:[^'\")]|$uc)++)\\))?\\s*(zerofill\\s*)?(unsigned(?:\\s+zerofill)?)?)(?:\\s*(?:CHARSET|CHARACTER\\s+SET)\\s*['\"]?([^'\"\\s,]+)['\"]?)?";$Xf="$uh*(".($T=="FUNCTION"?"":$Pd).")?\\s*(?:`((?:[^`]|``)*)`\\s*|\\b(\\S+)\\s+)$_i";$i=$g->result("SHOW CREATE $T ".idf_escape($C),2);preg_match("~\\(((?:$Xf\\s*,?)*)\\)\\s*".($T=="FUNCTION"?"RETURNS\\s+$_i\\s+":"")."(.*)~is",$i,$B);$q=array();preg_match_all("~$Xf\\s*,?~is",$B[1],$Be,PREG_SET_ORDER);foreach($Be
as$Kf){$C=str_replace("``","`",$Kf[2]).$Kf[3];$q[]=array("field"=>$C,"type"=>strtolower($Kf[5]),"length"=>preg_replace_callback("~$uc~s",'normalize_enum',$Kf[6]),"unsigned"=>strtolower(preg_replace('~\s+~',' ',trim("$Kf[8] $Kf[7]"))),"null"=>1,"full_type"=>$Kf[4],"inout"=>strtoupper($Kf[1]),"collation"=>strtolower($Kf[9]),);}if($T!="FUNCTION")return
array("fields"=>$q,"definition"=>$B[11]);return
array("fields"=>$q,"returns"=>array("type"=>$B[12],"length"=>$B[13],"unsigned"=>$B[15],"collation"=>$B[16]),"definition"=>$B[17],"language"=>"SQL",);}function
routines(){return
get_rows("SELECT ROUTINE_NAME AS SPECIFIC_NAME, ROUTINE_NAME, ROUTINE_TYPE, DTD_IDENTIFIER FROM information_schema.ROUTINES WHERE ROUTINE_SCHEMA = ".q(DB));}function
routine_languages(){return
array();}function
routine_id($C,$J){return
idf_escape($C);}function
last_id(){global$g;return$g->result("SELECT LAST_INSERT_ID()");}function
explain($g,$G){return$g->query("EXPLAIN ".(min_version(5.1)?"PARTITIONS ":"").$G);}function
found_rows($R,$Z){return($Z||$R["Engine"]!="InnoDB"?null:$R["Rows"]);}function
types(){return
array();}function
schemas(){return
array();}function
get_schema(){return"";}function
set_schema($Xg){return
true;}function
create_sql($Q,$La,$Gh){global$g;$I=$g->result("SHOW CREATE TABLE ".table($Q),1);if(!$La)$I=preg_replace('~ AUTO_INCREMENT=\d+~','',$I);return$I;}function
truncate_sql($Q){return"TRUNCATE ".table($Q);}function
use_sql($k){return"USE ".idf_escape($k);}function
trigger_sql($Q){$I="";foreach(get_rows("SHOW TRIGGERS LIKE ".q(addcslashes($Q,"%_\\")),null,"-- ")as$J)$I.="\nCREATE TRIGGER ".idf_escape($J["Trigger"])." $J[Timing] $J[Event] ON ".table($J["Table"])." FOR EACH ROW\n$J[Statement];;\n";return$I;}function
show_variables(){return
get_key_vals("SHOW VARIABLES");}function
process_list(){return
get_rows("SHOW FULL PROCESSLIST");}function
show_status(){return
get_key_vals("SHOW STATUS");}function
convert_field($p){if(preg_match("~binary~",$p["type"]))return"HEX(".idf_escape($p["field"]).")";if($p["type"]=="bit")return"BIN(".idf_escape($p["field"])." + 0)";if(preg_match("~geometry|point|linestring|polygon~",$p["type"]))return(min_version(8)?"ST_":"")."AsWKT(".idf_escape($p["field"]).")";}function
unconvert_field($p,$I){if(preg_match("~binary~",$p["type"]))$I="UNHEX($I)";if($p["type"]=="bit")$I="CONV($I, 2, 10) + 0";if(preg_match("~geometry|point|linestring|polygon~",$p["type"]))$I=(min_version(8)?"ST_":"")."GeomFromText($I)";return$I;}function
support($Nc){return!preg_match("~scheme|sequence|type|view_trigger|materializedview".(min_version(8)?"":"|descidx".(min_version(5.1)?"":"|event|partitioning".(min_version(5)?"":"|routine|trigger|view")))."~",$Nc);}function
kill_process($X){return
queries("KILL ".number($X));}function
connection_id(){return"SELECT CONNECTION_ID()";}function
max_connections(){global$g;return$g->result("SELECT @@max_connections");}$y="sql";$U=array();$Fh=array();foreach(array('Numbers'=>array("tinyint"=>3,"smallint"=>5,"mediumint"=>8,"int"=>10,"bigint"=>20,"decimal"=>66,"float"=>12,"double"=>21),'Date and time'=>array("date"=>10,"datetime"=>19,"timestamp"=>19,"time"=>10,"year"=>4),'Strings'=>array("char"=>255,"varchar"=>65535,"tinytext"=>255,"text"=>65535,"mediumtext"=>16777215,"longtext"=>4294967295),'Lists'=>array("enum"=>65535,"set"=>64),'Binary'=>array("bit"=>20,"binary"=>255,"varbinary"=>65535,"tinyblob"=>255,"blob"=>65535,"mediumblob"=>16777215,"longblob"=>4294967295),'Geometry'=>array("geometry"=>0,"point"=>0,"linestring"=>0,"polygon"=>0,"multipoint"=>0,"multilinestring"=>0,"multipolygon"=>0,"geometrycollection"=>0),)as$z=>$X){$U+=$X;$Fh[$z]=array_keys($X);}$Gi=array("unsigned","zerofill","unsigned zerofill");$sf=array("=","<",">","<=",">=","!=","LIKE","LIKE %%","REGEXP","IN","FIND_IN_SET","IS NULL","NOT LIKE","NOT REGEXP","NOT IN","IS NOT NULL","SQL");$id=array("char_length","date","from_unixtime","lower","round","floor","ceil","sec_to_time","time_to_sec","upper");$od=array("avg","count","count distinct","group_concat","max","min","sum");$kc=array(array("char"=>"md5/sha1/password/encrypt/uuid","binary"=>"md5/sha1","date|time"=>"now",),array(number_type()=>"+/-","date"=>"+ interval/- interval","time"=>"addtime/subtime","char|text"=>"concat",));}define("SERVER",$_GET[DRIVER]);define("DB",$_GET["db"]);define("ME",preg_replace('~^[^?]*/([^?]*).*~','\1',$_SERVER["REQUEST_URI"]).'?'.(sid()?SID.'&':'').(SERVER!==null?DRIVER."=".urlencode(SERVER).'&':'').(isset($_GET["username"])?"username=".urlencode($_GET["username"]).'&':'').(DB!=""?'db='.urlencode(DB).'&'.(isset($_GET["ns"])?"ns=".urlencode($_GET["ns"])."&":""):''));$ia="4.7.1";class
Adminer{var$operators;function
name(){return"<a href='https://www.adminer.org/'".target_blank()." id='h1'>Adminer</a>";}function
credentials(){return
array(SERVER,$_GET["username"],get_password());}function
connectSsl(){}function
permanentLogin($i=false){return
password_file($i);}function
bruteForceKey(){return$_SERVER["REMOTE_ADDR"];}function
serverName($N){return
h($N);}function
database(){return
DB;}function
databases($Yc=true){return
get_databases($Yc);}function
schemas(){return
schemas();}function
queryTimeout(){return
2;}function
headers(){}function
csp(){return
csp();}function
head(){return
true;}function
css(){$I=array();$Sc="adminer.css";if(file_exists($Sc))$I[]=$Sc;return$I;}function
loginForm(){global$cc;echo"<table cellspacing='0' class='layout'>\n",$this->loginFormField('driver','<tr><th>'.'System'.'<td>',html_select("auth[driver]",$cc,DRIVER,"loginDriver(this);")."\n"),$this->loginFormField('server','<tr><th>'.'Server'.'<td>','<input name="auth[server]" value="'.h(SERVER).'" title="hostname[:port]" placeholder="localhost" autocapitalize="off">'."\n"),$this->loginFormField('username','<tr><th>'.'Username'.'<td>','<input name="auth[username]" id="username" value="'.h($_GET["username"]).'" autocomplete="username" autocapitalize="off">'.script("focus(qs('#username')); qs('#username').form['auth[driver]'].onchange();")),$this->loginFormField('password','<tr><th>'.'Password'.'<td>','<input type="password" name="auth[password]" autocomplete="current-password">'."\n"),$this->loginFormField('db','<tr><th>'.'Database'.'<td>','<input name="auth[db]" value="'.h($_GET["db"]).'" autocapitalize="off">'."\n"),"</table>\n","<p><input type='submit' value='".'Login'."'>\n",checkbox("auth[permanent]",1,$_COOKIE["adminer_permanent"],'Permanent login')."\n";}function
loginFormField($C,$vd,$Y){return$vd.$Y;}function
login($we,$F){if($F=="")return
sprintf('Adminer does not support accessing a database without a password, <a href="https://www.adminer.org/en/password/"%s>more information</a>.',target_blank());return
true;}function
tableName($Mh){return
h($Mh["Name"]);}function
fieldName($p,$xf=0){return'<span title="'.h($p["full_type"]).'">'.h($p["field"]).'</span>';}function
selectLinks($Mh,$O=""){global$y,$n;echo'<p class="links">';$ue=array("select"=>'Select data');if(support("table")||support("indexes"))$ue["table"]='Show structure';if(support("table")){if(is_view($Mh))$ue["view"]='Alter view';else$ue["create"]='Alter table';}if($O!==null)$ue["edit"]='New item';$C=$Mh["Name"];foreach($ue
as$z=>$X)echo" <a href='".h(ME)."$z=".urlencode($C).($z=="edit"?$O:"")."'".bold(isset($_GET[$z])).">$X</a>";echo
doc_link(array($y=>$n->tableHelp($C)),"?"),"\n";}function
foreignKeys($Q){return
foreign_keys($Q);}function
backwardKeys($Q,$Lh){return
array();}function
backwardKeysPrint($Oa,$J){}function
selectQuery($G,$Ah,$Lc=false){global$y,$n;$I="</p>\n";if(!$Lc&&($aj=$n->warnings())){$u="warnings";$I=", <a href='#$u'>".'Warnings'."</a>".script("qsl('a').onclick = partial(toggle, '$u');","")."$I<div id='$u' class='hidden'>\n$aj</div>\n";}return"<p><code class='jush-$y'>".h(str_replace("\n"," ",$G))."</code> <span class='time'>(".format_time($Ah).")</span>".(support("sql")?" <a href='".h(ME)."sql=".urlencode($G)."'>".'Edit'."</a>":"").$I;}function
sqlCommandQuery($G){return
shorten_utf8(trim($G),1000);}function
rowDescription($Q){return"";}function
rowDescriptions($K,$bd){return$K;}function
selectLink($X,$p){}function
selectVal($X,$A,$p,$Ef){$I=($X===null?"<i>NULL</i>":(preg_match("~char|binary|boolean~",$p["type"])&&!preg_match("~var~",$p["type"])?"<code>$X</code>":$X));if(preg_match('~blob|bytea|raw|file~',$p["type"])&&!is_utf8($X))$I="<i>".lang(array('%d byte','%d bytes'),strlen($Ef))."</i>";if(preg_match('~json~',$p["type"]))$I="<code class='jush-js'>$I</code>";return($A?"<a href='".h($A)."'".(is_url($A)?target_blank():"").">$I</a>":$I);}function
editVal($X,$p){return$X;}function
tableStructurePrint($q){echo"<div class='scrollable'>\n","<table cellspacing='0' class='nowrap'>\n","<thead><tr><th>".'Column'."<td>".'Type'.(support("comment")?"<td>".'Comment':"")."</thead>\n";foreach($q
as$p){echo"<tr".odd()."><th>".h($p["field"]),"<td><span title='".h($p["collation"])."'>".h($p["full_type"])."</span>",($p["null"]?" <i>NULL</i>":""),($p["auto_increment"]?" <i>".'Auto Increment'."</i>":""),(isset($p["default"])?" <span title='".'Default value'."'>[<b>".h($p["default"])."</b>]</span>":""),(support("comment")?"<td>".h($p["comment"]):""),"\n";}echo"</table>\n","</div>\n";}function
tableIndexesPrint($x){echo"<table cellspacing='0'>\n";foreach($x
as$C=>$w){ksort($w["columns"]);$jg=array();foreach($w["columns"]as$z=>$X)$jg[]="<i>".h($X)."</i>".($w["lengths"][$z]?"(".$w["lengths"][$z].")":"").($w["descs"][$z]?" DESC":"");echo"<tr title='".h($C)."'><th>$w[type]<td>".implode(", ",$jg)."\n";}echo"</table>\n";}function
selectColumnsPrint($L,$f){global$id,$od;print_fieldset("select",'Select',$L);$t=0;$L[""]=array();foreach($L
as$z=>$X){$X=$_GET["columns"][$z];$e=select_input(" name='columns[$t][col]'",$f,$X["col"],($z!==""?"selectFieldChange":"selectAddRow"));echo"<div>".($id||$od?"<select name='columns[$t][fun]'>".optionlist(array(-1=>"")+array_filter(array('Functions'=>$id,'Aggregation'=>$od)),$X["fun"])."</select>".on_help("getTarget(event).value && getTarget(event).value.replace(/ |\$/, '(') + ')'",1).script("qsl('select').onchange = function () { helpClose();".($z!==""?"":" qsl('select, input', this.parentNode).onchange();")." };","")."($e)":$e)."</div>\n";$t++;}echo"</div></fieldset>\n";}function
selectSearchPrint($Z,$f,$x){print_fieldset("search",'Search',$Z);foreach($x
as$t=>$w){if($w["type"]=="FULLTEXT"){echo"<div>(<i>".implode("</i>, <i>",array_map('h',$w["columns"]))."</i>) AGAINST"," <input type='search' name='fulltext[$t]' value='".h($_GET["fulltext"][$t])."'>",script("qsl('input').oninput = selectFieldChange;",""),checkbox("boolean[$t]",1,isset($_GET["boolean"][$t]),"BOOL"),"</div>\n";}}$ab="this.parentNode.firstChild.onchange();";foreach(array_merge((array)$_GET["where"],array(array()))as$t=>$X){if(!$X||("$X[col]$X[val]"!=""&&in_array($X["op"],$this->operators))){echo"<div>".select_input(" name='where[$t][col]'",$f,$X["col"],($X?"selectFieldChange":"selectAddRow"),"(".'anywhere'.")"),html_select("where[$t][op]",$this->operators,$X["op"],$ab),"<input type='search' name='where[$t][val]' value='".h($X["val"])."'>",script("mixin(qsl('input'), {oninput: function () { $ab }, onkeydown: selectSearchKeydown, onsearch: selectSearchSearch});",""),"</div>\n";}}echo"</div></fieldset>\n";}function
selectOrderPrint($xf,$f,$x){print_fieldset("sort",'Sort',$xf);$t=0;foreach((array)$_GET["order"]as$z=>$X){if($X!=""){echo"<div>".select_input(" name='order[$t]'",$f,$X,"selectFieldChange"),checkbox("desc[$t]",1,isset($_GET["desc"][$z]),'descending')."</div>\n";$t++;}}echo"<div>".select_input(" name='order[$t]'",$f,"","selectAddRow"),checkbox("desc[$t]",1,false,'descending')."</div>\n","</div></fieldset>\n";}function
selectLimitPrint($_){echo"<fieldset><legend>".'Limit'."</legend><div>";echo"<input type='number' name='limit' class='size' value='".h($_)."'>",script("qsl('input').oninput = selectFieldChange;",""),"</div></fieldset>\n";}function
selectLengthPrint($bi){if($bi!==null){echo"<fieldset><legend>".'Text length'."</legend><div>","<input type='number' name='text_length' class='size' value='".h($bi)."'>","</div></fieldset>\n";}}function
selectActionPrint($x){echo"<fieldset><legend>".'Action'."</legend><div>","<input type='submit' value='".'Select'."'>"," <span id='noindex' title='".'Full table scan'."'></span>","<script".nonce().">\n","var indexColumns = ";$f=array();foreach($x
as$w){$Ib=reset($w["columns"]);if($w["type"]!="FULLTEXT"&&$Ib)$f[$Ib]=1;}$f[""]=1;foreach($f
as$z=>$X)json_row($z);echo";\n","selectFieldChange.call(qs('#form')['select']);\n","</script>\n","</div></fieldset>\n";}function
selectCommandPrint(){return!information_schema(DB);}function
selectImportPrint(){return!information_schema(DB);}function
selectEmailPrint($pc,$f){}function
selectColumnsProcess($f,$x){global$id,$od;$L=array();$ld=array();foreach((array)$_GET["columns"]as$z=>$X){if($X["fun"]=="count"||($X["col"]!=""&&(!$X["fun"]||in_array($X["fun"],$id)||in_array($X["fun"],$od)))){$L[$z]=apply_sql_function($X["fun"],($X["col"]!=""?idf_escape($X["col"]):"*"));if(!in_array($X["fun"],$od))$ld[]=$L[$z];}}return
array($L,$ld);}function
selectSearchProcess($q,$x){global$g,$n;$I=array();foreach($x
as$t=>$w){if($w["type"]=="FULLTEXT"&&$_GET["fulltext"][$t]!="")$I[]="MATCH (".implode(", ",array_map('idf_escape',$w["columns"])).") AGAINST (".q($_GET["fulltext"][$t]).(isset($_GET["boolean"][$t])?" IN BOOLEAN MODE":"").")";}foreach((array)$_GET["where"]as$z=>$X){if("$X[col]$X[val]"!=""&&in_array($X["op"],$this->operators)){$fg="";$ub=" $X[op]";if(preg_match('~IN$~',$X["op"])){$Fd=process_length($X["val"]);$ub.=" ".($Fd!=""?$Fd:"(NULL)");}elseif($X["op"]=="SQL")$ub=" $X[val]";elseif($X["op"]=="LIKE %%")$ub=" LIKE ".$this->processInput($q[$X["col"]],"%$X[val]%");elseif($X["op"]=="ILIKE %%")$ub=" ILIKE ".$this->processInput($q[$X["col"]],"%$X[val]%");elseif($X["op"]=="FIND_IN_SET"){$fg="$X[op](".q($X["val"]).", ";$ub=")";}elseif(!preg_match('~NULL$~',$X["op"]))$ub.=" ".$this->processInput($q[$X["col"]],$X["val"]);if($X["col"]!="")$I[]=$fg.$n->convertSearch(idf_escape($X["col"]),$X,$q[$X["col"]]).$ub;else{$qb=array();foreach($q
as$C=>$p){if((preg_match('~^[-\d.'.(preg_match('~IN$~',$X["op"])?',':'').']+$~',$X["val"])||!preg_match('~'.number_type().'|bit~',$p["type"]))&&(!preg_match("~[\x80-\xFF]~",$X["val"])||preg_match('~char|text|enum|set~',$p["type"])))$qb[]=$fg.$n->convertSearch(idf_escape($C),$X,$p).$ub;}$I[]=($qb?"(".implode(" OR ",$qb).")":"1 = 0");}}}return$I;}function
selectOrderProcess($q,$x){$I=array();foreach((array)$_GET["order"]as$z=>$X){if($X!="")$I[]=(preg_match('~^((COUNT\(DISTINCT |[A-Z0-9_]+\()(`(?:[^`]|``)+`|"(?:[^"]|"")+")\)|COUNT\(\*\))$~',$X)?$X:idf_escape($X)).(isset($_GET["desc"][$z])?" DESC":"");}return$I;}function
selectLimitProcess(){return(isset($_GET["limit"])?$_GET["limit"]:"50");}function
selectLengthProcess(){return(isset($_GET["text_length"])?$_GET["text_length"]:"100");}function
selectEmailProcess($Z,$bd){return
false;}function
selectQueryBuild($L,$Z,$ld,$xf,$_,$E){return"";}function
messageQuery($G,$ci,$Lc=false){global$y,$n;restart_session();$wd=&get_session("queries");if(!$wd[$_GET["db"]])$wd[$_GET["db"]]=array();if(strlen($G)>1e6)$G=preg_replace('~[\x80-\xFF]+$~','',substr($G,0,1e6))."\nâ¦";$wd[$_GET["db"]][]=array($G,time(),$ci);$yh="sql-".count($wd[$_GET["db"]]);$I="<a href='#$yh' class='toggle'>".'SQL command'."</a>\n";if(!$Lc&&($aj=$n->warnings())){$u="warnings-".count($wd[$_GET["db"]]);$I="<a href='#$u' class='toggle'>".'Warnings'."</a>, $I<div id='$u' class='hidden'>\n$aj</div>\n";}return" <span class='time'>".@date("H:i:s")."</span>"." $I<div id='$yh' class='hidden'><pre><code class='jush-$y'>".shorten_utf8($G,1000)."</code></pre>".($ci?" <span class='time'>($ci)</span>":'').(support("sql")?'<p><a href="'.h(str_replace("db=".urlencode(DB),"db=".urlencode($_GET["db"]),ME).'sql=&history='.(count($wd[$_GET["db"]])-1)).'">'.'Edit'.'</a>':'').'</div>';}function
editFunctions($p){global$kc;$I=($p["null"]?"NULL/":"");foreach($kc
as$z=>$id){if(!$z||(!isset($_GET["call"])&&(isset($_GET["select"])||where($_GET)))){foreach($id
as$Xf=>$X){if(!$Xf||preg_match("~$Xf~",$p["type"]))$I.="/$X";}if($z&&!preg_match('~set|blob|bytea|raw|file~',$p["type"]))$I.="/SQL";}}if($p["auto_increment"]&&!isset($_GET["select"])&&!where($_GET))$I='Auto Increment';return
explode("/",$I);}function
editInput($Q,$p,$Ja,$Y){if($p["type"]=="enum")return(isset($_GET["select"])?"<label><input type='radio'$Ja value='-1' checked><i>".'original'."</i></label> ":"").($p["null"]?"<label><input type='radio'$Ja value=''".($Y!==null||isset($_GET["select"])?"":" checked")."><i>NULL</i></label> ":"").enum_input("radio",$Ja,$p,$Y,0);return"";}function
editHint($Q,$p,$Y){return"";}function
processInput($p,$Y,$s=""){if($s=="SQL")return$Y;$C=$p["field"];$I=q($Y);if(preg_match('~^(now|getdate|uuid)$~',$s))$I="$s()";elseif(preg_match('~^current_(date|timestamp)$~',$s))$I=$s;elseif(preg_match('~^([+-]|\|\|)$~',$s))$I=idf_escape($C)." $s $I";elseif(preg_match('~^[+-] interval$~',$s))$I=idf_escape($C)." $s ".(preg_match("~^(\\d+|'[0-9.: -]') [A-Z_]+\$~i",$Y)?$Y:$I);elseif(preg_match('~^(addtime|subtime|concat)$~',$s))$I="$s(".idf_escape($C).", $I)";elseif(preg_match('~^(md5|sha1|password|encrypt)$~',$s))$I="$s($I)";return
unconvert_field($p,$I);}function
dumpOutput(){$I=array('text'=>'open','file'=>'save');if(function_exists('gzencode'))$I['gz']='gzip';return$I;}function
dumpFormat(){return
array('sql'=>'SQL','csv'=>'CSV,','csv;'=>'CSV;','tsv'=>'TSV');}function
dumpDatabase($m){}function
dumpTable($Q,$Gh,$Yd=0){if($_POST["format"]!="sql"){echo"\xef\xbb\xbf";if($Gh)dump_csv(array_keys(fields($Q)));}else{if($Yd==2){$q=array();foreach(fields($Q)as$C=>$p)$q[]=idf_escape($C)." $p[full_type]";$i="CREATE TABLE ".table($Q)." (".implode(", ",$q).")";}else$i=create_sql($Q,$_POST["auto_increment"],$Gh);set_utf8mb4($i);if($Gh&&$i){if($Gh=="DROP+CREATE"||$Yd==1)echo"DROP ".($Yd==2?"VIEW":"TABLE")." IF EXISTS ".table($Q).";\n";if($Yd==1)$i=remove_definer($i);echo"$i;\n\n";}}}function
dumpData($Q,$Gh,$G){global$g,$y;$De=($y=="sqlite"?0:1048576);if($Gh){if($_POST["format"]=="sql"){if($Gh=="TRUNCATE+INSERT")echo
truncate_sql($Q).";\n";$q=fields($Q);}$H=$g->query($G,1);if($H){$Rd="";$Xa="";$fe=array();$Ih="";$Oc=($Q!=''?'fetch_assoc':'fetch_row');while($J=$H->$Oc()){if(!$fe){$Si=array();foreach($J
as$X){$p=$H->fetch_field();$fe[]=$p->name;$z=idf_escape($p->name);$Si[]="$z = VALUES($z)";}$Ih=($Gh=="INSERT+UPDATE"?"\nON DUPLICATE KEY UPDATE ".implode(", ",$Si):"").";\n";}if($_POST["format"]!="sql"){if($Gh=="table"){dump_csv($fe);$Gh="INSERT";}dump_csv($J);}else{if(!$Rd)$Rd="INSERT INTO ".table($Q)." (".implode(", ",array_map('idf_escape',$fe)).") VALUES";foreach($J
as$z=>$X){$p=$q[$z];$J[$z]=($X!==null?unconvert_field($p,preg_match(number_type(),$p["type"])&&$X!=''&&!preg_match('~\[~',$p["full_type"])?$X:q(($X===false?0:$X))):"NULL");}$Vg=($De?"\n":" ")."(".implode(",\t",$J).")";if(!$Xa)$Xa=$Rd.$Vg;elseif(strlen($Xa)+4+strlen($Vg)+strlen($Ih)<$De)$Xa.=",$Vg";else{echo$Xa.$Ih;$Xa=$Rd.$Vg;}}}if($Xa)echo$Xa.$Ih;}elseif($_POST["format"]=="sql")echo"-- ".str_replace("\n"," ",$g->error)."\n";}}function
dumpFilename($Ad){return
friendly_url($Ad!=""?$Ad:(SERVER!=""?SERVER:"localhost"));}function
dumpHeaders($Ad,$Se=false){$Hf=$_POST["output"];$Gc=(preg_match('~sql~',$_POST["format"])?"sql":($Se?"tar":"csv"));header("Content-Type: ".($Hf=="gz"?"application/x-gzip":($Gc=="tar"?"application/x-tar":($Gc=="sql"||$Hf!="file"?"text/plain":"text/csv")."; charset=utf-8")));if($Hf=="gz")ob_start('ob_gzencode',1e6);return$Gc;}function
importServerPath(){return"adminer.sql";}function
homepage(){echo'<p class="links">'.($_GET["ns"]==""&&support("database")?'<a href="'.h(ME).'database=">'.'Alter database'."</a>\n":""),(support("scheme")?"<a href='".h(ME)."scheme='>".($_GET["ns"]!=""?'Alter schema':'Create schema')."</a>\n":""),($_GET["ns"]!==""?'<a href="'.h(ME).'schema=">'.'Database schema'."</a>\n":""),(support("privileges")?"<a href='".h(ME)."privileges='>".'Privileges'."</a>\n":"");return
true;}function
navigation($Re){global$ia,$y,$cc,$g;echo'<h1>
',$this->name(),' <span class="version">',$ia,'</span>
<a href="https://www.adminer.org/#download"',target_blank(),' id="version">',(version_compare($ia,$_COOKIE["adminer_version"])<0?h($_COOKIE["adminer_version"]):""),'</a>
</h1>
';if($Re=="auth"){$Uc=true;foreach((array)$_SESSION["pwds"]as$Ui=>$jh){foreach($jh
as$N=>$Pi){foreach($Pi
as$V=>$F){if($F!==null){if($Uc){echo"<ul id='logins'>".script("mixin(qs('#logins'), {onmouseover: menuOver, onmouseout: menuOut});");$Uc=false;}$Ob=$_SESSION["db"][$Ui][$N][$V];foreach(($Ob?array_keys($Ob):array(""))as$m)echo"<li><a href='".h(auth_url($Ui,$N,$V,$m))."'>($cc[$Ui]) ".h($V.($N!=""?"@".$this->serverName($N):"").($m!=""?" - $m":""))."</a>\n";}}}}}else{if($_GET["ns"]!==""&&!$Re&&DB!=""){$g->select_db(DB);$S=table_status('',true);}echo
script_src(preg_replace("~\\?.*~","",ME)."?file=jush.js&version=4.7.1");if(support("sql")){echo'<script',nonce(),'>
';if($S){$ue=array();foreach($S
as$Q=>$T)$ue[]=preg_quote($Q,'/');echo"var jushLinks = { $y: [ '".js_escape(ME).(support("table")?"table=":"select=")."\$&', /\\b(".implode("|",$ue).")\\b/g ] };\n";foreach(array("bac","bra","sqlite_quo","mssql_bra")as$X)echo"jushLinks.$X = jushLinks.$y;\n";}$ih=$g->server_info;echo'bodyLoad(\'',(is_object($g)?preg_replace('~^(\d\.?\d).*~s','\1',$ih):""),'\'',(preg_match('~MariaDB~',$ih)?", true":""),');
</script>
';}$this->databasesPrint($Re);if(DB==""||!$Re){echo"<p class='links'>".(support("sql")?"<a href='".h(ME)."sql='".bold(isset($_GET["sql"])&&!isset($_GET["import"])).">".'SQL command'."</a>\n<a href='".h(ME)."import='".bold(isset($_GET["import"])).">".'Import'."</a>\n":"")."";if(support("dump"))echo"<a href='".h(ME)."dump=".urlencode(isset($_GET["table"])?$_GET["table"]:$_GET["select"])."' id='dump'".bold(isset($_GET["dump"])).">".'Export'."</a>\n";}if($_GET["ns"]!==""&&!$Re&&DB!=""){echo'<a href="'.h(ME).'create="'.bold($_GET["create"]==="").">".'Create table'."</a>\n";if(!$S)echo"<p class='message'>".'No tables.'."\n";else$this->tablesPrint($S);}}}function
databasesPrint($Re){global$b,$g;$l=$this->databases();if($l&&!in_array(DB,$l))array_unshift($l,DB);echo'<form action="">
<p id="dbs">
';hidden_fields_get();$Mb=script("mixin(qsl('select'), {onmousedown: dbMouseDown, onchange: dbChange});");echo"<span title='".'database'."'>".'DB'."</span>: ".($l?"<select name='db'>".optionlist(array(""=>"")+$l,DB)."</select>$Mb":"<input name='db' value='".h(DB)."' autocapitalize='off'>\n"),"<input type='submit' value='".'Use'."'".($l?" class='hidden'":"").">\n";if($Re!="db"&&DB!=""&&$g->select_db(DB)){if(support("scheme")){echo"<br>".'Schema'.": <select name='ns'>".optionlist(array(""=>"")+$b->schemas(),$_GET["ns"])."</select>$Mb";if($_GET["ns"]!="")set_schema($_GET["ns"]);}}foreach(array("import","sql","schema","dump","privileges")as$X){if(isset($_GET[$X])){echo"<input type='hidden' name='$X' value=''>";break;}}echo"</p></form>\n";}function
tablesPrint($S){echo"<ul id='tables'>".script("mixin(qs('#tables'), {onmouseover: menuOver, onmouseout: menuOut});");foreach($S
as$Q=>$Ch){$C=$this->tableName($Ch);if($C!=""){echo'<li><a href="'.h(ME).'select='.urlencode($Q).'"'.bold($_GET["select"]==$Q||$_GET["edit"]==$Q,"select").">".'select'."</a> ",(support("table")||support("indexes")?'<a href="'.h(ME).'table='.urlencode($Q).'"'.bold(in_array($Q,array($_GET["table"],$_GET["create"],$_GET["indexes"],$_GET["foreign"],$_GET["trigger"])),(is_view($Ch)?"view":"structure"))." title='".'Show structure'."'>$C</a>":"<span>$C</span>")."\n";}}echo"</ul>\n";}}$b=(function_exists('adminer_object')?adminer_object():new
Adminer);if($b->operators===null)$b->operators=$sf;function
page_header($fi,$o="",$Wa=array(),$gi=""){global$ca,$ia,$b,$cc,$y;page_headers();if(is_ajax()&&$o){page_messages($o);exit;}$hi=$fi.($gi!=""?": $gi":"");$ii=strip_tags($hi.(SERVER!=""&&SERVER!="localhost"?h(" - ".SERVER):"")." - ".$b->name());echo'<!DOCTYPE html>
<html lang="en" dir="ltr">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="robots" content="noindex">
<title>',$ii,'</title>
<link rel="stylesheet" type="text/css" href="',h(preg_replace("~\\?.*~","",ME)."?file=default.css&version=4.7.1"),'">
',script_src(preg_replace("~\\?.*~","",ME)."?file=functions.js&version=4.7.1");if($b->head()){echo'<link rel="shortcut icon" type="image/x-icon" href="',h(preg_replace("~\\?.*~","",ME)."?file=favicon.ico&version=4.7.1"),'">
<link rel="apple-touch-icon" href="',h(preg_replace("~\\?.*~","",ME)."?file=favicon.ico&version=4.7.1"),'">
';foreach($b->css()as$Gb){echo'<link rel="stylesheet" type="text/css" href="',h($Gb),'">
';}}echo'
<body class="ltr nojs">
';$Sc=get_temp_dir()."/adminer.version";if(!$_COOKIE["adminer_version"]&&function_exists('openssl_verify')&&file_exists($Sc)&&filemtime($Sc)+86400>time()){$Vi=unserialize(file_get_contents($Sc));$qg="-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAwqWOVuF5uw7/+Z70djoK
RlHIZFZPO0uYRezq90+7Amk+FDNd7KkL5eDve+vHRJBLAszF/7XKXe11xwliIsFs
DFWQlsABVZB3oisKCBEuI71J4kPH8dKGEWR9jDHFw3cWmoH3PmqImX6FISWbG3B8
h7FIx3jEaw5ckVPVTeo5JRm/1DZzJxjyDenXvBQ/6o9DgZKeNDgxwKzH+sw9/YCO
jHnq1cFpOIISzARlrHMa/43YfeNRAm/tsBXjSxembBPo7aQZLAWHmaj5+K19H10B
nCpz9Y++cipkVEiKRGih4ZEvjoFysEOdRLj6WiD/uUNky4xGeA6LaJqh5XpkFkcQ
fQIDAQAB
-----END PUBLIC KEY-----
";if(openssl_verify($Vi["version"],base64_decode($Vi["signature"]),$qg)==1)$_COOKIE["adminer_version"]=$Vi["version"];}echo'<script',nonce(),'>
mixin(document.body, {onkeydown: bodyKeydown, onclick: bodyClick',(isset($_COOKIE["adminer_version"])?"":", onload: partial(verifyVersion, '$ia', '".js_escape(ME)."', '".get_token()."')");?>});
document.body.className = document.body.className.replace(/ nojs/, ' js');
var offlineMessage = '<?php echo
js_escape('You are offline.'),'\';
var thousandsSeparator = \'',js_escape(','),'\';
</script>

<div id="help" class="jush-',$y,' jsonly hidden"></div>
',script("mixin(qs('#help'), {onmouseover: function () { helpOpen = 1; }, onmouseout: helpMouseout});"),'
<div id="content">
';if($Wa!==null){$A=substr(preg_replace('~\b(username|db|ns)=[^&]*&~','',ME),0,-1);echo'<p id="breadcrumb"><a href="'.h($A?$A:".").'">'.$cc[DRIVER].'</a> &raquo; ';$A=substr(preg_replace('~\b(db|ns)=[^&]*&~','',ME),0,-1);$N=$b->serverName(SERVER);$N=($N!=""?$N:'Server');if($Wa===false)echo"$N\n";else{echo"<a href='".($A?h($A):".")."' accesskey='1' title='Alt+Shift+1'>$N</a> &raquo; ";if($_GET["ns"]!=""||(DB!=""&&is_array($Wa)))echo'<a href="'.h($A."&db=".urlencode(DB).(support("scheme")?"&ns=":"")).'">'.h(DB).'</a> &raquo; ';if(is_array($Wa)){if($_GET["ns"]!="")echo'<a href="'.h(substr(ME,0,-1)).'">'.h($_GET["ns"]).'</a> &raquo; ';foreach($Wa
as$z=>$X){$Ub=(is_array($X)?$X[1]:h($X));if($Ub!="")echo"<a href='".h(ME."$z=").urlencode(is_array($X)?$X[0]:$X)."'>$Ub</a> &raquo; ";}}echo"$fi\n";}}echo"<h2>$hi</h2>\n","<div id='ajaxstatus' class='jsonly hidden'></div>\n";restart_session();page_messages($o);$l=&get_session("dbs");if(DB!=""&&$l&&!in_array(DB,$l,true))$l=null;stop_session();define("PAGE_HEADER",1);}function
page_headers(){global$b;header("Content-Type: text/html; charset=utf-8");header("Cache-Control: no-cache");header("X-Frame-Options: deny");header("X-XSS-Protection: 0");header("X-Content-Type-Options: nosniff");header("Referrer-Policy: origin-when-cross-origin");foreach($b->csp()as$Fb){$ud=array();foreach($Fb
as$z=>$X)$ud[]="$z $X";header("Content-Security-Policy: ".implode("; ",$ud));}$b->headers();}function
csp(){return
array(array("script-src"=>"'self' 'unsafe-inline' 'nonce-".get_nonce()."' 'strict-dynamic'","connect-src"=>"'self'","frame-src"=>"https://www.adminer.org","object-src"=>"'none'","base-uri"=>"'none'","form-action"=>"'self'",),);}function
get_nonce(){static$bf;if(!$bf)$bf=base64_encode(rand_string());return$bf;}function
page_messages($o){$Ii=preg_replace('~^[^?]*~','',$_SERVER["REQUEST_URI"]);$Ne=$_SESSION["messages"][$Ii];if($Ne){echo"<div class='message'>".implode("</div>\n<div class='message'>",$Ne)."</div>".script("messagesPrint();");unset($_SESSION["messages"][$Ii]);}if($o)echo"<div class='error'>$o</div>\n";}function
page_footer($Re=""){global$b,$mi;echo'</div>

';if($Re!="auth"){echo'<form action="" method="post">
<p class="logout">
<input type="submit" name="logout" value="Logout" id="logout">
<input type="hidden" name="token" value="',$mi,'">
</p>
</form>
';}echo'<div id="menu">
';$b->navigation($Re);echo'</div>
',script("setupSubmitHighlight(document);");}function
int32($Ue){while($Ue>=2147483648)$Ue-=4294967296;while($Ue<=-2147483649)$Ue+=4294967296;return(int)$Ue;}function
long2str($W,$Zi){$Vg='';foreach($W
as$X)$Vg.=pack('V',$X);if($Zi)return
substr($Vg,0,end($W));return$Vg;}function
str2long($Vg,$Zi){$W=array_values(unpack('V*',str_pad($Vg,4*ceil(strlen($Vg)/4),"\0")));if($Zi)$W[]=strlen($Vg);return$W;}function
xxtea_mx($mj,$lj,$Jh,$be){return
int32((($mj>>5&0x7FFFFFF)^$lj<<2)+(($lj>>3&0x1FFFFFFF)^$mj<<4))^int32(($Jh^$lj)+($be^$mj));}function
encrypt_string($Eh,$z){if($Eh=="")return"";$z=array_values(unpack("V*",pack("H*",md5($z))));$W=str2long($Eh,true);$Ue=count($W)-1;$mj=$W[$Ue];$lj=$W[0];$rg=floor(6+52/($Ue+1));$Jh=0;while($rg-->0){$Jh=int32($Jh+0x9E3779B9);$jc=$Jh>>2&3;for($If=0;$If<$Ue;$If++){$lj=$W[$If+1];$Te=xxtea_mx($mj,$lj,$Jh,$z[$If&3^$jc]);$mj=int32($W[$If]+$Te);$W[$If]=$mj;}$lj=$W[0];$Te=xxtea_mx($mj,$lj,$Jh,$z[$If&3^$jc]);$mj=int32($W[$Ue]+$Te);$W[$Ue]=$mj;}return
long2str($W,false);}function
decrypt_string($Eh,$z){if($Eh=="")return"";if(!$z)return
false;$z=array_values(unpack("V*",pack("H*",md5($z))));$W=str2long($Eh,false);$Ue=count($W)-1;$mj=$W[$Ue];$lj=$W[0];$rg=floor(6+52/($Ue+1));$Jh=int32($rg*0x9E3779B9);while($Jh){$jc=$Jh>>2&3;for($If=$Ue;$If>0;$If--){$mj=$W[$If-1];$Te=xxtea_mx($mj,$lj,$Jh,$z[$If&3^$jc]);$lj=int32($W[$If]-$Te);$W[$If]=$lj;}$mj=$W[$Ue];$Te=xxtea_mx($mj,$lj,$Jh,$z[$If&3^$jc]);$lj=int32($W[0]-$Te);$W[0]=$lj;$Jh=int32($Jh-0x9E3779B9);}return
long2str($W,true);}$g='';$td=$_SESSION["token"];if(!$td)$_SESSION["token"]=rand(1,1e6);$mi=get_token();$Yf=array();if($_COOKIE["adminer_permanent"]){foreach(explode(" ",$_COOKIE["adminer_permanent"])as$X){list($z)=explode(":",$X);$Yf[$z]=$X;}}function
add_invalid_login(){global$b;$gd=file_open_lock(get_temp_dir()."/adminer.invalid");if(!$gd)return;$Ud=unserialize(stream_get_contents($gd));$ci=time();if($Ud){foreach($Ud
as$Vd=>$X){if($X[0]<$ci)unset($Ud[$Vd]);}}$Td=&$Ud[$b->bruteForceKey()];if(!$Td)$Td=array($ci+30*60,0);$Td[1]++;file_write_unlock($gd,serialize($Ud));}function
check_invalid_login(){global$b;$Ud=unserialize(@file_get_contents(get_temp_dir()."/adminer.invalid"));$Td=$Ud[$b->bruteForceKey()];$af=($Td[1]>29?$Td[0]-time():0);if($af>0)auth_error(lang(array('Too many unsuccessful logins, try again in %d minute.','Too many unsuccessful logins, try again in %d minutes.'),ceil($af/60)));}$Ka=$_POST["auth"];if($Ka){session_regenerate_id();$Ui=$Ka["driver"];$N=$Ka["server"];$V=$Ka["username"];$F=(string)$Ka["password"];$m=$Ka["db"];set_password($Ui,$N,$V,$F);$_SESSION["db"][$Ui][$N][$V][$m]=true;if($Ka["permanent"]){$z=base64_encode($Ui)."-".base64_encode($N)."-".base64_encode($V)."-".base64_encode($m);$kg=$b->permanentLogin(true);$Yf[$z]="$z:".base64_encode($kg?encrypt_string($F,$kg):"");cookie("adminer_permanent",implode(" ",$Yf));}if(count($_POST)==1||DRIVER!=$Ui||SERVER!=$N||$_GET["username"]!==$V||DB!=$m)redirect(auth_url($Ui,$N,$V,$m));}elseif($_POST["logout"]){if($td&&!verify_token()){page_header('Logout','Invalid CSRF token. Send the form again.');page_footer("db");exit;}else{foreach(array("pwds","db","dbs","queries")as$z)set_session($z,null);unset_permanent();redirect(substr(preg_replace('~\b(username|db|ns)=[^&]*&~','',ME),0,-1),'Logout successful.'.' '.'Thanks for using Adminer, consider <a href="https://www.adminer.org/en/donation/">donating</a>.');}}elseif($Yf&&!$_SESSION["pwds"]){session_regenerate_id();$kg=$b->permanentLogin();foreach($Yf
as$z=>$X){list(,$ib)=explode(":",$X);list($Ui,$N,$V,$m)=array_map('base64_decode',explode("-",$z));set_password($Ui,$N,$V,decrypt_string(base64_decode($ib),$kg));$_SESSION["db"][$Ui][$N][$V][$m]=true;}}function
unset_permanent(){global$Yf;foreach($Yf
as$z=>$X){list($Ui,$N,$V,$m)=array_map('base64_decode',explode("-",$z));if($Ui==DRIVER&&$N==SERVER&&$V==$_GET["username"]&&$m==DB)unset($Yf[$z]);}cookie("adminer_permanent",implode(" ",$Yf));}function
auth_error($o){global$b,$td;$kh=session_name();if(isset($_GET["username"])){header("HTTP/1.1 403 Forbidden");if(($_COOKIE[$kh]||$_GET[$kh])&&!$td)$o='Session expired, please login again.';else{restart_session();add_invalid_login();$F=get_password();if($F!==null){if($F===false)$o.='<br>'.sprintf('Master password expired. <a href="https://www.adminer.org/en/extension/"%s>Implement</a> %s method to make it permanent.',target_blank(),'<code>permanentLogin()</code>');set_password(DRIVER,SERVER,$_GET["username"],null);}unset_permanent();}}if(!$_COOKIE[$kh]&&$_GET[$kh]&&ini_bool("session.use_only_cookies"))$o='Session support must be enabled.';$Lf=session_get_cookie_params();cookie("adminer_key",($_COOKIE["adminer_key"]?$_COOKIE["adminer_key"]:rand_string()),$Lf["lifetime"]);page_header('Login',$o,null);echo"<form action='' method='post'>\n","<div>";if(hidden_fields($_POST,array("auth")))echo"<p class='message'>".'The action will be performed after successful login with the same credentials.'."\n";echo"</div>\n";$b->loginForm();echo"</form>\n";page_footer("auth");exit;}if(isset($_GET["username"])&&!class_exists("Min_DB")){unset($_SESSION["pwds"][DRIVER]);unset_permanent();page_header('No extension',sprintf('None of the supported PHP extensions (%s) are available.',implode(", ",$eg)),false);page_footer("auth");exit;}stop_session(true);if(isset($_GET["username"])){list($zd,$ag)=explode(":",SERVER,2);if(is_numeric($ag)&&$ag<1024)auth_error('Connecting to privileged ports is not allowed.');check_invalid_login();$g=connect();$n=new
Min_Driver($g);}$we=null;if(!is_object($g)||($we=$b->login($_GET["username"],get_password()))!==true){$o=(is_string($g)?h($g):(is_string($we)?$we:'Invalid credentials.'));auth_error($o.(preg_match('~^ | $~',get_password())?'<br>'.'There is a space in the input password which might be the cause.':''));}if($Ka&&$_POST["token"])$_POST["token"]=$mi;$o='';if($_POST){if(!verify_token()){$Od="max_input_vars";$He=ini_get($Od);if(extension_loaded("suhosin")){foreach(array("suhosin.request.max_vars","suhosin.post.max_vars")as$z){$X=ini_get($z);if($X&&(!$He||$X<$He)){$Od=$z;$He=$X;}}}$o=(!$_POST["token"]&&$He?sprintf('Maximum number of allowed fields exceeded. Please increase %s.',"'$Od'"):'Invalid CSRF token. Send the form again.'.' '.'If you did not send this request from Adminer then close this page.');}}elseif($_SERVER["REQUEST_METHOD"]=="POST"){$o=sprintf('Too big POST data. Reduce the data or increase the %s configuration directive.',"'post_max_size'");if(isset($_GET["sql"]))$o.=' '.'You can upload a big SQL file via FTP and import it from server.';}function
select($H,$h=null,$_f=array(),$_=0){global$y;$ue=array();$x=array();$f=array();$Ta=array();$U=array();$I=array();odd('');for($t=0;(!$_||$t<$_)&&($J=$H->fetch_row());$t++){if(!$t){echo"<div class='scrollable'>\n","<table cellspacing='0' class='nowrap'>\n","<thead><tr>";for($ae=0;$ae<count($J);$ae++){$p=$H->fetch_field();$C=$p->name;$zf=$p->orgtable;$yf=$p->orgname;$I[$p->table]=$zf;if($_f&&$y=="sql")$ue[$ae]=($C=="table"?"table=":($C=="possible_keys"?"indexes=":null));elseif($zf!=""){if(!isset($x[$zf])){$x[$zf]=array();foreach(indexes($zf,$h)as$w){if($w["type"]=="PRIMARY"){$x[$zf]=array_flip($w["columns"]);break;}}$f[$zf]=$x[$zf];}if(isset($f[$zf][$yf])){unset($f[$zf][$yf]);$x[$zf][$yf]=$ae;$ue[$ae]=$zf;}}if($p->charsetnr==63)$Ta[$ae]=true;$U[$ae]=$p->type;echo"<th".($zf!=""||$p->name!=$yf?" title='".h(($zf!=""?"$zf.":"").$yf)."'":"").">".h($C).($_f?doc_link(array('sql'=>"explain-output.html#explain_".strtolower($C),'mariadb'=>"explain/#the-columns-in-explain-select",)):"");}echo"</thead>\n";}echo"<tr".odd().">";foreach($J
as$z=>$X){if($X===null)$X="<i>NULL</i>";elseif($Ta[$z]&&!is_utf8($X))$X="<i>".lang(array('%d byte','%d bytes'),strlen($X))."</i>";else{$X=h($X);if($U[$z]==254)$X="<code>$X</code>";}if(isset($ue[$z])&&!$f[$ue[$z]]){if($_f&&$y=="sql"){$Q=$J[array_search("table=",$ue)];$A=$ue[$z].urlencode($_f[$Q]!=""?$_f[$Q]:$Q);}else{$A="edit=".urlencode($ue[$z]);foreach($x[$ue[$z]]as$mb=>$ae)$A.="&where".urlencode("[".bracket_escape($mb)."]")."=".urlencode($J[$ae]);}$X="<a href='".h(ME.$A)."'>$X</a>";}echo"<td>$X";}}echo($t?"</table>\n</div>":"<p class='message'>".'No rows.')."\n";return$I;}function
referencable_primary($eh){$I=array();foreach(table_status('',true)as$Nh=>$Q){if($Nh!=$eh&&fk_support($Q)){foreach(fields($Nh)as$p){if($p["primary"]){if($I[$Nh]){unset($I[$Nh]);break;}$I[$Nh]=$p;}}}}return$I;}function
adminer_settings(){parse_str($_COOKIE["adminer_settings"],$mh);return$mh;}function
adminer_setting($z){$mh=adminer_settings();return$mh[$z];}function
set_adminer_settings($mh){return
cookie("adminer_settings",http_build_query($mh+adminer_settings()));}function
textarea($C,$Y,$K=10,$qb=80){global$y;echo"<textarea name='$C' rows='$K' cols='$qb' class='sqlarea jush-$y' spellcheck='false' wrap='off'>";if(is_array($Y)){foreach($Y
as$X)echo
h($X[0])."\n\n\n";}else
echo
h($Y);echo"</textarea>";}function
edit_type($z,$p,$ob,$cd=array(),$Jc=array()){global$Fh,$U,$Gi,$nf;$T=$p["type"];echo'<td><select name="',h($z),'[type]" class="type" aria-labelledby="label-type">';if($T&&!isset($U[$T])&&!isset($cd[$T])&&!in_array($T,$Jc))$Jc[]=$T;if($cd)$Fh['Foreign keys']=$cd;echo
optionlist(array_merge($Jc,$Fh),$T),'</select>
',on_help("getTarget(event).value",1),script("mixin(qsl('select'), {onfocus: function () { lastType = selectValue(this); }, onchange: editingTypeChange});",""),'<td><input name="',h($z),'[length]" value="',h($p["length"]),'" size="3"',(!$p["length"]&&preg_match('~var(char|binary)$~',$T)?" class='required'":"");echo' aria-labelledby="label-length">',script("mixin(qsl('input'), {onfocus: editingLengthFocus, oninput: editingLengthChange});",""),'<td class="options">',"<select name='".h($z)."[collation]'".(preg_match('~(char|text|enum|set)$~',$T)?"":" class='hidden'").'><option value="">('.'collation'.')'.optionlist($ob,$p["collation"]).'</select>',($Gi?"<select name='".h($z)."[unsigned]'".(!$T||preg_match(number_type(),$T)?"":" class='hidden'").'><option>'.optionlist($Gi,$p["unsigned"]).'</select>':''),(isset($p['on_update'])?"<select name='".h($z)."[on_update]'".(preg_match('~timestamp|datetime~',$T)?"":" class='hidden'").'>'.optionlist(array(""=>"(".'ON UPDATE'.")","CURRENT_TIMESTAMP"),(preg_match('~^CURRENT_TIMESTAMP~i',$p["on_update"])?"CURRENT_TIMESTAMP":$p["on_update"])).'</select>':''),($cd?"<select name='".h($z)."[on_delete]'".(preg_match("~`~",$T)?"":" class='hidden'")."><option value=''>(".'ON DELETE'.")".optionlist(explode("|",$nf),$p["on_delete"])."</select> ":" ");}function
process_length($re){global$uc;return(preg_match("~^\\s*\\(?\\s*$uc(?:\\s*,\\s*$uc)*+\\s*\\)?\\s*\$~",$re)&&preg_match_all("~$uc~",$re,$Be)?"(".implode(",",$Be[0]).")":preg_replace('~^[0-9].*~','(\0)',preg_replace('~[^-0-9,+()[\]]~','',$re)));}function
process_type($p,$nb="COLLATE"){global$Gi;return" $p[type]".process_length($p["length"]).(preg_match(number_type(),$p["type"])&&in_array($p["unsigned"],$Gi)?" $p[unsigned]":"").(preg_match('~char|text|enum|set~',$p["type"])&&$p["collation"]?" $nb ".q($p["collation"]):"");}function
process_field($p,$zi){return
array(idf_escape(trim($p["field"])),process_type($zi),($p["null"]?" NULL":" NOT NULL"),default_value($p),(preg_match('~timestamp|datetime~',$p["type"])&&$p["on_update"]?" ON UPDATE $p[on_update]":""),(support("comment")&&$p["comment"]!=""?" COMMENT ".q($p["comment"]):""),($p["auto_increment"]?auto_increment():null),);}function
default_value($p){$Qb=$p["default"];return($Qb===null?"":" DEFAULT ".(preg_match('~char|binary|text|enum|set~',$p["type"])||preg_match('~^(?![a-z])~i',$Qb)?q($Qb):$Qb));}function
type_class($T){foreach(array('char'=>'text','date'=>'time|year','binary'=>'blob','enum'=>'set',)as$z=>$X){if(preg_match("~$z|$X~",$T))return" class='$z'";}}function
edit_fields($q,$ob,$T="TABLE",$cd=array()){global$Pd;$q=array_values($q);echo'<thead><tr>
';if($T=="PROCEDURE"){echo'<td>';}echo'<th id="label-name">',($T=="TABLE"?'Column name':'Parameter name'),'<td id="label-type">Type<textarea id="enum-edit" rows="4" cols="12" wrap="off" style="display: none;"></textarea>',script("qs('#enum-edit').onblur = editingLengthBlur;"),'<td id="label-length">Length
<td>','Options';if($T=="TABLE"){echo'<td id="label-null">NULL
<td><input type="radio" name="auto_increment_col" value=""><acronym id="label-ai" title="Auto Increment">AI</acronym>',doc_link(array('sql'=>"example-auto-increment.html",'mariadb'=>"auto_increment/",'sqlite'=>"autoinc.html",'pgsql'=>"datatype.html#DATATYPE-SERIAL",'mssql'=>"ms186775.aspx",)),'<td id="label-default">Default value
',(support("comment")?"<td id='label-comment'>".'Comment':"");}echo'<td>',"<input type='image' class='icon' name='add[".(support("move_col")?0:count($q))."]' src='".h(preg_replace("~\\?.*~","",ME)."?file=plus.gif&version=4.7.1")."' alt='+' title='".'Add next'."'>".script("row_count = ".count($q).";"),'</thead>
<tbody>
',script("mixin(qsl('tbody'), {onclick: editingClick, onkeydown: editingKeydown, oninput: editingInput});");foreach($q
as$t=>$p){$t++;$Af=$p[($_POST?"orig":"field")];$Yb=(isset($_POST["add"][$t-1])||(isset($p["field"])&&!$_POST["drop_col"][$t]))&&(support("drop_col")||$Af=="");echo'<tr',($Yb?"":" style='display: none;'"),'>
',($T=="PROCEDURE"?"<td>".html_select("fields[$t][inout]",explode("|",$Pd),$p["inout"]):""),'<th>';if($Yb){echo'<input name="fields[',$t,'][field]" value="',h($p["field"]),'" data-maxlength="64" autocapitalize="off" aria-labelledby="label-name">',script("qsl('input').oninput = function () { editingNameChange.call(this);".($p["field"]!=""||count($q)>1?"":" editingAddRow.call(this);")." };","");}echo'<input type="hidden" name="fields[',$t,'][orig]" value="',h($Af),'">
';edit_type("fields[$t]",$p,$ob,$cd);if($T=="TABLE"){echo'<td>',checkbox("fields[$t][null]",1,$p["null"],"","","block","label-null"),'<td><label class="block"><input type="radio" name="auto_increment_col" value="',$t,'"';if($p["auto_increment"]){echo' checked';}echo' aria-labelledby="label-ai"></label><td>',checkbox("fields[$t][has_default]",1,$p["has_default"],"","","","label-default"),'<input name="fields[',$t,'][default]" value="',h($p["default"]),'" aria-labelledby="label-default">',(support("comment")?"<td><input name='fields[$t][comment]' value='".h($p["comment"])."' data-maxlength='".(min_version(5.5)?1024:255)."' aria-labelledby='label-comment'>":"");}echo"<td>",(support("move_col")?"<input type='image' class='icon' name='add[$t]' src='".h(preg_replace("~\\?.*~","",ME)."?file=plus.gif&version=4.7.1")."' alt='+' title='".'Add next'."'> "."<input type='image' class='icon' name='up[$t]' src='".h(preg_replace("~\\?.*~","",ME)."?file=up.gif&version=4.7.1")."' alt='â' title='".'Move up'."'> "."<input type='image' class='icon' name='down[$t]' src='".h(preg_replace("~\\?.*~","",ME)."?file=down.gif&version=4.7.1")."' alt='â' title='".'Move down'."'> ":""),($Af==""||support("drop_col")?"<input type='image' class='icon' name='drop_col[$t]' src='".h(preg_replace("~\\?.*~","",ME)."?file=cross.gif&version=4.7.1")."' alt='x' title='".'Remove'."'>":"");}}function
process_fields(&$q){$D=0;if($_POST["up"]){$le=0;foreach($q
as$z=>$p){if(key($_POST["up"])==$z){unset($q[$z]);array_splice($q,$le,0,array($p));break;}if(isset($p["field"]))$le=$D;$D++;}}elseif($_POST["down"]){$ed=false;foreach($q
as$z=>$p){if(isset($p["field"])&&$ed){unset($q[key($_POST["down"])]);array_splice($q,$D,0,array($ed));break;}if(key($_POST["down"])==$z)$ed=$p;$D++;}}elseif($_POST["add"]){$q=array_values($q);array_splice($q,key($_POST["add"]),0,array(array()));}elseif(!$_POST["drop_col"])return
false;return
true;}function
normalize_enum($B){return"'".str_replace("'","''",addcslashes(stripcslashes(str_replace($B[0][0].$B[0][0],$B[0][0],substr($B[0],1,-1))),'\\'))."'";}function
grant($jd,$mg,$f,$mf){if(!$mg)return
true;if($mg==array("ALL PRIVILEGES","GRANT OPTION"))return($jd=="GRANT"?queries("$jd ALL PRIVILEGES$mf WITH GRANT OPTION"):queries("$jd ALL PRIVILEGES$mf")&&queries("$jd GRANT OPTION$mf"));return
queries("$jd ".preg_replace('~(GRANT OPTION)\([^)]*\)~','\1',implode("$f, ",$mg).$f).$mf);}function
drop_create($dc,$i,$ec,$Zh,$gc,$ve,$Me,$Ke,$Le,$jf,$Xe){if($_POST["drop"])query_redirect($dc,$ve,$Me);elseif($jf=="")query_redirect($i,$ve,$Le);elseif($jf!=$Xe){$Eb=queries($i);queries_redirect($ve,$Ke,$Eb&&queries($dc));if($Eb)queries($ec);}else
queries_redirect($ve,$Ke,queries($Zh)&&queries($gc)&&queries($dc)&&queries($i));}function
create_trigger($mf,$J){global$y;$ei=" $J[Timing] $J[Event]".($J["Event"]=="UPDATE OF"?" ".idf_escape($J["Of"]):"");return"CREATE TRIGGER ".idf_escape($J["Trigger"]).($y=="mssql"?$mf.$ei:$ei.$mf).rtrim(" $J[Type]\n$J[Statement]",";").";";}function
create_routine($Rg,$J){global$Pd,$y;$O=array();$q=(array)$J["fields"];ksort($q);foreach($q
as$p){if($p["field"]!="")$O[]=(preg_match("~^($Pd)\$~",$p["inout"])?"$p[inout] ":"").idf_escape($p["field"]).process_type($p,"CHARACTER SET");}$Rb=rtrim("\n$J[definition]",";");return"CREATE $Rg ".idf_escape(trim($J["name"]))." (".implode(", ",$O).")".(isset($_GET["function"])?" RETURNS".process_type($J["returns"],"CHARACTER SET"):"").($J["language"]?" LANGUAGE $J[language]":"").($y=="pgsql"?" AS ".q($Rb):"$Rb;");}function
remove_definer($G){return
preg_replace('~^([A-Z =]+) DEFINER=`'.preg_replace('~@(.*)~','`@`(%|\1)',logged_user()).'`~','\1',$G);}function
format_foreign_key($r){global$nf;return" FOREIGN KEY (".implode(", ",array_map('idf_escape',$r["source"])).") REFERENCES ".table($r["table"])." (".implode(", ",array_map('idf_escape',$r["target"])).")".(preg_match("~^($nf)\$~",$r["on_delete"])?" ON DELETE $r[on_delete]":"").(preg_match("~^($nf)\$~",$r["on_update"])?" ON UPDATE $r[on_update]":"");}function
tar_file($Sc,$ji){$I=pack("a100a8a8a8a12a12",$Sc,644,0,0,decoct($ji->size),decoct(time()));$gb=8*32;for($t=0;$t<strlen($I);$t++)$gb+=ord($I[$t]);$I.=sprintf("%06o",$gb)."\0 ";echo$I,str_repeat("\0",512-strlen($I));$ji->send();echo
str_repeat("\0",511-($ji->size+511)%512);}function
ini_bytes($Od){$X=ini_get($Od);switch(strtolower(substr($X,-1))){case'g':$X*=1024;case'm':$X*=1024;case'k':$X*=1024;}return$X;}function
doc_link($Wf,$ai="<sup>?</sup>"){global$y,$g;$ih=$g->server_info;$Vi=preg_replace('~^(\d\.?\d).*~s','\1',$ih);$Li=array('sql'=>"https://dev.mysql.com/doc/refman/$Vi/en/",'sqlite'=>"https://www.sqlite.org/",'pgsql'=>"https://www.postgresql.org/docs/$Vi/static/",'mssql'=>"https://msdn.microsoft.com/library/",'oracle'=>"https://download.oracle.com/docs/cd/B19306_01/server.102/b14200/",);if(preg_match('~MariaDB~',$ih)){$Li['sql']="https://mariadb.com/kb/en/library/";$Wf['sql']=(isset($Wf['mariadb'])?$Wf['mariadb']:str_replace(".html","/",$Wf['sql']));}return($Wf[$y]?"<a href='$Li[$y]$Wf[$y]'".target_blank().">$ai</a>":"");}function
ob_gzencode($P){return
gzencode($P);}function
db_size($m){global$g;if(!$g->select_db($m))return"?";$I=0;foreach(table_status()as$R)$I+=$R["Data_length"]+$R["Index_length"];return
format_number($I);}function
set_utf8mb4($i){global$g;static$O=false;if(!$O&&preg_match('~\butf8mb4~i',$i)){$O=true;echo"SET NAMES ".charset($g).";\n\n";}}function
connect_error(){global$b,$g,$mi,$o,$cc;if(DB!=""){header("HTTP/1.1 404 Not Found");page_header('Database'.": ".h(DB),'Invalid database.',true);}else{if($_POST["db"]&&!$o)queries_redirect(substr(ME,0,-1),'Databases have been dropped.',drop_databases($_POST["db"]));page_header('Select database',$o,false);echo"<p class='links'>\n";foreach(array('database'=>'Create database','privileges'=>'Privileges','processlist'=>'Process list','variables'=>'Variables','status'=>'Status',)as$z=>$X){if(support($z))echo"<a href='".h(ME)."$z='>$X</a>\n";}echo"<p>".sprintf('%s version: %s through PHP extension %s',$cc[DRIVER],"<b>".h($g->server_info)."</b>","<b>$g->extension</b>")."\n","<p>".sprintf('Logged as: %s',"<b>".h(logged_user())."</b>")."\n";$l=$b->databases();if($l){$Yg=support("scheme");$ob=collations();echo"<form action='' method='post'>\n","<table cellspacing='0' class='checkable'>\n",script("mixin(qsl('table'), {onclick: tableClick, ondblclick: partialArg(tableClick, true)});"),"<thead><tr>".(support("database")?"<td>":"")."<th>".'Database'." - <a href='".h(ME)."refresh=1'>".'Refresh'."</a>"."<td>".'Collation'."<td>".'Tables'."<td>".'Size'." - <a href='".h(ME)."dbsize=1'>".'Compute'."</a>".script("qsl('a').onclick = partial(ajaxSetHtml, '".js_escape(ME)."script=connect');","")."</thead>\n";$l=($_GET["dbsize"]?count_tables($l):array_flip($l));foreach($l
as$m=>$S){$Qg=h(ME)."db=".urlencode($m);$u=h("Db-".$m);echo"<tr".odd().">".(support("database")?"<td>".checkbox("db[]",$m,in_array($m,(array)$_POST["db"]),"","","",$u):""),"<th><a href='$Qg' id='$u'>".h($m)."</a>";$d=h(db_collation($m,$ob));echo"<td>".(support("database")?"<a href='$Qg".($Yg?"&amp;ns=":"")."&amp;database=' title='".'Alter database'."'>$d</a>":$d),"<td align='right'><a href='$Qg&amp;schema=' id='tables-".h($m)."' title='".'Database schema'."'>".($_GET["dbsize"]?$S:"?")."</a>","<td align='right' id='size-".h($m)."'>".($_GET["dbsize"]?db_size($m):"?"),"\n";}echo"</table>\n",(support("database")?"<div class='footer'><div>\n"."<fieldset><legend>".'Selected'." <span id='selected'></span></legend><div>\n"."<input type='hidden' name='all' value=''>".script("qsl('input').onclick = function () { selectCount('selected', formChecked(this, /^db/)); };")."<input type='submit' name='drop' value='".'Drop'."'>".confirm()."\n"."</div></fieldset>\n"."</div></div>\n":""),"<input type='hidden' name='token' value='$mi'>\n","</form>\n",script("tableCheck();");}}page_footer("db");}if(isset($_GET["status"]))$_GET["variables"]=$_GET["status"];if(isset($_GET["import"]))$_GET["sql"]=$_GET["import"];if(!(DB!=""?$g->select_db(DB):isset($_GET["sql"])||isset($_GET["dump"])||isset($_GET["database"])||isset($_GET["processlist"])||isset($_GET["privileges"])||isset($_GET["user"])||isset($_GET["variables"])||$_GET["script"]=="connect"||$_GET["script"]=="kill")){if(DB!=""||$_GET["refresh"]){restart_session();set_session("dbs",null);}connect_error();exit;}if(support("scheme")&&DB!=""&&$_GET["ns"]!==""){if(!isset($_GET["ns"]))redirect(preg_replace('~ns=[^&]*&~','',ME)."ns=".get_schema());if(!set_schema($_GET["ns"])){header("HTTP/1.1 404 Not Found");page_header('Schema'.": ".h($_GET["ns"]),'Invalid schema.',true);page_footer("ns");exit;}}$nf="RESTRICT|NO ACTION|CASCADE|SET NULL|SET DEFAULT";class
TmpFile{var$handler;var$size;function
__construct(){$this->handler=tmpfile();}function
write($zb){$this->size+=strlen($zb);fwrite($this->handler,$zb);}function
send(){fseek($this->handler,0);fpassthru($this->handler);fclose($this->handler);}}$uc="'(?:''|[^'\\\\]|\\\\.)*'";$Pd="IN|OUT|INOUT";if(isset($_GET["select"])&&($_POST["edit"]||$_POST["clone"])&&!$_POST["save"])$_GET["edit"]=$_GET["select"];if(isset($_GET["callf"]))$_GET["call"]=$_GET["callf"];if(isset($_GET["function"]))$_GET["procedure"]=$_GET["function"];if(isset($_GET["download"])){$a=$_GET["download"];$q=fields($a);header("Content-Type: application/octet-stream");header("Content-Disposition: attachment; filename=".friendly_url("$a-".implode("_",$_GET["where"])).".".friendly_url($_GET["field"]));$L=array(idf_escape($_GET["field"]));$H=$n->select($a,$L,array(where($_GET,$q)),$L);$J=($H?$H->fetch_row():array());echo$n->value($J[0],$q[$_GET["field"]]);exit;}elseif(isset($_GET["table"])){$a=$_GET["table"];$q=fields($a);if(!$q)$o=error();$R=table_status1($a,true);$C=$b->tableName($R);page_header(($q&&is_view($R)?$R['Engine']=='materialized view'?'Materialized view':'View':'Table').": ".($C!=""?$C:h($a)),$o);$b->selectLinks($R);$tb=$R["Comment"];if($tb!="")echo"<p class='nowrap'>".'Comment'.": ".h($tb)."\n";if($q)$b->tableStructurePrint($q);if(!is_view($R)){if(support("indexes")){echo"<h3 id='indexes'>".'Indexes'."</h3>\n";$x=indexes($a);if($x)$b->tableIndexesPrint($x);echo'<p class="links"><a href="'.h(ME).'indexes='.urlencode($a).'">'.'Alter indexes'."</a>\n";}if(fk_support($R)){echo"<h3 id='foreign-keys'>".'Foreign keys'."</h3>\n";$cd=foreign_keys($a);if($cd){echo"<table cellspacing='0'>\n","<thead><tr><th>".'Source'."<td>".'Target'."<td>".'ON DELETE'."<td>".'ON UPDATE'."<td></thead>\n";foreach($cd
as$C=>$r){echo"<tr title='".h($C)."'>","<th><i>".implode("</i>, <i>",array_map('h',$r["source"]))."</i>","<td><a href='".h($r["db"]!=""?preg_replace('~db=[^&]*~',"db=".urlencode($r["db"]),ME):($r["ns"]!=""?preg_replace('~ns=[^&]*~',"ns=".urlencode($r["ns"]),ME):ME))."table=".urlencode($r["table"])."'>".($r["db"]!=""?"<b>".h($r["db"])."</b>.":"").($r["ns"]!=""?"<b>".h($r["ns"])."</b>.":"").h($r["table"])."</a>","(<i>".implode("</i>, <i>",array_map('h',$r["target"]))."</i>)","<td>".h($r["on_delete"])."\n","<td>".h($r["on_update"])."\n",'<td><a href="'.h(ME.'foreign='.urlencode($a).'&name='.urlencode($C)).'">'.'Alter'.'</a>';}echo"</table>\n";}echo'<p class="links"><a href="'.h(ME).'foreign='.urlencode($a).'">'.'Add foreign key'."</a>\n";}}if(support(is_view($R)?"view_trigger":"trigger")){echo"<h3 id='triggers'>".'Triggers'."</h3>\n";$yi=triggers($a);if($yi){echo"<table cellspacing='0'>\n";foreach($yi
as$z=>$X)echo"<tr valign='top'><td>".h($X[0])."<td>".h($X[1])."<th>".h($z)."<td><a href='".h(ME.'trigger='.urlencode($a).'&name='.urlencode($z))."'>".'Alter'."</a>\n";echo"</table>\n";}echo'<p class="links"><a href="'.h(ME).'trigger='.urlencode($a).'">'.'Add trigger'."</a>\n";}}elseif(isset($_GET["schema"])){page_header('Database schema',"",array(),h(DB.($_GET["ns"]?".$_GET[ns]":"")));$Ph=array();$Qh=array();$ea=($_GET["schema"]?$_GET["schema"]:$_COOKIE["adminer_schema-".str_replace(".","_",DB)]);preg_match_all('~([^:]+):([-0-9.]+)x([-0-9.]+)(_|$)~',$ea,$Be,PREG_SET_ORDER);foreach($Be
as$t=>$B){$Ph[$B[1]]=array($B[2],$B[3]);$Qh[]="\n\t'".js_escape($B[1])."': [ $B[2], $B[3] ]";}$ni=0;$Qa=-1;$Xg=array();$Cg=array();$pe=array();foreach(table_status('',true)as$Q=>$R){if(is_view($R))continue;$bg=0;$Xg[$Q]["fields"]=array();foreach(fields($Q)as$C=>$p){$bg+=1.25;$p["pos"]=$bg;$Xg[$Q]["fields"][$C]=$p;}$Xg[$Q]["pos"]=($Ph[$Q]?$Ph[$Q]:array($ni,0));foreach($b->foreignKeys($Q)as$X){if(!$X["db"]){$ne=$Qa;if($Ph[$Q][1]||$Ph[$X["table"]][1])$ne=min(floatval($Ph[$Q][1]),floatval($Ph[$X["table"]][1]))-1;else$Qa-=.1;while($pe[(string)$ne])$ne-=.0001;$Xg[$Q]["references"][$X["table"]][(string)$ne]=array($X["source"],$X["target"]);$Cg[$X["table"]][$Q][(string)$ne]=$X["target"];$pe[(string)$ne]=true;}}$ni=max($ni,$Xg[$Q]["pos"][0]+2.5+$bg);}echo'<div id="schema" style="height: ',$ni,'em;">
<script',nonce(),'>
qs(\'#schema\').onselectstart = function () { return false; };
var tablePos = {',implode(",",$Qh)."\n",'};
var em = qs(\'#schema\').offsetHeight / ',$ni,';
document.onmousemove = schemaMousemove;
document.onmouseup = partialArg(schemaMouseup, \'',js_escape(DB),'\');
</script>
';foreach($Xg
as$C=>$Q){echo"<div class='table' style='top: ".$Q["pos"][0]."em; left: ".$Q["pos"][1]."em;'>",'<a href="'.h(ME).'table='.urlencode($C).'"><b>'.h($C)."</b></a>",script("qsl('div').onmousedown = schemaMousedown;");foreach($Q["fields"]as$p){$X='<span'.type_class($p["type"]).' title="'.h($p["full_type"].($p["null"]?" NULL":'')).'">'.h($p["field"]).'</span>';echo"<br>".($p["primary"]?"<i>$X</i>":$X);}foreach((array)$Q["references"]as$Wh=>$Dg){foreach($Dg
as$ne=>$_g){$oe=$ne-$Ph[$C][1];$t=0;foreach($_g[0]as$th)echo"\n<div class='references' title='".h($Wh)."' id='refs$ne-".($t++)."' style='left: $oe"."em; top: ".$Q["fields"][$th]["pos"]."em; padding-top: .5em;'><div style='border-top: 1px solid Gray; width: ".(-$oe)."em;'></div></div>";}}foreach((array)$Cg[$C]as$Wh=>$Dg){foreach($Dg
as$ne=>$f){$oe=$ne-$Ph[$C][1];$t=0;foreach($f
as$Vh)echo"\n<div class='references' title='".h($Wh)."' id='refd$ne-".($t++)."' style='left: $oe"."em; top: ".$Q["fields"][$Vh]["pos"]."em; height: 1.25em; background: url(".h(preg_replace("~\\?.*~","",ME)."?file=arrow.gif) no-repeat right center;&version=4.7.1")."'><div style='height: .5em; border-bottom: 1px solid Gray; width: ".(-$oe)."em;'></div></div>";}}echo"\n</div>\n";}foreach($Xg
as$C=>$Q){foreach((array)$Q["references"]as$Wh=>$Dg){foreach($Dg
as$ne=>$_g){$Qe=$ni;$Fe=-10;foreach($_g[0]as$z=>$th){$cg=$Q["pos"][0]+$Q["fields"][$th]["pos"];$dg=$Xg[$Wh]["pos"][0]+$Xg[$Wh]["fields"][$_g[1][$z]]["pos"];$Qe=min($Qe,$cg,$dg);$Fe=max($Fe,$cg,$dg);}echo"<div class='references' id='refl$ne' style='left: $ne"."em; top: $Qe"."em; padding: .5em 0;'><div style='border-right: 1px solid Gray; margin-top: 1px; height: ".($Fe-$Qe)."em;'></div></div>\n";}}}echo'</div>
<p class="links"><a href="',h(ME."schema=".urlencode($ea)),'" id="schema-link">Permanent link</a>
';}elseif(isset($_GET["dump"])){$a=$_GET["dump"];if($_POST&&!$o){$Bb="";foreach(array("output","format","db_style","routines","events","table_style","auto_increment","triggers","data_style")as$z)$Bb.="&$z=".urlencode($_POST[$z]);cookie("adminer_export",substr($Bb,1));$S=array_flip((array)$_POST["tables"])+array_flip((array)$_POST["data"]);$Gc=dump_headers((count($S)==1?key($S):DB),(DB==""||count($S)>1));$Xd=preg_match('~sql~',$_POST["format"]);if($Xd){echo"-- Adminer $ia ".$cc[DRIVER]." dump\n\n";if($y=="sql"){echo"SET NAMES utf8;
SET time_zone = '+00:00';
".($_POST["data_style"]?"SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';
":"")."
";$g->query("SET time_zone = '+00:00';");}}$Gh=$_POST["db_style"];$l=array(DB);if(DB==""){$l=$_POST["databases"];if(is_string($l))$l=explode("\n",rtrim(str_replace("\r","",$l),"\n"));}foreach((array)$l
as$m){$b->dumpDatabase($m);if($g->select_db($m)){if($Xd&&preg_match('~CREATE~',$Gh)&&($i=$g->result("SHOW CREATE DATABASE ".idf_escape($m),1))){set_utf8mb4($i);if($Gh=="DROP+CREATE")echo"DROP DATABASE IF EXISTS ".idf_escape($m).";\n";echo"$i;\n";}if($Xd){if($Gh)echo
use_sql($m).";\n\n";$Gf="";if($_POST["routines"]){foreach(array("FUNCTION","PROCEDURE")as$Rg){foreach(get_rows("SHOW $Rg STATUS WHERE Db = ".q($m),null,"-- ")as$J){$i=remove_definer($g->result("SHOW CREATE $Rg ".idf_escape($J["Name"]),2));set_utf8mb4($i);$Gf.=($Gh!='DROP+CREATE'?"DROP $Rg IF EXISTS ".idf_escape($J["Name"]).";;\n":"")."$i;;\n\n";}}}if($_POST["events"]){foreach(get_rows("SHOW EVENTS",null,"-- ")as$J){$i=remove_definer($g->result("SHOW CREATE EVENT ".idf_escape($J["Name"]),3));set_utf8mb4($i);$Gf.=($Gh!='DROP+CREATE'?"DROP EVENT IF EXISTS ".idf_escape($J["Name"]).";;\n":"")."$i;;\n\n";}}if($Gf)echo"DELIMITER ;;\n\n$Gf"."DELIMITER ;\n\n";}if($_POST["table_style"]||$_POST["data_style"]){$Xi=array();foreach(table_status('',true)as$C=>$R){$Q=(DB==""||in_array($C,(array)$_POST["tables"]));$Jb=(DB==""||in_array($C,(array)$_POST["data"]));if($Q||$Jb){if($Gc=="tar"){$ji=new
TmpFile;ob_start(array($ji,'write'),1e5);}$b->dumpTable($C,($Q?$_POST["table_style"]:""),(is_view($R)?2:0));if(is_view($R))$Xi[]=$C;elseif($Jb){$q=fields($C);$b->dumpData($C,$_POST["data_style"],"SELECT *".convert_fields($q,$q)." FROM ".table($C));}if($Xd&&$_POST["triggers"]&&$Q&&($yi=trigger_sql($C)))echo"\nDELIMITER ;;\n$yi\nDELIMITER ;\n";if($Gc=="tar"){ob_end_flush();tar_file((DB!=""?"":"$m/")."$C.csv",$ji);}elseif($Xd)echo"\n";}}foreach($Xi
as$Wi)$b->dumpTable($Wi,$_POST["table_style"],1);if($Gc=="tar")echo
pack("x512");}}}if($Xd)echo"-- ".$g->result("SELECT NOW()")."\n";exit;}page_header('Export',$o,($_GET["export"]!=""?array("table"=>$_GET["export"]):array()),h(DB));echo'
<form action="" method="post">
<table cellspacing="0" class="layout">
';$Nb=array('','USE','DROP+CREATE','CREATE');$Rh=array('','DROP+CREATE','CREATE');$Kb=array('','TRUNCATE+INSERT','INSERT');if($y=="sql")$Kb[]='INSERT+UPDATE';parse_str($_COOKIE["adminer_export"],$J);if(!$J)$J=array("output"=>"text","format"=>"sql","db_style"=>(DB!=""?"":"CREATE"),"table_style"=>"DROP+CREATE","data_style"=>"INSERT");if(!isset($J["events"])){$J["routines"]=$J["events"]=($_GET["dump"]=="");$J["triggers"]=$J["table_style"];}echo"<tr><th>".'Output'."<td>".html_select("output",$b->dumpOutput(),$J["output"],0)."\n";echo"<tr><th>".'Format'."<td>".html_select("format",$b->dumpFormat(),$J["format"],0)."\n";echo($y=="sqlite"?"":"<tr><th>".'Database'."<td>".html_select('db_style',$Nb,$J["db_style"]).(support("routine")?checkbox("routines",1,$J["routines"],'Routines'):"").(support("event")?checkbox("events",1,$J["events"],'Events'):"")),"<tr><th>".'Tables'."<td>".html_select('table_style',$Rh,$J["table_style"]).checkbox("auto_increment",1,$J["auto_increment"],'Auto Increment').(support("trigger")?checkbox("triggers",1,$J["triggers"],'Triggers'):""),"<tr><th>".'Data'."<td>".html_select('data_style',$Kb,$J["data_style"]),'</table>
<p><input type="submit" value="Export">
<input type="hidden" name="token" value="',$mi,'">

<table cellspacing="0">
',script("qsl('table').onclick = dumpClick;");$gg=array();if(DB!=""){$eb=($a!=""?"":" checked");echo"<thead><tr>","<th style='text-align: left;'><label class='block'><input type='checkbox' id='check-tables'$eb>".'Tables'."</label>".script("qs('#check-tables').onclick = partial(formCheck, /^tables\\[/);",""),"<th style='text-align: right;'><label class='block'>".'Data'."<input type='checkbox' id='check-data'$eb></label>".script("qs('#check-data').onclick = partial(formCheck, /^data\\[/);",""),"</thead>\n";$Xi="";$Sh=tables_list();foreach($Sh
as$C=>$T){$fg=preg_replace('~_.*~','',$C);$eb=($a==""||$a==(substr($a,-1)=="%"?"$fg%":$C));$jg="<tr><td>".checkbox("tables[]",$C,$eb,$C,"","block");if($T!==null&&!preg_match('~table~i',$T))$Xi.="$jg\n";else
echo"$jg<td align='right'><label class='block'><span id='Rows-".h($C)."'></span>".checkbox("data[]",$C,$eb)."</label>\n";$gg[$fg]++;}echo$Xi;if($Sh)echo
script("ajaxSetHtml('".js_escape(ME)."script=db');");}else{echo"<thead><tr><th style='text-align: left;'>","<label class='block'><input type='checkbox' id='check-databases'".($a==""?" checked":"").">".'Database'."</label>",script("qs('#check-databases').onclick = partial(formCheck, /^databases\\[/);",""),"</thead>\n";$l=$b->databases();if($l){foreach($l
as$m){if(!information_schema($m)){$fg=preg_replace('~_.*~','',$m);echo"<tr><td>".checkbox("databases[]",$m,$a==""||$a=="$fg%",$m,"","block")."\n";$gg[$fg]++;}}}else
echo"<tr><td><textarea name='databases' rows='10' cols='20'></textarea>";}echo'</table>
</form>
';$Uc=true;foreach($gg
as$z=>$X){if($z!=""&&$X>1){echo($Uc?"<p>":" ")."<a href='".h(ME)."dump=".urlencode("$z%")."'>".h($z)."</a>";$Uc=false;}}}elseif(isset($_GET["privileges"])){page_header('Privileges');echo'<p class="links"><a href="'.h(ME).'user=">'.'Create user'."</a>";$H=$g->query("SELECT User, Host FROM mysql.".(DB==""?"user":"db WHERE ".q(DB)." LIKE Db")." ORDER BY Host, User");$jd=$H;if(!$H)$H=$g->query("SELECT SUBSTRING_INDEX(CURRENT_USER, '@', 1) AS User, SUBSTRING_INDEX(CURRENT_USER, '@', -1) AS Host");echo"<form action=''><p>\n";hidden_fields_get();echo"<input type='hidden' name='db' value='".h(DB)."'>\n",($jd?"":"<input type='hidden' name='grant' value=''>\n"),"<table cellspacing='0'>\n","<thead><tr><th>".'Username'."<th>".'Server'."<th></thead>\n";while($J=$H->fetch_assoc())echo'<tr'.odd().'><td>'.h($J["User"])."<td>".h($J["Host"]).'<td><a href="'.h(ME.'user='.urlencode($J["User"]).'&host='.urlencode($J["Host"])).'">'.'Edit'."</a>\n";if(!$jd||DB!="")echo"<tr".odd()."><td><input name='user' autocapitalize='off'><td><input name='host' value='localhost' autocapitalize='off'><td><input type='submit' value='".'Edit'."'>\n";echo"</table>\n","</form>\n";}elseif(isset($_GET["sql"])){if(!$o&&$_POST["export"]){dump_headers("sql");$b->dumpTable("","");$b->dumpData("","table",$_POST["query"]);exit;}restart_session();$xd=&get_session("queries");$wd=&$xd[DB];if(!$o&&$_POST["clear"]){$wd=array();redirect(remove_from_uri("history"));}page_header((isset($_GET["import"])?'Import':'SQL command'),$o);if(!$o&&$_POST){$gd=false;if(!isset($_GET["import"]))$G=$_POST["query"];elseif($_POST["webfile"]){$xh=$b->importServerPath();$gd=@fopen((file_exists($xh)?$xh:"compress.zlib://$xh.gz"),"rb");$G=($gd?fread($gd,1e6):false);}else$G=get_file("sql_file",true);if(is_string($G)){if(function_exists('memory_get_usage'))@ini_set("memory_limit",max(ini_bytes("memory_limit"),2*strlen($G)+memory_get_usage()+8e6));if($G!=""&&strlen($G)<1e6){$rg=$G.(preg_match("~;[ \t\r\n]*\$~",$G)?"":";");if(!$wd||reset(end($wd))!=$rg){restart_session();$wd[]=array($rg,time());set_session("queries",$xd);stop_session();}}$uh="(?:\\s|/\\*[\s\S]*?\\*/|(?:#|-- )[^\n]*\n?|--\r?\n)";$Tb=";";$D=0;$rc=true;$h=connect();if(is_object($h)&&DB!="")$h->select_db(DB);$sb=0;$wc=array();$Nf='[\'"'.($y=="sql"?'`#':($y=="sqlite"?'`[':($y=="mssql"?'[':''))).']|/\*|-- |$'.($y=="pgsql"?'|\$[^$]*\$':'');$oi=microtime(true);parse_str($_COOKIE["adminer_export"],$xa);$ic=$b->dumpFormat();unset($ic["sql"]);while($G!=""){if(!$D&&preg_match("~^$uh*+DELIMITER\\s+(\\S+)~i",$G,$B)){$Tb=$B[1];$G=substr($G,strlen($B[0]));}else{preg_match('('.preg_quote($Tb)."\\s*|$Nf)",$G,$B,PREG_OFFSET_CAPTURE,$D);list($ed,$bg)=$B[0];if(!$ed&&$gd&&!feof($gd))$G.=fread($gd,1e5);else{if(!$ed&&rtrim($G)=="")break;$D=$bg+strlen($ed);if($ed&&rtrim($ed)!=$Tb){while(preg_match('('.($ed=='/*'?'\*/':($ed=='['?']':(preg_match('~^-- |^#~',$ed)?"\n":preg_quote($ed)."|\\\\."))).'|$)s',$G,$B,PREG_OFFSET_CAPTURE,$D)){$Vg=$B[0][0];if(!$Vg&&$gd&&!feof($gd))$G.=fread($gd,1e5);else{$D=$B[0][1]+strlen($Vg);if($Vg[0]!="\\")break;}}}else{$rc=false;$rg=substr($G,0,$bg);$sb++;$jg="<pre id='sql-$sb'><code class='jush-$y'>".$b->sqlCommandQuery($rg)."</code></pre>\n";if($y=="sqlite"&&preg_match("~^$uh*+ATTACH\\b~i",$rg,$B)){echo$jg,"<p class='error'>".'ATTACH queries are not supported.'."\n";$wc[]=" <a href='#sql-$sb'>$sb</a>";if($_POST["error_stops"])break;}else{if(!$_POST["only_errors"]){echo$jg;ob_flush();flush();}$Ah=microtime(true);if($g->multi_query($rg)&&is_object($h)&&preg_match("~^$uh*+USE\\b~i",$rg))$h->query($rg);do{$H=$g->store_result();if($g->error){echo($_POST["only_errors"]?$jg:""),"<p class='error'>".'Error in query'.($g->errno?" ($g->errno)":"").": ".error()."\n";$wc[]=" <a href='#sql-$sb'>$sb</a>";if($_POST["error_stops"])break
2;}else{$ci=" <span class='time'>(".format_time($Ah).")</span>".(strlen($rg)<1000?" <a href='".h(ME)."sql=".urlencode(trim($rg))."'>".'Edit'."</a>":"");$za=$g->affected_rows;$aj=($_POST["only_errors"]?"":$n->warnings());$bj="warnings-$sb";if($aj)$ci.=", <a href='#$bj'>".'Warnings'."</a>".script("qsl('a').onclick = partial(toggle, '$bj');","");$Dc=null;$Ec="explain-$sb";if(is_object($H)){$_=$_POST["limit"];$_f=select($H,$h,array(),$_);if(!$_POST["only_errors"]){echo"<form action='' method='post'>\n";$df=$H->num_rows;echo"<p>".($df?($_&&$df>$_?sprintf('%d / ',$_):"").lang(array('%d row','%d rows'),$df):""),$ci;if($h&&preg_match("~^($uh|\\()*+SELECT\\b~i",$rg)&&($Dc=explain($h,$rg)))echo", <a href='#$Ec'>Explain</a>".script("qsl('a').onclick = partial(toggle, '$Ec');","");$u="export-$sb";echo", <a href='#$u'>".'Export'."</a>".script("qsl('a').onclick = partial(toggle, '$u');","")."<span id='$u' class='hidden'>: ".html_select("output",$b->dumpOutput(),$xa["output"])." ".html_select("format",$ic,$xa["format"])."<input type='hidden' name='query' value='".h($rg)."'>"." <input type='submit' name='export' value='".'Export'."'><input type='hidden' name='token' value='$mi'></span>\n"."</form>\n";}}else{if(preg_match("~^$uh*+(CREATE|DROP|ALTER)$uh++(DATABASE|SCHEMA)\\b~i",$rg)){restart_session();set_session("dbs",null);stop_session();}if(!$_POST["only_errors"])echo"<p class='message' title='".h($g->info)."'>".lang(array('Query executed OK, %d row affected.','Query executed OK, %d rows affected.'),$za)."$ci\n";}echo($aj?"<div id='$bj' class='hidden'>\n$aj</div>\n":"");if($Dc){echo"<div id='$Ec' class='hidden'>\n";select($Dc,$h,$_f);echo"</div>\n";}}$Ah=microtime(true);}while($g->next_result());}$G=substr($G,$D);$D=0;}}}}if($rc)echo"<p class='message'>".'No commands to execute.'."\n";elseif($_POST["only_errors"]){echo"<p class='message'>".lang(array('%d query executed OK.','%d queries executed OK.'),$sb-count($wc))," <span class='time'>(".format_time($oi).")</span>\n";}elseif($wc&&$sb>1)echo"<p class='error'>".'Error in query'.": ".implode("",$wc)."\n";}else
echo"<p class='error'>".upload_error($G)."\n";}echo'
<form action="" method="post" enctype="multipart/form-data" id="form">
';$Ac="<input type='submit' value='".'Execute'."' title='Ctrl+Enter'>";if(!isset($_GET["import"])){$rg=$_GET["sql"];if($_POST)$rg=$_POST["query"];elseif($_GET["history"]=="all")$rg=$wd;elseif($_GET["history"]!="")$rg=$wd[$_GET["history"]][0];echo"<p>";textarea("query",$rg,20);echo
script(($_POST?"":"qs('textarea').focus();\n")."qs('#form').onsubmit = partial(sqlSubmit, qs('#form'), '".remove_from_uri("sql|limit|error_stops|only_errors")."');"),"<p>$Ac\n",'Limit rows'.": <input type='number' name='limit' class='size' value='".h($_POST?$_POST["limit"]:$_GET["limit"])."'>\n";}else{echo"<fieldset><legend>".'File upload'."</legend><div>";$pd=(extension_loaded("zlib")?"[.gz]":"");echo(ini_bool("file_uploads")?"SQL$pd (&lt; ".ini_get("upload_max_filesize")."B): <input type='file' name='sql_file[]' multiple>\n$Ac":'File uploads are disabled.'),"</div></fieldset>\n";$Ed=$b->importServerPath();if($Ed){echo"<fieldset><legend>".'From server'."</legend><div>",sprintf('Webserver file %s',"<code>".h($Ed)."$pd</code>"),' <input type="submit" name="webfile" value="'.'Run file'.'">',"</div></fieldset>\n";}echo"<p>";}echo
checkbox("error_stops",1,($_POST?$_POST["error_stops"]:isset($_GET["import"])),'Stop on error')."\n",checkbox("only_errors",1,($_POST?$_POST["only_errors"]:isset($_GET["import"])),'Show only errors')."\n","<input type='hidden' name='token' value='$mi'>\n";if(!isset($_GET["import"])&&$wd){print_fieldset("history",'History',$_GET["history"]!="");for($X=end($wd);$X;$X=prev($wd)){$z=key($wd);list($rg,$ci,$mc)=$X;echo'<a href="'.h(ME."sql=&history=$z").'">'.'Edit'."</a>"." <span class='time' title='".@date('Y-m-d',$ci)."'>".@date("H:i:s",$ci)."</span>"." <code class='jush-$y'>".shorten_utf8(ltrim(str_replace("\n"," ",str_replace("\r","",preg_replace('~^(#|-- ).*~m','',$rg)))),80,"</code>").($mc?" <span class='time'>($mc)</span>":"")."<br>\n";}echo"<input type='submit' name='clear' value='".'Clear'."'>\n","<a href='".h(ME."sql=&history=all")."'>".'Edit all'."</a>\n","</div></fieldset>\n";}echo'</form>
';}elseif(isset($_GET["edit"])){$a=$_GET["edit"];$q=fields($a);$Z=(isset($_GET["select"])?($_POST["check"]&&count($_POST["check"])==1?where_check($_POST["check"][0],$q):""):where($_GET,$q));$Hi=(isset($_GET["select"])?$_POST["edit"]:$Z);foreach($q
as$C=>$p){if(!isset($p["privileges"][$Hi?"update":"insert"])||$b->fieldName($p)=="")unset($q[$C]);}if($_POST&&!$o&&!isset($_GET["select"])){$ve=$_POST["referer"];if($_POST["insert"])$ve=($Hi?null:$_SERVER["REQUEST_URI"]);elseif(!preg_match('~^.+&select=.+$~',$ve))$ve=ME."select=".urlencode($a);$x=indexes($a);$Ci=unique_array($_GET["where"],$x);$ug="\nWHERE $Z";if(isset($_POST["delete"]))queries_redirect($ve,'Item has been deleted.',$n->delete($a,$ug,!$Ci));else{$O=array();foreach($q
as$C=>$p){$X=process_input($p);if($X!==false&&$X!==null)$O[idf_escape($C)]=$X;}if($Hi){if(!$O)redirect($ve);queries_redirect($ve,'Item has been updated.',$n->update($a,$O,$ug,!$Ci));if(is_ajax()){page_headers();page_messages($o);exit;}}else{$H=$n->insert($a,$O);$me=($H?last_id():0);queries_redirect($ve,sprintf('Item%s has been inserted.',($me?" $me":"")),$H);}}}$J=null;if($_POST["save"])$J=(array)$_POST["fields"];elseif($Z){$L=array();foreach($q
as$C=>$p){if(isset($p["privileges"]["select"])){$Ga=convert_field($p);if($_POST["clone"]&&$p["auto_increment"])$Ga="''";if($y=="sql"&&preg_match("~enum|set~",$p["type"]))$Ga="1*".idf_escape($C);$L[]=($Ga?"$Ga AS ":"").idf_escape($C);}}$J=array();if(!support("table"))$L=array("*");if($L){$H=$n->select($a,$L,array($Z),$L,array(),(isset($_GET["select"])?2:1));if(!$H)$o=error();else{$J=$H->fetch_assoc();if(!$J)$J=false;}if(isset($_GET["select"])&&(!$J||$H->fetch_assoc()))$J=null;}}if(!support("table")&&!$q){if(!$Z){$H=$n->select($a,array("*"),$Z,array("*"));$J=($H?$H->fetch_assoc():false);if(!$J)$J=array($n->primary=>"");}if($J){foreach($J
as$z=>$X){if(!$Z)$J[$z]=null;$q[$z]=array("field"=>$z,"null"=>($z!=$n->primary),"auto_increment"=>($z==$n->primary));}}}edit_form($a,$q,$J,$Hi);}elseif(isset($_GET["create"])){$a=$_GET["create"];$Pf=array();foreach(array('HASH','LINEAR HASH','KEY','LINEAR KEY','RANGE','LIST')as$z)$Pf[$z]=$z;$Bg=referencable_primary($a);$cd=array();foreach($Bg
as$Nh=>$p)$cd[str_replace("`","``",$Nh)."`".str_replace("`","``",$p["field"])]=$Nh;$Cf=array();$R=array();if($a!=""){$Cf=fields($a);$R=table_status($a);if(!$R)$o='No tables.';}$J=$_POST;$J["fields"]=(array)$J["fields"];if($J["auto_increment_col"])$J["fields"][$J["auto_increment_col"]]["auto_increment"]=true;if($_POST)set_adminer_settings(array("comments"=>$_POST["comments"],"defaults"=>$_POST["defaults"]));if($_POST&&!process_fields($J["fields"])&&!$o){if($_POST["drop"])queries_redirect(substr(ME,0,-1),'Table has been dropped.',drop_tables(array($a)));else{$q=array();$Da=array();$Mi=false;$ad=array();$Bf=reset($Cf);$Aa=" FIRST";foreach($J["fields"]as$z=>$p){$r=$cd[$p["type"]];$zi=($r!==null?$Bg[$r]:$p);if($p["field"]!=""){if(!$p["has_default"])$p["default"]=null;if($z==$J["auto_increment_col"])$p["auto_increment"]=true;$og=process_field($p,$zi);$Da[]=array($p["orig"],$og,$Aa);if($og!=process_field($Bf,$Bf)){$q[]=array($p["orig"],$og,$Aa);if($p["orig"]!=""||$Aa)$Mi=true;}if($r!==null)$ad[idf_escape($p["field"])]=($a!=""&&$y!="sqlite"?"ADD":" ").format_foreign_key(array('table'=>$cd[$p["type"]],'source'=>array($p["field"]),'target'=>array($zi["field"]),'on_delete'=>$p["on_delete"],));$Aa=" AFTER ".idf_escape($p["field"]);}elseif($p["orig"]!=""){$Mi=true;$q[]=array($p["orig"]);}if($p["orig"]!=""){$Bf=next($Cf);if(!$Bf)$Aa="";}}$Rf="";if($Pf[$J["partition_by"]]){$Sf=array();if($J["partition_by"]=='RANGE'||$J["partition_by"]=='LIST'){foreach(array_filter($J["partition_names"])as$z=>$X){$Y=$J["partition_values"][$z];$Sf[]="\n  PARTITION ".idf_escape($X)." VALUES ".($J["partition_by"]=='RANGE'?"LESS THAN":"IN").($Y!=""?" ($Y)":" MAXVALUE");}}$Rf.="\nPARTITION BY $J[partition_by]($J[partition])".($Sf?" (".implode(",",$Sf)."\n)":($J["partitions"]?" PARTITIONS ".(+$J["partitions"]):""));}elseif(support("partitioning")&&preg_match("~partitioned~",$R["Create_options"]))$Rf.="\nREMOVE PARTITIONING";$Je='Table has been altered.';if($a==""){cookie("adminer_engine",$J["Engine"]);$Je='Table has been created.';}$C=trim($J["name"]);queries_redirect(ME.(support("table")?"table=":"select=").urlencode($C),$Je,alter_table($a,$C,($y=="sqlite"&&($Mi||$ad)?$Da:$q),$ad,($J["Comment"]!=$R["Comment"]?$J["Comment"]:null),($J["Engine"]&&$J["Engine"]!=$R["Engine"]?$J["Engine"]:""),($J["Collation"]&&$J["Collation"]!=$R["Collation"]?$J["Collation"]:""),($J["Auto_increment"]!=""?number($J["Auto_increment"]):""),$Rf));}}page_header(($a!=""?'Alter table':'Create table'),$o,array("table"=>$a),h($a));if(!$_POST){$J=array("Engine"=>$_COOKIE["adminer_engine"],"fields"=>array(array("field"=>"","type"=>(isset($U["int"])?"int":(isset($U["integer"])?"integer":"")),"on_update"=>"")),"partition_names"=>array(""),);if($a!=""){$J=$R;$J["name"]=$a;$J["fields"]=array();if(!$_GET["auto_increment"])$J["Auto_increment"]="";foreach($Cf
as$p){$p["has_default"]=isset($p["default"]);$J["fields"][]=$p;}if(support("partitioning")){$hd="FROM information_schema.PARTITIONS WHERE TABLE_SCHEMA = ".q(DB)." AND TABLE_NAME = ".q($a);$H=$g->query("SELECT PARTITION_METHOD, PARTITION_ORDINAL_POSITION, PARTITION_EXPRESSION $hd ORDER BY PARTITION_ORDINAL_POSITION DESC LIMIT 1");list($J["partition_by"],$J["partitions"],$J["partition"])=$H->fetch_row();$Sf=get_key_vals("SELECT PARTITION_NAME, PARTITION_DESCRIPTION $hd AND PARTITION_NAME != '' ORDER BY PARTITION_ORDINAL_POSITION");$Sf[""]="";$J["partition_names"]=array_keys($Sf);$J["partition_values"]=array_values($Sf);}}}$ob=collations();$tc=engines();foreach($tc
as$sc){if(!strcasecmp($sc,$J["Engine"])){$J["Engine"]=$sc;break;}}echo'
<form action="" method="post" id="form">
<p>
';if(support("columns")||$a==""){echo'Table name: <input name="name" data-maxlength="64" value="',h($J["name"]),'" autocapitalize="off">
';if($a==""&&!$_POST)echo
script("focus(qs('#form')['name']);");echo($tc?"<select name='Engine'>".optionlist(array(""=>"(".'engine'.")")+$tc,$J["Engine"])."</select>".on_help("getTarget(event).value",1).script("qsl('select').onchange = helpClose;"):""),' ',($ob&&!preg_match("~sqlite|mssql~",$y)?html_select("Collation",array(""=>"(".'collation'.")")+$ob,$J["Collation"]):""),' <input type="submit" value="Save">
';}echo'
';if(support("columns")){echo'<div class="scrollable">
<table cellspacing="0" id="edit-fields" class="nowrap">
';edit_fields($J["fields"],$ob,"TABLE",$cd);echo'</table>
</div>
<p>
Auto Increment: <input type="number" name="Auto_increment" size="6" value="',h($J["Auto_increment"]),'">
',checkbox("defaults",1,($_POST?$_POST["defaults"]:adminer_setting("defaults")),'Default values',"columnShow(this.checked, 5)","jsonly"),(support("comment")?checkbox("comments",1,($_POST?$_POST["comments"]:adminer_setting("comments")),'Comment',"editingCommentsClick(this, true);","jsonly").' <input name="Comment" value="'.h($J["Comment"]).'" data-maxlength="'.(min_version(5.5)?2048:60).'">':''),'<p>
<input type="submit" value="Save">
';}echo'
';if($a!=""){echo'<input type="submit" name="drop" value="Drop">',confirm(sprintf('Drop %s?',$a));}if(support("partitioning")){$Qf=preg_match('~RANGE|LIST~',$J["partition_by"]);print_fieldset("partition",'Partition by',$J["partition_by"]);echo'<p>
',"<select name='partition_by'>".optionlist(array(""=>"")+$Pf,$J["partition_by"])."</select>".on_help("getTarget(event).value.replace(/./, 'PARTITION BY \$&')",1).script("qsl('select').onchange = partitionByChange;"),'(<input name="partition" value="',h($J["partition"]),'">)
Partitions: <input type="number" name="partitions" class="size',($Qf||!$J["partition_by"]?" hidden":""),'" value="',h($J["partitions"]),'">
<table cellspacing="0" id="partition-table"',($Qf?"":" class='hidden'"),'>
<thead><tr><th>Partition name<th>Values</thead>
';foreach($J["partition_names"]as$z=>$X){echo'<tr>','<td><input name="partition_names[]" value="'.h($X).'" autocapitalize="off">',($z==count($J["partition_names"])-1?script("qsl('input').oninput = partitionNameChange;"):''),'<td><input name="partition_values[]" value="'.h($J["partition_values"][$z]).'">';}echo'</table>
</div></fieldset>
';}echo'<input type="hidden" name="token" value="',$mi,'">
</form>
',script("qs('#form')['defaults'].onclick();".(support("comment")?" editingCommentsClick(qs('#form')['comments']);":""));}elseif(isset($_GET["indexes"])){$a=$_GET["indexes"];$Hd=array("PRIMARY","UNIQUE","INDEX");$R=table_status($a,true);if(preg_match('~MyISAM|M?aria'.(min_version(5.6,'10.0.5')?'|InnoDB':'').'~i',$R["Engine"]))$Hd[]="FULLTEXT";if(preg_match('~MyISAM|M?aria'.(min_version(5.7,'10.2.2')?'|InnoDB':'').'~i',$R["Engine"]))$Hd[]="SPATIAL";$x=indexes($a);$hg=array();if($y=="mongo"){$hg=$x["_id_"];unset($Hd[0]);unset($x["_id_"]);}$J=$_POST;if($_POST&&!$o&&!$_POST["add"]&&!$_POST["drop_col"]){$c=array();foreach($J["indexes"]as$w){$C=$w["name"];if(in_array($w["type"],$Hd)){$f=array();$se=array();$Vb=array();$O=array();ksort($w["columns"]);foreach($w["columns"]as$z=>$e){if($e!=""){$re=$w["lengths"][$z];$Ub=$w["descs"][$z];$O[]=idf_escape($e).($re?"(".(+$re).")":"").($Ub?" DESC":"");$f[]=$e;$se[]=($re?$re:null);$Vb[]=$Ub;}}if($f){$Bc=$x[$C];if($Bc){ksort($Bc["columns"]);ksort($Bc["lengths"]);ksort($Bc["descs"]);if($w["type"]==$Bc["type"]&&array_values($Bc["columns"])===$f&&(!$Bc["lengths"]||array_values($Bc["lengths"])===$se)&&array_values($Bc["descs"])===$Vb){unset($x[$C]);continue;}}$c[]=array($w["type"],$C,$O);}}}foreach($x
as$C=>$Bc)$c[]=array($Bc["type"],$C,"DROP");if(!$c)redirect(ME."table=".urlencode($a));queries_redirect(ME."table=".urlencode($a),'Indexes have been altered.',alter_indexes($a,$c));}page_header('Indexes',$o,array("table"=>$a),h($a));$q=array_keys(fields($a));if($_POST["add"]){foreach($J["indexes"]as$z=>$w){if($w["columns"][count($w["columns"])]!="")$J["indexes"][$z]["columns"][]="";}$w=end($J["indexes"]);if($w["type"]||array_filter($w["columns"],'strlen'))$J["indexes"][]=array("columns"=>array(1=>""));}if(!$J){foreach($x
as$z=>$w){$x[$z]["name"]=$z;$x[$z]["columns"][]="";}$x[]=array("columns"=>array(1=>""));$J["indexes"]=$x;}echo'
<form action="" method="post">
<div class="scrollable">
<table cellspacing="0" class="nowrap">
<thead><tr>
<th id="label-type">Index Type
<th><input type="submit" class="wayoff">Column (length)
<th id="label-name">Name
<th><noscript>',"<input type='image' class='icon' name='add[0]' src='".h(preg_replace("~\\?.*~","",ME)."?file=plus.gif&version=4.7.1")."' alt='+' title='".'Add next'."'>",'</noscript>
</thead>
';if($hg){echo"<tr><td>PRIMARY<td>";foreach($hg["columns"]as$z=>$e){echo
select_input(" disabled",$q,$e),"<label><input disabled type='checkbox'>".'descending'."</label> ";}echo"<td><td>\n";}$ae=1;foreach($J["indexes"]as$w){if(!$_POST["drop_col"]||$ae!=key($_POST["drop_col"])){echo"<tr><td>".html_select("indexes[$ae][type]",array(-1=>"")+$Hd,$w["type"],($ae==count($J["indexes"])?"indexesAddRow.call(this);":1),"label-type"),"<td>";ksort($w["columns"]);$t=1;foreach($w["columns"]as$z=>$e){echo"<span>".select_input(" name='indexes[$ae][columns][$t]' title='".'Column'."'",($q?array_combine($q,$q):$q),$e,"partial(".($t==count($w["columns"])?"indexesAddColumn":"indexesChangeColumn").", '".js_escape($y=="sql"?"":$_GET["indexes"]."_")."')"),($y=="sql"||$y=="mssql"?"<input type='number' name='indexes[$ae][lengths][$t]' class='size' value='".h($w["lengths"][$z])."' title='".'Length'."'>":""),(support("descidx")?checkbox("indexes[$ae][descs][$t]",1,$w["descs"][$z],'descending'):"")," </span>";$t++;}echo"<td><input name='indexes[$ae][name]' value='".h($w["name"])."' autocapitalize='off' aria-labelledby='label-name'>\n","<td><input type='image' class='icon' name='drop_col[$ae]' src='".h(preg_replace("~\\?.*~","",ME)."?file=cross.gif&version=4.7.1")."' alt='x' title='".'Remove'."'>".script("qsl('input').onclick = partial(editingRemoveRow, 'indexes\$1[type]');");}$ae++;}echo'</table>
</div>
<p>
<input type="submit" value="Save">
<input type="hidden" name="token" value="',$mi,'">
</form>
';}elseif(isset($_GET["database"])){$J=$_POST;if($_POST&&!$o&&!isset($_POST["add_x"])){$C=trim($J["name"]);if($_POST["drop"]){$_GET["db"]="";queries_redirect(remove_from_uri("db|database"),'Database has been dropped.',drop_databases(array(DB)));}elseif(DB!==$C){if(DB!=""){$_GET["db"]=$C;queries_redirect(preg_replace('~\bdb=[^&]*&~','',ME)."db=".urlencode($C),'Database has been renamed.',rename_database($C,$J["collation"]));}else{$l=explode("\n",str_replace("\r","",$C));$Hh=true;$le="";foreach($l
as$m){if(count($l)==1||$m!=""){if(!create_database($m,$J["collation"]))$Hh=false;$le=$m;}}restart_session();set_session("dbs",null);queries_redirect(ME."db=".urlencode($le),'Database has been created.',$Hh);}}else{if(!$J["collation"])redirect(substr(ME,0,-1));query_redirect("ALTER DATABASE ".idf_escape($C).(preg_match('~^[a-z0-9_]+$~i',$J["collation"])?" COLLATE $J[collation]":""),substr(ME,0,-1),'Database has been altered.');}}page_header(DB!=""?'Alter database':'Create database',$o,array(),h(DB));$ob=collations();$C=DB;if($_POST)$C=$J["name"];elseif(DB!="")$J["collation"]=db_collation(DB,$ob);elseif($y=="sql"){foreach(get_vals("SHOW GRANTS")as$jd){if(preg_match('~ ON (`(([^\\\\`]|``|\\\\.)*)%`\.\*)?~',$jd,$B)&&$B[1]){$C=stripcslashes(idf_unescape("`$B[2]`"));break;}}}echo'
<form action="" method="post">
<p>
',($_POST["add_x"]||strpos($C,"\n")?'<textarea id="name" name="name" rows="10" cols="40">'.h($C).'</textarea><br>':'<input name="name" id="name" value="'.h($C).'" data-maxlength="64" autocapitalize="off">')."\n".($ob?html_select("collation",array(""=>"(".'collation'.")")+$ob,$J["collation"]).doc_link(array('sql'=>"charset-charsets.html",'mariadb'=>"supported-character-sets-and-collations/",'mssql'=>"ms187963.aspx",)):""),script("focus(qs('#name'));"),'<input type="submit" value="Save">
';if(DB!="")echo"<input type='submit' name='drop' value='".'Drop'."'>".confirm(sprintf('Drop %s?',DB))."\n";elseif(!$_POST["add_x"]&&$_GET["db"]=="")echo"<input type='image' class='icon' name='add' src='".h(preg_replace("~\\?.*~","",ME)."?file=plus.gif&version=4.7.1")."' alt='+' title='".'Add next'."'>\n";echo'<input type="hidden" name="token" value="',$mi,'">
</form>
';}elseif(isset($_GET["scheme"])){$J=$_POST;if($_POST&&!$o){$A=preg_replace('~ns=[^&]*&~','',ME)."ns=";if($_POST["drop"])query_redirect("DROP SCHEMA ".idf_escape($_GET["ns"]),$A,'Schema has been dropped.');else{$C=trim($J["name"]);$A.=urlencode($C);if($_GET["ns"]=="")query_redirect("CREATE SCHEMA ".idf_escape($C),$A,'Schema has been created.');elseif($_GET["ns"]!=$C)query_redirect("ALTER SCHEMA ".idf_escape($_GET["ns"])." RENAME TO ".idf_escape($C),$A,'Schema has been altered.');else
redirect($A);}}page_header($_GET["ns"]!=""?'Alter schema':'Create schema',$o);if(!$J)$J["name"]=$_GET["ns"];echo'
<form action="" method="post">
<p><input name="name" id="name" value="',h($J["name"]),'" autocapitalize="off">
',script("focus(qs('#name'));"),'<input type="submit" value="Save">
';if($_GET["ns"]!="")echo"<input type='submit' name='drop' value='".'Drop'."'>".confirm(sprintf('Drop %s?',$_GET["ns"]))."\n";echo'<input type="hidden" name="token" value="',$mi,'">
</form>
';}elseif(isset($_GET["call"])){$da=($_GET["name"]?$_GET["name"]:$_GET["call"]);page_header('Call'.": ".h($da),$o);$Rg=routine($_GET["call"],(isset($_GET["callf"])?"FUNCTION":"PROCEDURE"));$Fd=array();$Gf=array();foreach($Rg["fields"]as$t=>$p){if(substr($p["inout"],-3)=="OUT")$Gf[$t]="@".idf_escape($p["field"])." AS ".idf_escape($p["field"]);if(!$p["inout"]||substr($p["inout"],0,2)=="IN")$Fd[]=$t;}if(!$o&&$_POST){$Za=array();foreach($Rg["fields"]as$z=>$p){if(in_array($z,$Fd)){$X=process_input($p);if($X===false)$X="''";if(isset($Gf[$z]))$g->query("SET @".idf_escape($p["field"])." = $X");}$Za[]=(isset($Gf[$z])?"@".idf_escape($p["field"]):$X);}$G=(isset($_GET["callf"])?"SELECT":"CALL")." ".table($da)."(".implode(", ",$Za).")";$Ah=microtime(true);$H=$g->multi_query($G);$za=$g->affected_rows;echo$b->selectQuery($G,$Ah,!$H);if(!$H)echo"<p class='error'>".error()."\n";else{$h=connect();if(is_object($h))$h->select_db(DB);do{$H=$g->store_result();if(is_object($H))select($H,$h);else
echo"<p class='message'>".lang(array('Routine has been called, %d row affected.','Routine has been called, %d rows affected.'),$za)."\n";}while($g->next_result());if($Gf)select($g->query("SELECT ".implode(", ",$Gf)));}}echo'
<form action="" method="post">
';if($Fd){echo"<table cellspacing='0' class='layout'>\n";foreach($Fd
as$z){$p=$Rg["fields"][$z];$C=$p["field"];echo"<tr><th>".$b->fieldName($p);$Y=$_POST["fields"][$C];if($Y!=""){if($p["type"]=="enum")$Y=+$Y;if($p["type"]=="set")$Y=array_sum($Y);}input($p,$Y,(string)$_POST["function"][$C]);echo"\n";}echo"</table>\n";}echo'<p>
<input type="submit" value="Call">
<input type="hidden" name="token" value="',$mi,'">
</form>
';}elseif(isset($_GET["foreign"])){$a=$_GET["foreign"];$C=$_GET["name"];$J=$_POST;if($_POST&&!$o&&!$_POST["add"]&&!$_POST["change"]&&!$_POST["change-js"]){$Je=($_POST["drop"]?'Foreign key has been dropped.':($C!=""?'Foreign key has been altered.':'Foreign key has been created.'));$ve=ME."table=".urlencode($a);if(!$_POST["drop"]){$J["source"]=array_filter($J["source"],'strlen');ksort($J["source"]);$Vh=array();foreach($J["source"]as$z=>$X)$Vh[$z]=$J["target"][$z];$J["target"]=$Vh;}if($y=="sqlite")queries_redirect($ve,$Je,recreate_table($a,$a,array(),array(),array(" $C"=>($_POST["drop"]?"":" ".format_foreign_key($J)))));else{$c="ALTER TABLE ".table($a);$dc="\nDROP ".($y=="sql"?"FOREIGN KEY ":"CONSTRAINT ").idf_escape($C);if($_POST["drop"])query_redirect($c.$dc,$ve,$Je);else{query_redirect($c.($C!=""?"$dc,":"")."\nADD".format_foreign_key($J),$ve,$Je);$o='Source and target columns must have the same data type, there must be an index on the target columns and referenced data must exist.'."<br>$o";}}}page_header('Foreign key',$o,array("table"=>$a),h($a));if($_POST){ksort($J["source"]);if($_POST["add"])$J["source"][]="";elseif($_POST["change"]||$_POST["change-js"])$J["target"]=array();}elseif($C!=""){$cd=foreign_keys($a);$J=$cd[$C];$J["source"][]="";}else{$J["table"]=$a;$J["source"]=array("");}$th=array_keys(fields($a));$Vh=($a===$J["table"]?$th:array_keys(fields($J["table"])));$Ag=array_keys(array_filter(table_status('',true),'fk_support'));echo'
<form action="" method="post">
<p>
';if($J["db"]==""&&$J["ns"]==""){echo'Target table:
',html_select("table",$Ag,$J["table"],"this.form['change-js'].value = '1'; this.form.submit();"),'<input type="hidden" name="change-js" value="">
<noscript><p><input type="submit" name="change" value="Change"></noscript>
<table cellspacing="0">
<thead><tr><th id="label-source">Source<th id="label-target">Target</thead>
';$ae=0;foreach($J["source"]as$z=>$X){echo"<tr>","<td>".html_select("source[".(+$z)."]",array(-1=>"")+$th,$X,($ae==count($J["source"])-1?"foreignAddRow.call(this);":1),"label-source"),"<td>".html_select("target[".(+$z)."]",$Vh,$J["target"][$z],1,"label-target");$ae++;}echo'</table>
<p>
ON DELETE: ',html_select("on_delete",array(-1=>"")+explode("|",$nf),$J["on_delete"]),' ON UPDATE: ',html_select("on_update",array(-1=>"")+explode("|",$nf),$J["on_update"]),doc_link(array('sql'=>"innodb-foreign-key-constraints.html",'mariadb'=>"foreign-keys/",'pgsql'=>"sql-createtable.html#SQL-CREATETABLE-REFERENCES",'mssql'=>"ms174979.aspx",'oracle'=>"clauses002.htm#sthref2903",)),'<p>
<input type="submit" value="Save">
<noscript><p><input type="submit" name="add" value="Add column"></noscript>
';}if($C!=""){echo'<input type="submit" name="drop" value="Drop">',confirm(sprintf('Drop %s?',$C));}echo'<input type="hidden" name="token" value="',$mi,'">
</form>
';}elseif(isset($_GET["view"])){$a=$_GET["view"];$J=$_POST;$Df="VIEW";if($y=="pgsql"&&$a!=""){$Ch=table_status($a);$Df=strtoupper($Ch["Engine"]);}if($_POST&&!$o){$C=trim($J["name"]);$Ga=" AS\n$J[select]";$ve=ME."table=".urlencode($C);$Je='View has been altered.';$T=($_POST["materialized"]?"MATERIALIZED VIEW":"VIEW");if(!$_POST["drop"]&&$a==$C&&$y!="sqlite"&&$T=="VIEW"&&$Df=="VIEW")query_redirect(($y=="mssql"?"ALTER":"CREATE OR REPLACE")." VIEW ".table($C).$Ga,$ve,$Je);else{$Xh=$C."_adminer_".uniqid();drop_create("DROP $Df ".table($a),"CREATE $T ".table($C).$Ga,"DROP $T ".table($C),"CREATE $T ".table($Xh).$Ga,"DROP $T ".table($Xh),($_POST["drop"]?substr(ME,0,-1):$ve),'View has been dropped.',$Je,'View has been created.',$a,$C);}}if(!$_POST&&$a!=""){$J=view($a);$J["name"]=$a;$J["materialized"]=($Df!="VIEW");if(!$o)$o=error();}page_header(($a!=""?'Alter view':'Create view'),$o,array("table"=>$a),h($a));echo'
<form action="" method="post">
<p>Name: <input name="name" value="',h($J["name"]),'" data-maxlength="64" autocapitalize="off">
',(support("materializedview")?" ".checkbox("materialized",1,$J["materialized"],'Materialized view'):""),'<p>';textarea("select",$J["select"]);echo'<p>
<input type="submit" value="Save">
';if($a!=""){echo'<input type="submit" name="drop" value="Drop">',confirm(sprintf('Drop %s?',$a));}echo'<input type="hidden" name="token" value="',$mi,'">
</form>
';}elseif(isset($_GET["event"])){$aa=$_GET["event"];$Sd=array("YEAR","QUARTER","MONTH","DAY","HOUR","MINUTE","WEEK","SECOND","YEAR_MONTH","DAY_HOUR","DAY_MINUTE","DAY_SECOND","HOUR_MINUTE","HOUR_SECOND","MINUTE_SECOND");$Dh=array("ENABLED"=>"ENABLE","DISABLED"=>"DISABLE","SLAVESIDE_DISABLED"=>"DISABLE ON SLAVE");$J=$_POST;if($_POST&&!$o){if($_POST["drop"])query_redirect("DROP EVENT ".idf_escape($aa),substr(ME,0,-1),'Event has been dropped.');elseif(in_array($J["INTERVAL_FIELD"],$Sd)&&isset($Dh[$J["STATUS"]])){$Wg="\nON SCHEDULE ".($J["INTERVAL_VALUE"]?"EVERY ".q($J["INTERVAL_VALUE"])." $J[INTERVAL_FIELD]".($J["STARTS"]?" STARTS ".q($J["STARTS"]):"").($J["ENDS"]?" ENDS ".q($J["ENDS"]):""):"AT ".q($J["STARTS"]))." ON COMPLETION".($J["ON_COMPLETION"]?"":" NOT")." PRESERVE";queries_redirect(substr(ME,0,-1),($aa!=""?'Event has been altered.':'Event has been created.'),queries(($aa!=""?"ALTER EVENT ".idf_escape($aa).$Wg.($aa!=$J["EVENT_NAME"]?"\nRENAME TO ".idf_escape($J["EVENT_NAME"]):""):"CREATE EVENT ".idf_escape($J["EVENT_NAME"]).$Wg)."\n".$Dh[$J["STATUS"]]." COMMENT ".q($J["EVENT_COMMENT"]).rtrim(" DO\n$J[EVENT_DEFINITION]",";").";"));}}page_header(($aa!=""?'Alter event'.": ".h($aa):'Create event'),$o);if(!$J&&$aa!=""){$K=get_rows("SELECT * FROM information_schema.EVENTS WHERE EVENT_SCHEMA = ".q(DB)." AND EVENT_NAME = ".q($aa));$J=reset($K);}echo'
<form action="" method="post">
<table cellspacing="0" class="layout">
<tr><th>Name<td><input name="EVENT_NAME" value="',h($J["EVENT_NAME"]),'" data-maxlength="64" autocapitalize="off">
<tr><th title="datetime">Start<td><input name="STARTS" value="',h("$J[EXECUTE_AT]$J[STARTS]"),'">
<tr><th title="datetime">End<td><input name="ENDS" value="',h($J["ENDS"]),'">
<tr><th>Every<td><input type="number" name="INTERVAL_VALUE" value="',h($J["INTERVAL_VALUE"]),'" class="size"> ',html_select("INTERVAL_FIELD",$Sd,$J["INTERVAL_FIELD"]),'<tr><th>Status<td>',html_select("STATUS",$Dh,$J["STATUS"]),'<tr><th>Comment<td><input name="EVENT_COMMENT" value="',h($J["EVENT_COMMENT"]),'" data-maxlength="64">
<tr><th><td>',checkbox("ON_COMPLETION","PRESERVE",$J["ON_COMPLETION"]=="PRESERVE",'On completion preserve'),'</table>
<p>';textarea("EVENT_DEFINITION",$J["EVENT_DEFINITION"]);echo'<p>
<input type="submit" value="Save">
';if($aa!=""){echo'<input type="submit" name="drop" value="Drop">',confirm(sprintf('Drop %s?',$aa));}echo'<input type="hidden" name="token" value="',$mi,'">
</form>
';}elseif(isset($_GET["procedure"])){$da=($_GET["name"]?$_GET["name"]:$_GET["procedure"]);$Rg=(isset($_GET["function"])?"FUNCTION":"PROCEDURE");$J=$_POST;$J["fields"]=(array)$J["fields"];if($_POST&&!process_fields($J["fields"])&&!$o){$Af=routine($_GET["procedure"],$Rg);$Xh="$J[name]_adminer_".uniqid();drop_create("DROP $Rg ".routine_id($da,$Af),create_routine($Rg,$J),"DROP $Rg ".routine_id($J["name"],$J),create_routine($Rg,array("name"=>$Xh)+$J),"DROP $Rg ".routine_id($Xh,$J),substr(ME,0,-1),'Routine has been dropped.','Routine has been altered.','Routine has been created.',$da,$J["name"]);}page_header(($da!=""?(isset($_GET["function"])?'Alter function':'Alter procedure').": ".h($da):(isset($_GET["function"])?'Create function':'Create procedure')),$o);if(!$_POST&&$da!=""){$J=routine($_GET["procedure"],$Rg);$J["name"]=$da;}$ob=get_vals("SHOW CHARACTER SET");sort($ob);$Sg=routine_languages();echo'
<form action="" method="post" id="form">
<p>Name: <input name="name" value="',h($J["name"]),'" data-maxlength="64" autocapitalize="off">
',($Sg?'Language'.": ".html_select("language",$Sg,$J["language"])."\n":""),'<input type="submit" value="Save">
<div class="scrollable">
<table cellspacing="0" class="nowrap">
';edit_fields($J["fields"],$ob,$Rg);if(isset($_GET["function"])){echo"<tr><td>".'Return type';edit_type("returns",$J["returns"],$ob,array(),($y=="pgsql"?array("void","trigger"):array()));}echo'</table>
</div>
<p>';textarea("definition",$J["definition"]);echo'<p>
<input type="submit" value="Save">
';if($da!=""){echo'<input type="submit" name="drop" value="Drop">',confirm(sprintf('Drop %s?',$da));}echo'<input type="hidden" name="token" value="',$mi,'">
</form>
';}elseif(isset($_GET["sequence"])){$fa=$_GET["sequence"];$J=$_POST;if($_POST&&!$o){$A=substr(ME,0,-1);$C=trim($J["name"]);if($_POST["drop"])query_redirect("DROP SEQUENCE ".idf_escape($fa),$A,'Sequence has been dropped.');elseif($fa=="")query_redirect("CREATE SEQUENCE ".idf_escape($C),$A,'Sequence has been created.');elseif($fa!=$C)query_redirect("ALTER SEQUENCE ".idf_escape($fa)." RENAME TO ".idf_escape($C),$A,'Sequence has been altered.');else
redirect($A);}page_header($fa!=""?'Alter sequence'.": ".h($fa):'Create sequence',$o);if(!$J)$J["name"]=$fa;echo'
<form action="" method="post">
<p><input name="name" value="',h($J["name"]),'" autocapitalize="off">
<input type="submit" value="Save">
';if($fa!="")echo"<input type='submit' name='drop' value='".'Drop'."'>".confirm(sprintf('Drop %s?',$fa))."\n";echo'<input type="hidden" name="token" value="',$mi,'">
</form>
';}elseif(isset($_GET["type"])){$ga=$_GET["type"];$J=$_POST;if($_POST&&!$o){$A=substr(ME,0,-1);if($_POST["drop"])query_redirect("DROP TYPE ".idf_escape($ga),$A,'Type has been dropped.');else
query_redirect("CREATE TYPE ".idf_escape(trim($J["name"]))." $J[as]",$A,'Type has been created.');}page_header($ga!=""?'Alter type'.": ".h($ga):'Create type',$o);if(!$J)$J["as"]="AS ";echo'
<form action="" method="post">
<p>
';if($ga!="")echo"<input type='submit' name='drop' value='".'Drop'."'>".confirm(sprintf('Drop %s?',$ga))."\n";else{echo"<input name='name' value='".h($J['name'])."' autocapitalize='off'>\n";textarea("as",$J["as"]);echo"<p><input type='submit' value='".'Save'."'>\n";}echo'<input type="hidden" name="token" value="',$mi,'">
</form>
';}elseif(isset($_GET["trigger"])){$a=$_GET["trigger"];$C=$_GET["name"];$xi=trigger_options();$J=(array)trigger($C)+array("Trigger"=>$a."_bi");if($_POST){if(!$o&&in_array($_POST["Timing"],$xi["Timing"])&&in_array($_POST["Event"],$xi["Event"])&&in_array($_POST["Type"],$xi["Type"])){$mf=" ON ".table($a);$dc="DROP TRIGGER ".idf_escape($C).($y=="pgsql"?$mf:"");$ve=ME."table=".urlencode($a);if($_POST["drop"])query_redirect($dc,$ve,'Trigger has been dropped.');else{if($C!="")queries($dc);queries_redirect($ve,($C!=""?'Trigger has been altered.':'Trigger has been created.'),queries(create_trigger($mf,$_POST)));if($C!="")queries(create_trigger($mf,$J+array("Type"=>reset($xi["Type"]))));}}$J=$_POST;}page_header(($C!=""?'Alter trigger'.": ".h($C):'Create trigger'),$o,array("table"=>$a));echo'
<form action="" method="post" id="form">
<table cellspacing="0" class="layout">
<tr><th>Time<td>',html_select("Timing",$xi["Timing"],$J["Timing"],"triggerChange(/^".preg_quote($a,"/")."_[ba][iud]$/, '".js_escape($a)."', this.form);"),'<tr><th>Event<td>',html_select("Event",$xi["Event"],$J["Event"],"this.form['Timing'].onchange();"),(in_array("UPDATE OF",$xi["Event"])?" <input name='Of' value='".h($J["Of"])."' class='hidden'>":""),'<tr><th>Type<td>',html_select("Type",$xi["Type"],$J["Type"]),'</table>
<p>Name: <input name="Trigger" value="',h($J["Trigger"]),'" data-maxlength="64" autocapitalize="off">
',script("qs('#form')['Timing'].onchange();"),'<p>';textarea("Statement",$J["Statement"]);echo'<p>
<input type="submit" value="Save">
';if($C!=""){echo'<input type="submit" name="drop" value="Drop">',confirm(sprintf('Drop %s?',$C));}echo'<input type="hidden" name="token" value="',$mi,'">
</form>
';}elseif(isset($_GET["user"])){$ha=$_GET["user"];$mg=array(""=>array("All privileges"=>""));foreach(get_rows("SHOW PRIVILEGES")as$J){foreach(explode(",",($J["Privilege"]=="Grant option"?"":$J["Context"]))as$_b)$mg[$_b][$J["Privilege"]]=$J["Comment"];}$mg["Server Admin"]+=$mg["File access on server"];$mg["Databases"]["Create routine"]=$mg["Procedures"]["Create routine"];unset($mg["Procedures"]["Create routine"]);$mg["Columns"]=array();foreach(array("Select","Insert","Update","References")as$X)$mg["Columns"][$X]=$mg["Tables"][$X];unset($mg["Server Admin"]["Usage"]);foreach($mg["Tables"]as$z=>$X)unset($mg["Databases"][$z]);$We=array();if($_POST){foreach($_POST["objects"]as$z=>$X)$We[$X]=(array)$We[$X]+(array)$_POST["grants"][$z];}$kd=array();$kf="";if(isset($_GET["host"])&&($H=$g->query("SHOW GRANTS FOR ".q($ha)."@".q($_GET["host"])))){while($J=$H->fetch_row()){if(preg_match('~GRANT (.*) ON (.*) TO ~',$J[0],$B)&&preg_match_all('~ *([^(,]*[^ ,(])( *\([^)]+\))?~',$B[1],$Be,PREG_SET_ORDER)){foreach($Be
as$X){if($X[1]!="USAGE")$kd["$B[2]$X[2]"][$X[1]]=true;if(preg_match('~ WITH GRANT OPTION~',$J[0]))$kd["$B[2]$X[2]"]["GRANT OPTION"]=true;}}if(preg_match("~ IDENTIFIED BY PASSWORD '([^']+)~",$J[0],$B))$kf=$B[1];}}if($_POST&&!$o){$lf=(isset($_GET["host"])?q($ha)."@".q($_GET["host"]):"''");if($_POST["drop"])query_redirect("DROP USER $lf",ME."privileges=",'User has been dropped.');else{$Ye=q($_POST["user"])."@".q($_POST["host"]);$Uf=$_POST["pass"];if($Uf!=''&&!$_POST["hashed"]){$Uf=$g->result("SELECT PASSWORD(".q($Uf).")");$o=!$Uf;}$Eb=false;if(!$o){if($lf!=$Ye){$Eb=queries((min_version(5)?"CREATE USER":"GRANT USAGE ON *.* TO")." $Ye IDENTIFIED BY PASSWORD ".q($Uf));$o=!$Eb;}elseif($Uf!=$kf)queries("SET PASSWORD FOR $Ye = ".q($Uf));}if(!$o){$Og=array();foreach($We
as$ff=>$jd){if(isset($_GET["grant"]))$jd=array_filter($jd);$jd=array_keys($jd);if(isset($_GET["grant"]))$Og=array_diff(array_keys(array_filter($We[$ff],'strlen')),$jd);elseif($lf==$Ye){$if=array_keys((array)$kd[$ff]);$Og=array_diff($if,$jd);$jd=array_diff($jd,$if);unset($kd[$ff]);}if(preg_match('~^(.+)\s*(\(.*\))?$~U',$ff,$B)&&(!grant("REVOKE",$Og,$B[2]," ON $B[1] FROM $Ye")||!grant("GRANT",$jd,$B[2]," ON $B[1] TO $Ye"))){$o=true;break;}}}if(!$o&&isset($_GET["host"])){if($lf!=$Ye)queries("DROP USER $lf");elseif(!isset($_GET["grant"])){foreach($kd
as$ff=>$Og){if(preg_match('~^(.+)(\(.*\))?$~U',$ff,$B))grant("REVOKE",array_keys($Og),$B[2]," ON $B[1] FROM $Ye");}}}queries_redirect(ME."privileges=",(isset($_GET["host"])?'User has been altered.':'User has been created.'),!$o);if($Eb)$g->query("DROP USER $Ye");}}page_header((isset($_GET["host"])?'Username'.": ".h("$ha@$_GET[host]"):'Create user'),$o,array("privileges"=>array('','Privileges')));if($_POST){$J=$_POST;$kd=$We;}else{$J=$_GET+array("host"=>$g->result("SELECT SUBSTRING_INDEX(CURRENT_USER, '@', -1)"));$J["pass"]=$kf;if($kf!="")$J["hashed"]=true;$kd[(DB==""||$kd?"":idf_escape(addcslashes(DB,"%_\\"))).".*"]=array();}echo'<form action="" method="post">
<table cellspacing="0" class="layout">
<tr><th>Server<td><input name="host" data-maxlength="60" value="',h($J["host"]),'" autocapitalize="off">
<tr><th>Username<td><input name="user" data-maxlength="80" value="',h($J["user"]),'" autocapitalize="off">
<tr><th>Password<td><input name="pass" id="pass" value="',h($J["pass"]),'" autocomplete="new-password">
';if(!$J["hashed"])echo
script("typePassword(qs('#pass'));");echo
checkbox("hashed",1,$J["hashed"],'Hashed',"typePassword(this.form['pass'], this.checked);"),'</table>

';echo"<table cellspacing='0'>\n","<thead><tr><th colspan='2'>".'Privileges'.doc_link(array('sql'=>"grant.html#priv_level"));$t=0;foreach($kd
as$ff=>$jd){echo'<th>'.($ff!="*.*"?"<input name='objects[$t]' value='".h($ff)."' size='10' autocapitalize='off'>":"<input type='hidden' name='objects[$t]' value='*.*' size='10'>*.*");$t++;}echo"</thead>\n";foreach(array(""=>"","Server Admin"=>'Server',"Databases"=>'Database',"Tables"=>'Table',"Columns"=>'Column',"Procedures"=>'Routine',)as$_b=>$Ub){foreach((array)$mg[$_b]as$lg=>$tb){echo"<tr".odd()."><td".($Ub?">$Ub<td":" colspan='2'").' lang="en" title="'.h($tb).'">'.h($lg);$t=0;foreach($kd
as$ff=>$jd){$C="'grants[$t][".h(strtoupper($lg))."]'";$Y=$jd[strtoupper($lg)];if($_b=="Server Admin"&&$ff!=(isset($kd["*.*"])?"*.*":".*"))echo"<td>";elseif(isset($_GET["grant"]))echo"<td><select name=$C><option><option value='1'".($Y?" selected":"").">".'Grant'."<option value='0'".($Y=="0"?" selected":"").">".'Revoke'."</select>";else{echo"<td align='center'><label class='block'>","<input type='checkbox' name=$C value='1'".($Y?" checked":"").($lg=="All privileges"?" id='grants-$t-all'>":">".($lg=="Grant option"?"":script("qsl('input').onclick = function () { if (this.checked) formUncheck('grants-$t-all'); };"))),"</label>";}$t++;}}}echo"</table>\n",'<p>
<input type="submit" value="Save">
';if(isset($_GET["host"])){echo'<input type="submit" name="drop" value="Drop">',confirm(sprintf('Drop %s?',"$ha@$_GET[host]"));}echo'<input type="hidden" name="token" value="',$mi,'">
</form>
';}elseif(isset($_GET["processlist"])){if(support("kill")&&$_POST&&!$o){$he=0;foreach((array)$_POST["kill"]as$X){if(kill_process($X))$he++;}queries_redirect(ME."processlist=",lang(array('%d process has been killed.','%d processes have been killed.'),$he),$he||!$_POST["kill"]);}page_header('Process list',$o);echo'
<form action="" method="post">
<div class="scrollable">
<table cellspacing="0" class="nowrap checkable">
',script("mixin(qsl('table'), {onclick: tableClick, ondblclick: partialArg(tableClick, true)});");$t=-1;foreach(process_list()as$t=>$J){if(!$t){echo"<thead><tr lang='en'>".(support("kill")?"<th>":"");foreach($J
as$z=>$X)echo"<th>$z".doc_link(array('sql'=>"show-processlist.html#processlist_".strtolower($z),'pgsql'=>"monitoring-stats.html#PG-STAT-ACTIVITY-VIEW",'oracle'=>"../b14237/dynviews_2088.htm",));echo"</thead>\n";}echo"<tr".odd().">".(support("kill")?"<td>".checkbox("kill[]",$J[$y=="sql"?"Id":"pid"],0):"");foreach($J
as$z=>$X)echo"<td>".(($y=="sql"&&$z=="Info"&&preg_match("~Query|Killed~",$J["Command"])&&$X!="")||($y=="pgsql"&&$z=="current_query"&&$X!="<IDLE>")||($y=="oracle"&&$z=="sql_text"&&$X!="")?"<code class='jush-$y'>".shorten_utf8($X,100,"</code>").' <a href="'.h(ME.($J["db"]!=""?"db=".urlencode($J["db"])."&":"")."sql=".urlencode($X)).'">'.'Clone'.'</a>':h($X));echo"\n";}echo'</table>
</div>
<p>
';if(support("kill")){echo($t+1)."/".sprintf('%d in total',max_connections()),"<p><input type='submit' value='".'Kill'."'>\n";}echo'<input type="hidden" name="token" value="',$mi,'">
</form>
',script("tableCheck();");}elseif(isset($_GET["select"])){$a=$_GET["select"];$R=table_status1($a);$x=indexes($a);$q=fields($a);$cd=column_foreign_keys($a);$hf=$R["Oid"];parse_str($_COOKIE["adminer_import"],$ya);$Pg=array();$f=array();$bi=null;foreach($q
as$z=>$p){$C=$b->fieldName($p);if(isset($p["privileges"]["select"])&&$C!=""){$f[$z]=html_entity_decode(strip_tags($C),ENT_QUOTES);if(is_shortable($p))$bi=$b->selectLengthProcess();}$Pg+=$p["privileges"];}list($L,$ld)=$b->selectColumnsProcess($f,$x);$Wd=count($ld)<count($L);$Z=$b->selectSearchProcess($q,$x);$xf=$b->selectOrderProcess($q,$x);$_=$b->selectLimitProcess();if($_GET["val"]&&is_ajax()){header("Content-Type: text/plain; charset=utf-8");foreach($_GET["val"]as$Di=>$J){$Ga=convert_field($q[key($J)]);$L=array($Ga?$Ga:idf_escape(key($J)));$Z[]=where_check($Di,$q);$I=$n->select($a,$L,$Z,$L);if($I)echo
reset($I->fetch_row());}exit;}$hg=$Fi=null;foreach($x
as$w){if($w["type"]=="PRIMARY"){$hg=array_flip($w["columns"]);$Fi=($L?$hg:array());foreach($Fi
as$z=>$X){if(in_array(idf_escape($z),$L))unset($Fi[$z]);}break;}}if($hf&&!$hg){$hg=$Fi=array($hf=>0);$x[]=array("type"=>"PRIMARY","columns"=>array($hf));}if($_POST&&!$o){$gj=$Z;if(!$_POST["all"]&&is_array($_POST["check"])){$fb=array();foreach($_POST["check"]as$cb)$fb[]=where_check($cb,$q);$gj[]="((".implode(") OR (",$fb)."))";}$gj=($gj?"\nWHERE ".implode(" AND ",$gj):"");if($_POST["export"]){cookie("adminer_import","output=".urlencode($_POST["output"])."&format=".urlencode($_POST["format"]));dump_headers($a);$b->dumpTable($a,"");$hd=($L?implode(", ",$L):"*").convert_fields($f,$q,$L)."\nFROM ".table($a);$nd=($ld&&$Wd?"\nGROUP BY ".implode(", ",$ld):"").($xf?"\nORDER BY ".implode(", ",$xf):"");if(!is_array($_POST["check"])||$hg)$G="SELECT $hd$gj$nd";else{$Bi=array();foreach($_POST["check"]as$X)$Bi[]="(SELECT".limit($hd,"\nWHERE ".($Z?implode(" AND ",$Z)." AND ":"").where_check($X,$q).$nd,1).")";$G=implode(" UNION ALL ",$Bi);}$b->dumpData($a,"table",$G);exit;}if(!$b->selectEmailProcess($Z,$cd)){if($_POST["save"]||$_POST["delete"]){$H=true;$za=0;$O=array();if(!$_POST["delete"]){foreach($f
as$C=>$X){$X=process_input($q[$C]);if($X!==null&&($_POST["clone"]||$X!==false))$O[idf_escape($C)]=($X!==false?$X:idf_escape($C));}}if($_POST["delete"]||$O){if($_POST["clone"])$G="INTO ".table($a)." (".implode(", ",array_keys($O)).")\nSELECT ".implode(", ",$O)."\nFROM ".table($a);if($_POST["all"]||($hg&&is_array($_POST["check"]))||$Wd){$H=($_POST["delete"]?$n->delete($a,$gj):($_POST["clone"]?queries("INSERT $G$gj"):$n->update($a,$O,$gj)));$za=$g->affected_rows;}else{foreach((array)$_POST["check"]as$X){$cj="\nWHERE ".($Z?implode(" AND ",$Z)." AND ":"").where_check($X,$q);$H=($_POST["delete"]?$n->delete($a,$cj,1):($_POST["clone"]?queries("INSERT".limit1($a,$G,$cj)):$n->update($a,$O,$cj,1)));if(!$H)break;$za+=$g->affected_rows;}}}$Je=lang(array('%d item has been affected.','%d items have been affected.'),$za);if($_POST["clone"]&&$H&&$za==1){$me=last_id();if($me)$Je=sprintf('Item%s has been inserted.'," $me");}queries_redirect(remove_from_uri($_POST["all"]&&$_POST["delete"]?"page":""),$Je,$H);if(!$_POST["delete"]){edit_form($a,$q,(array)$_POST["fields"],!$_POST["clone"]);page_footer();exit;}}elseif(!$_POST["import"]){if(!$_POST["val"])$o='Ctrl+click on a value to modify it.';else{$H=true;$za=0;foreach($_POST["val"]as$Di=>$J){$O=array();foreach($J
as$z=>$X){$z=bracket_escape($z,1);$O[idf_escape($z)]=(preg_match('~char|text~',$q[$z]["type"])||$X!=""?$b->processInput($q[$z],$X):"NULL");}$H=$n->update($a,$O," WHERE ".($Z?implode(" AND ",$Z)." AND ":"").where_check($Di,$q),!$Wd&&!$hg," ");if(!$H)break;$za+=$g->affected_rows;}queries_redirect(remove_from_uri(),lang(array('%d item has been affected.','%d items have been affected.'),$za),$H);}}elseif(!is_string($Rc=get_file("csv_file",true)))$o=upload_error($Rc);elseif(!preg_match('~~u',$Rc))$o='File must be in UTF-8 encoding.';else{cookie("adminer_import","output=".urlencode($ya["output"])."&format=".urlencode($_POST["separator"]));$H=true;$qb=array_keys($q);preg_match_all('~(?>"[^"]*"|[^"\r\n]+)+~',$Rc,$Be);$za=count($Be[0]);$n->begin();$M=($_POST["separator"]=="csv"?",":($_POST["separator"]=="tsv"?"\t":";"));$K=array();foreach($Be[0]as$z=>$X){preg_match_all("~((?>\"[^\"]*\")+|[^$M]*)$M~",$X.$M,$Ce);if(!$z&&!array_diff($Ce[1],$qb)){$qb=$Ce[1];$za--;}else{$O=array();foreach($Ce[1]as$t=>$mb)$O[idf_escape($qb[$t])]=($mb==""&&$q[$qb[$t]]["null"]?"NULL":q(str_replace('""','"',preg_replace('~^"|"$~','',$mb))));$K[]=$O;}}$H=(!$K||$n->insertUpdate($a,$K,$hg));if($H)$H=$n->commit();queries_redirect(remove_from_uri("page"),lang(array('%d row has been imported.','%d rows have been imported.'),$za),$H);$n->rollback();}}}$Nh=$b->tableName($R);if(is_ajax()){page_headers();ob_start();}else
page_header('Select'.": $Nh",$o);$O=null;if(isset($Pg["insert"])||!support("table")){$O="";foreach((array)$_GET["where"]as$X){if($cd[$X["col"]]&&count($cd[$X["col"]])==1&&($X["op"]=="="||(!$X["op"]&&!preg_match('~[_%]~',$X["val"]))))$O.="&set".urlencode("[".bracket_escape($X["col"])."]")."=".urlencode($X["val"]);}}$b->selectLinks($R,$O);if(!$f&&support("table"))echo"<p class='error'>".'Unable to select the table'.($q?".":": ".error())."\n";else{echo"<form action='' id='form'>\n","<div style='display: none;'>";hidden_fields_get();echo(DB!=""?'<input type="hidden" name="db" value="'.h(DB).'">'.(isset($_GET["ns"])?'<input type="hidden" name="ns" value="'.h($_GET["ns"]).'">':""):"");echo'<input type="hidden" name="select" value="'.h($a).'">',"</div>\n";$b->selectColumnsPrint($L,$f);$b->selectSearchPrint($Z,$f,$x);$b->selectOrderPrint($xf,$f,$x);$b->selectLimitPrint($_);$b->selectLengthPrint($bi);$b->selectActionPrint($x);echo"</form>\n";$E=$_GET["page"];if($E=="last"){$fd=$g->result(count_rows($a,$Z,$Wd,$ld));$E=floor(max(0,$fd-1)/$_);}$bh=$L;$md=$ld;if(!$bh){$bh[]="*";$Ab=convert_fields($f,$q,$L);if($Ab)$bh[]=substr($Ab,2);}foreach($L
as$z=>$X){$p=$q[idf_unescape($X)];if($p&&($Ga=convert_field($p)))$bh[$z]="$Ga AS $X";}if(!$Wd&&$Fi){foreach($Fi
as$z=>$X){$bh[]=idf_escape($z);if($md)$md[]=idf_escape($z);}}$H=$n->select($a,$bh,$Z,$md,$xf,$_,$E,true);if(!$H)echo"<p class='error'>".error()."\n";else{if($y=="mssql"&&$E)$H->seek($_*$E);$qc=array();echo"<form action='' method='post' enctype='multipart/form-data'>\n";$K=array();while($J=$H->fetch_assoc()){if($E&&$y=="oracle")unset($J["RNUM"]);$K[]=$J;}if($_GET["page"]!="last"&&$_!=""&&$ld&&$Wd&&$y=="sql")$fd=$g->result(" SELECT FOUND_ROWS()");if(!$K)echo"<p class='message'>".'No rows.'."\n";else{$Pa=$b->backwardKeys($a,$Nh);echo"<div class='scrollable'>","<table id='table' cellspacing='0' class='nowrap checkable'>",script("mixin(qs('#table'), {onclick: tableClick, ondblclick: partialArg(tableClick, true), onkeydown: editingKeydown});"),"<thead><tr>".(!$ld&&$L?"":"<td><input type='checkbox' id='all-page' class='jsonly'>".script("qs('#all-page').onclick = partial(formCheck, /check/);","")." <a href='".h($_GET["modify"]?remove_from_uri("modify"):$_SERVER["REQUEST_URI"]."&modify=1")."'>".'Modify'."</a>");$Ve=array();$id=array();reset($L);$wg=1;foreach($K[0]as$z=>$X){if(!isset($Fi[$z])){$X=$_GET["columns"][key($L)];$p=$q[$L?($X?$X["col"]:current($L)):$z];$C=($p?$b->fieldName($p,$wg):($X["fun"]?"*":$z));if($C!=""){$wg++;$Ve[$z]=$C;$e=idf_escape($z);$_d=remove_from_uri('(order|desc)[^=]*|page').'&order%5B0%5D='.urlencode($z);$Ub="&desc%5B0%5D=1";echo"<th>".script("mixin(qsl('th'), {onmouseover: partial(columnMouse), onmouseout: partial(columnMouse, ' hidden')});",""),'<a href="'.h($_d.($xf[0]==$e||$xf[0]==$z||(!$xf&&$Wd&&$ld[0]==$e)?$Ub:'')).'">';echo
apply_sql_function($X["fun"],$C)."</a>";echo"<span class='column hidden'>","<a href='".h($_d.$Ub)."' title='".'descending'."' class='text'> â</a>";if(!$X["fun"]){echo'<a href="#fieldset-search" title="'.'Search'.'" class="text jsonly"> =</a>',script("qsl('a').onclick = partial(selectSearch, '".js_escape($z)."');");}echo"</span>";}$id[$z]=$X["fun"];next($L);}}$se=array();if($_GET["modify"]){foreach($K
as$J){foreach($J
as$z=>$X)$se[$z]=max($se[$z],min(40,strlen(utf8_decode($X))));}}echo($Pa?"<th>".'Relations':"")."</thead>\n";if(is_ajax()){if($_%2==1&&$E%2==1)odd();ob_end_clean();}foreach($b->rowDescriptions($K,$cd)as$Ue=>$J){$Ci=unique_array($K[$Ue],$x);if(!$Ci){$Ci=array();foreach($K[$Ue]as$z=>$X){if(!preg_match('~^(COUNT\((\*|(DISTINCT )?`(?:[^`]|``)+`)\)|(AVG|GROUP_CONCAT|MAX|MIN|SUM)\(`(?:[^`]|``)+`\))$~',$z))$Ci[$z]=$X;}}$Di="";foreach($Ci
as$z=>$X){if(($y=="sql"||$y=="pgsql")&&preg_match('~char|text|enum|set~',$q[$z]["type"])&&strlen($X)>64){$z=(strpos($z,'(')?$z:idf_escape($z));$z="MD5(".($y!='sql'||preg_match("~^utf8~",$q[$z]["collation"])?$z:"CONVERT($z USING ".charset($g).")").")";$X=md5($X);}$Di.="&".($X!==null?urlencode("where[".bracket_escape($z)."]")."=".urlencode($X):"null%5B%5D=".urlencode($z));}echo"<tr".odd().">".(!$ld&&$L?"":"<td>".checkbox("check[]",substr($Di,1),in_array(substr($Di,1),(array)$_POST["check"])).($Wd||information_schema(DB)?"":" <a href='".h(ME."edit=".urlencode($a).$Di)."' class='edit'>".'edit'."</a>"));foreach($J
as$z=>$X){if(isset($Ve[$z])){$p=$q[$z];$X=$n->value($X,$p);if($X!=""&&(!isset($qc[$z])||$qc[$z]!=""))$qc[$z]=(is_mail($X)?$Ve[$z]:"");$A="";if(preg_match('~blob|bytea|raw|file~',$p["type"])&&$X!="")$A=ME.'download='.urlencode($a).'&field='.urlencode($z).$Di;if(!$A&&$X!==null){foreach((array)$cd[$z]as$r){if(count($cd[$z])==1||end($r["source"])==$z){$A="";foreach($r["source"]as$t=>$th)$A.=where_link($t,$r["target"][$t],$K[$Ue][$th]);$A=($r["db"]!=""?preg_replace('~([?&]db=)[^&]+~','\1'.urlencode($r["db"]),ME):ME).'select='.urlencode($r["table"]).$A;if($r["ns"])$A=preg_replace('~([?&]ns=)[^&]+~','\1'.urlencode($r["ns"]),$A);if(count($r["source"])==1)break;}}}if($z=="COUNT(*)"){$A=ME."select=".urlencode($a);$t=0;foreach((array)$_GET["where"]as$W){if(!array_key_exists($W["col"],$Ci))$A.=where_link($t++,$W["col"],$W["val"],$W["op"]);}foreach($Ci
as$be=>$W)$A.=where_link($t++,$be,$W);}$X=select_value($X,$A,$p,$bi);$u=h("val[$Di][".bracket_escape($z)."]");$Y=$_POST["val"][$Di][bracket_escape($z)];$lc=!is_array($J[$z])&&is_utf8($X)&&$K[$Ue][$z]==$J[$z]&&!$id[$z];$ai=preg_match('~text|lob~',$p["type"]);if(($_GET["modify"]&&$lc)||$Y!==null){$qd=h($Y!==null?$Y:$J[$z]);echo"<td>".($ai?"<textarea name='$u' cols='30' rows='".(substr_count($J[$z],"\n")+1)."'>$qd</textarea>":"<input name='$u' value='$qd' size='$se[$z]'>");}else{$xe=strpos($X,"<i>â¦</i>");echo"<td id='$u' data-text='".($xe?2:($ai?1:0))."'".($lc?"":" data-warning='".h('Use edit link to modify this value.')."'").">$X</td>";}}}if($Pa)echo"<td>";$b->backwardKeysPrint($Pa,$K[$Ue]);echo"</tr>\n";}if(is_ajax())exit;echo"</table>\n","</div>\n";}if(!is_ajax()){if($K||$E){$_c=true;if($_GET["page"]!="last"){if($_==""||(count($K)<$_&&($K||!$E)))$fd=($E?$E*$_:0)+count($K);elseif($y!="sql"||!$Wd){$fd=($Wd?false:found_rows($R,$Z));if($fd<max(1e4,2*($E+1)*$_))$fd=reset(slow_query(count_rows($a,$Z,$Wd,$ld)));else$_c=false;}}$Jf=($_!=""&&($fd===false||$fd>$_||$E));if($Jf){echo(($fd===false?count($K)+1:$fd-$E*$_)>$_?'<p><a href="'.h(remove_from_uri("page")."&page=".($E+1)).'" class="loadmore">'.'Load more data'.'</a>'.script("qsl('a').onclick = partial(selectLoadMore, ".(+$_).", '".'Loading'."â¦');",""):''),"\n";}}echo"<div class='footer'><div>\n";if($K||$E){if($Jf){$Ee=($fd===false?$E+(count($K)>=$_?2:1):floor(($fd-1)/$_));echo"<fieldset>";if($y!="simpledb"){echo"<legend><a href='".h(remove_from_uri("page"))."'>".'Page'."</a></legend>",script("qsl('a').onclick = function () { pageClick(this.href, +prompt('".'Page'."', '".($E+1)."')); return false; };"),pagination(0,$E).($E>5?" â¦":"");for($t=max(1,$E-4);$t<min($Ee,$E+5);$t++)echo
pagination($t,$E);if($Ee>0){echo($E+5<$Ee?" â¦":""),($_c&&$fd!==false?pagination($Ee,$E):" <a href='".h(remove_from_uri("page")."&page=last")."' title='~$Ee'>".'last'."</a>");}}else{echo"<legend>".'Page'."</legend>",pagination(0,$E).($E>1?" â¦":""),($E?pagination($E,$E):""),($Ee>$E?pagination($E+1,$E).($Ee>$E+1?" â¦":""):"");}echo"</fieldset>\n";}echo"<fieldset>","<legend>".'Whole result'."</legend>";$Zb=($_c?"":"~ ").$fd;echo
checkbox("all",1,0,($fd!==false?($_c?"":"~ ").lang(array('%d row','%d rows'),$fd):""),"var checked = formChecked(this, /check/); selectCount('selected', this.checked ? '$Zb' : checked); selectCount('selected2', this.checked || !checked ? '$Zb' : checked);")."\n","</fieldset>\n";if($b->selectCommandPrint()){echo'<fieldset',($_GET["modify"]?'':' class="jsonly"'),'><legend>Modify</legend><div>
<input type="submit" value="Save"',($_GET["modify"]?'':' title="'.'Ctrl+click on a value to modify it.'.'"'),'>
</div></fieldset>
<fieldset><legend>Selected <span id="selected"></span></legend><div>
<input type="submit" name="edit" value="Edit">
<input type="submit" name="clone" value="Clone">
<input type="submit" name="delete" value="Delete">',confirm(),'</div></fieldset>
';}$dd=$b->dumpFormat();foreach((array)$_GET["columns"]as$e){if($e["fun"]){unset($dd['sql']);break;}}if($dd){print_fieldset("export",'Export'." <span id='selected2'></span>");$Hf=$b->dumpOutput();echo($Hf?html_select("output",$Hf,$ya["output"])." ":""),html_select("format",$dd,$ya["format"])," <input type='submit' name='export' value='".'Export'."'>\n","</div></fieldset>\n";}$b->selectEmailPrint(array_filter($qc,'strlen'),$f);}echo"</div></div>\n";if($b->selectImportPrint()){echo"<div>","<a href='#import'>".'Import'."</a>",script("qsl('a').onclick = partial(toggle, 'import');",""),"<span id='import' class='hidden'>: ","<input type='file' name='csv_file'> ",html_select("separator",array("csv"=>"CSV,","csv;"=>"CSV;","tsv"=>"TSV"),$ya["format"],1);echo" <input type='submit' name='import' value='".'Import'."'>","</span>","</div>";}echo"<input type='hidden' name='token' value='$mi'>\n","</form>\n",(!$ld&&$L?"":script("tableCheck();"));}}}if(is_ajax()){ob_end_clean();exit;}}elseif(isset($_GET["variables"])){$Ch=isset($_GET["status"]);page_header($Ch?'Status':'Variables');$Ti=($Ch?show_status():show_variables());if(!$Ti)echo"<p class='message'>".'No rows.'."\n";else{echo"<table cellspacing='0'>\n";foreach($Ti
as$z=>$X){echo"<tr>","<th><code class='jush-".$y.($Ch?"status":"set")."'>".h($z)."</code>","<td>".h($X);}echo"</table>\n";}}elseif(isset($_GET["script"])){header("Content-Type: text/javascript; charset=utf-8");if($_GET["script"]=="db"){$Kh=array("Data_length"=>0,"Index_length"=>0,"Data_free"=>0);foreach(table_status()as$C=>$R){json_row("Comment-$C",h($R["Comment"]));if(!is_view($R)){foreach(array("Engine","Collation")as$z)json_row("$z-$C",h($R[$z]));foreach($Kh+array("Auto_increment"=>0,"Rows"=>0)as$z=>$X){if($R[$z]!=""){$X=format_number($R[$z]);json_row("$z-$C",($z=="Rows"&&$X&&$R["Engine"]==($wh=="pgsql"?"table":"InnoDB")?"~ $X":$X));if(isset($Kh[$z]))$Kh[$z]+=($R["Engine"]!="InnoDB"||$z!="Data_free"?$R[$z]:0);}elseif(array_key_exists($z,$R))json_row("$z-$C");}}}foreach($Kh
as$z=>$X)json_row("sum-$z",format_number($X));json_row("");}elseif($_GET["script"]=="kill")$g->query("KILL ".number($_POST["kill"]));else{foreach(count_tables($b->databases())as$m=>$X){json_row("tables-$m",$X);json_row("size-$m",db_size($m));}json_row("");}exit;}else{$Th=array_merge((array)$_POST["tables"],(array)$_POST["views"]);if($Th&&!$o&&!$_POST["search"]){$H=true;$Je="";if($y=="sql"&&$_POST["tables"]&&count($_POST["tables"])>1&&($_POST["drop"]||$_POST["truncate"]||$_POST["copy"]))queries("SET foreign_key_checks = 0");if($_POST["truncate"]){if($_POST["tables"])$H=truncate_tables($_POST["tables"]);$Je='Tables have been truncated.';}elseif($_POST["move"]){$H=move_tables((array)$_POST["tables"],(array)$_POST["views"],$_POST["target"]);$Je='Tables have been moved.';}elseif($_POST["copy"]){$H=copy_tables((array)$_POST["tables"],(array)$_POST["views"],$_POST["target"]);$Je='Tables have been copied.';}elseif($_POST["drop"]){if($_POST["views"])$H=drop_views($_POST["views"]);if($H&&$_POST["tables"])$H=drop_tables($_POST["tables"]);$Je='Tables have been dropped.';}elseif($y!="sql"){$H=($y=="sqlite"?queries("VACUUM"):apply_queries("VACUUM".($_POST["optimize"]?"":" ANALYZE"),$_POST["tables"]));$Je='Tables have been optimized.';}elseif(!$_POST["tables"])$Je='No tables.';elseif($H=queries(($_POST["optimize"]?"OPTIMIZE":($_POST["check"]?"CHECK":($_POST["repair"]?"REPAIR":"ANALYZE")))." TABLE ".implode(", ",array_map('idf_escape',$_POST["tables"])))){while($J=$H->fetch_assoc())$Je.="<b>".h($J["Table"])."</b>: ".h($J["Msg_text"])."<br>";}queries_redirect(substr(ME,0,-1),$Je,$H);}page_header(($_GET["ns"]==""?'Database'.": ".h(DB):'Schema'.": ".h($_GET["ns"])),$o,true);if($b->homepage()){if($_GET["ns"]!==""){echo"<h3 id='tables-views'>".'Tables and views'."</h3>\n";$Sh=tables_list();if(!$Sh)echo"<p class='message'>".'No tables.'."\n";else{echo"<form action='' method='post'>\n";if(support("table")){echo"<fieldset><legend>".'Search data in tables'." <span id='selected2'></span></legend><div>","<input type='search' name='query' value='".h($_POST["query"])."'>",script("qsl('input').onkeydown = partialArg(bodyKeydown, 'search');","")," <input type='submit' name='search' value='".'Search'."'>\n","</div></fieldset>\n";if($_POST["search"]&&$_POST["query"]!=""){$_GET["where"][0]["op"]="LIKE %%";search_tables();}}$ac=doc_link(array('sql'=>'show-table-status.html'));echo"<div class='scrollable'>\n","<table cellspacing='0' class='nowrap checkable'>\n",script("mixin(qsl('table'), {onclick: tableClick, ondblclick: partialArg(tableClick, true)});"),'<thead><tr class="wrap">','<td><input id="check-all" type="checkbox" class="jsonly">'.script("qs('#check-all').onclick = partial(formCheck, /^(tables|views)\[/);",""),'<th>'.'Table','<td>'.'Engine'.doc_link(array('sql'=>'storage-engines.html')),'<td>'.'Collation'.doc_link(array('sql'=>'charset-charsets.html','mariadb'=>'supported-character-sets-and-collations/')),'<td>'.'Data Length'.$ac,'<td>'.'Index Length'.$ac,'<td>'.'Data Free'.$ac,'<td>'.'Auto Increment'.doc_link(array('sql'=>'example-auto-increment.html','mariadb'=>'auto_increment/')),'<td>'.'Rows'.$ac,(support("comment")?'<td>'.'Comment'.$ac:''),"</thead>\n";$S=0;foreach($Sh
as$C=>$T){$Wi=($T!==null&&!preg_match('~table~i',$T));$u=h("Table-".$C);echo'<tr'.odd().'><td>'.checkbox(($Wi?"views[]":"tables[]"),$C,in_array($C,$Th,true),"","","",$u),'<th>'.(support("table")||support("indexes")?"<a href='".h(ME)."table=".urlencode($C)."' title='".'Show structure'."' id='$u'>".h($C).'</a>':h($C));if($Wi){echo'<td colspan="6"><a href="'.h(ME)."view=".urlencode($C).'" title="'.'Alter view'.'">'.(preg_match('~materialized~i',$T)?'Materialized view':'View').'</a>','<td align="right"><a href="'.h(ME)."select=".urlencode($C).'" title="'.'Select data'.'">?</a>';}else{foreach(array("Engine"=>array(),"Collation"=>array(),"Data_length"=>array("create",'Alter table'),"Index_length"=>array("indexes",'Alter indexes'),"Data_free"=>array("edit",'New item'),"Auto_increment"=>array("auto_increment=1&create",'Alter table'),"Rows"=>array("select",'Select data'),)as$z=>$A){$u=" id='$z-".h($C)."'";echo($A?"<td align='right'>".(support("table")||$z=="Rows"||(support("indexes")&&$z!="Data_length")?"<a href='".h(ME."$A[0]=").urlencode($C)."'$u title='$A[1]'>?</a>":"<span$u>?</span>"):"<td id='$z-".h($C)."'>");}$S++;}echo(support("comment")?"<td id='Comment-".h($C)."'>":"");}echo"<tr><td><th>".sprintf('%d in total',count($Sh)),"<td>".h($y=="sql"?$g->result("SELECT @@storage_engine"):""),"<td>".h(db_collation(DB,collations()));foreach(array("Data_length","Index_length","Data_free")as$z)echo"<td align='right' id='sum-$z'>";echo"</table>\n","</div>\n";if(!information_schema(DB)){echo"<div class='footer'><div>\n";$Qi="<input type='submit' value='".'Vacuum'."'> ".on_help("'VACUUM'");$tf="<input type='submit' name='optimize' value='".'Optimize'."'> ".on_help($y=="sql"?"'OPTIMIZE TABLE'":"'VACUUM OPTIMIZE'");echo"<fieldset><legend>".'Selected'." <span id='selected'></span></legend><div>".($y=="sqlite"?$Qi:($y=="pgsql"?$Qi.$tf:($y=="sql"?"<input type='submit' value='".'Analyze'."'> ".on_help("'ANALYZE TABLE'").$tf."<input type='submit' name='check' value='".'Check'."'> ".on_help("'CHECK TABLE'")."<input type='submit' name='repair' value='".'Repair'."'> ".on_help("'REPAIR TABLE'"):"")))."<input type='submit' name='truncate' value='".'Truncate'."'> ".on_help($y=="sqlite"?"'DELETE'":"'TRUNCATE".($y=="pgsql"?"'":" TABLE'")).confirm()."<input type='submit' name='drop' value='".'Drop'."'>".on_help("'DROP TABLE'").confirm()."\n";$l=(support("scheme")?$b->schemas():$b->databases());if(count($l)!=1&&$y!="sqlite"){$m=(isset($_POST["target"])?$_POST["target"]:(support("scheme")?$_GET["ns"]:DB));echo"<p>".'Move to other database'.": ",($l?html_select("target",$l,$m):'<input name="target" value="'.h($m).'" autocapitalize="off">')," <input type='submit' name='move' value='".'Move'."'>",(support("copy")?" <input type='submit' name='copy' value='".'Copy'."'>":""),"\n";}echo"<input type='hidden' name='all' value=''>";echo
script("qsl('input').onclick = function () { selectCount('selected', formChecked(this, /^(tables|views)\[/));".(support("table")?" selectCount('selected2', formChecked(this, /^tables\[/) || $S);":"")." }"),"<input type='hidden' name='token' value='$mi'>\n","</div></fieldset>\n","</div></div>\n";}echo"</form>\n",script("tableCheck();");}echo'<p class="links"><a href="'.h(ME).'create=">'.'Create table'."</a>\n",(support("view")?'<a href="'.h(ME).'view=">'.'Create view'."</a>\n":"");if(support("routine")){echo"<h3 id='routines'>".'Routines'."</h3>\n";$Tg=routines();if($Tg){echo"<table cellspacing='0'>\n",'<thead><tr><th>'.'Name'.'<td>'.'Type'.'<td>'.'Return type'."<td></thead>\n";odd('');foreach($Tg
as$J){$C=($J["SPECIFIC_NAME"]==$J["ROUTINE_NAME"]?"":"&name=".urlencode($J["ROUTINE_NAME"]));echo'<tr'.odd().'>','<th><a href="'.h(ME.($J["ROUTINE_TYPE"]!="PROCEDURE"?'callf=':'call=').urlencode($J["SPECIFIC_NAME"]).$C).'">'.h($J["ROUTINE_NAME"]).'</a>','<td>'.h($J["ROUTINE_TYPE"]),'<td>'.h($J["DTD_IDENTIFIER"]),'<td><a href="'.h(ME.($J["ROUTINE_TYPE"]!="PROCEDURE"?'function=':'procedure=').urlencode($J["SPECIFIC_NAME"]).$C).'">'.'Alter'."</a>";}echo"</table>\n";}echo'<p class="links">'.(support("procedure")?'<a href="'.h(ME).'procedure=">'.'Create procedure'.'</a>':'').'<a href="'.h(ME).'function=">'.'Create function'."</a>\n";}if(support("sequence")){echo"<h3 id='sequences'>".'Sequences'."</h3>\n";$hh=get_vals("SELECT sequence_name FROM information_schema.sequences WHERE sequence_schema = current_schema() ORDER BY sequence_name");if($hh){echo"<table cellspacing='0'>\n","<thead><tr><th>".'Name'."</thead>\n";odd('');foreach($hh
as$X)echo"<tr".odd()."><th><a href='".h(ME)."sequence=".urlencode($X)."'>".h($X)."</a>\n";echo"</table>\n";}echo"<p class='links'><a href='".h(ME)."sequence='>".'Create sequence'."</a>\n";}if(support("type")){echo"<h3 id='user-types'>".'User types'."</h3>\n";$Oi=types();if($Oi){echo"<table cellspacing='0'>\n","<thead><tr><th>".'Name'."</thead>\n";odd('');foreach($Oi
as$X)echo"<tr".odd()."><th><a href='".h(ME)."type=".urlencode($X)."'>".h($X)."</a>\n";echo"</table>\n";}echo"<p class='links'><a href='".h(ME)."type='>".'Create type'."</a>\n";}if(support("event")){echo"<h3 id='events'>".'Events'."</h3>\n";$K=get_rows("SHOW EVENTS");if($K){echo"<table cellspacing='0'>\n","<thead><tr><th>".'Name'."<td>".'Schedule'."<td>".'Start'."<td>".'End'."<td></thead>\n";foreach($K
as$J){echo"<tr>","<th>".h($J["Name"]),"<td>".($J["Execute at"]?'At given time'."<td>".$J["Execute at"]:'Every'." ".$J["Interval value"]." ".$J["Interval field"]."<td>$J[Starts]"),"<td>$J[Ends]",'<td><a href="'.h(ME).'event='.urlencode($J["Name"]).'">'.'Alter'.'</a>';}echo"</table>\n";$yc=$g->result("SELECT @@event_scheduler");if($yc&&$yc!="ON")echo"<p class='error'><code class='jush-sqlset'>event_scheduler</code>: ".h($yc)."\n";}echo'<p class="links"><a href="'.h(ME).'event=">'.'Create event'."</a>\n";}if($Sh)echo
script("ajaxSetHtml('".js_escape(ME)."script=db');");}}}page_footer();
