<?php
/**
 * The template for displaying archive pages
 *
 * @package Future_Frontiers_HQ
 */

get_header();
?>

<main id="primary" class="site-main py-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        
        <header class="page-header mb-12">
            <?php
            the_archive_title('<h1 class="page-title text-3xl font-bold mb-4">', '</h1>');
            the_archive_description('<div class="archive-description text-gray-600">', '</div>');
            ?>
        </header>

        <?php if (have_posts()) : ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php
                while (have_posts()) :
                    the_post();
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
</main>

<?php
get_footer();
