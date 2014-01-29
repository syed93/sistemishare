<div class="jun_view_ads">
{{ partial("partials/user_left") }}
<div class="jun_right line">
  <div class="jform_post">
      <h4>Generate New iPin</h4> 
      
      {{ link_to("epins/index", "iPin", "class": "jun_button") }}
	  {{ link_to("epins/add", "Add iPin", "class": "jun_button jun_button_current") }}
      {{ link_to("epins/transfer", "Transfer iPin", "class": "jun_button") }}
      {{ link_to("epins/viewuseripin", "View User iPin", "class": "jun_button") }}
	  {{ link_to("epins/track", "Track", "class": "jun_button") }}
      
      
        <div class="big_box space_left jun_label"> 
		{{ content() }}  
		{{  form('epins/add', 'method': 'post') }}
		<label>
		<p>Jumlah iPin </p>{{ text_field("count", "size": 14, "placeholder": "3, 10, 100") }}
		</label> 
		<p>&nbsp;</p>{{ submit_button('submit', 'value': 'Generate', 'class': 'jun_button') }} 
		</form>
      </div>	
  </div>
</div>
</div>