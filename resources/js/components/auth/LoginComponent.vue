<template>
  <div>
    <div class="account-pages my-5 pt-sm-5">
      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-8 col-lg-6 col-xl-5">
            <div class="card">
              <div class="card-body p-4">
                <div class="text-center mt-2">
                  <img
                    src="logo.svg"
                    alt=""
                    height="60"
                    class="logo logo-dark m-auto"
                  />
                  <p class="text-muted mt-2">Sign in to continue.</p>
                </div>
                <div class="p-2 mt-4">
                  <form @submit.prevent="login_user()">
                    <div
                      v-if="saving"
                      class="mb-2 d-flex justify-content-center"
                    >
                      <saving-component></saving-component>
                    </div>
                    <div v-if="success" class="mb-2">
                      <success-component
                        :message="success_message"
                      ></success-component>
                    </div>
                    <div v-if="error" class="mb-2">
                      <fail-component :message="error_message"></fail-component>
                    </div>
                    <div class="mb-3">
                      <label class="form-label" for="username">Email</label>
                      <input
                        type="email"
                        class="form-control"
                        v-model="email"
                        required
                        placeholder="Enter email"
                      />
                    </div>

                    <div class="mb-3">
                      <div class="float-end">
                        <a href="auth-recoverpw.html" class="text-muted"
                          >Forgot password?</a
                        >
                      </div>
                      <label class="form-label" for="userpassword"
                        >Password</label
                      >
                      <input
                        type="password"
                        class="form-control"
                        v-model="password"
                        required
                        placeholder="Enter password"
                      />
                    </div>

                    <div class="form-check">
                      <input
                        type="checkbox"
                        class="form-check-input"
                        id="auth-remember-check"
                      />
                      <label class="form-check-label" for="auth-remember-check"
                        >Remember me</label
                      >
                    </div>

                    <div class="mt-3 text-end">
                      <button
                        class="btn btn-primary w-sm waves-effect waves-light"
                        type="submit"
                      >
                        Log In
                      </button>
                    </div>

                    <div class="mt-4 text-center">
                      <p class="mb-0">
                        Are you a customer ?
                        <a href="/products" class="fw-medium text-primary">
                          Go to shop
                        </a>
                      </p>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <div class="mt-5 text-center">
              <p>
                ©
                <span>
                  {{ date }}
                </span>
                Fikisha Ltd. Powered By
                <i class="mdi mdi-heart text-danger"></i> Teddy Genial
              </p>
            </div>
          </div>
        </div>
        <!-- end row -->
      </div>
      <!-- end container -->
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
  props: ["login-url", "home-url"],
  components: {
    SavingComponent,
    SuccessComponent,
    FailComponent,
    LoadingComponent,
  },
  data() {
    return {
      date: new Date().getFullYear(),
      email: "",
      password: "",
      error: false,
      success: false,
      success_message: "",
      error_message: "",
      saving: false,
    };
  },
  mounted() {},
  watch: {},
  methods: {
    login_user() {
      this.saving = true;
      let data = {
        email: this.email,
        password: this.password,
      };
      axios
        .post(this.loginUrl, data)
        .then((res) => {
          this.saving = false;
          this.success = true;
          this.success_message = res.data.message;
          setTimeout(() => {
            window.location.href = this.homeUrl;
          }, 3000);
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
