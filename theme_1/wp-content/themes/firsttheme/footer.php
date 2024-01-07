<footer class="p-6 bg-black text-white flex justify-evenly">
    <nav>
        <?php wp_nav_menu(array('theme_location' => "first_theme_footer_menu")) ?>
    </nav>

    <p class="">©️ copyrights <span class="dateSpan"></span> | designed by sabin</p>
    <?php
    wp_footer();
    ?>
</footer>

<!-- copyrights year script { -->
<script>
    let dateSpan = document.querySelector('footer p .dateSpan');
    let currentYear = new Date().getFullYear();
    dateSpan.textContent = currentYear;
</script>
<!-- copyrights year script } -->
</body>

</html>