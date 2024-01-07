<?php get_header('second'); ?>
<?php
// template name:team
?>

<div class="my-12 mx-auto w-3/4 my-8">
    <h2 class="text-4xl capitalize">
        <?php the_title(); ?>
    </h2>
    <?php $users = get_users(
        array(
            'role' => 'author', // Optional: Filter by user role
            'number' => -1, // Limit to 10 users // Order by registration date
            'order' => 'DESC' // Descending order
        )
    );
    foreach ($users as $user): ?>
        <h5>
            <?php echo $user->user_login ?>
        </h5>
    <?php endforeach; ?>
</div>

<?php get_footer(); ?>