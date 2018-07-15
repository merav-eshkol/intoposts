<?php
// example args
$args = (array('post_type' => 'manager-banner', 'posts_per_page' => 1));

// the query
$the_query = new WP_Query($args);
?>
<?php if ($the_query->have_posts()) : ?>

    <!-- start of the loop -->
    <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
        <?php
        $url = get_post_meta(get_the_ID(), 'yourprefix_demo_urlr', true);
        $img = get_post_meta(get_the_ID(), 'yourprefix_demo_image', true);
        ?>
        <a class="sidebar-banner" href="<?php echo $url ? $url: ''; ?>">
            <img src="<?php echo $img; ?>"
        </a>
    <?php endwhile; ?><!-- end of the loop -->

    <!-- put pagination functions here -->
    <?php wp_reset_postdata(); ?>

<?php else: ?>

    <p><?php get_sidebar(); ?></p>

<?php endif; ?>