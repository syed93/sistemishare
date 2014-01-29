
<div class="jun_view_ads">
{% for user in users %}	
    <div class="jun_left">
        <img src="http://localhost/isharedotcomdotmy/isharephal/uploads/profiles/{{user.profile_image}}">
        <ul class="jun_left_menu">
            <li>{{image('img/icons/home.png')}} {{link_to('', 'Home Page')}}</li>
            <li>{{image('img/icons/user.png')}} {{link_to('users/' ~ user.username, user.name)}}</li>
            <li>{{image('img/icons/phone.png')}} {{user.telephone}}</li>
            <li>{{image('img/icons/mail.png')}} {{user.email}}</li>
			<li>{{image('img/icons/date.png')}} {{user.created}}</li>
			<li>{{image('img/icons/date.png')}} {{user.nsurance_due_date}}</li>
        </ul>
    </div>

<div class="jun_right line">
  <div class="jform_post">
      <h4>iProfile</h4>
      
      <div class="line"></div>
      
      <div class="jun_label">
      {{ content() }}
      {{ form('users/login', 'method': 'post') }}
       <h2>Personal Information</h2> <li>{{link_to('settings/edit/', image('img/icons/edit.png'), 'title': 'Edit Profile')}}</li>
	      
		  <label><p>Sponsor</p>: {{ user.username_sponsor }}</label>
	      <label><p>Username</p>: {{ user.username }}</label>
	      <label><p>Full Name</p>: {{ text_field("name", "size": 30, "value": user.name ) }}</label>
	      <label><p>NRIC</p>: {{ text_field("nric", "size": 30, "value": user.nric_new) }}</label>
	      <label><p>Next Of Kin</p>: {{ text_field("next_of_kin", "size": 30, "value": user.kin_name)}}</label>
	      <label><p>Relation</p>: {{ text_field("relation", "size": 30, "value": user.relation)}}</label>
	      <label><p>Kin NRIC</p>: {{ text_field("kin_nric", "size": 30, "value": user.nric_new_kin)}}</label>
	      <label><p>Account No</p>: {{ text_field("account_no", "size": 30, "value": user.bank_number)}}</label>
	      <label><p>Bank Name</p>: {{ text_field("bank_name", "size": 30, "value": user.bank_name)}}</label>
	      
	      <label><p>Address</p>: {{ text_field("address", "size": 30, "value": user.address)}}</label>
	      <label><p>Postcode</p>: {{ text_field("postcode", "size": 30, "value": user.postcode)}}</label>
	      <label><p>Phone</p>: {{ text_field("telephone", "size": 30, "value": user.telephone)}}</label>
	      <label><p>Email</p>: {{ text_field("email", "size": 30, "value": user.email)}}</label>
	      
	   </div>
	   <div class="jun_label">
	   <h2>Vehicle Information</h2><li>{{link_to('settings/edit/', image('img/icons/edit.png'), 'title': 'Edit Profile')}}</li>   
	      <label><p>Previous Insurance</p>: {{ text_field("previous_insurance", "size": 30, "value": user.previous_insuran_company) }}</label>
	      <label><p>Cover Note</p>: {{ text_field("cover_note", "size": 30, "value": user.cover_note) }}</label>
	      <label><p>NCD</p>: {{ text_field("ncd", "size": 30, "value": user.insuran_ncb ) }}</label>
	      <label><p>Road Tax</p>: {{ text_field("road_tax_amount", "size": 30, "value": user.road_tax) }}</label>
	      <label><p>Due Date</p>: {{ user.insuran_due_date }}</label>
	      
	      <label><p>Reg No</p>: {{ user.reg_number }}</label>
	      <label><p>Owner Name</p>: {{ text_field("owner_name", "size": 30, "value": user.owner_name) }}</label>
	      <label><p>Owner NRIC</p>: {{ text_field("owner_nric", "size": 30, "value": user.owner_nric) }}</label>
	      <label><p>Owner DOB</p>: {{ text_field("owner_dob", "size": 30, "value": user.owner_dob) }}</label>
	      <label><p>Model</p>: {{ text_field("model", "size": 30, "value": user.model) }}</label>
	      <label><p>Year Make</p>: {{ text_field("year_make", "size": 30, "value": user.year_make) }}</label>
	      <label><p>Cubic Capacity</p>: {{ text_field("cubic_capacity", "size": 30, "value": user.capacity) }}</label>
	      <label><p>Engine No</p>: {{ text_field("engine_no", "size": 30, "value": user.engine_number) }}</label>
	      <label><p>Chasis No</p>: {{ text_field("chasis_no", "size": 30, "value": user.chasis_number) }}</label>
	      
	      <label><p>Grant Serial</p>: {{ text_field("grant_serial", "size": 30, "value": user.grant_serial_number) }}</label>
	      <label><p>&nbsp;</p> {{ submit_button('submit', 'value': 'Update', 'class': 'jun_button') }}</label>
      </div>
      </form>
  
	
  </div>
</div>
{% endfor %}
</div>