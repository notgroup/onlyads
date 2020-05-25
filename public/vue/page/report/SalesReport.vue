<template>
<div class="content">
    <div class="container-fluid">
        <!-- Page-Title -->
        <div class="page-title-box ">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4 class="page-title">SalesReport</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);">AnaSayfa</a>
                        </li>
                        <li class="breadcrumb-item active">SalesReport</li>
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
                                <table class="table table-striped table-hover table-bordered">
                                    <thead class="thead-default">
                                        <tr>
                                            <th>Para Birimi</th>
                                            <th>Adet (Siparişler)</th>
                                            <th>Adet (Ürün)</th>
                                            <th>Maliyet (Kargo,Ürün) </th>
                                            <th>Toplam (Sipariş)</th>
                                            <th>Kar (TL)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template v-for="(citems, country) in _.groupBy(items, 'country')">
                                        <tr :key="country">
                                            <td class="text-right text-uppercase"><b> TL</b></td>
                                            <td>{{_.reduce(citems,(memo, obj) => memo + Number(obj.ordersCount), 0)}}</td>
                                            <td>{{_.reduce(citems,(memo, obj) => memo + Number(obj.productQuantity), 0)}}</td>
                                            <td>{{currencyFormat(_.reduce(citems,(memo, obj) => memo + obj.totalCost, 0))}}</td>
                                            <td>{{currencyFormat(_.reduce(citems,(memo, obj) => memo + obj.totalPrice, 0))}}</td>

                                            <td>{{currencyFormat(Number(_.reduce(citems,(memo, obj) => memo + obj.gain, 0)))}}</td>
                                        </tr>
                                        </template>

                                    </tbody>
                                    <tfoot style="font-size: 15px" class="hide">
                                        <tr>
                                            <td class="text-right text-uppercase"><b>Toplam</b></td>
                                            <td><b>326</b></td>
                                            <td></td>
                                            <td>Ort.: <b>106.89 TL</b></td>
                                            <td><b>5,083.00 TL</b></td>
                                            <td>--</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>


                        <div class="card m-b-30">
                            <div class="card-header bg-primary text-white">
                                Ürün Grupları
                            </div>
                            <div class="card-body1 table-responsive">
                                <table class="table table-striped table-hover table-bordered">
                                    <thead class="thead-default">
                                        <tr>
                                            <th>Ürün Grubu</th>
                                            <th>Adet (Siparişler)</th>
                                            <th>Adet (Ürün)</th>
                                            <th>Maliyet (Kargo,Ürün) </th>
                                            <th>Toplam (Sipariş)</th>
                                            <th>Kar (TL)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template v-for="(citems, product_group_id) in _.groupBy(items, 'product_group_id')">
                                        <tr :key="product_group_id">
                                            <td class="text-right text-uppercase"><b>
                                                {{productsGroup[product_group_id].meta.name}}
                                                </b></td>
                                            <td>{{_.reduce(citems,(memo, obj) => memo + Number(obj.ordersCount), 0)}}</td>
                                            <td>{{_.reduce(citems,(memo, obj) => memo + Number(obj.productQuantity), 0)}}</td>
                                            <td>{{currencyFormat(_.reduce(citems,(memo, obj) => memo + obj.totalCost, 0))}}</td>
                                            <td>{{currencyFormat(_.reduce(citems,(memo, obj) => memo + obj.totalPrice, 0))}}</td>

                                            <td>{{currencyFormat(Number(_.reduce(citems,(memo, obj) => memo + obj.gain, 0)))}}</td>
                                        </tr>
                                        </template>

                                    </tbody>
                                    <tfoot style="font-size: 15px" class="hide">
                                        <tr>
                                            <td class="text-right text-uppercase"><b>Toplam</b></td>
                                            <td><b>326</b></td>
                                            <td></td>
                                            <td>Ort.: <b>106.89 TL</b></td>
                                            <td><b>5,083.00 TL</b></td>
                                            <td>--</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                        <div class="card m-b-30 hide">
                            <div class="card-header bg-primary text-white">
                                Domain
                            </div>
                            <div class="card-body1 table-responsive">
                                <table class="table table-striped table-hover table-bordered">
                                    <thead class="thead-default">
                                        <tr>
                                            <th>Domain</th>
                                            <th>Adet (Siparişler)</th>
                                            <th>Maliyet</th>
                                            <th>Toplam</th>
                                            <th>Toplam (TL)</th>
                                            <th>Kar (TL)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><b><a href="https://notgroup.github.io" target="_blank">notgroup.github.io</a></b></td>
                                            <td>306</td>

                                            <td>
                                                32,162.00 TL
                                                <br>
                                            </td>
                                            <td>4,155.00 TL</td>
                                            <td>32,162.00 TL</td>
                                            <td>28,007.00 TL</td>
                                        </tr>
                                        <tr>
                                            <td><b><a href="http://siparis.kilismacunu.com" target="_blank">siparis.kilismacunu.com</a></b></td>
                                            <td>17</td>

                                            <td>
                                                2,372.00 TL
                                                <br>
                                            </td>
                                            <td>735.00 TL</td>
                                            <td>2,372.00 TL</td>
                                            <td>1,637.00 TL</td>
                                        </tr>
                                        <tr>
                                            <td><b><a href="http://notgroup.s3.eu-west-3.amazonaws.com" target="_blank">notgroup.s3.eu-west-3.amazonaws.com</a></b></td>
                                            <td>2</td>

                                            <td>
                                                178.00 TL
                                                <br>
                                            </td>
                                            <td>178.00 TL</td>
                                            <td>178.00 TL</td>
                                            <td>0.00 TL</td>
                                        </tr>
                                        <tr>
                                            <td><b><a href="http://admin.roket.live" target="_blank">admin.roket.live</a></b></td>
                                            <td>1</td>

                                            <td>
                                                135.00 TL
                                                <br>
                                            </td>
                                            <td>15.00 TL</td>
                                            <td>135.00 TL</td>
                                            <td>120.00 TL</td>
                                        </tr>
                                    </tbody>
                                    <tfoot style="font-size: 15px">
                                        <tr>
                                            <td class="text-right text-uppercase"><b>Toplam</b></td>
                                            <td><b>326</b></td>

                                            <td></td>
                                            <td><b>5,083.00 TL</b></td>
                                            <td><b>34,847.00 TL</b></td>
                                            <td><b>29,764.00 TL</b></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                        <div class="card m-b-30">
                            <div class="card-header bg-primary text-white">
                                Kaynak
                            </div>
                            <div class="card-body1 table-responsive">
                                <table class="table table-striped table-hover table-bordered">
                                    <thead class="thead-default">
                                        <tr>
                                            <th>Kaynak</th>
                                            <th>Adet (Siparişler)</th>
                                            <th>Adet (Ürün)</th>
                                            <th>Maliyet (Kargo,Ürün) </th>
                                            <th>Toplam (Sipariş)</th>
                                            <th>Kar (TL)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template v-for="(citems, adsource) in _.groupBy(items, 'adsource')">
                                        <tr :key="adsource">
                                            <td class="text-right text-uppercase"><b>{{$root.clientInit.adsources[adsource].meta.name}}</b></td>
                                            <td>{{_.reduce(citems,(memo, obj) => memo + Number(obj.ordersCount), 0)}}</td>
                                            <td>{{_.reduce(citems,(memo, obj) => memo + Number(obj.productQuantity), 0)}}</td>
                                            <td>{{currencyFormat(_.reduce(citems,(memo, obj) => memo + obj.totalCost, 0))}}</td>
                                            <td>{{currencyFormat(_.reduce(citems,(memo, obj) => memo + obj.totalPrice, 0))}}</td>

                                            <td>{{currencyFormat(Number(_.reduce(citems,(memo, obj) => memo + obj.gain, 0)))}}</td>
                                        </tr>
                                        </template>

                                    </tbody>
                                    <tfoot style="font-size: 15px" class="hide">
                                        <tr>
                                            <td class="text-right text-uppercase"><b>Toplam</b></td>
                                            <td><b>326</b></td>
                                            <td></td>
                                            <td>Ort.: <b>106.89 TL</b></td>
                                            <td><b>5,083.00 TL</b></td>
                                            <td>--</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
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
    name: "SalesReport",
    data() {
        return {
            items:[],
            filter:{}
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
