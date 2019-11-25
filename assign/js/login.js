window.onload = function () {
	code();
	var fm = document.getElementsByTagName('form')[0];
	fm.onsubmit = function () {
		if (fm.user.value.length < 2 || fm.user.value.length > 20) {
			alert('用户名不得小于2位或者大于20位');
			fm.user.value = ''; //清空
			fm.user.focus(); //将焦点以至表单字段
			return false;
		}
		if (/[<>\'\"\ \　]/.test(fm.user.value)) {
			alert('用户名不得包含非法字符');
			fm.user.value = ''; //清空
			fm.user.focus(); //将焦点以至表单字段
			return false;
		}
		//密码验证
		if (fm.psw.value.length < 5) {
			alert('密码不得小于5位');
			fm.psw.value = ''; //清空
			fm.psw.focus(); //将焦点以至表单字段
			return false;
		}
		//验证码验证
		if (fm.yzm.value.length != 4) {
			alert('验证码必须是4位');
			fm.yzm.value = ''; //清空
			fm.yzm.focus(); //将焦点以至表单字段
			return false;
		}
	};
};