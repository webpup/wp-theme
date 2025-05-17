<?php

// Shortcode to get latest podcast
function pim_latest_podcast_shortcode($atts) {
    $atts = shortcode_atts(array(
        'count' => 1,
    ), $atts);
    
    $args = array(
        'post_type' => 'pim',
        'posts_per_page' => $atts['count'],
        'orderby' => 'meta_value_num',
        'meta_key' => 'episode_number',
        'order' => 'DESC'
    );
    
    $query = new WP_Query($args);
    
    if ($query->have_posts()) {
        ob_start();
        echo '<div class="pim-latest-podcasts">';
        while ($query->have_posts()) {
            $query->the_post();
            $episode_number = get_post_meta(get_the_ID(), 'episode_number', true);
            $media_link = get_post_meta(get_the_ID(), 'media_link', true);
            $published_date = get_post_meta(get_the_ID(), 'published_date', true);
            ?>
            <div class="pim-podcast">
                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?> (Episode <?php echo $episode_number; ?>)</a></h3>
                <?php if ($published_date) : ?>
                    <div class="pim-published-date"><?php echo date('F j, Y', strtotime($published_date)); ?></div>
                <?php endif; ?>
                <?php if (has_post_thumbnail()) : ?>
                    <div class="pim-banner-img"><?php the_post_thumbnail(); ?></div>
                <?php endif; ?>
                <?php if ($media_link) : ?>
                    <div class="pim-media">
                        <?php if (strpos($media_link, 'youtube.com') !== false || strpos($media_link, 'youtu.be') !== false) : ?>
                            <iframe width="560" height="315" src="<?php echo esc_url($media_link); ?>" frameborder="0" allowfullscreen></iframe>
                        <?php else : ?>
                            <audio controls>
                                <source src="<?php echo esc_url($media_link); ?>" type="audio/mpeg">
                                Your browser does not support the audio element.
                            </audio>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                <div class="pim-excerpt"><?php the_excerpt(); ?></div>
            </div>
            <?php
        }
        echo '</div>';
        wp_reset_postdata();
        return ob_get_clean();
    }
    
    return '<p>No podcasts found</p>';
}
add_shortcode('latest_podcast', 'pim_latest_podcast_shortcode');

// Shortcode to get latest 3 podcasts
function pim_latest_3_podcasts_shortcode() {
    return pim_latest_podcast_shortcode(array('count' => 3));
}
add_shortcode('latest_3_podcasts', 'pim_latest_3_podcasts_shortcode');
