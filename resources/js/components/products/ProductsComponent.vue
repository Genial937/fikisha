<template>
  <div>
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
          <h4 class="mb-0">Products</h4>

          <div v-if="role == 'Admin'" class="page-title-right">
            <ol class="breadcrumb m-0">
              <li class="breadcrumb-item">
                <a
                  href="javascript: void(0);"
                  @click="launchModal('add')"
                  class="btn btn-sm rounded-pill btn-primary text-white"
                  ><i class="uil-plus"></i> Add Product</a
                >
              </li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-xl-12 col-lg-12">
        <div class="card">
          <div class="card-body">
            <div v-if="loading" class="d-flex justify-content-center">
              <loading-component></loading-component>
            </div>
            <div v-else>
              <div class="row">
                <div class="col-md-6">
                  <div>
                    <h5>Showing result for "Shoes"</h5>
                    <ol class="breadcrumb p-0 bg-transparent mb-2">
                      <li class="breadcrumb-item">
                        <a href="javascript: void(0);">Footwear</a>
                      </li>
                      <li class="breadcrumb-item active">Shoes</li>
                    </ol>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-inline float-md-end">
                    <div class="search-box ms-2">
                      <div class="position-relative">
                        <input
                          type="text"
                          class="form-control bg-light border-light rounded"
                          placeholder="Search..."
                        />
                        <i class="mdi mdi-magnify search-icon"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div
                  v-for="product in products"
                  :key="product.id"
                  class="col-xl-4 col-sm-6"
                >
                  <div class="product-box">
                    <div class="product-img pt-4 px-4">
                      <div class="product-ribbon badge bg-warning">
                        Trending
                      </div>
                      <div class="product-wishlist">
                        <a href="#">
                          <i class="mdi mdi-heart-outline"></i>
                        </a>
                      </div>
                      <img
                        :src="product.photo"
                        alt=""
                        class="img-fluid mx-auto d-block"
                      />
                    </div>

                    <div class="text-center product-content p-4">
                      <h5 class="mb-1">
                        <a href="#" class="text-dark">{{ product.name }}</a>
                      </h5>
                      <p class="text-muted font-size-13">Gray, Shoes</p>

                      <h5 class="mt-3 mb-0">
                        <span class="text-muted me-2"></span>
                        Kes. {{ product.price }}
                      </h5>

                      <p class="text-center">
                        <a
                          href="#"
                          @click.prevent="add_to_cart(product.id)"
                          class="btn btn-sm btn-primary mt-2"
                          >Add to cart</a
                        >
                      </p>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row mt-4">
                <div class="col-sm-6">
                  <div>
                    <p class="mb-sm-0">Page 2 of 84</p>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="float-sm-end">
                    <ul class="pagination pagination-rounded mb-sm-0">
                      <li class="page-item disabled">
                        <a href="#" class="page-link"
                          ><i class="mdi mdi-chevron-left"></i
                        ></a>
                      </li>
                      <li class="page-item">
                        <a href="#" class="page-link">1</a>
                      </li>
                      <li class="page-item active">
                        <a href="#" class="page-link">2</a>
                      </li>
                      <li class="page-item">
                        <a href="#" class="page-link">3</a>
                      </li>
                      <li class="page-item">
                        <a href="#" class="page-link">4</a>
                      </li>
                      <li class="page-item">
                        <a href="#" class="page-link">5</a>
                      </li>
                      <li class="page-item">
                        <a href="#" class="page-link"
                          ><i class="mdi mdi-chevron-right"></i
                        ></a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="add">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <form @submit.prevent="save_product()">
            <div class="modal-header">
              <h4 class="modal-title">Add Product</h4>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>
            </div>
            <div class="modal-body">
              <div v-if="saving" class="d-flex justify-content-center">
                <saving-component></saving-component>
              </div>
              <div v-if="error">
                <fail-component :message="error_message"></fail-component>
              </div>
              <div v-if="success">
                <success-component
                  :message="success_message"
                ></success-component>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="">Product Name</label>
                    <input
                      type="text"
                      required
                      v-model="product.product_name"
                      class="form-control form-control-sm"
                    />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="">Product Price</label>
                    <input
                      type="number"
                      v-model="product.product_price"
                      required
                      class="form-control form-control-sm"
                    />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="">Available in</label>
                    <input
                      type="text"
                      v-model="product.availability"
                      required
                      class="form-control form-control-sm"
                      placeholder="i.e sacks, packets"
                    />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="">Product photo</label>
                    <input
                      type="file"
                      v-on:change="onFileChange"
                      required
                      class="form-control form-control-sm"
                    />
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="mb-3">
                    <label for="">Product Description</label>
                    <textarea
                      v-model="product.product_desc"
                      id=""
                      cols="30"
                      rows="4"
                      class="form-control"
                    ></textarea>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <a href="#" data-bs-dismiss="modal" class="btn btn-sm btn-danger"
                >Cancel</a
              >
              <button type="submit" class="btn btn-sm btn-primary">
                Submit
              </button>
            </div>
          </form>
        </div>
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
import VueSweetalert2 from "vue-sweetalert2";
import Swal from "sweetalert2";

