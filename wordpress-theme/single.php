<?php
/**
 * The template for displaying all single posts
 *
 * @package Future_Frontiers_HQ
 */

get_header();
?>

<main id="primary" class="site-main py-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <?php
            while (have_posts()) :
                the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('bg-white rounded-lg shadow-lg overflow-hidden'); ?>>
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="post-thumbnail">
                            <?php the_post_thumbnail('full', array('class' => 'w-full h-96 object-cover')); ?>
                        </div>
                    <?php endif; ?>

                    <div class="post-content p-8">
                        <header class="post-header mb-8">
                            <div class="post-meta flex items-center mb-4">
                                <?php
                                $categories = get_the_category();
                                if (!empty($categories)) {
                                    $category = $categories[0];
                                    $color = ffhq_get_category_color($category->term_id);
                                    echo '<span class="post-category" style="background-color: ' . esc_attr($color) . '">' . esc_html($category->name) . '</span>';
                                }
                                ?>
                                <span class="post-date ml-4 text-sm text-gray-500"><?php echo get_the_date(); ?></span>
                                <span class="reading-time ml-4 text-sm text-gray-500"></span>
                            </div>

                            <h1 class="post-title text-3xl md:text-4xl font-bold mb-4"><?php the_title(); ?></h1>

                            <div class="post-author flex items-center">
                                <?php echo get_avatar(get_the_author_meta('ID'), 40, '', '', array('class' => 'author-avatar rounded-full mr-3')); ?>
                                <div>
                                    <span class="author-name font-medium"><?php the_author(); ?></span>
                                    <div class="text-sm text-gray-500"><?php the_author_meta('description'); ?></div>
                                </div>
                            </div>
                        </header>

                        <div class="post-body prose prose-lg max-w-none">
                            <?php
                            the_content();
                            
                            wp_link_pages(array(
                                'before' => '<div class="page-links">' . esc_html__('Pages:', 'future-frontiers-hq'),
                                'after'  => '</div>',
                            ));
                            ?>
                        </div>

                        <footer class="post-footer mt-8 pt-8 border-t">
                            <div class="post-tags mb-4">
                                <?php
                                $tags = get_the_tags();
                                if ($tags) {
                                    echo '<span class="text-sm font-medium text-gray-700 mr-2">' . __('Tags:', 'future-frontiers-hq') . '</span>';
                                    foreach ($tags as $tag) {
                                        echo '<a href="' . esc_url(get_tag_link($tag->term_id)) . '" class="inline-block bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm mr-2 mb-2 hover:bg-gray-200">' . esc_html($tag->name) . '</a>';
                                    }
                                }
                                ?>
                            </div>

                            <div class="post-share flex items-center">
                                <span class="text-sm font-medium text-gray-700 mr-4"><?php _e('Share:', 'future-frontiers-hq'); ?></span>
                                <div class="flex space-x-2">
                                    <a href="https://twitter.com/intent/tweet?text=<?php echo urlencode(get_the_title()); ?>&url=<?php echo urlencode(get_permalink()); ?>" 
                                       class="bg-blue-500 text-white px-3 py-1 rounded text-sm hover:bg-blue-600" 
                                       target="_blank" 
                                       rel="noopener noreferrer">
                                        Twitter
                                    </a>
                                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" 
                                       class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700" 
                                       target="_blank" 
                                       rel="noopener noreferrer">
                                        Facebook
                                    </a>
                                    <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode(get_permalink()); ?>" 
                                       class="bg-blue-700 text-white px-3 py-1 rounded text-sm hover:bg-blue-800" 
                                       target="_blank" 
                                       rel="noopener noreferrer">
                                        LinkedIn
                                    </a>
                                </div>
                            </div>
                        </footer>
                    </div>
                </article>

                <!-- Navigation -->
                <nav class="post-navigation mt-8 flex justify-between">
                    <div class="nav-previous">
                        <?php previous_post_link('%link', '<span class="text-sm text-gray-600">&larr; Previous</span><br>%title'); ?>
                    </div>
                    <div class="nav-next text-right">
                        <?php next_post_link('%link', '<span class="text-sm text-gray-600">Next &rarr;</span><br>%title'); ?>
                    </div>
                </nav>

                <!-- Author Bio -->
                <div class="author-bio mt-8 p-6 bg-gray-50 rounded-lg">
                    <div class="flex items-center">
                        <?php echo get_avatar(get_the_author_meta('ID'), 60, '', '', array('class' => 'rounded-full mr-4')); ?>
                        <div>
                            <h3 class="text-lg font-semibold"><?php the_author(); ?></h3>
                            <p class="text-gray-600"><?php the_author_meta('description'); ?></p>
                        </div>
                    </div>
                </div>

                <!-- Related Posts -->
                <?php
                $related_posts = new WP_Query(array(
                    'category__in' => wp_get_post_categories(get_the_ID()),
                    'post__not_in' => array(get_the_ID()),
                    'posts_per_page' => 3,
                ));
                
                if ($related_posts->have_posts()) :
                    ?>
                    <div class="related-posts mt-12">
                        <h3 class="text-2xl font-bold mb-6"><?php _e('Related Articles', 'future-frontiers-hq'); ?></h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <?php
                            while ($related_posts->have_posts()) : $related_posts->the_post();
                                get_template_part('template-parts/content', 'related');
                            endwhile;
                            wp_reset_postdata();
                            ?>
                        </div>
                    </div>
                    <?php
                endif;
                ?>

                <!-- Comments -->
                <?php
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;
                ?>

                <?php
            endwhile;
            ?>
        </div>
    </div>
</main>

<?php
get_footer();
