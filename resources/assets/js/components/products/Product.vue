<template>
    <b-card class="border-0"
            :title="data.title"
            :img-src="data.image"
            img-fluid
            img-alt="image"
            img-top>
        <!-- Card Body -->
        <div>
            <!-- Badges -->
            <div class="d-flex flex-row flex-wrap mb-3">
                <b-badge pill class="mr-2" :href="'restoraunt/' + data.restoraunt_id">
                    {{data.restoraunt.brand}}
                </b-badge>
                <b-badge variant="success" pill>{{data.category.category}}</b-badge>
            </div>
            <div>
                <el-rate v-model="data.rate"></el-rate>
            </div>
            <!-- Buttons -->
            <div class="d-flex flex-row mt-4">
                <b-btn @click="addToCart(data.id)" class="rounded-0 mr-1"><i class="fa fa-cart-plus"></i> {{data.price}} $</b-btn>
                <b-btn class="rounded-0 w-100">Details <i class="fa fa-arrow-circle-right"></i></b-btn>
            </div>
        </div>
        <!-- End Card Body -->
    </b-card>
</template>

<script>
  export default {
    props: {
      data: {
        type: Object,
        required: true
      }
    },
    data() {
      return {
        rate: this.data.rate
      }
    },
    methods: {
      addToCart(product) {
        axios.post('/cart/store', {
          product_id: product
        })
            .then(response => {
              Event.fire('addToCart');

              const h = this.$createElement;

              this.$notify({
                title: 'Success!',
                message: h('p', 'The item is added to cart')
              });
            })
            .catch(errors => {
              if (errors.response.data.message == 'Unauthenticated.') {
                const h = this.$createElement;

                this.$notify({
                  title: 'Unauthenticated',
                  message: h('p', 'Log in to add an item to your cart')
                });
              }
            })
      }
    }
  }
</script>

<style scoped>

</style>