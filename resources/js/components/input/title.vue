<template>
  <div class="form-group">
    <label>Tên sản phẩm</label>
    <vs-input
      type="text"
      size="default"
      placeholder="Tên sản phẩm"
      class="w-100"
      v-model="model[0].content"
    />
    <el-button size="small" @click="showSettingLang('title')">Đa ngôn ngữ</el-button>
    <div class="dropLanguage" v-if="showLang.title == true">
      <div class="form-group" v-for="item,index in lang" :key="index">
        <label>{{item.name}}</label>
        <input
          type="text"
          size="default"
          placeholder="Tên sản phẩm"
          class="w-100 inputlang"
          :value="model[index]  ? model[index].content : ''"
          @input="setValueLanguage(item,$event.target.value,model)"
        />
      </div>
    </div>
  </div>
</template>
<script>
import { mapActions } from "vuex";
import TinyMce from "../_common/tinymce";
import InputTag from "vue-input-tag";
export default {
  name: "title",
  props:['name','model'],
  data() {
    return {
      showLang: {
        title: false
      },
      arrTitle: [
        {
          lang_code: "vi",
          content: "1"
        }
      ],
      lang: []
    };
  },
  components: {},
  computed: {},
  watch: {},
  methods: {
    ...mapActions(["listLanguage"]),
    showSettingLang(value) {
      if (value == "title") {
        this.showLang.title = !this.showLang.title;
      }
    },
    setValueLanguage(val, input, array) {
      var arr = this.$helpers.getValueInputLang(val, input, array);
      this.array = arr;
    },
    listLang() {
      this.listLanguage()
        .then(response => {
          this.loadings(false);
          this.lang = response.data;
          console.log(this.lang);
        })
        .catch(error => {});
    }
  },
  mounted() {
    this.listLang();
    console.log(this.name)
  }
};
</script>