<template>
  <div>
    <div
      class="
        alert alert-success
        d-flex
        align-items-between
        alert-dismissible
        fade
        show
      "
      role="alert"
    >
      <svg
        class="bi flex-shrink-0 me-2"
        width="24"
        height="24"
        role="img"
        aria-label="Success:"
      >
        <use xlink:href="#check-circle-fill" />
      </svg>
      <div>{{ message }}</div>
      <button
        type="button"
        class="btn-close"
        data-bs-dismiss="alert"
        aria-label="Close"
      ></button>
    </div>
  </div>
</template>

<script>
export default {
  props: ["message"],
  data() {
    return {};
  },
  mounted() {},
};
</script>
