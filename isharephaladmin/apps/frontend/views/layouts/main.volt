<div align="center">
	<div id="top-menu">
		<div id="logo">
			{{ link_to("index", "<h1>iShare</h1>", "alt": "Go Home") }}
		</div>
		<div id="menu-links">
			<ul id="menu-header-navigation" class="menu">
				<li class="menu-item">
					{{ link_to("users/index", "iDashboard") }}
				</li>
				<li class="menu-item">
					{{ link_to("users/view", "iKomuniti") }}
				</li>
				<li class="menu-item">
					{{ link_to("insuran/manage", "iTakaful") }}
				</li>
				<li class="menu-item">
					{{ link_to("users/logout", "Logout") }}
				</li>
			</ul>
		</div>
        <div class="jun_post_button">
        {{link_to('posts/new', image('img/ad_button.png'))}}
		{{link_to('users/register', image('img/register_button.png'))}} 
		{{link_to('users/login', image('img/login_button.png'))}}
        </div>
	</div>
	{{ content() }}
	<div class="footer">
		Powered by {{ link_to("about", "Develop by Azrul Haris Using Phalcon PHP Framework") }}
	</div>
</div>