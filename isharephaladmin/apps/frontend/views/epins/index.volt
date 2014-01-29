
<div class="jun_view_ads">
{{ partial("partials/user_left") }}
<div class="jun_right line">
  <div class="jform_post jun_view">
      <h4>iPin All</h4>
      
	  {{ link_to("epins/index", "iPin", "class": "jun_button jun_button_current") }}
	  {{ link_to("epins/add", "Add iPin", "class": "jun_button") }}
      {{ link_to("epins/transfer", "Transfer iPin", "class": "jun_button") }}
      {{ link_to("epins/viewuseripin", "View User iPin", "class": "jun_button") }}
	  {{ link_to("epins/track", "Track", "class": "jun_button") }}
	  
	<table>
	    <tr>
		 <th>iPin</th> <th>Used</th> <th>Owner</th>  <th>Transfer History</th><th>Created</th>
	    </tr>
		{% for pin in epins %}
		<tr>
		    <td><p>{{pin.epin}}</p></td>
			<td><p>{{pin.used_username}}</p></td>
			<td><p>{{pin.username}}</p></td> 
		    <td><p>{{pin.last_owner}}</p></td>
			<td><p>{{pin.created}}</p></td>
		</tr>
		{% endfor %}
		</table>
		<div class="jun_pagination">
		{{ content()}}
		</div>
  	
  </div>
</div>
</div>