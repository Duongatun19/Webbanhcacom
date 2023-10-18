<template>
<!-- partial -->
<div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            <h4 class="card-title">Danh sách thương hiệu</h4>
            <p class="card-description">Thêm mới hoặc sửa chữa thương hiệu sản phẩm</p>
            <router-link class="nav-link" :to="{name:'createEditProductBrands',params:{id:''}}">
                <vs-button type="gradient" style="float:right;">Thêm mới</vs-button>
            </router-link>
            <vs-input
                icon="search"
                placeholder="Search"
                v-model="keyword"
                @keyup="searchBrands()"
            />
            <vs-table max-items="7" pagination :data="list">
                <template slot="thead">
                <vs-th>Avatar</vs-th>
                <vs-th>Tên thương hiệu</vs-th>
                <vs-th>Hành động</vs-th>
                </template>
                <template slot-scope="{data}">
                <vs-tr :key="indextr" v-for="(tr, indextr) in data">
                    <vs-td :data="tr.id">
                    <vs-avatar size="70px" :src="tr.image" />
                    </vs-td>
                    <vs-td :data="tr.name">{{tr.name}}</vs-td>
                    <vs-td :data="tr.id">
                    <router-link :to="{name:'createEditProductBrands',params:{id:tr.id}}">
                        <vs-button
                        vs-type="gradient"
                        size="lagre"
                        color="success" 
                        icon="edit"
                        ></vs-button>
                    </router-link>
                    <vs-button vs-type="gradient" size="lagre" color="red" icon="delete_forever" @click="confirmDestroy(tr.id)"></vs-button>
                    </vs-td>
                </vs-tr>
                </template>
            </vs-table>
            </div>
        </div>
        </div>
    </div>
</div>
</template>


<script>

import { mapActions } from "vuex";
export default {
data: () => ({
    keyword: null,
    popupActivo: false,
    list: [],
    timer:0,
    id_item :''
}),
components: {
},
computed: {
    
},
methods: {
    ...mapActions(["listProductBrand","deleteProductBrand", "loadings"]),
    closePop(event) {
    this.listBrand();
    this.popupActivo = event;
    },
    listBrands() {
    this.loadings(true);
    this.listProductBrand({ keyword: this.keyword })
    .then(response => {
        this.loadings(false);
        this.list = response.data;
        });
    },
    searchBrands() {
    if (this.timer) {
        clearTimeout(this.timer);
        this.timer = null;
    }
    this.timer = setTimeout(() => {
        this.listProductBrand({ keyword: this.keyword })
        .then(response => {
            this.list = response.data;
        });
    }, 800);
    },
    destroy(){
    this.loadings(true);
    this.deleteProductBrand({id:this.id_item})
    .then(response => {
        this.listBrands()
        this.loadings(false);
        this.$success('Xóa thương hiệu thành công');
    });
    },
    confirmDestroy(id){
    this.id_item = id;
    this.$vs.dialog({
        type:'confirm',
        color: 'danger',
        title: `Bạn có chắc chắn`,
        text: 'Xóa thương hiệu này',
        accept:this.destroy
    })
    }
},
mounted() {
    this.listBrands()
}
};
</script>
<style>
</style>