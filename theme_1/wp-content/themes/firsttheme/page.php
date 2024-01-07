<?php get_header() ?>


<?php
// calling other headers like this - header-second.php
//get_header('second')
?>


<!-- loop all the post & page from database -->

<div class="mx-auto w-3/4 my-8">
    <?php
    if (have_posts()):
        while (have_posts()):
            the_post();
            ?>
            <article class="my-12">
                <h2>
                    <?php the_title(); ?>
                </h2>
                <div>
                    <p>
                        <?php the_content(); ?>
                    </p>
                </div>
            </article>
        <?php endwhile;
    else: ?>
        <p>there is no post</p>
    <?php endif;
    ?>
</div>


<?php get_footer(); ?>