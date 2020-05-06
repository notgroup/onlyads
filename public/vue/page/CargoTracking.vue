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
            <div class="col-xl-12">
                <div class="email-leftbar card" @click="filter.page = 1">

                    <div class="form-group row">
                        <label class="col-sm-12 col-form-label">Durumu</label>
                        <div class="col-sm-12">
                            <select class="form-control adstatus-selector multiselector" v-model="filter.payment_method">
                                <option value="0" selected>Hepsi</option>
                                <template v-for="(item, itemi) in $root.clientInit.paymentMethods">
                                    <option :key="itemi" :value="item.content_id">{{item.meta.name}} </option>
                                </template>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-form-label">Sehir</label>
                        <div class="col-sm-12">
                            <select class="form-control adstatus-selector multiselector" v-model="filter.city">
                                <option value="0" selected>Hepsi</option>
                                <template v-for="(item, itemi) in _.groupBy(this.$root.clientInit.cities,'country_id')[215]">
                                    <option :key="itemi" :value="item.zone_id">{{item.name}} </option>
                                </template>
                            </select>
                        </div>
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
                    <button class="btn btn-primary btn-block" :disabled="refreshing">
                        <i class="fas fa-sync mr-2" :class="[refreshing ? 'fa-spin' : '']"></i> Göster</button>
                </div>
                <div class="email-rightbar mb-3 card m-b-30">
                    <div class="card-body" v-if="getFilter">
                        <table class="table table-striped table-bordered table-responsive mb-0 table-hover nowrap display" style="
                            border-collapse: collapse;
                            border-spacing: 0;
                            width: 100%;
                        ">
                            <thead class="thead-default">
                                <tr>
                                    <th width="1%">G.No</th>
                                    <th width="1%">S.No</th>
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
                                    <td  @click="getCargoDetail(item)">{{ item.meta.cargoDetail.gonderino }}</td>
                                    <td  @click="getCargoDetail(item)">{{ item.meta.cargoDetail.sipno }}</td>
                                    <td>{{ cargoStatusTypes[item.meta.cargoDetail.durum] }}</td>
                                    <td>{{ item.meta.cargoDetail.aliciadi }}</td>
                                    <td>{{ item.meta.cargoDetail.alicisoyad }}</td>
                                    <td>{{ item.meta.cargoDetail.sehiradi }}</td>
                                    <td>{{ item.meta.cargoDetail.sube }}</td>
                                    <td>{{ item.meta.cargoDetail.onsonuc }}</td>
                                    <td>{{ item.meta.cargoDetail.sonuc }}</td>
                                    <td>{{ item.meta.cargoDetail.tutar }}</td>
                                    <td>{{ item.meta.cargoDetail.alimtarihi }}</td>
                                    <td>{{ item.meta.cargoDetail.sonuctarihi }}</td>

                                    <td>
                                        <div class="btn-group btn-group">
                                            <button class="btn btn-primary waves-effect waves-light" @click="getCargoDetail(item)">
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
        <button type="button" class="btn btn-primary waves-effect waves-light hide" data-toggle="modal" data-target=".modal01">Large modal</button>
        <div class="modal fade bs-example-modal-lg modal01" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="myLargeModalLabel">{{currentCargoDetail.aliciadi}} {{currentCargoDetail.alicisoyad}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <iframe v-if="currentCargoDetail.url" style="padding-top: 20px;" :src="currentCargoDetail.url" frameborder="0" height="600px" scrolling="yes" width="100%"></iframe>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>
</div>
</template>

<script>
var todayDate = new Date().toLocaleDateString().split('.').reverse().join('-');
module.exports = {
    name: "CargoTracking",
    props: ["typeId"],
    data() {
        return {
            refreshing: false,
            currentCargoDetail: {},
            facets: {

            },
            filter: {
                status: 0,
                payment_method: 0,
                city: 0,
                startDate: todayDate,
                endDate: todayDate,
                page: 1
            },
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
            items: [],
        };
    },
    computed: {
        getFilter() {

            this.getData();
            return this.filter;
        }
    },
    mounted() {
        var todayDate = new Date().toLocaleDateString().split('.').join('/');
        console.log(todayDate);

        //this.getData();
    },
    beforeCreate() {},
    created() {},
    methods: {
        getData() {
            this.refreshing = true;
            this.get(window.apiUrl + "/CargoTracking" + this.$root.getString(this.filter), (res) => {
                this.items = res.item;
                this.refreshing = false;
            });
        },
        getCargoDetail(order) {
            this.currentCargoDetail = {}
            this.get(window.apiUrl + "/CargoTracking/" + order.sipno, (res) => {
                window.open(res.url, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=200,left=300,width=800,height=600");
                this.currentCargoDetail = Object.assign(order, res);
              //  $('.modal01').modal('show');
                console.log(res)

            });
        },
    },
};
</script>

<style scoped>
.modal-lg,
.modal-xl {
    max-width: 900px;
}
</style>
