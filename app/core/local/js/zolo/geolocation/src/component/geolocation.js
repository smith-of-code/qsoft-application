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

		data() {
			return {
				tabs: [
					{
						name: 'city',
						title: 'Куда доставить ваш заказ?',
						isActive: true
					},
					{
						name: 'change-city',
						title: 'Выберите город',
						isActive: false
					},
					{
						name: 'address',
						title: 'Укажите ваш адрес для доставки заказов',
						isActive: false
					}
				],
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

		mounted() {
			this.setActiveTab(this.startTab)
		},

		methods: {
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
								this.$bitrix.Data.set('currentCityId',city.CITY_ID)
								$('#geolocationName').text(city.CITY_NAME)
								this.setActiveTab('city')
							}
						});


				})




			}
		},
		watch: {

		},

		template: `

        <header class="modal__section modal__section--header ">
            <h3 class="geolocation__header">{{activeTab.title}}</h3>
        </header>
        <component :is="activeTab.name" @setTab="setActiveTab($event)" @updateCity="setCity" />
    `
	};