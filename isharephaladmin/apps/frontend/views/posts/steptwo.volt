<div class="section-header">
<div class="jun_left">
<h2>Dear Users</h2>
<p>Your account will be create automatically after your first post. You can logged in and manage your ads next time using email address and password that you entered during first post. Enjoy your free ads, search suppliers, chat with buyers, save favorite sellers and many features.</p>
</div>

<div class="jun_right line">
{{ content() }}
  <div class="jform_post">
	{{ form('posts/steptwo', 'method': 'post') }}	    
		<label><span>Full Name:</span>
	        {{ posts['full_name']|e }}
		</label>
		<label><span>NRIC:</span>
	        {{ posts['nric'] }}
		</label>
		<label><span>Phone:</span>
	        {{ posts['phone'] }}
		</label>
		<label><span>Email:</span>
	        {{ posts['email'] }}
		</label>
		<label><span>Address:</span>
	        {{ posts['address']|e }}
		</label>
		<label><span>Postcode:</span>
	        {{ posts['postcode'] }}
		</label>
		<label><span>Region:</span>
			{{region}}
		</label>
		<label><span>Category:</span>
		    {{category}}
	    </label>
		<label><span>Title:</span>
	        {{ posts['title']|e }}
		</label>
		<label><span>Body:</span>
	        <pre>{{ posts['description']|e }} </pre>
		</label>
		<label><span></span>
        	{{ submit_button('Save') }}
	    </label>
    </form>

  </div>
</div>
</div> 