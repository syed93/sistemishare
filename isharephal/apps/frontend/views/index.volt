<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html>
	<head>
		{{ get_title() }}
		{{ stylesheet_link("css/style.css") }}
		{{ stylesheet_link("css/jquery-ui.css") }}
		{{ javascript_include("js/jquery.min.js") }} 
		{{ javascript_include("js/jquery.maphilight.min.js") }} 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		
		{{ javascript_include("js/jquery-ui.js") }}
		 
        {{ javascript_include("js/ajax-message.js") }} 
		
		<script>
		    $(function() { $('.map').maphilight(); });
		</script>
		<script>
		$(function() {
		$( "#datepicker_from" ).datepicker({dateFormat: "yy-mm-dd", stepMonths: 12});
		});
		$(function() {
		$( "#datepicker_to" ).datepicker({dateFormat: "yy-mm-dd", stepMonths: 12});
		});
		</script>
	</head>
	<body>
		{{ content() }}
	</body>
</html>