/**
 * [code 验证码刷新改变值]
 * @return {[type]} [返回一个新的url地址]
 */
function code () {
	var code = document.getElementById('code');
	code.onclick = function () {
		this.src='code.php?tm='+Math.random();
	};	
}