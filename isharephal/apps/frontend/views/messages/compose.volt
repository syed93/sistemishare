<div class="jun_view_ads">
{{ partial("partials/user_left") }}
	<div class="jun_right line">
		<div class="jform_post jun_view">
			<h2>iMail inbox</h2>
			{{ link_to("messages/index", "Inbox", "class": "jun_button") }}
	  {{ link_to("messages/sentitems", "Outbox", "class": "jun_button") }}
	  {{ link_to("messages/compose", "Compose", "class": "jun_button") }}
			<div class="jun_messages">
			
			    
				<div class="jun_pagination">
					{{ content()}}
				</div>
				
			</div>
			<div class="jun_reply_message">    
				<form action="" method="post">
				{{ text_field("username", "id": "username", "size": 45, "placeholder": "username1, username2") }}
				<textarea name="reply" placeholder="Type your message..."></textarea>
				<input type="submit" name="reply" value="Reply" class="jun_button">
				</form>
			</div>
		</div>
	</div>
</div>