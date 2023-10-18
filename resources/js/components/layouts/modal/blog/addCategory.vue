<template>
  <div class="card-body">
    <form class="forms-sample" enctype="multipart/form-data">
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
              placeholder="Tên sản phẩm"
              class="w-100 inputlang"
              v-model="objData.name[index].content"
            />
          </div>
        </div>
      </div>
      <div class="form-group">
        <vs-input
          class="w-100"
          v-model="objData.path"
          font-size="40px"
          label-placeholder="Link"
        />
      </div>
      <div class="form-group">
        <label for="exampleSelectGender">Avatar</label>
        <image-upload v-model="objData.avatar" type="avatar" :title="'category-blog'"></image-upload>
      </div>
      <div class="form-group">
        <label for="exampleInputName1">Trạng thái</label>
        <vs-switch v-model="objData.status">
          <span slot="on">Hiện</span>
          <span slot="off">Ẩn</span>
        </vs-switch>
      </div>
      <div class="form-group">
        <vs-button
          color="success"
          type="gradient"
          class="mr-left-45"
          @click="handleSubmit()"
        >Lưu lại</vs-button>
      </div>
    </form>
  </div>
</template>

<script>
import { required, email, minLength, sameAs } from "vuelidate/lib/validators";
import { mapActions } from "vuex";
export default {
  data() {
    return {
      showLang:{
        title:false
      },
      errors:[],
      objData: {
        name: [
          {
            lang_code:'vi',
            content:''
          }
        ],
        path: "",
        avatar: "",
        status: ""
      },
      img:'',
      lang:[]
    };
  },
  methods: {
    ...mapActions(["saveCategoryBlog", "loadings","listLanguage"]),
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
    },
    handleSubmit() {
      this.errors = [];
      if(this.objData.name[0].content == '') this.errors.push('Tên không được để trống');
      if (this.errors.length > 0) {
        this.errors.forEach((value, key) => {
          this.$error(value)
        })
        return;
      } else {
        this.saveCategoryBlog(this.objData)
          .then(response => {
            // this.listCate()
            this.$success('Thêm mới danh mục thành công');
            this.$emit("closePopup", false);
          })
          .catch(error => {
            this.$error( Object.values(error.response.data.errors)[0][0]);
          });
      }
    },
    nameImage(event) {
      this.objData.avatar = event;
    },
    listLang(){
      this.listLanguage().then(response => {
        this.lang  = response.data
      }).catch(error => {

      })
    },
  },
   mounted() {
    this.listLang();
    }
};
</script>