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

			if (!this.currentCity.city){
				navigator.geolocation.getCurrentPosition(async (pos)=>{
						const crd = pos.coords;

						this.coords.lat = crd.latitude
						this.coords.lon = crd.longitude

						let getGeoIpInfo = await this.getGeoIpInfo()
						this.geoIpInfo = getGeoIpInfo.data[0].data

						this.saveCity(this.geoIpInfo,true)
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
					this.saveCity(dadataCity)
				})
			},

			saveCity(dadataCity,noReload=false){

				BX.ajax.runAction('wizandr:geolocation.usercity.savecity', {
					data: {
						city: dadataCity,
					}
				})
					.then((res) => {
						if (res.status === 'success'){
							localStorage.setItem('current_city-name',dadataCity.city)
							localStorage.setItem('current_city-region-name',dadataCity.region)

							if (localStorage.getItem('deliveryPlaceAddress') !== null && !localStorage.getItem('deliveryPlaceAddress').toLowerCase().includes(dadataCity.city.toLowerCase()) ){
								this.clearAddressFromLS()
							}
							if (!noReload){
								location.reload()
							}else {
								this.getCurrentCity()
								$('#geolocationName').text(dadataCity.city)
							}

						}
					});
			},

			saveAddressToLS(place){
				console.log(place)
				localStorage.setItem('deliveryPlaceId',place.id)
				localStorage.setItem('deliveryPlaceAddressShort',place.address_short)
				localStorage.setItem('deliveryPlacePostalCode',place.postal_code)

				localStorage.setItem('deliveryPlaceFlat',place.flat??'')
				localStorage.setItem('deliveryPlaceAddressEntry',place.entry??'')
				localStorage.setItem('deliveryPlaceAddressHousepin',place.housepin??'')
				localStorage.setItem('deliveryPlaceFloor',place.floor??'')
				localStorage.setItem('deliveryPlaceGeoLat',place.geo_lat??'')
				localStorage.setItem('deliveryPlaceGeoLon',place.geo_lon??'')

			},

			clearAddressFromLS(){
				localStorage.removeItem('deliveryPlaceAddressShort')
				localStorage.removeItem('deliveryPlacePostalCode')
				localStorage.removeItem('deliveryPlaceFlat')
				localStorage.removeItem('deliveryPlaceAddressEntry')
				localStorage.removeItem('deliveryPlaceAddressHousepin')
				localStorage.removeItem('deliveryPlaceFloor')
				localStorage.removeItem('deliveryPlaceGeoLat')
				localStorage.removeItem('deliveryPlaceGeoLon')
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