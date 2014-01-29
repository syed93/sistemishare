<div align="center">
    <div class="blue_top">
	<div id="top-menu">
		<div id="logo">
			{{ link_to("users/index", "<h1>iShare</h1>", "alt": "Go Home") }}
		</div>
		<div id="menu-links">
			<ul id="menu-header-navigation" class="menu">
				<li class="menu-item">
					{{ link_to("users/index", "iDashbord") }}
				</li>
				<li class="menu-item">
					{{ link_to("users/logout", "Logout") }}
				</li>
				<li class="menu-item">
					{{ link_to("charts", "Charts") }}
				</li>
				<li class="menu-item">
					{{ link_to("about", "About") }}
				</li>
			</ul>
		</div>
        <div class="jun_top_icon">
            {{link_to('activations/index', image('img/icons/user.png'), 'id': 'showmenu')}}
		    {{link_to('users/register', image('img/icons/top_mail.png'))}} 
		    {{link_to('users/login', image('img/icons/alert.png'))}}
        </div>
	</div>
	</div>
	{{ content() }}
	<div class="footer">
		Powered by {{ link_to("about", "Develop by Azrul Haris Using Phalcon PHP Framework") }}
	</div>
	
</div>