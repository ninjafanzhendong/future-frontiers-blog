<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @package Future_Frontiers_HQ
 */

?>

<section class="no-results not-found py-12">
    <div class="container mx-auto px-4 text-center">
        <header class="page-header">
            <h1 class="page-title text-3xl font-bold mb-4"><?php esc_html_e('Nothing Found', 'future-frontiers-hq'); ?></h1>
        </header>

        <div class="page-content">
            <?php
            if (is_home() && current_user_can('publish_posts')) :
                ?>
                <p class="text-gray-600 mb-4">
                    <?php
                    printf(
                        wp_kses(
                            /* translators: 1: link to WP admin new post page. */
                            __('Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'future-frontiers-hq'),
                            array(
                                'a' => array(
                                    'href' => array(),
                                ),
                            )
                        ),
                        esc_url(admin_url('post-new.php'))
                    );
                    ?>
                </p>
                <?php
            elseif (is_search()) :
                ?>
                <p class="text-gray-600 mb-8"><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'future-frontiers-hq'); ?></p>
                
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
                <?php
            else :
                ?>
                <p class="text-gray-600 mb-8"><?php esc_html_e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'future-frontiers-hq'); ?></p>
                
                <form role="search" method="get" class="search-form max-w-md mx-auto" action="<?php echo esc_url(home_url('/')); ?>">
                    <div class="flex">
                        <input type="search" 
                               class="search-field flex-1 px-4 py-2 border border-gray-300 rounded-l-lg focus:outline-none focus:border-blue-500" 
                               placeholder="<?php echo esc_attr_x('Search &hellip;', 'placeholder', 'future-frontiers-hq'); ?>" 
                               name="s" />
                        <button type="submit" 
                                class="bg-gradient-to-r from-[#00D4FF] to-[#FF006E] text-white px-6 py-2 rounded-r-lg font-semibold">
                            <?php echo esc_attr_x('Search', 'submit button', 'future-frontiers-hq'); ?>
                        </button>
                    </div>
                </form>
                <?php
            endif;
            ?>
        </div>
    </div>
</section>
