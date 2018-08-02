<?php if( current_user_can('administrator') == false and current_user_can('subscriber') == false ) : ?>
    <section class="home-section-3 outer">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="text">
                    <p class="title"><?php the_field('want_to_try_our_training_title', 'option'); ?></p>
                    <p class="description"><?php the_field('want_to_try_our_training_title_description', 'option'); ?></p>
                    <a href="/register" class="c-btn c-btn-primary">Get started</a>
                </div>
            </div>
            <div class="col-md-6 hidden-sm hidden-xs">
                <div class="left-img" style="background-image:url(<?php the_field('want_to_try_our_training_title_image', 'option'); ?>)"></div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
