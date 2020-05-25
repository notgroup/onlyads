<template>
<div class="content">
    <div class="container-fluid">
                <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4 class="page-title">Hesp Eşleştirme</h4>
                </div>
                <div class="col-sm-6 hide">
                    <button class="btn btn-primary rounded btn-custom waves-effect waves-light float-right">Eşleştir</button>
                </div>
            </div>
        </div>
<div class="row">

    <div class="col-xl-12">

            <div class="card">
            <div class="row p-3">
                <div class="col-lg-6">
                    <div class="btn-group">

                        <button class="btn btn-primary" @click="selecteds = Array.from(_.pluck(items, 'account_id')).map(item => Number(item))">Hepsini Seç</button>
                        <button v-if="selecteds.length" class="btn btn-primary" @click="selecteds = []">Kaldır </button>
                    </div>

                    <div class="btn-group" v-if="selecteds.length">
                        <select class="btn btn-primary form-control text-white" v-model="actionValue" @change="setProductToAds(selecteds, actionValue)">
                            <option value="0" selected="selected">Ürün Seç</option>
                                <template v-for="(item, itemi) in productsGroup">
                                    <option :key="itemi" :value="item.content_id">{{item.meta.name}}</option>
                                </template>
                        </select>
                    </div>

                        <button class="btn btn-primary" @click="emptyItems()">Boş Olanlar</button>
                        <button class="btn btn-primary" @click="items = totalitems, selecteds=[]">Sıfırla</button>
                    <label v-if="selecteds.length" style="padding-top: 7px;padding-left: 10px;"> {{selecteds.length}} seçilen</label>


                </div>

                <div class="col-lg-6">
                        <div class="form-group mb-0  float-lg-right">
                            <input type="text" name="queryText" class="form-control rounded" placeholder="ara.." v-model="filter.query" @change="searchQuery()" >
                        </div>

                </div>

            </div>
            <div id="tablebody" class="card-body p-0" style="max-height: 75vh;overflow-y: auto;">
                <table class="table table-striped table-bordered  mb-0 table-hover nowrap display" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead class="thead-default">
                        <tr>
                            <th  width="20%">Hesap Adı</th>
                            <th>Ürün</th>
                            <th>Ortak BM ID</th>
                            <th >Ortak Bm Adı</th>
                            <th width="1%">Index</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, itemi) in _.sortBy(items,'account_name')">
                            <td :key="itemi">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="selected" :id="'customCheck'+itemi" @click="selecteds.includes(item.account_id) ? selecteds = _.without(selecteds, item.account_id) : selecteds.push(item.account_id)" :checked="selecteds.includes(item.account_id)">
                                    <label class="custom-control-label" :for="'customCheck'+itemi">{{item.account_name}}</label>
                                </div>
                            </td>
    
                            <td>{{item.product_id ? productsGroup[item.product_id].meta.name : ''}}</td>
                            <td>{{item.business_id}}</td>
                            <td>{{item.business_name}}</td>
                            <td>{{itemi}}.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            </div>
    </div>

</div>
</div>
</div>
</template>

<script>
var todayDate = new Date().toLocaleDateString().split('.').reverse().join('-');
module.exports = {
    name: "AdProductAds",
    props: ["bmId", "typeId"],
    data() {
        return {
                        totalitems: [],
            actionValue: 0,
            rawData: {},
            statusColors: {
                "confirmed": "success",
                "pending": "warning",
            },
            filter: {
                content_type: this.typeId,
                status: 'pending',
                payment_method: 0,
                city: 0,
                endDate: todayDate,
                page: 1,
                query:"",
            },
            facets: [],
            refreshing: false,
            items: [],
            selecteds: [],
            currentSettings: {
                autoload: ''
            },
            productsGroup: {}
        };
    },
    computed: {
    },
    mounted() {},
    beforeCreate() {},
    created() {
                this.productsGroup = _.indexBy(this.$root.clientInit.productsGroup, 'content_id')
        this.getAdAccounts();
    },
    methods: {
        searchQuery(){
     
            this.items = this.totalitems.filter((item) => {
                return item.account_name.toLocaleLowerCase('tr').search(this.filter.query) != -1
                })
        },
        emptyItems(){
     
            this.items = this.totalitems.filter((item) => {
                return !item.product_id
                })
                this.selecteds=[]
        },
        setProductToAds(selecteds, product_id) {
  
              alertify.okBtn("Tamam")
                    .cancelBtn("Vazgeç")
                    .defaultValue("")

                    .confirm("Seçili hesaplar ürüne atanacak?", (ev) => {
                       this.changeProductAds(selecteds, product_id)

                    }, (ev) => {
                        ev.preventDefault();
                        // alertify.error("Vazgeçtiniz");
                    });
  

        },
        changeProductAds(selecteds, product_id) {

            this.post(window.apiUrl + "/setChangeProductAds/" + product_id, {
                selecteds: selecteds,
                product_id: product_id
            }, (res) => {

 
                this.getAdAccounts()
                alertify.success("Reklam eşleştirme başarılı..");
                this.selecteds = []
            })

        },
        addSetting() {
            this.post(window.apiUrl + "/addSetting", this.currentSettings, (res) => {
                this.currentSettings = {}
                this.settings = res
            })
        },
        getAdAccounts() {
            this.get(window.apiUrl + "/getAddAccounts/" + this.bmId, (res) => {
                console.log(res);
                this.items = res.map((item) => {
                    item.account_id = Number(item.account_id)
                    return item
                })
            this.totalitems =  this.items;
               // document.getElementById("tablebody").scrollTop = 0
            })
        },
        getData() {
            this.get(window.apiUrl + "/contents" + this.$root.getString({
                page: this.filter.page,
                filter: this.filter
            }), (res) => {


                this.items = res.data;
                console.log()
               // document.getElementById("tablebody").scrollTop = 0
            })
        },
        fetchOrder() {
            this.get(window.apiUrl + "/fetchOrder", (res) => {
                let item = res
                this.$router.push('/ContenDetail/' + item.entity_type_id + '/' + item.content_id)
            });
        },
        getExcell(shipment = {}) {
            alertify.log("Aktarma dosyası hazırlanıyor.");
            this.get(window.apiUrl + "/contents" + this.$root.getString({
                shipment_id: shipment.content_id,
                page: this.filter.page,
                selecteds: this.selecteds,
                filter: Object.assign({
                    download: 1
                }, this.filter)
            }), (res) => {
                let basename = res.url.replace(/.*\//, '');
                let dirname = res.url.match(/.*\//);
                this.$root.linkDownload(res.url, todayDate + shipment.meta.name + '.xlsx')
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
