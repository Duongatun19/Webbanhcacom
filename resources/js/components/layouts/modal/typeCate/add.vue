<template>
  <div class="card-body">
    <form class="forms-sample" enctype="multipart/form-data">
      <div class="form-group">
        <vs-input
          class="w-100"
          v-model="objData.name[0].content"
          :class="{ 'is-invalid': submitted && $v.objData.name.$error }"
          font-size="40px"
          label-placeholder="Tên loại sản phẩm"
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
       <vs-select class="selectExample" v-model="objData.cate_id" placeholder="Danh mục">
            <vs-select-item
              :value="item.id"
              :text="JSON.parse(item.name)[0].content"
              v-for="(item,index) in categoryList"
              :key="'f'+index"
            />
          </vs-select>
        <div v-if="submitted && !$v.objData.path.required" class="noti-err">Loại không để trống</div>
      </div>
      <div class="form-group">
        <label for="exampleSelectGender">Avatar</label>
        <image-upload v-model="objData.avatar" type="avatar"></image-upload>
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
      lang:[],
      objData: {
        name: [
          {
            lang_code:'vi',
            content:''
          }
        ],
        path: "link",
        avatar: "123",
        status: 1,
        cate_id:0
      },
      img:'',
      categoryList:[],
      submitted: false
    };
  },
  validations: {
    objData: {
      name: { required },
      path: { required }
    }
  },
  methods: {
    ...mapActions(["saveTypeCate", "loadings","listCate",,"listLanguage"]),
    handleSubmit() {
      this.errors = [];
      if(this.objData.name[0].content == '') this.errors.push('Tên danh mục không được để trống');
      if (this.errors.length > 0) {
        this.errors.forEach((value, key) => {
          this.$error(value)
        })
        return;
      } else {
        this.saveTypeCate(this.objData)
          .then(response => {
            // this.listCate()
            this.$success('Thêm mới loại thành công');
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
    },
    listCategory() {
      this.loadings(true);
      this.listCate()
      .then(response => {
          this.loadings(false);
          this.categoryList = response.data;
        });
    },
  },
  mounted(){
      this.listCategory();
      this.listLang();
  }
};
</script>