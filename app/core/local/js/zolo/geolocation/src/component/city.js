export const City =
	{
		data() {
			return {
				cityId: '',
				cities:[]
			};
		},
		mounted() {
			this.cityId = this.$bitrix.Data.get('currentCityId')
			this.cities = this.$bitrix.Data.get('saleCities')
		},
		computed:{
			activeCity() {
				return this.cities.find(e => +this.cityId === +e.ID)
			},
		},
		methods:{
			nbsp(text=''){
				return text.replace(' ', `&nbsp;`)
			}
		},

		template: `

        <section  class="modal__section modal__section--content modal-geolocation__content1" data-scrollbar data-modal-section>

            <img src="/local/templates/.default/images/delivery-box.png" alt="">

            <div class="modal-geolocation__container">
            <div class="modal-geolocation__city">
                <div class="modal-geolocation__curr-city">
                    <img class="modal-geolocation__curr-city-icon" src="/local/templates/.default/images/icons/geolocation-big.svg" alt="">
                    <span class="modal-geolocation__curr-city-text" v-if="activeCity">Ваш город <b v-html="nbsp(activeCity.CITY_NAME)"></b></span>
                </div>
                <p class="modal-geolocation__change-city"
                @click="$emit('setTab','change-city')">изменить</p>
            </div>
            <p class="modal-geolocation__message">
                Сохраните ваш адрес, удобный пункт выдачи или постамат, чтобы видеть условия доставки при оформлении заказа
            </p>
            <button type="button" class="button button--full button--bold button--medium button--rounded button--covered button--green">
                    <b class="button__text" @click="$emit('setTab','address')">Выбрать на карте</b>
            </button>
            </div>



        </section>

    `
	};