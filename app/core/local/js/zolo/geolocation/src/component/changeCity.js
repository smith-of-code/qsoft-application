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


		},

		template: `
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
        <input class="radio-green__input" type="radio" name="city" @change="$emit('updateCity',city)" :checked="isSelectedCity(city)" >
      </div>

        </div>

    `
	};