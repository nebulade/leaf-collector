function sessionApi(action, payload, callback) {
    $.ajax({
        type: "POST",
        dataType: "json",
        data: "action="+action+"&payload="+JSON.stringify(payload),
        beforeSend: function(x) {
            if(x && x.overrideMimeType) {
                x.overrideMimeType("application/json;charset=UTF-8");
            }
        },
        url: 'ajax/session.php',
        success: function(data) { callback(data) }
    });
}