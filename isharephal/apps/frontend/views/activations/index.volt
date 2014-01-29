<div class="jun_view_ads">
{{ partial("partials/user_left") }}
<div class="jun_right line">
  <div class="jform_post jun_view">
      <h2>iKomuniti activation</h2>
      
      <div class="line"></div> 
	  
	    <table>
	    <tr>
	    <th>Username</th> <th>Sponsor</th> <th>Due</th> <th>Reg No</th> <th>Model</th> <th>Actions</th>
	    </tr>
		{% for post in views %}
		<tr>
		    
			<td><p>{{ link_to('users/profile/' ~ post.username, post.username) }}</p></td>
			<td><p>{{post.username_sponsor}}</p></td>
			<td><p>{{post.insuran_due_date}}</p></td>
			<td><p>{{post.reg_number}}</p></td>
			<td><p>{{post.model}}</p></td>
			<td><p>{{ link_to("activations/index?ref=" ~ post.email_verification ~ "&activate=bljkX3BjVziItYbEqMZ1SOU2e8Xv6ZuRuTAztmdjVz8fOHeomyeLpuLaIZF4lHT&ntsv=" ~ post.id, "Activate", "class": "jun_button") }}&nbsp;{{ link_to("activations/addtokiv/" ~ post.id, "Problem", "class": "jun_button") }}</p></td>
		</tr>
		{% endfor %}
		</table>
		<div class="jun_pagination">
		{{ content()}}
		</div>
	
  </div>
</div>
</div>