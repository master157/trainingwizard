<?php /* Template Name: Training materials */ get_header(); ?>

<div class="t-tpl-training-materials">

    <section class="c-benefits">
        <div class="container">
            <div class="top">
                <h1><?php the_title(); ?></h1>
                <?if(!is_user_logged_in()):?>
                    <a href="/register" class="c-btn c-btn-primary">Sign up now</a>
                <?endif?>
            </div>
                <div class="container _items">
                    <div class="row">
                        <div class="items">
                            <?php

                            if( have_rows('training_materials_benefits_repeater', 'option') ):
                                while ( have_rows('training_materials_benefits_repeater','option') ) : the_row();
                                    //the_sub_field('sub_field_name');
                                    ?>
                                        <div class="col col-md-4 col-sm-4">
                                            <div class="item">
                                                <img src="<? the_sub_field('training_materials_benefits_repeater_ico'); ?>">
                                                <h4><? the_sub_field('training_materials_benefits_repeater_title'); ?></h4>
                                                <p><? the_sub_field('training_materials_benefits_repeater_description'); ?></p>
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
        </div>
    </section>

    <section class="c-benefits-list has-padding-top">
        <div class="container">
            <h2><?php the_field('training_materials_benefits_2_title', 'option');?></h2>
            <p class="description"><?php the_field('training_materials_benefits_2_description','option');?></p>

            <div class="items">

                <?php
                $index = 0;
                if( have_rows('training_materials_benefits_2_repeater','option') ):
                    while ( have_rows('training_materials_benefits_2_repeater','option') ) : the_row();
                        $index++;
                        ?>
                            <?if($index % 2 == 0){?>
                                <div class="item">
                                    <div class="row row-eq-height">
                                        <div class="col-md-6 v-center">
                                        <span class="text">
                                            <h4><?php the_sub_field('training_materials_benefits_2_repeater_title');?></h4>
                                            <p><?php the_sub_field('training_materials_benefits_2_repeater_description');?></p>
                                        </span>
                                        </div>
                                        <div class="col-md-6">
                                            <img src="<?php the_sub_field('training_materials_benefits_2_repeater_image'); ?>">
                                        </div>
                                    </div>
                                </div>
                            <?} else{
                                ?>

                                <div class="item">
                                    <div class="row row-eq-height">
                                        <div class="col-md-6">

                                            <img src="<?php the_sub_field('training_materials_benefits_2_repeater_image'); ?>">
                                        </div>
                                        <div class="col-md-6 v-center">
                                    <span class="text">
                                        <h4><?php the_sub_field('training_materials_benefits_2_repeater_title');?></h4>
                                        <p><?php the_sub_field('training_materials_benefits_2_repeater_description');?></p>
                                    </span>
                                        </div>
                                    </div>
                                </div>

                                <?
                            }?>

                        <?
                    endwhile;
                else :
                    // no rows found
                endif;

                ?>
            </div>
    </section>

    <section class="c-quote outer row-eq-height">
        <div class="b-img">
            <img src="<?php the_field('quote_image', 'option'); ?>">
        </div>
        <div class="b-text">
            <div class="q-ico">“</div>
            <div class="q-text">
                <?php the_field('quote_text', 'option'); ?>
            </div>
            <p><?php the_field('quote_author', 'option'); ?></p>
        </div>
    </section>

    <section class="c-trainings-list tm">
        <div class="container">

            <h2 class="section-title"><?php the_field('c_courses_available_title', 'option')?></h2>
            <p class="section-description"><?php the_field('c_courses_available_description', 'option')?></p>

            <div class="row">
                <div class="items">
                    <?php get_template_part( 'content', 'trainings-list' ); ?>
                </div>
            </div>
        </div>
    </section>

    <?php get_footer(); ?>
</div>