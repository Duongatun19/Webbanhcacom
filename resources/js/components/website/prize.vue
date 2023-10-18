<template>
  <div>
      <h3 class="page-title">Quản lý thư viện ảnh</h3>
      <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body" >
              <div class="row" v-for="(item, key) in objData" :key="key">
                <div class="col-md-3">
                  <div class="form-group">
                    <image-upload type="avatar" v-model="item.image" :title="'prize'"></image-upload>
                  </div>
                </div>
                <div class="col-md-9">
                  <div class="form-group">
                    <label>Tên ảnh</label>
                    <label style="float: right;cursor: pointer" title="Xóa ảnh" v-if="key != 0" @click="removeObjPartner(key)">
                      <vs-icon icon="clear"></vs-icon>
                    </label>
                    <vs-input
                      type="text"
                      v-model="item.name"
                      size="default"
                      placeholder="Tên ảnh"
                      class="w-100"
                    />
                  </div>
                  <div class="form-group">
                    <label>Link</label>
                    <vs-input
                      type="text"
                      v-model="item.link"
                      size="default"
                      placeholder="Link liên kết với ảnh (bỏ trống nếu không có)"
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
              <vs-button color="primary" @click="savePrizes">Lưu</vs-button>
              <vs-button color="success" @click="addObjPartner">Thêm ảnh</vs-button>
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
  name: "prize",
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
    ...mapActions(["savePrize", "loadings","listPrize"]),
    savePrizes(){
      this.loadings(true);
      this.savePrize({data:this.objData}).then(response => {
        this.loadings(false);
        this.$success('Thêm giải thưởng thành công');
      }).catch(error => {
        this.loadings(false);
        this.$error('Thêm giải thương thất bại');
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
      this.listPrize().then(response => {
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