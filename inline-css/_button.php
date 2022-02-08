<?php
// Button Styles
$buttonSettings = get_field('button_settings', 'option');
$buttonColour = get_field('button_colour', 'option');

//var_dump($buttonSettings);
?>
<style name="button">

    :root {
        --link-weight: 400;
        
        /* Master Button Settings */
        /* These set button colours in _components/_buttons.scss/*/

        --link-radius: <?php echo $buttonSettings['button_style'] ?>;
        --base-button-border-weight: <?php echo $buttonSettings['border_weight'] ?>;

        --base-button-background: <?php echo $buttonColour['background_colour'] ?>;
        --base-button-hover: <?php echo $buttonColour['hover_background_colour'] ?>;
        --base-button-text: <?php echo $buttonColour['text_colour'] ?>;
        --base-button-hover-text: <?php echo $buttonColour['hover_text_colour'] ?>;
        --base-button-border-color: <?php echo $buttonColour['border_colour'] ?>;
        --base-button-hover-border-color: <?php echo $buttonColour['hover_border_colour'] ?>;

    }

</style>