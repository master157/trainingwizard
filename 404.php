<?php get_header(); ?>

<div class="page-title">
    <div class="container">
        <h1>404</h1>
    </div>
</div>

<div class="page-content">
    <div class="container ">
        <div class="row">
            <div class="col-xs-12">
                <div class="content">
                    <h1><?php _e( 'Page not found', 'html5blank' ); ?></h1>
                    <h2>
                        <a href="<?php echo home_url(); ?>"><?php _e( 'Return home?', 'html5blank' ); ?></a>
                    </h2>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>