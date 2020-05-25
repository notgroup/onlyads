<template>
<div class="content">
    <div class="container-fluid">
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-sm-4">
                    <h4 class="page-title">{{(item.meta ? item.meta.fullname : item.meta.firstname) || 'AddOrder'}}</h4>
                </div>
                <div class="col-sm-6 hide">
                    <button @click="addContent(item, contenttypeid)" class="btn btn-success rounded btn-custom waves-effect waves-light float-right">Kaydet</button>
                </div>
                <div class="col-sm-8">
                    <div class="btn-group float-right">
                        <template v-for="(status, itemi) in $root.clientInit.orderStatuses">

                            <button :key="itemi" class="btn btn-sm change-order-status" :class="['btn-'+(item.entity_status == status.option ? 'success' : 'primary')]" type="button" @click="item.entity_status = status.option, addContent(item, contenttypeid)">{{status.value}}</button>
                        </template>

                        <button type="submit" @click="addContent(item, contenttypeid)" class="btn btn-warning btn-sm"><i class="fa fa-save"></i> Kaydet</button>
                    </div>

                </div>
            </div>
        </div>
        <div class="logdetail">
            <button @click="$root.showLog =  !$root.showLog">
                Log
            </button>
            <pre v-if="$root.showLog">
            {{rawItem}}
            {{item}}
            </pre>
        </div>

        <div class="row">

            <div class="col-lg-6">
                <pre>
                {{item.meta}}
                </pre>
                <div class="card m-b-30">
                    <div class="card-header bg-primary text-white">
                        Müşteri
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label for="input-fullname" class=" control-label">Ad Soyad</label>
                            <div class="">
                                <input id="input-fullname" class="form-control" placeholder="Ad Soyad" v-model="item.meta.fullname" name="fullname" type="text">
                            </div>
                        </div>
                        <div class="form-group hide">
                            <label for="input-firstname" class=" control-label">Ad</label>
                            <div class="">
                                <input id="input-firstname" class="form-control" placeholder="Ad" v-model="item.meta.firstname" name="firstname" type="text">
                            </div>
                        </div>
                        <div class="form-group hide">
                            <label for="input-lastname" class=" control-label">Soyad</label>
                            <div class="">
                                <input id="input-lastname" class="form-control" placeholder="Soyad" v-model="item.meta.lastname" name="lastname" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-email" class=" control-label">E-posta</label>
                            <div class="">
                                <input id="input-email" class="form-control" placeholder="E-posta" v-model="item.meta.email" name="email" type="email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-phone-number" class=" control-label">Telefon 1</label>
                            <div class="">
                                <div class="input-group">
                                    <input id="input-phone-number" class="form-control" placeholder="Telefon 1" v-model="item.meta.phone_number" name="phone_number" type="text">
                                    <div class="input-group-append bg-custom b-0">
                                        <a target="_blank" :href="'tel:' + item.meta.phone_number" class="input-group-text"><i class="fas fa-headphones-alt"></i></a>
                                        <a target="_blank" :href="'https://api.whatsapp.com/send?phone='+item.meta.phone_number+'&text=Merhaba '+item.meta.fullname" class="input-group-text"><i class="fab fa-whatsapp"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-phone-number-2" class=" control-label">Telefon 2</label>
                            <div class="">
                                <div class="input-group">
                                    <input id="input-phone-number-2" class="form-control" placeholder="Telefon 2" v-model="item.meta.phone_number_2" name="phone_number_2" type="text">
                                    <div class="input-group-append bg-custom b-0">
                                        <a target="_blank" :href="'tel:' + item.meta.phone_number" class="input-group-text"><i class="fas fa-headphones-alt"></i></a>
                                        <a target="_blank" :href="'https://api.whatsapp.com/send?phone='+item.meta.phone_number+'&text=Merhaba '+item.meta.fullname" class="input-group-text"><i class="fab fa-whatsapp"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-country" class=" control-label">Ülke</label>
                            <div class="">
                                <select id="input-country" class="form-control country-select" data-city-element=".city-select" v-model="item.meta.country" name="country">
                                    <option value="">ÜLKE...</option>
                                    <template v-for="(pm, pmk) in $root.clientInit.countries">
                                        <option :value="pm.country_id">{{pm.name}}</option>
                                    </template>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-city" class=" control-label">İl</label>
                            <div class="">
                                <select id="input-city" class="form-control city-select" v-model="item.meta.city" name="city">
                                    <option value="">İL...</option>
                                    <template v-for="(pm, pmk) in _.groupBy($root.clientInit.cities, 'country_id')[item.meta.country]">
                                        <option :value="pm.zone_id">{{pm.name}}</option>
                                    </template>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-district" class=" control-label">İlçe</label>
                            <div class="">
                                <select id="input-town" class="form-control city-select" v-model="item.meta.town" name="town_id">
                                    <option value="">İL...</option>
                                    <template v-for="(pm, pmk) in _.groupBy($root.clientInit.towns, 'zone_id')[item.meta.city]">
                                        <option :value="pm.town_id">{{pm.name}}</option>
                                    </template>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-address" class=" control-label">Adres</label>
                            <div class="">
                                <textarea id="input-address" class="form-control" rows="3" placeholder="Adres" v-model="item.meta.address" name="address" cols="50"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-district" class=" control-label">Posta Kodu</label>
                            <div class="">
                                <input id="input-district-name" class="form-control" placeholder="Posta Kodu" v-model="item.meta.zip_code" name="zip_code" type="text">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card m-b-30">
                    <div class="card-header bg-primary text-white">
                        Gönderi Bilgileri
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class=" control-label">Gönderi Kodu</label>
                            <div class="">
                                <p class="form-control-static">
                                    <a href="javascript: void(0);" target="_blank" data-toggle="modal" data-target="#shipment-modal-4356">A76BCE7B</a>
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class=" control-label">Kargo Firması</label>
                            <div class="">
                                <p class="form-control-static">
                                    Deposer (Yeni)
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class=" control-label">Çıkış Tarihi</label>
                            <div class="">
                                <p class="form-control-static">
                                    29.04.2020
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class=" control-label">Teslimat Durumu</label>
                            <div class="">
                                <p class="form-control-static">
                                    Sorunlu
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class=" control-label">Takip Numarası</label>
                            <div class="">
                                <p class="form-control-static">
                                    952341100182
                                    <a href="http://kargotakip.deposerileti.com:90/mng2.asp?har_kod=952341100182" class="btn btn-primary btn-sm ajax-link popup-link" style="margin-left: 10px;"><i class="fa fa-truck" aria-hidden="true"></i> Takip Bağlantısı</a>
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class=" control-label">Takip Bağlantısı</label>
                            <div class="">
                                <p class="form-control-static">
                                    <a href="http://kargotakip.deposerileti.com:90/mng2.asp?har_kod=952341100182" target="_blank">http://kargotakip.deposerileti.com:90/mng2.asp?har_kod=952341100182</a>
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class=" control-label">Varış Şubesi</label>
                            <div class="">
                                <p class="form-control-static">
                                    MNG KARGO
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class=" control-label">İade Sebebi</label>
                            <div class="">
                                <p class="form-control-static">
                                    Kabul Edilmedi
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card m-b-30">
                    <div class="card-header bg-primary text-white">
                        Diğer Bilgiler
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">ID</label>
                            <div class="col-sm-9">
                                <p class="form-control-static">
                                    3936
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Fatura Numarası</label>
                            <div class="col-sm-9">
                                <p class="form-control-static">
                                    ---
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Tarih</label>
                            <div class="col-sm-9">
                                <p class="form-control-static">
                                    29.04.2020 - 12:31:50
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Güncelleme Tarihi</label>
                            <div class="col-sm-9">
                                <p class="form-control-static">
                                    04.05.2020 - 13:59:54
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-name" class="col-sm-3 control-label">IP Adresi</label>
                            <div class="col-sm-9">
                                <p class="form-control-static">
                                    176.40.242.136
                                </p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Reklam Kaynak</label>
                            <div class="col-sm-9">
                                <p class="form-control-static">
                                    dye30-1
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Domain</label>
                            <div class="col-sm-9">
                                <p class="form-control-static">
                                    notgroup.s3.eu-west-3.amazonaws.com
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Yönlendiren</label>
                            <div class="col-sm-9">
                                <p class="form-control-static">
                                    https://notgroup.s3.eu-west-3.amazonaws.com/meshur-kilis-bali-macunu/order.html
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Kullanıcı Aracı</label>
                            <div class="col-sm-9">
                                <p class="form-control-static break-word">
                                    Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.129 Safari/537.36
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-6">

                <div class="card m-b-30">
                    <div class="card-header bg-primary text-white">
                        Sepet ({{totalPrice}}) Adet
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label for="input-payment-method" class=" control-label">Ürünler</label>
                            <div class="">
                                <select id="input-payment-method" class="form-control" v-model="selectedProductId" @change="addProductToOrder(selectedProductId)">
                                    <option value="0" selected="selected">Ürün Ekle</option>
                                    <option v-for="(pi, pik) in products" :value="pik">{{pi.meta ? pi.meta.name : 0}}</option>
                                </select>
                            </div>
                        </div>

                        <table class="table table-striped table-bordered  mb-0 table-hover nowrap display" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead class="thead-default">
                                <tr>
                                    <th width="1%">ID</th>
                                    <th width="20%">Ürün</th>
                                    <th>Adet</th>
                                    <th>Fiyat</th>
                                    <th>Tutar</th>
                                    <th width="1%">İşlem</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-if="item.meta && item.meta.products" v-for="(pi, pik) in _.values(item.meta.products)">
                                    <td>{{pi.content_id}} </td>
                                    <td>{{pi.meta.name || pi.meta.title}} </td>
                                    <td>
                                        <input class="form-control" type="text" name="adet" :value="pi.meta.product_quantity" v-model="pi.meta.product_quantity">
                                    </td>
                                    <td><input class="form-control" type="text" name="price" :value="pi.meta.price" v-model="pi.meta.price"></td>
                                    <td>{{pi.meta.price * pi.meta.product_quantity}} TL</td>

                                    <td>
                                        <button class="btn btn-primary waves-effect waves-light" @click="item.meta.products.splice(pik,1), item.meta.product_id = _.pluck(item.meta.products, 'content_id')">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr style="font-weight: bold;">
                                    <td colspan="4" class="text-right text-uppercase">Ara Toplam</td>
                                    <td colspan="2">{{this.totalPriceFinal}} .TL</td>
                                </tr>
                                <tr style="font-weight: bold;">
                                    <td colspan="4" class="text-right text-uppercase">Kargo Tutarı</td>
                                    <td colspan="2"><input type="text" name="shipmentCost" class="form-control" style="max-width: 40%;margin-right: 10px;display:inline-block;max-height: 25px;" :value="item.meta.shipmentCost" v-model="item.meta.shipmentCost">
                                        <span> .TL</span></td>

                                </tr>
                                <tr style="font-weight: bold;">
                                    <td colspan="4" class="text-right text-uppercase">Genel Toplam</td>
                                    <td colspan="2">{{Number(this.totalPriceFinal) + Number(item.meta.shipmentCost || 0)}} <span class="text-right"> .TL</span></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="card m-b-30">
                    <div class="card-header bg-primary text-white">
                        Sipariş Detayları
                    </div>
                    <div class="card-body">

                        <div class="form-group hide">
                            <label for="input-payment-method" class=" control-label ">Sipariş Tipi</label>
                            <div class="">
                                <p class="form-control-static">
                                    <input v-model="item.meta.type" name="type" type="hidden" value="order">
                                    Sipariş
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-source" class=" control-label">Kaynak</label>
                            <div class="">
                                <select id="input-source" class="form-control" v-model="item.meta.adsource" name="adsource">
                                    <option value="" selected="selected">KAYNAK...</option>
                                    <template v-if="$root.clientInit && $root.clientInit.adsources" v-for="(pm, pmk) in $root.clientInit.adsources">
                                        <option :value="pm.content_id">{{pm.meta.name}}</option>
                                    </template>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-payment-method" class=" control-label">Ödeme Metodu</label>
                            <div class="">
                                <select id="input-payment-method" class="form-control" v-model="item.meta.payment_method" name="payment_method">
                                    <option value="" selected="selected">ÖDEME METODU...</option>
                                    <template v-for="(pm, pmk) in $root.clientInit.paymentMethods">
                                        <option :value="pm.content_id">{{pm.meta.name}}</option>
                                    </template>
                                </select>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card m-b-30">
                    <div class="card-header bg-primary text-white">
                        Notlar
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label for="input-meta-description">Not</label>
                            <div class="">
                                <textarea rows="3" id="input-meta-description" class="form-control" placeholder="Not Ekle" v-model="item.meta.note" name="note" cols="50"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card m-b-30" v-if="item.content_id">
                    <div class="card-header bg-primary text-white">
                        SMS Görevleri
                    </div>
                    <div class="card-body tableScroll">

                        <table class="table table-striped table-bordered table-hover min-table hide">
                            <thead class="thead-default">
                                <tr>
                                    <th>Hazırlanma Tarihi</th>
                                    <th>Teslim Tarihi</th>
                                    <th>Görev Tipi</th>
                                    <th>Teslimat Durumu</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(pi, pik) in 2">
                                    <td>01.05.2020 - 09:21:35 </td>
                                    <td>01.05.2020 - 09:21:35 </td>
                                    <td>Yeni Sipariş </td>
                                    <td><span class="badge badge-danger">Ulaşılamadı</span> </td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card m-b-30" v-if="item.content_id">
                    <div class="card-header bg-primary text-white">
                        Önceki Siparişler
                    </div>
                    <div class="card-body tableScroll">

                        <table class="table table-striped table-bordered table-hover min-table">
                            <thead>
                                <tr>
                                    <th style="width: 1%;">Tar.</th>
                                    <th style="width: 1%;">Dur.</th>
                                    <th style="width: 1%;">T.Dur</th>
                                    <th style="width: 1%;">S.No</th>
                                    <th style="width: 1%;">İsim</th>
                                    <th style="width: 1%;">Tutar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(pi, pik) in oldOrders">
                                    <td>{{new Date(pi.created_at).toLocaleString()}} </td>
                                    <td>İptal</td>
                                    <td>Bilinmiyor</td>
                                    <td>{{pi.content_id}}</td>
                                    <td>{{pi.meta.firstname}} </td>
                                    <td>{{pi.meta.finalPrice || 0}} </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card m-b-30" v-if="item.content_id">
                    <div class="card-header bg-primary text-white">
                        Geçmiş
                    </div>
                    <div class="card-body tableScroll">
                        <table class="table table-striped table-bordered table-hover  min-table">
                            <thead>
                                <tr>
                                    <th style="width: 1%;">Tarih</th>
                                    <th style="width: 1%;">Durum</th>
                                    <th style="width: 1%;">Açıklama</th>
                                    <th style="width: 1%;">Yönetici</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(pi, pik) in logHistory">
                                    <td>{{moment(pi.created_at).format('DD.MM.YY - HH:mm')}} </td>
                                    <td>{{userActions[pi.action_type] || pi.action_type}} </td>
                                    <td>{{pi.content.note}} </td>
                                    <td>{{pi.content.manager}} </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card m-b-30">
                    <div class="card-header bg-primary text-white">
                        Eklentiler
                    </div>
                    <div class="card-body">

                    </div>
                </div>
            </div>
            <div class="col-lg-6">

            </div>
        </div>

    </div>

