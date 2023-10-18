<template>
    <el-upload class="avatar-uploader"
               v-loading="loading"
               :class="type"
               :style="'height:' + height"
               :action="'/upload'"
               name="img"
               :http-request="request"
               :before-upload="beforeUpload"
               :on-remove="handleRemove"
               :show-file-list="false"
               :file-list="fileList">
        <img v-if="imageUrl || value" :src="imageUrl || value">
        <i v-else class="el-icon-plus avatar-uploader-icon"
           :style="[{height: height}, {maxHeight: height}, {lineHeight: height}]"></i>
    </el-upload>
</template>
 
<script>
    import config from '../../../config';
    import imageCompression from 'browser-image-compression';

    export default {
        props: {
            value: {
                type: String
            },
            type: {
                type: String,
                default: 'avatar-img'
            },
            height: {
                type: String,
                default: '172px'
            },
            maxWidthHeight: {
                type: Number,
                default: 1000
            },
            title:""
        },
        data() {
            return {
                imageUrl: '',
                loading: false
            }
        },
        computed: {
            fileList() {
                if (!this.value) return;
                return [{name: this.value, url: this.value}]
            }
        },
        methods: {
            handleRemove() {
                this.imageUrl = '';
                this.$emit('input', null)
            },
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
            beforeUpload(file) {
                const isType = file.type === 'image/jpeg' || file.type === 'image/png';
                if (!isType) {
                    this.$message('Image must be JPG or PNG format!', 'error');
                }
                return isType;
            },
            request(req) {
                const options = {
                    maxSizeMB: 3,
                    maxWidthOrHeight: 10000,
                    useWebWorker: false,
                    maxIteration: 10
                }
                console.log(this.title);
                imageCompression(req.file, options)
                    .then(res => {
                        this.loading = true;
                        var xhr, formData;
                        xhr = new XMLHttpRequest();
                        xhr.withCredentials = false;
                        xhr.open('POST', __ENV__.link + 'api/upload-image');
                        xhr.onload = () => {
                            var json;
                            if (xhr.status != 200) {
                                this.$notify.error({
                                    message: 'HTTP Error: ' + xhr.status,
                                    type: 'success'
                                });
                                this.loading = false;
                                return;
                            }
                            json = JSON.parse(xhr.responseText);
                            this.imageUrl = URL.createObjectURL(res);
                            this.loading = false;
                            return this.$emit('input', json.path.replace(__ENV__.link,'/'));
                        };
                        formData = new FormData();
                        formData.append('img', res, req.file.name);
                        formData.append("title_post", this.getslugname(this.title));
                        xhr.send(formData);
                    })
            }
        },
        created() {
            this.imageUrl = this.value;
        }
    }
</script>

<style>
    .avatar-uploader .el-upload {
        border: 1px dashed #d9d9d9;
        border-radius: 6px;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }

    .avatar-img .el-upload {
        width: 100%;
        height: 100%;
    }

    .avatar-uploader .el-upload:hover {
        border-color: #409EFF;
    }

    .avatar-uploader-icon {
        font-size: 28px;
        color: #8c939d;
        text-align: center;
    }

    .avatar {
        width: 200px!important;
        height: 200px!important;
        border-radius: 6px!important;
    }

    .avatar .avatar-uploader-icon {
        width: 200px;
        height: 200px;
        line-height: 200px;
    }

    .avatar-img img {
        height: 100%;
        object-fit: cover;
    }

    .avatar img {
        width: 200px;
        height: 172px;
        display: block;
        object-fit: cover;
    }
</style>
