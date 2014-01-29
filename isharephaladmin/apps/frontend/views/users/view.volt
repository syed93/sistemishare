
<div class="jun_view_ads">
<div class="line">
  <div class="jun_view">
      <h2>iShare</h2>{{ link_to("users/logout", "Logout") }}
      
      <div class="line"></div>
      
      
     
      
	    <table>
	    <tr>
	    <th>Username</th> <th>Sponsor</th> <th>Due</th> <th>Reg No</th> <th>Model</th> <th>Year</th>
	    </tr>
		{% for post in views %}
		<tr>
		    
			<td><p>{{ link_to('users/profile/' ~ post.username, post.username) }}</p></td>
			<td><p>{{post.username_sponsor}}</p></td>
			<td><p>{{post.insuran_due_date}}</p></td>
			<td><p>{{post.reg_number}}</p></td>
			<td><p>{{post.model}}</p></td>
			<td><p>{{post.year_make}}</p></td>
		</tr>
		{% endfor %}
		</table>
		<div class="jun_pagination">
		{{ content()}}
		</div>
	
  </div>
</div>
</div>