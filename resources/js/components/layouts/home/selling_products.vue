<template>
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Sản phẩm bán chạy</h4>
      <div id="traffic-chart-legend" class="rounded-legend legend-vertical legend-bottom-left pt-4">
        <div class="panel-body">
          <section class="next-card__section top-product-sales">
            <div
              data-define="{topProducts: new Bizweb.HomeTopProductsReport(this,{channelId: 'all',channelName: '',homeSidebar: homeSidebar})}"
              data-context="topProducts"
            >
              <div class="area-nodata">
                <div>
                  <i class="mdi mdi-chart-bar text-successa nav-profile-badge"></i>
                </div>
                <p>Tuần này cửa hàng bạn chưa có đơn hàng nào</p>
                <vs-button color="primary" type="border">Bắt đầu bán hàng</vs-button>
                <div
                  class="next-grid next-grid--no-padding next-grid--aligned-to-baseline next-grid--space-between"
                >
                  <div class="next-grid__cell next-grid__cell--no-flex report-total-price">
                    <p>
                      <span class="dot-total-price"></span>Tổng doanh thu
                      <span
                        class="type--number type--number--large"
                        id="order-total-price"
                        style="font-weight:500; color:#7cb5ec"
                      >0 đ</span>
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {};
</script>