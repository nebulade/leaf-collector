<html>
<head>
    <title> Test </title>
</head>

<body>

<link rel="stylesheet" href="lib/jqwidgets/styles/jqx.base.css" type="text/css" />
<script type="text/javascript" src="lib/jquery-1.8.2.js"></script>
<script type="text/javascript" src="lib/jqwidgets/jqxcore.js"></script>
<script type="text/javascript" src="lib/jqwidgets/jqxbuttons.js"></script>
<script type="text/javascript" src="lib/jqwidgets/jqxscrollbar.js"></script>
<script type="text/javascript" src="lib/jqwidgets/jqxlistbox.js"></script>
<script type="text/javascript" src="lib/jqwidgets/jqxdropdownlist.js"></script>

<script language="javascript">

function projectApi(action, payload, callback) {
    $.ajax({
        type: "POST",
        dataType: "json",
        data: "action="+action+"&payload="+JSON.stringify(payload),
        beforeSend: function(x) {
            if(x && x.overrideMimeType) {
                x.overrideMimeType("application/json;charset=UTF-8");
            }
        },
        url: 'ajax/resource.php',
        success: function(data) { callback(data) }
    });
}

</script>

<div id='mainToolBar'>
    <script type="text/javascript">
        $(document).ready(function () {
            var source = [
                "Project 1",
                "Project 2",
                "Project 3"
            ];
            // Create a jqxDropDownList
            $("#jqxdropdownlist").jqxDropDownList({ source: source, selectedIndex: 0, width: '200px', height: '25px' });
            // disable the sixth item.
            $("#jqxdropdownlist").jqxDropDownList('disableAt', 5);
            // bind to 'select' event.
            $('#jqxdropdownlist').bind('select', function (event) {
                var args = event.args;
                var item = $('#jqxdropdownlist').jqxDropDownList('getItem', args.index);
                alert('Selected: ' + item.label);
            });
        });
    </script>
    <div id='jqxdropdownlist'>
    </div>
</div>







<input id="name" type="text"/>
<input id="url" type="text"/>

<div>
    <input type="button" value="List Bookmarks" id='listBookmarkButton'/>
    <input type="button" value="Add Bookmark" id='addBookmarkButton'/>
</div>

<script>
    function addBookmark() {
        var bookmark = {};
        bookmark.name = $("#name").val();
        bookmark.url = $("#url").val();
        projectApi("add", bookmark, function(data) { console.log(data); });
    }

    $("#listBookmarkButton").jqxButton({ width: '150', height: '25'});
    $("#listBookmarkButton").bind('click', function() {
        projectApi("list", {}, function(data) { console.log(data); });
    });

    $("#addBookmarkButton").jqxButton({ width: '150', height: '25'});
    $("#addBookmarkButton").bind('click', function() {
        var bookmark = {};
        bookmark.name = $("#name").val();
        bookmark.url = $("#url").val();
        projectApi("add", bookmark, function(data) { console.log(data); });
    });
</script>

</body>

</html>

