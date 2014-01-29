


<div class="jun_view_ads">
{% for user in profiles %}	
    <div class="jun_left">
        <img src="http://localhost/isharedotcomdotmy/isharephal/uploads/profiles/{{user.profile_image}}">
        <ul class="jun_left_menu">
            <li>{{image('img/icons/home.png')}} {{link_to('', 'Home Page')}}</li>
            <li>{{image('img/icons/user.png')}} {{link_to('users/' ~ user.username, user.name)}}</li>
            <li>{{image('img/icons/phone.png')}} {{user.telephone}}</li>
            <li>{{image('img/icons/mail.png')}} {{user.email}}</li>
			<li>{{image('img/icons/place.png')}} {{user.address}}</li>
			<li>{{image('img/icons/date.png')}} {{user.created}}</li>
            <li>{{image('img/icons/disckette.png')}} {{link_to('save/' ~ user.id, 'Save This Ad')}}</li>
            
        </ul>
    </div>

<div class="jun_right line">
  <div class="jform_post">
  
  {{ content() }}
  

      <h2>Insurance Renewal</h2>
      
      <div class="line"></div>
      <div class="jun_menu_top">
      <li><a href="{{back}}">Back</a></li><li>{{ link_to("users/logout", "Logout") }}</li>
      </div>
      
      <div class="jun_label">
        <h2>Renew</h2>
		
        {% for post in updates %}
			{{ form('insuran/renew/'~post.username, 'method': 'post') }}
			    
				<label>  
				    <p>Insurance Premium </p>RM {{ text_field("insuran_amount", "size": 20, "value": post.ins_amount) }}
				</label>
				
				<label>
				    <p>Cukai Jalan </p>RM {{ text_field("road_tax", "size": 20, "value": post.r_amount) }}
				</label>
				
				<label>
				    <p>Nilai Perlindungan </p>RM {{ text_field("cover", "size": 20, "value": post.cover) }}
				</label>
				<label>
				     <p>Servis Caj </p>RM {{ text_field("service_charge", "size": 20, "value": post.charge) }}
				</label>
				<label>
				     <p>Jumlah </p>RM {{ text_field("total", "size": 20, "value": post.total) }}
				</label>
				<label>
				     <p>iWallet </p>RM {{ post.amount }}{{ hidden_field("wallet", "size": 20, "value": post.amount) }}
				</label>
				<label>
				     <p>Jumlah Perlu Dibayar </p>RM {{ amount_to_pay }}{{ hidden_field("amount_to_pay", "size": 20, "value": amount_to_pay) }} 
				</label>
				<label>
				     <p>Tambah iWallet </p>RM {{ text_field("add_iwallet", "size": 20, "placeholder": amount_to_pay) }} 
				</label>
				{{hidden_field("reg_no", "value": post.reg_no)}}
				{{hidden_field("user_id", "value": post.id)}}
				
				
			     
				    {{ submit_button('submit', 'value': 'Renew', 'class': 'jun_button') }}
				
		    </form>
		{% endfor %}
      
      </div>
      
      
      <div class="jun_label">
       <h2>Personal Information</h2> <li>{{link_to('users/edit/' ~ user.username, image('img/icons/edit.png'), 'title': 'Edit Profile')}}</li>
	      <label><p>Sponsor</p>: {{user.username_sponsor}}</label>
	      <label><p>Username</p>: {{user.username}}</label>
	      <label><p>Full Name</p>: {{user.name}}</label>
	      <label><p>NRIC</p>: {{user.nric_new}}</label>
	      <label><p>Next Of Kin</p>: {{user.kin_name}}</label>
	      <label><p>Relation</p>: {{user.relation}}</label>
	      <label><p>Kin NRIC</p>: {{user.nric_new_kin}}</label>
	      <label><p>Account No</p>: {{user.bank_number}}</label>
	      <label><p>Bank Name</p>: {{user.bank_name}}</label>
	      
	      <label><p>Address</p>: {{user.address}}</label>
	      <label><p>Postcode</p>: {{user.postcode}}</label>
	      <label><p>Phone</p>: {{user.telephone}}</label>
	      <label><p>Email</p>: {{user.email}}</label>
	      <label><p>Join Date</p>: {{user.created}}</label>
	   </div>
	   <div class="jun_label">
	   <h2>Vehicle Information</h2><li>{{link_to('users/edit/' ~ user.username, image('img/icons/edit.png'), 'title': 'Edit Profile')}}</li>   
	      <label><p>Previous Insurance</p>: {{user.previous_insuran_company}}</label>
	      <label><p>Cover Note</p>: {{user.cover_note}}</label>
	      <label><p>NCD</p>: {{user.insuran_ncb}}</label>
	      <label><p>Road Tax</p>: {{user.road_tax}}</label>
	      <label><p>Due Date</p>: {{user.insuran_due_date}}</label>
	      
	      <label><p>Reg No</p>: {{user.reg_number}}</label>
	      <label><p>Owner Name</p>: {{user.owner_name}}</label>
	      <label><p>Owner NRIC</p>: {{user.owner_nric}}</label>
	      <label><p>Owner DOB</p>: {{user.owner_dob}}</label>
	      <label><p>Model</p>: {{user.model}}</label>
	      <label><p>Year Make</p>: {{user.year_make}}</label>
	      <label><p>Cubic Capacity</p>: {{user.capacity}}</label>
	      <label><p>Engine No</p>: {{user.engine_number}}</label>
	      <label><p>Chasis No</p>: {{user.chasis_number}}</label>
	      
	      <label><p>Grant Serial</p>: {{user.grant_serial_number}}</label>
	      
      </div>

	
  </div>
</div>
{% endfor %}
</div>