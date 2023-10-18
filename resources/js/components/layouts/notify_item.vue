<template>
  <div>
    <div :key="index" v-for="(i, index) in unread">
      <div class="dropdown-divider"></div>
      <a class="dropdown-item preview-item">
        <div class="preview-thumbnail">
          <div class="preview-icon bg-success">
            <i class="mdi mdi-account-multiple-plus"></i>
          </div>
        </div>
        <div
          class="preview-item-content d-flex align-items-start flex-column justify-content-center"
        >
          <h6 class="preview-subject font-weight-normal mb-1">Khách hàng mới</h6>
          <p class="text-gray ellipsis mb-0">{{i.data.thread.name}} vừa đăng ký tài khoản</p>
        </div>
      </a>
    </div>
  </div>
</template>
<script>
export default {
  // mixins: [ UserInfor ],
  data() {
    return {};
  },
  components: {},
  props: ["unread"],
  watch: {},
  watch: {},
  methods: {},
  mounted() {}
};
</script>