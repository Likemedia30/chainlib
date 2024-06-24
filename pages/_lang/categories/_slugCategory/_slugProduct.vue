<template>
  <div class="oneProduct-content" v-if="product">

    <v-img src="/Main-banner.jpeg" class="banner-search">
      <search/>
    </v-img>

    <v-container>
      <v-row>
        <v-col class="col-12">
          <div class="productOne">
            <v-row class="justify-space-between">
              <v-col class="col-lg-5 col-12">
                <div>
                  <slider-one-product :images="product.images"
                                      @openZoom="openZoom"
                                      :productImages="product.images"
                                      path="products"/>
                </div>
              </v-col>

              <v-col class="col-lg-7 col-12 book-property-area">
                <h2 class="productOne__name">{{ product.translation.name }}</h2>

                <div id="half-stars">
                  <div class="rating-group">
                    <input class="rating__input rating__input--none" checked name="rating2" id="rating2-0" value="0"
                           type="radio">
                    <label aria-label="0 stars" class="rating__label" for="rating2-0">&nbsp;</label>
                    <label aria-label="0.5 stars" class="rating__label rating__label--half" for="rating2-05"><i
                        class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                    <input class="rating__input" name="rating2" id="rating2-05" value="0.5" type="radio">
                    <label aria-label="1 star" class="rating__label" for="rating2-10"><i
                        class="rating__icon rating__icon--star fa fa-star"></i></label>
                    <input class="rating__input" name="rating2" id="rating2-10" value="1" type="radio">
                    <label aria-label="1.5 stars" class="rating__label rating__label--half" for="rating2-15"><i
                        class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                    <input class="rating__input" name="rating2" id="rating2-15" value="1.5" type="radio">
                    <label aria-label="2 stars" class="rating__label" for="rating2-20"><i
                        class="rating__icon rating__icon--star fa fa-star"></i></label>
                    <input class="rating__input" name="rating2" id="rating2-20" value="2" type="radio">
                    <label aria-label="2.5 stars" class="rating__label rating__label--half" for="rating2-25"><i
                        class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                    <input class="rating__input" name="rating2" id="rating2-25" value="2.5" type="radio">
                    <label aria-label="3 stars" class="rating__label" for="rating2-30"><i
                        class="rating__icon rating__icon--star fa fa-star"></i></label>
                    <input class="rating__input" name="rating2" id="rating2-30" value="3" type="radio">
                    <label aria-label="3.5 stars" class="rating__label rating__label--half" for="rating2-35"><i
                        class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                    <input class="rating__input" name="rating2" id="rating2-35" value="3.5" type="radio"
                           :checked="product.id % 2 == 1">
                    <label aria-label="4 stars" class="rating__label" for="rating2-40"><i
                        class="rating__icon rating__icon--star fa fa-star"></i></label>
                    <input class="rating__input" name="rating2" id="rating2-40" value="4" type="radio">
                    <label aria-label="4.5 stars" class="rating__label rating__label--half" for="rating2-45"><i
                        class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                    <input class="rating__input" name="rating2" id="rating2-45" value="4.5" type="radio"
                           :checked="product.id % 2 == 0">
                    <label aria-label="5 stars" class="rating__label" for="rating2-50"><i
                        class="rating__icon rating__icon--star fa fa-star"></i></label>
                    <input class="rating__input" name="rating2" id="rating2-50" value="5" type="radio">
                  </div>
                  <p class="stars-description" style="font-family: sans-serif; font-size:0.9rem">
                    {{ randomIntFromInterval(2, product.id) }} votes
                  </p>
                </div>

                <v-expansion-panels focusable
                                    v-model="panel"
                                    :readonly="readonly"
                                    multiple>

                  <v-expansion-panel v-if="properties">
                    <v-expansion-panel-header>Properties</v-expansion-panel-header>
                    <v-expansion-panel-content>
                      <properties-area :properties="properties"></properties-area>
                    </v-expansion-panel-content>
                  </v-expansion-panel>


                  <v-expansion-panel v-if="thing.length">
                    <v-expansion-panel-header>Details</v-expansion-panel-header>
                    <v-expansion-panel-content>
                      <details-area :thing="thing" v-if="thing.length > 0"></details-area>
                    </v-expansion-panel-content>
                  </v-expansion-panel>

                  <!--                  <v-expansion-panel v-if="offers.length">-->
                  <!--                    <v-expansion-panel-header>Offers</v-expansion-panel-header>-->
                  <!--                    <v-expansion-panel-content>-->
                  <!--                      <offers-area :offers="offers" v-if="offers.length"></offers-area>-->
                  <!--                    </v-expansion-panel-content>-->
                  <!--                  </v-expansion-panel>-->

                </v-expansion-panels>

              </v-col>

              <v-col class="col-lg-12 col-12" v-if="product.translation.body">
                <about-area :text="product.translation.body"></about-area>
              </v-col>

              <v-col class="text-center">
                <p class="productOne__price mb-4" v-if="thing.length > 0">
                  {{ parsePrice(thing) }}
                  {{ currency.abbr }}
                </p>

                <v-btn
                       :href="`https://mintbase.io/thing/${mainnnetId}`"
                       target="_blank" class="ml-20 custom__btn">
                  <v-icon>mdi-cart-variant</v-icon>
                  Buy with near
                </v-btn>

                <span v-if="thing.length && product.homewear">
                  <span>
                    <CartBtn :product="product"></CartBtn>
                  </span>
                </span>

              </v-col>

            </v-row>
          </div>
        </v-col>

        <v-col class="col-12 mt-lg-8">
          <v-row>
            <v-col class="col-12 mt-lg-8" v-if="similar.length">
              <h3 class="additional-title">Similar books:</h3>
              <similar-slider :similars="similar"/>
            </v-col>
          </v-row>
        </v-col>

      </v-row>
    </v-container>

  </div>
