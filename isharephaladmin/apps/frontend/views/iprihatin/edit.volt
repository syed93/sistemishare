<div class="jun_view_ads">
{{ partial("partials/user_left") }}
<div class="jun_right line">
  <div class="jform_post jun_view">
      <h2>iPrihatin Post</h2>
      {{ link_to("iprihatin/index", "iPrihatin", "class": "jun_button") }}
	  {{ link_to("iprihatin/add", "New Post", "class": "jun_button") }} 
	    <div class="jun_view_iprihatin"> 
		{% for iprihatin in iprihatins %}    
	        <h2>{{link_to("iprihatin/view/" ~ iprihatin.slug, iprihatin.title)}}</h2>
	        {% if not (iprihatin.image is empty) %}
			    {{ image("uploads/iprihatins/" ~ iprihatin.image) }} 
			{% endif %}
			   
	        <p>Date {{iprihatin.created}}</p>
	        {{ content() }}
	        <form action="" method="POST">
			<textarea name="body">{{iprihatin.body}}</textarea>
		    <input type="submit" name="submit" value="Save" class="jun_button">
		    </form>
		{% endfor %}
		</div> 
  </div>
</div>
</div>