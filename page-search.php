<?php
/*
Template Name: Search Results
*/

get_header(); ?>

    <div class="page-title">
        <div class="container">
            <h1>Search Results</h1>
        </div>
    </div>

    <div class="c-trainings-list has-sb">
        <div class="container ">

            <div class="row">
                <div class="col-xs-12">
                        <div class="search-box">
                            <?php $hrDocuSearch = new WP_Advanced_Search('hrDocuSearch'); ?>
                            <?php $hrDocuSearch->the_form(); ?>
                        </div>

                    <div class="row">

                         <?php $hrDocuSearch = new WP_Advanced_Search('hrDocuSearch'); $query = $hrDocuSearch->query(); ?>

                        <?php if ( $query->have_posts() ) : ?>

                            <div class="items no-img">

                                    <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                                        <?  $group_access_id = get_post_meta( get_the_ID(), '_user_level_group', true ); ?>
                                        <?if(user_has_access_to_post($group_access_id)):?>
                                        <div class="col col-md-4 col-sm-6">
                                            <div class="categories-box v-center">
                                <span><div><?php the_title(); ?></div>
                                <a href="<?php the_permalink(); ?>">See module</a>
                                            </div>

                                        </div>
                                    <?endif;?>
                                    <?php endwhile; ?>

                            </div>
                        <?php endif; ?>

                        <?php wp_reset_query(); wp_reset_postdata(); ?>

                        <?php if(function_exists('wp_pagenavi')){ wp_pagenavi( array( 'query' => $query )); } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?get_footer();?>