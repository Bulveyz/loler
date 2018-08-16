<template>
    <div>
        <!-- Filters Panel -->
       <product-sort-panel @clickOnSearch="handleClickSearch" :products-count="productsCount"></product-sort-panel>
        <!-- End Filters Panel -->

        <!-- Results Sections -->
        <div class="sort-results">
            <b-card-group columns>

                <!-- Card Item -->
                <product :key="index" v-for="(item, index) in items" :data="item"></product>

            </b-card-group>
        </div>
        <!-- End Results Sections -->
    </div>
</template>

<script>
  import ProductSortPanel from './ProductSortPanel'
  import Product from './Product'

  const defaultOffset = 10;
  export default {
    components: {
      ProductSortPanel,
      Product
    },
    data() {
      return {
        items: [],
        offset: 0,
        isLoading: false,
        productsCount: 0,
        filters: {}
      }
    },
    methods: {
      onSearch(filters = 0) {
        // Start Loading
        this.isLoading = true;

        // Axios POST
        axios.post('/filter-products', {
          offset: this.offset,
          price: this.filters.price,
          restoraunt: this.filters.restoraunt,
          category: this.filters.category,
          rate: this.filters.rate
        })
            .then(response => {
              // Set Products Sorted Count
              this.productsCount = response.data.productsCount;

              // Collect Product To Array
              response.data.products.forEach(item => {
                this.items.push(item);
              });

              // End Loading
              this.isLoading = false;
            });
        // End Axios POST
      },
      handleClickSearch(filter) {
        this.offset = 0;
        this.items = [];
        this.filters = filter.filters
        this.onSearch();
      },
      handleScroll() {
        /**
         * If the offset is less than the number of elements, then the action will be successful.
         * If less than products are found when offset the action is prohibited
         */
        if (this.offset <= this.productsCount && this.productsCount > defaultOffset) {
          var scrollHeight = $(document).height();
          var scrollPosition = $(window).height() + $(window).scrollTop();
          if ((scrollHeight - scrollPosition) / scrollHeight === 0) {

            // If Loadin Is End
            if (!this.isLoading) {
              this.offset = this.offset + defaultOffset;
              this.onSearch();
            }
          }
        }
      }
    },
    mounted() {
      this.onSearch();
      window.addEventListener('scroll', this.handleScroll);
    }
  }
</script>

<style scoped>

</style>