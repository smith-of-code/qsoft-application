import dropzone from 'dropzone';

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
    uploaderError: '[data-uploader-error]',
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
            <div class="file__wrapper">
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

                    <div class="file__upload">
                        <a class="button button--iconed button--simple button--gray" href="/" download>
                            <span class="button__icon">
                                <svg class="icon icon--import">
                                    <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-import"></use>
                                </svg>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            <input type="hidden" data-dropzone-file>
            <div class="file__error" data-dz-errormessage></div>
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

    let newUrl = $uploader.data('request-url') != null ? $uploader.data('request-url') : targetUrl;

    let config,
        _acceptedFiles = initParams.acceptedFiles,
        _paramName = initParams.paramName,
        acceptedFiles,
        previewTemplate,
        maxFiles,
        maxFileSize,
        paramName;

    acceptedFiles = (_acceptedFiles && _acceptedFiles.length) ? _acceptedFiles : baseConfig.acceptedFiles;
    paramName = (_paramName && _paramName.length) ? _paramName : baseConfig.paramName;
    maxFiles = initParams.maxFiles ? initParams.maxFiles : baseConfig.maxFiles;
    maxFileSize = initParams.maxFileSize ? initParams.maxFileSize : baseConfig.maxFileSize;

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

    if (initParams.images === true) {
        previewTemplate = `
            <div class="dropzone__previews-picture dz-preview" data-uploader-preview>
                <div class="dropzone__previews-picture-box">
                    <div class="dropzone__previews-picture-image">
                        <img src="" alt="" class="dropzone__previews-picture-image-pic" data-dz-thumbnail />
                    </div>
                    <div class="dropzone__previews-item-remove" data-dz-remove>
                        <svg class="dropzone__previews-item-remove-icon icon icon--cross"><use xlink:href="/public/images/icons/sprite.svg#icon-cross"></use></svg>
                    </div>
                </div>
                <input type="hidden" data-dropzone-file>
                <div class="dropzone__previews-item-error" data-dz-errormessage></div>
            </div>
        `;
    } else {
        previewTemplate = baseConfig.previewTemplate;
    }

    config = $.extend({}, baseConfig, {
        paramName: paramName,
        url: newUrl,
        acceptedFiles: acceptedFiles,
        maxFiles: maxFiles,
        maxFilesize: maxFileSize,
        previewsContainer: $previewsContainer,
        previewTemplate: previewTemplate,
        thumbnailHeight: 720, // px
        thumbnailWidth: 1280, // px
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

                if (initParams.single === true) {
                    let _error = $($parentContainer).find(ELEMENTS_SELECTOR.uploaderError);
                    _error.text('');
                }

                _filePreviewName.html(fileNameCut(fileName));
                _filePreviewFormat.html(fileType);
                _filePreviewSize.html(formatBytes(fileSize));
            });

            self.on("maxfilesexceeded", function (file) {
                if (initParams.single === true) {
                    this.removeAllFiles();
                    this.addFile(file);
                }
            });

            self.on('error', (file, message) => {
                if (initParams.single === true) {
                    let _error = $($parentContainer).find(ELEMENTS_SELECTOR.uploaderError);

                    _error.text(message);
                    this.removeAllFiles();
                }
            });

            self.on('removedfile', (file) => {
                $.ajax({
                    url: "",
                    type: "POST",
                    data: { 'DEL_FILE_ID': file.id }
                });
                let delOpt = "[value='" + file.id + "']";
                $uploader.find(delOpt).remove();
            });

            self.on('success', (file, data) => {
                //для интеграции с бэком
                let decData = JSON.parse(data);
                let photoID = decData["FILE_ID"];
                file.id = photoID;

                $(file.previewElement).find('[data-dropzone-file]').val(file.id);
            });
        },
    });

    $uploader.dropzone(config);
}

export default function (container) {
    const $elems = container ? $(container).find(ELEMENTS_SELECTOR.uploaderArea) : $(ELEMENTS_SELECTOR.uploaderArea);
    $elems.each((index, elem) => uploadFiles(elem));
}
