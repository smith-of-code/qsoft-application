export const Geolocation = {
    components: {  },

    data() {
        return {
            inputSearchCity:'',
            selectedCity:null,
            tabsTitles:{

            }
        };
    },

    props: {
        cities: {
            type: Array,
            default:[],
            required: false,
        },
    },

    computed: {
        filterCity (){
            let result = []
            this.cities.forEach(e=>{
                if(!this.inputSearchCity || !this.inputSearchCity || e.CITY_NAME.toLowerCase().startsWith(this.inputSearchCity.toLowerCase())){
                    result.push(e)
                }
            })
            return result
        }
    },

    created() {

    },

    mounted() {

    },

    methods: {
    },

    template: `
            
       <header class="modal__section modal__section--header ">
            <h3 class="geolocation__header">Выберите город</h3>
        </header>
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
    
                        <div class="radio-green" v-for="city in filterCity">
                            <label class="radio-green__label" for="city">{{city.CITY_NAME}}<small class="radio-green__small">{{city.REGION_NAME}}</small></label>
                            <input class="radio-green__input" type="radio" name="city" v-model="selectedCity">
                        </div>
    
                </div>
        </section>
            
    `
};