
    <?php echo $gallery->getColorboxStyles(1); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo THEMEPATH; ?>/style.css" />
    <?php /* <script type="text/javascript" src="//code.jquery.com/jquery-2.1.4.min.js"></script> */ ?>
    <?php // echo $gallery->getColorboxScripts(); ?>
    <?php
        $galleryArray['relText'] = 'colorbox';
        echo $gallery->readTemplate('templates/defaultGallery.php', $galleryArray);
    ?>
