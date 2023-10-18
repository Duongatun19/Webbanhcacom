<template>
  <!-- partial -->
  <div>
      <h3 class="page-title">Đơn hàng chưa thanh toán</h3>
      <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <!-- <h4 class="card-title" @click="listCate">Danh sách danh mục</h4>
              <p class="card-description">Thêm mới hoặc sửa chửa danh mục sản phẩm</p> -->
              <vs-button type="gradient" style="float:right;" @click="popupActivo=true" v-if="list.length > 0">Thêm mới</vs-button>
              <div class="row" v-if="list.length == 0">
                <div class="col-md-2"></div>
                <div class="col-md-4">
                  <div class="mb-0 flex-grow">
                    <h5 class="mr-2 mb-2">Quản lý đơn hàng chưa hoàn tất của bạn</h5>
                    <p class="mb-0 font-weight-light">Đơn hàng chưa hoàn tất là đơn hàng mà<br> khách hàng thêm sản phẩm vào giở hàng <br> và chưa hoàn tất thanh toán.</p>
                    <router-link class="mb-0 font-weight-light" :to="{name:'billAdd'}">
                      <vs-button color="success" type="filled">Tạo đơn hàng</vs-button>
                    </router-link>
                  </div>
                </div>
                <div class="col-md-4">
                  <img width="100%" height="400" src="https://bizweb.dktcdn.net/assets/admin/images/empty-states/abandon_checkout.svg">
                </div>
                <div class="col-md-2"></div>
              </div>
              <vs-input
                icon="search"
                placeholder="Search"
                v-model="keyword"
                v-if="list.length > 0"
                @keyup="searchCategory()"
              />
              <vs-table max-items="5" pagination :data="list" v-if="list.length > 0">
                <template slot="thead">
                  <vs-th>Đơn hàng nháp</vs-th>
                  <vs-th>Chỉnh sửa lúc</vs-th>
                  <vs-th>Khach hàng</vs-th>
                  <vs-th>Trạng thái</vs-th>
                  <vs-th>Hành động</vs-th>
                </template>
                <template slot-scope="{data}">
                  <vs-tr :key="indextr" v-for="(tr, indextr) in data">
                    <vs-td :data="tr.id">#{{tr.code_bill}}</vs-td>
                    <vs-td :data="tr.updated_at">{{formatDate(tr.updated_at)}}</vs-td>
                    <vs-td :data="tr.cus_name">
                      {{tr.cus_name}}
                    </vs-td>
                    <vs-td :data="tr.id">
                        <vs-chip color="danger" v-if="tr.statu == 2">
                          Chưa thanh toán
                        </vs-chip>
                    </vs-td>
                    <vs-td :data="tr.id">
                      <router-link :to="{name:'billDetail',params:{code_bill:tr.code_bill}}">
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
import ModalAdd from "../../components/layouts/modal/category/add";

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
    ...mapActions(["draftBill","destroyCate", "loadings"]),
    closePop(event) {
      this.listCategory();
      this.popupActivo = event;
    },
    formatDate(value) {
        const date = new Date(value),
          month = date.getMonth() > 9 ? date.getMonth() : `0${date.getMonth()}`,
          day = date.getDate() > 9 ? date.getDate() : `0${date.getDate()}`;
        return `${date.getFullYear()}-${month}-${day}`;
    },
    draftBills() {
      this.loadings(true);
      this.draftBill({ keyword: this.keyword,status:2 })
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
          this.draftBill({ keyword: this.keyword,status:2 })
          .then(response => {
            this.list = response.data;
          });
      }, 800);
    },
    // destroy(){
    //   this.loadings(true);
    //   this.destroyCate(this.id_item)
    //   .then(response => {
    //     this.listCategory()
    //     this.loadings(false);
    //     this.$vs.notify({
    //           title: "Xóa danh mục",
    //           text: "Thành công",
    //           color: "success",
    //           position: "top-right"
    //         });
    //   });
    // },
    // confirmDestroy(id){
    //   this.id_item = id;
    //   this.$vs.dialog({
    //     type:'confirm',
    //     color: 'danger',
    //     title: `Bạn có chắc chắn`,
    //     text: 'Xóa danh mục này',
    //     accept:this.destroy
    //   })
    // }
  },
  mounted() {
    this.draftBills()
  }
};
</script>
<style>
</style>