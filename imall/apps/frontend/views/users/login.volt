
<div class="section-header">
<div class="jun_left">
<h2>Dear Users</h2>
<p>If you already post ad </p>
</div>
<div class="jun_right line">
  <div class="jform_post">
      <h2>Jun.my Free User Login</h2>
      <div class="line"></div>
  {{ content() }}
	{{ form('users/login', 'method': 'post') }}
	    
		<label><span>Email:</span>
	        {{ text_field("email", "size": 60) }}
		</label>
		<label><span>Password:</span>
	        {{ password_field("password", "size": 20) }} 
		</label>
		
		<label><span></span>
        	{{ submit_button('submit', 'value': 'Login') }}
			
	    </label>
    </form>
  </div>
</div>
</div>