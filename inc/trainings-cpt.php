<?php

function elmscre_hrdocuments() {
    $labels = array(
        'name'               => _x( 'Trainings', 'post type general name' ),
        'singular_name'      => _x( 'Training', 'post type singular name' ),
        'add_new'            => _x( 'Add New', 'Training' ),
        'add_new_item'       => __( 'Add New Training' ),
        'edit_item'          => __( 'Edit Training' ),
        'new_item'           => __( 'New Training' ),
        'all_items'          => __( 'All Training' ),
        'view_item'          => __( 'View Training' ),
        'search_items'       => __( 'Search Training' ),
        'not_found'          => __( 'No Training found' ),
        'not_found_in_trash' => __( 'No Training found in the Trash' ),
        'parent_item_colon'  => '',
        'menu_name'          => 'Trainings'
    );
    $args = array(
        'labels'        => $labels,
        'description'   => 'Shows all of the Trainings',
        'public'        => true,
        'menu_position' => 41,
        //'menu_icon'     => get_stylesheet_directory_uri() . '/img/documents-icon.svg',
        'supports'      => array( 'title', 'excerpt', 'editor', 'thumbnail' ),
        //'taxonomies'    => array( 'document-type', 'document-category', 'document-sector', 'document-pricing' ),
        'taxonomies'    => array('training-category'),
        //'register_meta_box_cb' => 'add_work_meta',
        'has_archive'   => false,
        '_builtin'      => false,
        'capability_type' => 'post',
        'rewrite'       => array('slug' => 'trainings', true)
    );
    register_post_type( 'trainings', $args );
}
add_action( 'init', 'elmscre_hrdocuments' );

/*
function document_type() {
    $labels = array(
        'name' => _x( 'Type', 'taxonomy general name' ),
        'singular_name' => _x( 'Types', 'taxonomy singular name' ),
        'search_items' =>  __( 'Search Types' ),
        'all_items' => __( 'All Categories' ),
        'parent_item' => __( 'Parent Type' ),
        'parent_item_colon' => __( 'Parent Type:' ),
        'edit_item' => __( 'Edit Type' ),
        'update_item' => __( 'Update Type' ),
        'add_new_item' => __( 'Add New Type' ),
        'new_item_name' => __( 'New Type Name' ),
        'menu_name' => __( 'Type' ),
    );

    register_taxonomy('document-type', array('hrdocuments'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_tagcloud' => false,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'document-type', 'with_front' => false)
    ));
}
add_action( 'init', 'document_type', 0 );
*/

function training_category() {
    $labels = array(
        'name' => _x( 'Category', 'taxonomy general name' ),
        'singular_name' => _x( 'Category', 'taxonomy singular name' ),
        'search_items' =>  __( 'Search Categories' ),
        'all_items' => __( 'All Categories' ),
        'parent_item' => __( 'Parent Category' ),
        'parent_item_colon' => __( 'Parent Category:' ),
        'edit_item' => __( 'Edit Category' ),
        'update_item' => __( 'Update Category' ),
        'add_new_item' => __( 'Add New Category' ),
        'new_item_name' => __( 'New Category Name' ),
        'menu_name' => __( 'Categories' ),
    );

    register_taxonomy('training-category', array('trainings'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_tagcloud' => false,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'training-category', 'with_front' => false)
    ));
}
add_action( 'init', 'training_category', 0 );

function training_type() {
    $labels = array(
        'name' => _x( 'Type', 'taxonomy general name' ),
        'singular_name' => _x( 'Type', 'taxonomy singular name' ),
        'search_items' =>  __( 'Search Types' ),
        'all_items' => __( 'All Types' ),
        'parent_item' => __( 'Parent Type' ),
        'parent_item_colon' => __( 'Parent Type:' ),
        'edit_item' => __( 'Edit Type' ),
        'update_item' => __( 'Update Type' ),
        'add_new_item' => __( 'Add New Type' ),
        'new_item_name' => __( 'New Type Name' ),
        'menu_name' => __( 'Type' ),
    );

    register_taxonomy('training-type', array('trainings'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_tagcloud' => false,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'training-type', 'with_front' => false)
    ));
}
add_action( 'init', 'training_type', 0 );

