<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die()?>

<div class="dropzone" data-uploader>
    <input type="file" name="<?=$arParams['NAME']?>" multiple class="dropzone__control">

    <div class="dropzone__area">
        <div class="dropzone__message dz-message needsclick">
            <div class="dropzone__message-caption needsclick">
                <h6 class="dropzone__message-title">Ограничения:</h6>
                <ul class="dropzone__message-list">
                    <li class="dropzone__message-item">до 10 файлов</li>
                    <li class="dropzone__message-item">вес каждого файла не более 5 МБ</li>
                    <li class="dropzone__message-item">форматы файлов: PDF, JPG, JPEG, PNG, HEIC</li>
                </ul>
            </div>

            <button type="button" class="dropzone__button button button--medium button--rounded button--covered button--red"
            data-uploader-area='{"paramName": "<?=$arParams['NAME']?>", "url":"/_markup/gui.php"}'>
                <span class="button__icon">
                    <svg class="icon icon--import">
                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-import"></use>
                    </svg>
                </span>
                <span class="button__text">Загрузить файл</span>
            </button>
        </div>

        <div class="dropzone__previews dz-previews" data-uploader-previews>
            <?php foreach ($arParams['FILES'] as $file):?>
                <div class="file dz-processing dz-image-preview dz-success dz-complete" data-uploader-preview="">
                    <div class="file__wrapper">
                        <div class="file__prewiew">
                            <div class="file__icon">
                                <svg class="icon icon--gallery">
                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-gallery"></use>
                                </svg>
                            </div>

                            <div class="file__name">
                                <h6 class="file__name-heading heading heading--tiny" data-uploader-preview-filename=""><?=$file['name']?></h6>
                            </div>
                        </div>

                        <div class="file__info">
                            <div class="file__format" data-uploader-preview-format=""><?=$file['format']?></div>

                            <div class="file__weight" data-uploader-preview-size=""><?=$file['size']?></div>

                            <div class="file__delete" data-dz-remove="">
                                <button type="button" class="file__delete-button button button--iconed button--simple button--gray">
                                    <span class="file__delete-button-icon button__icon">
                                        <svg class="icon icon--delete">
                                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-delete"></use>
                                        </svg>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" data-dropzone-file="" value="<?=$file['id']?>">
                    <div class="file__error" data-dz-errormessage=""></div>
                </div>
            <?php endforeach;?>
        </div>
    </div>
</div>
