$(function(){
    // $('#collapseOne,#collapseTwo,#collapseThree').collapse({
    //     parent:'#accordion',
    //     toggle:true,
    // });
    // 绑定模态框展示的方法
    $("#myModal,#myModal1,#myModal2,#myModal3").on("show.bs.modal",function(e){
        //获得点击打开的按钮
        var button=$(e.relatedTarget)
        //根据标签获得按钮传入的参数
        //获取座位号
        var recipient=button.data("whatever")
        //获取"我的"占位时间
        var recipient1=button.data("whatever1")
        //获取"我的"名言警句
        var recipient2=button.data("whatever2")
        //获取"我要等待"等待时间
        var recipient3=button.data("whatever3")
        //获得模态框本身
        var modal=$(this)
        //更改body里input的值,座位号
        modal.find(".modal-body .seatnum").val(recipient);
        //座位剩余时长
        modal.find(".modal-body .surplus_time").val(recipient1);
        //名言警句
        modal.find(".modal-body .language_text").val(recipient2);
        //等待时间
        modal.find(".modal-body .wait_time").val(recipient3);
    })
    //点击关闭"我要占位"窗口
    $('#but').on('click',function(){
        $('#myModal1').modal('hide');
    });   
})
