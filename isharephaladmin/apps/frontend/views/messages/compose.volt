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
			{{ link_to("messages/index", "Inbox", "class": "jun_button") }}
	  {{ link_to("messages/sentitems", "Outbox", "class": "jun_button") }}
	  {{ link_to("messages/compose", "Compose", "class": "jun_button") }}
			
			<div class="jun_messages" id="feedback">
				
			</div>
			{{ content()}}	
			{% for user in users %}
			<div class="jun_reply_message">    
				<form name="frm" onsubmit="return(false)">
				{{ text_field("name", "id": "username", "size": 45, "placeholder": "username") }}
				{{hidden_field("from_user_id", "value": "" ~ user.id)}}
				<textarea name="comment" placeholder="Type your message..."></textarea>
				<input class="jun_button" name="Submit" type="submit" value="Hantar" onClick="submitForm(this)">
				</form>
			</div>
			{% endfor %}
		</div>
	</div>
</div>



