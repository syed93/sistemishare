<div class="jun_view_ads">
{{ partial("partials/user_left") }}
<div class="jun_right line">
  <div class="jform_post jun_view">
      <h2>iMail inbox</h2>
      
      {{ link_to("messages/index", "Inbox", "class": "jun_button") }}
	  {{ link_to("messages/sentitems", "Outbox", "class": "jun_button") }}
	  {{ link_to("messages/compose", "Compose", "class": "jun_button") }}
	  
	    <table>
	    <tr>
	    <th>From</th> <th>Messages</th> <th>Date</th> <th>Time</th>
	    </tr>
		
		{{ content()}}
		</table>
		<div class="jun_pagination">
		
		</div>
	
  </div>
</div>
</div>