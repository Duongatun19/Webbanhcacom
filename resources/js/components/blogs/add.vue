<template>
  <div>
    <div class="row">
      <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="form-group">
              <label>Tiêu đề tin tức</label>
              <vs-input
                type="text"
                size="default"
                placeholder="Tên bài viết"
                class="w-100"
                v-model="objData.title[0].content"
              />
              <el-button size="small" @click="showSettingLangExist('name')"
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
                    placeholder="Tên sản phẩm"
                    class="w-100 inputlang"
                    v-model="objData.title[index].content"
                  />
                </div>
              </div>
            </div>
            <div class="form-group">
              <label>Nội dung</label>
              <TinyMce v-model="objData.content[0].content" />
              <el-button size="small" @click="showSettingLangExist('content')"
                >Đa ngôn ngữ</el-button
              >
              <div class="dropLanguage" v-if="showLang.content == true">
                <div
                  class="form-group"
                  v-for="(item, index) in lang"
                  :key="index"
                >
                  <label v-if="index != 0">{{ item.name }}</label>
                  <TinyMce
                    v-if="index != 0"
                    v-model="objData.content[index].content"
                  />
                </div>
              </div>
            </div>
            <div class="form-group">
              <label>Mô tả ngắn</label>
              <vs-input
                type="text"
                size="default"
                placeholder="Tên bài viết"
                class="w-100"
                v-model="objData.description[0].content"
              />
              <el-button
                size="small"
                @click="showSettingLangExist('description')"
                >Đa ngôn ngữ</el-button
              >
              <div class="dropLanguage" v-if="showLang.description == true">
                <div
                  class="form-group"
                  v-for="(item, index) in lang"
                  :key="index"
                >
                  <label v-if="index != 0">{{ item.name }}</label>
                  <vs-input
                    type="text"
                    size="default"
                    placeholder="Tên bài viết"
                    class="w-100"
                    v-model="objData.description[index].content"
                  />
                </div>
              </div>
            </div>
            <div class="form-group">
              <label>Ảnh đại diện</label>
              <image-upload
                v-model="objData.image"
                type="avatar"
                :title="objData.title[0].content"
              ></image-upload>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="form-group">
              <label>Trạng thái</label>
              <vs-select v-model="objData.status">
                <vs-select-item value="1" text="Hiện" />
                <vs-select-item value="0" text="Ẩn" />
              </vs-select>
            </div>
            <!-- <div class="form-group">
              <label>Danh mục</label>
              <vs-select
                class="selectExample"
                v-model="objData.category"
                placeholder="Danh mục"
                @change="findCategoryType()"
              >
                <vs-select-item value="0" text="Không danh mục" />
                <vs-select-item
                  :value="item.slug"
                  :text="JSON.parse(item.name)[0].content"
                  v-for="(item, index) in cate"
                  :key="'f' + index"
                />
              </vs-select>
            </div> -->
            <!-- <div class="form-group">
              <label>Loại danh mục</label>
              <vs-select
                class="selectExample"
                v-model="objData.type_cate"
                placeholder="Danh mục"
                :disabled="objData.category == '' || type_cate.length == 0"
              >
                <vs-select-item value="0" text="Không danh mục" />
                <vs-select-item
                  :value="item.slug"
                  :text="JSON.parse(item.name)[0].content"
                  v-for="(item, index) in type_cate"
                  :key="'f' + index"
                />
              </vs-select>
            </div> -->
            <div class="form-group">
              <label>Hiển thị bài viết nổi bật</label>
              <vs-select
                  class="selectExample"
                  v-model="objData.home_status"
                  placeholder="Không"
                >
                <vs-select-item
                    value="0"
                    text="Không"
                  />
                  <vs-select-item
                    value="1"
                    text="Có"
                  />
                </vs-select>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row fixxed">
      <div class="col-12">
        <div class="saveButton">
          <vs-button color="primary" @click="addBlogs">Thêm mới</vs-button>
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
  name: "product",
  data() {
    return {
      errors: [],
      cate: [],
      cate_pro:[],
      type_cate: [],
      lang: [],
      showLang: {
        title: false,
        content: false,
        description: false,
      },
      objData: {
        title: [
          {
            lang_code: "vi",
            content: "",
          },
        ],
        content: [
          {
            lang_code: "vi",
            content: "",
          },
        ],
        description: [
          {
            lang_code: "vi",
            content: "",
          },
        ],
        cate_product:0,
        status: 1,
        image: "",
        author: "",
        category: "",
        type_news: "",
        home_status: "",
        type_cate: "",
      },
    };
  },
  components: {
    TinyMce,
  },
  computed: {},
  watch: {},
  methods: {
    ...mapActions([
      "addBlog",
      "loadings",
      "listCateBlog",
      "listLanguage",
      "listTypelog",
      "findTypeCateBlog",
      "listCate",
    ]),
    listLang() {
      this.listLanguage()
        .then((response) => {
          this.loadings(false);
          this.lang = response.data;
        })
        .catch((error) => {});
    },
    showSettingLangExist(value, name = "content") {
      if (value == "name") {
        this.showLang.title = !this.showLang.title;
        this.lang.forEach((value, index) => {
          if (
            !this.objData.title[index] &&
            value.code != this.objData.title[0].lang_code
          ) {
            var oj = {};
            oj.lang_code = value.code;
            oj.content = "";
            this.objData.title.push(oj);
          }
        });
      }
      if (value == "content") {
        this.showLang.content = !this.showLang.content;
        this.lang.forEach((value, index) => {
          if (
            !this.objData.content[index] &&
            value.code != this.objData.content[0].lang_code
          ) {
            var oj = {};
            oj.lang_code = value.code;
            oj.content = "";
            this.objData.content.push(oj);
          }
        });
      }
      if (value == "description") {
        this.showLang.description = !this.showLang.description;
        this.lang.forEach((value, index) => {
          if (
            !this.objData.description[index] &&
            value.code != this.objData.description[0].lang_code
          ) {
            var oj = {};
            oj.lang_code = value.code;
            oj.content = "";
            this.objData.description.push(oj);
          }
        });
      }
    },
    addBlogs() {
      this.errors = [];
      if (this.objData.title[0].content == "")
        this.errors.push("Tiêu đề không được để trống");
      if (this.objData.content[0].content == "")
        this.errors.push("Nội dung không được để trống");
      if (this.objData.description[0].content == "")
        this.errors.push("Mô tả không được để trống");
      if (this.objData.images == "") this.errors.push("Vui lòng chọn ảnh");
      // if (this.objData.category == "")
      //   this.errors.push("Chọn danh mục sản phẩm");
      if (this.errors.length > 0) {
        this.errors.forEach((value, key) => {
          this.$error(value);
        });
        return;
      } else {
        this.loadings(true);
        this.addBlog(this.objData)
          .then((response) => {
            this.loadings(false);
            this.$router.push({ name: "listBlogs" });
            this.$success("Thêm tin tức thành công");
          })
          .catch((error) => {
            this.loadings(false);
            this.$error("Thêm tin tức thất bại");
          });
      }
    },
    listCategory() {
      this.loadings(true);
      this.listCateBlog().then((response) => {
        this.loadings(false);
        this.cate = response.data;
      });
    },
    findCategoryType() {
      this.findTypeCateBlog(this.objData.category).then((response) => {
        this.type_cate = response.data;
      });
    },
  },
  mounted() {
    this.listCategory();
    this.listLang();
    this.listCate().then((response) => {
      this.loadings(false);
      this.cate_pro = response.data;
    });
  },
};
</script>