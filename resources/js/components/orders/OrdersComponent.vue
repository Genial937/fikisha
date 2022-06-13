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
          <h4 class="mb-0">Orders</h4>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="card card-body">
          <div v-if="loading" class="d-flex justify-content-center">
            <loading-component></loading-component>
          </div>
          <div v-else>
            <data-table
              v-bind="parametersTable"
              @actionTriggered="handleACtion"
            />
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="view">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Order Details</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <div v-if="loading_details" class="d-flex justify-content-center">
              <loading-component></loading-component>
            </div>
            <div v-else>
              <div class="card checkout-order-summary">
                <div class="card-body">
                  <div class="p-3 bg-light mb-4">
                    <h5 class="font-size-16 mb-0">
                      Order Summary
                      <span class="float-end ms-2">{{ order_no }}</span>
                    </h5>
                  </div>
                  <div class="table-responsive">
                    <table class="table table-centered mb-0 table-nowrap">
                      <thead>
                        <tr>
                          <th
                            class="border-top-0"
                            style="width: 110px"
                            scope="col"
                          >
                            Product
                          </th>
                          <th class="border-top-0" scope="col">Product Desc</th>
                          <th class="border-top-0" scope="col">Price</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="item in items" :key="item.id">
                          <th scope="row">
                            <img
                              :src="item.products.product_photo"
                              alt="product-img"
                              title="product-img"
                              class="avatar-md"
                            />
                          </th>
                          <td>
                            <h5 class="font-size-14 text-truncate">
                              <a
                                href="ecommerce-product-detail.html"
                                class="text-dark"
                                >{{ item.products.product_name }}</a
                              >
                            </h5>
                            <p class="text-muted mb-0">
                              Kes. {{ item.products.product_price }} x
                              {{ item.quantity }}
                            </p>
                          </td>
                          <td>
                            Kes.
                            {{ item.products.product_price * item.quantity }}
                          </td>
                        </tr>

                        <tr>
                          <td colspan="2">
                            <h5 class="font-size-14 m-0">Sub Total :</h5>
                          </td>
                          <td>{{ total }}</td>
                        </tr>
                        <tr>
                          <td colspan="2">
                            <h5 class="font-size-14 m-0">Discount :</h5>
                          </td>
                          <td>Kes. 0</td>
                        </tr>

                        <tr>
                          <td colspan="2">
                            <h5 class="font-size-14 m-0">Shipping Charge :</h5>
                          </td>
                          <td>kes. 0</td>
                        </tr>
                        <tr>
                          <td colspan="2">
                            <h5 class="font-size-14 m-0">Estimated Tax :</h5>
                          </td>
                          <td>Kes. 0</td>
                        </tr>

                        <tr class="bg-light">
                          <td colspan="2">
                            <h5 class="font-size-14 m-0">Total:</h5>
                          </td>
                          <td>{{ total }}</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <a href="#" data-bs-dismiss="modal" class="btn btn-sm btn-danger"
              >Close</a
            >
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="edit">
      <div class="modal-dialog">
        <div class="modal-content">
          <form @submit.prevent="update_order()">
            <div class="modal-header">
              <h5 class="modal-title">Update Order</h5>
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
              <div v-if="success">
                <success-component
                  :message="success_message"
                ></success-component>
              </div>
              <div v-if="error">
                <fail-component :message="error_message"></fail-component>
              </div>
              <div class="mb-3">
                <label for="">Vehicle</label>
                <div v-if="assigned">
                  <input
                    type="text"
                    readonly
                    class="form-control form-control-sm"
                    v-model="vehicle_name"
                  />
                </div>
                <div v-else>
                  <select
                    v-model="vehicle_id"
                    id=""
                    class="form-control form-control-sm"
                  >
                    <option value="">Select</option>
                    <option
                      v-for="veh in vehicles"
                      :key="veh.id"
                      :value="veh.id"
                    >
                      {{ veh.reg_no }} ~ {{ veh.name }} ~ {{ veh.status }}
                    </option>
                  </select>
                </div>
              </div>
              <div class="mb-">
                <label for="">Status</label>
                <select v-model="order_status" id="" class="form-control">
                  <option value="">Select</option>
                  <option value="loading">Loading</option>
                  <option value="dispatched">Dispatched</option>
                  <option value="delivered">Delivered</option>
                </select>
              </div>
            </div>
            <div class="modal-footer">
              <a href="#" data-bs-dismiss="modal" class="btn btn-sm btn-danger"
                >Cancel</a
              >
              <button type="submit" class="btn btn-sm btn-primary">
                Update
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import DataTable from "@andresouzaabreu/vue-data-table";
import "@andresouzaabreu/vue-data-table/dist/DataTable.css";
import LoadingComponent from "../states/LoaderComponent.vue";
import SavingComponent from "../states/SavingComponent.vue";
import SuccessComponent from "../states/SuccessComponent.vue";
import FailComponent from "../states/FailComponent.vue";
import axios from "axios";
import VueSweetalert2 from "vue-sweetalert2";
import Swal from "sweetalert2";

