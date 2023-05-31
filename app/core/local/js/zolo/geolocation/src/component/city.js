export const City =
	{
		inject: ['saveAddressToLS','clearAddressFromLS'],

		data() {
			return {
				cityId: '',
				cities:[],
				listDeliveryPlace:[],
				activeDeliveryPlaceId:0
			};
		},
		mounted() {
			this.cityId = this.$bitrix.Data.get('currentCityId')
			this.cities = this.$bitrix.Data.get('saleCities')

			this.activeDeliveryPlaceId = localStorage.getItem('deliveryPlaceId')??0
			this.fetchListDeliveryPlace()
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

			fetchListDeliveryPlace(){
				BX.ajax.runAction('wizandr:geolocation.useraddress.list')
					.then((res) => {
						this.listDeliveryPlace = res.data
						// Код после выполнения экшена
					});
			},

			deleteDeliveryPlace(id){
				BX.ajax.runAction('wizandr:geolocation.useraddress.delete', {
					data: {
						place_id: id
					}
				})
					.then(function () {

				});
				this.listDeliveryPlace.splice(this.listDeliveryPlace.findIndex(e=>e.id === id),1)

			},
			setCurrentDelivery(event,place){

				let city = this.$bitrix.Data.get('saleCities').find(e=>
					e.CITY_NAME.toLowerCase() === place.city.toLowerCase()
					&&
					(
						place.city  === place.region || (e.REGION_NAME!==null && e.REGION_NAME.toLowerCase().includes(place.region.toLowerCase()))
					)
				)

				if (!city){
					city = this.$bitrix.Data.get('saleCities').find(e=>e.CITY_NAME.toLowerCase() === place.city.toLowerCase())
				}

				console.log(place)
				this.activeDeliveryPlaceId = place.id
				this.saveAddressToLS(place)
				this.$emit('updateCity',city)
			},

			isActiveDeliveryPlace(place){
				return place.id === this.activeDeliveryPlaceId
			}

		},

		template: `


            <img v-if="!listDeliveryPlace.length" src="/local/templates/.default/images/delivery-box.png" alt="">
			<div v-else class="modal-geolocation__container mt-15">
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
            
            <div class="modal-geolocation__delivery-card" :class="{active:isActiveDeliveryPlace(delivery_item)}"  @click="setCurrentDelivery($event,delivery_item)"  v-for="delivery_item in listDeliveryPlace">
            	<button @click.stop="deleteDeliveryPlace(delivery_item.id)" type="button" class="button button--ordinary button--iconed button--simple button--big button--red modal-geolocation__delivery-rm">
					<span class="button__icon">
						<svg class="icon">
							<use xlink:href="/local/templates/.default/images/icons/sprite.svg#icon-delete"></use>R
						</svg>
					</span>
				</button>
            	<h4 class="modal-geolocation__delivery-header">Доставка по адресу</h4>
            	<p class="modal-geolocation__delivery-text">{{delivery_item.address}}</p>
			</div>
            
            
            <p v-if="!listDeliveryPlace.length" class="modal-geolocation__message">
                Сохраните ваш адрес, удобный пункт выдачи или постамат, чтобы видеть условия доставки при оформлении заказа
            </p>
            <p v-else class="modal-geolocation__message">
                Добавьте адрес доставки или пункт выдачи
            </p>
            
            
            <button @click="$emit('setTab','address')" type="button" class="button button--full button--bold button--medium button--rounded button--covered button--green">
                    <b class="button__text" >{{!listDeliveryPlace.length?'Выбрать на карте':'Добавить'}}</b>
            </button>
            </div>



       

    `
	};