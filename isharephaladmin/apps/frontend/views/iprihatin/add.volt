<script type="text/javascript">
$(document).ready(function()
{
    $('#username').autocomplete(
    {
        source: "{{urlajax}}",
        minLength: 2
    });
});
</script>


<div class="jun_view_ads">
{{ partial("partials/user_left") }}
	<div class="jun_right line">
		<div class="jform_post jun_view">
			<h2>iMail inbox</h2>
	        {{ link_to("iprihatin/index", "iPrihatin", "class": "jun_button") }}
	  		{{ link_to("iprihatin/add", "New Post", "class": "jun_button jun_button_current") }}
			
			<div class="jun_messages" id="feedback">
				
			</div>
			{{ content()}}	 
			<div class="jun_reply_message">    
				<form action="" method="POST" enctype="multipart/form-data" >
				{{ text_field("title", "size": 45, "placeholder": "iPrihatin title...") }}
				<textarea name="body" placeholder="Type your message..."></textarea>
				<input type="file" name="image1"/>
				<input type="file" name="image2"/>
				<input type="file" name="image3"/>
				<input class="jun_button" name="Submit" type="submit" value="Post" onClick="submitForm(this)">
				</form>
			</div> 
		</div>
	</div>
</div>



