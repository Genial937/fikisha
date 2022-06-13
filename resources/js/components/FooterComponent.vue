<template>
  <div>
    <footer class="footer">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">{{ date }} © Fikisha Ltd.</div>
          <div class="col-sm-6">
            <div class="text-sm-end d-none d-sm-block">
              Powered by:
              <a
                href="https://teddygenial.com"
                target="_blank"
                class="text-reset"
                >Teddy Genial</a
              >
            </div>
          </div>
        </div>
      </div>
    </footer>
  </div>
</template>
<script>
export default {
  props: [],
  components: {},
  data() {
    return {
      date: new Date().getFullYear(),
    };
  },
};
</script>
