<template>
<div class="content">
    <div class="container-fluid">
        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4 class="page-title">Ç.M İşlemleri</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);">AnaSayfa</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Ç.M İşlemleri
                        </li>
                    </ol>
                </div>
            </div>
            <!-- end row -->
        </div>

        <div class="row" v-if="getFilter">
            <div class="col-xl-12">
                <div class="email-leftbar card" @click="filter.page = 1">
            <div class="form-group row ">
                <label class="col-sm-12 col-form-label">Agent Actions</label>
                <div class="col-sm-12">
                    <div class="mail-list m-t-10" style="max-height: 280px;overflow-y: auto;">
                            <a href="javascript:;" @click="filter.agentStatus = 0">
                                <span class="mdi mdi-label-outline text-default mr-2"></span>
                                Hepsi
                            </a>
                        <template v-for="(item, itemi) in facetsAgentAction">
                            <a :key="itemi" href="javascript:;" @click="filter.agentStatus = itemi">
                                <span class="mdi mdi-label-outline text-default mr-2"></span>
                                {{_.indexBy($root.clientInit.agentActions, 'option')[itemi].value}} (<b>{{item || 0}}</b>)
                            </a>
                        </template>

                    </div>
                </div>
            </div>
            <div class="form-group row hide">
                <label class="col-sm-12 col-form-label">Kargo Durumu</label>
                <div class="col-sm-12">
                    <div class="mail-list m-t-10" style="max-height: 280px;overflow-y: auto;">

                        <template v-for="(item, itemi) in facetsCargoStatus">
                            <a v-if="[1,2,3,4,5,6,0].includes(Number(itemi))" :key="itemi" href="javascript:;"  @click="filter.cargoStatus = itemi">
                                <span class="mdi mdi-label-outline text-default mr-2"></span>
                                {{cargoStatusTypes[itemi]}} (<b>{{item || 0}}</b>)
                            </a>
                        </template>

                    </div>
                </div>
            </div>
                    <div class="form-group row hide">
                        <label class="col-sm-12 col-form-label">Durumu</label>
                        <div class="col-sm-12">
                            <select class="form-control adstatus-selector multiselector" v-model="filter.cargoStatus">
                                <option value="-1" selected>Hepsi</option>
                                <template v-for="(item, itemi) in cargoStatusTypes">
                                    <option :key="itemi" :value="itemi">{{item}} </option>
                                </template>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-form-label">Sehir</label>
                        <div class="col-sm-12">
                            <select class="form-control adstatus-selector multiselector" v-model="filter.city">
                                <option value="0" selected>Hepsi</option>
                                <template v-for="(item, itemi) in _.groupBy($root.clientInit.cities,'country_id')[215]">
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
                    <div>
                                    <div class="row p-3">
                <div class="col-lg-6">
                    <div class="btn-group hide">
                        <button class="btn btn-primary">Hepsini Seç</button>
                    </div>

 
                    <div class="btn-group ml-1 mo-mb-2">
                        <button type="button" class="btn btn-primary waves-light waves-effect dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-download"></i> Dışa Aktar
                        </button>
                        <div class="dropdown-menu">
                 

                        </div>
                    </div>
              

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
                                    <th>A.Adı</th>
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
                                <tr v-for="(item, itemi) in items" v-if="item.meta.cargoDetail">
                                    <td @click="getCargoDetail(item)">{{ item.meta.cargoDetail.gonderino }}</td>
                                    <td @click="getCargoDetail(item)">{{ item.meta.cargoDetail.sipno }}</td>
                                    <td>{{ cargoStatusTypes[item.meta.cargoDetail.durum] }}</td>
                                    <td>{{ item.meta.cargoDetail.aliciadi }}
                                        <span v-if="item.meta.agentStatus" class="badge badge-primary" style="display: inherit;">
                                            {{_.indexBy($root.clientInit.agentActions, 'option')[item.meta.agentStatus].value}}
                                        </span>
                                    </td>
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
                                            <button class="btn btn-primary waves-effect waves-light" @click="getCargoModal(item)">
                                                <i class="far fa-eye"></i>
                                            </button>
                                            <button class="btn btn-primary waves-effect waves-light" @click="$router.push('/ContenDetail/' + item.entity_type_id + '/' +item.content_id)">
                                                <i class="far fa-edit"></i>
                                            </button>
                                            <button class="btn btn-primary waves-effect waves-light" @click="$root.getCargoDetail(item)">
                                                <i class="fa fa-truck"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
            </div>
                        <hr class="m-t-10 m-b-20" />
                    </div>
                </div>
            </div>
        </div>

    </div>
    <cargo-detail-modal v-if="currentCargoDetail && currentCargoDetail.meta" v-on:closemodal="(res) => {currentCargoDetail = 0, getData()}" :cargo-detail="currentCargoDetail"></cargo-detail-modal>
</div>
</template>

<script>
var todayDate = new Date().toLocaleDateString().split('.').reverse().join('-');
var CargoDetailModal = httpVueLoader('/vue/components/part/CargoDetailModal.vue');
module.exports = {
    name: "CargoTracking",
    components:{CargoDetailModal},
    props: ["typeId"],
    data() {
        return {
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

        //this.getData();
    },
    beforeCreate() {},
    created() {},
    methods: {
        getData() {
            this.refreshing = true;
            this.get(window.apiUrl + "/CargoTracking" + this.$root.getString(this.filter), (res) => {
                this.items = res.data;
                this.facetsCargoStatus = res.facetsCargoStatus;
                this.facetsAgentAction = res.facetsAgentAction;
                this.refreshing = false;
                this.rawData= res;
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
</style>
