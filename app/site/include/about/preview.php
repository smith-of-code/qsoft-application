<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?php
// При подстановке ссылки на видео с Youtube, изменить ссылку вида
// https://www.youtube.com/watch?v=hnB8jLCznHI
// на
// https://www.youtube.com/embed/hnB8jLCznHI
// т. е. указывается эндпоинт embed вместо watch, и далее ID видео через слэш.
?>
<section class="about__preview section section--margin-xl">
    <div class="about__preview-box section__box box">
        <iframe class="about__preview-video" width="100%" height="100%" src="https://www.youtube.com/embed/hnB8jLCznHI" frameborder="0" allowfullscreen>
        </iframe>
    </div>
</section>