<?php
// Colours
$primary = get_field('primary', 'option');
$secondary = get_field('secondary', 'option');
$tertiary = get_field('tertiary', 'option');
$quaternary = get_field('quaternary', 'option');
$dark = get_field('dark', 'option');
$light = get_field('light', 'option');
$background = get_field('background_colour', 'option');

?>
<style name="colours">

    :root {
        --primary-main: <?php echo $primary['main'] ?>;
        --primary-highlight: <?php echo $primary['highlight'] ?>;
        --primary-invert: <?php echo $primary['invert'] ?>;

        --secondary-main: <?php echo $secondary['main'] ?>;
        --secondary-highlight: <?php echo $secondary['highlight'] ?>;
        --secondary-invert: <?php echo $secondary['invert'] ?>;

        --tertiary-main: <?php echo $tertiary['main'] ?>;
        --tertiary-highlight: <?php echo $tertiary['highlight'] ?>;
        --tertiary-invert: <?php echo $tertiary['invert'] ?>;

        --quaternary-main: <?php echo $quaternary['main'] ?>;
        --quaternary-highlight: <?php echo $quaternary['highlight'] ?>;
        --quaternary-invert: <?php echo $quaternary['invert'] ?>;

        --light-main: <?php echo $light['main'] ?>;
        --light-highlight: <?php echo $light['highlight'] ?>;
        --light-invert: <?php echo $light['invert'] ?>;

        --dark-main: <?php echo $dark['main'] ?>;
        --dark-highlight: <?php echo $dark['highlight'] ?>;
        --dark-invert: <?php echo $dark['invert'] ?>;

        --base-background: <?php echo $background ?>;

    }

</style>