<template>
  <div>
      <div class="row">
        <div class="col-md-8 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="form-group">
                <label>Tiêu đề khuyến mãi</label>
                <vs-input
                  type="text"
                  size="default"
                  placeholder="Tên bài viết"
                  class="w-100"
                  v-model="objData.name"
                />
              </div>
              <div class="form-group">
                <label>Mô tả ngắn</label>
                <vs-input
                  type="text"
                  size="default"
                  placeholder="Tên bài viết"
                  class="w-100"
                  v-model="objData.description"
                />
              </div>
              <div class="form-group">
                <label>Ảnh đại diện</label>
                <image-upload v-model="objData.image" type="avatar"></image-upload>
              </div>
            </div>
            
          </div>
          
        </div>
        <div class="col-md-4 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="form-group">
                <label>Trạng thái</label>
                <vs-select v-model="objData.status"
                  >
                      <vs-select-item  value="1" text="Hiện" />
                      <vs-select-item  value="0" text="Ẩn" />
                    </vs-select>
              </div>
              <div class="form-group">
                <label>Đường dẫn cho khuyến mãi</label>
                <vs-input
                  type="text"
                  size="default"
                  placeholder="Tên bài viết"
                  class="w-100"
                  v-model="objData.link"
                />
              </div>
            </div>
          </div>
          
        </div>
        
      </div>
      <div class="row fixxed">
        <div class="col-12">
          <div class="saveButton">
            <vs-button color="primary" @click="addPromotions">Lưu</vs-button>
          </div>
        </div>
      </div>
    <!-- content-wrapper ends -->
  </div>
</template>


<script>
import { mapActions } from "vuex";
export default {
  name: "product",
  data() {
    return {
      errors:[],
      cate:[],
      lang:[],
      showLang:{
        title:false,
        content:false,
        description:false
      },
      objData: {
          id: this.$route.params.id,
        name: '',
        description: '',
        status: "",
        image: "",
        link: ""
      }
    };
  },
  components: {
  },
  computed: {},
  watch: {},
  methods: {
    ...mapActions(["addPromotion", "loadings","detailPromotion"]),
    editById() {
      this.loadings(true);
      this.detailPromotion(this.objData).then(response => {
        this.loadings(false);
        if(response.data == null){
          this.objData ={
                    id: this.$route.params.id,
                    name: '',
                    description: '',
                    status: "",
                    image: "",
                    link: ""
                  }
        }else{
          this.objData = response.data;
        }
      }).catch(error => {
        console.log(12);
      });
    },
    addPromotions(){
      this.errors = [];
      if(this.objData.name == '') this.errors.push('Tên không được để trống');
      if(this.objData.description == '') this.errors.push('Mô tả không được để trống');
      if(this.objData.images == '') this.errors.push('Vui lòng chọn ảnh');
      if(this.objData.link == '') this.errors.push('Đường dẫn khônng để trống');
      if (this.errors.length > 0) {
        this.errors.forEach((value, key) => {
          this.$error(value)
        })
        return;
      }else{
        this.loadings(true);
        this.addPromotion(this.objData).then(response => {
          this.loadings(false);
          this.$router.push({name:'listPromotion'});
          this.$success('Thêm khuyến mãi thành công');
        }).catch(error => {
          this.loadings(false);
          this.$error('Thêm khuyến mãi thất bại');
        })
      }
    },
  },
  mounted() {
      this.editById();
  }
};
</script>