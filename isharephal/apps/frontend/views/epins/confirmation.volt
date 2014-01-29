
<div class="jun_view_ads">
{{ partial("partials/user_left") }}
<div class="jun_right line">
  <div class="jform_post">
      <h2>Wallets Management</h2>{{ link_to("users/logout", "Logout") }}
      
      <div class="line"></div>
      
      {{ content() }}
      
      <div class="big_box space_left jun_label">
         <h4>Pindah ePin</h4>
         {{  form('epins/transfer', 'method': 'post') }}
        <label>
		    <p>Jumlah ePin</p>{{ text_field("count", "size": 14) }}
		</label>
		<label>
		    <p>Username penerima</p>{{ text_field("username", "size": 14, "id": "username") }}
		</label>
		<label> 
		    <p>&nbsp;</p>{{ submit_button('submit', 'value': 'Next Step') }}
		</label>
		</form>
      </div>

      
  
	
  </div>
</div>
</div>