<template>
<div class="content">
    <div class="container-fluid">
        <!-- Page-Title -->
        <div class="page-title-box ">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4 class="page-title">AgentReport</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);">AnaSayfa</a>
                        </li>
                        <li class="breadcrumb-item active">AgentReport</li>
                    </ol>
                </div>
            </div>
            <!-- end row -->
        </div>
        <div class="row">
            <div class="col-2">
                <div class="card m-b-30">
                    <div class="card-header bg-primary text-white">
                        Filtreler
                    </div>
                    <div class="card-body">
                        <div class="form-group row"><label class="col-sm-12 col-form-label">Rapor Türü</label>
                            <div class="col-sm-12">
                                <select class="form-control" v-model="currentReportType">
                                    <option value="0" selected="selected">Hepsi</option>
                                    <template v-for="(act, actk) in _.indexBy(items, 'log_type')">
                                        <option :value="actk">{{userActions[actk]}}</option>
                                    </template>
                                </select></div>
                        </div>
                        <div class="form-group row"><label class="col-sm-12 col-form-label">Aksiyon Türü</label>
                            <div class="col-sm-12">
                                <select class="form-control" v-model="currentActionType">
                                    <option value="0" selected="selected">Hepsi</option>
                                    <template v-for="(act, actk) in _.indexBy(_.groupBy(items, 'log_type')[currentReportType], 'action_type')">
                                        <option :value="actk">{{userActions[actk]}}</option>
                                    </template>
                                </select></div>
                        </div>
                        <div class="form-group row">
                            <label for="example-date-input" class="col-12 col-form-label">Tarih</label>
                            <label for="example-date-input" class="col-2 col-form-label"><i class="fas fa-calendar-alt"></i></label>
                            <div class="col-10">
                                <input class="form-control" type="date" id="example-date-input" :max="filter.endDate" v-model="filter.startDate" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-date-input" class="col-2 col-form-label"><i class="fas fa-calendar-alt"></i></label>
                            <div class="col-10">
                                <input class="form-control" type="date" id="example-date-input" :min="filter.startDate" v-model="filter.endDate" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-10">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card m-b-30">
                            <div class="card-header bg-primary text-white">
                                Genel Toplam
                            </div>
                            <div class="card-body1 table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Yönetici</th>
                                            <th>Rapor Türü</th>
                                            <th>Aksiyon Türü</th>
                                            <th>İşlem Türü</th>
                                            <th>Toplam</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template v-for="(item, itemk) in _.groupBy(_.groupBy(items, 'log_type')[currentReportType], 'action_type')[currentActionType]">
                                            <tr>
                                                <td>{{$root.clientInit.users[item.subject_id]}}</td>
                                                <td>{{userActions[item.log_type] || item.log_type}}</td>
                                                <td>{{userActions[item.action_type]}}</td>
                                                <td>{{userActions[item.value] || item.value}}</td>
                                                <td>{{item.total}}</td>
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
    </div>
</template>

<script>
module.exports = {
    name: "AgentReport",
    data() {
        return {
            items: [],
            actionTypes: {
                "Fatura Hazırlık": "Fatura Hazırlık",
                "Faturası Kesildi": "Faturası Kesildi",
                "Görüntülendi": "Görüntülendi",
                "Güncellendi": "Güncellendi",
                "Kargo işlemi yapıldı": "Kargo işlemi yapıldı",
                "Kargoya Verildi": "Kargoya Verildi",
                "Onaylandı": "Onaylandı",
                "Sipariş Ürün Ekleme": "Sipariş Ürün Ekleme",
                "Sipariş Ürün Silme": "Sipariş Ürün Silme",
                "Stok Bekleyen": "Stok Bekleyen",
                "Telefon Araması Yapıldı": "Telefon Araması Yapıldı",
                "Teslim Edildi": "Teslim Edildi",
                "Ulaşılamadı": "Ulaşılamadı",
                "Yeni Sipariş": "Yeni Sipariş",
                "Yönetici": "Yönetici",
                "whatsapp": "whatsapp",
                "Ödeme Onayı": "Ödeme Onayı",
                "Ürün Adedi Değiştirildi": "Ürün Adedi Değiştirildi",
                "Ürün Fiyatı Değiştirildi": "Ürün Fiyatı Değiştirildi",
                "İade": "İade",
                "İleri Tarihli": "İleri Tarihli",
                "İptal Edildi": "İptal Edildi"
            },
            currentReportType: 'callCenterAction',
            currentActionType: 'change_status',
            filter: {},
        };
    },
    computed: {},
    mounted() {},
    beforeCreate() {},
    created() {
        this.getReport();
    },
    methods: {
        getReport() {
            this.get(window.apiUrl + "/AgentReport", (res) => {
                this.items = res;
            });
        },
    },
};
</script>

<style></style>
