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

        callback(files);
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

            callback({error: null, result: new Project(name)});
        });
    });
};

exports.projectManager = new ProjectManager();
exports.request = function (req, callback) {
    console.log("");
    console.log("+ Project API request");
    console.log("  - url: ", req.url);
    console.log("  - query: ", req.query);
    console.log("");

    if (req.query.action === "listAll") {
        exports.projectManager.listAll(callback);
    } else if (req.query.action === "create") {
        exports.projectManager.create(req.query.name, callback);
    }
};
