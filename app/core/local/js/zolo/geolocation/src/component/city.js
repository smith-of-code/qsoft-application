export const City =
	{
		data() {
			return {
				cityId: '',
				cities:[],
				listArrivalPlace:[],
			};
		},
		mounted() {
			this.cityId = this.$bitrix.Data.get('currentCityId')
			this.cities = this.$bitrix.Data.get('saleCities')

			BX.ajax.runAction('wizandr:geolocation.usercity.list')
				.then((res) => {
					this.listArrivalPlace = res.data
					// Код после выполнения экшена
				});
		},
		computed:{
			activeCity() {
				return this.cities.find(e => +this.cityId === +e.ID)
			},
		},
		methods:{
			nbsp(text=''){
				return text.replace(' ', `&nbsp;`)
			},

			fetchListArrivalPlace(){
				BX.ajax.runAction('wizandr:geolocation.usercity.list')
					.then((res) => {
						this.listArrivalPlace = res.data
						// Код после выполнения экшена
					});
			},

			deleteArivalPlace(id){
				BX.ajax.runAction('wizandr:geolocation.usercity.delete', {
					data: {
						place_id: id
					}
				})
					.then(function () {

				});
				this.listArrivalPlace.splice(this.listArrivalPlace.findIndex(e=>e.id === id),1)

			}

			// getArrivalName(arrivalItem){
			// 	arrivalItem
			// }
		},

		template: `

        <section  class="modal__section modal__section--content modal-geolocation__content1" data-scrollbar data-modal-section>

            <img v-if="!listArrivalPlace.length" src="/local/templates/.default/images/delivery-box.png" alt="">
			<div v-else class="modal-geolocation__container">
			<p>
				Выберите адрес, чтобы увидеть условия доставки при оформлении заказа
			</p>
			</div>
			
            <div class="modal-geolocation__container">
            <div class="modal-geolocation__city">
                <div class="modal-geolocation__curr-city">
                    <img class="modal-geolocation__curr-city-icon" src="/local/templates/.default/images/icons/geolocation-big.svg" alt="">
                    <span class="modal-geolocation__curr-city-text" v-if="activeCity">Ваш город <b v-html="nbsp(activeCity.CITY_NAME)"></b></span>
                </div>
                <p class="modal-geolocation__change-city"
                @click="$emit('setTab','change-city')">Изменить</p>
            </div>
            
            <div class="modal-geolocation__arrival-card"  v-for="arrival_item in listArrivalPlace">
            	<button @click="deleteArivalPlace(arrival_item.id)" type="button" class="button button--ordinary button--iconed button--simple button--big button--red modal-geolocation__arrival-rm">
					<span class="button__icon">
						<svg class="icon">
							<use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-delete"></use>
						</svg>
					</span>
				</button>
            	<h4 class="modal-geolocation__arrival-header">Доставка по адресу</h4>
            	<p class="modal-geolocation__arrival-text">{{arrival_item.address}}</p>
			</div>
            
            
            <p v-if="!listArrivalPlace.length" class="modal-geolocation__message">
                Сохраните ваш адрес, удобный пункт выдачи или постамат, чтобы видеть условия доставки при оформлении заказа
            </p>
            <p v-else class="modal-geolocation__message">
                Добавьте адрес доставки или пункт выдачи
            </p>
            
            
            <button type="button" class="button button--full button--bold button--medium button--rounded button--covered button--green">
                    <b class="button__text" @click="$emit('setTab','address')">{{!listArrivalPlace.length?'Выбрать на карте':'Добавить'}}</b>
            </button>
            </div>



        </section>

    `
	};