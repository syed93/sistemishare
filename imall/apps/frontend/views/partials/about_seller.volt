 
<div class="jun_left">
    <h2>iSeller Info<h2>
    {{image('uploads/profiles/' ~ post.profile_image)}}
    <ul class="jun_left_menu">
        <li>{{image('img/icons/home.png')}} {{link_to('', 'Home Page')}}</li>
        <li>{{image('img/icons/user.png')}} {{link_to('users/' ~ post.username, post.username)}}</li>
        <li>{{image('img/icons/phone.png')}} {{post.telephone}}</li>
        <li>{{image('img/icons/mail.png')}} {{post.email}}</li>
		<li>{{image('img/icons/place.png')}} {{post.address}}</li>
		<li>{{image('img/icons/date.png')}} {{post.created}}</li>
        
    </ul>
</div>
 
