<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>充值界面</title>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
</head>
<body>
    <input type="hidden" value="{{$order_number}}" id="order_number">
    充值金额: <input type="number" id="money">元
    <br>
    <button id="queding">确定</button>
    <br>
    <img src="" alt="" id="image">
</body>
</html>
<script>
    $('#queding').click(function(){
        var order_number = $('#order_number').val();
        var money = $('#money').val();
        if(money == ''){
            alert('请输入金额');
            return false;
        }
        if(money <= 0){
            alert('请输入大于0的金额');
            return false;
        }
        var url = 'http://yuan.jinxiaofei.xyz/chongzhi_do?money='+money+'&order_number='+order_number;
        document.getElementById('image').src = url;
        setInterval('status()',1000);
    })
    function status(){
        var order_number = $('#order_number').val();
        $.get('chongzhi_status',{
            order_number:order_number
        },function(data){
            if(data == 1){
                location = 'person';
                alert('充值成功');
            }
        })
    }
</script>
