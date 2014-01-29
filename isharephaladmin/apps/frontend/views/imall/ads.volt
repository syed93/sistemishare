<div class="jun_view_ads">
{{ partial("partials/user_left") }}
<div class="jun_right line">
  <div class="jform_post imall_table">
      <h2>iMall</h2>
      {{ link_to("imall/index", "iMall", "class": "jun_button") }} 
      {{ link_to("imall/myads", "My Ads", "class": "jun_button jun_button_current") }} 
	  {{ link_to("imall/add", "New Ad", "class": "jun_button") }} 
	    {{content()}}
	
  </div>
</div>
</div>