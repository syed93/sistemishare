
<div class="jun_view_ads">
{{ partial("partials/user_left") }}
<div class="jun_right line">
  <div class="jform_post">
      <h4>iWallets</h4>
      
      <div class="line"></div>
      
      {{ content() }}

      <div class="big_box space_left jun_label">
         <h4>My iWallet</h4>
          <p>RM<b>{{wallet}}</b></p>
      </div>
      
      <div class="big_box space_left jun_label">
         <h4>Add iWallet</h4>
         {{  form('wallets/add/', 'method': 'get') }}
          <label>
		    <p>Amount RM</p>{{ text_field("add_amount", "size": 14, "placeholder": "0.00") }}
		</label>
		<label>
		     <p>Type</p><select name="type">
		       <option value="0">Select</option>
		       <option value="manual">Manual Transfer</option>
		       <option value="auto">Online Payment</option>
		       <option value="cc">Credit Card</option>
		    </select>
		</label>
		<label> 
		    <p>&nbsp;</p>{{ submit_button('submit', 'value': 'Next Step', 'class': 'jun_button') }}
		</label>
		</form>
      </div>

      
  
	
  </div>
</div>
</div>