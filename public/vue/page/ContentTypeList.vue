<template>
  <div class="content">
    <div class="container-fluid">
      <!-- Page-Title -->
      <div class="page-title-box">
        <div class="row align-items-center">
          <div class="col-sm-6">
            <h4 class="page-title">{{$root.entityTypes[contentTypeId]}}</h4>
          </div>
                <div class="col-sm-6">
                    <a :href="'#/AddContent/' + contentTypeId" class="btn btn-primary rounded btn-custom waves-effect waves-light float-right"><i class="fa fa-plus" style="margin-right:10px;"></i> Ekle</a>
                </div>
        </div>
        <!-- end row -->
      </div>
      <template v-if="contentTypeId">

   <order-list v-if="contentTypeId == 33" :type-id="contentTypeId"></order-list>
   <product-list v-else-if="contentTypeId == 4" :type-id="contentTypeId"></product-list>
   <product-group-list v-else-if="contentTypeId == 32" :type-id="contentTypeId"></product-group-list>
   <content-list v-else :type-id="contentTypeId"></content-list>
      </template>
 </div>
 </div>
</template>
<script>
var OrderList = httpVueLoader('/vue/page/OrderList.vue');
var ContentList = httpVueLoader('/vue/page/ContentList.vue');
var ProductList = httpVueLoader('/vue/page/ProductList.vue');
var ProductGroupList = httpVueLoader('/vue/page/ProductGroupList.vue');
module.exports = {
    components: {OrderList, ProductList, ProductGroupList, ContentList},
  name: "ContentTypeList",
  props:  ['typeId'],
  data() {
    return {
      items: [],
      currentSettings: {
        autoload: ''
      }
    };
  },
  computed: {
    contentTypeId(){
      return this.typeId
    }
  },
  mounted() {

  },
  beforeCreate() {},
  created() {},
  methods: {
    addSetting(){
      this.post(window.apiUrl + "/addSetting", this.currentSettings, (res) => {
        this.currentSettings = {}
        this.settings = res
      })
    },
    getData(typeId){
      this.get(window.apiUrl + "/contents/" + typeId, (res) => {

        this.items = res
      })
    }
  }
}
</script>
<style>
</style>

