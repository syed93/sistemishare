

<div class="jun_view_ads">
{{ partial("partials/user_left") }}
<div class="jun_right line">
    <div class="jform_post jun_view">
      	<h2>iMall</h2>
      	{{ link_to("imall/index", "iMall", "class": "jun_button jun_button_current") }} 
	  	{{ link_to("imall/myads", "My Ads", "class": "jun_button") }} 
	  	{{ link_to("imall/add", "New Ad", "class": "jun_button") }}
	    
	    
	
		<div class="big_box space_left jun_label">	 
		<div class="jun_step">
		    <h3 class="jun_step_current">Step 1</h3><h3>Step 2</h3><h3>Step 3</h3>
		</div>
		<div class="jun_text_on_form">
			<h3>Step 1 of 3: Fill Up the Insert Ad Form</h3>
			<p>Your ad will be reviewed according to the rules of iMall. After approval, it will be published for a period of 90 days.</p>
			<p>Please post your ads in the correct category. iMall reserves the right to edit or remove images or content that do not follow the rules and regulations. </p>
		</div>
		{{ content() }}   
			{{ form('imall/add', 'method': 'post') }} 
				<label><p>Region </p>
					<select name="region_id" id="selectregion">
					<option value="0">Select Region</option>				
					{% for region in regions %}
					    <option value="{{ region.id }}">{{region.name}}</option>
					{% endfor %}
					</select>
				</label>
				<label><p>Category </p>
				    <select name="category_id" class="category" id="category"> 
					    <option value="0">Select Categories</option>
					    {% for category in categories %}
					        <option value="{{ category.id }}" {%if category.type == 1 %}class="jun_select_parent" value=""disabled{% endif %}>{{category.name}}</option>
					    {% endfor %}
					</select>
					
					
			    </label>
			    <label><p>&nbsp;</p> <span><input type="radio" name="type" value="1"> For Sale 
<input type="radio" name="type" value="2"> For Rent <input type="radio" name="type" value="3"> Wanted
<input type="radio" name="type" value="4"> Wanted To Rent</span>
				</label>
				
				 
		        	<p>&nbsp; </p>{{ submit_button('submit', 'value': 'Next Step', 'class': 'jun_button space_left') }}
				 
		    </form>
		</div>
    </div>
</div>
</div>