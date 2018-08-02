<?php

get_header(); ?>

    <div class="row">

            <?php global $post; $post_slug = $post->post_name; $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy')); ?>

            <?php $work = (get_query_var('paged')) ? get_query_var('paged') : 1; ?>
            <?php $work = new WP_Query( array('post_status' => 'publish', 'post_type' => 'trainings', 'posts_per_page' => -1, 'order' => 'DESC', 'tax_query' => array(array('taxonomy' => 'training-category', 'terms' => $term->slug, 'field' => 'slug', 'include_children' => false, 'operator' => 'IN')), 'paged'=>$paged )); ?>

            <?php if ( $work->have_posts() ) : ?>
                <div class="row">
                    <?php while ( $work->have_posts() ) : $work->the_post(); ?>

                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="slide">
                                <div class="thumbnail-section">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <?php the_post_thumbnail( 'full', array( 'class' => 'img-responsive center-block' ) ); ?>
                                    <?php endif; ?>
                                </div>
                                <div class="testimonial-content">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="blog-title">
                                                <h5 class="no-margin"><?php the_title(); ?></h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="testimonial-readmore">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <hr/>
                                            <div class="clearfix gap-very-mini"></div>

                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <a href="<?php the_permalink(); ?>" class="btn-link no-margin"><i class="fa fa-file-text" aria-hidden="true"></i> &nbsp; SEE </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix gap"></div>
                        </div>

                    <?php endwhile; ?>
                </div>
            <?php endif; ?>

            <?php wp_reset_query(); wp_reset_postdata(); ?>

            <?php if(function_exists('wp_pagenavi')){ wp_pagenavi( array( 'query' => $work )); } ?>

            <div class="clearfix gap-ext"></div>
            <div class="row">
                <div class="col-xs-8 col-xs-offset-2">
                    <hr/>
                </div>
            </div>
            <div class="clearfix gap"></div>

            <div class="row">
                <div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                    <a href="javascript:history.go(-1)" class="btn btn-default">Back</a>
                </div>
            </div>

        </div>
    </div>
    <div class="clearfix gap"></div>

<?php get_footer(); ?>