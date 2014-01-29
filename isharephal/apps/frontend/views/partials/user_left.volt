{% for user in users %}	
    <div class="jun_left">
        <h2>iProfile<h2>
        {{image('uploads/profiles/' ~ user.profile_image)}}
        <ul class="jun_left_menu">
            <li>{{image('img/icons/home.png')}} {{link_to('', 'Home Page')}}</li>
            <li>{{image('img/icons/user.png')}} {{link_to('users/' ~ user.username, user.name)}}</li>
            <li>{{image('img/icons/phone.png')}} {{user.telephone}}</li>
            <li>{{image('img/icons/mail.png')}} {{user.email}}</li>
			<li>{{image('img/icons/place.png')}} {{user.address}}</li>
			<li>{{image('img/icons/date.png')}} {{user.created}}</li>
            
        </ul>
    </div>
{% endfor %}