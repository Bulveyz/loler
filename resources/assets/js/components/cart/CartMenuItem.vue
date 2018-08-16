<template>
    <!-- Cart Item -->
    <div class="cart-menu-item">
        <div class="d-flex flex-row">
            <div class="flex-column" style="width: 150px">
                <img class="rounded" :src="product.image" height="200px" width="150px" alt="">
                <div class="menu-item-footer d-flex flex-row justify-content-between mt-3">
                    <div class="d-flex mr-8">
                        <b-btn class="btn-left">Check out {{price}}$</b-btn>
                        <b-btn class="btn-right" variant="danger" @click="deleteProduct">X</b-btn>
                    </div>
                    <div class="mt-1 w-50">
                        <el-input-number @change="changeCount" v-model="count"></el-input-number>
                    </div>
                </div>
            </div>
            <div class="flex-column ml-3 position-relative menu-item-header w-100">
                <h6>{{product.title}}</h6>
                <div class="flex-row">
                    <b-badge pill class="mr-2" :href="'restoraunt/' + product.restoraunt.id">
                        {{product.restoraunt.brand}}
                    </b-badge>
                    <b-badge variant="success" pill>{{product.category.category}}</b-badge>
                </div>
            </div>
        </div>
        <br>
    </div>
    <!-- End Cart Item -->
</template>

<script>
  export default {
    props: {
      product: {
        type: Object,
        required: true
      },
      itemId: {
        type: Number,
        required: true
      }
    },
    data() {
      return {
        count: this.product.pivot.count,
      }
    },
    computed: {
      price() {
        return this.count * this.product.price
      }
    },
    methods: {
      changeCount() {
       if (this.count >= 1) {
         axios.post('/cart/counter', {
           id: this.product.pivot.id,
           count: this.count
         })
             .then(response => {
               this.$emit('changeCount', {
                 id: this.itemId,
                 count: this.count
               })
             })
       } else {
         this.deleteProduct();
       }
      },
      deleteProduct() {
        axios.delete('/cart/products/' + this.product.id)
            .then(response => {
              if (response.data == '200') {
                this.$emit('deleteProduct');
              }
            })
      }
    }
  }
</script>

<style>
    .menu-item-header {
        height: 200px;
    }

    .menu-item-footer {
        bottom: 0;
    }

    .btn-right {
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
    }

    .btn-left {
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
    }

    .el-input-number {
        width: 120px;
    }
</style>