import "sweetalert2/dist/sweetalert2.min.css";
export default {
  props: ["save-url", "fetch-url", "cart-url", "user-role"],
  components: {
    SavingComponent,
    SuccessComponent,
    FailComponent,
    LoadingComponent,
  },
  data() {
    return {
      loading: false,
      saving: false,
      error: false,
      success: false,
      success_message: "",
      error_message: "",
      product: {
        product_name: "",
        product_price: "",
        product_photo: "",
        product_desc: "",
        availability: "",
      },
      products: [],
      role: this.userRole,
    };
  },
  mounted() {
    this.fetch_products();
  },
  watch: {},
  methods: {
    fetch_products() {
      this.loading = true;
      axios
        .get(this.fetchUrl)
        .then((res) => {
          this.loading = false;
          this.products = res.data.products;
        })
        .catch((error) => {
          this.loading = false;
          console.log(error);
        });
    },
    onFileChange(e) {
      console.log(e.target.files[0]);
      this.product.product_photo = e.target.files[0];
    },
    save_product() {
      this.saving = true;
      const config = {
        headers: { "content-type": "multipart/form-data" },
      };

      let formData = new FormData();
      formData.append("product_name", this.product.product_name);
      formData.append("product_price", this.product.product_price);
      formData.append("product_photo", this.product.product_photo);
      formData.append("product_desc", this.product.product_desc);
      formData.append("availability", this.product.availability);
      axios
        .post(this.saveUrl, formData, config)
        .then((res) => {
          this.saving = false;
          this.success = true;
          this.success_message = res.data.message;
          this.resetForm();
        })
        .catch((error) => {
          this.saving = false;
          this.error = true;
          this.error_message = error.response.data.message;
          console.log(error);
        });
    },
    add_to_cart(id) {
      let data = {
        id: id,
      };
      axios
        .post(this.cartUrl, data)
        .then((res) => {
          this.$root.$emit("updateCart", "");
          this.showAlert(res.data.message);
        })
        .catch((error) => {
          console.log(error);
        });
    },
    launchModal(actionName) {
      if (actionName == "add") {
        $("#add").modal("show");
      }
      if (actionName == "edit") {
        $("edit").modal("show");
      }
    },
    resetForm() {
      var self = this; //you need this because *this* will refer to Object.keys below`

      //Iterate through each object field, key is name of the object field`
      Object.keys(this.product).forEach(function (key, index) {
        self.product[key] = "";
      });
    },
    showAlert(text) {
      // Use sweetalert2
      Swal.fire({
        title: "Success",
        text: text,
        icon: "success",
        confirmButtonText: "Ok",
      });
    },
  },
};
</script>