/*
function document_sector() {
    $labels = array(
        'name' => _x( 'Sector', 'taxonomy general name' ),
        'singular_name' => _x( 'Sector', 'taxonomy singular name' ),
        'search_items' =>  __( 'Search Categories' ),
        'all_items' => __( 'All Categories' ),
        'parent_item' => __( 'Parent Sector' ),
        'parent_item_colon' => __( 'Parent Sector:' ),
        'edit_item' => __( 'Edit Sector' ),
        'update_item' => __( 'Update Sector' ),
        'add_new_item' => __( 'Add New Sector' ),
        'new_item_name' => __( 'New Sector Name' ),
        'menu_name' => __( 'Sectors' ),
    );

    register_taxonomy('document-sector', array('hrdocuments'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_tagcloud' => false,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'document-sector', 'with_front' => false)
    ));
}
add_action( 'init', 'document_sector', 0 );

function document_pricing() {
    $labels = array(
        'name' => _x( 'Pricing', 'taxonomy general name' ),
        'singular_name' => _x( 'Pricing', 'taxonomy singular name' ),
        'search_items' =>  __( 'Search Pricing' ),
        'all_items' => __( 'All Pricing' ),
        'parent_item' => __( 'Parent Pricing' ),
        'parent_item_colon' => __( 'Parent Pricing:' ),
        'edit_item' => __( 'Edit Pricing' ),
        'update_item' => __( 'Update Pricing' ),
        'add_new_item' => __( 'Add New Pricing' ),
        'new_item_name' => __( 'New Pricing Name' ),
        'menu_name' => __( 'Pricing Categories' ),
    );

    register_taxonomy('document-pricing', array('hrdocuments'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_tagcloud' => false,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'document-pricing', 'with_front' => false)
    ));
}
add_action( 'init', 'document_pricing', 0 );
*/
/*
// Add Metabox
function add_work_meta() {
    add_meta_box('my-pdf-one', 'Document Details', 'pdf_link', 'hrdocuments', 'normal', 'high');
    //add_meta_box('elmscre_accordion', 'Accordion Information', 'elmscre_accordion', 'hrdocuments', 'normal', 'high');
}

// MS Word Dropdown
function pdf_link(){
    ?>

    <style>
        .metabox-properties { width:100%; height:auto; margin:0; padding:10px 0; overflow:hidden; }
        .metabox-properties td { width:48%; }
        .metabox-properties td select { width:100%; }
    </style>

    <?php
    global $post;
    $custom = get_post_custom($post->ID);
    $embedCode = get_post_meta($post->ID, '_embedcode', true);
    $downloadCode = get_post_meta($post->ID, '_downloadcode', true);
    $downloadLevel = get_post_meta($post->ID, '_downloadlevel', true);
    ?>

    <table class="metabox-properties">
        <tr>
            <td><label style="padding:0px 0px 4px"><strong>Embed Code</strong></label></td>
            <td><input type='text' name='_embedcode' value='<?php echo $embedCode ?>' class='widefat' /></td>
        </tr>
        <tr>
            <td><label style="padding:0px 0px 4px"><strong>Download ID</strong></label></td>
            <td><input type='text' name='_downloadcode' value='<?php echo $downloadCode ?>' class='widefat' /></td>
        </tr>
        <tr>
            <td><label style="padding:0px 0px 4px"><strong>Download Level</strong></label></td>
            <td><select name="_downloadlevel" id="_downloadlevel">
                    <option value="">- Please select a Subscription Level -</option>
                    <option value='essential' <?php selected($downloadLevel, 'essential'); ?>>Essential</option>
                    <option value='premium' <?php selected($downloadLevel, 'premium'); ?>>Premium</option>
                </select>
            </td>
        </tr>
    </table>
    <div style="clear:both"></div>

    <?php
}

//  Save Details
function save_work_formats(){
    global $post;

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE){
        return $post->ID;
    }

    $documents_meta['_embedcode'] = $_POST['_embedcode'];
    $documents_meta['_downloadcode'] = $_POST['_downloadcode'];
    $documents_meta['_downloadlevel'] = $_POST['_downloadlevel'];

    foreach ($documents_meta as $key => $value) {
        if($post->post_type == 'revision') return;
        $value = implode(',', (array)$value);
        if(get_post_meta($post->ID, $key, FALSE)) {
            update_post_meta($post->ID, $key, $value);
        }else{
            add_post_meta($post->ID, $key, $value);
        }
        if(!$value) delete_post_meta($post->ID, $key);
    }
}
add_action('save_post', 'save_work_formats');

// Create Additional Metabox
function elmscre_accordion() {
    global $post;
    echo '<input type="hidden" name="accordion" id="accordion" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
    $additional0 = get_post_meta($post->ID, '_additional0', true);
    $additional1 = get_post_meta($post->ID, '_additional1', true);
    $additional2 = get_post_meta($post->ID, '_additional2', true);
    $additional3 = get_post_meta($post->ID, '_additional3', true);
    $additional4 = get_post_meta($post->ID, '_additional4', true);

    wp_editor( $additional0, '_additional0', array( 'wpautop' => true, 'media_buttons' => false, 'textarea_name' => '_additional0', 'textarea_rows' => 10, 'teeny' => true ));
    wp_editor( $additional1, '_additional1', array( 'wpautop' => true, 'media_buttons' => false, 'textarea_name' => '_additional1', 'textarea_rows' => 10, 'teeny' => true ));
    wp_editor( $additional2, '_additional2', array( 'wpautop' => true, 'media_buttons' => false, 'textarea_name' => '_additional2', 'textarea_rows' => 10, 'teeny' => true ));
    wp_editor( $additional3, '_additional3', array( 'wpautop' => true, 'media_buttons' => false, 'textarea_name' => '_additional3', 'textarea_rows' => 10, 'teeny' => true ));
    wp_editor( $additional4, '_additional4', array( 'wpautop' => true, 'media_buttons' => false, 'textarea_name' => '_additional4', 'textarea_rows' => 10, 'teeny' => true ));
}

// Save Additional Data
function elmscre_save_accordion($post_id, $post) {
    if (!wp_verify_nonce( $_POST['accordion'], plugin_basename(__FILE__) )) {
        return $post->ID;
    }
    if (!current_user_can( 'edit_post', $post->ID ))
        return $post->ID;

    if(isset($_POST['_additional0']) && $_POST['_additional0'] != '')
        update_post_meta($post_id, '_additional0', $_POST['_additional0']);
    else
        delete_post_meta($post_id, '_additional0');
    $accordion_meta['_additional0'] = $_POST['_additional0'];

    if(isset($_POST['_additional1']) && $_POST['_additional1'] != '')
        update_post_meta($post_id, '_additional1', $_POST['_additional1']);
    else
        delete_post_meta($post_id, '_additional1');
    $accordion_meta['_additional1'] = $_POST['_additional1'];

    if(isset($_POST['_additional2']) && $_POST['_additional2'] != '')
        update_post_meta($post_id, '_additional2', $_POST['_additional2']);
    else
        delete_post_meta($post_id, '_additional2');
    $accordion_meta['_additional2'] = $_POST['_additional2'];

    if(isset($_POST['_additional3']) && $_POST['_additional3'] != '')
        update_post_meta($post_id, '_additional3', $_POST['_additional3']);
    else
        delete_post_meta($post_id, '_additional3');
    $accordion_meta['_additional3'] = $_POST['_additional3'];

    if(isset($_POST['_additional4']) && $_POST['_additional4'] != '')
        update_post_meta($post_id, '_additional4', $_POST['_additional4']);
    else
        delete_post_meta($post_id, '_additional4');
    $accordion_meta['_additional4'] = $_POST['_additional4'];


    foreach ($accordion_meta as $key => $value) {
        if($post->post_type == 'revision') return;
        $value = implode(',', (array)$value);
        if(get_post_meta($post->ID, $key, FALSE)) {
            update_post_meta($post->ID, $key, $value);
        }else{
            add_post_meta($post->ID, $key, $value);
        }
        if(!$value) delete_post_meta($post->ID, $key);
    }
}
add_action('save_post', 'elmscre_save_accordion', 1, 2);
*/
?>