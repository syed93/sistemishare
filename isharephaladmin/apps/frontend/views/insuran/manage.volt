
<div class="jun_view_ads">
<div class="line">
  <div class="jun_view">
      <h4>iManagement</h4>
      
      <div class="line"></div>
      
      <div class="imanagement_menu">
	      {{ link_to("insuran/manage", "iManagement", "class": "jun_button jun_button_current") }}
	      {{ link_to("insuran/quotation", "Updated", "class": "jun_button") }}
	      {{ link_to("insuran/kiv", "Problems", "class": "jun_button") }}
	      {{ link_to("insuran/done", "Done", "class": "jun_button") }}
      </div>
      
      <div class="search_form">
      <form action="" method="GET">
        <p>Carian <input type="text" name="query" placeholder="Username/Reg No/Phone">
        
		<input type="submit" name="submit" value="Search"></p>
		</form>
		
      </div>
      
      <div class="search_form right">
      <form action="" method="GET">
        <p>Dari Tarikh <input type="text" name="from" id="datepicker_from">
        Hingga Tarikh <input type="text" name="to" id="datepicker_to">
        
		<input type="submit" name="submit_date" value="Search"></p>
		</form>
		
      </div>
      
	    <table>
	    <tr>
	    <th>Username</th><th>Reg No</th><th>Telephone</th> <th>Due</th> <th>Insuran</th> <th>Roadtax</th> <th>Wallet</th> <th>Total</th> <th>Year</th> <th>Action</th>
	    </tr>
		{% for post in views %}
		<tr>
		    
			<td><p>{{ link_to('users/profile/' ~ post.username, post.username) }}</p></td>
			<td><p>{{post.reg_no}}</p></td>
			<td><p>{{post.tel}}</p></td>
			<td><p>{{post.due}}</p></td>
			<td><p>{{post.ins_amount}}</p></td>
			<td><p>{{post.r_amount}}</p></td>
			<td><p>{{post.amount}}</p></td>
			<td><p>{{post.total}}</p></td>
			 
			<td><p>{{post.year}}</p></td>
			<td><p>{{ link_to("insuran/update/" ~ post.username, "Update", "class": "jun_button") }} &nbsp; 
			{{ link_to("insuran/addtokiv/" ~ post.id, "Problem", "class": "jun_button") }}</p></td>
		</tr>
		{% endfor %}
		</table>
		<div class="jun_pagination">
		{{ content()}}
		
		</div>
	
  </div>
</div>
</div>