<template>
  <div class="card-body">
    <form class="forms-sample" enctype="multipart/form-data">
      <div class="form-group">
        <vs-input
          class="w-100"
          font-size="40px"
          label-placeholder="Từ khóa"
          v-model="objData.languageKey"
        />
      </div>
      <div class="form-group">
        <vs-input
          class="w-100"
          font-size="40px"
          label-placeholder="Hiển thị mặc định"
          v-model="objData.languageDefaultValue"
        />
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
          languageKey: '',
          languageDefaultValue: '',
      },
      submitted: false,
    };
  },
  computed:{
      ...mapGetters(['allLanguages'])
  },
  validations: {
    objData: {
      languageKey: { required },
      languageDefaultValue: { required }
    }
  },
  methods: {
    ...mapActions(["saveLanguageStatic", "loadings"]),
    handleSubmit() {
      this.submitted = true;
      this.$v.$touch();
      if (this.$v.$invalid) {
        return;
      } else {
        this.saveLanguageStatic(this.objData)
          .then(response => {
            this.$success('Thêm mới thành công');
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