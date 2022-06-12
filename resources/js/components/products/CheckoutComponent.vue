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
          <h4 class="mb-0">Checkout</h4>

          <div class="page-title-right">
            <ol class="breadcrumb m-0">
              <li class="breadcrumb-item">
                <a href="javascript: void(0);">Checkout</a>
              </li>
              <li class="breadcrumb-item active">Products</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <!-- end page title -->
    <div class="row">
      <div class="col-xl-10 m-auto">
        <div v-if="saving" class="card card-body mb-2 text-center">
          <div class="d-flex justify-content-center">
            <saving-component></saving-component>
          </div>
        </div>
        <div v-if="success">
          <success-component :message="success_message"></success-component>
        </div>
        <div v-if="error">
          <fail-component :message="error_message"></fail-component>
        </div>
        <form @submit.prevent="save_order()">
          <div class="custom-accordion">
            <div class="card">
              <a
                href="#checkout-billinginfo-collapse"
                class="text-dark"
                data-bs-toggle="collapse"
              >
                <div class="p-4">
                  <div class="d-flex align-items-center">
                    <div class="flex-shrink-0 me-3">
                      <i class="uil uil-receipt text-primary h2"></i>
                    </div>
                    <div class="flex-grow-1 overflow-hidden">
                      <h5 class="font-size-16 mb-1">Billing Info</h5>
                      <p class="text-muted text-truncate mb-0">
                        Sed ut perspiciatis unde omnis iste
                      </p>
                    </div>
                    <div class="flex-shrink-0">
                      <i
                        class="mdi mdi-chevron-up accor-down-icon font-size-24"
                      ></i>
                    </div>
                  </div>
                </div>
              </a>

              <div id="checkout-billinginfo-collapse" class="collapse show">
                <div class="p-4 border-top">
                  <div>
                    <div class="row">
                      <div class="col-lg-4">
                        <div class="mb-3 mb-4">
                          <label class="form-label" for="billing-name"
                            >Name</label
                          >
                          <input
                            type="text"
                            class="form-control"
                            v-model="name"
                            required
                            id="billing-name"
                            placeholder="Enter name"
                          />
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="mb-3 mb-4">
                          <label class="form-label" for="billing-email-address"
                            >Email Address</label
                          >
                          <input
                            type="email"
                            v-model="email"
                            class="form-control"
                            id="billing-email-address"
                            placeholder="Enter email"
                          />
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="mb-3 mb-4">
                          <label class="form-label" for="billing-phone"
                            >Phone</label
                          >
                          <input
                            type="text"
                            v-model="phone"
                            class="form-control"
                            id="billing-phone"
                            placeholder="Enter Phone no."
                          />
                        </div>
                      </div>
                    </div>

                    <div class="mb-4">
                      <label class="form-label" for="billing-address"
                        >Address</label
                      >
                      <textarea
                        class="form-control"
                        id="billing-address"
                        v-model="address"
                        required
                        rows="3"
                        placeholder="Enter full address"
                      ></textarea>
                    </div>

                    <div class="row">
                      <div class="col-lg-4">
                        <div class="mb-4 mb-lg-0">
                          <label class="form-label">Country</label>
                          <input
                            type="text"
                            class="form-control"
                            v-model="country"
                            placeholder="Enter country"
                          />
                        </div>
                      </div>

                      <div class="col-lg-4">
                        <div class="mb-4 mb-lg-0">
                          <label class="form-label" for="billing-city"
                            >City</label
                          >
                          <input
                            type="text"
                            class="form-control"
                            v-model="city"
                            id="billing-city"
                            placeholder="Enter City"
                          />
                        </div>
                      </div>

                      <div class="col-lg-4">
                        <div class="mb-0">
                          <label class="form-label" for="zip-code"
                            >Zip / Postal code</label
                          >
                          <input
                            type="text"
                            class="form-control"
                            v-model="zip"
                            id="zip-code"
                            placeholder="Enter Postal code"
                          />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row my-4">
            <div class="col">
              <a href="ecommerce-products.html" class="btn btn-link text-muted">
                <i class="uil uil-arrow-left me-1"></i> Continue Shopping
              </a>
            </div>
            <!-- end col -->
            <div class="col">
              <div class="text-end mt-2 mt-sm-0">
                <button type="submit" class="btn btn-success">
                  <i class="uil uil-shopping-cart-alt me-1"></i> Proceed
                </button>
              </div>
            </div>
            <!-- end col -->
          </div>
        </form>
        <!-- end row-->
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import SavingComponent from "../states/SavingComponent.vue";
import SuccessComponent from "../states/SuccessComponent.vue";
import FailComponent from "../states/FailComponent.vue";
import LoadingComponent from "../states/LoaderComponent.vue";
export default {
  props: ["save-url"],
  components: {
    SavingComponent,
    SuccessComponent,
    FailComponent,
    LoadingComponent,
  },
  data() {
    return {
      name: "",
      email: "",
      phone: "",
      address: "",
      country: "",
      city: "",
      zip: "",
      payment_method: "Card",
      saving: false,
      error: false,
      success: false,
      error_message: "",
      success_message: "",
    };
  },
  mounted() {},
  methods: {
    save_order() {
      this.saving = true;
      let data = {
        name: this.name,
        email: this.email,
        phone: this.phone,
        address: this.address,
        country: this.country,
        city: this.city,
        zip: this.zip,
        payment_method: this.payment_method,
      };
      axios
        .post(this.saveUrl, data)
        .then((res) => {
          this.saving = false;
          this.success = true;
          this.success_message = res.data.message;
          console.log(res.data);
        })
        .catch((error) => {
          this.saving = false;
          this.error = true;
          this.error_message = error.response.data.message;
          console.log(error);
        });
    },
  },
};
</script>
