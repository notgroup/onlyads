<template>
<div class="row">

    <div class="col-xl-12" v-if="contentTypeId">
        <div class="email-leftbar card" @click="filter.page = 1">

            <div class="form-group row ">
                <label class="col-sm-12 col-form-label">Sipariş Durumu</label>
                <div class="col-sm-12">
                    <div class="mail-list m-t-10" style="max-height: 280px;overflow-y: auto;">

                        <template v-for="(item, itemi) in $root.clientInit.orderStatuses">
                            <a @click="filter.status = item.option" :key="itemi" v-if="facets[item.option]" href="javascript:;" >
                                <span class="mdi mdi-label-outline text-default mr-2" :class="[filter.status == item.option ? 'text-success' :'']"></span>
                                {{item.value}} (<b>{{facets[item.option] || 0}}</b>)
                            </a>
                        </template>

                    </div>
                </div>
            </div>

            <div class="form-group row hide">
                <label class="col-sm-12 col-form-label">Sipariş Durumu</label>
                <div class="col-sm-12">
                    <select class="form-control status-selector multiselector" multiple v-model="filter.status">
                        <option value="0" selected>Hepsi</option>
                        <template v-for="(item, itemi) in $root.clientInit.orderStatuses">
                            <option :key="itemi" :value="item.option">{{item.value}}</option>
                        </template>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-12 col-form-label">Ödeme Metodu</label>
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
                <i class="fas fa-sync mr-2" :class="[refreshing ? 'fa-spin' : '']"></i>
                Göster</button>
        </div>
        <div class="email-rightbar mb-3 card m-b-30">
            <div class="row p-3">
                <div class="col-lg-6">
                    <div class="btn-group">

                        <button class="btn btn-primary" @click="selecteds = Array.from(_.pluck(items, 'content_id')).map(item => Number(item))">Hepsini Seç</button>
                        <button v-if="selecteds.length" class="btn btn-primary" @click="selecteds = []">Kaldır </button>
                    </div>

                    <div class="btn-group" v-if="selecteds.length">
                        <select class="btn btn-primary form-control text-white" v-model="actionValue" @change="setChangeStatus(selecteds, actionValue)">
                            <option value="0" selected="selected">Toplu İşlemler</option>
                            <optgroup label="Standart İşlemler">
                                <template v-for="(item, itemi) in $root.clientInit.orderStatuses">
                                    <option :key="itemi" :value="item.option" v-if="item.option != 'shipped'">{{item.value}}</option>
                                </template>
                            </optgroup>
                            <optgroup label="Kargo İşlemleri">
                                <option value="shipped:deposer">Kargoya Verildi (Deposer)</option>
                            </optgroup>
                        </select>
                    </div>
                    <div class="btn-group ml-1 mo-mb-2">
                        <button type="button" class="btn btn-primary waves-light waves-effect dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-download"></i> Dışa Aktar
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="javascript:;" @click="getExcell('deposer')">Deposer XLSX</a>
                            <a class="dropdown-item hide" href="#">Aras Kargo CSV</a>
                            <a class="dropdown-item hide" href="#">MNG XML</a>
                        </div>
                    </div>
                    <label v-if="selecteds.length" style="
    padding-top: 7px;
    padding-left: 10px;
