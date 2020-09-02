<?php // Footer Template

            if ( function_exists( 'hfe_is_before_footer_enabled' ) && hfe_is_before_footer_enabled()) {
                hfe_render_before_footer();
            }

            if ( function_exists( 'hfe_footer_enabled' ) && hfe_footer_enabled() ) {
                hfe_render_footer();
            } else {
	            o_footer_markup();
            } ?>
        </div><!-- /.site-wrap -->
        <?php wp_footer(); ?>
    </body>
</html>