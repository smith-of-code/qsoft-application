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
		},
		watch: {

		},

		template: `

        <header class="modal__section modal__section--header ">
            <h3 class="geolocation__header">{{activeTab.title}}</h3>
        </header>
        <component :is="activeTab.name" @setTab="setActiveTab($event)" />
    `
	};