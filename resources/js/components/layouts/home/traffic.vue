<template>
  <div class="card">
    <div class="card-body">
      <fusioncharts
        :type="type"
        :width="width"
        :height="height"
        :dataFormat="dataFormat"
        :dataSource="dataSource"
      ></fusioncharts>
    </div>
  </div>
</template>
<script>
import FusionCharts from "fusioncharts";
import { mapActions } from "vuex";
export default {
  data() {
    return {
      width: "100%",
      height: "400",
      type: "spline",
      dataFormat: "json",
      dataSource: {
        chart: {
          caption: "Lượt truy cập",
          subCaption: "7 ngày gần nhất",
          xAxisName: "Day",
          yAxisName: "Lượt truy cập",
          showValues: "0",
          theme: "fusion"
        },
        data: [
          {
            label: "Mon",
            value: "10"
          }
        ]
      },
      arrData: []
    };
  },
  methods: {
    ...mapActions(["getTrafficPage"]),
    getTrafficPages() {
      this.getTrafficPage()
        .then(response => {
          if( response.data.length > 0){
            this.dataSource.data = response.data;
          }
        })
        .catch(error => {});
    }
  },
  mounted() {
    this.getTrafficPages();
  }
};
</script>