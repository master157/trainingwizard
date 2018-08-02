<?php
    $categories = get_terms( 'training-category');
    $c_term_arr = get_field('tc_c_show');
    $page_template = basename( get_page_template() );
    $need_c_terms = 'training-materials.php' == $page_template;
    $c_term_arr = count($c_term_arr) > 0 ? $c_term_arr : [];
?>

<?php foreach ( $categories as $category ): ?>
    <?php $term_link = get_term_link($category); ?>

    <div class="col col-md-4 col-sm-6">
        <div class="categories-box">
            <?php if(function_exists('get_wp_term_image')) : ?>
            <?php $meta_image = get_wp_term_image($category->term_id); ?>
            <?php if(!empty($meta_image)) : ?>
            <img src="<?php echo $meta_image; ?>" alt="<?php echo $category->name; ?>" class="img-responsive center-block" />
            <div class="clearfix gap-very-mini"></div>
            <span><div><?php echo $category->name; ?></div>
                <a href="<?php echo $term_link?>">View course <span>&#8594;</span></a>
                <?php else : ?>
                    <span class="mid"><?php echo $category->name; ?><div class="clearfix gap-mini"></div><small><?php echo $category->description; ?></small></span>
                <?php endif; ?>
                <?php endif; ?>
        </div>
    </div>
<?php endforeach; wp_reset_postdata(); wp_reset_query(); ?>

<?return?>



<?php foreach ( $categories as $category ): ?>
    <?php $term_link = get_term_link($category); ?>

    <?if($need_c_terms):?>
        <?if(in_array($category->term_id, $c_term_arr)):?>
            <div class="col col-md-4 col-sm-6">
                <div class="categories-box">
                    <?php if(function_exists('get_wp_term_image')) : ?>
                    <?php $meta_image = get_wp_term_image($category->term_id); ?>
                    <?php if(!empty($meta_image)) : ?>
                    <img src="<?php echo $meta_image; ?>" alt="<?php echo $category->name; ?>" class="img-responsive center-block" />
                    <div class="clearfix gap-very-mini"></div>
                    <span><div><?php echo $category->name; ?></div>
                        <a href="<?php echo $term_link?>">View course <span>&#8594;</span></a>
                        <?php else : ?>
                            <span class="mid"><?php echo $category->name; ?><div class="clearfix gap-mini"></div><small><?php echo $category->description; ?></small></span>
                        <?php endif; ?>
                        <?php endif; ?>
                </div>
            </div>
        <?endif?>
    <?else:?>
        <div class="col col-md-4 col-sm-6">
            <div class="categories-box">
                <?php if(function_exists('get_wp_term_image')) : ?>
                <?php $meta_image = get_wp_term_image($category->term_id); ?>
                <?php if(!empty($meta_image)) : ?>
                <img src="<?php echo $meta_image; ?>" alt="<?php echo $category->name; ?>" class="img-responsive center-block" />
                <div class="clearfix gap-very-mini"></div>
                <span><div><?php echo $category->name; ?></div>
                        <a href="<?php echo $term_link?>">View course <span>&#8594;</span></a>
                    <?php else : ?>
                        <span class="mid"><?php echo $category->name; ?><div class="clearfix gap-mini"></div><small><?php echo $category->description; ?></small></span>
                    <?php endif; ?>
                    <?php endif; ?>
            </div>
        </div>
    <?endif?>

<?php endforeach; wp_reset_postdata(); wp_reset_query(); ?>