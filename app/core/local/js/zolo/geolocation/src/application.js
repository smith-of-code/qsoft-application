/**
 *  Если написать что-то не на ANSII (EN), то  автоматически будет выбрана кодировка UTF-8
 *  Это происходит автоматически. Больше ничего делать не нужно.
 */
/**
 * GeoLocation Application
 *
 * @package demo
 * @subpackage local
 * @copyright 2001-2022 Bitrix
 */

import {BitrixVue} from 'ui.vue3';
// import {Dom, Loc} from 'main.core';
import YmapPlugin from 'vue-yandex-maps'

import {GeolocationMain} from './component/geolocation';

export class GeoLocation
{
	#geolocation;
	props;

	constructor(rootNode,props={}): void
	{
		this.rootNode = document.querySelector(rootNode);
		this.props = props
	}

	start(): void
	{
		this.attachTemplate()
	}

	attachTemplate(): void
	{
		const context = this;

		this.#geolocation = BitrixVue.createApp({
			name: 'Geolocation',
			components: {
				GeolocationMain
			},
			data(){return{
				activeTab:context.props.activeTab
			}},
			beforeCreate(): void
			{
				this.$bitrix.Application.set(context);
				this.$bitrix.Data.set('saleCities',context.props.cities)
				this.$bitrix.Data.set('currentCityId',context.props.currentCityId)
				this.$bitrix.Data.set('currentCityKladrId',context.props.currentCityId)
			},
			template: `
<GeolocationMain :start-tab="activeTab"/>

<yandex-map 
  :coords="[54.62896654088406, 39.731893822753904]"
  zoom="10"
  style="width: 600px; height: 600px;"
  :cluster-options="{
    1: {clusterDisableClickZoom: true}
  }"
  :behaviors="['ruler']"
  :controls="['trafficControl']"
  map-type="hybrid"
  @map-was-initialized="initHandler"
>
</yandex-map>
`
		});
		this.#geolocation.use(YmapPlugin)
		this.#geolocation.mount(this.rootNode)
	}

	detachTemplate(): void
	{
		if (this.#geolocation)
		{
			this.#geolocation.unmount();
		}

		this.start();
	}
}
