<template>
  <div class="row">
    <div class="col-md-8" >
      <div class="card" style="height:100%">
        <div class="row">
          <div class="col-md-4" style="border-right: 1px solid #2b2a2a85;">
            <SumaryLeft />
          </div>
          <div class="col-md-8">
            <SumaryRight />
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
        <Traffic />
    </div>
  </div>
</template>
<script>
import SumaryLeft from "../home/sumary_left";
import SumaryRight from "../home/sumary_right"
import Traffic from "../home/traffic"
export default {
    components:{
        SumaryLeft, SumaryRight, Traffic
    }
};
</script>
<style>
.sumary-left {
  width: 300px;
  float: left;
}
.panel-body {
  padding: 15px;
}
.sumary-left ul {
  list-style-type: none;
}
.panel-data-icon {
  width: 50px;
  height: auto;
  float: left;
  padding: 0 0;
  text-align: left;
}
.panel-data-info {
  width: calc(100% - 50px);
  float: right;
  padding-right: 5px;
}
.panel-data-info-title {
  font-size: 14px;
  margin-top: 0px;
  margin-bottom: 0px;
}
.number-money {
  color: #6e6dc4;
}

.panel-data-info-number {
  font-size: 20px;
  font-weight: 500;
}
.icon-sms {
  font-size: 2rem;
}
.sumary-right {
    width: 100%;
    float: right;
}
.order-dashboard-wrapper {
    width: 100%;
    padding: 15px 0;
}
.order-dashboard-wrapper .order-dashboard-item:nth-child(1) {
    padding-right: 7.5px;
}

.order-dashboard-item {
    width: 50%;
    display: inline-block;
    float: left;
}

.order-dashboard-wrapper .order-dashboard-item:nth-child(2) {
    padding-left: 7.5px;
}
.order-dashboard-wrapper .order-dashboard-item:nth-child(3) {
    padding-right: 7.5px;
    margin-top: 15px;
}
.order-dashboard-wrapper .order-dashboard-item:nth-child(4) {
    padding-left: 7.5px;
    margin-top: 15px;
}
.order-dashboard-item a {
    text-decoration: none;
    color: inherit;
}
.order-dasboard-item-panel {
    width: 100%;
    min-height: 70px;
    background-color: #f2f9ff;
    border: 1px solid #7fc3ff;
    border-radius: 5px;
    text-align: center;
    padding: 20px 0;
}
.panel-body-detail-order .detail-order-number {
    font-size: 16px;
    font-weight: 500;
    color: #4680fe;
}
.panel-body-detail-order .detail-order-title {
    font-size: 14px;
    margin-left: 3px;
}
.order-dashboard-item-img{
    height: 50px;
}
</style>