window.onload=function(){
	var faceimg=document.getElementById('faceimg');
	var code = document.getElementById('code');
	var close=document.getElementById('close');
	faceimg.onclick=function(){
		window.open('face.php','faceimg','width=400px,height=300px','_parent');
	}
	code.onclick = function () {
		this.src='code.php?tm='+Math.random();
	}
	close.onclick=function(){
		window.open('index.php','_self');
	}
	var fm=document.getElementsByTagName('form')[0];
	fm.onsubmit=function(){
		//用户名验证
		if(fm.user.value.length<2 || fm.user.value.length>20){
			alert('用户名不得小于2位或者大于20位');
			fm.user.value='';
			fm.user.focus();
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
		if (fm.psw.value != fm.psw2.value) {
			alert('密码和密码确认必须一致');
			fm.psw2.value = ''; //清空
			fm.psw2.focus(); //将焦点以至表单字段
			return false;
		}
		//邮箱验证
		if (!/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/.test(fm.email.value)) {
			alert('邮件格式不正确');
			fm.email.value = ''; //清空
			fm.email.focus(); //将焦点以至表单字段
			return false;
		}
		//验证码验证
		if (fm.yzm.value.length != 4) {
			alert('验证码必须是4位');
			fm.yzm.value = ''; //清空
			fm.yzm.focus(); //将焦点以至表单字段
			return false;
		}

		return true;

	};
	
}
