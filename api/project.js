"use strict";

var fs = require('fs');

function createError(code, message) {
    return {
        code: code,
        message: message
    }
}

function Project (name) {
    this.name = name;
};

function ProjectManager () {
    this.projectsRoot = "store/";
};

ProjectManager.prototype.listAll = function (callback) {
    console.log("");
    console.log("+ Projects: listAll()");
    console.log("");

    fs.readdir(this.projectsRoot, function (error, files) {
        if (error) {
            console.log("[E] cannot list projects");
            callback(createError(1, "Cannot read projects directory."), null);
            return;
        }

        callback(null, files);
    });
};

ProjectManager.prototype.create = function (name, callback) {
    console.log("");
    console.log("+ Projects: create("+name+")");
    console.log("");

    var path = this.projectsRoot + "/" + name;

    fs.exists(path, function (exists) {
        if (exists) {
            console.log("[E] cannot create project '"+name+"', project already exists.");
            callback(createError(1, "Project '"+name+"' alread exists"), null);
            return;
        }

        fs.mkdir(path, function (error) {
            if (error) {
                console.log("[E] cannot create project '"+name+"', creating directory failed.");
                callback(createError(1, "Cannot create directory '" + path + "'"), null);
                return;
            }

            callback(null, new Project(name));
        });
    });
};

ProjectManager.prototype.select = function (name, req, callback) {
    console.log("");
    console.log("+ Projects: select("+name+")");
    console.log("");

    var path = this.projectsRoot + "/" + name;

    fs.exists(path, function (exists) {
        if (exists) {
            var project = new Project(name);
            req.session.projectName = name;
            req.session.project = project;
            callback(null, project);
            return;
        } else {
            callback(createError(0, "Project does not exist"), null);
        }
    });
};

ProjectManager.prototype.currentProject = function (req, callback) {
    console.log("");
    console.log("+ Projects: currentProject()");
    console.log("  - project: ", req.session.project);
    console.log("");

    if (typeof req.session.project !== "undefined") {
        callback(null, req.session.project);
    } else {
        callback(createError(0, "No project selected"), null);
    }
};

exports.projectManager = new ProjectManager();
exports.request = function (req, callback) {
    console.log("");
    console.log("+ Project API request");
    console.log("  - url: ", req.url);
    console.log("  - query: ", req.query);

    var payload = JSON.parse(req.query.payload);

    console.log("  - action: ", req.query.action);
    console.log("  - payload: ", payload);
    console.log("");

    if (req.query.action === "listAll") {
        exports.projectManager.listAll(callback);
    } else if (req.query.action === "create") {
        exports.projectManager.create(payload.name, callback);
    } else if (req.query.action === "select") {
        exports.projectManager.select(payload.name, req, callback);
    } else if (req.query.action === "currentProject") {
        exports.projectManager.currentProject(req, callback);
    }
};
