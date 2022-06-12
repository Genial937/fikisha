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
          <h4 class="mb-0">Vehicles</h4>
          <div class="page-title-right">
            <ol class="breadcrumb m-0">
              <li class="breadcrumb-item">
                <a
                  href="javascript: void(0);"
                  @click="handleAction('add')"
                  class="btn btn-sm rounded-pill btn-primary text-white"
                  ><i class="uil-plus"></i> Add Vehicle</a
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
          <div>
            <data-table
              v-bind="parametersTable"
              @actionTriggered="handleAction"
            />
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="add">
      <div class="modal-dialog">
        <div class="modal-content">
          <form @submit.prevent="save_vehicle()">
            <div class="modal-header">
              <h5 class="modal-title">Add Vehicle</h5>
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
                <label for="">Vehicle Name</label>
                <input
                  type="text"
                  v-model="vehicle.name"
                  required
                  class="form-control form-control-sm"
                />
              </div>
              <div class="mb-3">
                <label for="">Reg No</label>
                <input
                  type="text"
                  v-model="vehicle.reg_no"
                  required
                  class="form-control form-control-sm"
                />
              </div>
            </div>
            <div class="modal-footer">
              <a href="#" data-bs-dismiss="modal" class="btn btn-sm btn-danger"
                >Cancel</a
              >
              <button type="submit" class="btn btn-primary btn-sm">
                Submit
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="modal fade" id="edit">
      <div class="modal-dialog">
        <div class="modal-content">
          <form @submit.prevent="update_vehicle()">
            <div class="modal-header">
              <h5 class="modal-title">Edit Vehicle</h5>
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
                <label for="">Vehicle Name</label>
                <input
                  type="text"
                  v-model="vehicle.name"
                  required
                  class="form-control form-control-sm"
                />
              </div>
              <div class="mb-3">
                <label for="">Reg No</label>
                <input
                  type="text"
                  v-model="vehicle.reg_no"
                  required
                  class="form-control form-control-sm"
                />
              </div>
            </div>
            <div class="modal-footer">
              <a href="#" data-bs-dismiss="modal" class="btn btn-sm btn-danger"
                >Cancel</a
              >
              <button type="submit" class="btn btn-primary btn-sm">
                Submit
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="modal fade" id="delete">
      <div class="modal-dialog">
        <div class="modal-content">
          <form @submit.prevent="delete_vehicle()">
            <div class="modal-body text-center">
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
              <p>Confirm delete {{ vehicle.name }}?</p>
              <a href="#" data-bs-dismiss="modal" class="btn btn-sm btn-primary"
                >Cancel</a
              >
              <button type="submit" class="btn btn-sm btn-danger">
                Delete
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
import axios from "axios";
import SavingComponent from "../states/SavingComponent.vue";
import SuccessComponent from "../states/SuccessComponent.vue";
import FailComponent from "../states/FailComponent.vue";
import LoadingComponent from "../states/LoaderComponent.vue";
export default {
  props: ["save-url", "fetch-url", "delete-url", "update-url"],
  components: {
    DataTable,
    SavingComponent,
    SuccessComponent,
    FailComponent,
    LoadingComponent,
  },
  data() {
    return {
      vehicles: [],
      vehicle: {
        id: "",
        name: "",
        reg_no: "",
      },
      loading: false,
      error: false,
      success: false,
      error_message: "",
      success_message: "",
      saving: false,
    };
  },
  mounted() {
    this.fetch_vehicles();
  },
  computed: {
    parametersTable() {
      return {
        data: this.vehicles,
        tableClass: "table table-sm",
        actionMode: "single",
        actions: ["edit", "delete"],
        columnKeys: ["name", "reg_no", "status", "created_at"],
      };
    },
  },
  watch: {},
  methods: {
    fetch_vehicles() {
      this.loading = true;
      axios
        .get(this.fetchUrl)
        .then((res) => {
          this.loading = false;
          this.vehicles = res.data.vehicles;
          console.log(res.data);
        })
        .catch((error) => {
          this.loading = false;
          console.log(error);
        });
    },
    handleAction(actionName, data) {
      if (actionName == "add") {
        $("#add").modal("show");
      }
      if (actionName == "edit") {
        this.vehicle.id = data.id;
        this.vehicle.name = data.name;
        this.vehicle.reg_no = data.reg_no;
        $("#edit").modal("show");
      }
      if (actionName == "delete") {
        this.vehicle.id = data.id;
        this.vehicle.name = data.name;
        this.vehicle.reg_no = data.reg_no;
        $("#delete").modal("show");
      }
    },
    save_vehicle() {
      this.saving = true;
      let data = {
        name: this.vehicle.name,
        reg_no: this.vehicle.reg_no,
      };
      axios
        .post(this.saveUrl, data)
        .then((res) => {
          this.saving = false;
          this.success = true;
          this.success_message = res.data.message;
          this.fetch_vehicles();
          this.resetForm();
          console.log(res.data);
        })
        .catch((error) => {
          this.saving = false;
          this.error = true;
          this.error_message = error.response.data.message;
        });
    },
    update_vehicle() {
      this.saving = true;
      let url = this.updateUrl.replace("id", this.vehicle.id);
      let data = {
        name: this.vehicle.name,
        reg_no: this.vehicle.reg_no,
      };
      axios
        .put(url, data)
        .then((res) => {
          this.saving = false;
          this.success = true;
          this.success_message = res.data.message;
          this.fetch_vehicles();
          this.resetForm();
          console.log(res.data);
        })
        .catch((error) => {
          this.saving = false;
          this.error = true;
          this.error_message = error.response.data.message;
        });
    },
    delete_vehicle() {
      this.saving = true;
      let url = this.deleteUrl.replace("id", this.vehicle.id);
      console.log(url);
      axios
        .delete(url)
        .then((res) => {
          this.saving = false;
          this.success = true;
          this.success_message = res.data.message;
          this.fetch_vehicles();
          console.log(res.data);
        })
        .catch((error) => {
          this.saving = false;
          this.error = true;
          this.error_message = error.response.data.message;
          console.log(error);
        });
    },
    resetForm() {
      var self = this; //you need this because *this* will refer to Object.keys below`

      //Iterate through each object field, key is name of the object field`
      Object.keys(this.vehicle).forEach(function (key, index) {
        self.vehicle[key] = "";
      });
    },
  },
};
</script>
