<template>
  <div class="card-body">
    <form class="forms-sample" enctype="multipart/form-data">
      <div class="row">
        <div class="col-md-6">
            <vs-radio v-model="pay.payments" vs-value="40000">Giao hàng tận nơi - 40000₫</vs-radio>
            <vs-radio v-model="pay.payments" vs-value="0">Miễn phí vận chuyển&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;</vs-radio>
            <vs-radio v-model="pay.payments" vs-value="2">Vận chuyển tùy chọn&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;</vs-radio>
        </div>
        <div class="col-md-6"></div>
      </div>
      <hr>
      <div class="row" v-if="pay.payments == 2">
        <div class="col-md-6">
          <div class="form-group">
              <label>Tên phương thức vận chuyển</label>
              <vs-input
                  type="text"
                  size="default"
                  placeholder="Tên phương thức vận chuyển"
                  class="w-100"
                  v-model="pay.name"
                />
            </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
              <label>Phí vận chuyển</label>
              <vs-input
                  type="text"
                  size="default"
                  placeholder="Phí vận chuyển"
                  class="w-100"
                  v-model="pay.price"
                />
            </div>
        </div>
      </div>
      <div class="form-group">
        <vs-button
          color="success"
          type="gradient"
          class="mr-left-45"
          @click="handleSubmit()"
        >Cập nhật</vs-button>
      </div>
    </form>
  </div>
</template>

<script>
import { required, email, minLength, sameAs } from "vuelidate/lib/validators";
import { mapActions } from "vuex";
export default {
  data() {
    return {
      pay:{
        payments:0,
        name:'',
        price:0,
      }
    };
  },
  validations: {
    
  },
  methods: {
    ...mapActions(["loadings"]),
    handleSubmit() {
      this.$emit("closePopup", false);
      this.$emit("payments",this.pay);
    }
  }
};
</script>