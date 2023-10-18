<template>
<div>
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <h4 class="card-title" v-if="objData.id != ''">Sửa thương hiệu sản phẩm</h4>
                    <h4 class="card-title" v-if="objData.id == ''">Thêm thương hiệu sản phẩm</h4>
                </div>
                <div class="col-md-6"></div>
                <div class="col-md-3">
                </div>
            </div>
            <!-- <p class="card-description">Basic form elements</p> -->
            <form class="forms-sample">
                <div class="form-group">
                <label>Tên thương hiệu</label>
                <vs-input
                    class="w-100"
                    v-model="objData.name"
                    font-size="40px"
                />
                </div>
                <div class="form-group">
                    <label>Thuộc các danh mục sản phẩm</label>
                    <vs-select
                    placeholder="Danh mục"
                    multiple
                    class="selectExample w-100"
                    v-model="objData.cate_id"
                    >
                    <vs-select-item :key="index" :value="item.id" :text="JSON.parse(item.name)[0].content" v-for="(item,index) in cate" />
                    </vs-select>
                </div>
                <div class="form-group">
                <label>Ảnh đại diện</label>
                <image-upload
                    v-model="objData.image"
                    type="avatar"
                    :title="'danh-muc'"
                ></image-upload>
                </div>
                <!-- <div class="form-group">
                <label>Nội dung</label>
                <TinyMce v-model="objData.content" />
                </div> -->
                <div class="form-group">
                <label for="exampleInputName1">Trạng thái</label>
                <vs-select v-model="objData.status">
                    <vs-select-item  value="1" text="Hiện" />
                    <vs-select-item  value="0" text="Ẩn" />
                    </vs-select>
                </div>
            </form>
            </div>
        </div>
        </div>
    </div>
    <div class="row fixxed">
        <div class="col-12">
        <div class="saveButton">
            <vs-button color="primary" @click="saveEdit()">Cập nhật</vs-button>
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
data() {
    return {
    showLang:{
        title:false
    },
    objData: {
        id:this.$route.params.id,
        name: "",
        content: "",
        image: "",
        cate_id : [],
        status: 1,
    },
    lang:[],
    img: "",
    errors:[],
    cate: []
    };
},
components: {
    TinyMce,
},
methods: {
    ...mapActions(["editProductBrand","saveProductBrand","listLanguage", "loadings", "listCate"]),
    nameImage(event) {
    this.objData.image = event;
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
    saveEdit() {
    this.errors = [];
    if(this.objData.name == '') this.errors.push('Tên thương hiệu không được để trống');
    if(this.objData.cate_id.length == 0) this.errors.push('Vui lòng chọn danh mục sản phẩm');
    if (this.errors.length > 0) {
        this.errors.forEach((value, key) => {
        this.$error(value)
        })
        return;
    } else {
        this.loadings(true);
        this.saveProductBrand(this.objData)
        .then(response => {
            this.loadings(false);
            this.$router.push({ name: "listProductBrands" });
            if(this.objData.id != '') this.$success("Sửa thương hiệu thành công");
            if(this.objData.id == '') this.$success("Thêm thương hiệu thành công");
        })
        .catch(error => {
            this.loadings(false);
            if(this.objData.id != '')this.$error('Sửa thương hiệu thất bại');
            if(this.objData.id == '')this.$error('Thêm thương hiệu thất bại');
        });
    }
    },
    listLang(){
    this.listLanguage().then(response => {
        this.loadings(false);
        this.lang  = response.data
    }).catch(error => {

    })
    },
    getBrands(){
    this.loadings(true);
    if (this.objData.id != '') {
        this.editProductBrand(this.objData).then(response => {
            this.loadings(false);
            if(response.data == null){
            this.objData ={
                id:this.$route.params.id,
                name: "",
                path: "",
                image: "",
                cate_id: [],
                status: "",
            }
            }else{
            this.objData = response.data;
            this.objData.cate_id = JSON.parse(response.data.cate_id);
            }
        }).catch(error => {
            console.log(12);
        });
    }
    },
    changeLanguage(data){
    this.getBrands();
    }
},
mounted() {
    this.loadings(true);
    if (this.objData.id != '') {
        this.getBrands();
    }
    this.listCate().then((response) => {
        this.loadings(false);
        this.cate = response.data;
    });
    this.listLang();
}
};
</script>

<style>
</style>