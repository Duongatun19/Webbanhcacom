<template>
  <div>
      <div class="row">
        <div class="col-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-3">
                  <h4 class="card-title">Sửa loại tin tức</h4>
                </div>
                <div class="col-md-6"></div>
                <div class="col-md-3">
                  <vs-select
                    class="selectExample"
                    v-model="objData.language"
                    placeholder="Ngôn ngữ bài viết"
                    @change="changeLanguage($event)"
                  >
                    <vs-select-item
                      :key="index"
                      :value="item.code"
                      :text="item.name"
                      v-for="item,index in lang"
                    />
                  </vs-select>
                </div>
              </div>

              <!-- <p class="card-description">Basic form elements</p> -->
              <form class="forms-sample">
                <div class="form-group">
                  <vs-input
                    class="w-100"
                    v-model="objData.name[0].content"
                    :class="{ 'is-invalid': submitted && $v.objData.name.$error }"
                    font-size="40px"
                    label-placeholder="Tên danh mục"
                  />
                  <div
                    v-if="submitted && !$v.objData.name.required"
                    class="noti-err"
                  >Tên không để trống</div>
                </div>
                <div class="form-group">

                  <vs-select class="selectExample" v-model="objData.category_slug" placeholder="Danh mục">
                  <vs-select-item
                    :value="0"
                    text="Danh mục chac"
                  />
                  <vs-select-item
                    :value="item.slug"
                    :text="JSON.parse(item.name)[0].content"
                    v-for="(item,index) in categoryList"
                    :key="'f'+index"
                  />
                </vs-select>
                  <div
                    v-if="submitted && !$v.objData.category_slug.required"
                    class="noti-err"
                  >Danh mục cha không để trống</div>
                </div>
                <div class="form-group">
                  <label for="exampleInputName1">Ảnh đại diện</label>
                  <image-upload v-model="objData.avatar" type="avatar"></image-upload>
                </div>
                <div class="form-group">
                  <label for="exampleInputName1">Trạng thái</label>
                  <vs-select v-model="objData.status"
                  >
                    <vs-select-item  value="1" text="Hiện" />
                    <vs-select-item  value="0" text="Ẩn" />
                  </vs-select>
                </div>
                <vs-button
                  color="success"
                  type="gradient"
                  class="mr-left-45"
                  @click="saveEdit()"
                >Lưu lại</vs-button>
              </form>
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
  data() {
    return {
      objData: {
        language: this.$route.params.language,
        id:this.$route.params.id,
        name: [
          {
            lang_code:'vi',
            content:''
          }
        ],
        category_slug: "",
        avatar: "",
        status: "",
        slug:"",
      },
      categoryList:[],
      lang: [],
      img: "",
      submitted: false
    };
  },
  validations: {
    objData: {
      name: { required },
      category_slug: { required }
    }
  },
  methods: {
    ...mapActions([
      "getInfoTypeBlog",
      "saveTypeCateBlog",
      "listLanguage",
      "loadings","listCateBlog"
    ]),
    nameImage(event) {
      this.objData.avatar = event;
    },
    listCategory() {
      this.loadings(true);
      this.listCateBlog()
      .then(response => {
          this.loadings(false);
          this.categoryList = response.data;
        });
    },
    saveEdit() {
      this.submitted = true;
      this.$v.$touch();
      if (this.$v.$invalid) {
        return;
      } else {
        this.loadings(true);
        this.saveTypeCateBlog(this.objData)
          .then(response => {
            this.loadings(false);
            this.$success("Sửa danh mục thành công");
            this.$emit("closePopup", false);
          })
          .catch(error => {
            this.loadings(false);
            this.$error("Sửa danh mục thất bại");
          });
      }
    },
    listLang() {
      this.listLanguage()
        .then(response => {
          this.loadings(false);
          this.lang = response.data;
        })
        .catch(error => {});
    },
    getInfoCates() {
      this.loadings(true);
      this.getInfoTypeBlog(this.objData)
        .then(response => {
          this.loadings(false);
          if (response.data == null) {
            this.objData = {
              id: this.$route.params.id,
              name: "",
              category_slug: "",
              avatar: "",
              status: ""
            };
          } else {
            this.objData = response.data;
             this.objData.name = JSON.parse(response.data.name);
          }
        })
        .catch(error => {
          console.log(12);
        });
    },
    changeLanguage(data) {
      this.getInfoCates();
    }
  },
  mounted() {
    this.loadings(true);
    this.getInfoCates();
    this.listLang();
    this.listCategory();
  }
};
</script>

<style>
</style>