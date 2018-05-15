<html>
<head>
    <title>Pusher Test</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    


       /* // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('627b1f89cce002c44eb3', {
            cluster: 'us2',
            encrypted: true
        });

        var channel = pusher.subscribe('test-channel');
        channel.bind('TestEvent', function(data) {
            alert(data.message);
        });*/

</head>
<body>

<div id="app">   

<script src="{{ asset('js/app.js') }}"></script></div> 
</body>
</html>