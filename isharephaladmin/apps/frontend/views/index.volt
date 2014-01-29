<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html>
	<head>
		{{ get_title() }}
		{{ stylesheet_link("css/style.css") }}
		{{ javascript_include("js/jquery.js") }} 
		{{ javascript_include("js/jquery.autosize.js") }}
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<!--Date Picker-->
		{{ stylesheet_link("css/jquery-ui.css") }}
		{{ javascript_include("js/jquery-ui.js") }}
		{{ javascript_include("js/jquery.form.js") }} 
        {{ javascript_include("js/ajax-message.js") }} 

		<script>
		$(function() {
		$( "#datepicker_from" ).datepicker({changeMonth: true,
      changeYear: true, dateFormat: "yy-mm-dd", stepMonths: 12});
		});
		$(function() {
		$( "#datepicker_to" ).datepicker({changeMonth: true,
      changeYear: true, dateFormat: "yy-mm-dd", stepMonths: 12});
		});
		</script>
	</head>
	<body>
		{{ content() }}
	</body>
</html>