import dropzone from 'dropzone';

console.log(dropzone.prototype.defaultOptions);

// Локализация. Взято с https://gist.github.com/ValeriaVG/5ffcf92c98216e44e92d3db6a36ff838
dropzone.prototype.defaultOptions.dictDefaultMessage = 'Перетащите файлы для загрузки в это поле';
dropzone.prototype.defaultOptions.dictFallbackMessage = 'К сожалению, ваш браузер не поддерживает Drag-n-Drop';
dropzone.prototype.defaultOptions.dictFallbackText = 'Пожалуйста, воспользуйтесь старой доброй формой для загрузки';
dropzone.prototype.defaultOptions.dictFileTooBig = 'Файл слишком большой ({{filesize}}MB). Максимальный допустимый размер файла {{maxFilesize}}MB';
dropzone.prototype.defaultOptions.dictInvalidFileType = 'Вы не можете загружать файлы этого типа';
dropzone.prototype.defaultOptions.dictResponseError = 'Произошла ошибка при загрузке файла. Попробуйте еще раз. Если ошибка будет повторяться - передайте эту информацию администратору сайта: Код ошибки {{statusCode}}';
dropzone.prototype.defaultOptions.dictCancelUpload = 'Отменить загрузку';
dropzone.prototype.defaultOptions.dictCancelUploadConfirmation = 'Уверены, что хотите прервать загрузку?';
dropzone.prototype.defaultOptions.dictRemoveFile = 'Удалить файл';
dropzone.prototype.defaultOptions.dictRemoveFileConfirmation = null;
dropzone.prototype.defaultOptions.dictMaxFilesExceeded = 'Превышен лимит количества файлов. Вы можете загрузить не более {{maxFiles}}';
dropzone.prototype.defaultOptions.dictUploadCanceled = 'Загрузка отменена';

dropzone.autoDiscover = false;

const locationOrigin = window.location.origin;
const locationHref = window.location.href;
const targetUrl = locationHref.replace(locationOrigin, '');

const ELEMENTS_SELECTOR = {
    uploaderContainer: '[data-uploader]',
    uploaderArea: '[data-uploader-area]',
    uploaderPreviews: '[data-uploader-previews]',
    uploaderPreview: '[data-uploader-preview]',
    uploaderPreviewFilename: '[data-uploader-preview-filename]',
    uploaderPreviewFileFormat: '[data-uploader-preview-format]',
    uploaderPreviewFileSize: '[data-uploader-preview-size]',
};

const DATA_ATTRIBUTES = {
    params: 'uploader-area'
};

const baseConfig = {
    paramName: '',
    url: targetUrl,
    acceptedFiles: '.jpg, .jpeg, .png, .heic, .pdf',
    addRemoveLinks: false,
    dictRemoveFile: '',
    dictCancelUpload: '',
    maxFiles: 10,
    parallelUploads: 3,
    maxFileSize: 5, // Mb
    previewTemplate: `
        <div class="file" data-uploader-preview>
            <div class="file__prewiew">
                <div class="file__icon">
                    <svg class="icon icon--gallery">
                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-gallery"></use>
                    </svg>
                </div>

                <div class="file__name">
                    <h6 class="file__name-heading heading heading--tiny" data-uploader-preview-filename></h6>
                </div>
            </div>

            <div class="file__info">
                <div class="file__format" data-uploader-preview-format></div>

                <div class="file__weight" data-uploader-preview-size></div>

                <div class="file__delete" data-dz-remove>
                    <button type="button" class="file__delete-button button button--iconed button--simple button--gray">
                        <span class="file__delete-button-icon button__icon">
                            <svg class="icon icon--delete">
                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-delete"></use>
                            </svg>
                        </span>
                    </button>
                </div>
            </div>
            <div class="dropzone__previews-item-error" data-dz-errormessage></div>
        </div>
    `
};

function uploadFiles(el) {
    if(el.dropzone !== undefined) {
        return;
    }
    const $uploader = $(el);
    const $parentContainer = $uploader.closest(ELEMENTS_SELECTOR.uploaderContainer);
    const $previewsContainer = $parentContainer.find(ELEMENTS_SELECTOR.uploaderPreviews)[0];

    const initParams = $uploader.data(DATA_ATTRIBUTES.params);

    let config,
        _acceptedFiles = initParams.acceptedFiles,
        _maxFiles = initParams.maxFiles,
        _maxFileSize = initParams.maxFileSize,
        _paramName = initParams.paramName,
        acceptedFiles,
        maxFiles,
        maxFileSize,
        paramName;

    acceptedFiles = (_acceptedFiles && _acceptedFiles.length) ? _acceptedFiles : baseConfig.acceptedFiles;
    paramName = (_paramName && _paramName.length) ? _paramName : baseConfig.paramName;
    maxFiles = parseInt(_maxFiles) ? _maxFiles : baseConfig.maxFiles;

    maxFileSize = parseInt(_maxFileSize) ? _maxFileSize : baseConfig.maxFileSize;

    let newUrl = (initParams.url !== null) ? initParams.url : targetUrl;

    function fileNameCut(line) {
        if (line.length > 12) {
            return `${line.substr(0, 7)}...${line.substr(line.length - 2, line.length - 1)}`;
        } else {
            return line;
        }
    }

    function formatBytes(bytes, decimals = 2) {
        if (!+bytes) return '0 Bytes'
        const k = 1024
        const dm = decimals < 0 ? 0 : decimals
        const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB']
        const i = Math.floor(Math.log(bytes) / Math.log(k))
        return `${parseFloat((bytes / Math.pow(k, i)).toFixed(dm))} ${sizes[i]}`
    }

    config = $.extend({}, baseConfig, {
        paramName: paramName,
        url: newUrl,
        acceptedFiles: acceptedFiles,
        maxFiles: maxFiles,
        maxFileSize: maxFileSize,
        previewsContainer: $previewsContainer,
        previewTemplate: baseConfig.previewTemplate,
        init: function () {
            const self = this;

            self.on('addedfile', (file) => {
                let _file = file.name,
                    _filePreview = $(file.previewElement),
                    _filePreviewName = _filePreview.find(ELEMENTS_SELECTOR.uploaderPreviewFilename),
                    _filePreviewFormat = _filePreview.find(ELEMENTS_SELECTOR.uploaderPreviewFileFormat),
                    _filePreviewSize = _filePreview.find(ELEMENTS_SELECTOR.uploaderPreviewFileSize),
                    fileName = _file.substr(0, _file.lastIndexOf('.')),
                    fileType = _file.substr(_file.lastIndexOf('.') + 1, _file.length),
                    fileSize = file.size;

                _filePreviewName.html(fileNameCut(fileName));
                _filePreviewFormat.html(fileType);
                _filePreviewSize.html(formatBytes(fileSize));

            });

            self.on('success', (file, data) => {
                let _data = JSON.parse(data);
                file.id = _data['FILE_ID'];
            });
        },
    });

    $uploader.dropzone(config);
}

export default function (container) {
    const $elems = container ? $(container).find(ELEMENTS_SELECTOR.uploaderArea) : $(ELEMENTS_SELECTOR.uploaderArea);

    $elems.each((index, elem) => uploadFiles(elem));
}
