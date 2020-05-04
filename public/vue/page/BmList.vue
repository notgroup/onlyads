<template>
  <div class="content">
    <div class="container-fluid">
      <!-- Page-Title -->
      <div class="page-title-box">
        <div class="row align-items-center">
          <div class="col-sm-6">
            <h4 class="page-title">BM Hesapları</h4>
          </div>
                <div class="col-sm-6">
                    <a href="javascript:;" class="btn btn-primary rounded btn-custom waves-effect waves-light float-right"><i class="fa fa-plus" style="margin-right:10px;"></i> Ekle</a>
                </div>
        </div>
        <!-- end row -->
      </div>

      <div class="row">
        <div class="col-md-12">
          <table class="table table-striped table-bordered  mb-0 table-hover nowrap display" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead class="thead-default">
              <tr>
                <th width="1%">ID</th>
                <th>Başlık</th>
                <th width="1%">İşlem</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>3191402807537654</td>
                <td>Rocket Net / Yeni hesap</td>

                <td>
                  <div class="btn-group btn-group">

                   <button @click="$router.push('/ad-accounts/' + '3191402807537654')" class="btn btn-primary waves-effect waves-light">
                     <i class="far fa-eye"></i>
                   </button>
                 </div>
               </td>
             </tr>
              <tr>
                <td>156479078851727</td>
                <td>RocketMedia / Eski hesap</td>

                <td>
                  <div class="btn-group btn-group">

                   <button @click="$router.push('/ad-accounts/' + '156479078851727')" class="btn btn-primary waves-effect waves-light">
                     <i class="far fa-eye"></i>
                   </button>
                 </div>
               </td>
             </tr>
           </tbody>
         </table>
         <hr class="m-t-10 m-b-20" />
       </div>


     </div>

   </div>
 </div>
</template>
<script>
module.exports = {
  name: "BmLists",
  props:  [],
  data() {
    return {};
  },
  computed: {},
  mounted() {

  },
  beforeCreate() {},
  created() {},
  methods: {}
}
</script>
<style>
</style>

