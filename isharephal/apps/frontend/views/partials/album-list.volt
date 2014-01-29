
<table class="albums-index">
	{% set n = 1 %}
	<tr>
	{% for region in regions %}
		<td valign="top">
			<div class="album-name">
				{{ link_to('album/' ~ region.id ~ '/' ~ region.name, '<img src="' ~ region.name ~ '" alt="' ~ region.name ~ '"/>') }}
			</div>
			<div class="album-name">
				{{ link_to('album/' ~ region.id ~ '/' ~ region.name, region.name) }}
			</div>
			<div class="artist-name">
				{{ link_to('artist/' ~ region.id ~ '/' ~ region.id, region.name) }}
			</div>
		</td>
		{% if (n % 6) == 0 %}
			</tr><tr>
		{% endif %}
		{% set n = n + 1 %}
	{% endfor %}
</table>