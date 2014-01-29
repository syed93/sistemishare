<div class="jun_view_ads">
{{ partial("partials/user_left") }}
<div class="jun_right line">
  <div class="jform_post jun_view">
      <h2>iPrihatin Post</h2>
      {{ link_to("iprihatin/index", "iPrihatin", "class": "jun_button jun_button_current") }} 
	  
	    <table>
	    <tr>
	    <th>Title</th><th>Date</th> <th>Action</th>
	    
	    {% for iprihatin in iprihatins %}
		    <tr>
		        <td>{{link_to("iprihatin/view/" ~ iprihatin.slug, iprihatin.title)}}</td>
		        
		        <td><p>{{iprihatin.created}}</p></td>
		        <td>{{ link_to("iprihatin/view/" ~ iprihatin.slug, "View", "class": "jun_button") }}</td>
		    </tr>
		{% endfor %}
		</table>
		<div class="jun_pagination">
			{{ content()}}
		</div>
	
  </div>
</div>
</div>