</div>
</template>

<script>
module.exports = {
    name: "AddOrder",
    props: ['primaryid', 'contenttypeid'],
    data() {
        return {
            selectedProductId: 0,
            totalPriceFinal: 0,
            item: {
                entity_status: 'pending',
                meta: {
                    products: [],
                    product_id: []
                },

            },
            products: [],
            oldOrders: [],
            logHistory: [],
        };
    },
    computed: {
        totalPrice() {
            if (this.item && this.item.meta.product_id && this.item.meta && this.item.meta.products && _.keys(this.item.meta.products)) {
                this.totalPriceFinal = 0;
                _.values(this.item.meta.products).forEach(element => {
                    this.totalPriceFinal = this.totalPriceFinal + (element.meta.price * element.meta.product_quantity)
                });
                this.item.meta.finalPrice = this.totalPriceFinal;
                this.item.meta.product_id = _.pluck(this.item.meta.products, 'content_id')
                return _.keys(this.item.meta.products).length
            } else {
                return _.keys(this.item.meta.products).length;
            }
        }
    },
    mounted() {
        console.log(this.$route);
        console.log(this);

        if (this.primaryid) {
            this.getData(this.primaryid);
        }
        if (this.contenttypeid) {
            this.getContents(4);
        }
    },
    beforeCreate() {},
    created() {},
    methods: {
        addContent(item = {}, contenttypeid = 0) {
            this.item.meta.phone_number = this.item.meta.phone_number.substr(this.item.meta.phone_number.length - 10);
            this.post(window.apiUrl + "/addContent/" + contenttypeid, item, (res) => {
                if (this.item.content_id) {
                    alertify.success("Sipariş bilgilerini güncellediniz.");
                } else {
                    alertify.success("Yeni Sipariş Eklendi");
                }

                if (this.primaryid && res.meta.finalPrice && this.oldPrice != res.meta.finalPrice) {

                    this.$root.addLogHistory({
                        "object_id": this.primaryid,
                        "log_type": "orderAction",
                        "action_type": "order_price_changed",
                        "content": {
                            "old_value": this.oldPrice,
                            "new_value": res.meta.finalPrice,
                        },
                    });

                }
                if (this.primaryid && this.oldStatus != res.entity_status) {

                    this.$root.addLogHistory({
                        "object_id": this.primaryid,
                        "log_type": "orderAction",
                        "action_type": "change_status",
                        "content": {
                            "old_value": this.oldStatus,
                            "new_value": res.entity_status,
                        },
                    });

                }

                if (!this.primaryid) {

                    this.$root.addLogHistory({
                        "object_id": res.content_id,
                        "log_type": "orderAction",
                        "action_type": "new_order"
                    });
                    this.$router.push('/ContenDetail/33/' + this.item.content_id)
                }
                setTimeout(() => {
                    this.item = res
                    this.oldPrice = this.item.meta.finalPrice
                    this.oldStatus = this.item.entity_status
                    this.oldProductLength = this.item.meta.product_id.length
                }, 600);
                console.log(res)
            })
        },

        getData(primaryid) {
            this.get(window.apiUrl + "/getOrder/" + primaryid, (res) => {
                this.item = res.order;
                this.item.meta.phone_number = this.item.meta.phone_number.substr(this.item.meta.phone_number.length - 10);

                if (!this.item.meta.products) {

                    this.item.meta.products = [];
                } else {
                    this.item.meta.products = _.values(this.item.meta.products)
                }
                if (res.oldOrders) {

                    this.oldOrders = res.oldOrders;
                }

                if (this.item.meta.finalPrice) {
                    this.oldPrice = this.item.meta.finalPrice
                    this.oldStatus = this.item.entity_status
                    this.oldProductLength = this.item.meta.product_id.length
                    this.$root.addLogHistory({
                        "object_id": primaryid,
                        "log_type": "orderAction",
                        "action_type": "order_view"
                    })
                }

                this.getOrderLogHistory(primaryid)
                console.log(res);

            })
        },
        getContents(typeId) {
            this.get(window.apiUrl + "/contents/" + typeId, (res) => {
                console.log(res);

                this.products = _.indexBy(res, 'content_id')
            })
        },
        changeOrderStatus(itemId = 0, status = 'pending') {
            this.get(window.apiUrl + "/contents/" + typeId, (res) => {
                console.log(res);

                this.products = _.indexBy(res, 'content_id')
            })
        },
        getOrderLogHistory(contentId = 0) {
            this.get(window.apiUrl + "/getLogHistory/" + contentId, (res) => {
                console.log(res);

                this.logHistory = res.reverse()
            })
        },

        addProductToOrder(selectedProductId) {

            this.selectedProductId = 0
            this.item.meta.products.push(this.products[selectedProductId])
            this.item.meta.product_id = _.pluck(this.item.meta.products, 'content_id')
            if (this.primaryid) {
                this.$root.addLogHistory({
                    "object_id": this.primaryid,
                    "log_type": "orderAction",
                    "action_type": "add_product",
                    "content": {
                        itemId: selectedProductId
                    }
                })
            }

        }
    }
}
</script>

<style>
.tableScroll {
    max-height: 400px;
    overflow-y: auto;
    margin-bottom: 20px;
}

.min-table tr td {
    padding: 10px 10px !important;
}

.min-table thead td,
.min-table thead th {
    padding: 10px 10px;
}
</style>
