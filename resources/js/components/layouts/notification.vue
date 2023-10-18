<template>
	<li class="nav-item dropdown">
          <a
            class="nav-link count-indicator dropdown-toggle"
            id="notificationDropdown"
            href="#"
            data-toggle="dropdown"
          >
            <i class="mdi mdi-bell-outline"></i>
            <span class="count-symbol bg-danger">{{unread.length}}</span>
          </a>
          <div
            class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
            aria-labelledby="notificationDropdown"
          >
            <h6 class="p-3 mb-0">Notifications</h6>
            <NotifyItem :unread="unread"/>
            <div class="dropdown-divider"></div>
            <!-- <h6 class="p-3 mb-0 text-center">See all notifications</h6> -->
          </div>
        </li>
</template>
<script>
import NotifyItem from '../layouts/notify_item.vue'

export default {
  // mixins: [ UserInfor ],
  data() {
    return {
      itemNoti:{
        created_at: '',
        data: {},
        id: '',
        notifiable_id: '',
        notifiable_type: '',
        read_at: '',
        type: '',
        updated_at: ''
      }
    };
  },
  components: {
  	NotifyItem
  },
  props:['unread','userId'],
  watch: {
      
  },
  watch: {},
  methods: {
  },
  created() {
    let vm = this;
    Echo.private('App.User.'+this.userId)
    .notification((notification) => {
        vm.itemNoti.data.thread = notification.thread
        vm.unread.push(vm.itemNoti);
        vm.$vs.notify({
              title: "Khách hàng mới",
              text: notification.thread.name + "vừa đăng ký tài khoản",
              color: "primary",
              position: "top-right"
            });
    });
  }
};
</script>