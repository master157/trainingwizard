<?php /* Template Name: Home */
get_header();
?>

<main role="main">
    <section class="home-section-1 outer">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                    <div class="img-wrap">
                        <div class="img-wrap-inner">
                            <img src="<?php the_field('home_page_header_background_image'); ?>">
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 ">
                    <div class="text">
                        <h1 class="title"><?php the_field('home_page_header_title'); ?></h1>
                        <p class="description"><?php the_field('home_page_header_description'); ?></p>
                        <?php if(!is_user_logged_in()): ?>
                            <a href="<?php the_field('home_page_header_btn_link'); ?>" class="c-btn c-btn-primary"><?php the_field('home_page_header_btn_text'); ?></a>
                        <?endif?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="home-section-2 outer">
        <div class="container">
            <h2 class="title"><?php the_field('home_page_seaction_2_title'); ?></h2>
            <p class="sub-title"><?php the_field('home_page_seaction_2_description'); ?></p>

            <div class="items">
                <div class="row">

                    <?php
                        if( have_rows('home_page_seaction_2_repeater') ):

                            while ( have_rows('home_page_seaction_2_repeater') ) : the_row();
                                ?>
                                    <div class="col-md-4">
                                        <div class="item">
                                            <div class="img">
                                                <img src="<? the_sub_field('home_page_seaction_2_repeater_ico');?>">
                                            </div>
                                            <div class="text">
                                                <span><? the_sub_field('home_page_seaction_2_repeater_title');?></span>
                                                <h4><? the_sub_field('home_page_seaction_2_repeater_usertype');?></h4>
                                                <p><? the_sub_field('home_page_seaction_2_repeater_description');?></p>
                                            </div>
                                            <div class="features">
                                                <p class="title"><? the_sub_field('home_page_seaction_2_repeater_features_title');?></p>
                                                <? the_sub_field('home_page_seaction_2_features_repeater_items');?>
                                            </div>
                                            <div class="bottom">
                                                <a href="<? the_sub_field('home_page_seaction_2_repeater_button_link');?>" class="c-btn c-btn-secondary"><? the_sub_field('home_page_seaction_2_button_repeater_caption');?></a>
                                            </div>
                                        </div>
                                </div>
                                <?

                            endwhile;
                        else :
                            // no rows found
                        endif;
                    ?>

                </div>
            </div>
        </div>
    </section>

    <?php include_component('section-3');?>

    <?/*
    <section class="home-section-3 outer">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="text">
                        <p class="title"><?php the_field('home_page_section3_title'); ?></p>
                        <p class="description"><?php the_field('home_page_header_section3_description'); ?></p>
                        <a href="<?php the_field('home_page_section3_btn_link'); ?>" class="c-btn c-btn-primary"><?php the_field('home_page_section_3_btn_text'); ?></a>
                    </div>
                </div>
                <div class="col-md-6 hidden-sm hidden-xs">
                    <div class="left-img" style="background-image:url(<?php the_field('home_page_section3_background_image'); ?>)"></div>
                </div>
            </div>
        </div>
    </section>
    */?>

    <section class="home-section-4 outer">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6 ">
                    <div class="block-left">
                        <div class="title"><?php the_field('home_page_section4_title'); ?></div>
                        <?
                        $home_section_4_img = get_field('home_page_section4_background_image');

                        if( !empty($home_section_4_img) ): ?>
                            <img src="<?php echo $home_section_4_img['url']; ?>" alt="<?php echo $home_section_4_img['alt']; ?>" />
                        <?php endif;
                        ?>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="description"><?php the_field('home_page_header_section4_description'); ?></div>

                    <?
                        if( have_rows('home_page_seaction_4_repeater') ):
                            ?><ul><?
                                while ( have_rows('home_page_seaction_4_repeater') ) : the_row();

                                    ?>
                                        <li>
                                            <div class="item-title"><? the_sub_field('home_page_seaction_4_repeater_title') ?></div>
                                            <div class="item-description"><? the_sub_field('home_page_seaction_4_repeater_description') ?></div>
                                        </li>
                                    <?

                                endwhile;
                            ?></ul><?

                        else :
                            // no rows found
                        endif;
                    ?>
                </div>
            </div>
        </div>
    </section>

    <?php include_component('contact-us');?>

<?php get_footer(); ?>