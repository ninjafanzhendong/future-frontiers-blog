<?php
/**
 * The template for displaying all pages
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
                            <?php the_post_thumbnail('full', array('class' => 'w-full h-64 object-cover')); ?>
                        </div>
                    <?php endif; ?>

                    <div class="post-content p-8">
                        <header class="post-header mb-8">
                            <h1 class="post-title text-3xl md:text-4xl font-bold mb-4"><?php the_title(); ?></h1>
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
                    </div>
                </article>

                <?php
                // If comments are open or we have at least one comment, load up the comment template.
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;
                
            endwhile;
            ?>
        </div>
    </div>
</main>

<?php
get_footer();
