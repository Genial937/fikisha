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
          <h4 class="mb-0">Customers</h4>
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
              actionTriggered="handleACtion"
            />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import DataTable from "@andresouzaabreu/vue-data-table";
import "@andresouzaabreu/vue-data-table/dist/DataTable.css";
import LoadingComponent from "../states/LoaderComponent.vue";
import axios from "axios";
export default {
  props: ["fetch-url"],
  components: { DataTable, LoadingComponent },
  data() {
    return {
      loading: false,
      customers: [],
    };
  },
  mounted() {
    this.fetch_all();
  },
  computed: {
    parametersTable() {
      return {
        data: this.customers,
        tableClass: "table table-sm",
        columnKeys: [
          "name",
          "phone",
          "email",
          "address",
          "last_login",
          "created_at",
          "orders",
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
          this.customers = res.data.customers;
        })
        .catch((error) => {
          this.loading = false;
          console.log(error);
        });
    },
    handleACtion(actionName, data) {},
    launchModal(actionName) {},
  },
};
</script>
