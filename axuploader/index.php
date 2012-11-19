<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
	<title>File uploader</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="jquery,user interface,ui,widgets,interaction,javascript" />
	<meta name="description" content="Html5 file uploader" />
	<meta name="author" content="AlbanX" />
	
	<script src="jquery.js" type="text/javascript"></script>
	<script src="axuploader.js" type="text/javascript"></script>
	<script>
	$(document).ready(function(){
		$('.prova').axuploader({
			url:'upload.php',
			finish:function(x,files){  },
			enable:true,
			remotePath:function(){
				return 'up_files/';
			}
		});
	});
	</script>
</head>

<body>

<div class="prova"></div>

	<input type="button" onclick="$('.prova').axuploader('disable')" value="asd" />
	<input type="button" onclick="$('.prova').axuploader('enable')" value="ok" />
<div id="debug"></div>
</body>
</html>
