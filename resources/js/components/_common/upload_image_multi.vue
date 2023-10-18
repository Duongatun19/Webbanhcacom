<template>
  <div>
    <!-- 多图片上传 -->
    <el-upload
      v-if="multiple"
      action="'/upload'"
      name="img"
      list-type="picture-card"
      :on-preview="handlePreview"
      :auto-upload="true"
      :on-remove="handleRemove"
      :http-request="request"
      :file-list="uploadList"
    >
      <i class="el-icon-plus"></i>
    </el-upload>

    <el-dialog :visible.sync="dialogVisible">
      <img width="100%" :src="dialogImageUrl" alt />
    </el-dialog>
  </div>
</template>
<script>
import axios from "axios";
import config from "../../../config";
import imageCompression from "browser-image-compression";
export default {
  name: "uploader",
  props: {
    targetUrl: {
      // 上传地址
      type: String,
      default: "api/upload-image"
    },
    multiple: {
      // 多图开关
      type: Boolean,
      default: true
    },
    value: {
      // 初始图片链接
      default: ""
    },
    title:""
  },
  data() {
    return {
      file: "",
      dialogImageUrl: "",
      uploadList: [],
      reupload: true,
      dialogVisible: false,
      title_post:this.title,
    };
  },
  watch: {
    value: function(val) {
      if (val) {
        if (typeof this.value.length === 0) {
          this.uploadList = Array;
        } else {
          this.uploadList = this.formatImgArr(val);
        }
      }
    }
  },
  mounted() {
    
    if (typeof this.value.length === 0) {
      this.uploadList = Array;
    } else {
      this.uploadList = this.formatImgArr(this.value);
    }
  },
  methods: {
    getslugname(text){
      var slug = "";
      // Change to lower case
      var titleLower = text.toLowerCase();
      // Letter "e"
      slug = titleLower.replace(/e|é|è|ẽ|ẻ|ẹ|ê|ế|ề|ễ|ể|ệ/gi, 'e');
      // Letter "a"
      slug = slug.replace(/a|á|à|ã|ả|ạ|ă|ắ|ằ|ẵ|ẳ|ặ|â|ấ|ầ|ẫ|ẩ|ậ/gi, 'a');
      // Letter "o"
      slug = slug.replace(/o|ó|ò|õ|ỏ|ọ|ô|ố|ồ|ỗ|ổ|ộ|ơ|ớ|ờ|ỡ|ở|ợ/gi, 'o');
      // Letter "u"
      slug = slug.replace(/u|ú|ù|ũ|ủ|ụ|ư|ứ|ừ|ữ|ử|ự/gi, 'u');
      // Letter "d"
      slug = slug.replace(/đ/gi, 'd');
      // Trim the last whitespace
      slug = slug.replace(/\s*$/g, '');
      // Change whitespace to "-"
      slug = slug.replace(/\s+/g, '-');
      return slug;
    },
    handlePreview(file) {
      this.dialogImageUrl = file.url;
      this.dialogVisible = true;
    },
    handleRemove(file, fileList) {
      this.uploadList = fileList;
      this.$emit("input", this.formatImgArr(this.uploadList));
    },
    request(req) {
      const options = {
        maxSizeMB: 3,
        maxWidthOrHeight: 10000,
        useWebWorker: true,
        maxIteration: 10
      };
      imageCompression(req.file, options).then(res => {
        this.loading = true;
        var xhr, formData;
        xhr = new XMLHttpRequest();
        xhr.withCredentials = false;
        xhr.open("POST", __ENV__.link + "api/upload-image");
        xhr.onload = () => {
          var json;
          if (xhr.status != 200) {
            this.$notify.error({
              message: "HTTP Error: " + xhr.status,
              type: "success"
            });
            this.loading = false;
            return;
          }

          if (this.multiple) {
            json = JSON.parse(xhr.responseText);
            this.uploadList.push({
              url: json.path.replace(__ENV__.link,'/'),
              uid: "111"
            });
            this.$emit("input", this.formatImgArr(this.uploadList));
          } else {
            this.$emit("input", currentPic);
          }
        };
        formData = new FormData();
        formData.append("img", res, req.file.name);
        formData.append("title_post", this.getslugname(this.title));
        xhr.send(formData);
      });
    },
    formatImgArr(arr) {
      const result = arr.map((item, index) => {
        if (typeof item === "string") {
          return {
            url: item,
            uid: `index${index}`
          };
        } else {
          return item.url;
        }
      });
      return result;
    },
    beforeClose(done) {
      this.uploadList.pop();
    }
  },
  components: {}
};
</script>
<style>
.avatar-uploader .el-upload {
  border: 1px dashed #d9d9d9;
  border-radius: 6px;
  cursor: pointer;
  position: relative;
  overflow: hidden;
}
.avatar-uploader .el-upload:hover {
  border-color: #409eff;
}
.avatar-uploader-icon {
  color: #8c939d;
  text-align: center;
}
.avatar {
  display: block;
}
.reupload {
  border-radius: 50%;
  position: absolute;
  color: #fff;
  background-color: #000000;
  opacity: 0.6;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  display: none;
}
#uploadIcon {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  display: none;
}
</style>