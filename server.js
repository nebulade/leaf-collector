var express = require('express')
, app = express()
, io = require('socket.io').listen(app)
, config = require('./config.js')
, api = require('./api.js')
, projectApi = require('./api/project.js')
, sessionApi = require('./api/session.js');

console.log("");
console.log("+ Starting server");
console.log("  - Using port: ", config.server.port);
console.log("  - Using root directory: ", config.server.root);
console.log("");

app.listen(config.server.port);

app.use(express.cookieParser('leafcollector'));
app.use(express.cookieSession({
    path: '/',
    httpOnly: true,
    maxAge: null,
    secret: 'leafcollector',
    key: 'leafcollector.sess'
}));

sessionApi.sessionManager.config = config;

// index if no url is specified
app.get('/', function (req, res) {
    sessionApi.validateUser(req, res, function() {
        res.sendfile(config.server.root + '/index.html');
    });
});

// api calls which return JSON
app.get('/api/project*', function (req, res) {
    sessionApi.validateUser(req, res, function() {
        projectApi.request(req, function (result) {
            res.json(result);
        });
    });
});

// api calls which return JSON
app.get('/api/session*', function (req, res) {
    sessionApi.request(req, function (result) {
        res.json(result);
    });
});

// api calls which return JSON
app.get('/api/*', function (req, res) {
    sessionApi.validateUser(req, res, function() {
        api.request(req);
        res.sendfile(config.server.root + req.url);
    });
});

// js lib catchall
app.get('/lib/*', function (req, res) {
   console.log("js lib file request: ", req.url);
   res.sendfile(config.server.root + req.url);
});

// css catchall
app.get('*.css', function (req, res) {
   console.log("css file request: ", req.url);
   res.sendfile(config.server.root + req.url);
});

// css catchall
app.get('/third-party/*', function (req, res) {
   console.log("third-party file request: ", req.url);
   res.sendfile(config.server.root + req.url);
});

// catchall
app.get('*', function (req, res) {
    sessionApi.validateUser(req, res, function() {
       console.log("file request: ", req.url);
       res.sendfile(config.server.root + req.url);
   });
});

