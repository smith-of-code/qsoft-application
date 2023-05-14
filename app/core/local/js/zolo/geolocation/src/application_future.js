import {BitrixVue} from 'ui.vue3';
import geolocationMain from './component/geolocation'
const Component = {
	template: 'Hello, world!'
};

window.geolocation1 = BitrixVue.createApp({
	components: {
		Component
	},
	template: `
        <Component/>
    `
});


// export class GeoLocation
// {
// 	#geolocation;
// 	props;
//
// 	constructor(rootNode,props= {
// 		cities:[]
// 	}): void
// 	{
// 		this.rootNode = document.querySelector(rootNode);
// 		this.props = props
// 	}
//
// 	start(): void
// 	{
// 		this.attachTemplate()
// 	}
//
// 	attachTemplate(): void
// 	{
// 		const context = this;
//
// 		this.#geolocation = BitrixVue.createApp({
// 			name: 'Geolocation',
// 			props:['cities'],
// 			components: {
// 				GeolocationMain
// 			},
// 			beforeCreate(): void
// 			{
// 				this.$bitrix.Application.set(context);
// 			},
// 			template: '<GeolocationMain :cities="cities" />'
// 		},{cities:this.props.cities});
// 		this.#geolocation.mount(this.rootNode)
// 	}
//
// 	detachTemplate(): void
// 	{
// 		if (this.#geolocation)
// 		{
// 			this.#geolocation.unmount();
// 		}
//
// 		this.start();
// 	}
// }
