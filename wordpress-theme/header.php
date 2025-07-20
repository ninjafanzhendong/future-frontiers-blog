<?php
/**
 * The header for our theme
 *
 * @package Future_Frontiers_HQ
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    
    <?php wp_head(); ?>
    
    <!-- Preconnect to Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="<?php echo get_template_directory_uri(); ?>/favicon.svg">
    <link rel="alternate icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'future-frontiers-hq'); ?></a>

    <header id="masthead" class="site-header">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div class="site-branding flex items-center">
                    <?php
                    $custom_logo_id = get_theme_mod('custom_logo');
                    $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
                    
                    if (has_custom_logo()) {
                        echo '<div class="custom-logo">';
                        the_custom_logo();
                        echo '</div>';
                    } else {
                        ?>
                        <div class="site-logo">
                            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                                <div class="w-10 h-10 bg-gradient-to-br from-[#00D4FF] to-[#FF006E] rounded-lg flex items-center justify-center">
                                    <span class="text-white font-bold text-xl">F</span>
                                </div>
                            </a>
                        </div>
                        <?php
                    }
                    ?>
                    <div>
                        <h1 class="site-title">
                            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                                <?php bloginfo('name'); ?>
                            </a>
                        </h1>
                        <p class="site-description"><?php bloginfo('description'); ?></p>
                    </div>
                </div>

                <nav id="site-navigation" class="main-navigation">
                    <button class="menu-toggle md:hidden" aria-controls="primary-menu" aria-expanded="false">
                        <span class="sr-only"><?php esc_html_e('Primary Menu', 'future-frontiers-hq'); ?></span>
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'menu_id' => 'primary-menu',
                        'container_class' => 'hidden md:flex space-x-8',
                        'fallback_cb' => false,
                    ));
                    ?>
                </nav>
            </div>
        </div>
    </header>

    <?php if (is_front_page()) : ?>
        <!-- Hero Section -->
        <section class="hero-section py-16" style="background: linear-gradient(135deg, rgba(0, 212, 255, 0.1), rgba(255, 0, 110, 0.1));">
            <div class="container mx-auto px-4">
                <div class="hero-content text-center">
                    <h1 class="hero-title text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                        <?php echo esc_html(get_theme_mod('hero_title', 'The Future is Now')); ?>
                    </h1>
                    <p class="hero-subtitle text-xl text-gray-600 max-w-3xl mx-auto">
                        <?php echo esc_html(get_theme_mod('hero_subtitle', 'Discover groundbreaking innovations, space exploration breakthroughs, and AI advancements shaping our tomorrow.')); ?>
                    </p>
                </div>
            </div>
        </section>
    <?php endif; ?>
</div>
