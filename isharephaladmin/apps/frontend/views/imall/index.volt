
<div class="jun_view_ads">
{{ partial("partials/user_left") }}
<div class="jun_right line">
  <div class="jform_post imall_table">
      <h4>iPin All</h4>
      
	  {{ link_to("imall/index", "Activate Ads", "class": "jun_button jun_button_current") }}
	  {{ link_to("imall/listing", "Ads", "class": "jun_button") }}
      {{ link_to("imall/transfer", "Transfer iPin", "class": "jun_button") }}
      {{ link_to("imall/viewuseripin", "View User iPin", "class": "jun_button") }}
	  {{ link_to("imall/track", "Track", "class": "jun_button") }}
 
	    {{content()}}
	
  </div>
</div>
</div> 