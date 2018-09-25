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
<form action="user_add" method="get">
    <input type="hidden" value="{{$data}}" name="data">
    <input type="hidden" value="{{$openid}}" name="openid">
    <input type="radio" name="name" value="律师">律师
    <input type="radio" name="name" value="公众用户">公众用户
    <input type="submit" value="确定">
</form>
</body>
</html>