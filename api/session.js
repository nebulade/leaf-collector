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

SessionManager.prototype.isUserAuthenticated = function (session) {
    console.log("");
    console.log("+ Session: isUserAuthenticated()");
    console.log("  - valid: ", (typeof session.valid !== "undefined" && session.valid));
    console.log("");

    return (typeof session.valid !== "undefined" && session.valid);
};

SessionManager.prototype.login = function (user, password, session, callback) {
    console.log("");
    console.log("+ Session: login()");
    console.log("");

    if (user === "jzellner" && password === "manda") {
        session.user = user;
        session.valid = true;

        console.log("  - session: ", session);

        callback(null, true);
    } else {
        session.valid = false;

        callback(createError(1, "Login failed"), null);
    }
};

SessionManager.prototype.logout = function (req, callback) {
    console.log("");
    console.log("+ Session: logout()");
    console.log("");

    delete this.sids[req.headers.cookie];
    req.session = null;

    callback(null, true);
};

exports.sessionManager = new SessionManager();
exports.request = function (req, callback) {
    console.log("");
    console.log("+ Session API request");
    console.log("  - url: ", req.url);
    console.log("  - query: ", req.query);
    console.log("  - session: ", req.session);
    console.log("");

    var payload = JSON.parse(req.query.payload);

    if (req.query.action === 'login') {
        exports.sessionManager.login(payload['user'], payload['password'], req.session, callback);
    } else if (req.query.action === 'logout') {
        exports.sessionManager.logout(req, callback);
    }
};

exports.validateUser = function (req, res, callback) {
    console.log("");
    console.log("+ Session API validateUser");
    console.log("  - url: ", req.url);
    console.log("  - query: ", req.query);
    console.log("  - session: ", req.session);
    console.log("");

    if (exports.sessionManager.isUserAuthenticated(req.session)) {
        callback(null, true);
        return;
    } else {
        res.sendfile(exports.sessionManager.config.server.root + '/login.html');
    }
};
