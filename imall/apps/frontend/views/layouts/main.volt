<div align="center">
	<div id="top-menu">
		<div id="logo">
			{{ link_to("index", "<h1>iMall</h1>", "alt": "Go Home") }}
		</div>
		<div id="menu-links">
			<ul id="menu-header-navigation" class="menu">
				<li class="menu-item">
					{{ link_to("index", "Home") }}
				</li>
				<li class="menu-item">
					<a href="http://localhost/isharedotcomdotmy/isharephal/users/index">Users Area</a>
				</li>
				<li class="menu-item">
					{{ link_to("charts", "Charts") }}
				</li>
				<li class="menu-item">
					{{ link_to("about", "About") }}
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