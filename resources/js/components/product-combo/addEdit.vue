<template>
<div>
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <h4 class="card-title" v-if="objData.id != ''">Sửa combo sản phẩm</h4>
                    <h4 class="card-title" v-if="objData.id == ''">Thêm combo sản phẩm</h4>
                </div>
                <div class="col-md-6"></div>
                <div class="col-md-3">
                </div>
            </div>
            <!-- <p class="card-description">Basic form elements</p> -->
            <form class="forms-sample">
                <div class="form-group">
                <label>Tên combo</label>
                <vs-input
                    class="w-100"
                    v-model="objData.name"
                    font-size="40px"
                />
                </div>
                <div class="form-group">
                <label>Ảnh đại diện</label>
                <image-upload
                    v-model="objData.image"
                    type="avatar"
                    :title="'danh-muc'"
                ></image-upload>
                </div>
                <div class="form-group">
                <label>Nội dung</label>
                <TinyMce v-model="objData.content" />
                </div>
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
    <div class="row" v-if="objData.products.length > 0">
        <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4>Các thuộc combo này</h4>
            <vs-table stripe :data="objData.products" max-items="10" pagination>
            <template slot="thead">
                <vs-th>Ảnh sản phẩm</vs-th>
                <vs-th>Tên sản phẩm</vs-th>
                <vs-th>Danh mục</vs-th>
                <vs-th>Thương hiệu</vs-th>
                <vs-th>Xóa khỏi combo</vs-th>
            </template>
            <template slot-scope="{data}">
                <vs-tr :key="indextr" v-for="(tr, indextr) in data">
                <vs-td ><vs-avatar size="large" :src="JSON.parse(tr.images)[0]"/></vs-td>
                <vs-td :data="tr.name">{{JSON.parse(tr.name)[0].content}}</vs-td>
                <vs-td :data="tr.name" v-if="tr.cate != null">{{JSON.parse(tr.cate.name)[0].content}}</vs-td>
                <vs-td :data="tr.name" v-if="tr.cate == null">-----</vs-td>
                <vs-td :data="tr.name" v-if="tr.brand != null">{{tr.brand.name}}</vs-td>
                <vs-td :data="tr.name" v-if="tr.brand == null">-----</vs-td>
                <vs-td >
                    <vs-button vs-type="gradient" size="lagre" color="red" icon="delete_forever" @click="confirmDestroy(tr.id)"></vs-button>
                </vs-td>
                </vs-tr>
            </template>
            </vs-table>
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
        status: 1,
        products : []
    },
    objDel: {
        id_item: ""
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
    ...mapActions(["editProductCombo","saveProductCombo","listLanguage", "loadings", "listCate", "changeComboId"]),
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
    if(this.objData.name == '') this.errors.push('Tên combo không được để trống');
    if (this.errors.length > 0) {
        this.errors.forEach((value, key) => {
        this.$error(value)
        })
        return;
    } else {
        this.loadings(true);
        this.saveProductCombo(this.objData)
        .then(response => {
            this.loadings(false);
            this.$router.push({ name: "listProductCombo" });
            if(this.objData.id != '')this.$success("Sửa combo thành công");
            if(this.objData.id == '')this.$success("Thêm combo thành công");
        })
        .catch(error => {
            this.loadings(false);
            if(this.objData.id != "" )this.$error('Sửa combo thất bại');
            if(this.objData.id == "" )this.$error('Thêm combo thất bại');
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
    getCombo(){
    this.loadings(true);
    if (this.objData.id != '') {
        this.editProductCombo(this.objData).then(response => {
            this.loadings(false);
            if(response.data == null){
            this.objData ={
                id:this.$route.params.id,
                name: "",
                path: "",
                image: "",
                status: "",
            }
            }else{
            this.objData = response.data;
            this.objData.products = JSON.pare(response.data.products);
            }
        }).catch(error => {
            console.log(12);
        });
    }
    },
    destroy(){
    this.changeComboId({id: this.objDel.id_item}).then(response => {
        this.getCombo();
        this.$success('Xóa thành công');
    });
    },
    confirmDestroy(id,slug){
    this.objDel.id_item = id;
    this.$vs.dialog({
        type:'confirm',
        color: 'danger',
        title: `Bạn có chắc chắn`,
        text: 'Xóa sản phẩm này khỏi combo',
        accept:this.destroy
    })
    },
    changeLanguage(data){
    this.getCombo();
    }
},
mounted() {
    this.loadings(true);
    if (this.objData.id != '') {
        this.getCombo();
    }
    this.listLang();
}
};
</script>

<style>
</style>