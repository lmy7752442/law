<table border="1">
    <th>id</th>
    <th>用户id</th>
    <th>标题</th>
    <th>内容</th>
    <th>操作</th>
    @foreach($article_info as $user)
        <tr>
            <td>{{$user->art_id}}</td>
            <td>{{$user->uid}}</td>
            <td>{{$user->title}}</td>
            <td>{{$user->content}}</td>
            <td><input type="button" name="check" value="审核"></td>
        </tr>
    @endforeach

</table>
<script type="text/javascript" src="/js/jquery-3.2.1.min.js"></script>
<script>
    $('[name=check]').on('click',function(){
        var art_id = $(this).parent().siblings().first().html();
        alert(art_id)
    })
</script>