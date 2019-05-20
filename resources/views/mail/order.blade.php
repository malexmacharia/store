<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>
    <div class="container">

        Dear {{$customer->name}},
        <p>Order number  {{$order->id}} has been Dispatched</p>
{{--        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut, commodi cumque deserunt dicta dignissimos dolore dolorum eligendi error esse et modi nesciunt omnis praesentium quia reiciendis saepe similique suscipit ut!</p>--}}
    </div>
</body>
</html>