<?php
/*
 *  Selectors used by the gallery:
 * 
 *      'gallerySelector'=>'div.galleryContainer',
        'pictureSelector'=>'div.pictureContainer',
        'fullImageSelector'=>'img.fullImage',
        'thmbImageSelector'=>'img.thmbImage',
        'titleSelector'=>'h3.title',
        'descriptionSelector'=>'h4.description',
        'photographerSelector'=>'p.photographer',
        'copyrightSelector'=>'p.copyright',
        'personsSelector'=>'p.persons',
 * 
 * 
 * 
 * Variables used in the template:
 * 
 *      $galleryData = Array(
 *          $name => Array(
 *              [0] => Array(
 *                  'fullImg' => 
 *                  'thmbImg' =>
 *                  'title'
 *              ),
 *              [1] => ...
 *          ),
 *          $name => ...
 *      );
 */
?>

<?php foreach ($galleryData as $galleryName => $gallery) { ?>
    <div title="<?=$galleryName?>" id ="galleryContainer_<?=$galleryName?>" class="galleryContainer">
        <?php foreach ($gallery as $pictureData) { ?>
            <div id="pictureContainer_<?php echo substr($pictureData['fullImg'], 0, -4)?>" class="pictureContainer">
                <h3 class="title"><?=$pictureData['title']?></h3>
                <h4 class="description"><?=$pictureData['description']?></h4>
                <img class="thmbImage" src="<?php echo GALLERY_PATH . $pictureData['gallery'] . "/" . $pictureData['thmbImg']?>">
                <img class="fullImage" src="<?php echo GALLERY_PATH . $pictureData['gallery'] . "/" . $pictureData['fullImg']?>">
                <p class="photographer"><?=$pictureData['photographer']?></p>
                <p class="copyright"><?=$pictureData['copyright']?></p>
                <p class="persons"><?=$pictureData['persons']?></p>
            </div>
        <?php }; ?>
    </div>
<?php }; ?>