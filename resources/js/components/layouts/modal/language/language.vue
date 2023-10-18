<template>
  <div class="card-body">
    <form class="forms-sample" enctype="multipart/form-data">
      <div class="form-group">
          <vs-select
            class="w-100"
            label="Ngôn ngữ"
            v-model="objData.code"
            >
            <vs-select-item :text="lang[0]" v-for="(lang,key) in allLanguages" :value="key" :key=key />
            </vs-select>
      </div>
      <div class="form-group">
        <vs-input
          class="w-100"
          font-size="40px"
          label-placeholder="Tên tiếng việt"
          v-model="objData.name"
        />
      </div>
      <div class="form-group">
        <vs-input
          class="w-100"
          font-size="40px"
          label-placeholder="Thứ tự hiển thị"
          v-model="objData.priority"
        />
      </div>
      <div class="form-group">
        <image-upload type="avatar" v-model="objData.flagIcon"></image-upload>
      </div>
      <div class="form-group">
        <label for="exampleInputName1">Trạng thái</label>
        <vs-switch v-model="objData.status">
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
      objData: {
        code: '',
        name: '',
        priority: 1,
        status: 1,
        flagIcon:''
      },
      submitted: false,
    };
  },
  computed:{
      ...mapGetters(['allLanguages'])
  },
  validations: {
    objData: {
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
        this.saveLanguage(this.objData)
          .then(response => {
            this.$success('Thêm danh mục thành công');
            this.$emit("closePopup", false);
          })
          .catch(error => {
            this.$error(Object.values(error.response.data.errors)[0][0]);
          });
      }
    },
  }
};
</script>