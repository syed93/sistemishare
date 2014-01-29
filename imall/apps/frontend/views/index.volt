<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html>
	<head>
		{{ get_title() }}
		{{ stylesheet_link("css/style.css") }}
		{{ javascript_include("js/jquery.min.js") }}
		{{ javascript_include("js/thumbimage.js") }} 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	</head>
	<body>
		{{ content() }}
	</body>
</html>