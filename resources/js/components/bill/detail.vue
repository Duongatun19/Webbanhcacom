<template>
  <div>
      <h3 class="page-title">Mã đơn hàng: #{{bill.code_bill}}</h3>
      <div class="row">
        <div class="col-md-8 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <label>Chi tiết đơn hàng</label>
              <vs-table stripe :data="bill.bill_detail">
                <template slot="thead">
                  <vs-th>Ảnh sản phẩm</vs-th>
                  <vs-th>Tên sản phẩm</vs-th>
                  <vs-th>Màu sắc</vs-th>
                  <vs-th>Kích thước</vs-th>
                  <vs-th>Giá gốc</vs-th>
                  <vs-th>Giá giảm</vs-th>
                  <vs-th>Số lượng</vs-th>
                </template>
                <template slot-scope="{data}">
                  <vs-tr :key="indextr" v-for="(tr, indextr) in bill.bill_detail">
                    <vs-td ><vs-avatar size="large" :src="tr.images"/></vs-td>
                    <vs-td>{{tr.name}}</vs-td>
                    <vs-td v-if="tr.color != null">{{tr.color}}</vs-td>
                    <vs-td v-if="tr.color == null">----</vs-td>
                    <vs-td v-if="tr.size != null">{{tr.size}}</vs-td>
                    <vs-td v-if="tr.size == null">----</vs-td>
                    <vs-td >{{formatNumber(tr.price)}}</vs-td>
                    <vs-td >{{formatNumber(tr.discount)}}</vs-td>
                    <vs-td >{{tr.qty}}</vs-td>
                  </vs-tr>
                </template>
              </vs-table>
              <div class="row">
                <!-- <div class="col-md-4">
                  <div class="form-group">
                    <label>Ghi chú</label>
                    <vs-textarea v-model="bill.note"  />
                  </div>
                </div> -->
                <div class="col-md-12">
                  <table class="table">
                      <tbody>
                        <tr>
                          <td>Tiền hàng chưa tính phí ship</td>
                          <td>{{formatNumber(bill.total_money)}}đ</td>
                        </tr>
                        <tr v-if="bill.transport_price != '' ">
                          <td>Phí vận chuyển</td>
                          <td>{{formatNumber(bill.transport_price)}}đ</td>
                        </tr>
                        <tr>
                          <td>Tổng cộng</td>
                          <td>{{formatNumber(bill.total_money)}}đ</td>
                        </tr>
                      </tbody>
                    </table>
                </div>
              </div>
              <hr>
              <div class="row" v-if="bill.statu == 0">
                <div class="col-md-6">
                  <div class="form-group">
                    <h4 style="margin: 0">Xác nhận thanh toán</h4>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <vs-button color="success" type="border" @click="changePaymented()" >Xác nhận đơn hàng</vs-button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
        </div>
        <div class="col-md-4 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <!-- <div class="form-group">
                <label>Tài khoản đặt hàng</label>
                <vs-select
                  placeholder="Search and select"
                  class="selectExample"
                  label-placeholder="Autocomplete"
                  v-model="bill.code_customer"
                  >
                  <vs-select-item key="0" value="0" text="Khách hàng chưa có tài khoản" />
                  <vs-select-item :key="index" :value="item.id" :text="item.name" v-for="item,index in customer" />
                </vs-select>
              </div> -->
              <div class="form-group">
                <label>Trạng thái đơn hàng</label> <br>
                <vs-chip color="primary" v-if="bill.statu == 1">
                  Đã thanh toán
                </vs-chip>
                <vs-chip color="danger" v-if="bill.statu == 4">
                  Đã hủy
                </vs-chip>
                <vs-chip color="success" v-if="bill.statu == 0">
                  Đợi kiểm tra
                </vs-chip>
                <vs-chip color="success" v-if="bill.statu == 3">
                  Hoàn tất
                </vs-chip>
              </div>
              <div class="form-group ">
                <table class="table">
                    <tbody>
                      <tr>
                        <td>Tên khách hàng</td>
                        <td>{{bill.cus_name}}</td>
                      </tr>
                      <tr>
                        <td>Số điện thoại </td>
                        <td>{{bill.cus_phone}}</td>
                      </tr>
                      <tr>
                        <td>Email </td>
                        <td>{{bill.cus_email}}</td>
                      </tr>
                      <tr>
                        <td>Địa chỉ </td>
                        <td>{{bill.cus_address}}</td>
                      </tr>
                      <tr>
                        <td>Ghi chú </td>
                        <td>{{bill.note}}</td>
                      </tr>
                    </tbody>
                  </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    <!-- content-wrapper ends -->
  </div>
