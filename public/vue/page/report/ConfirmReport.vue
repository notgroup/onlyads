<template>
<div class="content">
    <div class="container-fluid">
        <!-- Page-Title -->
        <div class="page-title-box ">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4 class="page-title">Onay Raporları</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);">AnaSayfa</a>
                        </li>
                        <li class="breadcrumb-item active">Onay Raporları</li>
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
                        <template v-for="(days, dayi) in reports.ordersByDay">
                            <div v-if="days.confirmedCount" class="card m-b-30" :key="dayi">
                                <div class="card-header bg-primary text-white">
                                    {{days.day}} (Toplam Sipariş: {{days.ordersCount}} | Toplam Onay: {{days.confirmedCount}} | Toplam Oran: {{$root.computedRate(days.confirmedCount,days.ordersCount)}}%)
                                </div>
                                <div class="card-body1 table-responsive">
                                    <table class="table table-striped table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Tarih</th>
                                                <th>Sipariş</th>
                                                <th>Siparişe göre oran</th>
                                                <th>Onaya göre oran</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <template v-for="(confirmsItem, coni) in _.groupBy(reports.ordersByStatus, 'day')[days.day]">
                                                <tr>
                                                    <td>{{confirmsItem.confirmed_date}}</td>
                                                    <td>{{confirmsItem.ordersCount}}</td>
                                                    <td>{{$root.computedRate(confirmsItem.ordersCount,days.ordersCount)}}%</td>
                                                    <td>{{$root.computedRate(confirmsItem.ordersCount,days.confirmedCount)}}%</td>

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
    name: "ConfirmReport",
    data() {
        return {
            reports: {},
            actionTypes: {},
            filter: {},
        };
    },
    computed: {},
    mounted() {

    },
    beforeCreate() {},
    created() {
        this.getReport();

    },
    methods: {
        getReport() {
            this.get(window.apiUrl + "/ConfirmReport", (res) => {
                this.reports = res;
            });
        },
    }
};
</script>

<style></style>