</template>

<script>

import {mapGetters} from 'vuex'
import contentApi from '@/api/contentApi'
import userApi from "~/api/userApi";
import SliderOneProduct from '@/components/front/sliders/SliderOneProduct.vue'
import similarSlider from '@/components/front/sliders/SimilarCarousel.vue'
import CartBtn from '~/components/front/cart/CartBtn.vue'
import Sizes from '@/components/front/productWidgets/Sizes.vue'
import Zoom from '@/components/front/productWidgets/Zoom.vue'
import NearBuyProductBtn from "~/components/front/near/NearBuyProductBtn"
import NearBuySubProductBtn from "~/components/front/near/NearBuySubProductBtn";
import PropertiesArea from "@/components/front/productWidgets/marketplace/PropertiesArea";
import OffersArea from "~/components/front/productWidgets/marketplace/OffersArea";
import AboutArea from "~/components/front/productWidgets/marketplace/AboutArea";
import DetailsArea from "~/components/front/productWidgets/marketplace/DetailsArea";
import Search from "~/components/front/partials/Search";

// import NearBuy from "~/components/front/near/NearBuy";
import gql from 'graphql-tag'

const THING_QUERY = gql`
  query THING_QUERY($id: String!) {
    thing (where: {id: {_eq: $id}}) {
       id
       storeId
    metadata {
      title
      description
      tags
      media
      category
      external_url
    }
    tokens {
      id
      minter
      ownerId
      list {
        contractId
        price
        contractId
        ownerId
      }
    }
  }
  }
`;

const getPropertyByKey = (properties) => {
  return properties['NFT Mainnet ID']
}

export default {
  components: {
    NearBuySubProductBtn,
    SliderOneProduct,
    similarSlider,
    Sizes,
    Zoom,
    CartBtn,
    NearBuyProductBtn,
    PropertiesArea,
    OffersArea,
    AboutArea,
    DetailsArea,
    Search
    // NearBuy
  },
  async asyncData({app, params, store}) {
    const client = app.apolloProvider.defaultClient;
    let prod = null
    let similar = []
    let properties = []
    let offers = []
    let thingMB = [];

    await contentApi.getProduct({
      lang: store.state.lang.lang,
      alias: params.slugProduct,
      currency: store.state.currency.id
    }, data => {
      prod = data.product
      similar = data.similars
      properties = data.properties
      offers = data.offers
    })

    const mainnetId = getPropertyByKey(properties)

    if (mainnetId) {
      const id = mainnetId;

      const res = await client.query({
        query: THING_QUERY,
        variables: {id},
      })
      const {thing} = res.data;
      thingMB = thing
    }

    return {
      similar,
      product: prod,
      productImages: prod.images,
      properties: properties,
      offers: offers,
      thing: thingMB,
      mainnnetId: mainnetId
    }
  },
  watch: {
    async currency() {
      await contentApi.getProduct({
        lang: this.language.lang,
        alias: this.product.alias,
        currency: this.currency.id
      }, data => {
        this.product = data.product
        this.similar = data.similar
        this.offers = data.offers
        this.properties = data.properties
        this.productImages = this.product.images
      })
    },
  },
  computed: mapGetters({
    categories: 'getCategories',
    language: 'getLanguage',
    currency: 'getCurrency',
    trans: 'getTranslations',
    contract: 'near/getContract',
    currentUser: 'near/getCurrentUser',
    nearConfig: 'near/getNearConfig',
    walletConnection: 'near/getWalletConnection',
  }),
  data() {
    return {
      product: null,
      productImages: [],
      zoom: false,
      mainImage: null,
      panel: [0, 1, 2, 3],
      readonly: false
    }
  },
  async mounted() {
    this.$nuxt.$on('update-product-offers', data => {
      this.updateOffers();
    });
  },
  methods: {
    randomIntFromInterval(min, max) {
      return Math.floor(Math.random() * (max - min + 1) + min)
    },
    parsePrice(thing) {
      if (thing.length > 0) {
        if (thing[0].tokens.length > 0) {
          if (thing[0].tokens[0].list) {
            if (thing[0].tokens[0].list.price) {
              let price = thing[0].tokens[0].list.price.toString()
              let x = price.split('e')
              let y = x[1].split('+')

              y = y.filter(element => {
                return element !== '';
              });

              y = y[0] - 24
              x = x[0]

              const number = x * Math.pow(10, y)

              return parseFloat(number)
            }
          }
        }
      }

      return 0;
    }
    ,
    updateOffers() {
      const data = {
        productId: this.product.id,
        lang: this.language.lang,
        currency: this.currency.id
      };
      userApi.getOffers(data, async response => {
        this.offers = response.data
      })
    }
    ,
    openZoom(image) {
      this.mainImage = image
      this.zoom = true
    }
  }
}
</script>

