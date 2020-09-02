<?php // Footer Template

            if ( function_exists( 'hfe_is_before_footer_enabled' ) && hfe_is_before_footer_enabled()) {
                hfe_render_before_footer();
            }

            if ( function_exists( 'hfe_footer_enabled' ) && hfe_footer_enabled() ) {
                hfe_render_footer();
            } else { ?>
                <footer class="site-footer">
                    Default theme footer will go here
                </footer>
            <?php } ?>
        </div><!-- /.site-wrap -->
        <?php wp_footer(); ?>
    </body>
</html>