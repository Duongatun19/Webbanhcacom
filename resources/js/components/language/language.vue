<template>
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title">Quản lý ngôn ngữ</h3>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">Ngôn ngữ/</a>
            </li>
          </ol>
        </nav>
      </div>
      <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Ngôn ngữ</h4>
              <p class="card-description">Thêm mới hoặc sửa ngôn ngữ</p>
              <vs-button
                class="nav-link"
                type="gradient"
                style="float:right;"
                @click="popupActivo=true"
              >Thêm Ngôn Ngữ</vs-button>
              <vs-input icon="search" placeholder="Search" v-model="objData.name" @keyup="searchLanguage()" />
              <vs-table stripe :data="list" max-items="10" pagination>
                <template slot="thead">
                  <vs-th>Mã ngôn ngữ</vs-th>
                  <vs-th>Tên</vs-th>
                  <vs-th>Thứ tự hiển thị</vs-th>
                  <vs-th>Action</vs-th>
                </template>
                <template slot-scope="{data}">
                  <vs-tr :key="indextr" v-for="(tr, indextr) in data">
                    <vs-td>{{tr.code}}</vs-td>
                    <vs-td>{{tr.name}}</vs-td>
                    <vs-td>{{tr.priority}}</vs-td>
                    <vs-td>
                      <vs-button vs-type="gradient" size="lagre" color="success" icon="edit" @click="editLang(tr.code)" ></vs-button>
                      <vs-button
                        vs-type="gradient"
                        size="lagre"
                        color="red"
                        icon="delete_forever"
                        @click="confirmDestroy(tr.code)"
                      ></vs-button>
                    </vs-td>
                  </vs-tr>
                </template>
              </vs-table>
            </div>
          </div>
        </div>
      </div>
      <vs-popup style="width:100%;" title="Thêm mới ngôn ngữ" :active.sync="popupActivo">
        <AddLanguage @closePopup="closePop($event)" />
      </vs-popup>
      <vs-popup style="width:100%;" title="Thêm mới ngôn ngữ" :active.sync="popupEdit">
        <EditLanguage @closePopupEdit="closePopEdit($event)" :item="detailLang" />
      </vs-popup>
    </div>
  </div>
</template>


<script>
import Swal from "sweetalert2";
import { mapActions } from "vuex";
import AddLanguage from "../layouts/modal/language/language";
import EditLanguage from "../layouts/modal/language/language_edit";
export default {
  data() {
    return {
      list: [],
      keyword: "",
      id_item: "",
      popupActivo: false,
      popupEdit:false,
      objData:{
        name:"",
        status:"",
        pageIndex:"",
        pageSize:"",
        keyword: "",
      },
      detailLang:{}
    };
  },
  components: { AddLanguage, EditLanguage },
  computed: {},
  watch: {},
  methods: {
    ...mapActions(["listLanguage","detailLanguage","destroyLanguage", "loadings"]),
    closePop(event) {
      this.listLanguages();
      this.popupActivo = event;
    },
    closePopEdit(event){
      this.listLanguages();
      this.popupEdit = event;
    },
    editLang(id){
      this.popupEdit=true
      this.detailLanguage({code:id}).then(response => {
        this.detailLang = response.data;
      })
      .catch(err => {
          this.detailLang = err.data;
        });
    },
    searchLanguage() {
      if (this.timer) {
        clearTimeout(this.timer);
        this.timer = null;
      }
      this.timer = setTimeout(() => {
          this.listLanguage(this.objData)
          .then(response => {
            this.list = response.data;
          });
      }, 800);
    },
    listLanguages() {
      this.loadings(true);
      this.listLanguage(this.objData)
        .then(response => {
          this.loadings(false);
          this.list = response.data;
        })
        .catch(err => {
          this.loadings(false);
          this.list = err.data;
        });
    },
    destroy(){
      this.loadings(true);
      this.destroyLanguage(this.id_item)
      .then(response => {
        this.listLanguages();
        this.loadings(false);
        this.$success('Xóa ngôn ngữ thành công');
      });
    },
    confirmDestroy(code){
      this.id_item = code;
      this.$vs.dialog({
        type:'confirm',
        color: 'danger',
        title: `Bạn có chắc chắn`,
        text: 'Xóa ngôn ngữ này',
        accept:this.destroy
      })
    }
  },
  mounted() {
    this.listLanguages();
  }
};
</script>