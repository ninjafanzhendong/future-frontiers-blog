<?php
/**
 * Template part for displaying featured posts
 *
 * @package Future_Frontiers_HQ
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('bg-white rounded-lg shadow-lg overflow-hidden mb-12'); ?>>
    <div class="md:flex">
        <?php if (has_post_thumbnail()) : ?>
            <div class="md:w-1/2">
                <a href="<?php the_permalink(); ?>" rel="bookmark">
                    <?php the_post_thumbnail('ffhq-featured', array('class' => 'w-full h-64 md:h-full object-cover')); ?>
                </a>
            </div>
        <?php endif; ?>

        <div class="md:w-1/2 p-8">
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
            </div>

            <h2 class="post-title text-2xl font-bold mb-3">
                <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
            </h2>

            <div class="post-excerpt text-gray-600 mb-4">
                <?php the_excerpt(); ?>
            </div>

            <div class="post-author flex items-center">
                <?php echo get_avatar(get_the_author_meta('ID'), 32, '', '', array('class' => 'author-avatar rounded-full mr-3')); ?>
                <span class="author-name text-sm text-gray-700 font-medium"><?php the_author(); ?></span>
            </div>
        </div>
    </div>
</article>
