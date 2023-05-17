
export const Address =
	{
		data() {
			return {
				place: {
					kladr_id:null,
					address: '',
					flat: '',
					postal_code: '',
					entry: '',
					housepin: '',
					floor: '',
				},
				isOpenSearchResult:false,

				searchResult:[],
				settings :{
					apiKey: '',
					lang: 'ru_RU',
					coordorder: 'latlong',
					enterprise: false,
					version: '2.1'
				}
			};
		},


		computed: {},
		created() {},
		mounted() {

			new ymaps.Map('yandMap1',{
				center: [55.74954, 37.621587],
				zoom: 10,
				controls: []
			})





		},

		methods: {
			fillPlace(place) {
				this.place.address = place.value
				this.place.postal_code = place.data.postal_code
				this.place.kladr_id = place.data.kladr_id

				this.isOpenSearchResult = false
				console.log(this.place)
			},

			async saveCity() {
				// prominado – префикс партнера, отделяется двоеточием
				// module – название модуля
				// api – приставка из .settings.php
				// updater.apply – название класса и метода без постфикса Action

				BX.ajax.runAction('wizandr:geolocation.usercity.add', {
					data: {
						place: this.place
					}
				})
				.then(function () {

				});
			},


		},
		watch: {
			'place.address'(newVal) {
				if (newVal.length > 3) {
					BX.ajax.runAction('wizandr:geolocation.usercity.dadata', {
						data: {
							query: newVal
						}
					})
						.then((res) => {
							this.searchResult = res.data
							// Код после выполнения экшена
						});
				}

			}

		},

		template: `

        <section class="modal__section modal__section--content geolocation__address" data-scrollbar data-modal-section>
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
                                <input type="text" class="input__control" autocomplete="off" v-model="place.address" @input="isOpenSearchResult=true" name="address">
                            </div>
                        </div>
                        <div v-if="searchResult.length && isOpenSearchResult" class="form__field-search--result">
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

            <div class="geolocation__yamap__container">
            <div id="yandMap1" style="width:746px; height: 400px;" ></div>
            </div>

            <div class="modal-geolocation__container">
                <button type="button" class="button button--full button--bold button--medium button--rounded button--covered button--green">
                        <b class="button__text" @click="saveCity()">Сохранить адрес</b>
                </button>
            </div>

        </section>

    `
	};