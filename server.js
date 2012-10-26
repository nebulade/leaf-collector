var express = require('express')
, app = express()
, io = require('socket.io').listen(app);

app.listen(1337);

app.get('/', function (req, res) {
//    console.log("request: ", req);
    res.sendfile(__dirname + '/index.html');
});

io.sockets.on('connection', function (socket) {
    socket.emit('news', { hello: 'world' });
    socket.on('my other event', function (data) {
        console.log(data);
    });
});
