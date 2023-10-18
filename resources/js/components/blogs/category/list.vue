<template>
  <!-- partial -->
  <div>
      <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Danh sách danh mục</h4>
              <p class="card-description">Thêm mới hoặc sửa chửa danh mục tin tức</p>
              <vs-button type="gradient" style="float:right;" @click="popupActivo=true">Thêm mới</vs-button>
              <vs-input
                icon="search"
                placeholder="Search"
                v-model="keyword"
                @keyup="searchCategory()"
              />
              <vs-table max-items="5" pagination :data="list">
                <template slot="thead">
                  <vs-th>ID</vs-th>
                  <vs-th>Tên</vs-th>
                  <vs-th>Avatar</vs-th>
                  <vs-th>Link</vs-th>
                  <vs-th>Hành động</vs-th>
                </template>
                <template slot-scope="{data}">
                  <vs-tr :key="indextr" v-for="(tr, indextr) in data">
                    <vs-td :data="tr.quiz_id">{{tr.quiz_id}}</vs-td>
                    <vs-td :data="tr.name">{{JSON.parse(tr.name)[0].content}}</vs-td>
                    <vs-td :data="tr.id">
                      <vs-avatar size="70px" :src="tr.avatar" />
                    </vs-td>
                    <vs-td :data="tr.id">{{tr.path}}</vs-td>
                    <vs-td :data="tr.id">
                      <router-link :to="{name:'editCateBlog',params:{id:tr.id}}">
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
      <vs-popup style="width:100%;" title="Thêm mới danh mục" :active.sync="popupActivo">
        <ModalAdd @closePopup="closePop($event)" />
      </vs-popup>
  </div>
</template>


<script>
import ModalAdd from "../../layouts/modal/blog/addCategory";

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
    ...mapActions(["listCateBlog","destroyCateBLog", "loadings"]),
    closePop(event) {
      this.listCategory();
      this.popupActivo = event;
    },
    listCategory() {
      this.loadings(true);
      this.listCateBlog({ keyword: this.keyword })
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
          this.listCateBlog({ keyword: this.keyword })
          .then(response => {
              this.loadings(false);
              this.list = response.data;
            });
      }, 800);
    },
    destroy(){
      this.loadings(true);
      this.destroyCateBLog({id:this.id_item})
      .then(response => {
        this.listCategory();
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
    this.listCategory()
  }
};
</script>
<style>
</style>