<template>
<div>
    <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target=".modal01">Large modal</button>

    <div class="modal fade bs-example-modal-lg modal01" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" style="max-width: 1024px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Detay</h5>
                    <button type="button" class="close" @click="closeModal()" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body row">

                    <div class="col-md-12">
                        <div class="form-group row">
                            <label class="col-sm-2 control-label" style="text-align:left;">İşlemler</label>
                            <div class="col-sm-12" style="margin-bottom: 20px;">

                                <select class="form-control input-sm table-filter-input actions" name="actions" v-model="currentCargoDetail.meta.agentStatus">
                                    <option value="0">İşlemler...</option>
                                    <option value="processless" selected="selected">İşlemsiz</option>
                                    <option value="not_get_cargo">Kargo getirilmedi</option>
                                    <option value="delivered">Teslim edildi</option>
                                    <option value="not_get">İstemiyor</option>
                                    <option value="notreached">Ulaşılamadı</option>
                                    <option value="callagain">Tekrar Aranacak</option>
                                    <option value="resale">Tekrar Satış</option>
                                    <option value="redeploy">WhatsApp İletişim</option>
                                    <option value="whatsapp">WhatsApp</option>
                                    <option value="cancel">İptal</option>
                                    <option value="inprocess">İşlem Yapılıyor</option>
                                    <option value="sendedcargo">Cross</option>
                                    <option value="backoffice">Cross 2</option>
                                    <option value="wrong_number">WhatsApp Yok</option>
                                </select>
                            </div>
                            <div class="col-sm-12">
                                <textarea class="form-control notes" rows="3" placeholder="Notlar" name="notes" cols="50" style="margin-bottom: 20px;" v-model="currentCargoDetail.meta.agentNote"></textarea>
                                <button @click="setAgentAction()" target="_blank" class="btn btn-primary btn-sm save-status" data-id="3149"><i class="fa fa-save"></i> Kaydet</button>

                            </div>
                        </div>

                        <hr />
                    </div>
                    <div class="col-md-6">
                        <dl class="row mb-0" v-if="currentCargoDetail.meta">

                            <dt class="col-sm-5">İsim</dt>
                            <dd class="col-sm-7">{{currentCargoDetail.meta.fullname}}</dd>
                            <dt class="col-sm-5">Telefon</dt>
                            <dd class="col-sm-7">{{currentCargoDetail.meta.phone_number}}
                                <a target="_blank" :href="'tel:' + currentCargoDetail.meta.phone_number" class="badge badge-primary">
                                    <i class="fas fa-headphones-alt"></i>
                                </a>
                                <a target="_blank" :href="'https://api.whatsapp.com/send?phone='+currentCargoDetail.meta.phone_number+'&text=Merhaba '+currentCargoDetail.meta.fullname" class="badge badge-primary">
                                    <i class="fab fa-whatsapp"></i>
                                </a>

                            </dd>
                            <dt class="col-sm-5">Gönderi Kodu</dt>
                            <dd class="col-sm-7">{{currentCargoDetail.content_id}}</dd>
                            <dt class="col-sm-5">Gönderi Ödemesi</dt>
                            <dd class="col-sm-7">Gönderici Ödemeli</dd>
                            <dt class="col-sm-5">Kargo Firması</dt>
                            <dd class="col-sm-7">{{currentCargoDetail.cargo_detail.branch}}</dd>
                            <dt class="col-sm-5">Alım Tarihi</dt>
                            <dd class="col-sm-7">{{currentCargoDetail.cargo_detail.acceptDate}}</dd>
                            <dt class="col-sm-5">Adres</dt>
                            <dd class="col-sm-7">{{currentCargoDetail.meta.address}}</dd>

                        </dl>
                    </div>
                    <div class="col-md-6">
                        <dl class="row mb-0" v-if="currentCargoDetail.meta">

                            <dt class="col-sm-5">Çıkış Tarihi</dt>
                            <dd class="col-sm-7">{{currentCargoDetail.cargo_detail.exitDate}}</dd>
                            <dt class="col-sm-5">Teslimat Durumu</dt>
                            <dd class="col-sm-7">{{currentCargoDetail.cargo_detail.shipmentStatus}}</dd>
                            <dt class="col-sm-5">Takip Numarası</dt>
                            <dd class="col-sm-7">{{currentCargoDetail.cargo_detail.senderId}}
                                <span @click="$root.getCargoDetail(currentCargoDetail)" class="badge badge-primary"> <i class="fa fa-truck"></i></span>

                            </dd>
                            <dt class="col-sm-5">Varış Şubesi</dt>
                            <dd class="col-sm-7">{{currentCargoDetail.cargo_detail.branch}}</dd>
                            <dt class="col-sm-5">Durum Açıklaması</dt>
                            <dd class="col-sm-7">{{currentCargoDetail.cargo_detail.result}}</dd>
                            <dt class="col-sm-5">Fatura Numarası</dt>
                            <dd class="col-sm-7">{{currentCargoDetail.content_id}}</dd>
                            <dt class="col-sm-5">İrsaliye Numarası</dt>
                            <dd class="col-sm-7">{{currentCargoDetail.content_id}}</dd>
                            <dt class="col-sm-5">Güncelleme Tarihi</dt>
                            <dd class="col-sm-7">{{currentCargoDetail.cargo_detail.resultDate}}</dd>

                        </dl>
                    </div>

                    <div class="col-sm-12">
                        <pre class="logdetail">
                        {{currentCargoDetail.meta}}
                        </pre>
                        <h6>Ürünler</h6>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Ürün</th>
                                    <th>Adet</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template v-for="(product, pkey) in currentCargoDetail.meta.products">
                                    <tr :key="pkey">
                                        <td>{{product.content_id}}</td>
                                        <td>
                                            <div class="pull-left" style="margin-left: 15px;">
                                                <b>{{product.meta.name || product.meta.title}}</b>
                                            </div>
                                        </td>
                                        <td>
                                            <b>1</b>
                                        </td>
                                    </tr>
                                </template>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
module.exports = {
    name: "cargoDetailModal",
    props: ['cargoDetail'],
    data() {
        return {
            currentCargoDetail: {
                meta: {}
            },
            agentStatusContent: {
                action: 0,
                note: ''
            },
            agentStatus: 0
        };
    },
    computed: {},
    mounted() {
        $('.modal01').modal('show');
        console.log(this);

    },
    beforeCreate() {},
    created() {
        console.log(this);

        this.currentCargoDetail = this.cargoDetail
        this.agentStatus = this.cargoDetail.meta.agentStatus
    },
    methods: {
        setAgentAction() {
            this.post(window.apiUrl + "/addContent/" + 33, _.omit(this.currentCargoDetail, 'cargo_detail'), (res) => {
                alertify.success("İşlem bilgilerini güncellediniz.");
                if (this.agentStatus != this.currentCargoDetail.meta.agentStatus) {
                    this.$root.addLogHistory({
                        object_id: this.currentCargoDetail.content_id,
                        log_type: 'callCenterAction',
                        action_type: 'change_status',
                        content: {
                            old_value: this.agentStatus,
                            new_value: this.currentCargoDetail.meta.agentStatus
                        }
                    })
                }
                setTimeout(() => {
                            this.agentStatus = res.meta.agentStatus
                            this.currentCargoDetail = Object.assign(this.currentCargoDetail,res)
                }, 1000);

            })

        },
        closeModal() {
            console.log('close modal');

            this.$emit('closemodal', 0)
        }
    },
};
</script>

<style></style>
