<template>
<div class="content">
    <div class="container-fluid">
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4 class="page-title">{{item.meta.name || 'Kargo Metodu'}}</h4>
                </div>
                <div class="col-sm-6">
                    <button @click="addContent(item, contenttypeid)" class="btn btn-primary rounded btn-custom waves-effect waves-light float-right">Kaydet</button>
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
                        Servis Giriş Bilgileri
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="input-api" class="control-label">Api</label>
                            <div class="">
                                <select class="form-control" v-model="item.meta.api" name="api">
                                    <option value="0" >API...</option>
                                    <option value="ajannet">Ajan.net</option>
                                    <option value="aras">Aras Kargo</option>
                                    <option value="dhl">DHL</option>
                                    <option value="fedex">FEDEX</option>
                                    <option value="gls">GLS</option>
                                    <option value="kargoerisim">Kargo Erisim</option>
                                    <option value="kargoolusum">Kargo Oluşum</option>
                                    <option value="kargoorganik">Kargo Organik</option>
                                    <option value="mng">MNG Kargo</option>
                                    <option value="ptt">PTT Kargo</option>
                                    <option value="ups">UPS</option>
                                    <option value="yurtici">Yurtiçi Kargo</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-name" class="control-label">username</label>
                            <div class="">
                                <input id="input-name" class="form-control" v-model="item.meta.username" name="username" type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-name" class="control-label">password</label>
                            <div class="">
                                <input id="input-name" class="form-control" v-model="item.meta.password" name="password" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-name" class="control-label">customerCode</label>
                            <div class="">
                                <input id="input-name" class="form-control" v-model="item.meta.customerCode" name="customerCode" type="text">
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card m-b-30">
                    <div class="card-header bg-primary text-white">
                        Kargo Bilgileri
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="input-status" class="control-label">Durum</label>
                            <div class="">
                                <select class="form-control" id="input-status" v-model="item.entity_status" name="status">
                                    <option value="1">Aktif</option>
                                    <option value="0">Pasif</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-name" class="control-label">İsim</label>
                            <div class="">
                                <input id="input-name" class="form-control" placeholder="Yöntem Adı" v-model="item.meta.name" name="name" type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-name" class="control-label">Telefon</label>
                            <div class="">
                                <input id="input-name" class="form-control" placeholder="Telefon" v-model="item.meta.phone" name="phone" type="phone">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-6">

                <div class="card m-b-30">
                    <div class="card-header bg-primary text-white">
                        Çıktı Formatı
                    </div>
                    <div class="card-body">

                        <textarea rows="10" class="textarea form-control" v-model="exportFormat"></textarea>
                    </div>
                </div>
                <div class="card m-b-30">
                    <div class="card-header bg-primary text-white">
                        Detay/Açıklama
                    </div>
                    <div class="card-body">
                        <textarea rows="3" class="textarea form-control" v-model="item.meta.description"></textarea>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</template>

<script>
module.exports = {
    name: "AddShipment",
    props: ['primaryid', 'contenttypeid'],
    data() {
        return {
            exportFormat:"sipno:content_id,urun:name,ad:fullname,adres:address,ilce:town,sehir:city,tel:phone_number,irsaliyeno:content_id,ilkodu:code_number,tahsilat_tutari:finalPrice,odeme_tipi:payment_method".split(',').join('\n'),
            item: {
                entity_status:0,
                meta: {
                    api:0
                }
            },
        };
    },
    computed: {},
    mounted() {
        if (this.primaryid) {
            this.getData(this.primaryid);
        }
    },
    beforeCreate() {},
    created() {},
    methods: {
        addContent(item = {}, contenttypeid = 0) {
            this.post(window.apiUrl + "/addContent/" + contenttypeid, this.item, (res) => {
                console.log(res)
            })
        },
        getData(primaryid) {
            this.get(window.apiUrl + "/content/" + primaryid, (res) => {
                this.item = res;

            })
        }
    }
}
</script>

<style>
</style>