<style lang="scss">
.buyOn__methods {
  .v-btn--icon.v-size--default {
    width: auto !important;
  }
}

.productOne__bloc {
  .v-application p {
    padding: 0;
  }
}

.oneProduct-content {
  max-width: 1500px;
}

.moreProducts {
  border: 2px solid $main-color;
  padding: 15px;
  margin-bottom: 20px;

  span {
    color: $main-color;
  }

  .v-btn {
    width: 100%
  }

  .row {
    align-items: center;
  }
}

.help {
  align-items: center;
  color: $main-color;
  font-size: 12px;
  margin-top: 20px;

  .col {
    padding: 0 10px;
  }

  span {
    padding-bottom: 15px;
  }

  .v-btn {
    display: flex;
    margin-bottom: 0 !important;
  }

  .v-icon {
    margin-right: 5px;
  }
}

.productOne {
  margin-top: -50px;
  padding: 30px 15px;
  background-color: #FFF;
  position: relative;
  z-index: 2;

  &__name {
    font-family: $font-titles;
    font-size: 30px;
    color: $olive-color;
    letter-spacing: 0;
    line-height: 17px;
    text-align: left;
    text-transform: uppercase;
    margin-top: 0px;
    line-height: 1.5;
  }

  &__price {
    margin-top: 10px;
    text-transform: uppercase;
    font-size: 26px;
    font-family: $font-roboto;
    font-weight: 600;
    color: #e96535;
  }

  &__discount {
    position: absolute;
    top: -40px;
    right: 0;
    width: 100px;
    height: 100px;
    // background-image: url("./static/discountIcon.png");
    background-size: 110%;
    background-position: center center;
    font-family: $font-text-bold;
    font-size: 25px;
    color: $red-color;
    padding-left: 20px;
    letter-spacing: 0.04px;
    line-height: 1.2;
    text-align: center;
    display: -ms-flex;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -ms-flex-direction: column;
    flex-direction: column;
    padding-top: 20px;
  }

  &__by {
    color: $main-color;
    font-size: 12px;
  }

  &__exp {
    padding: 0;

    &::before {
      box-shadow: none;
    }

    div {
      padding: 0 !important;
    }
  }

  .v-expansion-panel,
  .v-expansion-panel__header {
    background-color: #FFF !important;
  }

  .v-expansion-panel-content__wrap {
    padding: 0 15px !important;
  }

  &__exp &__bloc-text {
    padding: 0;
  }

  &__exp-header {
    color: $olive-color;
    padding: 0;
    text-transform: uppercase;
  }

  &__bloc {
    padding-top: 10px;
    margin-bottom: 0;
    border-top: 1px solid rgba(0, 0, 0, 0.12);
    border-bottom: 1px solid rgba(0, 0, 0, 0.12);
  }

  &__bloc-text {
    font-family: $font-roboto;
    font-size: 13px;
    line-height: 1.7;
    text-align: left;
    color: $main-color;
    font-weight: 300;
    padding: 0 24px 0;

    a {
      text-decoration: underline;
    }
  }

  &__bloc-title {
    color: $olive-color;
    padding: 0;
    font-size: 0.9375rem;
    line-height: 1;
    min-height: 30px;
    display: flex;
    align-items: center;
    text-transform: uppercase;
  }

  .v-btn.body {
    color: $main-color !important;
  }

  .v-btn {
    margin-bottom: 15px;

    .cart-icon {
      width: 15px;
      margin-left: 10px;
      margin-bottom: 6px;
    }
  }
}

