<template>
  <div>
      <h3 class="page-title">Thêm mới khách hàng</h3>
      <div class="row">
        <div class="col-md-2 grid-margin stretch-card"></div>
        <div class="col-md-5 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
                <h1>{{objData.name}}</h1>
                <label v-if="objData.status == 0">
                  <vs-button color="primary" type="border" icon="record_voice_over" @click="popupActivo=true" v-if="objData.email != null">Kích hoạt tài khoản</vs-button>
                </label>
                <label  v-if="objData.status == 1">
                  <vs-button @click="confirm()" color="primary" type="border" icon="voice_over_off" v-if="objData.email != null" style="margin-right:5px;">Vô hiệu hóa tài khoản</vs-button>
                  <vs-button color="primary" type="border" icon="cached" @click="popupReset=true" v-if="objData.email != null">Đặt lại mật khẩu</vs-button>
                </label>
              <div class="form-group">
                <label>Ghi chú</label>
                <vs-textarea v-model="objData.note" class="w-100" height="100" placeholder="Nhập ghi chú về khách hàng" />
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="form-group">
                <a href="javascript:;" style="float:right;" @click="popupBasicInfo = true" >Sửa</a>
                <h4>Liên hệ</h4>
                <label >Email:  {{objData.email}}</label><br>
                <label >Tên:  {{objData.name}}</label><br>
                <label >SĐT:  {{objData.phone}}</label><br>
                <label >Địa chỉ:  {{objData.address}}</label><br>
                <label >Trạng thái:  {{objData.status == 1 ? "Đã có tài khoản" : "Chưa có tài khoản"}}</label><br>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-2 grid-margin stretch-card"></div>
      </div>
      <div class="row">
        <div class="col-md-2 grid-margin stretch-card"></div>
        <div class="col-md-5 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
                <h4>Đơn hàng gần đây</h4>
              <div class="form-group">
                <label>Chưa có đơn hàng</label>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3 grid-margin stretch-card">
        </div>
        <div class="col-md-2 grid-margin stretch-card"></div>
      </div>
      <vs-button color="primary" @click="addCustomers" :disabled="$v.$invalid">Thêm mới</vs-button>
    <vs-popup style="width:100%;" title="Kích hoạt tài khoản" :active.sync="popupActivo" v-if="popupActivo">
        <ActiveAcc @closePopup="closePop($event)" :email.sync="objData.email"/>
    </vs-popup>
    <vs-popup style="width:100%;" title="Đặt lại mật khẩu" :active.sync="popupReset" v-if="popupReset">
        <ActiveAcc @closePopup="closePop($event)" :email.sync="objData.email"/>
    </vs-popup>
    <vs-popup style="width:100%;" title="Sửa thông tin khách hàng" :active.sync="popupBasicInfo" v-if="popupBasicInfo">
        <BasicInfo @closePopup="closePop($event)" :customer.sync="objData"/>
    </vs-popup>
    <!-- content-wrapper ends -->
  </div>
</template>


<script>
import { mapActions } from "vuex";
import TinyMce from "../_common/tinymce";
import ActiveAcc from "../layouts/modal/customer/active_account"
import BasicInfo from "../layouts/modal/customer/infomation"
import { required } from "vuelidate/lib/validators";
export default {
  name: "customer",
  data() {
    return {
      popupActivo:false,
      popupReset:false,
      submitted: false,
      popupBasicInfo:false,
      objData: {
        id:this.$route.params.id_customer,
        name: "",
        email: "",
        address: "",
        phone: "",
        note: "",
        status: ""
      },
    };
  },
  validations: {
    objData: {
      name: { required },
      email:{required}
    }
  },
  components: {
    TinyMce,ActiveAcc,BasicInfo
  },
  computed: {},
  watch: {},
  methods: {
    ...mapActions(["getEditCustomer","addCustomer", "loadings",,"disableAccount"]),
    closePop(event) {
      this.getEditCustomers();
      this.popupActivo = event;
      this.popupReset = event;
      this.popupBasicInfo = event;
    },
    confirm(){
      this.$vs.dialog({
        type:'confirm',
        color: 'danger',
        title: `Vô hiệu hóa tài khoản`,
        text: 'Bạn có chắc muốn vô hiệu hóa tài khoản của khách hàng này không? Khách hàng bị khóa sẽ không thể đăng nhập vào tài khoản của họ nữa!',
        accept:this.disableAccs
      })
    },
    disableAccs(){
      this.disableAccount(this.objData).then(response => {
        this.getEditCustomers();
        this.$success('Vô hiệu hóa thành công');
      })
    },
    getEditCustomers(){
        this.loadings == true;
        this.getEditCustomer(this.objData.id).then(response => {
            this.loadings == false;
            this.objData = response.data
        }).catch(error => {
            this.loadings == false;
        })
    },
    addCustomers() {
      this.submitted = true;
      this.$v.$touch();
      if (this.$v.$invalid) {
        return;
      } else {
        this.loadings(true);
        this.addCustomer(this.objData)
          .then(response => {
            this.loadings(false);
            this.$success('Thêm khách hàng thành công');
          })
          .catch(error => {
            this.loadings(false);
            this.$error('Thêm khách hàng thất bại');
          });
      }
    }
  },
  mounted() {
      this.getEditCustomers();
  }
};
</script>