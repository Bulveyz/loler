<template>
    <div class="sort-panel row mb-5 mt-5">
        <div class="col-4">
            <!-- Price -->
            <div class="form-group">
                <h5>Price</h5>
                <el-slider
                        v-model="price"
                        :max="120"
                        range>
                </el-slider>
                <span>From {{price[0]}} $ to {{price[1]}} $</span>
            </div>
            <!-- End Price -->
        </div>

        <div class="col-6">
            <!-- Brand Select -->
            <div class="form-group">
                <h5>Brand</h5>
                <bulveyz-select placeholder="Brands" active="0" v-model="restoraunt">
                    <bulveyz-select-option value="0" label="All"></bulveyz-select-option>
                    <bulveyz-select-option v-for="(item,index) in restoraunts" :key="index" :value="item.id"
                                           :label="item.brand"></bulveyz-select-option>
                </bulveyz-select>
                <div class="flex flex-wrap mt-3">
                    <el-radio v-model="category" label="0">All</el-radio>
                    <el-radio v-model="category" label="1">Salad</el-radio>
                    <el-radio v-model="category" label="2">Dessets</el-radio>
                    <el-radio v-model="category" label="3">Hot dish</el-radio>
                    <el-radio v-model="category" label="4">Drinks</el-radio>
                    <el-radio class="m-0" v-model="category" label="5">Liquid dishes</el-radio>
                </div>
            </div>
            <!--End Brand Select -->
        </div>

        <div class="col-2">
            <!-- Rate Filter -->
            <h5>Popular</h5>
            <div class="mb-4">
                <el-rate v-model="rate"></el-rate>
            </div>

            <!-- Reset Rate Filter -->
            <a href="#!" class="text-secondary" @click="rate = 0">Reset rate</a>

            <!-- End Rate Filter -->
        </div>
        <div class="col-12">
            <!-- Button -->
            <b-btn @click="onClickSearch">Search</b-btn>

            <!-- Count Found Products -->
            <span class="float-right">Resutls: {{productsCount}}</span>
        </div>
    </div>
</template>

<script>
  export default {
    props: {
      productsCount: {
        default: 0,
        required: true
      }
    },
    data() {
      return {
        price: [0, 120],
        restoraunt: 0,
        restoraunts: [],
        category: '0',
        rate: 0
      }
    },
    methods: {
      onClickSearch() {
        this.$emit('clickOnSearch', {
          filters: {
            price: this.price,
            restoraunt: this.restoraunt,
            category: this.category,
            rate: this.rate
          }
        });
      },
      fetchRestoraunts() {
        axios.get('/get-restoraunts')
            .then(response => this.restoraunts = response.data)
      },
    },
    mounted() {
      this.fetchRestoraunts();
    }
  }
</script>

<style scoped>

</style>