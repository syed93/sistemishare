
<div class="jun_view_ads">
{% for user in users %}	
    <div class="jun_left">
        {{image('uploads/profiles/' ~ user.profile_image)}}
        <ul class="jun_left_menu">
            <li>{{image('img/icons/home.png')}} {{link_to('', 'Home Page')}}</li>
            <li>{{image('img/icons/user.png')}} {{link_to('users/' ~ user.username, user.name)}}</li>
            <li>{{image('img/icons/phone.png')}} {{user.telephone}}</li>
            <li>{{image('img/icons/mail.png')}} {{user.email}}</li>
			<li>{{image('img/icons/place.png')}} {{user.address}}</li>
			<li>{{image('img/icons/date.png')}} {{user.created}}</li>
            
        </ul>
    </div>

<div class="jun_right line">
  <div class="jform_post">
      <h4>View Member Profile</h4>
      
      <div class="line"></div>
      <div class="jun_menu_top">
        <div class="button_menu">
	      <a href="edit">{{ submit_button('submit', 'value': 'Edit Profile', 'class': 'jun_button') }}</a>
	      <a href="sms">{{ submit_button('submit', 'value': 'SMS Setting', 'class': 'jun_button') }}</a>
	    </div>
      </div>
      <div class="jun_label">
       <h2>Personal Information</h2> <li>{{link_to('settings/edit', image('img/icons/edit.png'), 'title': 'Edit Profile')}}</li>
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
	   <h2>Vehicle Information</h2><li>{{link_to('settings/edit', image('img/icons/edit.png'), 'title': 'Edit Profile')}}</li>   
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
  {{ content() }}
	
  </div>
</div>
{% endfor %}
</div>