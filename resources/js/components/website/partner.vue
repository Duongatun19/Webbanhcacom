<template>
  <div>
      <h3 class="page-title">Quản lý đối tác</h3>
      <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body" >
              <div class="row" v-for="(item, key) in objData" :key="key">
                <div class="col-md-3">
                  <div class="form-group">
                    <image-upload type="avatar" v-model="item.image" :title="'doi-tac'"></image-upload>
                  </div>
                </div>
                <div class="col-md-9">
                  <div class="form-group">
                    <label>Tên đối tác</label>
                    <label style="float: right;cursor: pointer" title="Xóa đối tác" v-if="key != 0" @click="removeObjPartner(key)">
                      <vs-icon icon="clear"></vs-icon>
                    </label>
                    <vs-input
                      type="text"
                      v-model="item.name"
                      size="default"
                      placeholder="Tên đối tác"
                      class="w-100"
                    />
                  </div>
                  <div class="form-group">
                    <label>Link</label>
                    <vs-input
                      type="text"
                      v-model="item.link"
                      size="default"
                      placeholder="Link liên kết với đối tác (bỏ trống nếu không có)"
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
              <vs-button color="primary" @click="savePartners">Lưu</vs-button>
              <vs-button color="success" @click="addObjPartner">Thêm đối tác</vs-button>
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
          name:"",
          image: "",
          status:"",
          link:""
        }
      ] 
    };
  },
  components: {},
  computed: {},
  watch: {},
  methods: {
    ...mapActions(["savePartner", "loadings","listPartner"]),
    savePartners(){
      this.loadings(true);
      this.savePartner({data:this.objData}).then(response => {
        this.loadings(false);
        this.$success('Thêm đối tác thành công');
      }).catch(error => {
        this.loadings(false);
        this.$error('Thêm đối tác thất bại');
      })
    },
    addObjPartner(){
      this.objData.push({
          name:"",
          image: "",
          status:"",
          link:""
        });
    },
    removeObjPartner(i){
      this.objData.splice(i, 1);
    },
    listBanners(){
      this.loadings(true);
      this.listPartner().then(response => {
        this.loadings(false);
        if(response.data.length > 0){
          this.objData = response.data
        }else{
          this.objData = [
            {
              name:"",
              image: "",
              status:"",
              link:""
            }
          ]
        }
        
      }).catch(error => {
        this.loadings(false);;
      })
    }
  },
  mounted() {
    this.listBanners();
  }
};
</script>