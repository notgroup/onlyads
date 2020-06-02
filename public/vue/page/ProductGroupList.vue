<template>
<div class="row">
    <div class="col-md-12">
        <table class="table table-striped table-bordered  mb-0 table-hover nowrap display" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead class="thead-default">
                <tr>
                    <th width="1%">ID</th>
                    <th>Başlık</th>
                    <th>Stok</th>
                    <th>Maliyet</th>
                    <th width="1%">İşlem</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, itemi) in items">
                    <td>{{itemi}}</td>
                    <td>{{item.meta.name}}</td>
                    <td>{{item.meta.quantity}}</td>
                    <td>{{item.meta.cost}}</td>

                    <td>
                        <div class="btn-group btn-group">
                                        <button @click="formCode(item)" class="btn btn-primary waves-effect waves-light">
                                            <i class="fab fa-wpforms"></i>
                                        </button>
                            <button @click="$router.push('/ContenDetail/' + item.entity_type_id + '/' +item.content_id)" class="btn btn-primary waves-effect waves-light">
                                <i class="far fa-eye"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <hr class="m-t-10 m-b-20" />
    </div>
    <div class="modal fade bs-example-modal-lg addBmModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Yerleştirme Kodu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                            <div class="form-group" v-if="modalItem.formHtml">
                                <label>Form Kodu</label>
                                <div>
                                    <textarea required="" class="form-control" rows="20" name="access_token2" v-model="modalItem.formHtml"></textarea>
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
    name: "ProductList",
    props: ['typeId'],
    data() {
        return {
            items: [],
            modalItem: {
                formHtml:''
            },
            currentSettings: {
                autoload: ''
            }
        };
    },
    computed: {},
    mounted() {
        this.getData(this.typeId)
    },
    beforeCreate() {},
    created() {},
    methods: {
        getData(typeId) {
            this.get(window.apiUrl + "/contents/" + typeId, (res) => {

                this.items = res
            })
        },
                formCode(modalItem) {

            this.modalItem.formHtml = `<form id="siparisformu" action="/api/checkout/smart" class="thecheckout checkout-form theForm" method="post" onsubmit="return mycheck(this);">

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
