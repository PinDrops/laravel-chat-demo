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

/*/
var app = require('http').createServer(handler);
var io = require('socket.io')(app);

var Redis = require('ioredis');
var redis = new Redis();

app.listen(3000, function() {
    console.log('Server is running!');
});

function handler(req, res) {
    res.writeHead(200);
    res.end('');
}

io.on('connection', function(socket) {
    //
});

redis.psubscribe('*', function(err, count) {
    //
});

redis.on('pmessage', function(subscribed, channel, message) {
    message = JSON.parse(message);
    io.emit(channel + ':' + message.event, message.data);
});
/**/


/*/

var fs = require('fs');
//This line is from the Node.js HTTPS documentation.
var options = {
 key: fs.readFileSync('/etc/nginx/ssl/<makeyourownpath>/server.key'),
 cert: fs.readFileSync('/etc/nginx/ssl/<makeyourownpath>/server.crt')
};

var app = require('https').createServer(options, handler);
var io = require('socket.io')(app);

var Redis = require('ioredis');
var redis = new Redis();

app.listen(6001, function() {
 console.log('Server is running on port 6001!');
});

function handler(req, res) {
 res.writeHead(200);
 res.end('');
}

io.on('connection', function(socket) {
 //
});

redis.psubscribe('*', function(err, count) {
 //
});

redis.on('pmessage', function(subscribed, channel, message) {
 message = JSON.parse(message);
 io.emit(channel + ':' + message.event, message.data);
});

/**/

