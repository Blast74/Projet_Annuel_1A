<?php
session_start();

 ?>
<html>
<head>
<script>
var idSession = '<?php echo $_SESSION["id"]; ?>'
function showHint(str) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "echoAjaxTest.php?access_token=" + str, true);
        xmlhttp.send();
    }
    console.log(idSession);
</script>
</head>
<body>

<p><b>Start typing a name in the input field below:</b></p>
<form>
First name: <input type="button" onclick="showHint(idSession)">
</form>
<p>Suggestions: <span id="txtHint"></span></p>
</body>
</html>
