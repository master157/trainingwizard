<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>

		<link href="//www.google-analytics.com" rel="dns-prefetch">
        <link href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon.ico" rel="shortcut icon">
        <link href="<?php echo get_template_directory_uri(); ?>/img/icons/touch.png" rel="apple-touch-icon-precomposed">

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?php bloginfo('description'); ?>">

		<?php wp_head(); ?>
		<script>
        // conditionizr.com
        // configure environment tests
        conditionizr.config({
            assets: '<?php echo get_template_directory_uri(); ?>',
            tests: {}
        });
        </script>

	</head>
	<body <?php body_class(); ?>>

		<!-- wrapper -->
		<div class="page-wrapper">

			<!-- header -->
			<header class="header clear" role="banner">
                <div class="top-bar outer">
                    <div class="inner-container">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-7 col-md-6 col-sm-5 col-xs-5">
                                    <div class="phone v-center">
                                        <i class="fa fa-phone" aria-hidden="true"></i>
                                        <span><?php the_field('general_phone1', 'option'); ?></span>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-6 col-sm-7 col-xs-7">
                                    <div class="search-sign">
                                        <div class="row">
                                            <form action="/search-results/">
                                                <div class="col-md-7 col-sm-7 col-xs-2 col-md-push-0 col-sm-push-0 col-xs-push-10">
                                                    <div class="search-wrapper v-center">
                                                        <div class="search">
                                                            <i class="fa fa-search" aria-hidden="true"></i>
                                                            <input type="text" name="search_query" placeholder="<?php the_field('general_search_placeholder_text', 'option'); ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            <div class="col-md-5 col-sm-5 col-xs-10 col-md-pull-0 col-sm-pull-0 col-xs-pull-2">
                                                <div class="sign-in v-center">
                                                    <div class="inner">
                                                        <i class="fa fa-user-circle" aria-hidden="true"></i>
                                                        <?php if(!is_user_logged_in()):?>
                                                            <a href="<?php echo wp_login_url(); ?>"><?php the_field('general_sign_in_text', 'option'); ?></a>
                                                            <?else:?>
                                                                <span class="user-account">
                                                                    <a href="#">Your account <i class="fa fa-angle-down"></i></a>
                                                                    <div class="dropdown">
                                                                        <a href="/edit-your-profile">Edit your membership</a>
                                                                        <a href="/billing-information">Update payment Method</a>
                                                                        <a href="<?php echo wp_logout_url(); ?>">Sign Out</a>
                                                                    </div>
                                                                </span>
                                                        <?endif?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="main-nav outer">
                    <div class="container">
                        <div class="logo-nav">
                            <div class="row">
                                <div class="col-md-2 col-sm-12">

                                    <div class="m-nav-ico hidden">
                                        <i class="fa fa-bars" aria-hidden="true"></i>
                                    </div>

                                    <!-- logo -->
                                    <div class="logo">
                                        <a href="<?php echo home_url(); ?>">
                                            <?
                                            $logo_top = get_field('general_logo_top', 'option');

                                            if( !empty($logo_top) ): ?>
                                                <img src="<?php echo $logo_top['url']; ?>" alt="<?php echo $logo_top['alt']; ?>" />
                                            <?php endif; ?>
                                        </a>
                                    </div>
                                    <!-- /logo -->
                                </div>

                                <div class="col-md-10 col-sm-12">
                                    <!-- nav -->
                                    <nav class="nav" role="navigation">
                                        <div class="m-nav-close hidden"><i class="fa fa-times" aria-hidden="true"></i></div>
                                        <?php html5blank_nav(); ?>
                                    </nav>
                                    <!-- /nav -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

			</header>
			<!-- /header -->