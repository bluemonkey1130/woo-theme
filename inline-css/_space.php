<?php
$space = get_field('space_size', 'option');
?>
<style name="space">

    :root {
        --spacing-ratio: <?php echo $space ?>;
    }

</style>