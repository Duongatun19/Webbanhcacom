<template>
    <div class="row">
        <div class="col-md-8 grid-margin stretch-card">
          <div class="card">
            <ChartComponent />
          </div>
        </div>
        <div class="col-md-4 grid-margin stretch-card">
          <SellingProduct />
        </div>
      </div>
</template>
<script>
import ChartComponent from "../home/chart";
import SellingProduct from "../home/selling_products"
export default {
    components: {
        ChartComponent,
        SellingProduct
    },
}
</script>