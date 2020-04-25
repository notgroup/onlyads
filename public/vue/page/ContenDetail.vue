<template>
    <div class="content">
        <div class="container-fluid">
            <!-- Page-Title -->
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">{{item.meta ? item.meta.title : 'ContenDetail'}}</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">AnaSayfa</a></li>
                            <li class="breadcrumb-item active">Products</li>
                        </ol>
                    </div>
                </div>
                <!-- end row -->
            </div>



</div>
</div>
</template>
<script>
module.exports = {
    name: "ContenDetail",
    props:['primaryId'],
    data() {
        return {
            item: {}
        };
    },
    computed: {},
    mounted() {
      this.getData();
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
          this.get(window.apiUrl + "/content/" + this.primaryId, (res) => {

            this.item = res
        })
      }
  }
}
</script>
<style>
</style>

