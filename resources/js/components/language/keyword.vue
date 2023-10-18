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
              <h4 class="card-title" >Từ khóa</h4>
              <vs-button type="gradient" style="float:right;" @click="popupActivo=true">Thêm từ khóa</vs-button>
              <p class="card-description">Thêm mới hoặc sửa từ khóa</p>
              <vs-button color="success" type="filled"  style="float:right;" @click="editLanguageStaticByLang">Lưu</vs-button>
              <vs-input icon="search" placeholder="Search" v-model="keyword" @keyup="searchKey" />
              <vs-table stripe :data="list" max-items="10" pagination>
                <template slot="thead">
                  <vs-th>STT</vs-th>
                  <vs-th>Từ khóa</vs-th>
                  <vs-th v-for="(i, key) in list" :key="key">{{i.name}}</vs-th>
                  <vs-th>Action</vs-th>
                </template>
                <template slot-scope="{data}">
                  <vs-tr v-for="(item, index) in languageStatic" :key="item.info.languageKey">
                    <vs-td >{{index + 1}}</vs-td>
                    <vs-td >{{item.info.languageKey}}</vs-td>
                    <!-- <vs-td>{{item.info.languageDefaultValue}}</vs-td> -->
                    <vs-td v-for="(jtem, index2) in list" :key="jtem.code" ><vs-input v-model="item.lang[jtem.code]" /></vs-td>
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
    <vs-popup style="width:100%;" title="Thêm từ khóa" :active.sync="popupActivo">
      <AddKeyword @closePopup="closePop($event)"  />
    </vs-popup>
  </div>
</template>


<script>
import Swal from "sweetalert2";
import { mapActions, mapGetters } from "vuex";
import AddKeyword from "../../components/layouts/modal/language/keyword"
export default {
  data() {
    return {
      list:[],
      keyword:"",
      id_item:"",
      popupActivo:false,
      languageStatic:[]
    };
  },
  components: {AddKeyword},
  computed: {
    
  },
  watch: {},
  methods: {
    ...mapActions(['loadings','listLanguage','getListLanguageStatic','saveLanguageStaticByLang']),
    closePop(event) {
      this.getListLanguageStatics();
      this.popupActivo = event;
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
    searchKey() {
      if (this.timer) {
        clearTimeout(this.timer);
        this.timer = null;
      }
      this.timer = setTimeout(() => {
          this.listLanguage({ keyword: this.keyword })
          .then(response => {
              this.list = response.data;
          }).catch(err => {
               
          });
      }, 800);
    },
    getListLanguageStatics(){
      this.loadings(true);
      this.getListLanguageStatic()
        .then(response => {
          this.loadings(false);
          this.languageStatic = response.data;
        })
        .catch(err => {
          this.loadings(false);
        });
    },
    editLanguageStaticByLang() {
        this.loadings(true);
        this.saveLanguageStaticByLang(JSON.stringify(this.languageStatic)).then((response) => {
            this.loadings(false);
            if (response.success) {
              this.$success('Thêm danh mục thành công');
                this.getLanguageStatic();
            }
        }).catch((err) => {
            this.loadings(false);
        });
    },

  },
  mounted() {
    this.listLanguages();
    this.getListLanguageStatics();
  }
};
</script>