<template>
<div class="content">
    <div class="container-fluid">
        <!-- Page-Title -->
        <div class="page-title-box ">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4 class="page-title">ManagerReport</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);">AnaSayfa</a>
                        </li>
                        <li class="breadcrumb-item active">ManagerReport</li>
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
                        <div class="form-group row"><label class="col-sm-12 col-form-label">Aksiyon Türleri</label>
                            <div class="col-sm-12"><select class="form-control">
                                    <option value="0" selected="selected">Hepsi</option>
                                    <template v-for="(act, actk) in actionTypes">
                                        <option :value="act">{{act}}</option>
                                    </template>
                                </select></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-10">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card m-b-30">
                            <div class="card-header bg-primary text-white">
                                Görüntülendi
                            </div>
                            <div class="card-body1 table-responsive">
                                <table class="table table-striped table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th>
                                                Yönetici
                                            </th>
                                            <th>
                                                Adet
                                            </th>
                                            <th>
                                                Ortalama
                                            </th>
                                            <th>
                                                Tutar
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                Dilay Keten
                                            </td>
                                            <td>
                                                89
                                            </td>
                                            <td>
                                                %20
                                            </td>
                                            <td>
                                                1356 TL
                                            </td>
                                        </tr>
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
    name: "ManagerReport",
    data() {
        return {
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
            }
        };
    },
    computed: {},
    mounted() {},
    beforeCreate() {},
    created() {},
    methods: {},
};
</script>

<style></style>
