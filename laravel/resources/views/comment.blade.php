<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div style="margin-left: 40%;">
    <input type="hidden" value="{{$data->comment_id}}" id="hi">
    <input type="hidden" value="{{$data->h_id}}" id="hid">

        <table>
            <tr>
                <td>
                    热点：
                </td>
                <td>
                    {{$res->h_content}}
                </td>
            </tr>
            <tr>
                <td>评论：</td>
                {{--<td><textarea name="" readonly>{{$data->content}}</textarea></td>--}}
                <td>{{$data->content}}</td>
            </tr>
    <tr>
        <td></td>
        <td>
            <div style="margin-top:10px; ">
                <textarea name="" id="area" cols="40" rows="10"></textarea>
            </div>
        </td>
    </tr>
    <tr>
        <td></td>
        <td><input type="button" value="评论" id="bu"></td>
    </tr>

    </table>
</div>
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