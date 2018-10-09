<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>评论</title>
    <link rel="stylesheet" href="https://weui.io/weui.css"/>
    <link rel="stylesheet" href="https://weui.io/example.css"/>
</head>
<body>

    <input type="hidden" value="{{$data->comment_id}}" id="hi">
    <input type="hidden" value="{{$data->h_id}}" id="hid">
                    <p>热点：<b style="color:red;">{{$res->h_content}}</b></p>
                    <p>评论：<b style="color:darkgreen;"> {{$data->content}}</b></p>
                <div class="weui-cells weui-cells_form">
                    <div class="weui-cell">
                        <div class="weui-cell__bd" >
                            <textarea class="weui-textarea" placeholder="请输入文本" rows="5" cols="48"></textarea>
                        </div>
                    </div>
                </div>
                     <input type="button" value="评论" id="bu">


</body>
</html>
<script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
<script>
    $('#bu').on('click',function(){
        // pid
        var id = $('#hi').val();
        var hid = $('#hid').val(); // h_id 热点
        var area = $("#area").val();// 评论内容
        // alert(id);
        // alert(hid);
        // alert(area);
        $.get('/comment_do_do',
            {
                id:id,
                hid:hid,
                area:area
            },function(data){
            // alert(data)
                if(data == 1){
                    location.href='hot_detail?h_id='+hid;
                }
                // console.log(data)
            })

    })
</script>