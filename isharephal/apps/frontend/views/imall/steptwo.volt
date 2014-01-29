

<div class="jun_view_ads">
{{ partial("partials/user_left") }}
<div class="jun_right line">
    <div class="jform_post jun_view">
      	<h2>iMall</h2>
      	{{ link_to("imall/index", "iMall", "class": "jun_button jun_button_current") }} 
	  	{{ link_to("imall/add", "New Ad", "class": "jun_button") }} 
	    
	    
	
		<div class="big_box space_left jun_label">	 
		<div class="jun_step">
		    <h3>Step 1</h3><h3 class="jun_step_current">Step 2</h3><h3>Step 3</h3>
		</div>
		<div class="jun_text_on_form">
			<h3>Step 2 of 3: Fill Up the Title and Description</h3>
			<p>Your ad will be reviewed according to the rules of iMall. After approval, it will be published for a period of 90 days.</p>
			<p>Please post your ads in the correct category. iMall reserves the right to edit or remove images or content that do not follow the rules and regulations. </p>
		</div>
		{{ content() }}   
			<form method="post" action="" enctype="multipart/form-data">
				<label><p>Region </p>
				    {% for region in regions %}
						{{ region.name }}
					{% endfor %}
				</label>
				<label><p>Category </p>
				    {% for category in categories %}
				        {{category.name}}
					{% endfor %}
					
			    </label>
			    <label><p>Ad Type </p> 
			        {% if type == 1 %} 
					    For sale
					{% elseif type == 2 %}
					    For Rent
					{% elseif type == 3 %}
					    Wanted
					{% elseif type == 4 %}
					    Wanted To Rent
					{% endif %}
				</label>
				{% if type == 1 %} 
					<label>
					    <p>Price <span class="red">*</span> RM</p>{{text_field('price', 'size': 16, 'placeholder': '0.00')}}
					    <select name="item_condition">
						<option value="0">Item Condition</option>
						<option value="New">New</option>
						<option value="Used">Used</option>
						</select>
					</label>
				{% endif %}
				<label>
				    <p>Item Location <span class="red">*</span></p>{{text_field('location', 'size': 60, 'placeholder': 'Petaling Jaya')}}
				</label>
				<label>
				    <p>Title <span class="red">*</span></p>{{text_field('title', 'size': 60, 'placeholder': 'Proton Preve Turbo 2013 Auto')}}
				</label>
				<label>
				    <p>Description <span class="red">*</span></p>{{text_area('body', 'cols': 40)}}
				</label>
				<label>
				    <p>Optional </p><input type="file" name="image[]"/>
				</label> 
				<label>
				    <p>Optional</p><input type="file" name="image[]"/>
				</label> 
				<label>
				    <p>Optional </p><input type="file" name="image[]"/>
				</label> 
				<label>
				    <p>Optional </p><input type="file" name="image[]"/>
				</label>  
		        	<p> </p>{{ submit_button('submit', 'value': 'Next Step', 'class': 'jun_button space_left') }}
				 
		    </form>
		</div>
    </div>
</div>
</div>