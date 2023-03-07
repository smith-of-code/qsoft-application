import {useDropzoneStore} from "../../../../stores/dropzoneStore";

let id = 0;

export const Dropzone = {
    props: {
        files: {
            type: Array,
            default: [],
        },
        editing: {
            type: Boolean,
            default: false,
        },
    },

    data() {
        return {
            componentId: 'dropzone-' + ++id,
        };
    },

    setup () {
        return { store: useDropzoneStore() };
    },

    methods: {
        async uploadFile(event) {
            const data = new FormData();
            for (let i = 0; i < event.target.files.length; i++) {
                data.append(`file-${i}`, event.target.files[i]);
            }
            const response = await this.store.uploadFile(data);
            for (const fileInfo of response.data) {
                this.files.push(fileInfo);
            }
            this.$emit('upload', response.data);
        },
        deleteFile(file) {
            // this.store.deleteFile(file.id); Файлы не удаляются т.к. они нужны для тикетов тех поддержки
            this.files.splice(this.files.indexOf(file), 1);
            this.$emit('delete', file.id);
        },
    },

    template: `
      <div v-if="!editing && !files.length" class="profile__notification">
        <span class="profile__notification-icon">
            <svg class="icon icon--danger">
                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-danger"></use>
            </svg>
        </span>
        <p class="profile__notification-text">Необходимо приложить документы. Войдите в режим редактирования.</p>
      </div>
      
      <div class="dropzone">
          <input type="file" ref="file" :name="componentId" :id="componentId" multiple class="dropzone__control" @change="uploadFile($event)">
          <div class="dropzone__area">
            <div class="profile__toggle dropzone__message dz-message needsclick">
              <label :for="componentId" class="dropzone__button dropzone__button--profile button button--medium button--rounded button--covered button--red">
                    <span class="button__icon">
                        <svg class="icon icon--import">
                            <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-import"></use>
                        </svg>
                    </span>
                <span class="button__text">Загрузить файл</span>
              </label>
            </div>
    
            <div class="dropzone__previews dropzone__previews--profile dz-previews">
              <div v-for="file in files" :key="file.id" class="file dz-processing dz-image-preview dz-success dz-complete">
                <div class="file__wrapper">
                  <div class="file__prewiew">
                    <div class="file__icon">
                      <svg class="icon icon--gallery">
                        <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-gallery"></use>
                      </svg>
                    </div>
    
                    <div class="file__name">
                      <h6 class="file__name-heading heading heading--tiny">{{ file.name }}</h6>
                    </div>
                  </div>
    
                  <div class="file__info">
                    <div class="file__format">{{ file.src.slice(-5) == '.heic' ? 'HEIC' : file.format }}</div>
                    <div class="file__weight">{{ file.size }}</div>
    
                    <div v-if="editing" class="file__delete">
                      <button type="button" class="file__delete-button button button--iconed button--simple button--gray" @click="deleteFile(file)">
                        <span class="file__delete-button-icon button__icon">
                            <svg class="icon icon--delete">
                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-delete"></use>
                            </svg>
                        </span>
                      </button>
                    </div>
                    <div v-else class="file__upload">
                      <a class="button button--iconed button--simple button--gray" :href="file.src" download>
                        <span class="button__icon">
                            <svg class="icon icon--import">
                                <use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-import"></use>
                            </svg>
                        </span>
                      </a>
                    </div>
                  </div>
                </div>
                <div class="file__error"></div>
              </div>
            </div>
          </div>
      </div>
    `,
};