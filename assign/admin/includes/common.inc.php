<?php
// 防止恶意调用
if(!defined('IN_TG')){
	exit("非法调用");
}
//设置编码utf-8
header('Content-type:text/html;charset=utf-8');
//ROOT_PATH => D:\phpStudy\PHPTutorial\WWW\assign\ 
define('ROOT_PATH',substr(__FILE__,0,-23));
//拒绝低版本php
if(PHP_VERSION<'5.5.38'){
	exit('php版本太低');
}
//引入核心函数库
require ROOT_PATH.'includes/global.func.php';
//引入数据库函数
require ROOT_PATH.'includes/mysql.func.php';
//连接数据库
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PWD','root');
define('DB_NAME','assign');
//连接数据库
_connect();
//设置字符集
_set_names();
?>