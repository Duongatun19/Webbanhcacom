<template>
  <!-- partial -->
  <div>
      <h3 class="page-title">Trang nội dung</h3>
      <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Danh sách trang nội dung</h4>
              <p class="card-description">Thêm mới hoặc sửa chửa trang nội dung</p>
              <router-link class="nav-link" :to="{name:'pageContentAdd'}">
               <vs-button type="gradient" style="float:right;" >Thêm mới</vs-button>
              </router-link>
              
              <vs-input
                icon="search"
                placeholder="Search"
                v-model="keyword"
                @keyup="searchPageContent()"
              />
              <vs-table max-items="5" pagination :data="list">
                <template slot="thead">
                  <vs-th>ID</vs-th>
                  <vs-th>Tên</vs-th>
                  <vs-th>Danh mục</vs-th>
                  <vs-th>Hành động</vs-th>
                </template>
                <template slot-scope="{data}">
                  <vs-tr :key="indextr" v-for="(tr, indextr) in data">
                    <vs-td :data="tr.quiz_id">{{tr.quiz_id}}</vs-td>
                    <vs-td :data="tr.name">{{tr.title}}</vs-td>
                    <vs-td :data="tr.type" v-if="tr.type == 'ho-tro-khach-hang'">Hỗ trợ khách hàng</vs-td>  
                    <vs-td :data="tr.type" v-if="tr.type == 've-chung-toi'">Về chúng tôi</vs-td>    
                    <vs-td :data="tr.id">
                      <router-link :to="{name:'pageContentEdit',params:{quiz_id:tr.quiz_id,language:tr.language}}">
                        <vs-button
                          vs-type="gradient"
                          size="lagre"
                          color="success"
                          icon="edit"
                        ></vs-button>
                      </router-link>
                      <vs-button vs-type="gradient" size="lagre" color="red" icon="delete_forever" @click="confirmDestroy(tr.quiz_id)"></vs-button>
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
  computed: {
    
  },
  methods: {
    ...mapActions(["listPageContent","deletePageContent", "loadings"]),
    closePop(event) {
      this.listCategory();
      this.popupActivo = event;
    },
    listPageContents() {
      this.loadings(true);
      this.listPageContent({ keyword: this.keyword })
      .then(response => {
          this.loadings(false);
          this.list = response.data;
        });
    },
    searchPageContent() {
      if (this.timer) {
        clearTimeout(this.timer);
        this.timer = null;
      } 
      this.timer = setTimeout(() => {
          this.listPageContent({ keyword: this.keyword })
          .then(response => {
              this.loadings(false);
              this.list = response.data;
            });
      }, 800);
    },
    destroy(){
      this.loadings(true);
      this.deletePageContent(this.id_item)
      .then(response => {
        this.listPageContents();
        this.loadings(false);
        this.$success('Xóa bài viết thành công');
      });
    },
    confirmDestroy(id){
      this.id_item = id;
      this.$vs.dialog({
        type:'confirm',
        color: 'danger',
        title: `Bạn có chắc chắn`,
        text: 'Xóa bài viết này',
        accept:this.destroy
      })
    }
  },
  mounted() {
    this.listPageContents()
  }
};
</script>
<style>
</style>