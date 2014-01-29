
<div class="section-header">
<div class="jun_left">
<h2>Dear Users</h2>
<p>If you already post ad </p>
</div>
<div class="jun_right line">
  <div class="jform_post">
      <h2>Jun.my Free User Login</h2>
      <div class="line"></div>
  {{ content() }}
	{{ form('users/login', 'method': 'post') }}
	    <fieldset>
	    <table>
		<tr>
		<td><p>Username:</p></td>
	    <td> 
		    {{ text_field("email", "size": 60) }}
		</td>
		</tr>
		<tr>
		<td><p>Password:</p></td>
	    <td> 
		    {{ password_field("password", "size": 20) }}
		</td>
		</tr>
		<tr>
		<td></td>
	    <td> 
		    {{ submit_button('submit', 'value': 'Login') }}
		</td>
		</tr>
		</table>
    </form>
  </div>
</div>
</div>