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

                    <div class="search-box">
                        <?php $hrDocuSearch = new WP_Advanced_Search('hrDocuSearch'); ?>
                        <?php $hrDocuSearch->the_form(); ?>
                    </div>

                    <section class="c-trainings-list no-padding-bottom">
                        <div class="container">

                            <h2 class="section-title"><?php the_field('c_courses_available_title', 'option')?></h2>

                            <div class="row">
                                <div class="items">
                                    <?php get_template_part( 'content', 'trainings-list' ); ?>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>

<?php get_footer(); ?>