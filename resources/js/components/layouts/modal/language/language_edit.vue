<template>
  <div class="card-body">
    <form class="forms-sample" enctype="multipart/form-data">
      <div class="form-group">
          <vs-select
            class="w-100"
            label="Ngôn ngữ"
            v-model="item.code"
            >
            <vs-select-item :text="lang[0]" v-for="(lang,key) in allLanguages" :value="key" :key=key />
            </vs-select>
      </div>
      <div class="form-group">
        <vs-input
          class="w-100"
          font-size="40px"
          label-placeholder="Tên tiếng việt"
          v-model="item.name"
        />
      </div>
      <div class="form-group">
        <vs-input
          class="w-100"
          font-size="40px"
          label-placeholder="Thứ tự hiển thị"
          v-model="item.priority"
        />
      </div>
      <div class="form-group">
        <image-upload type="avatar" v-model="item.flagIcon"></image-upload>
      </div>
      <div class="form-group">
        <label for="exampleInputName1">Trạng thái</label>
        <vs-switch v-model="item.status">
          <span slot="on">Hiện</span>
          <span slot="off">Ẩn</span>
        </vs-switch>
      </div>
      <div class="form-group">
        <vs-button
          color="success"
          type="gradient"
          class="mr-left-45"
          @click="handleSubmit()"
        >Lưu lại</vs-button>
      </div>
    </form>
  </div>
</template>

<script>
import { required, email, minLength, sameAs } from "vuelidate/lib/validators";
import { mapActions, mapGetters } from "vuex";
export default {
  data() {
    return {
      objData:{},
      submitted: false,
    };
  },
  props:['item'],
  computed:{
      ...mapGetters(['allLanguages'])
  },
  validations: {
    item: {
      code: { required },
      name: { required },
      priority:{ required }
    }
  },
  methods: {
    ...mapActions(["saveLanguage", "loadings"]),
    handleSubmit() {
      this.submitted = true;
      this.$v.$touch();
      if (this.$v.$invalid) {
        return;
      } else {
        this.saveLanguage(this.item)
          .then(response => {
            this.$success('Sửa ngôn ngữ thành công');
            this.$emit("closePopupEdit", false);
          })
          .catch(error => {
            this.$error(Object.values(error.response.data.errors)[0][0]);
          });
      }
    },
  },
  mounted(){
  }
};
</script>