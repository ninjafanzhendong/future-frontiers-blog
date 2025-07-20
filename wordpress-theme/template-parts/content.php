<?php
/**
 * Template part for displaying posts
 *
 * @package Future_Frontiers_HQ
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post-card bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1'); ?>>
    <?php if (has_post_thumbnail()) : ?>
        <div class="post-thumbnail-wrapper">
            <a href="<?php the_permalink(); ?>" rel="bookmark">
                <?php the_post_thumbnail('ffhq-card', array('class' => 'w-full h-48 object-cover transition-transform duration-300 hover:scale-105')); ?>
            </a>
        </div>
    <?php endif; ?>

    <div class="post-content p-6">
        <div class="post-meta flex items-center mb-3">
            <?php
            $categories = get_the_category();
            if (!empty($categories)) {
                $category = $categories[0];
                $color = ffhq_get_category_color($category->term_id);
                echo '<span class="post-category" style="background-color: ' . esc_attr($color) . '">' . esc_html($category->name) . '</span>';
            }
            ?>
            <span class="post-date ml-3 text-sm text-gray-500"><?php echo get_the_date(); ?></span>
        </div>

        <h2 class="post-title text-xl font-bold mb-2">
            <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
        </h2>

        <div class="post-excerpt text-gray-600 text-sm mb-4">
            <?php the_excerpt(); ?>
        </div>

        <div class="post-author flex items-center">
            <?php echo get_avatar(get_the_author_meta('ID'), 24, '', '', array('class' => 'author-avatar rounded-full mr-2')); ?>
            <span class="author-name text-sm text-gray-500"><?php the_author(); ?></span>
        </div>
    </div>
</article>
