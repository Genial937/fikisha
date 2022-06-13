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
          <h4 class="mb-0">Dashboard</h4>

          <div class="page-title-right">
            <ol class="breadcrumb m-0">
              <li class="breadcrumb-item">
                <a href="javascript: void(0);">Fikisha Ltd</a>
              </li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div v-if="loading" class="col-md-12 card card-body">
        <div class="d-flex justify-content-center">
          <loading-component></loading-component>
        </div>
      </div>
      <div v-else class="col-md-12">
        <div v-if="role == 'Admin'" class="row">
          <div class="col-md-6 col-xl-3">
            <div class="card">
              <div class="card-body">
                <div class="float-end mt-2">
                  <div id="total-revenue-chart"></div>
                </div>
                <div>
                  <h4 class="mb-1 mt-1">
                    Kes. <span data-plugin="counterup">{{ revenues }}</span>
                  </h4>
                  <p class="text-muted mb-0">Total Revenue</p>
                </div>
              </div>
            </div>
          </div>
          <!-- end col-->

          <div class="col-md-6 col-xl-3">
            <div class="card">
              <div class="card-body">
                <div class="float-end mt-2">
                  <div id="orders-chart"></div>
                </div>
                <div>
                  <h4 class="mb-1 mt-1">
                    <span data-plugin="counterup">{{ orders }}</span>
                  </h4>
                  <p class="text-muted mb-0">Orders</p>
                </div>
              </div>
            </div>
          </div>
          <!-- end col-->

          <div class="col-md-6 col-xl-3">
            <div class="card">
              <div class="card-body">
                <div class="float-end mt-2">
                  <div id="customers-chart"></div>
                </div>
                <div>
                  <h4 class="mb-1 mt-1">
                    <span data-plugin="counterup">{{ customers }}</span>
                  </h4>
                  <p class="text-muted mb-0">Customers</p>
                </div>
              </div>
            </div>
          </div>
          <!-- end col-->

          <div class="col-md-6 col-xl-3">
            <div class="card">
              <div class="card-body">
                <div class="float-end mt-2">
                  <div id="growth-chart"></div>
                </div>
                <div>
                  <h4 class="mb-1 mt-1">
                    <span data-plugin="counterup">{{ users }}</span>
                  </h4>
                  <p class="text-muted mb-0">System Users</p>
                </div>
              </div>
            </div>
          </div>
          <!-- end col-->
        </div>

        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title mb-4">Latest Orders</h4>
                <div class="table-responsive">
                  <table class="table table-centered table-nowrap mb-0">
                    <thead class="table-light">
                      <tr>
                        <th style="width: 20px">
                          <div class="form-check font-size-16">
                            <input
                              type="checkbox"
                              class="form-check-input"
                              id="customCheck1"
                            />
                            <label class="form-check-label" for="customCheck1"
                              >&nbsp;</label
                            >
                          </div>
                        </th>
                        <th>Order ID</th>
                        <th>Billing Name</th>
                        <th>Date</th>
                        <th>Total</th>
                        <th>Payment Method</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="order in latest" :key="order.id">
                        <td>
                          <div class="form-check font-size-16">
                            <input
                              type="checkbox"
                              class="form-check-input"
                              id="customCheck2"
                            />
                            <label class="form-check-label" for="customCheck2"
                              >&nbsp;</label
                            >
                          </div>
                        </td>
                        <td>
                          <a
                            href="javascript: void(0);"
                            class="text-body fw-bold"
                            >{{ order.order_no }}</a
                          >
                        </td>
                        <td>{{ order.customer }}</td>
                        <td>{{ order.order_date }}</td>
                        <td>{{ order.total_cost }}</td>

                        <td>
                          {{ order.payment_method }}
                        </td>
                        <td>{{ order.status }}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import LoadingComponent from "./states/LoaderComponent.vue";
export default {
  props: ["stats-url", "user-role"],
  components: { LoadingComponent },
  data() {
    return {
      loading: false,
      orders: 0,
      customers: 0,
      revenues: 0,
      users: 0,
      latest: [],
      role: this.userRole,
    };
  },
  mounted() {
    this.fetch_all();
  },
  methods: {
    fetch_all() {
      this.loading = true;
      axios
        .get(this.statsUrl)
        .then((res) => {
          this.loading = false;
          this.orders = res.data.orders;
          this.revenues = res.data.total;
          this.customers = res.data.customers;
          this.users = res.data.users;
          this.latest = res.data.latest_orders;
        })
        .catch((error) => {
          this.loading = false;
          console.log(error);
        });
    },
  },
};
</script>
