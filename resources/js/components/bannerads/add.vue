<template>
  <div>
    <div class="row">
      <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="form-group">
              <label>Ảnh đại diện</label>
              <image-upload
                v-model="objData.image"
                type="avatar"
                :title="'banner-'"
              ></image-upload>
            </div>
            <div class="form-group">
              <label>Link liên kết</label>
              <vs-input
                type="text"
                size="default"
                placeholder="Tên bài viết"
                class="w-100"
                v-model="objData.name"
              />
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
                <vs-select-item value="2" text="Banner sản phẩm sale" />
                <vs-select-item value="1" text="Banner theo danh mục" />
                <vs-select-item value="0" text="Ẩn" />
              </vs-select>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row fixxed">
      <div class="col-12">
        <div class="saveButton">
          <vs-button color="primary" @click="addBanner">Thêm mới</vs-button>
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
      type_cate: [],
      lang: [],
      showLang: {
        title: false,
        content: false,
        description: false,
      },
      objData: {
        name: "",
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
        status: 1,
        image: ""
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
      "addBannerads",
      "loadings",
      "listLanguage"
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
            !this.objData.name[index] &&
            value.code != this.objData.name[0].lang_code
          ) {
            var oj = {};
            oj.lang_code = value.code;
            oj.content = "";
            this.objData.name.push(oj);
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
    addBanner() {
      this.errors = [];
      if (this.objData.name == "")
        this.errors.push("Liên kết không được để trống");
      if (this.objData.image == "") this.errors.push("Vui lòng chọn ảnh");
      if (this.errors.length > 0) {
        this.errors.forEach((value, key) => {
          this.$error(value);
        });
        return;
      } else {
        this.loadings(true);
        this.addBannerads(this.objData)
          .then((response) => {
            this.loadings(false);
            this.$router.push({ name: "listBannerads" });
            this.$success("Thêm thành công");
          })
          .catch((error) => {
            this.loadings(false);
            this.$error("Thêm thất bại");
          });
      }
    }
  },
  mounted() {
    this.listLang();
  },
};
</script>