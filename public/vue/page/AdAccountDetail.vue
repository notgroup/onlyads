<template>
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">Dashboard</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Stexo</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end page-title -->

            <!-- START ROW -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <h4 class="mt-0 header-title mb-4">Active Deals</h4>


                        </div>
                    </div>
                </div>

            </div>
            <!-- END ROW -->

        </div>
        <!-- container-fluid -->

    </div>
</template>
<script>
module.exports = {
    name: "AdAccountDetail",
    data() {
        return {
          adAccounts: []
      };
  },
  computed: {},
  mounted() {
    this.get('/adAccounts/' 12365, (res) => {


})
},
beforeCreate() {},
created() {},
methods: {}
}
</script>
<style>
</style>

