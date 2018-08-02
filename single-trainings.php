<?php

get_header(); ?>
    <?php $group_access_id = get_post_meta( get_the_ID(), '_user_level_group', true ); ?>
    <div class="page-title">
        <div class="container">
            <h1><?php the_title();?></h1>
        </div>
    </div>

    <div class="page-content">
        <div class="container ">
            <div class="row">
                <div class="col-xs-12">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="inner block-info">

                                <h2>About</h2>

                                <div class="content">
                                    <?php while ( have_posts() ) : the_post(); ?>
                                        <?php the_content(); ?>
                                    <?php endwhile; ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="inner additional-block">
                                <?php if(!is_user_logged_in()):?>
                                    <h2>Register or sign in to download this Module</h2>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6"><a href="/register" class="c-btn c-btn-secondary">Create an account</a></div>
                                        <div class="col-md-6 col-sm-6"><a href="<?php echo wp_login_url(); ?>" class="c-btn c-btn-primary sign-in">Sign in</a></div>
                                    </div>

                                <?else:?>

                                <h2>Downloads</h2>
                                <ul>
                                    <li>
                                        <h4>TRAINER NOTES & HANDOUT (PDF)</h4>
                                        <?if( !can_download($group_access_id) ):?>
                                            <a href="/edit-your-profile" class="c-btn c-btn-3">Upgrade your level to continue</a>
                                        <?else:?>
                                            <?php echo do_shortcode('[download id="'.get_field('trainer_notes___handout_pdf').'" template="custom"]');?>
                                        <?endif;?>


                                    </li>
                                    <li>
<!--                                        <h4>Positive Action Cards (PDF)</h4>-->
                                        <h4><?php echo get_field('positive_action__cards_pdf_title');?></h4>
                                        <?php //echo do_shortcode('[download id="'.get_field('positive_action__cards_pdf').'" template="custom"]');?>
                                        <a href=" <?php echo get_field('positive_action__cards_pdf');?>" class="c-btn c-btn-secondary">download</a>
                                    </li>
                                    <?//if(pmpro_hasMembershipLevel(array('7','8'))):?>
                                        <li>
                                            <h3>Pro & Pro+ Members only</h3>
                                            <h4>Trainer notes & Handout (Word)</h4>
                                            <?if( can_download($group_access_id, true) ):?>
                                                <?php echo do_shortcode('[download id="'.get_field('trainer_notes___handout_word').'" template="custom"]');?>
                                                <?else:?>
                                                <a href="/edit-your-profile" class="c-btn c-btn-3">Upgrade your level to Pro, Pro+</a>
                                            <?endif?>

                                        </li>
                                    <?//endif?>
                                </ul>
                            </div>
                            <?endif?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

<?get_footer();?>