"> {{selecteds.length}} seçilen</label>

                    <form role="search" class="email-inbox hide">
                        <div class="form-group mb-0">
                            <input type="text" class="form-control rounded" placeholder="Search Your mail..">
                            <button type="submit"><i class="fa fa-search"></i></button>
                        </div>
                    </form>
                </div>

                <div class="col-lg-6">
                    <div class="btn-toolbar float-lg-right" role="toolbar">
                        <div class="btn-group mo-mb-2">
                            <button v-if="rawData.prev_page_url" @click="filter.page = filter.page - 1" type="button" class="btn btn-primary waves-light waves-effect"><i class="fas fa-chevron-left"></i></button>
                            <button type="button" class="btn btn-primary waves-light waves-effect">{{filter.page}}</button>
                            <button v-if="rawData.next_page_url" @click="filter.page =  filter.page + 1" type="button" class="btn btn-primary waves-light waves-effect"><i class="fas fa-chevron-right"></i></button>
                        </div>
                        <div class="btn-group ml-1 mo-mb-2 hide">
                            <button type="button" class="btn btn-primary waves-light waves-effect dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-folder"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Updates</a>
                                <a class="dropdown-item" href="#">Social</a>
                                <a class="dropdown-item" href="#">Team Manage</a>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <div id="tablebody" class="card-body p-0" style="max-height: 75vh;overflow-y: auto;">
                <table class="table table-striped table-bordered  mb-0 table-hover nowrap display" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead class="thead-default">
                        <tr>
                            <th width="1%">ID</th>
                            <th>İsim</th>
                            <th>Durum</th>
                            <th>Telefon</th>
                            <th>Tutar</th>
                            <th>Ö.Metodu</th>
                            <th>Şehir/İlçe</th>
                            <th width="1%">tarih</th>
                            <th width="1%">İşlem</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, itemi) in items" v-if="item.meta">
                            <td :key="itemi">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="selected" :id="'customCheck'+itemi" @click="selecteds.includes(item.content_id) ? selecteds = _.without(selecteds, item.content_id) : selecteds.push(item.content_id)" :checked="selecteds.includes(item.content_id)">
                                    <label class="custom-control-label" :for="'customCheck'+itemi">{{item.content_id}}</label>
                                </div>
                            </td>
                            <td @click="$router.push('/ContenDetail/' + item.entity_type_id + '/' +item.content_id)">{{(item.meta.fullname || item.meta.firstname || item.meta.title)}}</td>
                            <td>{{(_.indexBy($root.clientInit.orderStatuses,'option')[item.entity_status].value)}}</td>
                            <td>{{(item.meta.phone_number ? '*****.' + item.meta.phone_number.substr(item.meta.phone_number.length -4) : '')}}</td>
                            <td>{{(item.meta.finalPrice)}} .TL</td>
                            <td>{{(_.indexBy($root.clientInit.paymentMethods, 'content_id')[item.meta.payment_method].meta.name || item.meta.payment_method)}}</td>
                            <td>{{(_.indexBy($root.clientInit.cities, 'zone_id')[item.meta.city] ? _.indexBy($root.clientInit.cities, 'zone_id')[item.meta.city].name : item.meta.city)}}/{{(_.indexBy($root.clientInit.towns, 'town_id')[item.meta.town] ? _.indexBy($root.clientInit.towns, 'town_id')[item.meta.town].name : item.meta.town)}}</td>
                            <td>{{new Date(item.created_at).toLocaleString()}}</td>

                            <td>
                                <div class="btn-group btn-group">

                                    <button @click="$router.push('/ContenDetail/' + item.entity_type_id + '/' +item.content_id)" class="btn btn-primary waves-effect waves-light">
                                        <i class="far fa-eye"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
</template>

<script>
var todayDate = new Date().toLocaleDateString().split('.').reverse().join('-');
module.exports = {
    name: "ContentTypeList",
    props: ['typeId'],
    data() {
        return {
            actionValue: 0,
            rawData: {},
            statusColors: {
                "confirmed": "success",
                "pending": "warning",
            },
            filter: {
                content_type: this.typeId,
                status: 'confirmed',
                payment_method: 0,
                city: 0,
                endDate: todayDate,
                page: 1
            },
            facets: [],
            refreshing: false,
            items: [],
            selecteds: [],
            currentSettings: {
                autoload: ''
            }
        };
    },
    computed: {
        contentTypeId() {
            this.filter.content_type = this.typeId
            this.selecteds = []
            this.getData(this.typeId)
            return this.typeId
        }
    },
    mounted() {},
    beforeCreate() {},
    created() {},
    methods: {
        setChangeStatus(selecteds, status) {

            this.post(window.apiUrl + "/setChangeStatus/" + this.typeId, {
                selecteds: selecteds,
                status: status
            }, (res) => {

                this.selecteds = []
                this.getData()
                this.actionValue = 0
                    alertify.success("Toplu sipariş güncellemesi başarılı.");
            })

        },
        addSetting() {
            this.post(window.apiUrl + "/addSetting", this.currentSettings, (res) => {
                this.currentSettings = {}
                this.settings = res
            })
        },
        getData() {
            this.get(window.apiUrl + "/contents" + this.$root.getString({
                page: this.filter.page,
                filter: this.filter
            }), (res) => {

                this.items = res.data
                this.facets = res.facets
                this.rawData = res
                document.getElementById("tablebody").scrollTop = 0
            })
        },
        getExcell(fileName = 'defaultName') {
            alertify.log("Aktarma dosyası hazırlanıyor.");
            this.get(window.apiUrl + "/contents" + this.$root.getString({
                page: this.filter.page,
                selecteds: this.selecteds,
                filter: Object.assign({
                    download: 1
                }, this.filter)
            }), (res) => {
                let basename = res.url.replace(/.*\//, '');
                let dirname = res.url.match(/.*\//);
                this.$root.linkDownload(res.url, todayDate + fileName + '.xlsx')
                alertify.success("Aktarma dosyası hazırlandı.");
                console.log(res);

            })
        }
    }
}
</script>

<style scoped>
thead th {
    /* border-bottom-width: 2px; */
    /* background: white; */
    z-index: 99;
    border: 0;
    margin: 0;
    position: sticky;
    margin-top: -2px;
    top: -2px;
    /* border-top: 1px solid; */
    box-shadow: 0 2px 2px -1px rgba(0, 0, 0, 0.4);
}
</style>
