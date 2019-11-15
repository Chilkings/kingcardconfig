<?php
/*
第一修改者为作者
修改者:lbr-dev,预留
修改者GITHUB:lbr-dev(https://github.com/lbr-dev/),预留
修改者QQ:lbr-dev(3170482764),预留
本项目开源地址:https://github.com/kingcardconfig/kingcardconfig/
*/

include_once(dirname(dirname(__FILE__)).'/lib/pclzip.lib.php');

function fgc($f){
$c=file_get_contents($f);
return $c;
}

function fpc($f,$c){
file_put_contents($f,$c);
}

function gettime(){
$gettime=date("Y-m-d H:i:s");
return $gettime;
}

function getua(){
$getua=$_SERVER['HTTP_USER_AGENT'];
return $getua;
}

function getuserip()
{
	if(getenv('HTTP_CLIENT_IP')){
		$ip = getenv('HTTP_CLIENT_IP');
	}
	if(getenv('HTTP_X_REAL_IP')){
		$ip = getenv('HTTP_X_REAL_IP');
	}elseif(getenv('HTTP_X_FORWARDED_FOR')){
		$ip = getenv('HTTP_X_FORWARDED_FOR');
		$ips = explode(',',$ip);
		$ip = $ips[0];
	}elseif(getenv('REMOTE_ADDR')){
		$ip = getenv('REMOTE_ADDR');
	}else{
		$ip = '0.0.0.0';
	}
	
	return $ip;
}

function getip(){
$getip=$_SERVER["REMOTE_ADDR"];
return $getip;
}

function gethost(){
$gethost=$_SERVER['HTTP_HOST'];
return $gethost;
}

function geturlpath(){
$http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';
$geturlpath=dirname($http_type.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
return $geturlpath;
}

function getwebpages($url, $header, $timeout){
if (substr($url,0,5)=='https') {
$opts = array('https' => array('method' => 'GET',
"protocol_version" => 1.1,
"timeout" => $timeout,
'header'=> $header));
$context = stream_context_create($opts);
$fp = fopen($url, 'r', false, $context);
$return = stream_get_contents($fp);
fclose($fp);
} else {
$opts = array('http' => array('method' => 'GET',
"protocol_version" => 1.1,
"timeout" => $timeout,
'header'=> $header));
$context = stream_context_create($opts);
$fp = fopen($url, 'r', false, $context);
$return = stream_get_contents($fp);
fclose($fp);
}
return $return;
}

function checktheproxyserver($url, $proxyip, $proxyport, $header, $timeout){
if (substr($url,0,5)=='https') {
$opts = array('https' => array('method' => 'GET',
"protocol_version" => 1.1,
"timeout" => $timeout,
'header'=> $header,
'proxy' => "tcp://".$proxyip.":".$proxyport."",
'request_fulluri' => true));
$context = stream_context_create($opts);
$fp = fopen($url, 'r', false, $context);
$return = stream_get_contents($fp);
fclose($fp);
} else {
$opts = array('http' => array('method' => 'GET',
"protocol_version" => 1.1,
"timeout" => $timeout,
'header'=> $header,
'proxy' => "tcp://".$proxyip.":".$proxyport."",
'request_fulluri' => true));
$context = stream_context_create($opts);
$fp = fopen($url, 'r', false, $context);
$return = stream_get_contents($fp);
fclose($fp);
}
return $return;
}

function gzdecodeapi($gzip) {

if (!function_exists('gzdecode')) {      
    function gzdecode ($data) {      
        $flags = ord(substr($data, 3, 1));      
        $headerlen = 10;      
        $extralen = 0;      
        $filenamelen = 0;      
        if ($flags & 4) {      
            $extralen = unpack('v' ,substr($data, 10, 2));      
            $extralen = $extralen[1];      
            $headerlen += 2 + $extralen;      
        }      
        if ($flags & 8) // Filename      
            $headerlen = strpos($data, chr(0), $headerlen) + 1;      
        if ($flags & 16) // Comment      
            $headerlen = strpos($data, chr(0), $headerlen) + 1;      
        if ($flags & 2) // CRC at end of file      
            $headerlen += 2;      
        $unpacked = @gzinflate(substr($data, $headerlen));      
        if ($unpacked === FALSE)      
              $unpacked = $data;      
        return $unpacked;      
     }
$return=gzdecode($gzip);
} else {
$return=gzdecode($gzip);
}
return $return;
}

function get_between($input, $start, $end) {

    $substr = substr($input, strlen($start)+strpos($input, $start),(strlen($input) - strpos($input, $end))*(-1));

    return $substr;

}

function wltfapi($file) {
$ua=$_SERVER['HTTP_USER_AGENT'];
$time=date("Y-m-d H:i:s");
$c="TIME:".$time." USER-AGENT:".$ua."";
$f=fopen($file,"a+");
$fw=fwrite($f,$c."\n");
fclose($f);
if ($fw === false) {
$return="0";
} else {
$return="1";
}
return $return;
}

function isgziphtmlapi($isgziphtmlfile,$html) {
file_put_contents($isgziphtmlfile,$html);
$file = fopen($isgziphtmlfile, "r");   
//只读2字节  如果为31139则开启了gzip
$bin = fread($file, 2);  
fclose($file);   
$strInfo = @unpack("C2chars", $bin);   
$typeCode = intval($strInfo['chars1'].$strInfo['chars2']);   
$isGzip = 0;   
switch ($typeCode)   
{ 
    case 31139:       
      //网站开启了gzip 
        $isGzip = 1; 
        break; 
    default:   
        $isGzip = 0; 
}
unlink($isgziphtmlfile);
return $isGzip;
}

function unzip($file){
$archive = new PclZip($file);
if ($archive->extract() == 0) {
die("Unzip Error:".$archive->errorInfo(true));
}
}

?>