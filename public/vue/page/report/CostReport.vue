<template>
<div class="content">
    <div class="container-fluid">
        <!-- Page-Title -->
        <div class="page-title-box ">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4 class="page-title">Cost Report</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);">AnaSayfa</a>
                        </li>
                        <li class="breadcrumb-item active">Cost Report</li>
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
                            <div class="col-sm-12">
                                <select class="form-control" v-model="filter.product_group_id">
                                    <option value="0" selected="selected">Hepsi</option>
                                    <template v-for="(act, actk) in _.keys(_.indexBy(items, 'product_group_id'))">
                                        <option :key="actk" :value="act">{{act}}</option>
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
                        <template v-for="(groupItems, groupName) in _.groupBy(items, 'product_group_id')">
                            <div class="card m-b-30">
                                <div class="card-header bg-primary text-white">
                                    {{productsGroup[groupName] ? productsGroup[groupName].meta.name : ''}}
                                </div>
                                <div class="card-body1 table-responsive">
                                    <table class="table table-striped table-hover table-bordered">
                                        <thead class="thead-default">
                                            <tr>
                                                <th>Tarih</th>
                                                <th>Adet (Siparişler)</th>
                                                <th>Adet (Ürün)</th>
                                                <th>Maliyet (Kargo,Ürün) </th>
                                                <th>Toplam (Sipariş)</th>
                                                <th>Kar (TL)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <template v-for="(citems, dayk) in _.groupBy(groupItems, 'day')">
                                                <tr :key="dayk">
                                                    <td class="text-right text-uppercase"><b> {{dayk}}</b></td>
                                                    <td>{{_.reduce(citems,(memo, obj) => memo + Number(obj.ordersCount), 0)}}</td>
                                                    <td>{{_.reduce(citems,(memo, obj) => memo + Number(obj.productQuantity), 0)}}</td>
                                                    <td>{{currencyFormat(_.reduce(citems,(memo, obj) => memo + obj.totalCost, 0))}}</td>
                                                    <td>{{currencyFormat(_.reduce(citems,(memo, obj) => memo + obj.totalPrice, 0))}}</td>

                                                    <td>{{currencyFormat(Number(_.reduce(citems,(memo, obj) => memo + obj.gain, 0)))}}</td>
                                                </tr>
                                            </template>

                                        </tbody>
                                        <tfoot style="font-size: 15px" class="">
                                            <tr>
                                                <td class="text-right text-uppercase"><b>Toplam</b></td>
                                                <td>{{_.reduce(groupItems,(memo, obj) => memo + Number(obj.ordersCount), 0)}}</td>
                                                <td>{{_.reduce(groupItems,(memo, obj) => memo + Number(obj.productQuantity), 0)}}</td>
                                                <td>{{currencyFormat(_.reduce(groupItems,(memo, obj) => memo + obj.totalCost, 0))}}</td>
                                                <td>{{currencyFormat(_.reduce(groupItems,(memo, obj) => memo + obj.totalPrice, 0))}}</td>
                                                <td>{{currencyFormat(Number(_.reduce(groupItems,(memo, obj) => memo + obj.gain, 0)))}}</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </template>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
module.exports = {
    name: "CostReport",
    data() {
        return {
            productsGroup: {},
            filter: {
                product_group_id:0
            },
            items: []
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
            this.get(window.apiUrl + "/SalesReport", (res) => {
                this.items = res;
            });
        },
    }
};
</script>

<style></style>
