<template>
<div class="content">
    <div class="container-fluid">
        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4 class="page-title">FormCreator</h4>
                </div>
                <div class="col-sm-6"></div>
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
                            <th>Ürün Sayısı</th>
                            <th>App Id</th>
                            <th>Güncelleme</th>
                            <th width="1%">İşlem</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template v-for="(bm, bmi) in productGroups">
                            <tr :key="bmi">
                                <td>{{bm.content_id}}</td>
                                <td>{{bm.meta.name}}</td>
                                <td>{{bm.bm_id}}</td>
                                <td>{{bm.app_id}}</td>
                                <td>{{bm.created_at}}</td>

                                <td>
                                    <div class="btn-group btn-group">
                                        <button @click="newBmModal(bm)" class="btn btn-primary waves-effect waves-light">
                                            <i class="fas fa-cog"></i>
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

                            <div class="form-group">
                                <label>Access Token (Sistem Kullanıcısı)</label>
                                <div>
                                    <textarea required="" class="form-control" rows="20" name="access_token2" v-model="newBm.formHtml"></textarea>
                                </div>
                            </div>
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
    name: "FormCreator",
    props: [],
    data() {
        return {
            newBm: {},
            bm_accounts: [],
            productGroups: []
        };
    },
    computed: {},
    mounted() {
        this.productGroups = this.$root.clientInit.productsGroup
       // this.getBmList();
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
            this.newBm.formHtml = `<form id="siparisformu" action="//roket.live/api/checkout/smart" class="thecheckout checkout-form theForm" method="post" onsubmit="return mycheck(this);">

    <input type="hidden" name="domain_name" value="">
    <input type="hidden" name="success_url" value="">
    <input type="hidden" name="adsource" value="6">
    <input type="hidden" name="ref" value="">
    <input type="hidden" name="locale" value="tr">

        <div class="form-group">
            <select class="form-control dselector" name="product_id[]" id="fproduct" required="">
                <option value="">Ürün Seçiniz</option>
                <option value="12">1Siperlik + 3Hediye Maske 59TL</option>
                <option value="13">2Siperlik + 4Hediye Maske 79TL</option>
                <option value="14">3Siperlik + 5Hediye Maske 99TL</option>
            </select>
        </div>


        <div class="form-group icon-form">
            <input placeholder="Alıcı Adı ve Soyadı" tabindex="2" type="text" class="form-control" name="firstname"
                required="">
            <span class="field-icon"><i class="fas fa-user"></i></span>
        </div>


        <div class="form-group icon-form">
            <input placeholder="Telefon Numaranız" tabindex="1" type="tel" class="form-control" name="phone_number"
                required="">
            <span class="field-icon"><i class="fas fa-mobile-alt"></i></span>
        </div>



        <div class="form-group">
            <select class="form-control dselector" name="payment_method" required="">
                <option value="">Ödeme Şekli</option>
                <option value="2">Kapıda Nakit</option>
                <option value="3">Kapıda Kredi Kartı</option>
            </select>
        </div>

        <div class="form-group">
            <select name="city" class="form-control input-lg thecity"></select>
        </div>
        <div class="form-group icon-form">
            <select style="padding-left: 30px;" name="district" class="form-control input-lg smart-district-select">
                <option value="">Önce İl Seçiniz</option>
            </select>
            <span class="field-icon"><i class="fas fa-map-marker-alt"></i></span>
        </div>

        <div class="form-group icon-form">
            <textarea placeholder="Adres (Lütfen Açık Adresinizi Yazınız)" tabindex="7" name="address" rows="2"
                class="form-control" required=""></textarea>
            <span class="field-icon"><i class="fas fa-map-marker-alt"></i></span>
        </div>




        <button class="btn btn-success btn-lg js-save-btn" name="submit"
            id="sp_button"><i class="fas fa-check"></i> SİPARİŞİ GÖNDER
        </button>
</form>`;
             $('.addBmModal').modal('show');
        }
    }
}
</script>

<style>
</style>
