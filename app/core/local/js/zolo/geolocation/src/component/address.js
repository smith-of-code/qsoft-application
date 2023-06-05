
export const Address =
	{
		inject: ['saveAddressToLS','clearAddressFromLS','cities'],
		data() {
			return {
				place: {
					kladr_id:null,
					address: '',
					address_short: '',
					flat: '',
					postal_code: '',
					entry: '',
					housepin: '',
					floor: '',
					city:'',
					region:'',
					fias_level:null
				},
				errors:{
					address: '',
					save:''
				},
				isOpenSearchResult:false,

				searchResult:[],
				settings :{
					apiKey: '',
					lang: 'ru_RU',
					coordorder: 'latlong',
					enterprise: false,
					version: '2.1'
				},
				acceptSearch:true
			};
		},


		computed: {},
		created() {},
		mounted() {

			this.place.id = localStorage.getItem('deliveryPlaceId')??'0'

			this.place.kladr_id = localStorage.getItem('deliveryPlaceKladrId')
			this.place.address = localStorage.getItem('deliveryPlaceAddress')
			this.place.address_short = localStorage.getItem('deliveryPlaceAddressShort')
			this.place.flat = localStorage.getItem('deliveryPlaceFlat')
			this.place.postal_code = localStorage.getItem('deliveryPlacePostalCode')
			this.place.entry = localStorage.getItem('deliveryPlaceAddressEntry')
			this.place.housepin = localStorage.getItem('deliveryPlaceAddressHousepin')
			this.place.floor = localStorage.getItem('deliveryPlaceFloor')
			this.place.city = localStorage.getItem('deliveryPlaceCity')
			this.place.region = localStorage.getItem('deliveryPlaceRegion')

			// new ymaps.Map('yandMap1',{
			// 	center: [55.74954, 37.621587],
			// 	zoom: 10,
			// 	controls: []
			// })





		},

		methods: {
			fillPlace(place) {
				this.place.address = place.value
				this.place.address_short = place.data.street_with_type  + (place.data.house? ', '+place.data.house:'') + (place.data.block_type?', '+place.data.block_type+' '+place.data.block:'')


				this.place.postal_code = place.data.postal_code
				this.place.kladr_id = place.data.kladr_id
				this.place.city = place.data.city
				this.place.region = place.data.region
				this.place.fias_level = place.data.fias_level
				this.isOpenSearchResult = false
				console.log(place)
			},

			async saveAddress() {

				this.errors.save = ''

				if (+this.place.fias_level < 7){
					this.errors.address = 'Не заполнен номер дома'
					return
				}

				//ищем по условию, что если название города и региона в нижнем регистре совпадает, за исключением тех случаев когда город и регион одинаковы в dadata (Санкт петербург)
				let city = this.cities.find(e=>
					e.CITY_NAME.toLowerCase() === this.place.city.toLowerCase()
					&&
					(
						this.place.city  === this.place.region || (e.REGION_NAME!==null && e.REGION_NAME.toLowerCase().includes(this.place.region.toLowerCase()))
					)
				)

				if (!city){
					city = this.cities.find(e=>e.CITY_NAME.toLowerCase() === this.place.city.toLowerCase())
				}


				BX.ajax.runAction('wizandr:geolocation.useraddress.add', {
					data: {
						place: this.place
					}
				}).then(res=> {

					this.place.id = res.data.id
					this.saveAddressToLS(this.place)
					this.$emit('updateCity',city)

				}).catch(err=>{

					this.errors.save = 'Адрес уже добавлен'

				});
			},



		},
		watch: {
			'place.address'(newVal) {
				this.errors.address = ''
				if (newVal && newVal.length > 3 && this.acceptSearch) {
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
							this.acceptSearch = false
							setTimeout(()=>{
								this.acceptSearch = true
							},3000)
							// Код после выполнения экшена
						});
				}

			}

		},

		template: `

            <div class="geolocation__address--form">
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
                                <input type="text" class="input__control" :class="{'input__control--error':errors.address.length}" autocomplete="off" v-model="place.address" @input="isOpenSearchResult=true" @focus="place.address = place.address" name="address">
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
            <div class="form__row">
				<div class="form__col">
					<button @click="saveAddress()" type="button" class="button button--full button--bold button--medium button--rounded button--covered button--green">
							<b class="button__text" >Сохранить адрес</b>
					 </button>
					 <span v-if="errors.save.length" class="input__control-error">{{errors.save}}</span>
				</div>
			</div>
		</div>

<!--            <div class="geolocation__yamap__container">-->
<!--            <div id="yandMap1" style="width:746px; height: 400px;" ></div>-->
<!--            </div>-->

            <div class="modal-geolocation__container">
            

            </div>


    `
	};