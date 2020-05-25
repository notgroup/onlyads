<template>
<div class="content">
    <div class="container-fluid">
        <!0 Page-Title 0>
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4 class="page-title">Teslimat Raporları Özet</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);">AnaSayfa</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Teslimat Raporları Özet
                        </li>
                    </ol>
                </div>
            </div>
            <!0 end row 0>
        </div>
        <div class="table-responsive">

            <table class="table table-striped table-hover" data-url="http://admin.roket.live/shipment/mini">
                <thead class="totalTable" style="">
                    <tr>
                        <th class="text-center">&nbsp;</th>
                        <th class="text-center thunknown"><a data-order-id="unknown" class="btn btn-sm btn-default set-cargo edit" data-toggle="modal" data-target="#new-size-form" title="Detay">Bilinmiyor</a></th>

                        <th class="text-center thpacking"><a data-order-id="packing" class="btn btn-sm btn-default set-cargo edit" data-toggle="modal" data-target="#new-size-form" title="Detay">Paketleme</a></th>

                        <th class="text-center thon_the_way"><a data-order-id="on_the_way" class="btn btn-sm btn-default set-cargo edit" data-toggle="modal" data-target="#new-size-form" title="Detay">Yolda</a></th>

                        <th class="text-center that_departure_unit"><a data-order-id="at_departure_unit" class="btn btn-sm btn-default set-cargo edit" data-toggle="modal" data-target="#new-size-form" title="Detay">Çıkış Şubesinde</a></th>

                        <th class="text-center that_arrival_unit"><a data-order-id="at_arrival_unit" class="btn btn-sm btn-default set-cargo edit" data-toggle="modal" data-target="#new-size-form" title="Detay">Teslimat Şubesinde</a></th>

                        <th class="text-center thmessage"><a data-order-id="message" class="btn btn-sm btn-default set-cargo edit" data-toggle="modal" data-target="#new-size-form" title="Detay">Uğrama Notlu</a></th>

                        <th class="text-center thredirected"><a data-order-id="redirected" class="btn btn-sm btn-default set-cargo edit" data-toggle="modal" data-target="#new-size-form" title="Detay">Yönlendirildi</a></th>

                        <th class="text-center thwrong_adress"><a data-order-id="wrong_adress" class="btn btn-sm btn-default set-cargo edit" data-toggle="modal" data-target="#new-size-form" title="Detay">Hatalı Adres</a></th>

                        <th class="text-center thproblem"><a data-order-id="problem" class="btn btn-sm btn-default set-cargo edit" data-toggle="modal" data-target="#new-size-form" title="Detay">Sorunlu</a></th>

                        <th class="text-center thon_delivery"><a data-order-id="on_delivery" class="btn btn-sm btn-default set-cargo edit" data-toggle="modal" data-target="#new-size-form" title="Detay">Teslimatta</a></th>

                        <th class="text-center thdelivered"><a data-order-id="delivered" class="btn btn-sm btn-default set-cargo edit" data-toggle="modal" data-target="#new-size-form" title="Detay">Teslim Edildi</a></th>

                        <th class="text-center threturning"><a data-order-id="returning" class="btn btn-sm btn-default set-cargo edit" data-toggle="modal" data-target="#new-size-form" title="Detay">İade Geliyor</a></th>

                        <th class="text-center threturned"><a data-order-id="returned" class="btn btn-sm btn-default set-cargo edit" data-toggle="modal" data-target="#new-size-form" title="Detay">İade</a></th>

                        <th class="text-center">Toplam</th>
                    </tr>
                </thead>
                <tbody class="totalTable" style="">
                    <tr>
                        <td class="text-center">&nbsp;</td>
                        <td class="text-center th2unknown">{{_.reduce(_.groupBy(reportsAll, 'shipmentStatus')['unknown'],(memo, obj) => memo + Number(obj.total), 0)}}</td>
                        <td class="text-center th2packing">{{_.reduce(_.groupBy(reportsAll, 'shipmentStatus')['packing'],(memo, obj) => memo + Number(obj.total), 0)}}</td>
                        <td class="text-center th2on_the_way">{{_.reduce(_.groupBy(reportsAll, 'shipmentStatus')['on_delivery'],(memo, obj) => memo + Number(obj.total), 0)}}</td>
                        <td class="text-center th2at_departure_unit">0</td>
                        <td class="text-center th2at_arrival_unit">0</td>
                        <td class="text-center th2message">{{_.reduce(_.groupBy(reportsAll, 'shipmentStatus')['message'],(memo, obj) => memo + Number(obj.total), 0)}}</td>
                        <td class="text-center th2redirected">0</td>
                        <td class="text-center th2wrong_adress">0</td>
                        <td class="text-center th2problem">{{_.reduce(_.groupBy(reportsAll, 'shipmentStatus')['problem'],(memo, obj) => memo + Number(obj.total), 0)}}</td>
                        <td class="text-center th2on_delivery">0</td>
                        <td class="text-center th2delivered">{{_.reduce(_.groupBy(reportsAll, 'shipmentStatus')['delivered'],(memo, obj) => memo + Number(obj.total), 0)}}</td>
                        <td class="text-center th2returning">0</td>
                        <td class="text-center th2returned">{{_.reduce(_.groupBy(reportsAll, 'shipmentStatus')['returned'],(memo, obj) => memo + Number(obj.total), 0)}}</td>
                        <td class="text-center">{{_.reduce(reportsAll,(memo, obj) => memo + Number(obj.total), 0)}}</td>
                    </tr>
                    <tr>
                        <td class="text-center">&nbsp;</td>
                        <td class="text-center th2unknown">%0</td>
                        <td class="text-center th2packing">%0</td>
                        <td class="text-center th2on_the_way">%0</td>
                        <td class="text-center th2at_departure_unit">%0</td>
                        <td class="text-center th2at_arrival_unit">%0</td>
                        <td class="text-center th2message">%0</td>
                        <td class="text-center th2redirected">%0</td>
                        <td class="text-center th2wrong_adress">%0</td>
                        <td class="text-center th2problem">%0</td>
                        <td class="text-center th2on_delivery">%0</td>
                        <td class="text-center th2delivered">%0</td>
                        <td class="text-center th2returning">%0</td>
                        <td class="text-center th2returned">%0</td>
                        <td class="text-center">%0</td>
                    </tr>
                    <tr>
                        <td class="text-center">&nbsp;</td>
                        <td class="text-center th2unknown">{{_.reduce(_.groupBy(reportsAll, 'shipmentStatus')['unknown'],(memo, obj) => memo + Number(obj.price), 0).toLocaleString('tr-TR', { style: 'currency', currency: 'TRY' })}}</td>
                        <td class="text-center th2packing">{{_.reduce(_.groupBy(reportsAll, 'shipmentStatus')['packing'],(memo, obj) => memo + Number(obj.price), 0).toLocaleString('tr-TR', { style: 'currency', currency: 'TRY' })}}</td>
                        <td class="text-center th2on_the_way">{{_.reduce(_.groupBy(reportsAll, 'shipmentStatus')['on_delivery'],(memo, obj) => memo + Number(obj.price), 0).toLocaleString('tr-TR', { style: 'currency', currency: 'TRY' })}}</td>
                        <td class="text-center th2at_departure_unit">₺0</td>
                        <td class="text-center th2at_arrival_unit">₺0</td>
                        <td class="text-center th2message">{{_.reduce(_.groupBy(reportsAll, 'shipmentStatus')['message'],(memo, obj) => memo + Number(obj.price), 0).toLocaleString('tr-TR', { style: 'currency', currency: 'TRY' })}}</td>
                        <td class="text-center th2redirected">₺0</td>
                        <td class="text-center th2wrong_adress">₺0</td>
                        <td class="text-center th2problem">{{_.reduce(_.groupBy(reportsAll, 'shipmentStatus')['problem'],(memo, obj) => memo + Number(obj.price), 0).toLocaleString('tr-TR', { style: 'currency', currency: 'TRY' })}}</td>
                        <td class="text-center th2on_delivery">₺0</td>
                        <td class="text-center th2delivered">{{_.reduce(_.groupBy(reportsAll, 'shipmentStatus')['delivered'],(memo, obj) => memo + Number(obj.price), 0).toLocaleString('tr-TR', { style: 'currency', currency: 'TRY' })}}</td>
                        <td class="text-center th2returning">₺0</td>
                        <td class="text-center th2returned">{{_.reduce(_.groupBy(reportsAll, 'shipmentStatus')['returned'],(memo, obj) => memo + Number(obj.price), 0).toLocaleString('tr-TR', { style: 'currency', currency: 'TRY' })}}</td>
                        <td class="text-center">{{_.reduce(reportsAll,(memo, obj) => memo + Number(obj.price), 0).toLocaleString('tr-TR', { style: 'currency', currency: 'TRY' })}}</td>
                    </tr>
                </tbody>

                <thead class="dateTable" style="">
                    <tr>
                        <th colspan="7" style="padding:0px;">
                            <hr>
                        </th>
                        <th align="center" style="text-align: center;padding: 10px;">Tarih</th>
                        <th colspan="99" style="padding:0px;">
                            <hr>
                        </th>
                    </tr>
                    <tr>
                    </tr>
                    <tr>
                        <th class="text-center">Tarih</th>
                        <th class="text-center thunknown">Bilinmiyor</th>
                        <th class="text-center thpacking">Paketleme</th>
                        <th class="text-center thon_the_way">Yolda</th>
                        <th class="text-center that_departure_unit">Çıkış Şubesinde</th>
                        <th class="text-center that_arrival_unit">Teslimat Şubesinde</th>
                        <th class="text-center thmessage">Uğrama Notlu</th>
                        <th class="text-center thredirected">Yönlendirildi</th>
                        <th class="text-center thwrong_adress">Hatalı Adres</th>
                        <th class="text-center thproblem">Sorunlu</th>
                        <th class="text-center thon_delivery">Teslimatta</th>
                        <th class="text-center thdelivered">Teslim Edildi</th>
                        <th class="text-center threturning">İade Geliyor</th>
                        <th class="text-center threturned">İade</th>
                        <th class="text-center">Toplam</th>
                        <th class="text-center">Toplam (TRY)</th>
                    </tr>
                </thead>
                <tbody class="dateTable" style="">
                    <template v-for="(dailyDetails, day) in _.groupBy(reportsAll, 'acceptDate')">
                        <tr>
                            <th class="text-center">{{day}}</th>
                            <td class="text-center th2unknown">
                                {{_.reduce(_.groupBy(dailyDetails, 'shipmentStatus')['unknown'],(memo, obj) => memo + Number(obj.total), 0)}}
                                (%0 )
                            </td>
                            <td class="text-center th2packing">
                                {{_.reduce(_.groupBy(dailyDetails, 'shipmentStatus')['packing'],(memo, obj) => memo + Number(obj.total), 0)}}
                                (%0 )
                            </td>
                            <td class="text-center th2on_the_way">
                                {{_.reduce(_.groupBy(dailyDetails, 'shipmentStatus')['on_delivery'],(memo, obj) => memo + Number(obj.total), 0)}}
                                (%0 )
                            </td>
                            <td class="text-center th2at_departure_unit">0
                            </td>
                            <td class="text-center th2at_arrival_unit">0
                            </td>
                            <td class="text-center th2message">
                                {{_.reduce(_.groupBy(dailyDetails, 'shipmentStatus')['message'],(memo, obj) => memo + Number(obj.total), 0)}}
                                (%0 )
                            </td>
                            <td class="text-center th2redirected">0
                            </td>
                            <td class="text-center th2wrong_adress">0
                            </td>
                            <td class="text-center th2problem">
                                {{_.reduce(_.groupBy(dailyDetails, 'shipmentStatus')['problem'],(memo, obj) => memo + Number(obj.total), 0)}}
                                (%0 )
                            </td>
                            <td class="text-center th2on_delivery">0
                            </td>
                            <td class="text-center th2delivered">
                                {{_.reduce(_.groupBy(dailyDetails, 'shipmentStatus')['delivered'],(memo, obj) => memo + Number(obj.total), 0)}}
                                (%0 )
                            </td>
                            <td class="text-center th2returning">0
                            </td>
                            <td class="text-center th2returned">
                                {{_.reduce(_.groupBy(dailyDetails, 'shipmentStatus')['returned'],(memo, obj) => memo + Number(obj.total), 0)}}
                                ( <b> %0 </b> )
                            </td>
                            <td class="text-center">{{_.reduce(dailyDetails,(memo, obj) => memo + Number(obj.total), 0)}}</td>
                            <td class="text-right">{{_.reduce(dailyDetails,(memo, obj) => memo + Number(obj.price), 0).toLocaleString('tr-TR', { style: 'currency', currency: 'TRY' })}}</td>
                        </tr>
                    </template>

                   
                </tbody>

                <thead class="productGroup" style="">
                    <tr>
                        <th colspan="7" style="padding:0px;">
                            <hr>
                        </th>
                        <th align="center" style="text-align: center;padding: 10px;">Ürün Grubu</th>
                        <th colspan="99" style="padding:0px;">
                            <hr>
                        </th>
                    </tr>
                    <tr>
                    </tr>
                    <tr>
                        <th class="text-center">Ürün Grubu</th>
                        <th class="text-center thunknown">Bilinmiyor</th>
                        <th class="text-center thpacking">Paketleme</th>
                        <th class="text-center thon_the_way">Yolda</th>
                        <th class="text-center that_departure_unit">Çıkış Şubesinde</th>
                        <th class="text-center that_arrival_unit">Teslimat Şubesinde</th>
                        <th class="text-center thmessage">Uğrama Notlu</th>
                        <th class="text-center thredirected">Yönlendirildi</th>
                        <th class="text-center thwrong_adress">Hatalı Adres</th>
                        <th class="text-center thproblem">Sorunlu</th>
                        <th class="text-center thon_delivery">Teslimatta</th>
                        <th class="text-center thdelivered">Teslim Edildi</th>
                        <th class="text-center threturning">İade Geliyor</th>
                        <th class="text-center threturned">İade</th>
                        <th class="text-center">Toplam</th>
                        <th class="text-center">Toplam (TRY)</th>
                    </tr>
                </thead>
                <tbody class="productGroup" style="">
                    <template v-for="(groupDetails, groupId) in _.groupBy(reportsAll, 'product_group_id')">
                    <tr>
                        <th class="text-center"><a href="javascript:;" target="_blank">{{_.indexBy($root.clientInit.productsGroup, 'content_id')[groupId].meta.name}}</a></th>
                        <td class="text-center th2unknown">
                                {{_.reduce(_.groupBy(groupDetails, 'shipmentStatus')['unknown'],(memo, obj) => memo + Number(obj.total), 0)}}
                                (%0 )
                            </td>
                            <td class="text-center th2packing">
                                {{_.reduce(_.groupBy(groupDetails, 'shipmentStatus')['packing'],(memo, obj) => memo + Number(obj.total), 0)}}
                                (%0 )
                            </td>
                            <td class="text-center th2on_the_way">
                                {{_.reduce(_.groupBy(groupDetails, 'shipmentStatus')['on_delivery'],(memo, obj) => memo + Number(obj.total), 0)}}
                                (%0 )
                            </td>
                            <td class="text-center th2at_departure_unit">0
                            </td>
                            <td class="text-center th2at_arrival_unit">0
                            </td>
                            <td class="text-center th2message">
                                {{_.reduce(_.groupBy(groupDetails, 'shipmentStatus')['message'],(memo, obj) => memo + Number(obj.total), 0)}}
                                (%0 )
                            </td>
                            <td class="text-center th2redirected">0
                            </td>
                            <td class="text-center th2wrong_adress">0
                            </td>
                            <td class="text-center th2problem">
                                {{_.reduce(_.groupBy(groupDetails, 'shipmentStatus')['problem'],(memo, obj) => memo + Number(obj.total), 0)}}
                                (%0 )
                            </td>
                            <td class="text-center th2on_delivery">0
                            </td>
                            <td class="text-center th2delivered">
                                {{_.reduce(_.groupBy(groupDetails, 'shipmentStatus')['delivered'],(memo, obj) => memo + Number(obj.total), 0)}}
                                (%0 )
                            </td>
                            <td class="text-center th2returning">0
                            </td>
                            <td class="text-center th2returned">
                                {{_.reduce(_.groupBy(groupDetails, 'shipmentStatus')['returned'],(memo, obj) => memo + Number(obj.total), 0)}}
                                ( <b> %0 </b> )
                            </td>
                            <td class="text-center">{{_.reduce(groupDetails,(memo, obj) => memo + Number(obj.total), 0)}}</td>
                            <td class="text-right">{{_.reduce(groupDetails,(memo, obj) => memo + Number(obj.price), 0).toLocaleString('tr-TR', { style: 'currency', currency: 'TRY' })}}</td>
                    </tr>
                      </template>
                </tbody>

                <thead class="productGroup" style="">
                    <tr>
                        <th colspan="7" style="padding:0px;">
                            <hr>
                        </th>
                        <th align="center" style="text-align: center;padding: 10px;">Kaynak Grubu</th>
                        <th colspan="99" style="padding:0px;">
                            <hr>
                        </th>
                    </tr>
                    <tr>
                    </tr>
                    <tr>
                        <th class="text-center">Kaynak Grubu</th>
                        <th class="text-center thunknown">Bilinmiyor</th>
                        <th class="text-center thpacking">Paketleme</th>
                        <th class="text-center thon_the_way">Yolda</th>
                        <th class="text-center that_departure_unit">Çıkış Şubesinde</th>
                        <th class="text-center that_arrival_unit">Teslimat Şubesinde</th>
                        <th class="text-center thmessage">Uğrama Notlu</th>
                        <th class="text-center thredirected">Yönlendirildi</th>
                        <th class="text-center thwrong_adress">Hatalı Adres</th>
                        <th class="text-center thproblem">Sorunlu</th>
                        <th class="text-center thon_delivery">Teslimatta</th>
                        <th class="text-center thdelivered">Teslim Edildi</th>
                        <th class="text-center threturning">İade Geliyor</th>
                        <th class="text-center threturned">İade</th>
                        <th class="text-center">Toplam</th>
                        <th class="text-center">Toplam (TRY)</th>
                    </tr>
                </thead>
                <tbody class="productGroup" style="">
                    <template v-for="(groupDetails, groupId) in _.groupBy(reportsAll, 'adsource')">
                    <tr>
                        <th class="text-center"><a href="javascript:;" target="_blank">{{_.indexBy($root.clientInit.adsources, 'content_id')[groupId].meta.name}}</a></th>
                                            <td class="text-center th2unknown">
                                {{_.reduce(_.groupBy(groupDetails, 'shipmentStatus')['unknown'],(memo, obj) => memo + Number(obj.total), 0)}}
                                (%0 )
                            </td>
                            <td class="text-center th2packing">
                                {{_.reduce(_.groupBy(groupDetails, 'shipmentStatus')['packing'],(memo, obj) => memo + Number(obj.total), 0)}}
                                (%0 )
                            </td>
                            <td class="text-center th2on_the_way">
                                {{_.reduce(_.groupBy(groupDetails, 'shipmentStatus')['on_delivery'],(memo, obj) => memo + Number(obj.total), 0)}}
                                (%0 )
                            </td>
                            <td class="text-center th2at_departure_unit">0
                            </td>
                            <td class="text-center th2at_arrival_unit">0
                            </td>
                            <td class="text-center th2message">
                                {{_.reduce(_.groupBy(groupDetails, 'shipmentStatus')['message'],(memo, obj) => memo + Number(obj.total), 0)}}
                                (%0 )
                            </td>
                            <td class="text-center th2redirected">0
                            </td>
                            <td class="text-center th2wrong_adress">0
                            </td>
                            <td class="text-center th2problem">
                                {{_.reduce(_.groupBy(groupDetails, 'shipmentStatus')['problem'],(memo, obj) => memo + Number(obj.total), 0)}}
                                (%0 )
                            </td>
                            <td class="text-center th2on_delivery">0
                            </td>
                            <td class="text-center th2delivered">
                                {{_.reduce(_.groupBy(groupDetails, 'shipmentStatus')['delivered'],(memo, obj) => memo + Number(obj.total), 0)}}
                                (%0 )
                            </td>
                            <td class="text-center th2returning">0
                            </td>
                            <td class="text-center th2returned">
                                {{_.reduce(_.groupBy(groupDetails, 'shipmentStatus')['returned'],(memo, obj) => memo + Number(obj.total), 0)}}
                                ( <b> %0 </b> )
                            </td>
                            <td class="text-center">{{_.reduce(groupDetails,(memo, obj) => memo + Number(obj.total), 0)}}</td>
                            <td class="text-right">{{_.reduce(groupDetails,(memo, obj) => memo + Number(obj.price), 0).toLocaleString('tr-TR', { style: 'currency', currency: 'TRY' })}}</td>
                    
                    </tr>
                    </template>
                   
                </tbody>

            </table>
        </div>
    </div>
