
<div class="jun_view_ads">
{{ partial("partials/user_left") }}
<div class="jun_right line">
  <div class="jform_post jun_view">
      <h2>Wallets Management</h2>{{ link_to("users/logout", "Logout") }}
      
      <div class="line"></div>
      <table>
	    <tr>
	   <th>Title</th> <th>Amount</th> <th>Reference</th> <th>Created</th> <th>Type</th>
	    </tr>
		{% for hist in views %}
		<tr>
		    
			<td><p>{{hist.title}}</p></td>
			<td><p>{{hist.amount}}</p></td>
			<td><p>{{hist.reference}}</p></td>
			<td><p>{{hist.created}}</p></td>
			<td><p>{{hist.type}}</p></td>
		    
		</tr>
		
		{% endfor %}
		<tr>
		    <td><p>Balance </p></td>
			<td><p>RM{{wallet}}</p></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		</table>
		<div class="jun_pagination">
		{{ content()}}
		</div>
      {{ content() }}
	  	
  </div>
</div>
</div>