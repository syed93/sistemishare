
<div class="section-header">
<div class="jun_left">
<h2>Dear Users</h2>
<p>Your account will be create automatically after your first post. You can logged in and manage your ads next time using email address and password that you entered during first post. Enjoy your free ads, search suppliers, chat with buyers, save favorite sellers and many features.</p>
</div>
<div class="jun_right line">
  <div class="jform_post">
      <h2>Jun.my Create New Account</h2>
      <div class="line"></div>
  {{ content() }}
	{{ form('users/register', 'method': 'post') }}
	    
		<label><span>Full Name:</span>
	        {{ text_field("full_name", "size": 60) }}
		</label>
		<label><span>NRIC:</span>
	        {{ text_field("nric", "size": 60) }}
		</label>
		<label><span>Phone:</span>
	        {{ text_field("phone", "size": 60) }}
		</label>
		<label><span>Email:</span>
	        {{ text_field("email", "size": 60) }}
		</label>
		
		<label><span>Address:</span>
	        {{ text_field("address", "size": 60) }}
		</label>
		<label><span>City:</span>
	        {{ text_field("city", "size": 60) }}
		</label>
		<label><span>Postcode:</span>
	        {{ text_field("postcode", "size": 20) }}
		</label>
		<label><span>Region:</span>
			<select name="region_id" id="selectregion">
			<option value="0">Select Region</option>				
			{% for bottom in bottoms %}
			    <option value="{{ bottom.id }}">{{bottom.name}}</option>
			{% endfor %}
			</select>
		</label>
		<label><span>Password:</span>
	        {{ password_field("password", "size": 20) }} 
		</label>
		<label><span>Retype Password:</span>
	        {{ password_field("retype_password", "size": 20) }}
		</label>
		<label><span></span>
        	{{ submit_button('submit', 'value': 'Next Step') }}
			
	    </label>
    </form>
  </div>
</div>
</div>