<template>
  <div>
      <div class="row">
        <div class="col-md-8 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="form-group">
                <label>Tên khách hàng</label>
                <vs-input
                  type="text"
                  size="default"
                  placeholder="Tên bài viết"
                  class="w-100"
                  v-model="objData.name[0].content"
                />
                <el-button size="small" @click="showSettingLangExist('name')">Đa ngôn ngữ</el-button>
                <div class="dropLanguage" v-if="showLang.title == true">
                  <div class="form-group" v-for="item,index in lang" :key="index">
                    <label v-if="index != 0">{{item.name}}</label>
                    <input
                      v-if="index != 0"
                      type="text"
                      size="default"
                      placeholder="Tên sản phẩm"
                      class="w-100 inputlang"
                      v-model="objData.name[index].content"
                    />
                  </div>
                </div>
              </div>
              <div class="form-group">
              <label>Chức vụ</label>
              <vs-input
                type="text"
                size="default"
                placeholder="Chức vụ/Công việc"
                class="w-100"
                v-model="objData.position[0].content"
              />
              <el-button size="small" @click="showSettingLangExist('position')"
                >Đa ngôn ngữ</el-button
              >
              <div class="dropLanguage" v-if="showLang.title == true">
                <div
                  class="form-group"
                  v-for="(item, index) in lang"
                  :key="index"
                >
                  <label v-if="index != 0">{{ item.name }}</label>
                  <input
                    v-if="index != 0"
                    type="text"
                    size="default"
                    placeholder="Chức vụ/Công việc"
                    class="w-100 inputlang"
                    v-model="objData.position[index].content"
                  />
                </div>
              </div>
            </div>
              <div class="form-group">
                <label>Nội dung</label>
                <TinyMce v-model="objData.content[0].content" />
                <el-button size="small" @click="showSettingLangExist('content')">Đa ngôn ngữ</el-button>
                <div class="dropLanguage" v-if="showLang.content == true">
                    <div class="form-group" v-for="item,index in lang" :key="index">
                        <label v-if="index != 0">{{item.name}}</label>
                        <TinyMce v-if="index != 0" v-model="objData.content[index].content" />
                    </div>
                </div>
              </div>
              <div class="form-group">
                <label>Ảnh đại diện</label>
                <image-upload v-model="objData.avatar" type="avatar" :title="objData.name[0].content"></image-upload>
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
            </div>
          </div>
        </div>
        
      </div>
      <div class="row fixxed">
        <div class="col-12">
          <div class="saveButton">
            <vs-button color="primary" @click="addReviewCuss">Cập nhật</vs-button>
          </div>
        </div>
      </div>
    <!-- content-wrapper ends -->
  </div>
</template>


<script>
import { mapActions } from "vuex";
import TinyMce from "../_common/tinymce";
import { required } from "vuelidate/lib/validators";
export default {
  name: "editService",
  data() {
    return {
      showLang:{
        title:false,
        content:false,
        description:false
      },
      errors:[],
      cate:[],
      type_cate:[],
      objData: {
        id: this.$route.params.id,
        name: [
          {
            lang_code:'vi',
            content:''
          }
        ],
        content: [
          {
            lang_code:'vi',
            content:''
          }
        ],
        position: [
          {
            lang_code:'vi',
            content:''
          }
        ],
        status: 1,
        avatar: ""
      },
      lang:[]
    };
  },
  components: {
    TinyMce
  },
  computed: {},
  watch: {},
  methods: {
    ...mapActions(["addReviewCus", "loadings","detailReviewCus","listLanguage"]),
    addReviewCuss(){
      this.errors = [];
      if(this.objData.name[0].content == '') this.errors.push('Tên không được để trống');
      if(this.objData.content[0].content == '') this.errors.push('Nội dung không được để trống');
      if(this.objData.position[0].content == '') this.errors.push('Chức vụ không được để trống');
      if(this.objData.avatar == '') this.errors.push('Vui lòng chọn ảnh');
      if (this.errors.length > 0) {
        this.errors.forEach((value, key) => {
          this.$error(value)
        })
        return;
      }else{
        this.loadings(true);
        this.addReviewCus(this.objData).then(response => {
          this.loadings(false);
          this.$router.push({name:'listReviewCus'});
          this.$success('Sửa Review thành công');
        }).catch(error => {
          this.loadings(false);
          this.$error('Sửa Review thất bại');
        })
      }
    },
    showSettingLangExist(value,name = "content"){
      if(value == "name"){
        this.showLang.title = !this.showLang.title
          this.lang.forEach((value, index) => {
              if(!this.objData.name[index] && value.code != this.objData.name[0].lang_code){
                  var oj = {};
                  oj.lang_code = value.code;
                  oj.content = ''
                  this.objData.name.push(oj)
              }
          });
      }
      if(value == "content"){
        this.showLang.content = !this.showLang.content
          this.lang.forEach((value, index) => {
              if(!this.objData.content[index] && value.code != this.objData.content[0].lang_code){
                  var oj = {};
                  oj.lang_code = value.code;
                  oj.content = ''
                  this.objData.content.push(oj)
              }
          });
      }
      if(value == "position"){
        this.showLang.description = !this.showLang.description
          this.lang.forEach((value, index) => {
              if(!this.objData.position[index] && value.code != this.objData.position[0].lang_code){
                  var oj = {};
                  oj.lang_code = value.code;
                  oj.content = ''
                  this.objData.position.push(oj)
              }
          });
      }
      
    },
    editById() {
      this.loadings(true);
      this.detailReviewCus(this.objData).then(response => {
        this.loadings(false);
        if(response.data == null){
          this.objData ={
                    id: this.$route.params.id,
                    name: [
                      {
                        lang_code:'vi',
                        content:''
                      }
                    ],
                    content: [
                      {
                        lang_code:'vi',
                        content:''
                      }
                    ],
                    position: [
                      {
                        lang_code:'vi',
                        content:''
                      }
                    ],
                    status: "",
                    avatar: ""
                  }
        }else{
          this.objData = response.data;
           this.objData.content = JSON.parse(response.data.content);
          this.objData.position = JSON.parse(response.data.position);
          this.objData.name = JSON.parse(response.data.name);
        }
      }).catch(error => {
        console.log(12);
      });
    },
    listLang(){
      this.listLanguage().then(response => {
        this.lang  = response.data
      }).catch(error => {

      })
    },
    changeLanguage(data){
      this.editById();
    }
  },
  mounted() {
    this.editById();
    this.listLang();
  }
};
</script>