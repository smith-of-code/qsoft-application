<template>
  <header class="modal__section modal__section--header ">
    <h3 class="geolocation__header">{{activeTab.title}}</h3>
  </header>
  <section v-if="activeTab.name === 'tab1'" class="modal__section modal__section--content modal-geolocation__content1" data-scrollbar data-modal-section>

    <img src="/local/templates/.default/images/delivery-box.png" alt="">

    <div class="modal-geolocation__container">
      <div class="modal-geolocation__city">
        <div class="modal-geolocation__curr-city">
          <img class="modal-geolocation__curr-city-icon" src="/local/templates/.default/images/icons/geolocation-big.svg" alt="">
          <span class="modal-geolocation__curr-city-text" v-if="activeCity">Ваш город <b>{{activeCity.CITY_NAME}}</b></span>
        </div>
        <p class="modal-geolocation__change-city"
           @click="setActiveTab('tab2')">изменить</p>
      </div>
      <p class="modal-geolocation__message">
        Сохраните ваш адрес, удобный пункт выдачи или постамат, чтобы видеть условия доставки при оформлении заказа
      </p>
      <button type="button" class="button button--full button--bold button--medium button--rounded button--covered button--green">
        <b class="button__text" @click="setActiveTab('tab3')">Выбрать на карте</b>
      </button>
    </div>



  </section>



  <section v-else-if="activeTab.name === 'tab2'" class="modal__section modal__section--content" data-scrollbar data-modal-section>
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

  <section v-else-if="activeTab.name === 'tab3'" class="modal__section modal__section--content modal__section--content-address" data-scrollbar data-modal-section>

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

    <div class="yamap__container">
      <img src="/local/templates/.default/images/yamap.jpg" alt="">
    </div>

    <div class="modal-geolocation__container">
      <button type="button" class="button button--full button--bold button--medium button--rounded button--covered button--green">
        <b class="button__text" @click="saveCity()">Сохранить адрес</b>
      </button>
    </div>

  </section>
</template>

<script>
export default {
  name: "geolocationMain",
  components: {},

  data() {
    return {
      cityId: '<?= $geolocationId ?>',
      inputSearchCity: '',
      tabs: [
        {
          name: 'tab1',
          title: 'Куда доставить ваш заказ?',
          isActive: true
        },
        {
          name: 'tab2',
          title: 'Выберите город',
          isActive: false
        },
        {
          name: 'tab3',
          title: 'Укажите ваш адрес для доставки заказов',
          isActive: false
        }
      ],
      place: {
        kladr_id:null,
        address: '',
        flat: '',
        postal_code: '',
        entry: '',
        housepin: '',
        floor: '',
      },
      searchResult: [],
      isOpenSearchResult:false,
      errors:{
        address:null
      },
      listArrivalPlace:[]
    };
  },

  props: {
    cities: {
      type: Array
    },
  },

  computed: {
    filterCity() {
      let result = []
      console.log(this.cities)
      this.cities.forEach(e => {
        if (!this.inputSearchCity || !this.inputSearchCity || e.CITY_NAME.toLowerCase().startsWith(this.inputSearchCity.toLowerCase())) {
          result.push(e)
        }
      })
      return result
    },
    activeTab() {
      return this.tabs.find(e => e.isActive)
    },
    activeCity() {
      return this.cities.find(e => this.cityId === e.ID)
    },


  },

  created() {

  },

  mounted() {
    console.log(this.defaultCityId)

  },

  methods: {
    setActiveTab(name) {
      this.tabs.forEach(e => {
        if (e.name !== name) {
          e.isActive = false
        } else {
          e.isActive = true
        }
      })

    },
    fillPlace(place) {
      this.place.address = place.value
      this.place.postal_code = place.data.postal_code
      this.place.kladr_id = place.data.kladr_id

      this.isOpenSearchResult = false
      console.log(this.place)
    },
    setCity(city) {
      this.cityId = city.ID
      this.setActiveTab('tab1')
    },
    isSelectedCity(city) {
      return city.ID === this.cityId
    },
    fetchListArrivalPlace(){
      BX.ajax.runAction('wizandr:geolocation.usercity.list')
          .then((res) => {
            this.listArrivalPlace = res.data
            // Код после выполнения экшена
          });
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
            // Код после выполнения экшена
          });
      // const response = await BX.ajax.runAction('wizandr:geolocation.Item.add', {
      //     data: {
      //        dsdsd:332323
      //     }
      // }).then((response) => response.data)
    },
    deleteArivalPlace(id){
      BX.ajax.runAction('wizandr:geolocation.usercity.delete', {
        data: {
          place_id: id
        }
      })
          .then(function () {
            // Код после выполнения экшена
          });
    }
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
}
</script>

<style scoped>

</style>