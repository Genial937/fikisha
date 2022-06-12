<template>
  <div>
    <!-- start page title -->
    <div class="row">
      <div class="col-12">
        <div
          class="
            page-title-box
            d-flex
            align-items-center
            justify-content-between
          "
        >
          <h4 class="mb-0">Cart</h4>

          <div class="page-title-right">
            <ol class="breadcrumb m-0">
              <li class="breadcrumb-item">
                <a href="javascript: void(0);">Cart</a>
              </li>
              <li class="breadcrumb-item active">Products</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <!-- end page title -->
    <div class="row mb-3">
      <div class="col-xl-8">
        <div
          v-for="(item, index) in items"
          :key="index"
          class="card border shadow-none"
        >
          <div class="card-body">
            <div class="d-flex align-items-start border-bottom pb-3">
              <div class="flex-shrink-0 me-4">
                <img :src="item.photo" alt="" class="avatar-lg" />
              </div>
              <div class="flex-grow-1 align-self-center overflow-hidden">
                <div>
                  <h5 class="text-truncate font-size-16">
                    <a href="ecommerce-product-detail.html" class="text-dark">{{
                      item.name
                    }}</a>
                  </h5>
                </div>
              </div>
              <div class="ms-2">
                <ul class="list-inline mb-0 font-size-16">
                  <li class="list-inline-item">
                    <a href="#" class="text-muted px-2">
                      <i class="uil uil-trash-alt"></i>
                    </a>
                  </li>
                  <li class="list-inline-item">
                    <a href="#" class="text-muted px-2">
                      <i class="uil uil-heart"></i>
                    </a>
                  </li>
                </ul>
              </div>
            </div>

            <div>
              <div class="row">
                <div class="col-md-4">
                  <div class="mt-3">
                    <p class="text-muted mb-2">Price</p>
                    <h5 class="font-size-16">Kes. {{ item.price }}</h5>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="mt-3">
                    <p class="text-muted mb-2">{{ item.quantity }}</p>
                    <div style="width: 110px" class="product-cart-touchspin">
                      <input data-toggle="touchspin" type="text" value="02" />
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="mt-3">
                    <p class="text-muted mb-2">Total</p>
                    <h5 class="font-size-16">Kes. {{ item.total }}</h5>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- end card -->

        <!-- end card -->

        <div class="row mt-4">
          <div class="col-sm-6">
            <a :href="shop" class="btn btn-link text-muted">
              <i class="uil uil-arrow-left me-1"></i> Continue Shopping
            </a>
          </div>
          <!-- end col -->
          <div class="col-sm-6">
            <div class="text-sm-end mt-2 mt-sm-0">
              <a :href="checkout" class="btn btn-success">
                <i class="uil uil-shopping-cart-alt me-1"></i> Checkout
              </a>
            </div>
          </div>
          <!-- end col -->
        </div>
        <!-- end row-->
      </div>

      <div class="col-xl-4">
        <div class="mt-5 mt-lg-3">
          <div class="card border shadow-none">
            <div class="card-header bg-transparent border-bottom py-3 px-4">
              <h5 class="font-size-16 mb-0">
                Order Summary <span class="float-end">#MN0124</span>
              </h5>
            </div>
            <div class="card-body p-4">
              <div class="table-responsive">
                <table class="table mb-0">
                  <tbody>
                    <tr>
                      <td>Sub Total :</td>
                      <td class="text-end">Kes. {{ total_cost }}</td>
                    </tr>
                    <tr>
                      <td>Discount :</td>
                      <td class="text-end">Kes. 0</td>
                    </tr>
                    <tr>
                      <td>Shipping Charge :</td>
                      <td class="text-end">Kes. 0</td>
                    </tr>
                    <tr>
                      <td>Estimated Tax :</td>
                      <td class="text-end">Kes. 0</td>
                    </tr>
                    <tr class="bg-light">
                      <th>Total :</th>
                      <td class="text-end">
                        <span class="fw-bold"> Kes. {{ total_cost }} </span>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- end table-responsive -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  props: ["cart-url", "shop-url", "checkout-url"],
  components: {},
  data() {
    return {
      items: [],
      total_cost: 0,
      shop: this.shopUrl,
      checkout: this.checkoutUrl,
    };
  },
  mounted() {
    this.fetch_cart();
  },
  methods: {
    fetch_cart() {
      axios
        .get(this.cartUrl)
        .then((res) => {
          this.items = res.data.items;
          this.total_cost = res.data.total;
          console.log(res.data);
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>
