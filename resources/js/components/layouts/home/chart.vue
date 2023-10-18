<template>
  <div class="card-body">
    <div class="clearfix">
      <h4 class="card-title float-left">Doanh thu</h4>
      <div
        id="visit-sale-chart-legend"
        class="rounded-legend legend-horizontal legend-top-right float-right"
      ></div>
    </div>
    <el-date-picker
      v-model="dateSearch"
      type="daterange"
      unlink-panels
      range-separator="-"
      start-placeholder="Ngày bắt đầu"
      end-placeholder="Ngày kết thúc"
      :picker-options="pickerOptions"
      value-format="yyyy-MM-dd"
      @change="defaultDate()"
    ></el-date-picker>
    <fusioncharts
      :type="type"
      :width="width"
      :height="height"
      :dataFormat="dataFormat"
      :dataSource="dataSource"
    ></fusioncharts>
  </div>
</template>
<script>
import FusionCharts from 'fusioncharts';
import {mapActions} from 'vuex'
export default {
    data () {
      return {
        type: 'column2d',
        width: '100%',
        height: '300',
        dataFormat: 'json',
        dataSource: {
            chart: {
            caption: '',
            subCaption: '',
            showValues: '1',
            showPercentInTooltip: '0',
            numberPrefix: '',
            enableMultiSlicing: '1',
            theme: 'fusion'
          },
          data: []
        },
        dateSearch:'',
        dateRequest:{
          dateStart:'',
          dateEnd:'',
        },
        pickerOptions: {
          shortcuts: [{
            text: '1 tuần trước',
            onClick(picker) {
              const end = new Date();
              const start = new Date();
              start.setTime(start.getTime() - 3600 * 1000 * 24 * 7);
              picker.$emit('pick', [start, end]);
            }
          }, {
            text: '1 tháng trước',
            onClick(picker) {
              const end = new Date();
              const start = new Date();
              start.setTime(start.getTime() - 3600 * 1000 * 24 * 30);
              picker.$emit('pick', [start, end]);
            }
          }, {
            text: '3 tháng trước',
            onClick(picker) {
              const end = new Date();
              const start = new Date();
              start.setTime(start.getTime() - 3600 * 1000 * 24 * 90);
              picker.$emit('pick', [start, end]);
            }
          }]
        },
      }
    },
    components: {
      FusionCharts
    },
    mounted () {
      this.getChartJs();
    },
    methods: {
      ...mapActions(['getDataChart']),
      getChartJs(){
        this.getDataChart(this.dateRequest).then(response => {
          this.dataSource.data = response.data;
        }).catch(error => {
          this.$error('Hiển thị biểu đồ thất bại!');
        })
      },
      defaultDate(){
        this.dateRequest.dateStart = this.dateSearch[0];
        this.dateRequest.dateEnd = this.dateSearch[1];
        this.getChartJs();
      }
    }
}
</script>>