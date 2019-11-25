/**
 * [setAll 全选]
 */
function setAll() {
	 var checkbox = document.getElementsByName("checkbox");
	 for (var i = 0; i < checkbox.length; i++) {
	     checkbox[i].checked = true;
	 	}
	}
/**
 * [setNo 全不选]
 */
function setNo() {
     var checkbox = document.getElementsByName("checkbox");
     for (var i = 0; i < checkbox.length; i++) {
         checkbox[i].checked = false;
     }
 }
 /**
  * [show 选择某一个]
  * @return {[type]} [description]
  */
// function show(){
//     obj = document.getElementsByName("checkbox");
//     check_val = [];
//     for(k in obj){
//         if(obj[k].checked)
//             check_val.push(obj[k].value);
//     }
//     alert(check_val);
//     $.post("first_floor.php", {checksel:check_val});
// }