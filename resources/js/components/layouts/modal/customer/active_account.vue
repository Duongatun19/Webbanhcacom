<template>
  <div class="card-body">
    <form class="forms-sample" enctype="multipart/form-data">
      <div class="form-group">
        <vs-input
          class="w-100"
          type="password"
          v-model="objData.password"
          :class="{ 'is-invalid': submitted && $v.objData.password.$error }"
          font-size="40px"
          label-placeholder="Mật khẩu"
        />
        <div v-if="submitted && !$v.objData.password.required" class="noti-err">Mật khẩu không để trống</div>
      </div>
      <div class="form-group">
        <vs-input
          class="w-100"
          type="password"
          v-model="objData.rePassword"
          font-size="40px"
          label-placeholder="Nhập lại mật khẩu"
          :class="{'is-invalid': submitted && $v.objData.rePassword.$error}"
        />
        <div v-if="submitted && !$v.objData.rePassword.required" class="noti-err">Nhập lại mật khẩu</div>
        <div v-if="submitted && !$v.objData.rePassword.sameAsPassword" class="noti-err">Nhập lại mật khẩu không chính xác</div>
      </div>
      <!-- <div class="form-group">
        <vs-checkbox v-model="objData.notify">Gửi thông báo cho tài khoản</vs-checkbox>
      </div> -->
      <div class="form-group">
        <vs-button
          color="success"
          type="gradient"
          class="mr-left-45"
          @click="handleSubmit()"
        >Lưu lại</vs-button>
      </div>
    </form>
  </div>
</template>

<script>
import { required, email, minLength, sameAs } from "vuelidate/lib/validators";
import { mapActions } from "vuex";
export default {
  data() {
    return {
      objData: {
        password: "",
        rePassword: "",
        notify:0,
        email:this.email
      },
      img:'',
      submitted: false
    };
  },
  props:['email'],
  validations: {
    objData: {
      password: { required },
      rePassword: { 
            required,
            sameAsPassword: sameAs('password')
        }
    }
  },
  methods: {
    ...mapActions(["activeCustomer", "loadings"]),
    handleSubmit() {
      this.submitted = true;
      this.$v.$touch();
      if (this.$v.$invalid) {
        return;
      } else {
        this.activeCustomer(this.objData)
          .then(response => {
            // this.listCate()
            this.$success('Thêm mới danh mục thành công');
            this.$emit("closePopup", false);
          })
          .catch(error => {
            this.$error(Object.values(error.response.data.errors)[0][0]);
            this.$emit("closePopup", false);
          });
      }
    },
  },
  mounted(){
    console.log(this.email);
  }
};
</script>