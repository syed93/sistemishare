<div class="jun_view_ads">
{{ partial("partials/user_left") }}
<div class="jun_right line">
  <div class="jform_post jun_view">
      <h2>iPrihatin Post</h2>
      {{ link_to("iprihatin/index", "iPrihatin", "class": "jun_button") }}
	  {{ link_to("iprihatin/add", "New Post", "class": "jun_button") }}
	  {% for iprihatin in iprihatins %}
	  {{ link_to("iprihatin/edit/" ~  iprihatin.slug, "Edit This Post", "class": "jun_button") }}
	  
	    <div class="jun_view_iprihatin">
	    
	    {{ content()}}
		    
	        <h2>{{link_to("iprihatin/view/" ~ iprihatin.slug, iprihatin.title)}}</h2>
	        {% if not (iprihatin.image is empty) %}
			    {{ image("uploads/iprihatins/" ~ iprihatin.image) }} 
			{% endif %}
			   
	        <p>Tarikh {{iprihatin.created}}</p><p>Jumlah Sumbangan <b>RM{{iprihatin.amount}}</b></p>
	        <pre>{{iprihatin.body}}</pre>
		         
		{% endfor %}
		</div> 
	
  </div>
</div>
</div>