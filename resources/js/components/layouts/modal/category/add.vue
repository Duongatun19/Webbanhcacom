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
        <label for="exampleSelectGender">Nôi dung</label>
        <TinyMce
                    v-if="index != 0"
                    v-model="objData.content"
                  />
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
import { mapActions } from "vuex";
import TinyMce from "../../../_common/tinymce";
export default {
  data() {
    return {
      showLang:{
        title:false
      },
      errors:[],
      lang:[],
      objData: {
        name: [
          {
            lang_code:'vi',
            content:''
          }
        ],
        content: "",
        avatar: "",
        imagehome:"",
        status: 1
      },
      img:'',
    };
  },
  components: {
    TinyMce,
  },
  methods: {
    ...mapActions(["saveCategory", "loadings","listLanguage"]),
    handleSubmit() {
      this.errors = [];
      if(this.objData.name[0].content == '') this.errors.push('Tên danh mục không được để trống');
      if (this.errors.length > 0) {
        this.errors.forEach((value, key) => {
          this.$error(value)
        })
        return;
      } else {
        this.saveCategory(this.objData)
          .then(response => {
            // this.listCate()
            this.$success('Thêm mới danh mục thành công');
            this.$emit("closePopup", false);
          })
          .catch(error => {
            this.$error(Object.values(error.response.data.errors)[0][0]);
          });
      }
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
    listLang(){
      this.listLanguage().then(response => {
        this.loadings(false);
        this.lang  = response.data
      }).catch(error => {

      })
    },
    nameImage(event) {
      this.objData.avatar = event;
    }
  },
  mounted() {
    this.listLang();
  }
};
</script>