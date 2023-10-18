<template>
  <div>
        <h3 class="page-title">Thêm mới đơn hàng</h3>
      <div class="row">
        <div class="col-md-8 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <label>Chi tiết đơn hàng</label>
              <div class="row" v-for="(i, key) in bill.bill_detail" v-if="bill.bill_detail.length > 0">
                <div class="col-md-1">
                  <el-avatar shape="square" :size="50" :src="JSON.parse(i.images)[0]"></el-avatar>
                </div>
                <div class="col-md-5">
                  <label>{{i.name}}</label>
                </div>
                <div class="col-md-3">
                  <el-input-number v-model="i.qty" size="mini" controls-position="right" :min="1" :max="10"></el-input-number>
                </div>
                
                <div class="col-md-1"><label style="margin-top: 5%">x{{formatNumber(i.price)}}đ</label></div>
                <div class="col-md-2">
                  <label style="margin-top: 4%">{{formatNumber(i.price*i.qty)}}đ</label>
                </div>
                <hr style="border: 0.5px solid #f2edf3; width: 100%;">
              </div>
              <div class="form-group">
                <multiselect v-model="bill.bill_detail" placeholder="Tim kiem san pham" label="name" track-by="name" :multiple="true" :options="products" :option-height="104" :custom-label="customLabel" :show-labels="false">
                  <template slot="singleLabel" slot-scope="props">
                    <div class="row">
                      <div class="col-md-1"><img class="option__image" width="30" :src="JSON.parse(props.option.images)[0]" alt="No Man’s Sky"></div>
                      <div class="col-md-11">
                        <span class="option__desc">
                      <span class="option__title">{{ props.option.name }}</span>
                    </span>
                      </div>
                    </div>
                  </template>
                  <template slot="option" slot-scope="props">
                     <div class="row">
                      <div class="col-md-1"><img class="option__image" width="30" :src="JSON.parse(props.option.images)[0]" alt="No Man’s Sky"></div>
                      <div class="col-md-11">
                        <span class="option__desc">
                      <span class="option__title">{{  JSON.parse(props.option.name)[0].content }}</span>
                    </span>
                      </div>
                    </div>
                  </template>
                </multiselect>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Ghi chú</label>
                    <vs-textarea v-model="bill.note"  />
                  </div>
                </div>
                <div class="col-md-6">
                  <table class="table">
                      <tbody>
                        <tr>
                          <td>Tạm tính</td>
                          <td>{{formatNumber(total_product)}}</td>
                        </tr>
                        <tr>
                          <td><a href="javascript:;">Thêm khuyến mãi</a></td>
                          <td>___</td>
                        </tr>
                        <tr v-if="bill.transport_price == '' ">
                          <td><a href="javascript:;" @click="popupActivo = true">Thêm phương thức vận chuyển</a></td>
                          <td>___</td>
                        </tr>
                        <tr v-if="bill.transport_price != '' ">
                          <td><a href="javascript:;" @click="popupActivo = true">Phương thức vận chuyển</a></td>
                          <td></td>
                        </tr>
                        <tr v-if="bill.transport_price != '' ">
                          <td>{{bill.transport}}</td>
                          <td>{{formatNumber(bill.transport_price)}}đ</td>
                        </tr>
                        <tr>
                          <td>Tổng cộng</td>
                          <td>{{formatNumber(total_bill)}}đ</td>
                        </tr>
                      </tbody>
                    </table>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <h4>Xác nhận thanh toán</h4>
                  </div>
                </div>
                <div class="col-md-6">
                  <vs-button color="danger" type="border" disabled >Thanh toán sau</vs-button>
                  <vs-button color="success" type="border" disabled >Đã thanh toán</vs-button>
                </div>
              </div>
              <vs-button color="primary" @click="addBills">Lưu đơn hàng nháp</vs-button>
            </div>
          </div>
          
        </div>
        <div class="col-md-4 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="form-group">
                    <label>Tìm kiếm hay thêm mới khách hàng</label>
                    <vs-select
                      placeholder="Search and select"
                      class="selectExample"
                      label-placeholder="Autocomplete"
                      v-model="bill.code_customer"
                      >
                       <vs-select-item key="0" value="0" text="Khách hàng chưa có tài khoản" />
                      <vs-select-item :key="index" :value="item.id" :text="item.name" v-for="item,index in customer" />
                    </vs-select>
                  </div>
            </div>
          </div>
        </div>
        <vs-popup style="width:100%;" title="Phương thức vận chuyển" :active.sync="popupActivo" v-if="popupActivo">
            <Payments @closePopup="closePop($event)" @payments="payments($event)" />
        </vs-popup>
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
  name: "bills",
  data() {
    return {
      popupActivo:false,
      customer:[],
      submitted: false,
      products:[],
      qty:1,
      bill:{
          code_bill:'',
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
            total += vm.bill.bill_detail[i]['price'] * vm.bill.bill_detail[i]['qty']
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
    ...mapActions(["loadings","listProduct","listCustomer","addBill"]),
    closePop(event) {
      this.popupActivo = event;
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
         this.$router.push({ name: "billDraft" });
         this.$success('Thêm đơn hàng thành công');
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
  }
};
</script>
<style scoped>
.el-select-dropdown__item{
    height: auto!important;
}
</style>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>