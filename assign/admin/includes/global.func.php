<?php
// 防止恶意调用
if(!defined('IN_TG')){
	exit('非法调用');
}
/**
 * _code()是验证码函数
 * @access public 
 * @param int $_width 表示验证码的长度
 * @param int $_height 表示验证码的高度
 * @param int $_rnd_code 表示验证码的位数
 * @param bool $_flag 表示验证码是否需要边框 
 * @return void 这个函数执行后产生一个验证码
 */
function _code($_width = 75,$_height = 28,$_rnd_code = 4,$_flag = false) {
	
	//创建随机码
	for ($i=0;$i<$_rnd_code;$i++) {
		@$_nmsg .= dechex(mt_rand(0,15));
	}
	
	//保存在session
	$_SESSION['code'] = $_nmsg;
	
	//创建一张图像
	$_img = imagecreatetruecolor($_width,$_height);
	
	//白色
	$_white = imagecolorallocate($_img,255,255,255);
	
	//填充
	imagefill($_img,0,0,$_white);
	
	if ($_flag) {
		//黑色,边框
		$_black = imagecolorallocate($_img,0,0,0);
		imagerectangle($_img,0,0,$_width-1,$_height-1,$_black);
	}
	
	//随即画出6个线条
	for ($i=0;$i<6;$i++) {
		$_rnd_color = imagecolorallocate($_img,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
		imageline($_img,mt_rand(0,$_width),mt_rand(0,$_height),mt_rand(0,$_width),mt_rand(0,$_height),$_rnd_color);
	}
	
	//随即雪花
	for ($i=0;$i<100;$i++) {
		$_rnd_color = imagecolorallocate($_img,mt_rand(200,255),mt_rand(200,255),mt_rand(200,255));
		imagestring($_img,1,mt_rand(1,$_width),mt_rand(1,$_height),'*',$_rnd_color);
	}
	
	//输出验证码
	for ($i=0;$i<strlen($_SESSION['code']);$i++) {
		$_rnd_color = imagecolorallocate($_img,mt_rand(0,100),mt_rand(0,150),mt_rand(0,200));
		imagestring($_img,5,($i*$_width)/$_rnd_code+mt_rand(1,10),mt_rand(1,$_height/2),$_SESSION['code'][$i],$_rnd_color);
	}
	
	//输出图像
	header('Content-Type: image/png');
	imagepng($_img);
	
	//销毁
	imagedestroy($_img);
}
/**
 * [_check_code description]
 * @param  [type] $post_code    [description]
 * @param  [type] $session_code [description]
 * @return [type]               [description]
 */
function _check_code($post_code,$session_code){
	if(!($post_code==$session_code)){
		_alert_back('验证码错误');
	}
}
/**
 * [_alert_back js弹出框退出当前程序]
 * @param  [type] $alertstr [提示语]
 * @param  [type] $url      [要跳转到url]
 * @return [type]           [description]
 */
function _alert_back_url($alertstr,$url){
	echo "<script type='text/javascript'>alert('$alertstr');window.location.href='$url';</script>";
	exit();
}
/*
 * [_alert_url_null js弹出框不退出当程序，继续执行]
 * @param  [type] $alertstr [提示语]
 * @param  [type] $url      [要跳转到的url]
 * @return [type]           [description]
 */
function _alert_url_null($alertstr,$url){
	echo "<script type='text/javascript'>alert('$alertstr');window.location.href='$url';</script>";
}
/**
 * _alert_back()表示js弹框
 * @access public
 * @param $alertstr
 * @return void弹窗
 */
function _alert_back($alertstr){
	echo "<script type='text/javascript'>alert('$alertstr');window.history.go(-1);</script>";
	exit();
}
/**
 * [_location description]
 * @param  [type] $_info [description]
 * @param  [type] $_url  [description]
 * @return [type]        [description]
 */
function _location($_info,$_url) {
	if (!empty($_info)) {
		echo "<script type='text/javascript'>alert('$_info');location.href='$_url';</script>";
		exit();
	} else {
		header('Location:'.$_url);
	}
}
/**
 * [_url_sha1 加密]
 * @param  [type] $_str [description]
 * @return [type]       [description]
 */
function _url_sha1($_str){
	return $_str.substr(sha1(mt_rand(1,9)),0,20);
}
?>