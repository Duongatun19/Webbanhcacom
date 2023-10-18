<template>
  <div class="row">
    <div class="col-md-4 stretch-card grid-margin">
      <div class="card bg-gradient-danger card-img-holder text-white">
        <div class="card-body">
          <h4 class="font-weight-normal mb-3"></h4>
          <h3 class="mb-5">Cấu hình cửa hàng</h3>
          <h6 class="card-text">
            <router-link :to="{name:'setting'}">
              <vs-button color="dark" type="border">Sửa cấu hình</vs-button>
            </router-link>
          </h6>
        </div>
      </div>
    </div>
    <div class="col-md-4 stretch-card grid-margin">
      <div class="card bg-gradient-info card-img-holder text-white">
        <div class="card-body">
      
          <h4 class="font-weight-normal mb-3"></h4>
          <h3 class="mb-5">Thêm sản phẩm</h3>
          <h6 class="card-text">
            <router-link :to="{name:'createProduct'}">
              <vs-button color="dark" type="border">Thêm sản phẩm</vs-button>
            </router-link>
          </h6>
        </div>
      </div>
    </div>
    <div class="col-md-4 stretch-card grid-margin">
      <div class="card bg-gradient-success card-img-holder text-white">
        <div class="card-body">
          <h4 class="font-weight-normal mb-3"></h4>
          <h3 class="mb-5">Sẵn sàng bán hàng</h3>
          <h6 class="card-text">
            <router-link :to="{name:'billAdd'}">
              <vs-button color="dark" type="border">Tạo đơn hàng</vs-button>
            </router-link>
          </h6>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {};
</script>