<template>
  <div class="content">
    <div class="container-fluid">
      <!-- Page-Title -->
      <div class="page-title-box">
        <div class="row align-items-center">
          <div class="col-sm-6">
            <h4 class="page-title">BlogManagment</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-right">
              <li class="breadcrumb-item"><a href="javascript:void(0);">AnaSayfa</a></li>
              <li class="breadcrumb-item active">BlogManagment</li>
            </ol>
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
                <th width="5%">Domain</th>
                <th width="5%">Type</th>
                <th width="1%">Tools</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(item, itemi) in items">
                <td>{{itemi}}</td>
                <td>{{item.title}}</td>
                <td>{{item.domain}}</td>
                <td>{{item.type}}</td>

                <td>
                  <div class="btn-group btn-group">

                   <button class="btn btn-primary waves-effect waves-light">
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
  name: "BlogList",
  props:  ['typeId'],
  data() {
    return {
      items: [
        {
        title: "bir makale",
        domain: "corronas.site",
        type: "article",
      },
        {
        title: "bir sayfa",
        domain: "corronas.site",
        type: "page",
      }
      ]
    };
  },
  computed: {},
  mounted() {

  },
  beforeCreate() {},
  created() {},
  methods: {
    getData(typeId){
      this.get(window.apiUrl + "/BlogList", (res) => {

        this.items = res
      })
    }
  }
}
</script>
<style>
</style>

