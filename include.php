<?php
//导入第三方内库
require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'CodeCompress-Lib-HtmlMinify'.DIRECTORY_SEPARATOR.'html-minify.php';

#注册插件
RegisterPlugin("CodeCompress","ActivePlugin_CodeCompress");

function ActivePlugin_CodeCompress() {
	Add_Filter_Plugin('Filter_Plugin_Index_Begin','CodeCompress_begin');	
	Add_Filter_Plugin('Filter_Plugin_Index_End','CodeCompress_end');
	Add_Filter_Plugin('Filter_Plugin_Zbp_MakeTemplatetags','CodeCompress_main');
}

function CodeCompress_main(&$template){
	global $zbp;		
	$consoleLogText=$zbp->Config('CodeCompress')->consoleLogInfo;
	$zbp->footer .= "<script type=\"text/javascript\">console.info(\"$consoleLogText\");</script>\r\n";
}

function CodeCompress_begin(){
	ob_start();
}

function CodeCompress_end(){
	$html=ob_get_contents();
	ob_get_clean();
	if(!function_exists('absolute_to_relative_url')){
		require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'CodeCompress-Lib-HtmlMinify'.DIRECTORY_SEPARATOR.'absolute-to-relative-urls.php';
	}
	$currentpage = $_SERVER['PHP_SELF'];
	if(strpos($currentpage,"zb_system/") || strpos($currentpage,"zb_users/")){
		echo $html;
	}else{
		echo new CodeCompress_HTML_Minify($html);
	}
}

function InstallPlugin_CodeCompress() {
	global $zbp;
	$zbp->Config('CodeCompress')->name='CodeCompress';
	$zbp->Config('CodeCompress')->cnName='代码压缩';
	$zbp->Config('CodeCompress')->dependency='HTML_Minify';
	$zbp->Config('CodeCompress')->version='1.0';
	$zbp->Config('CodeCompress')->consoleLogInfo='亲，如果对代码压缩感兴趣，请到https://github.com/tangkunyin/codecompressforzblog。如果有其它IT方面问题，欢迎到说IT与我交流(http://shuoit.net)！  ^_^';	
	$zbp->SaveConfig('CodeCompress');
}

function UninstallPlugin_CodeCompress() {
	global $zbp;
	$zbp->DelConfig('CodeCompress');
}