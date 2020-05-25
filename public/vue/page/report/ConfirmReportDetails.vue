<template>
<div class="content">
    <div class="container-fluid">
        <!-- Page-Title -->
        <div class="page-title-box ">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4 class="page-title">Ürün Grubu Onay Raporları</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);">AnaSayfa</a>
                        </li>
                        <li class="breadcrumb-item active">Ürün Grubu Onay Raporları</li>
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
                        <div class="form-group row"><label class="col-sm-12 col-form-label">Ürün Grubu</label>
                            <div class="col-sm-12"><select class="form-control">
                                    <option value="0" selected="selected">Hepsi</option>
                                    <template v-for="(act, actk) in actionTypes">
                                        <option :value="act">{{act}}</option>
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
                                Ürün Grupları
                            </div>
                            <div class="card-body1 table-responsive">
                                <table class="table table-striped table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Ürün Grubu</th>
                                            <th>Sipariş</th>
                                            <th>Onaylı Sipariş</th>
                                            <th>Onaya göre oran</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template v-for="(productGroupArr, productGroupId) in _.groupBy(reports.ordersByProductGroups, 'product_group_id')">
                                            <tr>
                                                <td>{{productsGroup[productGroupId].meta.name}}</td>
                                                <td>{{_.reduce(productGroupArr,(memo, obj) => memo + Number(obj.ordersCount), 0)}}</td>
                                                <td>{{_.reduce(productGroupArr,(memo, obj) => memo + Number(obj.confirmedCount), 0)}}</td>
                                                <td>{{$root.computedRate(_.reduce(productGroupArr,(memo, obj) => memo + Number(obj.confirmedCount), 0), _.reduce(productGroupArr,(memo, obj) => memo + Number(obj.ordersCount), 0))}}%</td>

                                            </tr>
                                        </template>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        </template>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
module.exports = {
    name: "ConfirmReportDetails",
    data() {
        return {
            productsGroup: {},
            reports: {},
            actionTypes: {},
            filter: {},
        };
    },
    computed: {},
    mounted() {
        this.productsGroup = _.indexBy(this.$root.clientInit.productsGroup, 'content_id')
    },
    beforeCreate() {},
    created() {
        this.getReport();

    },
    methods: {
        getReport() {
            this.get(window.apiUrl + "/ConfirmReportProductGroup", (res) => {
                this.reports = res;
            });
        },
    }
};
</script>

<style></style>
