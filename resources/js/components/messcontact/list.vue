<template>
  <!-- partial -->
  <div>
      <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Tin nhắn trang liên hệ</h4>
              <vs-table max-items="5" pagination :data="list">
                <template slot="thead">
                  <vs-th>ID</vs-th>
                  <vs-th>Tên</vs-th>
                  <vs-th>Email</vs-th>
                  <vs-th>Phone</vs-th>
                  <vs-th>Tin nhắn</vs-th>
                  <vs-th>Hành động</vs-th>
                </template>
                <template slot-scope="{data}">
                  <vs-tr :key="indextr" v-for="(tr, indextr) in data">
                    <vs-td :data="tr.id">{{tr.id}}</vs-td>
                    <vs-td :data="tr.name">{{tr.name}}</vs-td>
                    <vs-td :data="tr.email">{{tr.email}}</vs-td>
                    <vs-td :data="tr.phone">{{tr.phone}}</vs-td>  
                    <vs-td :data="tr.mess">{{tr.mess}}</vs-td>
                    <vs-td >
                      <vs-button vs-type="gradient" size="lagre" color="red" icon="delete_forever" @click="confirmDestroy(tr.id)"></vs-button>
                    </vs-td>      
                  </vs-tr>
                </template>
              </vs-table>
            </div>
          </div>
        </div>
      </div>
  </div>
</template>


<script>

import { mapActions } from "vuex";
export default {
  data: () => ({
    keyword: null,
    popupActivo: false,
    list: [],
    timer:0,
    id_item :''
  }),
  computed: {
    
  },
  methods: {
    ...mapActions(["listMessContact", "loadings", "deleteMessContact"]),
    listMessContacts() {
      this.loadings(true);
      this.listMessContact({ keyword: this.keyword })
      .then(response => {
          this.loadings(false);
          this.list = response.data;
        });
    },
    confirmDestroy(id){
      this.id_item = id
      this.$vs.dialog({
        type:'confirm',
        color: 'danger',
        title: `Bạn có chắc chắn`,
        text: 'Xóa bản tin này',
        accept:this.destroy
      })
    },
    destroy(){
      this.deleteMessContact({id:this.id_item}).then(response => {
        this.listMessContacts();
        this.loadings(false);
        this.$success('xóa thành công');
      });
    }
  },
  mounted() {
    this.listMessContacts()
  }
};
</script>
<style>
</style>