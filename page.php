<?php get_header(); ?>


    <div class="page-title">
        <div class="container">
            <h1><?php the_title();?></h1>
        </div>
    </div>

    <div class="page-content">
        <div class="container ">
            <div class="row">
                <div class="col-xs-12">
                    <div class="content">
                        <?php while ( have_posts() ) : the_post(); ?>
                            <?php the_content(); ?>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php get_footer(); ?>