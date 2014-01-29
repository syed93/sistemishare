<script type="text/javascript">
$(document).ready(function()
{
    $('#username').autocomplete(
    {
        source: "{{urlajax}}",
        minLength: 2
    });
});
</script>
<div class="jun_view_ads">
{{ partial("partials/user_left") }}
<div class="jun_right line">
  <div class="jform_post">
      <h4>iPin Transfer</h4>
      
	  {{ link_to("epins/index", "iPin", "class": "jun_button") }}
	  {{ link_to("epins/add", "Add iPin", "class": "jun_button") }}
      {{ link_to("epins/transfer", "Transfer iPin", "class": "jun_button jun_button_current") }}
      {{ link_to("epins/viewuseripin", "View User iPin", "class": "jun_button") }}
	  {{ link_to("epins/track", "Track", "class": "jun_button") }}
	  
	<div class="big_box space_left jun_label">
		{{ content()}}
     {% if hide == 0 %}
         {{  form('epins/transfer', 'method': 'post') }} 
        <label>
		    <p>Jumlah ePin</p>{{ text_field("count", "size": 24) }}
		</label>
		<label>
		    <p>Username penerima</p>{{ text_field("username", "size": 24, "id": "username") }}
		</label>
		<label>
		    <p>Kod Transaksi</p>{{ password_field("master_key", "size": 24) }}
		</label>
		 
		    <p>&nbsp;</p>{{ submit_button('submit', 'value': 'Langkah Seterusnya', 'class': 'jun_button') }}
		 
		</form>
		{% endif %}
  </div> 
  	
  </div>
</div>
</div>