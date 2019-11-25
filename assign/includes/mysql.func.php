<?php
// 防止恶意调用
if(!defined('IN_TG')){
	exit('非法调用');
}

/**
 * _connect()连接数据库
 * @access public
 * @return void
 */
function _connect(){
	global $_conn;
	if(!$_conn=mysqli_connect(DB_HOST,DB_USER,DB_PWD,DB_NAME)){
		exit('数据库连接失败！');
	}
}
/**
 * _set_names()设置字符集
 * @access public
 * @return void
 */
function _set_names(){
	global $_conn;
	if(!mysqli_query($_conn,"SET NAMES UTF8")){
		exit('字符集设置失败！');
	}
}
/**
 * _query($_conn,$select_result)
 * @param  [type] $_conn         [description]
 * @param  [type] $select_result [description]
 * @return $_result
 */
function _query($_conn,$select_result){
	if(!$_result=mysqli_query($_conn,$select_result)){
		exit('数据库查找失败');
	}
	return $_result;
}
/**
 * [_affected_rows 影响的数据行数]
 * @return [type] [description]
 */
function _affected_rows($_conn){
	return mysqli_affected_rows($_conn);
}

/**
 * [_fetch_array 判断用户名是否重复]
 * @param  [type] $_conn         [description]
 * @param  [type] $select_result [description]
 * @param  [type] $str           [description]
 * @return [type]                [description]
 */
function _fetch_array($_conn,$select_result,$str,$alert_info){
	if(mysqli_fetch_array(_query($_conn,$select_result),$str)){
		return _alert_back($alert_info);
	}
//mysqli_fetch_array(_query($_conn,"SELECT st_stnumber FROM ag_seat WHERE st_user='{$_SESSION['user']}' and st_used=0"))
// *
//  * [_all_fetch_array  获取结果集中的数据]
//  * @param  [type] $_conn [连接数据库]
//  * @param  [type] $_sql  [sql语句]
//  * @return [type]        [返回结果集]
 
// function all_fetch_array($_conn,$_sql){
// 	return mysqli_fetch_array(_query($_conn,$_sql),MYSQLI_ASSOC);
// }
/**
 * [_close 关闭数据库]
 * @param  [type] $_conn [description]
 * @return [type]        [description]
 */
function _close($_conn){
		if(!mysqli_close($_conn)){
			exit('关闭数据库异常');
		}
	}
// /**
//  * [_setcookie 设置cookie]
//  * @param  [type] $_name     [description]
//  * @param  [type] $_username [description]
//  * @return [type]            [description]
//  */
// function _setcookie($_name,$_username){
// 		return setcookie($_name,$_username);
// 	}
}
?>