<template>
    <div class="content">
        <div class="container-fluid">
            <!-- Page-Title -->
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">CargoTracking</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item">
                                <a href="javascript:void(0);">AnaSayfa</a>
                            </li>
                            <li class="breadcrumb-item active">
                                CargoTracking
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- end row -->
            </div>

            <div class="row">
                <div class="col-md-12">
                    <table
                        class="table table-striped table-bordered mb-0 table-hover nowrap display"
                        style="
                            border-collapse: collapse;
                            border-spacing: 0;
                            width: 100%;
                        "
                    >
                        <thead class="thead-default">
                            <tr>
                                <th width="1%">G.No</th>
                                <th width="1%">Durumu</th>
                                <th width="1%">A.Adı</th>
                                <th width="1%">A.Soyad</th>
                                <th width="1%">Sehir</th>
                                <th width="1%">Sube</th>
                                <th width="1%">O.Sonuc</th>
                                <th width="1%">Sonuc</th>
                                <th width="1%">Tutar</th>
                                <th width="1%">A.Tarih</th>
                                <th width="1%">S.Tarih</th>
                                <th width="1%">Tools</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, itemi) in items">
                                <td>{{ item.gonderino }}</td>
                                <td>{{ cargoStatusTypes[item.durum] }}</td>
                                <td>{{ item.aliciadi }}</td>
                                <td>{{ item.alicisoyad }}</td>
                                <td>{{ item.sehiradi }}</td>
                                <td>{{ item.sube }}</td>
                                <td>{{ item.onsonuc }}</td>
                                <td>{{ item.sonuc }}</td>
                                <td>{{ item.tutar }}</td>
                                <td>{{ item.alimtarihi }}</td>
                                <td>{{ item.sonuctarihi }}</td>

                                <td>
                                    <div class="btn-group btn-group">
                                        <button
                                            class="btn btn-primary waves-effect waves-light"
                                        >
                                            <i class="far fa-eye"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <hr class="m-t-10 m-b-20" />
                </div>
            </div>
        </div>
    </div>
</template>
<script>
module.exports = {
    name: "CargoTracking",
    props: ["typeId"],
    data() {
        return {
            cargoStatusTypes: {
                "0": "Paketleme",
                "1": "Teslimler",
                "2": "İadeler",
                "3": "Haber Formları",
                "4": "Dağıtımda",
                "5": "Kayıp",
                "6": "Sorunlu",
                "1,2,6": "Teslim,İade ve Sorunlu kargolar",
            },
            items: [
                {
                    gonderino: "952299400001",
                    musteribarkod: [],
                    aliciadi: "Test",
                    alicisoyad: "Test",
                    sehiradi: "Test",
                    durum: "1",
                    sube: "MNG KARGO",
                    subetel: [],
                    tutar: "71,00",
                    alimtarihi: "20.04.2020",
                    sonuctarihi: "23.04.2020",
                    sipno: "63D96ED4",
                    muskod: "7700000423",
                    onsonuc: "Test",
                    sonuc: "Test",
                    cikisno: "CL878837",
                    tahsiltarihi: "00:00:00",
                    odemetarihi: "00:00:00",
                    cikistarihi: "00:00:00",
                },
            ],
        };
    },
    computed: {},
    mounted() {
        this.getData();
    },
    beforeCreate() {},
    created() {},
    methods: {
        getData() {
            this.get(window.apiUrl + "/CargoTracking", (res) => {
                this.items = res.item;
            });
        },
    },
};
</script>
<style></style>
