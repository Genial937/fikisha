<template>
  <div>
    <button
      type="button"
      @click.prevent="go_to_cart()"
      class="btn header-item noti-icon waves-effect"
      id="page-header-notifications-dropdown"
      data-bs-toggle="dropdown"
      aria-haspopup="true"
      aria-expanded="false"
    >
      <i class="uil-shopping-cart-alt"></i>
      <span class="badge bg-danger rounded-pill">{{ count }}</span>
    </button>
  </div>
</template>

<script>
import axios from "axios";
export default {
  props: ["count-url", "cart-url"],
  components: {},
  data() {
    return {
      count: 0,
    };
  },
  mounted() {
    this.$root.$on("updateCart", () => {
      this.count_cart();
    });
    this.count_cart();
  },
  methods: {
    count_cart() {
      axios
        .get(this.countUrl)
        .then((res) => {
          this.count = res.data.count;
          console.log(res.data);
        })
        .catch((error) => {
          console.log(error);
        });
    },
    go_to_cart() {
      window.location.href = this.cartUrl;
    },
  },
};
</script>
