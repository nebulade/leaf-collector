"use strict";

function listAll() {
    console.log("");
    console.log("+ Projects: listAll()");
    console.log("");

    return ["DMX Shield", "Flasher"];
};

exports.request = function (req) {
    console.log("");
    console.log("+ Project API request");
    console.log("  - url: ", req.url);
    console.log("  - query: ", req.query);
    console.log("");

    if (req.query.action === "listAll") {
        return listAll();
    }
};
