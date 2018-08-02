<?/*
<a class="download-link" title="<?php if ( $dlm_download->get_version()->has_version_number() ) {
    printf( __( 'Version %s', 'download-monitor' ), $dlm_download->get_version()->get_the_version_number() );
} ?>" href="<?php $dlm_download->the_download_link(); ?>" rel="nofollow">
    <?php $dlm_download->the_title(); ?>
    (<?php printf( _n( '1 download', '%d downloads', $dlm_download->get_download_count(), 'download-monitor' ), $dlm_download->get_download_count() ) ?>)
</a>
*/?>

<a href="<?php $dlm_download->the_download_link(); ?>" class="c-btn c-btn-secondary">download</a>