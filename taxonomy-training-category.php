<?php

get_header(); ?>

    <div class="page-title">
        <div class="container">
            <h1><?php single_term_title(); ?></h1>



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

                        <?php global $post; $post_slug = $post->post_name; $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy')); ?>

                        <?php $work = (get_query_var('paged')) ? get_query_var('paged') : 1; ?>
                        <?php $work = new WP_Query( array('post_status' => 'publish', 'post_type' => 'trainings', 'posts_per_page' => -1, 'order' => 'DESC', 'tax_query' => array( array('taxonomy' => 'training-category', 'terms' => $term->slug, 'field' => 'slug', 'include_children' => false, 'operator' => 'IN')), 'paged'=>$paged )); ?>

                        <?php if ( $work->have_posts() ) : ?>
                            <div class="items no-img">

                                <?php while ( $work->have_posts() ) : $work->the_post(); ?>
                                    <? $group_access_id = get_post_meta( get_the_ID(), '_user_level_group', true ); ?>
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
                            <?endif;?>
                        <?php //endif; ?>

                        <?php wp_reset_query(); wp_reset_postdata(); ?>

                        <?php if(function_exists('wp_pagenavi')){ wp_pagenavi( array( 'query' => $work )); } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?get_footer();?>