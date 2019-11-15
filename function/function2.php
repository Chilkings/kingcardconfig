<?php
/*
第一修改者为作者
修改者:lbr-dev,预留
修改者GITHUB:lbr-dev(https://github.com/lbr-dev/),预留
修改者QQ:lbr-dev(3170482764),预留
本项目开源地址:https://github.com/kingcardconfig/kingcardconfig/
*/

include_once(dirname(dirname(__FILE__)).'/function/function1.php');

function ubbtohtml($Text){
$Text=preg_replace("/\[gethost\]/is",gethost(),$Text);
$Text=preg_replace("/\[getip\]/is",getip(),$Text);
$Text=preg_replace("/\[gettime\]/is",gettime(),$Text);
$Text=preg_replace("/\[getua\]/is",getua(),$Text);
$Text=preg_replace("/\[getuserip\]/is",getuserip(),$Text);
$Text=preg_replace("/\[geturlpath\]/is",geturlpath(),$Text);
$Text=preg_replace("/\\n/is","<br>",$Text);
$Text=preg_replace("/\\t/is"," ",$Text);
$Text=preg_replace("/\[hr\]/is","<hr>",$Text);
$Text=preg_replace("/\[separator\]/is","<br/>",$Text);
$Text=preg_replace("/\[h1\](.+?)\[\/h1\]/is","<h1>\\1</h1>",$Text);
$Text=preg_replace("/\[h2\](.+?)\[\/h2\]/is","<h2>\\1</h2>",$Text);
$Text=preg_replace("/\[h3\](.+?)\[\/h3\]/is","<h3>\\1</h3>",$Text);
$Text=preg_replace("/\[h4\](.+?)\[\/h4\]/is","<h4>\\1</h4>",$Text);
$Text=preg_replace("/\[h5\](.+?)\[\/h5\]/is","<h5>\\1</h5>",$Text);
$Text=preg_replace("/\[h6\](.+?)\[\/h6\]/is","<h6>\\1</h6>",$Text);
$Text=preg_replace("/\[center\](.+?)\[\/center\]/is","<center>\\1</center>",$Text);
$Text=preg_replace("/\[url=([^\[]*)\](.+?)\[\/url\]/is","<a href=\\1 target='_blank'>\\2</a>",$Text);
$Text=preg_replace("/\[url\](.+?)\[\/url\]/is","<a href=\"\\1\" target='_blank'>\\1</a>",$Text);
$Text=preg_replace("/\[url=(http:\/\/.+?)\](.+?)\[\/url\]/is","<a href='\\1' target='_blank'>\\2</a>",$Text);
$Text=preg_replace("/\[url=(.+?)\](.+?)\[\/url\]/is","<a href=\\1>\\2</a>",$Text);
$Text=preg_replace("/\[img\](.+?)\[\/img\]/is","<img src=\\1>",$Text);
$Text=preg_replace("/\[img\s(.+?)\](.+?)\[\/img\]/is","<img \\1 src=\\2>",$Text);
$Text=preg_replace("/\[color=(.+?)\](.+?)\[\/color\]/is","<font color=\\1>\\2</font>",$Text);
$Text=preg_replace("/\[style=(.+?)\](.+?)\[\/style\]/is","<div class='\\1'>\\2</div>",$Text);
$Text=preg_replace("/\[size=(.+?)\](.+?)\[\/size\]/is","<font size=\\1>\\2</font>",$Text);
$Text=preg_replace("/\[sup\](.+?)\[\/sup\]/is","<sup>\\1</sup>",$Text);
$Text=preg_replace("/\[sub\](.+?)\[\/sub\]/is","<sub>\\1</sub>",$Text);
$Text=preg_replace("/\[pre\](.+?)\[\/pre\]/is","<pre>\\1</pre>",$Text);
$Text=preg_replace("/\[email\](.+?)\[\/email\]/is","<a href='mailto:\\1'>\\1</a>",$Text);
$Text=preg_replace("/\[i\](.+?)\[\/i\]/is","<i>\\1</i>",$Text);
$Text=preg_replace("/\[u\](.+?)\[\/u\]/is","<u>\\1</u>",$Text);
$Text=preg_replace("/\[b\](.+?)\[\/b\]/is","<b>\\1</b>",$Text);
$Text=preg_replace("/\[quote\](.+?)\[\/quote\]/is","<blockquote>引用:<div style='border:1px solid silver;background:#EFFFDF;color:#393939;padding:5px' >\\1</div></blockquote>", $Text);
$Text=preg_replace("/\[sig\](.+?)\[\/sig\]/is","<div style='text-align: left; color: darkgreen; margin-left: 5%'><br><br>--------------------------<br>\\1<br>--------------------------</div>", $Text);
return $Text;
}

function gethtml($url,$ua,$timeout,$isgziphtmlfile){
$header = array("User-Agent:".$ua."");
$isgziphtml =getwebpages($url, $header, $timeout);
if (isgziphtmlapi($isgziphtmlfile,$isgziphtml) == '1') {
$html=gzdecodeapi($isgziphtml);
} else {
$html=$isgziphtml;
}
return $html;
}

function checkguidandtoken($url,$proxyip,$proxyport,$ua,$guid,$token,$checkguidandtokenhtml,$timeout,$isgziphtmlfile){
$header = array("User-Agent:".$ua."","Q-GUID:".$guid."","Q-Token:".$token."");
$isgziphtml =checktheproxyserver($url,$proxyip,$proxyport, $header, $timeout);
if (isgziphtmlapi($isgziphtmlfile,$isgziphtml) == '1') {
$html=gzdecodeapi($isgziphtml);
} else {
$html=$isgziphtml;
}
if ($html == $checkguidandtokenhtml) {
$return="1";
} else {
$return="0";
}
return $return;
}

function getconfigguid($config){
$guid= get_between($config, '"Guid":"', '","Token"');
return $guid;
}

function getconfigtoken($config){
$token= get_between($config, '"Token":"', '"}');
return $token;
}

function getconfigtime($config){
$time= get_between($config, '"Time":"', '","Guid"');
return $time;
}

?>