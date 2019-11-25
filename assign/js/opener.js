window.onload=function(){
	var imglist=document.getElementsByTagName('img');
	for (var i = 0; i < imglist.length; i++) {
		imglist[i].onclick=function(){
			_opener(this.alt);
		};
	}
}
function _opener(alt){
	var faceimg=opener.document.getElementById('faceimg');
	faceimg.src=alt;
	opener.document.getElementById('face').value=alt;
}