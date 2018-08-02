
<?php //$categories = get_terms( 'document-category', array( 'exclude' => array(54, 55))); ?>
<?php foreach ( $categories as $category ): ?>
    <?php $term_link = get_term_link($category); ?>
    <a href="<?php echo esc_url($term_link); ?>">
        <div class="categories-box">
            <?php if(function_exists('get_wp_term_image')) : ?>
                <?php $meta_image = get_wp_term_image($category->term_id); ?>
                <?php if(!empty($meta_image)) : ?>
                    <img src="<?php echo $meta_image; ?>" alt="<?php echo $category->name; ?>" class="img-responsive center-block" />
                    <div class="clearfix gap-very-mini"></div>
                    <span><?php echo $category->name; ?><div class="clearfix gap-mini"></div><small><?php echo $category->description; ?></small></span>
                <?php else : ?>
                    <span class="mid"><?php echo $category->name; ?><div class="clearfix gap-mini"></div><small><?php echo $category->description; ?></small></span>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </a>
<?php endforeach; wp_reset_postdata(); wp_reset_query(); ?>
</div>