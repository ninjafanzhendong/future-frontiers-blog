<?php
/**
 * The main template file
 *
 * @package Future_Frontiers_HQ
 */

get_header(); ?>

<main id="primary" class="site-main">

    <?php if (is_front_page()) : ?>
        <!-- Hero Section -->
        <section class="hero-section">
            <div class="container mx-auto px-4">
                <div class="hero-content">
                    <h1 class="hero-title">
                        <?php echo esc_html(get_theme_mod('hero_title', 'The Future is Now')); ?>
                    </h1>
                    <p class="hero-subtitle">
                        <?php echo esc_html(get_theme_mod('hero_subtitle', 'Discover groundbreaking innovations, space exploration breakthroughs, and AI advancements shaping our tomorrow.')); ?>
                    </p>
                </div>
            </div>
        </section>

        <!-- Featured Post -->
        <?php
        $featured_post = new WP_Query(array(
            'posts_per_page' => 1,
            'meta_key' => 'featured_post',
            'meta_value' => '1'
        ));
        
        if ($featured_post->have_posts()) :
            while ($featured_post->have_posts()) : $featured_post->the_post();
                get_template_part('template-parts/content', 'featured');
            endwhile;
            wp_reset_postdata();
        endif;
        ?>
    <?php endif; ?>

    <!-- Latest Posts -->
    <section class="py-12">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold mb-8"><?php _e('Latest Discoveries', 'future-frontiers-hq'); ?></h2>
            
            <?php if (have_posts()) : ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php
                    while (have_posts()) : the_post();
                        get_template_part('template-parts/content', get_post_format());
                    endwhile;
                    ?>
                </div>
                
                <div class="mt-12">
                    <?php ffhq_pagination(); ?>
                </div>
                
            <?php else : ?>
                <?php get_template_part('template-parts/content', 'none'); ?>
            <?php endif; ?>
        </div>
    </section>

    <?php if (is_front_page()) : ?>
        <!-- Newsletter Section -->
        <section class="newsletter-section py-16" style="background: linear-gradient(135deg, #00D4FF, #FF006E);">
            <div class="container mx-auto px-4 text-center">
                <h2 class="text-3xl font-bold text-white mb-4">
                    <?php echo esc_html(get_theme_mod('newsletter_title', 'Stay Ahead of the Future')); ?>
                </h2>
                <p class="text-xl text-white/90 mb-8">
                    <?php echo esc_html(get_theme_mod('newsletter_subtitle', 'Get the latest breakthroughs in science and technology delivered to your inbox weekly.')); ?>
                </p>
                
                <form class="max-w-md mx-auto" action="<?php echo esc_url(home_url('/')); ?>" method="post">
                    <div class="flex">
                        <input type="email" 
                               name="email" 
                               placeholder="<?php esc_attr_e('Enter your email', 'future-frontiers-hq'); ?>" 
                               class="flex-1 px-4 py-3 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-white/50"
                               required>
                        <button type="submit" 
                                class="bg-white text-gray-900 px-6 py-3 rounded-r-lg font-semibold hover:bg-gray-100 transition">
                            <?php _e('Subscribe', 'future-frontiers-hq'); ?>
                        </button>
                    </div>
                    <?php wp_nonce_field('newsletter_subscribe', 'newsletter_nonce'); ?>
                </form>
            </div>
        </section>
    <?php endif; ?>

</main>

<?php
get_footer();
