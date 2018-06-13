
chat demo made from instructions on

https://laracasts.com/discuss/channels/general-discussion/step-by-step-guide-to-installing-socketio-and-broadcasting-events-with-laravel-51


# current problems

I tried this tutorial on a fresh install of laravel 5.6 with socket io 2.1.1, and while the socket server runs fine, and connects in the "test" browser window. But nothing ever shows in the socket from running the "fire" window. Can someone share their working version of this in a GitHub project?

I put mine onto here, maybe someone can see the problem and fix so everyone in the future can have a compiled version of the demo 

Public repo I'll leave for others to benefit from :

https://github.com/PinDrops/laravel-chat-demo




```
Request URL: http://localhost:3000/socket.io/?EIO=3&transport=polling&t=MFwFvNR
response:
96:0{"sid":"NJGWx-qXUfgRIAiSAAAB","upgrades":["websocket"],"pingInterval":25000,"pingTimeout":5000}2:40
```

are those `96:0` and `2:40` supposed to exist? seems like a debugging error is somewhere.

```
Request URL: http://localhost:3000/socket.io/?EIO=3&transport=polling&t=MFwFvNh&sid=NJGWx-qXUfgRIAiSAAAB
response:
1:6
```

```
Request URL: ws://localhost:3000/socket.io/?EIO=3&transport=websocket&sid=NJGWx-qXUfgRIAiSAAAB

results of the frames are:
2probe
3probe
5
3
2
...
```


socket.js

```js
var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);
var Redis = require('ioredis');
var redis = new Redis();
redis.subscribe('test-channel', function(err, count) {
});
redis.on('message', function(channel, message) {
    console.log('Message Recieved: ' + message);
    message = JSON.parse(message);
    io.emit(channel + ':' + message.event, message.data);
});
http.listen(3000, function(){
    console.log('Listening on Port 3000');
});
```

test page

```js
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.1.1/socket.io.dev.js"></script>
    <script>
        var socket = io('http://localhost:3000');
        socket.on("test-channel:App\\Events\\EventName", function(message){
            console.log(message);
            // increase the power everytime we load test route
            $('#power').text(parseInt($('#power').text()) + parseInt(message.data.power));
        });
    </script>
```

the console.log never executes


```php
Route::get('fire', function () {
    // this fires the event
    $ev= event(new App\Events\EventName());
    var_dump($ev);
    return "event fired";
});
```

var dump result is always an empty array


```bash
$ node socket.js
Listening on Port 3000
```