import "sweetalert2/dist/sweetalert2.min.css";
export default {
  props: ["fetch-url", "vehicles-url", "update-url", "details-url"],
  components: {
    DataTable,
    LoadingComponent,
    SavingComponent,
    SuccessComponent,
    FailComponent,
  },
  data() {
    return {
      saving: false,
      error: false,
      success: false,
      error_message: "",
      success_message: "",
      orders: [],
      vehicles: [],
      loading: false,
      order_status: "",
      order_id: "",
      vehicle_id: "",
      assigned: false,
      vehicle_name: "",
      items: [],
      order_no: "",
      total: "",
      loading_details: false,
    };
  },
  mounted() {
    this.fetch_all();
    this.fetch_vehicles();
  },
  computed: {
    parametersTable() {
      return {
        data: this.orders,
        tableClass: "table table-sm",
        actionMode: "single",
        actions: ["view", "edit"],
        columnKeys: [
          "customer",
          "order_date",
          "order_no",
          "payment_method",
          "total_cost",
          "assigned_vehicle",
          "status",
        ],
      };
    },
  },
  watch: {},
  methods: {
    fetch_all() {
      this.loading = true;
      axios
        .get(this.fetchUrl)
        .then((res) => {
          this.loading = false;
          this.orders = res.data.orders;
        })
        .catch((error) => {
          this.loading = false;
          console.log(error);
        });
    },
    fetch_vehicles() {
      axios
        .get(this.vehiclesUrl)
        .then((res) => {
          this.vehicles = res.data.vehicles;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    update_order() {
      let url = this.updateUrl.replace("id", this.order_id);
      let check = this.vehicles.find((item) => item.id == this.vehicle_id);
      if (
        (!this.assigned && check.status == "Loading") ||
        (!this.assigned && check.status == "Transit")
      ) {
        let text = "This truck is not available";
        this.showAlert(text);
        return;
      }

      this.saving = true;
      let data = {
        vehicle_id: this.vehicle_id,
        id: this.order_id,
        order_status: this.order_status,
      };

      axios
        .put(url, data)
        .then((res) => {
          this.saving = false;
          this.success = true;
          this.success_message = res.data.message;
          this.fetch_all();
        })
        .catch((error) => {
          this.saving = false;
          this.error = true;
          this.error_message = error.response.data.message;
          console.log(error);
        });
    },
    handleACtion(actionName, data) {
      this.assigned = data.assigned_vehicle == "Not Assigned" ? false : true;
      this.order_id = data.id;
      this.vehicle_id =
        data.assigned_vehicle == "Not Assigned" ? "" : data.vehicle_id;
      this.vehicle_name = data.assigned_vehicle;

      if (actionName == "edit") {
        $("#edit").modal("show");
      }

      if (actionName == "view") {
        this.loading_details = true;
        this.order_no = data.order_no;
        this.total = data.total_cost;
        let url = this.detailsUrl.replace("id", data.id);
        $("#view").modal("show");
        axios
          .get(url)
          .then((res) => {
            this.loading_details = false;
            this.items = res.data.items;
          })
          .catch((error) => {
            this.loading_details = false;
            console.log(error);
          });
      }
    },
    showAlert(text) {
      // Use sweetalert2
      Swal.fire({
        title: "Error",
        text: text,
        icon: "error",
        confirmButtonText: "Ok",
      });
    },
  },
};
</script>
