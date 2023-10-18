<template>
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title">Cài đặt chung</h3>
      </div>
      <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body" >
                <div class="form-group">
                  <label>Tên doanh nghiệp</label>
                  <vs-input
                    type="text"
                    size="default"
                    class="w-100"
                    v-model="objData.company"
                  />
                </div>
                <div class="form-group">
                  <label>Tên website</label>
                  <vs-input
                    type="text"
                    size="default"
                    class="w-100"
                    v-model="objData.webname"
                  />
                </div>
                <div class="form-group">
                  <label>Văn phòng đại diện</label>
                  <vs-input
                    type="text"
                    size="default"
                    class="w-100"
                    v-model="objData.address1"
                  />
                </div>
                <div class="form-group">
                  <label>Địa chỉ</label>
                  <vs-input
                    type="text"
                    size="default"
                    class="w-100"
                    v-model="objData.address2"
                  />
                </div>
                <div class="form-group">
                  <label>Số điện thoại 1</label>
                  <vs-input
                    type="text"
                    size="default"
                    class="w-100"
                    v-model="objData.phone1"
                  />
                </div>
                <div class="form-group">
                  <label>Số điện thoại 2</label>
                  <vs-input
                    type="text"
                    size="default"
                    class="w-100"
                    v-model="objData.phone2"
                  />
                </div>
                <div class="form-group">
                  <label>Fax</label>
                  <vs-input
                    type="text"
                    size="default"
                    class="w-100"
                    v-model="objData.fax"
                  />
                </div>
                <div class="form-group">
                  <label>Email</label>
                  <vs-input
                    type="text"
                    size="default"
                    class="w-100"
                    v-model="objData.email"
                  />
                </div>
                <div class="form-group">
                  <label>Facebook</label>
                  <vs-input
                    type="text"
                    size="default"
                    class="w-100"
                    v-model="objData.facebook"
                  />
                </div>
                <div class="form-group">
                  <label>Google</label>
                  <vs-input
                    type="text"
                    size="default"
                    class="w-100"
                    v-model="objData.google"
                  />
                </div>
                <div class="form-group">
                  <label>Code Google analytics</label>
                  <vs-input
                    type="text"
                    size="default"
                    class="w-100"
                    v-model="objData.GA"
                  />
                </div>
                <div class="form-group">
                  <label>Iframe GG map</label>
                  <vs-input
                    type="text"
                    size="default"
                    class="w-100"
                    v-model="objData.iframe_map"
                  />
                </div>
                <div class="form-group">
                  <label>Favicon</label>
                  <image-upload type="avatar" v-model="objData.favicon" ></image-upload>
                </div>
                <div class="form-group">
                  <label>Logo</label>
                  <image-upload type="avatar" v-model="objData.logo"></image-upload>
                </div>
              <vs-button color="primary" @click="saveSetting">Lưu</vs-button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- content-wrapper ends -->
  </div>
</template>


<script>
import { mapActions } from "vuex";
import { required } from "vuelidate/lib/validators";
export default {
  name: "setting",
  data() {
    return {
      objData:
        {
            webname : "",
            company : "",
            address1: "",
            address2 : "",
            phone1 : "",
            phone2 : "",
            fax : "",
            email : "",
            facebook : "",
            google : "",
            GA : "",
            fbPixel : "",
            iframe_map : "",
            favicon : "",
            logo : ""
        }
    };
  },
  components: {},
  computed: {},
  watch: {},
  methods: {
    ...mapActions(["postSetting", "loadings","getSetting"]),
    saveSetting(){
      this.loadings(true);
      this.postSetting(this.objData).then(response => {
        this.loadings(false);
        this.$success('Cài đặt thành công');
      }).catch(error => {
        this.loadings(false);
        this.$error('Cài đặt thất bại');
      })
    },
    listSettings(){
      this.loadings(true);
      this.getSetting().then(response => {
        this.loadings(false);
        this.objData = response.data
      }).catch(error => {
        this.loadings(false);;
      })
    }
  },
  mounted() {
    this.listSettings();
  }
};
</script>