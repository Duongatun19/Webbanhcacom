<template>
  <div class="search-field d-none d-md-block">
    <form class="d-flex align-items-center h-100" action="#">
      <div class="input-group">
        <div class="input-group-prepend bg-transparent">
          <i class="input-group-text border-0 mdi mdi-magnify"></i>
        </div>
        <el-select
          class="form-control bg-transparent border-0"
          v-model="value"
          filterable
          remote
          reserve-keyword
          placeholder="Please enter a keyword"
          :remote-method="remoteMethod"
          :loading="loading"
        >
          <header class="quick-search__category-header">
            <div class="row">
              <div class="col-md-8">
                <h4 class="quick-search__category-title">Kết quả tìm kiếm</h4>
              </div>
              <div class="col-md-4">
                <div class="quick-search__filter">
                  <strong>Lọc:</strong>
                  <select class="quick-search__filter-select">
                    <option value selected>tất cả</option>
                    <option value="PRODUCT">sản phẩm</option>
                    <option value="ORDER">đơn hàng</option>
                    <option value="CUSTOMER">khách hàng</option>
                  </select>
                  <span class="quick-search__filter-icon">
                    <svg class="next-icon next-icon--size-16">
                      <use xlink:href="#next-disclosure" />
                    </svg>
                  </span>
                </div>
              </div>
            </div>
          </header>
          <el-option
            v-for="(item,key) in options"
            :key="key"
            :value="key"
          >
            <a :href="riderectChange(item)" class="searchform">
              <div class="row">
                <div class="col-md-2">
                  <el-avatar
                    shape="square"
                    :size="50"
                    :src="item.image"
                  ></el-avatar>
                </div>
                <div class="col-md-10" style="padding-left: 0;">
                  <h4 class="title_search">{{item.name}}</h4>
                  <p class="option_search">{{item.option}}</p>
                </div>
              </div>
            </a>
          </el-option>
        </el-select>
      </div>
    </form>
  </div>
</template>
<script>
import { mapActions } from "vuex";
export default {
  data() {
    return {
      objData: {
        keyword: ""
      },
      options: [],
      value: [],
      list: [],
      loading: false,
    };
  },
  mounted() {
  },
  methods: {
    ...mapActions(["searchNavbar"]),
    remoteMethod(query) {
      this.objData.keyword = query;
      if (query !== "") {
        this.loading = true;
        setTimeout(() => {
          this.loading = false;
          this.searchNavbar(this.objData).then(response => {
              this.options = response.data;
          })
        }, 500);
      } else {
        this.options = [];
      }
    },
    riderectChange(item){
        if(item.type == "product"){
            return this.$router.push({name: 'edit_product', params: { pro_code: item.id,language:'vi' }});
        }
    }
  }
};
</script>
<style >
i.input-group-text.border-0.mdi.mdi-magnify {
  display: none;
}
input.el-input__inner {
  border: none;
  margin: -6% -15% 0;
}
.el-select-dropdown.el-popper {
  min-width: 500px !important;
}
li.el-select-dropdown__item {
  padding-top: 13px;
}
.el-select-dropdown__item {
  height: 100% !important;
}
a.searchform{
    text-decoration: none;
}
h4.title_search {
    font-size: 16px;
    color: #544f4f;
    font-family: auto;
    font-weight: bold;
}

p.option_search {
    color: #505152;
}
.quick-search__category-header {
    height: 50px;
    background: #babdc1;
    padding-top: 2%;
    padding-left: 3%;
    color: #231d1dbf;
}
</style>