<?php
$heroText = get_field('hero_text');
$heroImage = get_field('hero_image');
$textColour = get_field('text_colour');
if ($heroImage) {
    ?>
    <section id="product-hero" class="grid-row">
        <div class="hero-text <?php echo $textColour; ?>">
            <?php echo $heroText ?>
        </div>
        <div class="hero-image"
             style="background: url(<?php echo wp_get_attachment_url($heroImage['id']); ?> )center center /cover no-repeat">
        </div>
    </section>
<?php } ?>