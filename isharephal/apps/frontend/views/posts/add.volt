<script type="text/javascript">
$(document).ready(function() {
    $(".category").change(function() {
        var category=$(this).val();
        var dataString = 'category='+ category;
        $.ajax ({
            type: "POST",
            url: "{{urlajax}}",
            data: dataString,
            cache: false,
            success: function(html) {
               $(".sell_option").html(html);
            } 
        });
     });
 }); 
</script>
<div class="section-header">
<div class="jun_left">
<h2>Dear Users</h2>
<p>Your account will be create automatically after your first post. You can logged in and manage your ads next time using email address and password that you entered during first post. Enjoy your free ads, search suppliers, chat with buyers, save favorite sellers and many features.</p>
</div>
<div class="jun_right line">
  <div class="jform_post">
      <h4>iMall</h4>
      <div class="line"></div>
  {{ content() }}
	{{ form('posts/new', 'method': 'post') }}
	    
		<label><span>Full Name:</span>
	        {{ text_field("full_name", "size": 60, "placeholder": "Ahmad Bin Abu") }}
		</label>
		<label><span>NRIC:</span>
	        {{ text_field("nric", "size": 60, "placeholder": "801230105455") }}
		</label>
		<label><span>Phone:</span>
	        {{ text_field("phone", "size": 60, "placeholder": "01234567890") }}
		</label>
		<label><span>Email:</span>
	        {{ text_field("email", "size": 60,  "placeholder": "nama@email.com") }}
		</label>
		<label><span>Password:</span>
	        {{ password_field("password", "size": 20) }} 
		</label>
		<label><span>Retype Password:</span>
	        {{ password_field("retype_password", "size": 20) }}
		</label>
		<label><span>Address:</span>
	        {{ text_field("address", "size": 60) }}
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
		<label><span>Category:</span>
		    <select name="category_id" class="category" id="category">
		    <option value="0">Select Categories</option>
			{% for cat in cats %}
			    <option value="{{ cat.id }}">{{cat.name}}</option>
			{% endfor %}
			</select><div class="sell_option"></div>
	    </label>
	    <label><span>Price:</span>
	       RM {{ text_field("price", "size": 10, "maxlength": 12, "placeholder": "0.00") }}
		</label>
		<label><span>Title:</span>
	        {{ text_field("title", "size": 60, "minlength": 10, "placeholder": "Ie: Toyota Wish Auto 2012") }}
		</label>
		<label><span>Body:</span>
	        {{ text_area("description") }}
		</label>
		<label><span></span>
        	{{ submit_button('submit', 'value': 'Next Step') }}
			
	    </label>
    </form>
  </div>
</div>
</div>