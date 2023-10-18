<template>
    <div class="card-body">
              <div class="clearfix">
                <h4 class="card-title float-left">Đơn hàng hiện tại</h4>
                <div class="sumary-right">
                  <div class="panel-body panel-body-detail-order">
                    <div class="order-dashboard-wrapper">
                      <div class="order-dashboard-item">
                        <a href="/admin/orders?FinancialStatus=pending">
                          <div class="order-dasboard-item-panel">
                            <div class="order-dashboard-item-img">
                                <i class="mdi mdi-calculator icon-sms text-primary align-middle"></i>
                            </div>
                            <p>
                              <span class="detail-order-number">{{objData.chua_thanh_toan}}</span>
                              <span class="detail-order-title">Chưa thanh toán</span>
                            </p>
                          </div>
                        </a>
                      </div>
                      <div class="order-dashboard-item">
                        <a href="/admin/orders?FulfillmentStatus=unfulfilled">
                          <div class="order-dasboard-item-panel">
                            <div class="order-dashboard-item-img">
                              <i class="mdi mdi-motorbike icon-sms text-primary align-middle"></i>
                            </div>
                            <p>
                              <span class="detail-order-number">{{objData.chua_giao_hang}}</span>
                              <span class="detail-order-title">Chưa giao</span>
                            </p>
                          </div>
                        </a>
                      </div>
                      <div class="order-dashboard-item">
                        <a href="/admin/checkouts?RecoveryStatus=not_recovered">
                          <div class="order-dasboard-item-panel">
                            <div class="order-dashboard-item-img">
                                <i class="mdi mdi-block-helper icon-sms text-primary align-middle"></i>
                            </div>
                            <p>
                              <span class="detail-order-number">{{objData.chua_hoan_tat}}</span>
                              <span class="detail-order-title">Chưa hoàn tất</span>
                            </p>
                          </div>
                        </a>
                      </div>
                      <div class="order-dashboard-item">
                        <a href="/admin/orders?FinancialStatus=refunded">
                          <div class="order-dasboard-item-panel">
                            <div class="order-dashboard-item-img">
                                <i class="mdi mdi-airplane-takeoff icon-sms text-primary align-middle"></i>
                            </div>
                            <p>
                              <span class="detail-order-number">{{objData.dang_giao_hang}}</span>
                              <span class="detail-order-title">Đang giao hàng</span>
                            </p>
                          </div>
                        </a>
                      </div>
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
                chua_thanh_toan:0,
                chua_giao_hang:0,
                chua_hoan_tat:0,
                dang_giao_hang:0
            }
        }
    },
    methods:{
        ...mapActions(['getStatisticalBill']),
        getStatisticalBills(){
            this.getStatisticalBill().then(response => {
                console.log(response);
                this.objData = response.data;
            }).catch(error => {
                this.$error('Lỗi ứng dụng');
            })
        }
    },
    mounted(){
        this.getStatisticalBills();
    }
}
</script>