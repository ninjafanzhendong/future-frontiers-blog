<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Future_Frontiers_HQ
 */

get_header();
?>

<main id="primary" class="site-main py-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mx-auto text-center">
            <header class="page-header">
                <h1 class="page-title text-6xl font-bold mb-4 text-gray-900">404</h1>
                <h2 class="page-subtitle text-3xl font-bold mb-4"><?php esc_html_e('Page Not Found', 'future-frontiers-hq'); ?></h2>
            </header>

            <div class="page-content">
                <p class="text-xl text-gray-600 mb-8">
                    <?php esc_html_e('The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'future-frontiers-hq'); ?>
                </p>
                
                <div class="mb-8">
                    <p class="text-gray-600 mb-4"><?php esc_html_e('Try searching for what you need:', 'future-frontiers-hq'); ?></p>
                    
                    <form role="search" method="get" class="search-form max-w-md mx-auto" action="<?php echo esc_url(home_url('/')); ?>">
                        <div class="flex">
                            <input type="search" 
                                   class="search-field flex-1 px-4 py-3 border border-gray-300 rounded-l-lg focus:outline-none focus:border-blue-500" 
                                   placeholder="<?php echo esc_attr_x('Search &hellip;', 'placeholder', 'future-frontiers-hq'); ?>" 
                                   name="s" />
                            <button type="submit" 
                                    class="bg-gradient-to-r from-[#00D4FF] to-[#FF006E] text-white px-6 py-3 rounded-r-lg font-semibold">
                                <?php echo esc_attr_x('Search', 'submit button', 'future-frontiers-hq'); ?>
                            </button>
                        </div>
                    </form>
                </div>

                <div class="mb-8">
                    <p class="text-gray-600 mb-4"><?php esc_html_e('Or go back to:', 'future-frontiers-hq'); ?></p>
                    <div class="flex justify-center space-x-4">
                        <a href="<?php echo esc_url(home_url('/')); ?>" 
                           class="bg-gray-200 text-gray-700 px-6 py-3 rounded-lg font-medium hover:bg-gray-300 transition">
                            <?php esc_html_e('Homepage', 'future-frontiers-hq'); ?>
                        </a>
                        <a href="<?php echo esc_url(home_url('/blog')); ?>" 
                           class="bg-gray-200 text-gray-700 px-6 py-3 rounded-lg font-medium hover:bg-gray-300 transition">
                            <?php esc_html_e('Blog', 'future-frontiers-hq'); ?>
                        </a>
                    </div>
                </div>

                <div class="bg-gray-50 rounded-lg p-8">
                    <h3 class="text-xl font-bold mb-4"><?php esc_html_e('Popular Articles', 'future-frontiers-hq'); ?></h3>
                    <?php
                    $popular_posts = new WP_Query(array(
                        'posts_per_page' => 3,
                        'orderby' => 'comment_count',
                        'order' => 'DESC'
                    ));
                    
                    if ($popular_posts->have_posts()) :
                        ?>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <?php
                            while ($popular_posts->have_posts()) : $popular_posts->the_post();
                                ?>
                                <article class="bg-white rounded-lg p-4 shadow-sm">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail('thumbnail', array('class' => 'w-full h-32 object-cover rounded mb-3')); ?>
                                        </a>
                                    <?php endif; ?>
                                    <h4 class="font-semibold mb-2">
                                        <a href="<?php the_permalink(); ?>" class="text-gray-900 hover:text-blue-600">
                                            <?php the_title(); ?>
                                        </a>
                                    </h4>
                                    <p class="text-sm text-gray-600"><?php echo get_the_date(); ?></p>
                                </article>
                                <?php
                            endwhile;
                            wp_reset_postdata();
                            ?>
                        </div>
                        <?php
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
get_footer();
