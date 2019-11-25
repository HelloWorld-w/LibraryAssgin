var timeflag=false;
function timeDown(times){
  if(!timeflag){
    timeflag=true;
    CountDown(times);
  }
}
function CountDown(times) {
  var tar=document.getElementById('surplus');
  var interval=setInterval(function(){
    if(times<0){clearInterval(interval);}
      var hour = Math.floor(times / (60 * 60));
      var minute = Math.floor(times / 60) - (hour * 60);
      var second = Math.floor(times) - (hour * 60 * 60) - (minute * 60);
    function tow(n) {
      return n >= 0 && n < 10 ? '0' + n : '' + n;
    }
    tar.innerHTML=tow(hour)+'小时 '+tow(minute)+'分 '+tow(second)+'秒 ';
    times--;
    if(times%60==0){
      $.post("timeDown.php", {timesecond: times});
      if(times==0){
        tar.innerHTML='时间到，结束';
        clearInterval(interval);
      }
    }
    $.post("timeDown.php", {times: times});
    },300);
}