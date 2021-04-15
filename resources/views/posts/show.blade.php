<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>blogpost</title>
</head>
<body>
    {{$post->title}}
    @can('update', $post)
        <a href="#">update the post</a>
    @endcan
</body>
</html>
