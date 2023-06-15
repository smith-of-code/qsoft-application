import {Address} from "./address";
import {ChangeCity} from "./changeCity";
import {City} from "./city";

export const GeolocationMain =
	{
		components: {
			Address,
			ChangeCity,
			City
		},

		provide() {
			// use function syntax so that we can access `this`
			return {
				saveAddressToLS:this.saveAddressToLS,
				clearAddressFromLS:this.clearAddressFromLS,
				cities:this.cities,
				currentCity:this.currentCity
			}
		},


		data() {
			return {
				tabs: [
					{
						name: 'city',
						title: 'Куда доставить ваш&nbsp;заказ?',
						isActive: true
					},
					{
						name: 'change-city',
						title: 'Выберите город',
						isActive: false
					},
					{
						name: 'address',
						title: 'Укажите ваш адрес для&nbsp;доставки заказов',
						isActive: false
					}
				],
				cities:[],
				currentCity:{},
				coords:{lat:0,lon:0},
				geoIpInfo:null,
				loaded:false
			};
		},
		props:{
			startTab:{}
		},
		computed: {
			activeTab() {
				return this.tabs.find(e => e.isActive)
			},
		},

		created() {},

		async mounted() {
			this.setActiveTab(this.startTab)

			await this.getCityList()

			await this.getCurrentCity()

			if (!this.currentCity.ID){
				navigator.geolocation.getCurrentPosition(async (pos)=>{
						const crd = pos.coords;

						this.coords.lat = crd.latitude
						this.coords.lon = crd.longitude

						let getGeoIpInfo = await this.getGeoIpInfo()
						this.geoIpInfo = getGeoIpInfo.data[0].data


						let city = this.cities.find(e=>{
							return e.CITY_NAME === this.geoIpInfo.city
						})

						this.saveCity(city,this.geoIpInfo,true)
						await this.getCurrentCity()


					}, (err)=>{
						console.log(err)
					},
					{
						enableHighAccuracy: true,
						timeout: 5000,
						maximumAge: 0,
					});
			}


			this.loaded = true

		},

		methods: {

			async getCityList(){
				let res = await BX.ajax.runAction('wizandr:geolocation.usercity.getcitylist')

				this.cities.push(...res.data)
			},

			async getCurrentCity(){
				let res = await BX.ajax.runAction('wizandr:geolocation.usercity.getcity')

				this.currentCity = Object.assign(this.currentCity,res.data)
			},

			async getGeoIpInfo(){

				return  BX.ajax.runAction('wizandr:geolocation.dadata.address',{
					data:{
						lat:this.coords.lat,
						lon:this.coords.lon,
						count:1
					}

				})

			},


			setActiveTab(name) {
				this.tabs.forEach(e => {
					e.isActive = e.name === name;
				})

			},

			async setCity(city){


				let dadataCity =null

				BX.ajax.runAction('wizandr:geolocation.dadata.suggest', {
					data: {
						query: city.CITY_NAME,
						only_city:true
					}
				})
				.then((res) => {
					dadataCity = res.data[0].data
					this.saveCity(city,dadataCity)
				})
			},

			saveCity(city,dadataCity,noReload=false){

				BX.ajax.runAction('wizandr:geolocation.usercity.savecity', {
					data: {
						city: {...city,...{city_kladr_id:dadataCity.city_kladr_id}},
					}
				})
					.then((res) => {
						if (res.status === 'success'){
							localStorage.setItem('current_city-id',city.CITY_ID)
							localStorage.setItem('current_city-city_kladr_id',dadataCity.city_kladr_id)
							localStorage.setItem('current_city-name',city.CITY_NAME)
							localStorage.setItem('current_city-region-name',city.REGION_NAME)

							if (localStorage.getItem('deliveryPlaceAddress') !== null && !localStorage.getItem('deliveryPlaceAddress').toLowerCase().includes(city.CITY_NAME.toLowerCase()) ){
								this.clearAddressFromLS()
							}
							if (!noReload){
								location.reload()
							}else {
								this.getCurrentCity()
								$('#geolocationName').text(city.CITY_NAME)
							}

						}
					});
			},

			saveAddressToLS(place){
				console.log(place)
				localStorage.setItem('deliveryPlaceId',place.id)
				localStorage.setItem('deliveryPlaceKladrId',place.kladr_id)
				localStorage.setItem('deliveryPlaceKladrId',place.kladr_id)
				localStorage.setItem('deliveryPlaceAddress',place.address)
				localStorage.setItem('deliveryPlaceAddressShort',place.address_short)

				localStorage.setItem('deliveryPlaceFlat',place.flat??'')
				localStorage.setItem('deliveryPlacePostalCode',place.postal_code)
				localStorage.setItem('deliveryPlaceAddressEntry',place.entry??'')
				localStorage.setItem('deliveryPlaceAddressHousepin',place.housepin??'')
				localStorage.setItem('deliveryPlaceFloor',place.floor??'')
				localStorage.setItem('deliveryPlaceCity',place.city??'')
				localStorage.setItem('deliveryPlaceRegion',place.region??'')

			},

			clearAddressFromLS(){
				localStorage.removeItem('deliveryPlaceKladrId')
				localStorage.removeItem('deliveryPlaceAddress')
				localStorage.removeItem('deliveryPlaceAddressShort')

				localStorage.removeItem('deliveryPlaceFlat')
				localStorage.removeItem('deliveryPlacePostalCode')
				localStorage.removeItem('deliveryPlaceAddressEntry')
				localStorage.removeItem('deliveryPlaceAddressHousepin')
				localStorage.removeItem('deliveryPlaceFloor')
				localStorage.removeItem('deliveryPlaceCity')
				localStorage.removeItem('deliveryPlaceRegion')
			}
		},
		watch: {

		},

		template: `
			<section v-if="loaded"  class="modal__section modal__section--content" :class="['modal-geolocation__content-'+activeTab.name]" data-scrollbar data-modal-section>
            
            <header :class="{'modal-geolocation__container':activeTab.name === 'city'}">
            <h3 class="geolocation__header" v-html="activeTab.title"></h3>
			</header>
            
        <component :is="activeTab.name" @setTab="setActiveTab($event)" @updateCity="setCity" />
        
         </section>
    `
	};