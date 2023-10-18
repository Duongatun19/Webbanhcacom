<template>
  <div>
      <h3 class="page-title">Quản lý banner</h3>
      <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body" >
              <div class="row" v-for="(item, key) in objData" :key="key">
                <div class="col-md-3">
                  <div class="form-group">
                    <image-upload type="avatar" v-model="item.image" :title="'banner-trang-chu'"></image-upload>
                  </div>
                </div>
                <div class="col-md-9">
                  <div class="form-group">
                    <label>Tiêu đề (Bỏ trống nếu là banner nhỏ)</label>
                    <label style="float: right;cursor: pointer" title="Xóa banner" v-if="key != 0" @click="removeObjBanner(key)">
                      <vs-icon icon="clear"></vs-icon>
                    </label>
                    <vs-input
                      type="text"
                      v-model="item.title"
                      size="default"
                      placeholder="Tiêu đề banner"
                      class="w-100"
                    />
                  </div>
                  <div class="form-group">
                    <label>Mô tả</label>
                    <label style="float: right;cursor: pointer" title="Xóa banner" v-if="key != 0" @click="removeObjBanner(key)">
                      <vs-icon icon="clear"></vs-icon>
                    </label>
                    <vs-input
                      type="text"
                      v-model="item.description"
                      size="default"
                      placeholder="Mô tả banner"
                      class="w-100"
                    />
                  </div>
                  <div class="form-group">
                    <label>Link</label>
                    <label style="float: right;cursor: pointer" title="Xóa banner" v-if="key != 0" @click="removeObjBanner(key)">
                      <vs-icon icon="clear"></vs-icon>
                    </label>
                    <vs-input
                      type="text"
                      v-model="item.link"
                      size="default"
                      placeholder="Link banner"
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
              <vs-button color="primary" @click="saveBanners">Lưu</vs-button>
              <vs-button color="success" @click="addObjBanner">Thêm banner</vs-button>
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
          link:"",
          title:"",
          description:"",
        }
      ] 
    };
  },
  components: {},
  computed: {},
  watch: {},
  methods: {
    ...mapActions(["saveBanner", "loadings","listBanner"]),
    saveBanners(){
      this.loadings(true);
      this.saveBanner({data:this.objData}).then(response => {
        this.loadings(false);
        this.$success('Sửa banner thành công');
      }).catch(error => {
        this.loadings(false);
        this.$error('Sửa banner thất bại');
      })
    },
    addObjBanner(){
      this.objData.push({
          image: "",
          status:1,
          link:"",
          title:"",
          description:"",
        });
    },
    removeObjBanner(i){
      this.objData.splice(i, 1);
    },
    listBanners(){
      this.loadings(true);
      this.listBanner().then(response => {
        this.loadings(false);
        this.objData = response.data
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