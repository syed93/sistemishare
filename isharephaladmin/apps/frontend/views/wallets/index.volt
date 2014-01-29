<script type="text/javascript">
$(document).ready(function()
{   $('#username').autocomplete(
    {   source: "{{ajaxurl}}",
        minLength: 2
    });
});
</script>
<div class="jun_view_ads">
{{ partial("partials/user_left") }}
<div class="jun_right line">
  <div class="jform_post">
      <h2>Wallets Management</h2> 
      <div class="big_box space_left jun_label">
         <h4>iWallet</h4>
          <p>RM<b>{{wallet}}</b></p>
      </div>
      
        <div class="big_box space_left jun_label">
        <h4>Tambah iWallet</h4>
		{{ content() }}
		{% if hideform == 1 %}
			
		{% else %}
        <form action="" method="GET">
        <label>
		    <p>Username</p>{{ text_field("username", "size": 14, "id": "username") }}
		</label>
		<label>
		    <p>Jumlah RM</p>{{ text_field("amount", "size": 14, "placeholder": "0.00") }}
		</label>
		
		{{ submit_button('submit', 'name': 'submit', 'value': 'Langkah Seterusnya', 'class': 'jun_button') }}
		
		</form>
		{% endif %}
      </div>	
  </div>
</div>
</div>