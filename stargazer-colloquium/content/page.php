<article <?php hybrid_attr('post'); ?>>

    <?php if (is_page()) : // If viewing a single page. ?>

        <header class="entry-header">
            <h1 <?php hybrid_attr('entry-title'); ?>><?php single_post_title(); ?></h1>
        </header><!-- .entry-header -->

        <div <?php hybrid_attr('entry-content'); ?>>
            <?php the_content(); ?>
            <?php wp_link_pages(); ?>
        </div><!-- .entry-content -->

        <!--pilchy isotope testing -->

        <!-- manual HTML demonstrating multiple combination filters -->
        <!-- See http://codepen.io/desandro/pen/JEojz/ -->
        
        <!-- Shuffle Button-->
        <p><button id="shuffleHTML">Shuffle</button></p>
        
        <div id="filtersHTML">
            <div class="ui-group">
                <h3>Color</h3>
                <div class="button-group js-radio-button-group" data-filter-group="color">
                    <button class="button is-checked" data-filter="">any</button>
                    <button class="button" data-filter=".red">red</button>
                    <button class="button" data-filter=".blue">blue</button>
                    <button class="button" data-filter=".yellow">yellow</button>
                </div>
            </div>

            <div class="ui-group">
                <h3>Size</h3>
                <div class="button-group js-radio-button-group" data-filter-group="size">
                    <button class="button is-checked" data-filter="">any</button>
                    <button class="button" data-filter=".small">small</button>
                    <button class="button" data-filter=".wide">wide</button>
                    <button class="button" data-filter=".big">big</button>
                    <button class="button" data-filter=".tall">tall</button>
                </div>
            </div>

            <div class="ui-group">
                <h3>Shape</h3>
                <div class="button-group js-radio-button-group" data-filter-group="shape">
                    <button class="button is-checked" data-filter="">any</button>
                    <button class="button" data-filter=".round">round</button>
                    <button class="button" data-filter=".square">square</button>
                </div>
            </div>
        </div>
        
        <div class="isotope">
            <div class="color-shape small round red"></div>
            <div class="color-shape small round blue"></div>
            <div class="color-shape small round yellow"></div>
            <div class="color-shape small square red"></div>
            <div class="color-shape small square blue"></div>
            <div class="color-shape small square yellow"></div>
            <div class="color-shape wide round red"></div>
            <div class="color-shape wide round blue"></div>
            <div class="color-shape wide round yellow"></div>
            <div class="color-shape wide square red"></div>
            <div class="color-shape wide square blue"></div>
            <div class="color-shape wide square yellow"></div>
            <div class="color-shape big round red"></div>
            <div class="color-shape big round blue"></div>
            <div class="color-shape big round yellow"></div>
            <div class="color-shape big square red"></div>
            <div class="color-shape big square blue"></div>
            <div class="color-shape big square yellow"></div>
            <div class="color-shape tall round red"></div>
            <div class="color-shape tall round blue"></div>
            <div class="color-shape tall round yellow"></div>
            <div class="color-shape tall square red"></div>
            <div class="color-shape tall square blue"></div>
            <div class="color-shape tall square yellow"></div>
        </div>

        <!-- WP version -->                
        <!-- List of cats with data-filter attributes set -->
        <ul id="filtersWP">
            <li><a href="#" data-filter="*" class="selected">SHOW ALL</a></li>
            <?php
            $terms = get_terms("category"); // get all categories, but you can use any taxonomy
            $count = count($terms); //How many are they?
            if ($count > 0) {  //If there are more than 0 terms
                foreach ($terms as $term) {  //for each term:
                    echo "<li><a href='#' data-filter='." . $term->slug . "'>" . $term->name . "</a></li>\n";
                    //create a list item with the current term slug for sorting, and name for label
                }
            }
            ?>
        </ul>

        <!-- Shuffle Button-->
        <p><button id="shuffleWP">Shuffle</button></p>
        
        <!-- List of posts with data-filter attributes set -->
        <?php
        $the_query = new WP_Query('posts_per_page=50'); // Check the WP_Query docs to see how you can limit which posts to display
        ?>
        <?php if ($the_query->have_posts()) : ?>
            <div id="isotope-list">
                <?php
                while ($the_query->have_posts()) : $the_query->the_post();
                    $termsArray = get_the_terms(!empty($post) && $post->ID, "category");  // Get terms for this particular item
                    // IMPORTANT: Needed to implement this to avoid 'Notice: Trying to get property of non-object' error message https://wordpress.org/support/topic/solution-for-notice-trying-to-get-property-of-non-object-evald-code
                    $termsString = ""; //initialize the string that will contain the terms
                    foreach ($termsArray as $term) { // for each term 
                        $termsString .= $term->slug . ' '; //create a string that has all the slugs
                    }
                    ?>
                    <div class="<?php echo $termsString; ?>item"> <?php // 'item' is used as an identifier (see Setp 5, line 6)   ?>
                        <h3><?php the_title(); ?></h3>
                        <?php
                        if (has_post_thumbnail()) {
                            the_post_thumbnail();
                        }
                        ?>
                    </div> <!-- end item -->
                <?php endwhile; ?>
            </div> <!-- end isotope-list -->
        <?php endif; ?>

        <!--pilchy isotope testing -->

        <footer class="entry-footer">
            <?php edit_post_link(); ?>
        </footer><!-- .entry-footer -->

    <?php else : // If not viewing a single page.  ?>

        <?php get_the_image(array('size' => 'stargazer-full')); ?>

        <header class="entry-header">
            <?php the_title('<h2 ' . hybrid_get_attr('entry-title') . '><a href="' . get_permalink() . '" rel="bookmark" itemprop="url">', '</a></h2>'); ?>
        </header><!-- .entry-header -->

        <div <?php hybrid_attr('entry-summary'); ?>>
            <?php the_excerpt(); ?>
        </div><!-- .entry-summary -->

    <?php endif; // End single page check.  ?>

</article><!-- .entry -->