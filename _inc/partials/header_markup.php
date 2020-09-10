<?php // Header Markup

function o_header_markup() {
	add_action('o_custom_css', function () {
		return '.site-header { background: yellow}';
	}); ?>
	<header class="site-header">
		Some header text just for testing...
	</header>
<?php } ?>
