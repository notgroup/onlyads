<template>
  <div class="content">
    <div class="container-fluid">
      <!-- Page-Title -->
      <div class="page-title-box">
        <div class="row align-items-center">
          <div class="col-sm-6">
            <h4 class="page-title">CustomerList</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-right">
              <li class="breadcrumb-item"><a href="javascript:void(0);">AnaSayfa</a></li>
              <li class="breadcrumb-item active">CustomerList</li>
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
                <th width="1%">İşlem</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(item, itemi) in items">
                <td>{{itemi}}</td>
                <td>{{item.meta.title}}</td>

                <td>
                  <div class="btn-group btn-group">

                   <button @click="$router.push('/CustomerDetail/' + item.content_id)" class="btn btn-primary waves-effect waves-light">
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
  name: "CustomerList",
  data() {
    return {
      items: [],
      currentSettings: {
        autoload: ''
      }
    };
  },
  computed: {},
  mounted() {
    this.getData()
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
    getData(){
      this.get(window.apiUrl + "/contents/4?api_token=gokhan", (res) => {

        this.items = res
      })
    }
  }
}
</script>
<style>
</style>

