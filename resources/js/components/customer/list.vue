<template>
  <!-- partial -->
  <div class="main-panel">
      <h3 class="page-title">Quản lý khách hàng</h3>
      <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title" v-if="list.length > 0">Danh sách khách hàng</h4>
              <router-link class="mb-0 font-weight-light" v-if="list.length > 0" :to="{name:'customerAdd'}" style="float:right;">
                <vs-button color="success" type="filled">Thêm khách hàng</vs-button>
              </router-link>
              <div class="row" v-if="list.length == 0">
                <div class="col-md-2"></div>
                <div class="col-md-4">
                  <div class="mb-0 flex-grow">
                    <h5 class="mr-2 mb-2">Khách hàng của bạn</h5>
                    <p class="mb-0 font-weight-light">Khi khách hàng tạo đơn hàng,<br> bạn có thể tìm kiếm thông tin chi tiết của họ và lịch sử <br> thanh toán tại đây.</p>
                    <router-link class="mb-0 font-weight-light" :to="{name:'customerAdd'}">
                      <vs-button color="success" type="filled">Thêm khách hàng</vs-button>
                    </router-link>
                  </div>
                </div>
                <div class="col-md-4">
                  <img width="100%" height="400" src="http://bizweb.dktcdn.net/assets/admin/images/empty-states/customer.svg">
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
                  <vs-th>ID</vs-th>
                  <vs-th>Thông tin</vs-th>
                  <vs-th>Email</vs-th>
                  <vs-th>Điện thoại</vs-th>
                  <vs-th>Đơn hàng</vs-th>
                  <vs-th>Đơn hàng gần nhất</vs-th>
                  <vs-th>Tổng chi tiêu</vs-th>
                  <vs-th>Action</vs-th>
                </template>
                <template slot-scope="{data}">
                  <vs-tr :key="indextr" v-for="(tr, indextr) in data">
                    <vs-td :data="indextr+1">{{indextr+1}}</vs-td>
                    <vs-td :data="tr.name">{{tr.name}}</vs-td>
                    <vs-td :data="tr.email">{{tr.email}}</vs-td>
                    <vs-td :data="tr.phone">{{tr.phone}}</vs-td>
                    <vs-td :data="tr.phone"></vs-td>
                    <vs-td :data="tr.phone"></vs-td>
                    <vs-td :data="tr.phone"></vs-td>
                    <vs-td :data="tr.id">
                      <router-link :to="{name:'customerEdit',params:{id_customer:tr.id}}">
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
    list: [],
    timer:0,
    id_item :''
  }),
  components: {
  },
  computed: {
    
  },
  methods: {
    ...mapActions(["listCustomer","destroyCate", "loadings"]),
    listCustomers() {
      this.loadings(true);
      this.listCustomer({ keyword: this.keyword })
      .then(response => {
          this.loadings(false);
          this.list = response.data;
          console.log(this.list.length);
        });
    },
    searchCategory() {
      if (this.timer) {
        clearTimeout(this.timer);
        this.timer = null;
      }
      this.timer = setTimeout(() => {
          this.listCustomer({ keyword: this.keyword })
          .then(response => {
            this.list = response.data;
          });
      }, 800);
    },
    destroy(){
      this.loadings(true);
      this.destroyCate(this.id_item)
      .then(response => {
        this.listCustomer()
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
    this.listCustomers()
  }
};
</script>
<style>
</style>