
var app     = require('express')();

/*/
var fs = require('fs');
var options = {
    key:  fs.readFileSync('/etc/nginx/ssl/<makeyourownpath>/server.key'),
    cert: fs.readFileSync('/etc/nginx/ssl/<makeyourownpath>/server.crt')
};
var server = require('https').createServer(options, handler);
/**/

var server  = require('http').Server(app);

//var server  = require('http').Server();

//var server = require('http').createServer(handler);
//function handler(req, res) {
//    res.writeHead(200);
//    res.end('');
//}

var io      = require('socket.io')(server);

var Redis = require('ioredis');
var redis = new Redis();

//redis.subscribe('test-channel', function(err, count) {});
//
//redis.subscribe('room',         function(err, count) {});
//redis.subscribe('direct',       function(err, count) {});
//redis.subscribe('alert',        function(err, count) {});

io.on('connection', function(socket) {});
redis.psubscribe('*', function(err, count) {
//    console.log('subscribed : ' + count);
//    console.log(err);
});
redis.on('pmessage', function(subscribed, channel, message) {
    message = JSON.parse(message);
    console.log( 'subscribed : ' + subscribed + ' , Channel : ' + channel + ' , event : ' + message.event );
    io.emit(channel + ':' + message.event, message.data);
});

//redis.on('message', function(channel, message) {
//    console.log('Message Recieved: ' + message);
//    message = JSON.parse(message);
//    io.emit(channel + ':' + message.event, message.data);
//});

server.listen(3000, function(){
    console.log('Listening on Port 3000');
});
