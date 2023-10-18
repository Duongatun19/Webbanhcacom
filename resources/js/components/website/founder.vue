<template>
  <div>
      <h3 class="page-title">Quản lý Founder</h3>
      <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body" >
              <div class="row" v-for="(item, key) in objData" :key="key">
                <div class="col-md-3">
                  <div class="form-group">
                    <image-upload type="avatar" v-model="item.image"></image-upload>
                  </div>
                </div>
                <div class="col-md-9">
                  <div class="form-group">
                    <label>Tên</label>
                    <label style="float: right;cursor: pointer" title="Xóa founder" v-if="key != 0" @click="removeObjBanner(key)">
                      <vs-icon icon="clear"></vs-icon>
                    </label>
                    <vs-input
                      type="text"
                      v-model="item.name"
                      size="default"
                      placeholder="Tên Founder"
                      class="w-100"
                    />
                  </div>
                  <div class="form-group">
                    <label>Chức Vụ</label>
                    <label style="float: right;cursor: pointer" title="Xóa founder" v-if="key != 0" @click="removeObjBanner(key)">
                      <vs-icon icon="clear"></vs-icon>
                    </label>
                    <vs-input
                      type="text"
                      v-model="item.position"
                      size="default"
                      placeholder="Mô tả founder"
                      class="w-100"
                    />
                  </div>
                  <div class="form-group">
                    <label>Trạng thái</label>
                    <vs-select v-model="item.status"
                  >
                      <vs-select-item  value="1" text="Hiện" />
                      <vs-select-item  value="0" text="Ẩn" />
                    </vs-select>
                  </div>
                </div>
                <hr style="border: 0.5px solid #04040426; width: 100%;">
              </div>
              <vs-button color="primary" @click="saveFounders">Lưu</vs-button>
              <vs-button color="success" @click="addObjBanner">Thêm Founder</vs-button>
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
  name: "product",
  data() {
    return {
      objData:[
        {
          image: "",
          status:1,
          name:"",
          position:"",
        }
      ] 
    };
  },
  components: {},
  computed: {},
  watch: {},
  methods: {
    ...mapActions(["saveFounder", "loadings","listFounder"]),
    saveFounders(){
      this.loadings(true);
      this.saveFounder({data:this.objData}).then(response => {
        this.loadings(false);
        this.$success('Sửa Founder thành công');
      }).catch(error => {
        this.loadings(false);
        this.$error('Sửa Founder thất bại');
      })
    },
    addObjBanner(){
      this.objData.push({
          image: "",
          status:1,
          name:"",
          position:"",
        });
    },
    removeObjBanner(i){
      this.objData.splice(i, 1);
    },
    listFounders(){
      this.loadings(true);
      this.listFounder().then(response => {
        this.loadings(false);
        this.objData = response.data
      }).catch(error => {
        this.loadings(false);;
      })
    }
  },
  mounted() {
    this.listFounders();
  }
};
</script>