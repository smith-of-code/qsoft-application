
export const YandexMap =
	{
		components: {
			// yandexMap, ymapMarker
		},
		inject: ['saveAddressToLS','clearAddressFromLS','cities'],
		emits:['update:modelValue','changeCoords'],
		props:{
			modelValue:String,
			coords:{
				default:[44.197334, 43.127487 ]
			},
			center:{
				default:[37.618918179574344, 55.75949895840033 ]
			},
			zoom: {
				default:15
			},
			id:{
				default:'yamap' + Math.random() * (1 - 9999) + 1
			},
			width:{
				default:'746'
			},
			height:{
				default:'719'
			}
		},
		data() {
			return {
				myMap:null,
				myPlacemark:null,
				address:'',
				firstGeoObject:null,

			};
		},


		computed: {},
		created() {},
		mounted() {
			this.initYamap()
		},

		methods: {
			change(text){
				this.$emit('update:modelValue',text)
			},

			initYamap(){
				let that = this

				let myPlacemark,
					myMap = new ymaps.Map(this.id, {
						center: this.center[0]?this.center:[37.618918179574344, 55.75949895840033],
						zoom: window.yaMapZoom??this.zoom,
						controls:['geolocationControl']
					}, {
						searchControlProvider: 'yandex#search'
					});

				if (this.coords[0]){
					myPlacemark = createPlacemark(this.coords)
					myMap.geoObjects.add(myPlacemark);
				}


				myMap.events.add('click', function (e) {
					var coords = e.get('coords');
					// console.log(coords);
					// Если метка уже создана – просто передвигаем ее.
					if (myPlacemark) {
						myPlacemark.geometry.setCoordinates(coords);
					}
					// Если нет – создаем.
					else {
						myPlacemark = createPlacemark(coords);
						myMap.geoObjects.add(myPlacemark);
						// Слушаем событие окончания перетаскивания на метке.
						myPlacemark.events.add('dragend', function () {

							getAddress(myPlacemark.geometry.getCoordinates());
						});
					}

					getAddress(coords);
				});


				myMap.events.add('boundschange',function (event) {

					window.yaMapZoom = event.get('newZoom')
				})

				// Создание метки.
				function createPlacemark(coords) {
					return new ymaps.Placemark(coords, {
						iconCaption: ''
					}, {
						preset: 'islands#violetDotIconWithCaption',
						draggable: true
					});
				}

				// Определяем адрес по координатам (обратное геокодирование).

				function getAddress(coords) {
					that.$emit('changeCoords',coords)
					// myPlacemark.properties.set('iconCaption', 'поиск...');
					ymaps.geocode(coords).then((res) =>{
						var firstGeoObject = res.geoObjects.get(0),
							address = firstGeoObject.getAddressLine();
						// console.log(firstGeoObject)


						// myPlacemark.properties
						// 	.set({
						// 		// Формируем строку с данными об объекте.
						// 		iconCaption: [
						// 			// Название населенного пункта или вышестоящее административно-территориальное образование.
						// 			firstGeoObject.getLocalities().length ? firstGeoObject.getLocalities() : firstGeoObject.getAdministrativeAreas(),
						// 			// Получаем путь до топонима, если метод вернул null, запрашиваем наименование здания.
						// 			firstGeoObject.getThoroughfare() || firstGeoObject.getPremise()
						// 		].filter(Boolean).join(', '),
						// 		// В качестве контента балуна задаем строку с адресом объекта.
						// 		balloonContent: address
						// 	});
						// myInput.value = address;
						console.log(address)
						that.change(address);
						// console.log(address)
					});

					console.log('address')
				}
			},

		},
		watch: {

		},

		template: `
			
		<div :id="id" class="map" :style="{width:width + 'px', height: height + 'px'}" ></div>

            
            


    `
	};