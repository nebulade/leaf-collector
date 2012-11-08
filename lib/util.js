
function projectApi(action, payload, callback) {
    ajaxCall('project', action, payload, callback);
}

function sessionApi(action, payload, callback) {
    ajaxCall('session', action, payload, callback);
}

function ajaxCall(api, action, payload, callback) {
    $.ajax({
        type: "GET",
        dataType: "json",
        data: "action="+action+"&payload="+JSON.stringify(payload),
        beforeSend: function(x) {
            if(x && x.overrideMimeType) {
                x.overrideMimeType("application/json;charset=UTF-8");
            }
        },
        url: 'api/'+api+'.js',
        success: function(data) { callback(data) }
    });
}