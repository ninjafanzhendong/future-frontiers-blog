<?php
/**
 * Template part for displaying related posts
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

    <div class="post-content p-4">
        <div class="post-meta flex items-center mb-2">
            <?php
            $categories = get_the_category();
            if (!empty($categories)) {
                $category = $categories[0];
                $color = ffhq_get_category_color($category->term_id);
                echo '<span class="post-category text-xs" style="background-color: ' . esc_attr($color) . '">' . esc_html($category->name) . '</span>';
            }
            ?>
            <span class="post-date ml-2 text-xs text-gray-500"><?php echo get_the_date(); ?></span>
        </div>

        <h3 class="post-title text-lg font-bold mb-2">
            <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
        </h3>

        <div class="post-excerpt text-gray-600 text-sm">
            <?php echo wp_trim_words(get_the_excerpt(), 15, '...'); ?>
        </div>
    </div>
</article>
