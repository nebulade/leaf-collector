"use strict";

exports.request = function (req) {
    console.log("");
    console.log("+ API request");
    console.log("  - url: ", req.url);
    console.log("  - query: ", req.query);
    console.log("");
};
