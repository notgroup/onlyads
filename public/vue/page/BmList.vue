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
                    <a href="javascript:;" class="btn btn-primary rounded btn-custom waves-effect waves-light float-right" data-toggle="modal" @click="newBmModal({})"><i class="fa fa-plus" style="margin-right:10px;"></i> Ekle</a>
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
                            <th>Name</th>
                            <th>BM Id</th>
                            <th>App Id</th>
                            <th>Güncelleme</th>
                            <th width="1%">İşlem</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template v-for="(bm, bmi) in bm_accounts">
                            <tr :key="bmi">
                                <td @click="$router.push('/ad-accounts/' + bm.bm_id)">{{bm.id}}</td>
                                <td @click="$router.push('/ad-accounts/' + bm.bm_id)">{{bm.name}}</td>
                                <td>{{bm.bm_id}}</td>
                                <td>{{bm.app_id}}</td>
                                <td>{{bm.auto_update}}</td>

                                <td>
                                    <div class="btn-group btn-group">
                                        <button @click="newBmModal(bm)" class="btn btn-primary waves-effect waves-light">
                                            <i class="fas fa-cog"></i>
                                        </button>
                                        <button @click="$router.push('/ad-accounts/' + bm.bm_id)" class="btn btn-primary waves-effect waves-light">
                                            <i class="far fa-eye"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
                <hr class="m-t-10 m-b-20" />
            </div>

        </div>

    </div>
    <div class="modal fade bs-example-modal-lg addBmModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">New BM</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-md-6">

                            <div class="form-group">
                                <label>Name (*)</label>
                                <div>
                                    <input type="text" name="name" v-model="newBm.name" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label>BM ID</label>
                                <div>
                                    <input type="text" name="bm_id" v-model="newBm.bm_id" class="form-control" />
                                </div>
                            </div>
                                                    <div class="form-group">
                            <label for="input-status" class="control-label">Otomatik Güncelleme</label>
                            <div class="">
                                <select class="form-control" id="input-status" v-model="newBm.auto_update" name="status">
                                    <option value="1">Aktif</option>
                                    <option value="0">Pasif</option>
                                </select>
                            </div>
                        </div>


                            <button type="button" class="btn btn-primary btn-block waves-effect waves-light" @click="addBm()">Gönder</button>
                        </div>
                        <div class="col-md-6">
                                          <div class="form-group">
                                <label>App Id</label>
                                <div>
                                    <input type="text" name="app_id" v-model="newBm.app_id" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label>App Secret</label>
                                <div>
                                    <input type="text" name="app_secret" v-model="newBm.app_secret" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Access Token (Sistem Kullanıcısı)</label>
                                <div>
                                    <textarea required="" class="form-control" rows="5" name="access_token" v-model="newBm.access_token"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

</div>
</template>

<script>
module.exports = {
    name: "BmLists",
    props: [],
    data() {
        return {
            newBm: {},
            bm_accounts: []
        };
    },
    computed: {},
    mounted() {
        this.getBmList();
    },
    beforeCreate() {},
    created() {},
    methods: {
        getBmList() {
            this.get(window.apiUrl + "/bm_accounts", (res) => {
                this.bm_accounts = res

            })
        },
        addBm() {
            this.post(window.apiUrl + "/addBm", this.newBm, (res) => {
                this.bm_accounts = res;
                this.newBm = {}
                $('.addBmModal').modal('hide');
            })
        },
        newBmModal(bm) {
            this.newBm = bm;
             $('.addBmModal').modal('show');
        }
    }
}
</script>

<style>
</style>
