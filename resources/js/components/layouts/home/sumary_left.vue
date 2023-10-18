<template>
    <div class="card-body">
              <div class="clearfix">
                <h4 class="card-title float-left">Tổng quan trong ngày</h4>
                <div class="sumary-left">
                  <div class="panel-body">
                    <div>
                      <ul>
                        <li class="clearfix">
                          <div class="panel-data-icon panel-data-icon-money">
                            <i class="mdi mdi-diamond icon-sms text-primary align-middle"></i>
                          </div>
                          <div class="panel-data-info">
                            <p class="panel-data-info-title">Doanh thu</p>
                            <p class="panel-data-info-number number-money" id="total_sales">{{objData.revenue}}₫</p>
                          </div>
                        </li>
                        <li class="clearfix">
                          <div class="panel-data-icon panel-data-icon-order">
                            <i class="mdi mdi-cube icon-sms text-primary align-middle"></i>
                          </div>
                          <div class="panel-data-info">
                            <p class="panel-data-info-title">Đơn hàng</p>
                            <p class="panel-data-info-number number-order" id="total_orders">{{objData.total_bill}}</p>
                          </div>
                        </li>
                        <li class="clearfix">
                          <div class="panel-data-icon panel-data-icon-cus">
                            <i class="mdi mdi-account icon-sms text-primary align-middle"></i>
                          </div>
                          <div class="panel-data-info">
                            <p class="panel-data-info-title">Khách hàng mới</p>
                            <p class="panel-data-info-number number-cus" id="total_customers">{{objData.new_cus}}</p>
                          </div>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div
                  id="visit-sale-chart-legend"
                  class="rounded-legend legend-horizontal legend-top-right float-right"
                ></div>
              </div>
            </div>
</template>
<script>
import {mapActions} from 'vuex'
export default {
    data(){
        return {
            objData:{
                revenue:0,
                total_bill:0,
                new_cus:0
            }
        }
    },
    methods:{
        ...mapActions(['getRevenue']),
        getRevenues(){
            this.getRevenue().then(response => {
                this.objData = response.data;
            }).catch(error => {
                this.$error('Lỗi ứng dụng');
            })
        }
    },
    mounted(){
        this.getRevenues();
    }
}
</script>>