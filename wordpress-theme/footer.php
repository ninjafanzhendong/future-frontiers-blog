<?php
/**
 * The footer for our theme
 *
 * @package Future_Frontiers_HQ
 */

?>

    <footer id="colophon" class="site-footer bg-gray-900 text-white py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="footer-content grid grid-cols-1 md:grid-cols-4 gap-8">
                
                <!-- Brand Section -->
                <div class="footer-section">
                    <div class="flex items-center mb-4">
                        <?php
                        $custom_logo_id = get_theme_mod('custom_logo');
                        $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
                        
                        if (has_custom_logo()) {
                            the_custom_logo();
                        } else {
                            ?>
                            <div class="w-8 h-8 bg-gradient-to-br from-[#00D4FF] to-[#FF006E] rounded-lg flex items-center justify-center mr-2">
                                <span class="text-white font-bold">F</span>
                            </div>
                            <?php
                        }
                        ?>
                        <span class="text-xl font-bold"><?php bloginfo('name'); ?></span>
                    </div>
                    <p class="text-gray-400">
                        <?php bloginfo('description'); ?>
                    </p>
                </div>

                <!-- Categories -->
                <div class="footer-section">
                    <h3 class="font-semibold mb-4"><?php _e('Categories', 'future-frontiers-hq'); ?></h3>
                    <ul class="space-y-2">
                        <?php
                        $categories = get_categories(array(
                            'orderby' => 'name',
                            'order' => 'ASC',
                            'number' => 5
                        ));
                        
                        foreach ($categories as $category) {
                            echo '<li><a href="' . esc_url(get_category_link($category->term_id)) . '" class="text-gray-400 hover:text-white">' . esc_html($category->name) . '</a></li>';
                        }
                        ?>
                    </ul>
                </div>

                <!-- About -->
                <div class="footer-section">
                    <h3 class="font-semibold mb-4"><?php _e('About', 'future-frontiers-hq'); ?></h3>
                    <ul class="space-y-2">
                        <li><a href="<?php echo esc_url(home_url('/about')); ?>" class="text-gray-400 hover:text-white"><?php _e('Our Mission', 'future-frontiers-hq'); ?></a></li>
                        <li><a href="<?php echo esc_url(home_url('/team')); ?>" class="text-gray-400 hover:text-white"><?php _e('Team', 'future-frontiers-hq'); ?></a></li>
                        <li><a href="<?php echo esc_url(home_url('/contact')); ?>" class="text-gray-400 hover:text-white"><?php _e('Contact', 'future-frontiers-hq'); ?></a></li>
                        <li><a href="<?php echo esc_url(home_url('/privacy-policy')); ?>" class="text-gray-400 hover:text-white"><?php _e('Privacy Policy', 'future-frontiers-hq'); ?></a></li>
                    </ul>
                </div>

                <!-- Follow Us -->
                <div class="footer-section">
                    <h3 class="font-semibold mb-4"><?php _e('Follow Us', 'future-frontiers-hq'); ?></h3>
                    <p class="text-gray-400 mb-4"><?php _e('Stay connected for the latest updates', 'future-frontiers-hq'); ?></p>
                    <div class="flex space-x-4">
                        <?php
                        $social_links = array(
                            'twitter' => 'Twitter',
                            'facebook' => 'Facebook',
                            'linkedin' => 'LinkedIn',
                            'youtube' => 'YouTube',
                        );
                        
                        foreach ($social_links as $platform => $label) {
                            $url = get_theme_mod('social_' . $platform);
                            if ($url) {
                                echo '<a href="' . esc_url($url) . '" class="text-gray-400 hover:text-white" target="_blank" rel="noopener noreferrer">' . esc_html($label) . '</a>';
                            }
                        }
                        ?>
                    </div>
                    
                    <!-- Newsletter Form -->
                    <div class="mt-6">
                        <h4 class="font-medium mb-2"><?php _e('Newsletter', 'future-frontiers-hq'); ?></h4>
                        <form action="<?php echo esc_url(home_url('/')); ?>" method="post" class="flex">
                            <input type="email" 
                                   name="email" 
                                   placeholder="<?php esc_attr_e('Your email', 'future-frontiers-hq'); ?>" 
                                   class="flex-1 px-3 py-2 text-sm rounded-l bg-gray-800 border border-gray-700 focus:outline-none focus:border-gray-600"
                                   required>
                            <button type="submit" 
                                    class="bg-gradient-to-r from-[#00D4FF] to-[#FF006E] text-white px-3 py-2 text-sm rounded-r font-medium">
                                <?php _e('Subscribe', 'future-frontiers-hq'); ?>
                            </button>
                            <?php wp_nonce_field('newsletter_subscribe', 'newsletter_nonce'); ?>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="footer-bottom border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. <?php _e('All rights reserved.', 'future-frontiers-hq'); ?></p>
            </div>
        </div>
    </footer>

</div>

<?php wp_footer(); ?>

</body>
</html>
