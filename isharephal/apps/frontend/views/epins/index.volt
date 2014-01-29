<div class="jun_view_ads">
{{ partial("partials/user_left") }}
<div class="jun_right line">
  <div class="jform_post jun_view">
    <h4>iPin informations</h4>
    {{ link_to("epins/index", "My iPin", "class": "jun_button jun_button_current") }}
	{{ link_to("epins/buy", "Buy iPin", "class": "jun_button") }}
	{{ link_to("epins/transfer", "Transfer iPin", "class": "jun_button") }} 
	{{ link_to("epins/track", "Track", "class": "jun_button") }} 
      {{ content()}}

	    <table>
	    <tr>
	    <th>Id</th> <th>iPin</th> <th>Status</th> <th>Status</th> <th>Created</th>  
	    </tr>
		{% for pin in epins %}
		<tr>
		    
			<td><p>{{pin.id}}</p></td>
			<td><p>{{pin.epin}}</p></td>
			<td><p>{% if pin.used_username is empty %} Available {% else %} {{pin.used_username}} {% endif %}</p></td>
			<td><p>{{pin.status}}</p></td>
			<td><p>{{pin.created}}</p></td> 
		</tr>
		{% endfor %}
		</table>
		<div class="jun_pagination">
		{{paginationUrl}}
		</div>
	
  </div>
</div>
</div>