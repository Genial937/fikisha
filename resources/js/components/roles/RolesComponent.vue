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
          <h4 class="mb-0">Roles</h4>
          <div class="page-title-right">
            <ol class="breadcrumb m-0">
              <li class="breadcrumb-item">
                <a
                  href="javascript: void(0);"
                  @click="launchModal('add')"
                  class="btn btn-sm rounded-pill btn-primary text-white"
                  ><i class="uil-plus"></i> Add Role</a
                >
              </li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <!-- end page title -->
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

    <div class="modal fade" id="add">
      <div class="modal-dialog">
        <div class="modal-content">
          <form @submit.prevent="save_role()">
            <div class="modal-header">
              <h5 class="modal-title">Add Role</h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>
            </div>
            <div class="modal-body">
              <div v-if="saving">
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
                <label for="">Role</label>
                <input
                  type="text"
                  v-model="name"
                  class="form-control form-control-sm"
                  required
                />
              </div>
            </div>
            <div class="modal-footer">
              <a href="#" data-bs-dismiss="modal" class="btn btn-sm btn-danger"
                >Cancel</a
              >
              <button class="btn btn-primary btn-sm">Save</button>
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
import axios from "axios";
import SavingComponent from "../states/SavingComponent.vue";
import SuccessComponent from "../states/SuccessComponent.vue";
import FailComponent from "../states/FailComponent.vue";
import LoadingComponent from "../states/LoaderComponent.vue";

export default {
  props: ["save-url", "fetch-url"],
  components: {
    DataTable,
    SavingComponent,
    SuccessComponent,
    FailComponent,
    LoadingComponent,
  },
  data() {
    return {
      roles: [],
      name: "",
      loading: false,
      saving: false,
      error: false,
      success: false,
      success_message: "",
      error_message: "",
    };
  },
  mounted() {
    this.fetch_roles();
  },
  computed: {
    parametersTable() {
      return {
        data: this.roles,
        tableClass: "table table-sm",
        columnKeys: ["name"],
      };
    },
  },
  watch: {},
  methods: {
    fetch_roles() {
      this.loading = true;
      axios
        .get(this.fetchUrl)
        .then((res) => {
          this.loading = false;
          this.roles = res.data.roles;
        })
        .catch((error) => {
          this.loading = false;
          console.log(error);
        });
    },
    save_role() {
      this.saving = true;
      let data = {
        name: this.name,
      };
      axios
        .post(this.saveUrl, data)
        .then((res) => {
          this.success = true;
          this.saving = false;
          this.success = true;
          this.success_message = res.data.message;
          this.fetch_roles();
          console.log(res.data);
        })
        .catch((error) => {
          this.saving = false;
          this.error = true;
          this.error_message = error.response.data.message;
          console.log(error);
        });
    },
    handleACtion(actionName, data) {},
    launchModal(actionName) {
      if (actionName == "add") {
        $("#add").modal("show");
      }
    },
  },
};
</script>
