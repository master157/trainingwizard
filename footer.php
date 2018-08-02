			<!-- footer -->
            <?php if(!is_user_logged_in() && !is_front_page()):?>
                <?php include_component('section-3');?>
                <?php include_component('contact-us');?>
            <?endif?>
			<footer class="footer" role="contentinfo">

                <div class="container">
                    <div class="row">
                        <div class="col col-md-3">
                            <?php dynamic_sidebar('footer1'); ?>
                        </div><!--  .col-md-4 -->
                        <div class="col col-md-3">
                            <?php dynamic_sidebar('footer2'); ?>
                        </div><!--  .col-md-4 -->
                        <div class="col col-md-3">
                            <?php dynamic_sidebar('footer3'); ?>
                        </div><!--  .col-md-4 -->
                        <div class="col col-md-3">
                            <?php dynamic_sidebar('footer4'); ?>
                        </div><!--  .col-md-4 -->
                    </div><!--  .row -->
                </div>
                <?php
                
                    //$pmpro_levels = pmpro_getAllLevels(false, true);
                    //$pmpro_level_order = pmpro_getOption('level_order');
                    //print_r($pmpro_level_order);
                    ?>
			</footer>
			<!-- /footer -->
		</div>
		<!-- /wrapper -->

		<?php wp_footer(); ?>

	</body>
</html>
