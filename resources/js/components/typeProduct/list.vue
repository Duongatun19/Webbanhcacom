<template>
  <!-- partial -->
  <div>
      <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Phân loại sản phẩm</h4>
              <router-link class="nav-link" :to="{name:'add_type_cate'}">
                <vs-button type="gradient" style="float:right;">Thêm mới</vs-button>
              </router-link>
              <vs-input
                icon="search"
                placeholder="Search"
                v-model="keyword"
                @keyup="searchCategory()"
              />
              <vs-table :data="list">
                <template slot="thead">
                  <!-- <vs-th>ID</vs-th>
                  <vs-th>Avatar</vs-th> -->
                  <vs-th>Tên loại</vs-th>
                  <vs-th>Danh mục</vs-th>
                  <vs-th>Trạng thái</vs-th>
                  <vs-th>Hành động</vs-th>
                </template>
                <template slot-scope="{data}">
                  <vs-tr :key="indextr" v-for="(tr, indextr) in data">
                    <!-- <vs-td :data="tr.id">{{tr.id}}</vs-td>
                    <vs-td :data="tr.id">
                      <vs-avatar size="70px" :src="tr.avatar" />
                    </vs-td> -->
                    <vs-td :data="tr.name">{{JSON.parse(tr.name)[0].content}}</vs-td>
                    <vs-td :data="tr.id" v-if="tr.cate != null">
                      {{JSON.parse(tr.cate)[0].content}}
                    </vs-td>
                    <vs-td :data="tr.id" v-if="tr.cate == null">-----</vs-td>
                    <vs-td :data="tr.id">{{tr.status == 1 ? 'Hiện' : 'Ẩn'}}</vs-td>
                    <vs-td :data="tr.id">
                      <router-link :to="{name:'edit_type_cate',params:{id:tr.id}}">
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
      <vs-popup style="width:100%;" title="Thêm mới thương hiệu" :active.sync="popupActivo">
        <ModalAdd @closePopup="closePop($event)" />
      </vs-popup>
  </div>
</template>


<script>
import ModalAdd from "../../components/layouts/modal/typeCate/add";

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
    ModalAdd
  },
  computed: {
     
  },
  methods: {
    ...mapActions(["listTypeCate","destroyTypeCate", "loadings"]),
    closePop(event) {
      this.listTypeCategory();
      this.popupActivo = event;
    },
    listTypeCategory() {
      this.loadings(true);
      this.listTypeCate({ keyword: this.keyword })
      .then(response => {
          this.loadings(false);
          this.list = response.data;
        });
    },
    searchCategory() {
      if (this.timer) {
        clearTimeout(this.timer);
        this.timer = null;
      }
      this.timer = setTimeout(() => {
          this.listTypeCate({ keyword: this.keyword })
          .then(response => {
            this.list = response.data;
          });
      }, 800);
    },
    destroy(){
      this.loadings(true);
      this.destroyTypeCate(this.id_item)
      .then(response => {
        this.listTypeCategory()
        this.loadings(false);
        this.$success('Xóa danh mục thành công');
      });
    },
    confirmDestroy(id){
      this.id_item = id;
      this.$vs.dialog({
        type:'confirm',
        color: 'danger',
        title: `Bạn có chắc chắn`,
        text: 'Xóa danh mục này',
        accept:this.destroy
      })
    }
  },
  mounted() {
    this.listTypeCategory()
  }
};
</script>
<style>
</style>