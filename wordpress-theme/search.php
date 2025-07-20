<?php
/**
 * The template for displaying search results pages
 *
 * @package Future_Frontiers_HQ
 */

get_header();
?>

<main id="primary" class="site-main py-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        
        <header class="page-header mb-12">
            <h1 class="page-title text-3xl font-bold mb-4">
                <?php
                printf(
                    /* translators: %s: search query. */
                    esc_html__('Search Results for: %s', 'future-frontiers-hq'),
                    '<span>' . get_search_query() . '</span>'
                );
                ?>
            </h1>
            <p class="text-gray-600">
                <?php
                global $wp_query;
                printf(
                    esc_html__('Found %d results', 'future-frontiers-hq'),
                    $wp_query->found_posts
                );
                ?>
            </p>
        </header>

        <?php if (have_posts()) : ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php
                while (have_posts()) :
                    the_post();
                    get_template_part('template-parts/content', 'search');
                endwhile;
                ?>
            </div>

            <div class="mt-12">
                <?php ffhq_pagination(); ?>
            </div>

        <?php else : ?>
            <div class="text-center py-12">
                <h2 class="text-2xl font-bold mb-4"><?php _e('No Results Found', 'future-frontiers-hq'); ?></h2>
                <p class="text-gray-600 mb-8"><?php _e('Try searching with different keywords.', 'future-frontiers-hq'); ?></p>
                
                <form role="search" method="get" class="search-form max-w-md mx-auto" action="<?php echo esc_url(home_url('/')); ?>">
                    <div class="flex">
                        <input type="search" 
                               class="search-field flex-1 px-4 py-2 border border-gray-300 rounded-l-lg focus:outline-none focus:border-blue-500" 
                               placeholder="<?php echo esc_attr_x('Search &hellip;', 'placeholder', 'future-frontiers-hq'); ?>" 
                               value="<?php echo get_search_query(); ?>" 
                               name="s" />
                        <button type="submit" 
                                class="bg-gradient-to-r from-[#00D4FF] to-[#FF006E] text-white px-6 py-2 rounded-r-lg font-semibold">
                            <?php echo esc_attr_x('Search', 'submit button', 'future-frontiers-hq'); ?>
                        </button>
                    </div>
                </form>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php
get_footer();
