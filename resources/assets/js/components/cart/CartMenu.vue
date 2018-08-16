<template>
    <b-nav-item-dropdown class="cart-menu" right>
        <template slot="text">
            <i class="fa fa-shopping-cart"></i>
        </template>
        <!-- Cart Items -->
        <div class="cart-menu-items p-2 position-relative">
            <span class="empty" v-if="products.length <= 0">Empty</span>
            <cart-menu-item :item-id="index" v-else :key="index" v-for="(product, index) in products" @changeCount="changeCount" @deleteProduct="deleteProduct(index)" :product="product"></cart-menu-item>
        </div>
        <!-- End Cart Items -->
        <div class="px-2 cart-menu-footer">
            <cart-footer class="border-top pt-2" :total="total"></cart-footer>
        </div>

    </b-nav-item-dropdown>
</template>

<script>
  import CartMenuItem from './CartMenuItem'
  import CartFooter from './CartFooter'

  export default {
    components: {
      CartMenuItem,
      CartFooter
    },
    data() {
      return {
        products: [],
        total: 0
      }
    },
    methods: {
      addToCart() {
        this.products = [];
        this.fetchCart();
      },
      changeCount(product) {
        this.products[product.id].pivot.count = product.count;
        this.fetchTotal();
      },
      fetchTotal() {
        this.total = 0;
        this.products.forEach(item => {
          this.total = this.total + (item.price * item.pivot.count)
        })
      },
      fetchCart() {
        axios.get('/cart/products').then(response => {
          this.products = response.data
        });
      },
      deleteProduct(index) {
        this.products.splice(index, 1)
      }
    },
    watch: {
      products() {
        this.fetchTotal();
      }
    },
    created() {
      this.fetchCart();
      Event.listen('addToCart', this.addToCart)
    }
  }
</script>

<style>
.cart-menu-items {
    height: 600px;
    overflow-y: scroll;
}

.empty {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}
</style>