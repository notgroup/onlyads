<template>
<div class="content">
    <div class="container-fluid">
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-sm-4">
                    <h4 class="page-title">{{(item.meta ? item.meta.title : '') || 'AddOrder'}}</h4>
                </div>
                <div class="col-sm-6 hide">
                    <button @click="addContent(item, contenttypeid)" class="btn btn-success rounded btn-custom waves-effect waves-light float-right">Kaydet</button>
                </div>
                <div class="col-sm-8">
                    <div class="btn-group float-right">

                        <button class="btn btn-primary btn-sm change-order-status" data-status="payment_review" type="button" onclick="changeOrderStatus(3124, 'payment_review', this);" autocomplete="off">Ödeme Onayı</button>

                        <button class="btn btn-success btn-sm change-order-status" data-status="confirmed" type="button" onclick="changeOrderStatus(3124, 'confirmed', this);" autocomplete="off">Onayla</button>

                        <button class="btn btn-danger btn-sm change-order-status" data-status="canceled" type="button" onclick="changeOrderStatus(3124, 'canceled', this);" autocomplete="off">İptal</button>

                        <button class="btn btn-warning btn-sm change-order-status" data-status="unreachable" type="button" onclick="changeOrderStatus(3124, 'unreachable', this);" autocomplete="off">Ulaşılamadı</button>

                        <button class="btn btn-primary btn-sm change-order-status" data-status="unreachable" type="button" onclick="changeOrderStatus(3124, 'pending_product', this);" autocomplete="off">Stok Bekleyen</button>

                        <button class="btn btn-primary btn-sm change-order-status" data-status="unreachable" type="button" onclick="changeOrderStatus(3124, 'hold', this);" autocomplete="off">İleri Tarihli</button>

                        <button class="btn btn-primary btn-sm change-order-status" data-status="unreachable" type="button" onclick="changeOrderStatus(3124, 'cross', this);" autocomplete="off">Cross</button>

                        <button class="btn btn-primary btn-sm change-order-status" data-status="invoice" type="button" onclick="changeOrderStatus(3124, 'invoice_prepare', this);" autocomplete="off">Fatura Hazırlık</button>

                        <button class="btn btn-primary btn-sm change-order-status" data-status="invoice" type="button" onclick="changeOrderStatus(3124, 'invoice', this);" autocomplete="off">Faturası Kesildi</button>

                        <button class="btn btn-primary btn-sm change-order-status" data-status="shipped" type="button" onclick="changeOrderStatus(3124, 'shipped', this);" autocomplete="off">Kargoya Verildi</button>

                        <button type="submit" @click="addContent(item, contenttypeid)" class="btn btn-primary btn-sm"  autocomplete="off"><i class="fa fa-save"></i> Kaydet</button>
                    </div>

                </div>
            </div>
        </div>
        <div class="logdetail">
            <button @click="$root.showLog =  !$root.showLog">
                Log
            </button>
        <pre  v-if="$root.showLog" >
{{item}}
        </pre>
        </div>

        <div class="row">

            <div class="col-lg-6">
                <div class="card m-b-30">
                    <div class="card-header bg-primary text-white">
                        Sipariş Detayları
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label for="input-payment-method" class=" control-label col-sm-2">Sipariş Tipi</label>
                            <div class="col-sm-10">
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
                                    <option value="10">AJANS1</option>
                                    <option value="11">AJANS2</option>
                                    <option value="12">AJANS3</option>
                                    <option value="13">AJANS4</option>
                                    <option value="14">AJANS5</option>
                                    <option value="15">AJANS6</option>
                                    <option value="27">B ELLE ONAY</option>
                                    <option value="5">ÇAĞRI MERKEZİ</option>
                                    <option value="26">ELLE ONAY</option>
                                    <option value="3">FACEBOOK</option>
                                    <option value="23">FACEBOOK YENİ</option>
                                    <option value="24">GOOGLE ADWORDS</option>
                                    <option value="7">İADEDEN SATIŞ</option>
                                    <option value="2">INSTAGRAM</option>
                                    <option value="29">INSTAGRAM BİO</option>
                                    <option value="22">INSTAGRAM DM</option>
                                    <option value="28">INSTAGRAM STORY</option>
                                    <option value="21">INSTAGRAM YORUM</option>
                                    <option value="8">İPTALDEN SATIŞ</option>
                                    <option value="33">MECRA</option>
                                    <option value="30">OUTBOUND</option>
                                    <option value="31">SNAPCHAT</option>
                                    <option value="16">SOURCE A</option>
                                    <option value="17">SOURCE B</option>
                                    <option value="18">SOURCE C</option>
                                    <option value="25">SOURCE D</option>
                                    <option value="4">TELEFON</option>
                                    <option value="32">TWİTTER</option>
                                    <option value="9">ULAŞILAMADIDAN SATIŞ</option>
                                    <option value="6">WEB</option>
                                    <option value="1">WHATSAPP</option>
                                    <option value="34">WHATSAPP FACEBOOK</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-payment-method" class=" control-label">Ödeme Metodu</label>
                            <div class="">
                                <select id="input-payment-method" class="form-control" v-model="item.meta.payment_method" name="payment_method">
                                    <option value="" selected="selected">ÖDEME METODU...</option>
                                    <option value="2">KAPIDA NAKİT ÖDEME</option>
                                    <option value="3">KAPIDA KREDİ KARTI</option>
                                    <option value="5">TALEP</option>
                                    <option value="4">TAHSİLATSIZ</option>
                                </select>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card m-b-30">
                    <div class="card-header bg-primary text-white">
                        Müşteri
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label for="input-firstname" class=" control-label">Ad</label>
                            <div class="">
                                <input id="input-firstname" class="form-control" placeholder="Ad" v-model="item.meta.firstname" name="firstname" type="text">
                            </div>
                        </div>
                        <div class="form-group">
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
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-phone-number-2" class=" control-label">Telefon 2</label>
                            <div class="">
                                <div class="input-group">
                                    <input id="input-phone-number-2" class="form-control" placeholder="Telefon 2" v-model="item.meta.phone_number_2" name="phone_number_2" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-country" class=" control-label">Ülke</label>
                            <div class="">
                                <select id="input-country" class="form-control country-select" data-city-element=".city-select" v-model="item.meta.country" name="country">
                                    <option value="">ÜLKE...</option>
                                    <option value="2">GERMANY</option>
                                    <option value="1" selected="selected">TÜRKİYE</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-city" class=" control-label">İl</label>
                            <div class="">
                                <select id="input-city" class="form-control city-select" v-model="item.meta.city" name="city">
                                    <option value="">İL...</option>
                                    <option value="80">ADANA</option>
                                    <option value="79">ADIYAMAN</option>
                                    <option value="78">AFYONKARAHİSAR</option>
                                    <option value="77">AĞRI</option>
                                    <option value="14">AKSARAY</option>
                                    <option value="76">AMASYA</option>
                                    <option value="75">ANKARA</option>
                                    <option value="74">ANTALYA</option>
                                    <option value="7">ARDAHAN</option>
                                    <option value="73">ARTVİN</option>
                                    <option value="72">AYDIN</option>
                                    <option value="71">BALIKESİR</option>
                                    <option value="8">BARTIN</option>
                                    <option value="10">BATMAN</option>
                                    <option value="13">BAYBURT</option>
                                    <option value="70">BİLECİK</option>
                                    <option value="69">BİNGÖL</option>
                                    <option value="68">BİTLİS</option>
                                    <option value="67">BOLU</option>
                                    <option value="66">BURDUR</option>
                                    <option value="65">BURSA</option>
                                    <option value="64">ÇANAKKALE</option>
                                    <option value="63">ÇANKIRI</option>
                                    <option value="62">ÇORUM</option>
                                    <option value="61">DENİZLİ</option>
                                    <option value="60">DİYARBAKIR</option>
                                    <option value="1">DÜZCE</option>
                                    <option value="59">EDİRNE</option>
                                    <option value="58">ELAZIĞ</option>
                                    <option value="57">ERZİNCAN</option>
                                    <option value="56">ERZURUM</option>
                                    <option value="55">ESKİŞEHİR</option>
                                    <option value="54">GAZİANTEP</option>
                                    <option value="53">GİRESUN</option>
                                    <option value="52">GÜMÜŞHANE</option>
                                    <option value="51">HAKKARİ</option>
                                    <option value="50">HATAY</option>
                                    <option value="6">IĞDIR</option>
                                    <option value="49">ISPARTA</option>
                                    <option value="81">İSTANBUL</option>
                                    <option value="47">İZMİR</option>
                                    <option value="36">KAHRAMANMARAŞ</option>
                                    <option value="4">KARABÜK</option>
                                    <option value="12">KARAMAN</option>
                                    <option value="46">KARS</option>
                                    <option value="45">KASTAMONU</option>
                                    <option value="44">KAYSERİ</option>
                                    <option value="3">KİLİS</option>
                                    <option value="11">KIRIKKALE</option>
                                    <option value="43">KIRKLARELİ</option>
                                    <option value="42">KIRŞEHİR</option>
                                    <option value="41">KOCAELİ</option>
                                    <option value="40">KONYA</option>
                                    <option value="39">KÜTAHYA</option>
                                    <option value="38">MALATYA</option>
                                    <option value="37">MANİSA</option>
                                    <option value="35">MARDİN</option>
                                    <option value="48">MERSİN</option>
                                    <option value="34">MUĞLA</option>
                                    <option value="33">MUŞ</option>
                                    <option value="32">NEVŞEHİR</option>
                                    <option value="31">NİĞDE</option>
                                    <option value="30">ORDU</option>
                                    <option value="2">OSMANİYE</option>
                                    <option value="29">RİZE</option>
                                    <option value="28">SAKARYA</option>
                                    <option value="27">SAMSUN</option>
                                    <option value="19">ŞANLIURFA</option>
                                    <option value="26">SİİRT</option>
                                    <option value="25">SİNOP</option>
                                    <option value="24">SİVAS</option>
                                    <option value="9">ŞIRNAK</option>
                                    <option value="23">TEKİRDAĞ</option>
                                    <option value="22">TOKAT</option>
                                    <option value="21">TRABZON</option>
                                    <option value="20">TUNCELİ</option>
                                    <option value="18">UŞAK</option>
                                    <option value="17">VAN</option>
                                    <option value="5">YALOVA</option>
                                    <option value="16">YOZGAT</option>
                                    <option value="15">ZONGULDAK</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-district" class=" control-label">İlçe</label>
                            <div class="">
                                <select id="input-district" class="form-control district-select" v-model="item.meta.district_id" name="district_id" style="display: none;">
                                    <option value="">İLÇE...</option>
                                </select>

                                <input id="input-district-name" class="form-control district-name" placeholder="İlçe" style="" v-model="item.meta.district_name" name="district_name" type="text">
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
            </div>
            <div class="col-lg-6">

                <div class="card m-b-30">
                    <div class="card-header bg-primary text-white">
                        Sepet {{totalPrice}}
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label for="input-payment-method" class=" control-label">Ürünler</label>
                            <div class="">
                                <select id="input-payment-method" class="form-control" v-model="selectedProductId" @change="addProductToOrder(selectedProductId)">
                                    <option value="0" selected="selected">Ürün Ekle</option>
                                    <option v-for="(pi, pik) in products" :value="pik">{{pi.meta ? pi.meta.title : 0}}</option>
                                </select>
                            </div>
                        </div>

                        <table 
                        class="table table-striped table-bordered  mb-0 table-hover nowrap display" 
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead class="thead-default">
                                <tr>
                                    <th width="1%">ID</th>
                                    <th width="20%">Ürün</th>
                                    <th>Fiyat</th>
                                    <th>Adet</th>
                                    <th>Tutar</th>
                                    <th width="1%">İşlem</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-if="item.meta && item.meta.products" v-for="(pi, pik) in item.meta.products" >
                                    <td>{{pi.content_id}} </td>
                                    <td>{{pi.meta.title}} </td>
                                    <td>
                                        <input class="form-control" type="text" name="adet" :value="pi.meta.product_quantity" v-model="pi.meta.product_quantity">
                                    </td>
                                    <td><input class="form-control" type="text" name="price" :value="pi.meta.price" v-model="pi.meta.price"></td>
                                    <td>{{pi.meta.price * pi.meta.product_quantity}} TL</td>

                                    <td>
                                        <button class="btn btn-primary waves-effect waves-light" 
                                        @click="item.meta.product_id = _.without(item.meta.product_id, pik), item.meta.products = _.omit(item.meta.products, pik)">
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
            <td colspan="2"><input 
            type="text" name="kargoTutari" 
            class="form-control" 
            style="max-width: 40%;margin-right: 10px;display:inline-block;max-height: 25px;"
            :value="item.meta.kargoTutari" v-model="item.meta.kargoTutari">
            <span> .TL</span></td>
            
        </tr>
                        <tr style="font-weight: bold;">
        	<td colspan="4" class="text-right text-uppercase">Genel Toplam</td>
            <td colspan="2">{{Number(this.totalPriceFinal) + Number(item.meta.kargoTutari || 0)}} <span class="text-right"> .TL</span></td>
        </tr>
    </tfoot>
                        </table>
                    </div>
                </div>
                <div class="card m-b-30">
                    <div class="card-header bg-primary text-white">
                        SMS Görevleri
                    </div>
                    <div class="card-body">

                        <table class="table table-striped table-bordered table-hover">
                            <thead class="thead-default">
                                <tr>
                                    <th>İsim</th>
                                    <th>Değer</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(pi, pik) in 2">
                                    <td>{{pi}} </td>

                                    <td><button class="btn btn-primary waves-effect waves-light">
                                            <i class="far fa-trash-alt"></i>
                                        </button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card m-b-30">
                    <div class="card-header bg-primary text-white">
                        Önceki Siparişler
                    </div>
                    <div class="card-body">

                        <table class="table table-striped table-bordered table-hover">
                            <thead class="thead-default">
                                <tr>
                                    <th>İsim</th>
                                    <th>Değer</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(pi, pik) in 2">
                                    <td>{{pi}} </td>

                                    <td><button class="btn btn-primary waves-effect waves-light">
                                            <i class="far fa-trash-alt"></i>
                                        </button></td>
                                </tr>
                            </tbody>
                        </table>
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
                <div class="card m-b-30">
                    <div class="card-header bg-primary text-white">
                        Geçmiş
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered table-hover">
                            <thead class="thead-default">
                                <tr>
                                    <th>İsim</th>
                                    <th>Değer</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(pi, pik) in 2">
                                    <td>{{pi}} </td>

                                    <td><button class="btn btn-primary waves-effect waves-light">
                                            <i class="far fa-trash-alt"></i>
                                        </button></td>
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
                meta:{
                    products:{},
                    product_id:[]
                },
            
            },
            rawItem: {},
            products: [],
        };
    },
    computed: {
        totalPrice(){
            if (this.item && this.item.meta.product_id) {
                this.totalPriceFinal = 0;
                _.values(this.item.meta.products).forEach(element => {
                    console.log(element);
                    this.totalPriceFinal = this.totalPriceFinal + (element.meta.price * element.meta.product_quantity)
                });
                this.item.meta.finalPrice = this.totalPriceFinal;
                return this.item.meta.product_id.length
            } else {
                return _.keys(this.item.meta.products);
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
            item.meta.title = item.meta.firstname + ' ' + item.meta.lastname + ' Siparişi';

            this.post(window.apiUrl + "/addContent/" + contenttypeid, item, (res) => {
                this.item = res
                if (!this.item.meta.products) {
                    
                    this.item.meta.products = {};
                }
                console.log(res)
            })
        },

        getData(primaryid) {
            this.get(window.apiUrl + "/content/" + primaryid, (res) => {
                this.item = res;
                if (!this.item.meta.products) {
                    
                    this.item.meta.products = {};
                }
                console.log(res);

            })
        },
        getContents(typeId) {
            this.get(window.apiUrl + "/contents/" + typeId, (res) => {
                console.log(res);

                this.products = _.indexBy(res, 'content_id')
            })
        },
        addProductToOrder(selectedProductId) {
            
            this.item.meta.product_id.push(selectedProductId)
            this.item.meta.products[selectedProductId] = this.products[selectedProductId]
            this.selectedProductId = 0
        }
    }
}
</script>

<style>
</style>