</div>
</template>

<script>
var todayDate = new Date().toLocaleDateString().split('.').reverse().join('-');
var CargoDetailModal = httpVueLoader('/vue/components/part/CargoDetailModal.vue');
module.exports = {
    name: "CargoDeliveryReportMini",
    components: {
        CargoDetailModal
    },
    props: ["typeId"],
    data() {
        return {
            reportsAll: [],
            dailyReport: {},
            cargoStatusLangs: {
                0: "Paketleme",
                1: "Teslimler",
                2: "İadeler",
                3: "Haber Formları",
                4: "Dağıtımda",
                5: "Kayıp",
                6: "Sorunlu"
            },
            refreshing: false,
            currentCargoDetail: 0,
            rawData: {

            },
            facets: {

            },
            filter: {
                cargoStatus: '0',
                agentStatus: 'processless',
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
                "6": "Sorunlu"
            },
            facetsCargoStatus: {},
            facetsAgentAction: {},
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

        this.getMiniReport();
    },
    beforeCreate() {},
    created() {},
    methods: {
        getMiniReport() {

            this.get(window.apiUrl + "/CargoReport", (res) => {
                console.log(res);
               
                if (res.length) {
                    this.reportsAll = res
              
                }

            });
        },
        getData() {
            this.refreshing = true;
            this.get(window.apiUrl + "/CargoTracking" + this.$root.getString(this.filter), (res) => {
                this.items = res.data;
                this.facetsCargoStatus = res.facetsCargoStatus;
                this.facetsAgentAction = res.facetsAgentAction;
                this.refreshing = false;
                this.rawData = res;
            });
        },

        getCargoModal(order) {
            this.currentCargoDetail = 0;
            setTimeout(() => {
                this.currentCargoDetail = order
                console.log(this.currentCargoDetail);
            }, 600);

        },
    },
};
</script>

<style scoped>
.modal-lg,
.modal-xl {
    max-width: 1024px;
}

.modal-body.row .form-group.row {
    margin-bottom: 0;
}

.table th,
.table th {
    vertical-align: top !important;
}

.table td,
.table th {
    padding: 5px;
}

.table td,
.table th {
    padding: 5px;
    font-size: 12px;
}
</style>
