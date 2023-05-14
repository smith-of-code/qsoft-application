export const ChangeCity =
	{
		components: {},

		data() {
			return {
				cityId:null,
				inputSearchCity: '',
				searchResult: [],
				isOpenSearchResult:false,
				cities:[]
			};
		},

		computed: {

			filterCity() {
				let result = []
				this.cities.forEach(e => {
					if (!this.inputSearchCity || !this.inputSearchCity || e.CITY_NAME.toLowerCase().startsWith(this.inputSearchCity.toLowerCase())) {
						result.push(e)
					}
				})
				return result
			}


		},

		created() {

		},

		mounted() {
			this.cityId = this.$bitrix.Data.get('currentCityId')
			this.cities = this.$bitrix.Data.get('saleCities')
		},

		methods: {
			isSelectedCity(city) {
				return +city.ID === +this.cityId
			},

			setCity(city){

				BX.ajax.runAction('wizandr:geolocation.usercity.savecity', {
					data: {
						city: city,
					}
				})
				.then((res) => {
					if (res.status === 'success'){
						localStorage.setItem('current_city-id',city.CITY_ID)
						localStorage.setItem('current_city-name',city.CITY_NAME)
						localStorage.setItem('current_city-region-name',city.REGION_NAME)
						this.$bitrix.Data.set('currentCityId',city.CITY_ID)
						$('#geolocationName').text(city.CITY_NAME)
						this.$emit('setTab','city')
					}
				});

			}
		},

		template: `
        <section class="modal__section modal__section--content" data-scrollbar data-modal-section>
        <div class="form__row">
                    <div class="form__col">
                        <div class="form__field">
                            <div class="form__field-block form__field-block--input">
                                <div class="input">
                                    <input type="text" class="input__control pr-1" v-model="inputSearchCity"  placeholder="Ваш город">
                                </div>
                            </div>
                        </div>
                    </div>
        </div>
        <div class="geolocation__city-list">

               <div class="radio-green" v-for="city in filterCity" :key="city">
        <label class="radio-green__label" for="city">{{city.CITY_NAME}}<small class="radio-green__small">{{city.REGION_NAME}}</small></label>
        <input class="radio-green__input" type="radio" name="city" @change="setCity(city)" :checked="isSelectedCity(city)" >
      </div>

        </div>
        </section>

    `
	};