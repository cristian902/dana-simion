<div class="timeline-centered">
    <?php
    $about_timeline = get_theme_mod('about_timeline');
    if(empty($about_timeline)){
        return;
    }

    $about_timeline_decoded = json_decode($about_timeline);
    if(empty($about_timeline_decoded)){
        return;
    }

    foreach ($about_timeline_decoded as $entry){
        $year = $entry->title;
        $events = $entry->social_repeater;
        if(empty($events)){
            return;
        }

        $events_decoded = json_decode($events);
        if( empty($events_decoded) ){
            return;
        }

        $is_first = true;
        foreach ( $events_decoded as $event ){
            $title = $event->title;
            $subtitle = $event->subtitle;
            $link = $event->link; ?>
            <article class="timeline-entry">
                <div class="timeline-entry-inner">
                    <?php
                    if( $is_first === true && !empty($year)) { ?>
                        <time class="timeline-time">
                            <span><?php echo wp_kses_post($year); ?></span>
                        </time>
                        <?php
                    } ?>
                    <div class="timeline-icon">
                    </div>
                    <div class="timeline-label">
                        <?php
                        if( !empty($title)){ ?>
                            <h2>
                                <?php
                                if( !empty($link)){
                                    echo '<a href="'.esc_url($link).'">';
                                }
                                echo wp_kses_post($title);
                                if( !empty($link)){
                                    echo '</a>';
                                }?>
                            </h2>
                            <?php
                        }

                        if( !empty($subtitle)){?>
                            <p><?php echo wp_kses_post($subtitle); ?></p>
                            <?php
                        } ?>
                    </div>
                </div>
            </article>
            <?php
            $is_first = false;
        }
    } ?>
</div>
