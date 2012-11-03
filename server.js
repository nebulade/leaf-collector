var express = require('express')
, app = express()
, io = require('socket.io').listen(app)
, config = require('./config.js')
, api = require('./api.js');

console.log("");
console.log("+ Starting server");
console.log("  - Using port: ", config.server.port);
console.log("  - Using root directory: ", config.server.root);
console.log("");

app.listen(config.server.port);

// index if no url is specified
app.get('/', function (req, res) {
    res.sendfile(config.server.root + '/index.html');
});

// api calls which return JSON
app.get('/api/*', function (req, res) {
    api.request(req);
    res.sendfile(config.server.root + req.url);
});

// catchall
app.get('*', function (req, res) {
   console.log("file request: ", req.url);
   res.sendfile(config.server.root + req.url);
});

io.sockets.on('connection', function (socket) {
    console.log("new connection :", socket);
    socket.emit('news', { hello: 'world' });
    socket.on('my other event', function (data) {
        console.log(data);
    });
});
