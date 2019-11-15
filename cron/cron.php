<?php
/*
第一修改者为作者
修改者:lbr-dev,预留
修改者GITHUB:lbr-dev(https://github.com/lbr-dev/),预留
修改者QQ:lbr-dev(3170482764),预留
本项目开源地址:https://github.com/kingcardconfig/kingcardconfig/
*/
include_once(dirname(dirname(__FILE__)).'/public/public.php');
if ($configcronlogonoroff == 'on') {
if (wltfapi(dirname(dirname(__FILE__))."/logs/".$configcronlogfilename) == '1') {
updatewkdtconfig(dirname(dirname(__FILE__))."/files/".$configwkdtconfigfilename,$configcheckguidandtokenurl,$configcheckguidandtokenproxyip,$configcheckguidandtokenproxyport,$configcheckguidandtokenua,$configcheckguidandtokenhtml,$configtimeout,dirname(dirname(__FILE__))."/tmps/".$configisgziphtmlfilename,$configcronsuccessmessage,$configwkdtconfig1url,$configwkdtconfig2url,$configwkdtconfig3url,$configwkdtconfig4url,$configwkdtconfig5url,$configwkdtconfig1ua,$configwkdtconfig2ua,$configwkdtconfig3ua,$configwkdtconfig4ua,$configwkdtconfig5ua);
} else {
echo "写入任务日志到".dirname(dirname(__FILE__))."/logs/".$configcronlogfilename."失败！";
}
} else {
updatewkdtconfig(dirname(dirname(__FILE__))."/files/".$configwkdtconfigfilename,$configcheckguidandtokenurl,$configcheckguidandtokenproxyip,$configcheckguidandtokenproxyport,$configcheckguidandtokenua,$configcheckguidandtokenhtml,$configtimeout,dirname(dirname(__FILE__))."/tmps/".$configisgziphtmlfilename,$configcronsuccessmessage,$configwkdtconfig1url,$configwkdtconfig2url,$configwkdtconfig3url,$configwkdtconfig4url,$configwkdtconfig5url,$configwkdtconfig1ua,$configwkdtconfig2ua,$configwkdtconfig3ua,$configwkdtconfig4ua,$configwkdtconfig5ua);
}
?>