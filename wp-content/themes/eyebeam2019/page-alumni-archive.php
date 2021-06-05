<?php 
/***
 * Template Name: Alumni Archive 2.0
 */



eyebeam2018_view_source_post('02-develop-intro');

get_header();

while (have_posts()) {

	the_post();

    ?>

    

    <div class="alumni-intro">
        <h2>
            Alumni Archive
        </h2>
        <?php the_content(); ?>

    </div>

    <hr />

    <div class="alumni-archive">

        <div class="alumni-archive-controls">

        <p>
            Filter the list of residents below by typing in a name or clicking the buttons on the right
        </p>

        <form action="" class="alumni-archive-controls-form-search">

            <input type="text" name="filter" class="alumni-filter" placeholder="Start typing a name..." />

            <button class="form-search" data-type="all">
                View All
            </button>
            <button class="form-search" data-type="residents">
                Residents
            </button>
            <button class="form-search" data-type="rapid-response">
                Rapid Response Fellows
            </button>

        </form>

        <div class="alumni-archive-controls-form-sort">
            <div class="left">
                
                <button data-sort="name" data-direction="asc" class="btn-light desc" value="true">
                    A-Z
                    <span class="asc">&uarr;</span>
                    <span class="desc">&darr;</span>
                </button>
                <button data-sort="date" data-direction="asc" class="btn-light desc" value="true">
                    Date
                    <span class="asc">&uarr;</span>
                    <span class="desc">&darr;</span>
                </button>
                
            </div>
<!--             
            <div class="right">
                <button class="btn-light">
                    Names
                </button>
                <button class="btn-light">
                    Thumbnails
                </button>
            </div> -->
        </div>

        </div>


        <hr />
        <?php 

        // $args = array(
        //     'post_type' => 'resident',
        //     'posts_per_page' => 12,
        // );

        // $alumni = get_posts($args);
            ?>

        <div class="alumni-archive-results">

            <?php //foreach($alumni as $resident){ ?>
            
                <?php include(__DIR__ . '/templates/alumni-resident-item.php'); ?>
            
            <?php //} ?>


        </div>

    </div>


    <?php

}

get_footer();
