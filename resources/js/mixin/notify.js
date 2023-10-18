import Vue from 'vue';
export default {
    data() {
        return {
            __notify: null
        }
    },
    methods: {
        $success(text) {
            this.$vs.notify({
                title: 'Success',
                text: text,
                color: "success",
                position: "top-right"
          });
        },
        $error(text) {
            this.$vs.notify({
                title: 'Lỗi Rồi',
                text: text,
                color: "danger",
                position: "top-right"
          });
        },
        showNotification(title, message, type, multi = false) {
            if( this.__notify != null && !multi ) {
                this.__notify.close();
            }
            this.__notify = this.$notify({
                title: title,
                message: message,
                type: type
            });
        }
    }
}