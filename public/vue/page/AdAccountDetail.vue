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
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Balance</th>
                                            <th scope="col">Pixel</th>
                                            <th scope="col">Contact</th>
                                            <th scope="col">Location</th>
                                            <th scope="col" colspan="2">Date</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template v-for="(bs, bkey) in adAccounts">
                                            <tr>
                                                <td>{{bs.name}}</td>
                                                <td>{{bs.balance}}</td>
                                                <td>{{bs.adspixels[0].name}}</td>
                                                <td><span class="badge badge-success">Delivered</span></td>
                                                <td>
                                                    <div>
                                                        <img src="assets/images/users/user-2.jpg" alt="" class="thumb-md rounded-circle mr-2"> Philip Smead
                                                    </div>
                                                </td>
                                                <td>Houston, TX 77074</td>
                                                <td>15/1/2018</td>

                                                <td>
                                                    <div>
                                                        <a href="#" class="btn btn-primary btn-sm">Edit</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        </template>


                                        <tr>
                                            <td>David Sanchez</td>
                                            <td><span class="badge badge-success">Delivered</span></td>
                                            <td>$7,250,000</td>
                                            <td>
                                                <div>
                                                    <img src="assets/images/users/user-6.jpg" alt="" class="thumb-md rounded-circle mr-2"> David Sanchez
                                                </div>
                                            </td>
                                            <td>Cincinnati, OH 45202</td>
                                            <td>19/1/2019</td>

                                            <td>
                                                <div>
                                                    <a href="#" class="btn btn-primary btn-sm">Edit</a>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

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

