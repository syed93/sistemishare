<div class="jun_view_ads">
{{ partial("partials/user_left") }}
<div class="jun_right line">
  <div class="jform_post jun_view">
      <h4>iPrihatin Post</h4>
      
	  {{ link_to("epins/index", "iPin", "class": "jun_button") }}
	  {{ link_to("epins/add", "Add iPin", "class": "jun_button jun_button_current") }}
      {{ link_to("epins/transfer", "Transfer iPin", "class": "jun_button") }}
      {{ link_to("epins/viewuseripin", "View User iPin", "class": "jun_button") }}
	  {{ link_to("epins/track", "Track", "class": "jun_button") }}
	  
	<div class="jun_label">
		{{ content()}}
     <h4>Generate New iPin</h4>
     {{  form('epins/index', 'method': 'post') }}
      <label>
	    <p>Count </p>{{ text_field("count", "size": 14, "placeholder": "3, 10, 100") }}
	</label>
	<label> 
	    <p>&nbsp;</p>{{ submit_button('submit', 'value': 'Generate') }}
	</label>
	</form>
  </div> 
  	
  </div>
</div>
</div>