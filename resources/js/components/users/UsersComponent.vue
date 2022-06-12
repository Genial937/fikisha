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
          <h4 class="mb-0">Users</h4>
          <div class="page-title-right">
            <ol class="breadcrumb m-0">
              <li class="breadcrumb-item">
                <a
                  href="javascript: void(0);"
                  @click="handleACtion('add')"
                  class="btn btn-sm rounded-pill btn-primary text-white"
                  ><i class="uil-plus"></i> Add User</a
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
          <data-table v-bind="parametersTable" actionTriggered="handleACtion" />
        </div>
      </div>
    </div>
    <div class="modal fade" id="add">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <form @submit.prevent="save_user()">
            <div class="modal-header">
              <h5 class="modal-title">Add User</h5>
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
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="">Name</label>
                    <input
                      type="text"
                      v-model="user.name"
                      required
                      class="form-control form-control-sm"
                    />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="">Email</label>
                    <input
                      type="email"
                      v-model="user.email"
                      required
                      class="form-control form-control-sm"
                    />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="">Phone</label>
                    <input
                      type="text"
                      v-model="user.phone"
                      required
                      class="form-control form-control-sm"
                    />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="">Password</label>
                    <input
                      type="password"
                      v-model="user.password"
                      required
                      class="form-control form-control-sm"
                    />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="">Confirm Password</label>
                    <input
                      type="password"
                      v-model="user.password_confirmation"
                      required
                      class="form-control form-control-sm"
                    />
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <a href="#" data-bs-dismiss="modal" class="btn btn-danger btn-sm"
                >Cancel</a
              >
              <button class="btn btn-sm btn-primary">Save</button>
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
      users: [],
      role: "",
      saving: false,
      error: false,
      success: false,
      error_message: "",
      success_message: "",
      user: {
        name: "",
        email: "",
        phone: "",
        password: "",
        password_confirmation: "",
      },
    };
  },
  mounted() {
    this.fetch_users();
  },
  computed: {
    parametersTable() {
      return {
        data: this.users,
        tableClass: "table table-sm",
        actionMode: "single",
        actions: ["edit", "delete"],
        columnKeys: ["name", "email", "phone", "last_login", "created_at"],
      };
    },
  },
  watch: {},
  methods: {
    fetch_users() {
      axios
        .get(this.fetchUrl)
        .then((res) => {
          this.users = res.data.users;
          console.log(res.data);
        })
        .catch((error) => {
          console.log(error);
        });
    },
    save_user() {
      this.saving = true;
      let data = {
        name: this.user.name,
        email: this.user.email,
        phone: this.user.email,
        password: this.user.password,
      };
      axios
        .post(this.saveUrl, data)
        .then((res) => {
          this.saving = false;
          this.success = true;
          this.success_message = res.data.message;
          this.fetch_users();
          console.log(res.data);
        })
        .catch((error) => {
          this.saving = false;
          this.error = true;
          this.error_message = error.response.data.message;
          console.log(error);
        });
    },
    handleACtion(actionName, data) {
      if (actionName == "add") {
        $("#add").modal("show");
      }
      if (actionName == "edit") {
      }
    },
  },
};
</script>
