import {mapActions} from 'vuex'
export default  {
	data(){
		return {
			userInfor:{}
		}
	},
	computed: {
        user: function() {
            return this.userInfor;
        }
    },
  methods: {
    ...mapActions(['getInforUser'])
    // getUserInfor(){
    // 	this.$store.dispatch("getUserInfor").then(response => {
    // 		this.userInfor = response.data
    // 	});
    // }
  },
  mounted() {
    this.getInforUser().then(response => {
      this.userInfor = response.data
    });
  }
};