.p-title {
  text-align: left;
  color: $main-color;
  font-family: $font-titles;
  font-size: 25px;
  letter-spacing: -0.11px;
  text-align: center;
  text-transform: uppercase;
  line-height: 1.3;
}

.p-subtitle {
  text-align: center;
  font-size: 20px;
  color: $olive-color;
  letter-spacing: -0.11px;
  font-family: $font-titles;
}

.prof {
  padding-bottom: 15px;

  &__iamge {
    position: relative;
  }

  &__indicator {
    position: absolute;
    top: 35px;
    left: 35px;
  }

  .v-card__actions {
    display: flex;
    justify-content: center;
  }

  .v-btn {
    border-radius: 9px !important;
  }
}

.v-input--selection-controls {
  margin-top: 5px;
}

.productOne .exp__point {
  color: $main-color;
  margin-bottom: 10px;
  position: relative;
  margin-left: 10px !important;

  &:after {
    content: "";
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background: $main-color;
    opacity: .5;
    position: absolute;
    left: 0;
    top: 6px;
  }
}

.buyOn {
  margin-top: 30px;
  padding-top: 20px;
  border-top: 1px solid rgba(0, 0, 0, 0.12);
  border-bottom: 1px solid rgba(0, 0, 0, 0.12);

  &__header {
    color: $olive-color;
    text-transform: uppercase;
    margin-bottom: 10px;
  }

  img {
    width: auto;
    height: 50px;
  }

  .v-btn {
    width: auto;
    height: auto;
    margin-right: 10px;

    &:last-child {
      img {
        height: 40px;
      }
    }
  }

  span {
    width: 100% !important
  }
}

.ozon-icon img {
  height: 30px !important;
}

.guaranty {
  padding-bottom: 20px;
  padding-top: 20px;
  border-bottom: 1px solid rgba(0, 0, 0, 0.12);

  &__header {
    color: $olive-color;
    text-transform: uppercase;
  }

  &__content {
    display: flex;
    align-items: center;
    margin-top: 10px;
  }

  &__item {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-right: 10px;

    span {
      font-size: 10px;
      color: $main-color;
      text-transform: uppercase;
    }
  }

  img {
    width: 60px
  }
}

.color {
  margin-top: 15px;
  margin-bottom: 40px;
}

@media (min-width: 1200px) {
  .additional-title {
    font-size: 30px;
  }
}

.exp__point {
  padding-left: 30px !important;
}

.productOne__bloc-text {
  padding: 0 0px !important;
}

.v-expansion-panel-header {
  max-width: 100% !important;
  background-color: #FFF !important;
  text-transform: uppercase;
}

.v-expansion-panel-header--active {
  background-color: transparent !important;
}

.v-expansion-panel-header:before {
  background-color: transparent !important;
}

.book-property-area {
  padding: 0 30px;
}

#half-stars {
  margin-left: -20px;

  .rating-group {
    display: inline-flex;
  }

  .rating__icon {
    pointer-events: none;
  }

  .rating__input {
    position: absolute !important;
    left: -9999px !important;
  }

  .rating__label {
    cursor: pointer;
    padding: 0 0.1em;
    font-size: 2rem;
  }

  .rating__label--half {
    padding-right: 0;
    margin-right: -0.6em;
    z-index: 2;
  }

  .rating__icon--star {
    color: orange;
  }

  .rating__icon--none {
    color: #eee;
  }

  .rating__input--none:checked + .rating__label .rating__icon--none {
    color: red;
  }

  .rating__input:checked ~ .rating__label .rating__icon--star {
    color: #ddd;
  }

  .rating-group:hover .rating__label .rating__icon--star,
  .rating-group:hover .rating__label--half .rating__icon--star {
    color: orange;
  }

  .rating__input:hover ~ .rating__label .rating__icon--star,
  .rating__input:hover ~ .rating__label--half .rating__icon--star {
    color: #ddd;
  }

  .rating-group:hover .rating__input--none:not(:hover) + .rating__label .rating__icon--none {
    color: #eee;
  }

  .rating__input--none:hover + .rating__label .rating__icon--none {
    color: red;
  }
}

.stars-description {
  margin-left: 20px;
}
.custom__btn {
  background-color: #e96535 !important;
  color: #FFF !important;
  font-weight: 600;
}
</style>
