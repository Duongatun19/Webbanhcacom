<template>
  <div>
      <div class="row">
        <div class="col-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-3"><h4 class="card-title">Thêm mới danh mục dự án</h4></div>
                <div class="col-md-6"></div>
                <div class="col-md-3">
                  </div>
              </div>
              <!-- <p class="card-description">Basic form elements</p> -->
              <form class="forms-sample">
                <div class="form-group">
                  <vs-input
                    class="w-100"
                    v-model="objData.name[0].content"
                    font-size="40px"
                    label-placeholder="Tên danh mục"
                  />
                  <el-button size="small" @click="showSettingLangExist('name')">Đa ngôn ngữ</el-button>
                    <div class="dropLanguage" v-if="showLang.title == true">
                      <div class="form-group" v-for="item,index in lang" :key="index">
                        <label v-if="index != 0">{{item.name}}</label>
                        <input
                          v-if="index != 0"
                          type="text"
                          size="default"
                          placeholder="Tên dự án"
                          class="w-100 inputlang"
                          v-model="objData.name[index].content"
                        />
                      </div>
                    </div>
                </div>
                <div class="form-group">
                  <label>Ảnh đại diện hoặc icon</label>
                  <image-upload
                    v-model="objData.avatar"
                    type="avatar"
                    :title="'danh-muc'"
                  ></image-upload>
                </div>
                <div class="form-group">
                  <label>Banner danh mục</label>
                  <image-upload
                    v-model="objData.imagehome"
                    type="avatar"
                    :title="'banner-danh-muc'"
                  ></image-upload>
                </div>
                <!-- <div class="form-group">
                    <label>Nội dung</label>
                    <TinyMce v-model="objData.content" />
                </div> -->
                <div class="form-group">
                  <label for="exampleInputName1">Trạng thái</label>
                  <vs-select v-model="objData.status"
                  >
                      <vs-select-item  value="1" text="Hiện" />
                      <vs-select-item  value="0" text="Ẩn" />
                    </vs-select>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="row fixxed">
        <div class="col-12">
          <div class="saveButton">
            <vs-button color="primary" @click="saveEdit()">Cập nhật</vs-button>
          </div>
        </div>
      </div>
    <!-- content-wrapper ends -->
  </div>
</template>

<script>
import { mapActions } from "vuex";
import TinyMce from "../_common/tinymce";
export default {
  data() {
    return {
      showLang:{
        title:false
      },
      objData: {
        name: [
          {
            lang_code:'vi',
            content:''
          }
        ],
        content: "",
        avatar: "",
        imagehome: "",
        status: 1,
      },
      lang:[],
      img: "",
      errors:[]
    };
  },
components: {
    TinyMce,
  },
  methods: {
    ...mapActions(["saveCategory","listLanguage", "loadings"]),
    nameImage(event) {
      this.objData.avatar = event;
    },
    showSettingLangExist(value){
        this.showLang.title = !this.showLang.title
          this.lang.forEach((value, index) => {
              if(!this.objData.name[index] && value.code != this.objData.name[0].lang_code){
                  var oj = {};
                  oj.lang_code = value.code;
                  oj.content = ''
                  this.objData.name.push(oj)
              }
          });
    },
    saveEdit() {
      this.errors = [];
      if(this.objData.name[0].content == '') this.errors.push('Tên danh mục không được để trống');
      if (this.errors.length > 0) {
        this.errors.forEach((value, key) => {
          this.$error(value)
        })
        return;
      } else {
        this.loadings(true);
        this.saveCategory(this.objData)
        .then(response => {
            this.loadings(false);
            this.$router.push({ name: "list_category" });
            this.$success("Thêm danh mục thành công");
            this.$route.push({ name: "list_category" });
          })
          .catch(error => {
            this.loadings(false);
          });
      }
    },
    listLang(){
      this.listLanguage().then(response => {
        this.loadings(false);
        this.lang  = response.data
      }).catch(error => {

      })
    },

  },
  mounted() {
    this.loadings(true);
    this.listLang();
  }
};
</script>

<style>
</style>