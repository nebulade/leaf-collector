"use strict";

function createError(code, message) {
    return {
        code: code,
        message: message
    }
}

function Session (name) {
    this.name = name;
};

function SessionManager () {
    this.config = {};
    this.sids = [];
};

SessionManager.prototype.isUserAuthenticated = function (sid) {
    console.log("");
    console.log("+ Session: isUserAuthenticated()");
    console.log("");

    if (sid in this.sids) {
        return true;
    } else {
        return false;
    }
};

SessionManager.prototype.login = function (user, password, sessionID, callback) {
    console.log("");
    console.log("+ Session: login()");
    console.log("");

    if (user === "jzellner" && password === "manda") {
        this.sids[sessionID] = true;
        callback({error: null, result: true});
    } else {
        callback({error: {code: 1, message: "Login failed"}, result: null});
    }
};

SessionManager.prototype.logout = function (req, callback) {
    console.log("");
    console.log("+ Session: logout()");
    console.log("");

    delete this.sids[req.headers.cookie];
    req.session = null;

    callback({error: null, result: true});
};

exports.sessionManager = new SessionManager();
exports.request = function (req, callback) {
    console.log("");
    console.log("+ Session API request");
    console.log("  - url: ", req.url);
    console.log("  - query: ", req.query);
    console.log("  - sessionID: ", req.headers.cookie);
    console.log("");

    var payload = JSON.parse(req.query.payload);

    if (req.query.action === 'login') {
        exports.sessionManager.login(payload['user'], payload['password'], req.headers.cookie, callback);
    } else if (req.query.action === 'logout') {
        exports.sessionManager.logout(req, callback);
    }
};
exports.validateUser = function (req, res, callback) {
    console.log("");
    console.log("+ Session API validateUser");
    console.log("  - url: ", req.url);
    console.log("  - query: ", req.query);
    console.log("  - sessionID: ", req.headers.cookie);
    console.log("");

    if (exports.sessionManager.isUserAuthenticated(req.headers.cookie)) {
        callback();
        return;
    } else {
        res.sendfile(exports.sessionManager.config.server.root + '/login.html');
    }
};
