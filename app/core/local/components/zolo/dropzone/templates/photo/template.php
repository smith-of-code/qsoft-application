<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die()?>

<div class="registration__dropzone dropzone dropzone--image" data-uploader>
    <input type="file" name="<?=$arParams['NAME']?>" class="dropzone__control">

    <div class="dropzone__area" data-uploader-area='{"paramName": "<?=$arParams['NAME']?>", "url":"/_markup/gui.php", "images": true, "single": true, "acceptedFiles": ".jpg, .jpeg, .png, .heic" }'>
        <div class="dropzone__message dz-message needsclick">
            <div class="dropzone__message-button dz-button link needsclick" data-uploader-previews>
                <svg class="dropzone__message-button-icon icon icon--camera">
                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-camera"></use>
                </svg>
                <?php if ($arParams['PHOTO']):?>
                    <div class="dropzone__previews-picture dz-preview dz-processing dz-image-preview dz-success dz-complete" data-uploader-preview="" title="Заменить обложку">
                        <div class="dropzone__previews-picture-box">
                            <div class="dropzone__previews-picture-image">
                                <img src="<?=$arParams['PHOTO']['src']?>" class="dropzone__previews-picture-image-pic" data-dz-thumbnail="">
                            </div>
                            <div class="dropzone__previews-item-remove" data-dz-remove="">
                                <svg class="dropzone__previews-item-remove-icon icon icon--cross"><use xlink:href="/public/images/icons/sprite.svg#icon-cross"></use></svg>
                            </div>
                        </div>
                        <div class="dropzone__previews-item-error" data-dz-errormessage=""></div>
                    </div>
                <?php endif;?>
            </div>

            <div class="dropzone__message-block">
                <div class="dropzone__message-caption needsclick">
                    <h6 class="dropzone__message-title">Требования к фото</h6>
                    <ul class="dropzone__message-list">
                        <li class="dropzone__message-item">формат jpg, jpeg, png, heic</li>
                        <li class="dropzone__message-item">размер 240 Х 320 px</li>
                        <li class="dropzone__message-item">вес не более 1МБ</li>
                    </ul>
                </div>

                <button type="button" class="dropzone__button button button--medium button--rounded button--covered button--red">
                    <span class="button__icon">
                        <svg class="icon icon--import">
                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-import"></use>
                        </svg>
                    </span>
                    <span class="button__text">Загрузить фото</span>
                </button>
            </div>
        </div>

        <div class="dropzone__previews dz-previews" data-uploader-previews></div>
    </div>
</div>
