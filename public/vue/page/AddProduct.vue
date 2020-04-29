<template>
<div class="content">
    <div class="container-fluid">
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-sm-4">
                    <h4 class="page-title">AddProduct</h4>
                </div>
                <div class="col-sm-8">
                    <button @click="addContent(item, contenttypeid)" class="btn btn-success rounded btn-custom waves-effect waves-light float-right">Kaydet</button>
                </div>

            </div>
        </div>
        <pre class="logdetail">
        {{item}}
        </pre>
        <div class="row">
            <div class="col-lg-6">
                <div class="card m-b-30">
                    <div class="card-header bg-primary text-white">
                        Ürün Detayları
                    </div>
                    <div class="card-body">
                        <div class="form-group" v-if="item.content_id">
                            <label for="input-type">Ürün Id:</label>
                            <div class="">
                                <p class = "form-control-static">{{item.content_id}}</p>
                            </div>
                        </div>
                        <div class="form-group hide">
                            <label for="input-type">Tip</label>
                            <div class="">
                                <select id="input-type" class="form-control" v-model="item.meta.type" name="type">
                                    <option value="simple">Basit Ürün</option>
                                    <option value="configurable" selected="selected">Varyantlı Ürün</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-status">Durum</label>
                            <div class="">
                                <select class="form-control" id="input-status" v-model="item.meta.status" name="status">
                                    <option value="active">Aktif</option>
                                    <option value="passive">Pasif</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-type">Ürün Grubu</label>
                            <div class="">
                                <select id="input-type" class="form-control" v-model="item.meta.product_group_id" name="product_group_id">
                                    <option value="" selected="selected">Ürün Grubu...</option>
                                    <option v-for="(pg, pgi) in productGroup" :value="pg.content_id">{{pg.meta.title}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-tax-rate">KDV Oranı</label>
                            <div class="">
                                <select class="form-control" id="input-tax-rate" v-model="item.meta.tax_rate_id" name="tax_rate_id">
                                    <option value="" selected="selected">KDV Oranı...</option>
                                    <option value="1">KDV 0</option>
                                    <option value="2">KDV 1</option>
                                    <option value="3">KDV 5</option>
                                    <option value="4">KDV 8</option>
                                    <option value="5">KDV 18</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-name">İsim</label>
                            <div class="">
                                <input id="input-name" class="form-control" placeholder="İsim" v-model="item.meta.title" name="title" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-sku">Ürün Kodu</label>
                            <div class="">
                                <input id="input-sku" class="form-control" placeholder="Ürün Kodu" v-model="item.meta.sku" name="sku" type="text">
                            </div>
                        </div>
                        <div class="form-group simple-product-input hide" style="display: none;">
                            <label for="input-barcode">Barkod</label>
                            <div class="">
                                <input id="input-barcode" class="form-control" placeholder="Barkod" v-model="item.meta.barcode" name="barcode" type="text">
                            </div>
                        </div>
                        <div class="form-group hide">
                            <label for="input-brand-name">Marka</label>
                            <div class="">
                                <input id="input-brand-name" class="form-control" placeholder="Marka" v-model="item.meta.brand_name" name="brand_name" type="text">
                            </div>
                        </div>
                        <div class="form-group configurable-product-input hide">
                            <label for="input-sizes-tokenfield">Bedenler</label>
                            <div class="">
                                <input id="input-brand-name" class="form-control" placeholder="Beden" v-model="item.meta.beden" name="beden" type="text">
                            </div>
                        </div>

                        <div class="form-group configurable-product-input hide">
                            <label for="input-colors-tokenfield">Renkler</label>
                            <div class="">
                                <input id="input-brand-name" class="form-control" placeholder="Renk" v-model="item.meta.renk" name="renk" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-volumetric-weight">Desi</label>
                            <div class="">
                                <input class="form-control text-right" id="input-volumetric-weight" placeholder="Desi" v-model="item.meta.volumetric_weight" name="volumetric_weight" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-weight">Ağırlık</label>
                            <div class="">
                                <div class="input-group">
                                    <input class="form-control text-right" id="input-weight" placeholder="Ağırlık" v-model="item.meta.weight" name="weight" type="text">
                         
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-cost">Maliyet</label>
                            <div class="">
                                <input id="input-cost" class="form-control text-right" placeholder="Maliyet" v-model="item.meta.cost" name="cost" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-price">Fiyat</label>
                            <div class="">
                                <input id="input-price" class="form-control text-right" placeholder="Fiyat" v-model="item.meta.price" name="price" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-price-normal">Normal Fiyat</label>
                            <div class="">
                                <input id="input-price-normal" class="form-control text-right" placeholder="Normal Fiyat" v-model="item.meta.price_normal" name="price_normal" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-price-sale">İndirimli Fiyat</label>
                            <div class="">
                                <input id="input-price-sale" class="form-control text-right" placeholder="İndirimli Fiyat" v-model="item.meta.price_sale" name="price_sale" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-product_quantity">Paket Adeti</label>
                            <div class="">
                                <input id="input-product_quantity" class="form-control text-right" placeholder="Paket Adeti" v-model="item.meta.product_quantity" name="product_quantity" type="text">
                            </div>
                        </div>
                        <div class="form-group simple-product-input" style="display: none;">
                            <label for="input-quantity">Adet</label>
                            <div class="">
                                <input id="input-quantity" class="form-control text-right" 
                                maxlength="9" placeholder="Adet" v-model="item.meta.quantity" name="quantity" type="number" value="">
                            </div>
                        </div>
                        <div class="form-group hide">
                            <label for="input-fake-quantity">Sahte Adet</label>
                            <div class="">
                                <input id="input-fake-quantity" class="form-control text-right" maxlength="9" placeholder="Sahte Adet" v-model="item.meta.fake_quantity" name="fake_quantity" type="text" value="">
                            </div>
                        </div>
                        <div class="form-group hide">
                            <label for="input-preorder">Ön Sipariş</label>
                            <div class="">
                                <p class="form-control-static">
                                    <input id="input-preorder" v-model="item.meta.preorder" name="preorder" type="checkbox" value="1">
                                </p>
                            </div>
                        </div>

                        <div class="form-group hide">
                            <label for="input-sort-order">Sıra</label>
                            <div class="">
                                <input id="input-sort-order" class="form-control text-right" placeholder="Sıra" v-model="item.meta.sort_order" name="sort_order" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-starts-at">Başlangıç Tarihi</label>
                            <div class="">
                                <div class="input-group datetimepicker date">
                                    <input id="input-starts-at" class="form-control" placeholder="Başlangıç Tarihi" v-model="item.meta.starts_at" name="starts_at" type="date">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-ends-at">Bitiş Tarihi</label>
                            <div class="">
                                <div class="input-group datetimepicker date">
                                    <input id="input-ends-at" class="form-control" placeholder="Bitiş Tarihi" v-model="item.meta.ends_at" name="ends_at" type="date">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card m-b-30">
                    <div class="card-header bg-primary text-white">
                        Medya
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="input-photo-1">Fotoğraf 1</label>
                            <div class="">
                                <p class="form-control-static">
                                    <input id="input-photo-1" v-model="item.meta.key" name="file[]" type="file">
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-photo-1">Fotoğraf 2</label>
                            <div class="">
                                <p class="form-control-static">
                                    <input id="input-photo-2" v-model="item.meta.key" name="file[]" type="file">
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-photo-1">Fotoğraf 3</label>
                            <div class="">
                                <p class="form-control-static">
                                    <input id="input-photo-3" v-model="item.meta.key" name="file[]" type="file">
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-photo-1">Fotoğraf 4</label>
                            <div class="">
                                <p class="form-control-static">
                                    <input id="input-photo-4" v-model="item.meta.key" name="file[]" type="file">
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-photo-1">Fotoğraf 5</label>
                            <div class="">
                                <p class="form-control-static">
                                    <input id="input-photo-5" v-model="item.meta.key" name="file[]" type="file">
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-photo-1">Fotoğraf 6</label>
                            <div class="">
                                <p class="form-control-static">
                                    <input id="input-photo-6" v-model="item.meta.key" name="file[]" type="file">
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-photo-1">Fotoğraf 7</label>
                            <div class="">
                                <p class="form-control-static">
                                    <input id="input-photo-7" v-model="item.meta.key" name="file[]" type="file">
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-video-url">Video URL 1</label>
                            <div class="">
                                <input id="input-video-url" class="form-control" placeholder="Video URL 1" v-model="item.meta.key" name="video_url" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-video-url-2">Video URL 2</label>
                            <div class="">
                                <input id="input-video-url-2" class="form-control" placeholder="Video URL 2" v-model="item.meta.key" name="video_url_2" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-video-url-3">Video URL 3</label>
                            <div class="">
                                <input id="input-video-url-3" class="form-control" placeholder="Video URL 3" v-model="item.meta.key" name="video_url_3" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-video-url-4">Video URL 4</label>
                            <div class="">
                                <input id="input-video-url-4" class="form-control" placeholder="Video URL 4" v-model="item.meta.key" name="video_url_4" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-video-url-5">Video URL 5</label>
                            <div class="">
                                <input id="input-video-url-5" class="form-control" placeholder="Video URL 5" v-model="item.meta.key" name="video_url_5" type="text">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card m-b-30">
                    <div class="card-header bg-primary text-white">
                        Açıklamalar
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="input-discount-description">İndirim Açıklaması</label>
                            <div class="">
                                <input id="input-discount-description" class="form-control" placeholder="İndirim Açıklaması" v-model="item.meta.key" name="description_discount" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-description">Açıklama</label>
                            <textarea class="form-control" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="input-description-short">admin.short_escription</label>
                            <textarea class="form-control" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="input-delivery-policy">Teslimat ve İade</label>
                            <textarea class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                </div>
                <div class="card m-b-30">
                    <div class="card-header bg-primary text-white">
                        Meta
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label for="input-seo-url">URL Anahtarı</label>
                            <div class="">
                                <input id="input-seo-url" class="form-control" placeholder="URL Anahtarı" v-model="item.meta.url_key" name="url_key" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-meta-title">Meta Başlık</label>
                            <div class="">
                                <input id="input-meta-title" class="form-control" placeholder="Meta Başlık" v-model="item.meta.meta_title" name="meta_title" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-meta-description">Meta Açıklama</label>
                            <div class="">
                                <textarea rows="3" id="input-meta-description" class="form-control" placeholder="Meta Açıklama" v-model="item.meta.meta_description" name="meta_description" cols="50"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card m-b-30">
                    <div class="card-header bg-primary text-white">
                        Domain
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="input-domains">Domain</label>
                            <div class="col-sm-12">
                                <select class="form-control" id="input-domains" multiple="" style="height: 200px;" autocomplete="off" v-model="item.meta.domain_id" name="domain_id[]">
                                    <option value="8">admin.roket.live</option>
                                    <option value="4">blockoils.site</option>
                                    <option value="3">cesizm.site</option>
                                    <option value="9">corronas.site</option>
                                    <option value="7">datcabadem.myshopify.com</option>
                                    <option value="14">datcalis.site</option>
                                    <option value="5">dekuka.site</option>
                                    <option value="6">lipof.site</option>
                                    <option value="16">lipogroup.netlify.app</option>
                                    <option value="13">lipogroup.netlify.com</option>
                                    <option value="18">lipogroup.test</option>
                                    <option value="1">lipolysisfb.site</option>
                                    <option value="12">lipoturkey.netlify.com</option>
                                    <option value="11">lipoty.site</option>
                                    <option value="23">notgroup.github.io</option>
                                    <option value="19">notgroup.herokuapp.com</option>
                                    <option value="17">notgroup.netlify.app</option>
                                    <option value="15">notgroup.netlify.com</option>
                                    <option value="22">notgroup.onrender.com</option>
                                    <option value="20">notgroup.s3.eu-west-3.amazonaws.com</option>
                                    <option value="21">notgroupgithubio.test</option>
                                    <option value="2">procdn.site</option>
                                    <option value="10">roket.live</option>
                                </select>

                            </div>
                        </div>
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
    name: "AddProduct",
    props: ['primaryid', 'contenttypeid'],
    data() {
        return {
            itemRaw: {},
            item: {meta:{}},
            productGroup: [],
        };
    },
    computed: {},
    mounted() {
        console.log(this.$route);
        console.log(this);
        if (this.primaryid) {
            this.getData(this.primaryid);
        }
        if (this.contenttypeid) {
            this.getContents(32);
        }
    },
    beforeCreate() {},
    created() {},
    methods: {
        addContent(item = {}, contenttypeid = 0) {
            item.meta.type = 'simple';
            this.post(window.apiUrl + "/addContent/" + contenttypeid, this.item, (res) => {
                console.log(res)
            })
        },
        getData(primaryid) {
            this.get(window.apiUrl + "/content/" + primaryid, (res) => {
                this.item = res;
                console.log(res);

            })
        },
        getContents(typeId) {
            this.get(window.apiUrl + "/contents/" + typeId, (res) => {
                console.log(res);

                this.productGroup = res
            })
        }
    }
}
</script>

<style>
</style>