</template>


<script>
import { mapActions } from "vuex";
import { required } from "vuelidate/lib/validators";
import Multiselect from 'vue-multiselect'
import Payments from '../layouts/modal/bill/payments.vue'
export default {
  name: "billsDetail",
  data() {
    return {
      popupActivo:false,
      customer:[],
      submitted: false,
      products:[],
      qty:"",
      bill:{
          code_bill:this.$route.params.code_bill,
          code_customer:'',
          total_money:0,
          statu:0,
          note:"",
          promotion:'',
          transport:'',
          transport_price:0,
          bill_detail:[]
        }
    };
  },
  validations: {
    
  },
  components: {
    Multiselect,Payments
  },
  computed: {
    total_product(){
      if(this.bill.bill_detail.length == 0){
        return 0;
      }else{
        var total = 0;
        let vm = this;

        for ( let i=0; i<vm.bill.bill_detail.length ; i++ ) {
            total += (vm.bill.bill_detail[i]['price']-(vm.bill.bill_detail[i]['price']*(vm.bill.bill_detail[i]['discount']/100))) * vm.bill.bill_detail[i]['qty']
        }
        return total
      }
    },
    total_bill (){
      return this.total_product + this.bill.transport_price;
    }
  },
  watch: {},
  methods: {
    ...mapActions(["loadings","listProduct","listCustomer","addBill","detailBill","changeStatus"]),
    closePop(event) {
      this.popupActivo = event;
    },
    changeUnPayment(){
      this.loadings(true);
      this.changeStatus({'status':2,'code_bill':this.$route.params.code_bill}).then(response => {
        this.loadings(false);
        this.detailBills();
        this.$success('Đổi trạng thái đơn hàng thành công');
        this.$router.push({ name: "billDraft" });
      })
    },
    changePaymented(){
      this.loadings(true);
      this.changeStatus({'status':1,'code_bill':this.$route.params.code_bill}).then(response => {
        this.loadings(false);
        this.detailBills();
        this.$success('Đổi trạng thái thành công');
        this.$router.push({ name: "billDraft" });
      })
    },
    detailBills(){
      this.detailBill(this.bill.code_bill).then(response => {
        this.bill = response.data;
        
      })
    },
    payments(event){
      if(event.payments == 2){
        this.bill.transport_price = event.price;
        this.bill.transport = event.name;
      }else if(event.payments == 40000){
        this.bill.transport_price = 40000;
        this.bill.transport = "Giao hàng tận nơi";
      }else{
        this.bill.transport_price = 0;
        this.bill.transport = "Miễn phí vận chuyển";
      }
    },
    customLabel ({ name }) {
      return `${name}`
    },
    formatNumber(num) {
      return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    },
    addBills(){
      this.loadings(true);
      this.addBill(this.bill).then(response => {
        this.loadings(false);
        this.$success('Thêm đơn hàng thành công');
        this.$router.push({ name: "billDraft" });
      }).catch(error => {
        this.loadings(false);
        this.$error('Thêm đơn hàng thất bại');
      })
    },
    listProducts(){
      this.loadings(true);
      this.listProduct()
      .then(response => {
          this.loadings(false);
          this.products = response.data;
      }).catch(err => {
          this.loadings(false);
          this.products = err.data;
      });
    },
    listCustomers() {
      this.loadings(true);
      this.listCustomer()
      .then(response => {
          this.loadings(false);
          this.customer = response.data;
        });
    },
    saveBill(){
      this.bill.total_money = this.total_bill;
      console.log(this.bill);
    }
  },
  mounted() {
      this.listProducts();
      this.listCustomers();
      this.detailBills();
  }
};
</script>
<style scoped>
.el-select-dropdown__item{
    height: auto!important;
}
</style>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>