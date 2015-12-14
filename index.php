<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Welcome to Webjia</title>
<style>
body {
	-webkit-font-smoothing: antialiased;
	font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
	font-size: 14px;
	line-height: 1.5;
}
#form-input {
	margin-right: 15px;
	width: 280px;
	height: 25px;
	padding: 2px 5px;
	border-radius: 1px;
	border: 1px solid #ccc;
	outline: none;
	-webkit-appearance: none;
	font-size: 13px;
	margin-top: 10px;
}
#form-submit {
	width: 80px;
	height: 30px;
	border-radius: 1px;
	border: 1px solid #5CB85C;
	background-color: #5CB85C;
	color: white;
	outline: none;
	cursor: pointer;
	-webkit-appearance: none;
	font-size: 13px;
	margin-top: 10px;
}
#contact {
	margin-top: 40px;
	font-size: 13px;
	font-weight: 300;
	font-style: italic;
}
</style>
<script src="jquery.min.js"></script>
<script>
$(document).ready(function() {
	$('form').submit(function() {
		var url = $('#form-input').val();
		location.href = "http://" + location.host + "/fetch.php/" + url.substr(url.indexOf('//') + 2);
		return false;
	});
});
</script>
</head>

<body>
	<p>Webkaka allows you to surf the Internet anonymously. Enter your URL below to get started.</p>
	<form>
		<input id="form-input" type="text" value="http://">
		<input id="form-submit" type="submit" value="Start">
	</form>
	<p id="contact">To report an issue, please contact <a href="mailto:webcraft@163.com">webcraft@163.com</a></p>
</body>
</html>
