// import { yandexMap, ymapMarker } from 'vue-yandex-maps'
import {YandexMap} from './yandexMap'

export const Address =
	{
		components: {
			YandexMap
		},
		inject: ['saveAddressToLS','clearAddressFromLS','cities'],
		data() {
			return {
				address:'',
				place: {
					address_short: '',
					postal_code:'',
					city:'',
					flat: '',
					entry: '',
					housepin: '',
					floor: '',
					geo_lat:'',
					geo_lon:'',
				},
				yandex_map_lat:null,
				yandex_map_lon:null,
				errors:{
					address: '',
					save:''
				},
				isOpenSearchResult:false,
				mapKey:'ddfsdf',
				searchResult:[],
				acceptSearch:true
			};
		},


		computed: {
			isMobile(){
				return window.screen.width < 768

			}
		},
		created() {},
		mounted() {

			this.place.id = localStorage.getItem('deliveryPlaceId')??'0'

			this.place.address_short = localStorage.getItem('deliveryPlaceAddressShort')
			this.place.postal_code = localStorage.getItem('deliveryPlacePostalCode')
			this.place.flat = localStorage.getItem('deliveryPlaceFlat')
			this.place.entry = localStorage.getItem('deliveryPlaceAddressEntry')
			this.place.housepin = localStorage.getItem('deliveryPlaceAddressHousepin')
			this.place.floor = localStorage.getItem('deliveryPlaceFloor')
			this.place.geo_lat = localStorage.getItem('deliveryPlaceGeoLat')
			this.place.geo_lon = localStorage.getItem('deliveryPlaceGeoLon')
			this.mapKey += 'sdfsd3'

		},

		methods: {


			async changeCoords(coords){

				this.yandex_map_lat=coords[1]
				this.yandex_map_lon=coords[0]
				// let data = await BX.ajax.runAction('wizandr:geolocation.dadata.address',{
				// 	data:{
				// 		lat:coords[1],
				// 		lon:coords[0],
				// 		count:1
				// 	}
				//
				// })
				// this.fillPlace(data.data[0])



			},
			addressInput(e){
				this.isOpenSearchResult=true
				this.place.address = e.target.value
			},

			fillPlace(place) {
				this.address = place.value
				this.place.address_short = place.data.street_with_type  + (place.data.house? ', '+place.data.house:'') + (place.data.block_type?', '+place.data.block_type+' '+place.data.block:'')

				this.place.city = place.data.city
				this.place.postal_code = place.data.postal_code
				this.place.geo_lat = this.yandex_map_lat??place.data.geo_lat
				this.place.geo_lon = this.yandex_map_lon??place.data.geo_lon
				this.yandex_map_lat = null
				this.yandex_map_lon = null
				this.mapKey += 'sdfsd3'

				this.isOpenSearchResult = false
			},

			async saveAddress() {

				this.errors.save = ''

				if (+this.place.fias_level < 7){
					this.errors.address = 'Не заполнен номер дома'
					return
				}

				// //ищем по условию, что если название города и региона в нижнем регистре совпадает, за исключением тех случаев когда город и регион одинаковы в dadata (Санкт петербург)
				// let city = this.cities.find(e=>
				// 	e.CITY_NAME.toLowerCase() === this.place.city.toLowerCase()
				// 	&&
				// 	(
				// 		this.place.city  === this.place.region || (e.REGION_NAME!==null && e.REGION_NAME.toLowerCase().includes(this.place.region.toLowerCase()))
				// 	)
				// )
				//
				// if (!city){
				// 	city = this.cities.find(e=>e.CITY_NAME.toLowerCase() === this.place.city.toLowerCase())
				// }


				BX.ajax.runAction('wizandr:geolocation.useraddress.add', {
					data: {
						place: {...this.place}
					}
				}).then(res=> {

					this.place.id = res.data.id
					this.saveAddressToLS(this.place)
					this.$emit('updateCity',{CITY_NAME:this.place.city})

				}).catch(err=>{

					this.errors.save = 'Адрес уже добавлен'

				});
			},



		},
		watch: {
			'address'(newVal) {
				this.errors.address = ''
				if (newVal && newVal.length > 3 && this.acceptSearch) {
					this.acceptSearch = false
					BX.ajax.runAction('wizandr:geolocation.dadata.suggest', {
						data: {
							query: newVal
						}
					})
						.then((res) => {
							this.searchResult = res.data
							if (!this.isOpenSearchResult){
								this.fillPlace(res.data[0])
							}
							// this.acceptSearch = false
							// setTimeout(()=>{
								this.acceptSearch = true
							// },3000)
							// Код после выполнения экшена
						}).catch(e=>{
						this.acceptSearch = true
					});
				}

			}

		},

		template: `
		<div class="modal-geolocation__address">
            <div class="geolocation__address--form">
            
            <div>
            <div class="form__row">
                <div class="form__col">
                    <div class="form__field">
                        <div class="form__field-block form__field-block--label">
                            <label for="address" class="form__label ">
                                <span class="form__label-text">Город, улица, дом</span>
                            </label>
                        </div>

                        <div class="form__field-block form__field-block--input">
                            <div class="input">
                                <input type="text" ref="placeAddress" class="input__control" :class="{'input__control--error':errors.address.length}" autocomplete="off" v-model="address" @input="addressInput" @focus="address = address" name="address">
                            	<span v-if="errors.address.length" class="input__control-error">{{errors.address}}</span>
                            </div>
                        </div>
                        <div v-if="searchResult.length && isOpenSearchResult" class="form__field-search--result  scroll_bar_alt">
                            <p v-for="placeItem in searchResult" @click="fillPlace(placeItem)" >{{placeItem.value}}</p>
                        </div>

                    </div>
                </div>
            </div>

            <div class="form__row">
                <div class="form__col">
                    <div class="form__field">
                        <div class="form__field-block form__field-block--label">
                            <label for="flat" class="form__label ">
                                <span class="form__label-text">Квартира/офис</span>
                            </label>
                        </div>

                        <div class="form__field-block form__field-block--input">
                            <div class="input">
                                <input type="text" class="input__control" v-model="place.flat" name="flat">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form__col">
                    <div class="form__field">
                        <div class="form__field-block form__field-block--label">
                            <label for="postal_code" class="form__label ">
                                <span class="form__label-text">Индекс</span>
                            </label>
                        </div>

                        <div class="form__field-block form__field-block--input">
                            <div class="input">
                                <input type="text" class="input__control" disabled :value="place.postal_code" name="postal_code">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form__row">
                <div class="form__col">
                    <div class="form__field">
                        <div class="form__field-block form__field-block--label">
                            <label for="entry" class="form__label ">
                                <span class="form__label-text">Подъезд</span>
                            </label>
                        </div>

                        <div class="form__field-block form__field-block--input">
                            <div class="input">
                                <input type="text" class="input__control" v-model="place.entry" name="entry">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form__col">
                    <div class="form__field">
                        <div class="form__field-block form__field-block--label">
                            <label for="floor" class="form__label ">
                                <span class="form__label-text">Этаж</span>
                            </label>
                        </div>

                        <div class="form__field-block form__field-block--input">
                            <div class="input">
                                <input type="text" class="input__control" v-model="place.floor" name="floor">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form__col">
                    <div class="form__field">
                        <div class="form__field-block form__field-block--label">
                            <label for="housepin" class="form__label ">
                                <span class="form__label-text">Домофон</span>
                            </label>
                        </div>

                        <div class="form__field-block form__field-block--input">
                            <div class="input">
                                <input type="text" class="input__control" v-model="place.housepin" name="housepin">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			</div>
			<div class="form__row">
			<div class="form__col">
			<yandex-map v-if="isMobile" v-model="address" :coords="[place.geo_lon,place.geo_lat]" :center="[place.geo_lon,place.geo_lat]" :key="'map_mobile'+mapKey" width="311" height="213"></yandex-map>
			</div>
			</div>
            <div class="form__row">
				<div class="form__col">
					<button @click="saveAddress()" type="button" class="button button--full button--bold button--medium button--rounded button--covered button--green">
							<b class="button__text" >Сохранить адрес</b>
					 </button>
					 <span v-if="errors.save.length" class="input__control-error">{{errors.save}}</span>
				</div>
			</div>
			
		</div>
			<yandex-map v-if="!isMobile" v-model="address" @changeCoords="changeCoords"  :coords="[place.geo_lon,place.geo_lat]" :center="[place.geo_lon,place.geo_lat]" :key="'map_desktop'+mapKey"></yandex-map>
		</div>
            


    `
	};