<template>
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">Referans Önekleri</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Ana Sayfa </a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
                <!-- end row -->

            </div>
            <!-- end page-title -->
            <div class="card faq-box border-success">
                <div class="card-body">
                    <div class="faq-icon float-right">
                        <i class="fas fa-question-circle font-24 mt-2 text-success"></i>
                    </div>

                    <h5 class="font-16 mb-3 mt-2">Nasıl Kullanılır?</h5>
                    <p class="text-muted mb-0">Ürün referans önekleri: circ_(*opsiyonel). <br />Örnek: <b>circ_ali01</b></p>
                </div>
            </div>
            <!-- START ROW -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Ürün</th>
                                            <th scope="col">Önek</th>
                                            <th scope="col">İşlem</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template v-for="(ref, rkey) in objects">
                                            <tr>
                                                <td>
                                                {{ref.id}}</td>
                                                <td>{{ref.name}}</td>
                                                <td>{{ref.value}}</td>
                                                <td>
                                                    <div>
                                                        <a href="#" class="btn btn-primary btn-sm">Edit</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        </template>


                                        <tr>
                                            <td>0</td>
                                            <td><input type="text" name="name" value="Circumin"></td>
                                            <td><input type="text" name="name" value="circ_"></td>
                                            <td>
                                                <div>
                                                    <a href="#" class="btn btn-primary btn-sm">Edit</a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td><input type="text" name="name" value="Lipolysis"></td>
                                            <td><input type="text" name="name" value="lipo_"></td>
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
    name: "AdAccounts",
    data() {
        return {
          objects: []
      };
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

