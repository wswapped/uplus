<!DOCTYPE html>
<html>
<head>
	<title>Okay</title>
</head>
<body>

<div id="result"></div>

<script type="text/javascript">
	var source = new EventSource("mon.php");
	source.onmessage = function(event) {
	    document.getElementById("result").innerHTML += event.data + "<br>";
	};
</script>
</body>
</html>