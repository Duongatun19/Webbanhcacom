<template>
   <div>
    <div class="header bg-gradient-success py-7 py-lg-8 pt-lg-9">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="text-center" style="margin-bottom: 5px; margin-top: -3px">
            <h3 class="text-white">
              Chào mừng bạn đến với trang quản trị do CuBon Web sáng lập
            </h3>
            <p class="text-lead text-white">
              Toàn bộ thông tin của website của bạn đều được chúng tôi bảo mật tuyệt đối. Trang quản trị này chỉ dành riêng cho bạn. Nếu bạn quên tài khoản đăng nhập, vui lòng liên hệ với CuBon để được cấp lại tài khoản
            </p>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4 ml-auto mr-auto" style="margin-top: 35px">
      <form>
        <card class="card-login card-plain">
          <div>
            <fg-input
              v-model="objLogin.name"
              class="no-border form-control-lg"
              placeholder="Tên đăng nhập"
              addon-left-icon="now-ui-icons ui-1_email-85"
            >
            </fg-input>

            <fg-input
              v-model="objLogin.password"
              type="password"
              class="no-border form-control-lg"
              placeholder="Mật khẩu"
              addon-left-icon="now-ui-icons ui-1_lock-circle-open"
            >
            </fg-input>
          </div>

          <div slot="footer">
            <button @click="login" class="btn btn-primary"  style="width:100%">
              Đăng nhập
            </button>
          </div>
        </card>
      </form>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import { mapActions } from "vuex";
export default {
  data() {
    return {
      objLogin: {
        name: "",
        password: "",
      },
    };
  },
  methods: {
    ...mapActions(["retrieveToken", "loadings"]),
    login() {
      this.loadings(true);
      this.retrieveToken(this.objLogin)
        .then((response) => {
          this.loadings(false);
          this.$router.push({ name: "home" });
          window.location.reload();
        })
        .catch((error) => {
          this.loadings(false);
          this.$error("Đăng nhập thất bại");
        });
    },
  },
  created() {},
};
</script>

