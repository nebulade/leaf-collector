<html>
<head>
    <title> Test </title>
</head>

<body>

<link rel="stylesheet" href="lib/jquery-ui.css">
<script src="lib/jquery-1.8.2.js"></script>
<script src="lib/jquery-ui.js"></script>

<script language="javascript">


function echo() {

var postData ="message=Some message";
    $.ajax({
        type: "POST",
        dataType: "json",
        data: postData,
        beforeSend: function(x) {
            if(x && x.overrideMimeType) {
                x.overrideMimeType("application/json;charset=UTF-8");
            }
        },
        url: 'ajax/echo.php',
        success: function(data) {
            // 'data' is a JSON object which we can access directly.
            // Evaluate the data.success member and do something appropriate...
            alert($("#output") + " - " + data);
            if (data.success == true){
                $("#output").text(data.message);
            }
            else{
                $("#output").text(data.message);
            }
        }
    });
}

</script>

<a href="javascript: echo();">Hello World!</a>

<div id="output">Result</div>

<div id="myButton">
Hello World
</div>

<script>
$("#myButton").button();
$("#myButton").click(function() { echo(); });
</script>

</body>

</html>

