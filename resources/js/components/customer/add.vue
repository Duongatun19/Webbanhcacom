<template>
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title">Thêm mới khách hàng</h3>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">Khách hàng</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Thêm mới</li>
          </ol>
        </nav>
      </div>
      <div class="row">
        <div class="col-md-2 grid-margin stretch-card"></div>
        <div class="col-md-5 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="form-group">
                <label>Tên khách hàng</label>
                <vs-input
                  type="text"
                  size="default"
                  placeholder="Tên khách hàng"
                  class="w-100"
                  v-model="objData.name"
                  :class="{ 'is-invalid': submitted && $v.objData.name.$error }"
                />
              </div>
              <div class="form-group">
                <label>Email</label>
                <vs-input
                  type="text"
                  size="default"
                  placeholder="Email"
                  class="w-100"
                  v-model="objData.email"
                />
              </div>
              <div class="form-group">
                <label>Số điện thoại</label>
                <vs-input
                  type="text"
                  size="default"
                  placeholder="Tên bài viết"
                  class="w-100"
                  v-model="objData.phone"
                />
              </div>
              <div class="form-group">
                <label>Địa chỉ</label>
                <vs-textarea v-model="objData.address" class="w-100" height="200px" />
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="form-group">
                <label>Ghi chú</label>
                <vs-textarea v-model="objData.note" class="w-100" />
              </div>
              <div class="form-group">
                <label>Tag</label>
                <vs-input
                  type="text"
                  size="default"
                  placeholder="Tên bài viết"
                  class="w-100"
                  v-model="objData.title"
                />
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-2 grid-margin stretch-card"></div>
      </div>
      <vs-button color="primary" @click="addCustomers" :disabled="$v.$invalid">Thêm mới</vs-button>
    </div>
    <!-- content-wrapper ends -->
  </div>
</template>


<script>
import { mapActions } from "vuex";
import TinyMce from "../_common/tinymce";
import { required } from "vuelidate/lib/validators";
export default {
  name: "customer",
  data() {
    return {
      submitted: false,
      objData: {
        name: "",
        email: "",
        address: "",
        phone: "",
        note: "",
        status: ""
      }
    };
  },
  validations: {
    objData: {
      name: { required },
      email:{required}
    }
  },
  components: {
    TinyMce
  },
  computed: {},
  watch: {},
  methods: {
    ...mapActions(["addCustomer", "loadings",]),
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
  }
};
</script>