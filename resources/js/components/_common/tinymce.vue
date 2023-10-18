<template>
  <div>
    <editor :init="{...init}" v-model="content"></editor>
  </div>
</template>

<script>
import config from '../../../config'
// Import TinyMCE
import tinymce from "tinymce/tinymce";
// A theme is also required
import "tinymce/themes/silver";
// Any plugins you want to use has to be imported
import "tinymce/plugins/advlist";
import "tinymce/plugins/wordcount";
import "tinymce/plugins/autolink";
import "tinymce/plugins/autosave";
import "tinymce/plugins/charmap";
import "tinymce/plugins/codesample";
import "tinymce/plugins/contextmenu";
import "tinymce/plugins/emoticons";
import "tinymce/plugins/fullscreen";
import "tinymce/plugins/hr";
import "tinymce/plugins/imagetools";
import "tinymce/plugins/insertdatetime";
import "tinymce/plugins/link";
import "tinymce/plugins/media";
import "tinymce/plugins/noneditable";
import "tinymce/plugins/paste";
import "tinymce/plugins/print";
import "tinymce/plugins/searchreplace";
import "tinymce/plugins/tabfocus";
import "tinymce/plugins/template";
import "tinymce/plugins/textpattern";
import "tinymce/plugins/visualblocks";
import "tinymce/plugins/anchor";
import "tinymce/plugins/autoresize";
import "tinymce/plugins/bbcode";
import "tinymce/plugins/code";
import "tinymce/plugins/colorpicker";
import "tinymce/plugins/directionality";
import "tinymce/plugins/fullpage";
import "tinymce/plugins/help";
import "tinymce/plugins/image";
import "tinymce/plugins/importcss";
import "tinymce/plugins/legacyoutput";
import "tinymce/plugins/lists";
import "tinymce/plugins/nonbreaking";
import "tinymce/plugins/pagebreak";
import "tinymce/plugins/preview";
import "tinymce/plugins/save";
import "tinymce/plugins/spellchecker";
import "tinymce/plugins/table";
import "tinymce/plugins/textcolor";
import "tinymce/plugins/toc";
import "tinymce/plugins/visualchars";

import "tinymce/skins/ui/oxide/skin.min.css";
import Editor from "@tinymce/tinymce-vue";
export default {
  name: "tinymce",
  components: {
    editor: Editor
  },
  props: {
        value: {
            type: String,
            default: ''
        },
  },
  data() {
    return {
      editor: null,
      cTinyMce: null,
      checkerTimeout: null,
      isTyping: false,
      init: {
        paste_data_images: true,
        plugins: [
          "advlist autolink lists link image charmap print preview hr anchor pagebreak",
          "searchreplace wordcount visualblocks visualchars code fullscreen",
          "insertdatetime media nonbreaking save table contextmenu directionality",
          "emoticons template paste textcolor colorpicker textpattern",
          "toc"
        ],
        toolbar1:
          "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | toc",
        toolbar2: "print preview media | forecolor backcolor emoticons",
        image_advtab: true,
        height:500,
        images_upload_handler: this.images_upload_handler
      }
    };
  },
  mounted() {
      
  },
  computed:{
      content:{
        get() {
            return this.value;
        },
        set(content) {
            this.$emit('input', content);
        }
      }
  },
  beforeDestroy() {},
  watch: {},
  methods: {
    images_upload_handler: function(blobInfo, success, failure) {
      var xhr, formData;
      xhr = new XMLHttpRequest();
      xhr.withCredentials = false;
      xhr.open("POST", __ENV__.link + 'api/upload-image');
      xhr.onload = function() {
        var json;

        if (xhr.status != 200) {
          failure("HTTP Error: " + xhr.status);
          return;
        }
        
        json = JSON.parse(xhr.responseText);
        success(json.path);
      };
      formData = new FormData();
      formData.append("img", blobInfo.blob(), blobInfo.filename());
      xhr.send(formData);
    }
  }
};
</script>

<style>
</style>