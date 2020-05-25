<template>
<div class="content">
    <div class="container-fluid">
        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4 class="page-title">StockActions</h4>
                </div>
                <div class="col-sm-6">
                    <a href="javascript:;" @click="addStockAction()" class="btn btn-primary rounded btn-custom waves-effect waves-light float-right">
                        <i class="fa fa-plus" style="margin-right:10px;"></i> İşlem Ekle</a>
                </div>
            </div>
            <!-- end row -->
        </div>

        <div class="row">
            <div class="col-md-2  align-items-center text-white">
                <button class="btn btn-block btn-primary" @click="currentTab = 'revenue'">Girdi</button>
                <button class="btn btn-block btn-primary" @click="currentTab = 'spend'">Çıktı</button>
                <button class="btn btn-block btn-primary" @click="currentTab = 'report'">Sevk</button>
                <button class="btn btn-block btn-primary" @click="currentTab = 'report'">Günlük Rapor</button>
            </div>
            <div class="col-md-10">

                <div class="row" v-if="currentTab == 'revenue'">
                    <div class="col-md-12">
                        <table class="table table-striped table-bordered  mb-0 table-hover nowrap display" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead class="thead-default">
                                <tr>
                                    <th width="1%">ID</th>
                                    <th>Aksiyon</th>
                                    <th>Ürün</th>
                                    <th>Kaynak</th>
                                    <th>Hedef</th>
                                    <th>Miktar/Adet</th>
                                    <th>İşlem Tarihi</th>
                                    <th width="1%">İşlem</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template v-for="(bm, bmi) in items">
                                    <tr :key="bmi">
                                    <td>{{bm.content_id}}</td>
                                        <td>{{bm.meta.actionType}}</td>
                                        <td>{{bm.meta.productGroup}}</td>
                                        <td>{{bm.meta.sourceDepository}}</td>
                                        <td>{{bm.meta.targetDepository}}</td>
                                        <td>{{bm.meta.count}}</td>
                                        <td>{{bm.meta.startDate}}</td>

                                        <td>
                                            <div class="btn-group btn-group">
                                                <button @click="$router.push('/PersonalCard/' + bmi)" class="btn btn-primary waves-effect waves-light">
                                                    <i class="far fa-eye"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </template>
                                <template v-if="1== 0" v-for="(bm, bmi) in items">
                                    <tr :key="bmi">
                                        <td>{{bmi}}</td>
                                        <td>{{accountingLabels[bm.actionType]}}</td>
                                        <td>{{accountingLabels[bm.status]}}</td>
                                        <td>{{_.indexBy($root.clientInit.accountingProperties.caseType, 'id')[bm.caseType].value}}</td>
                                        <td>{{_.indexBy($root.clientInit.accountingProperties.spendType, 'id')[bm.spendType].value }}</td>
                                        <td>{{bm.price}}</td>
                                        <td>{{bm.startDate}}</td>

                                        <td>
                                            <div class="btn-group btn-group">
                                                <button @click="$router.push('/PersonalCard/' + bmi)" class="btn btn-primary waves-effect waves-light">
                                                    <i class="far fa-eye"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                        <hr class="m-t-10 m-b-20" />
                    </div>

                </div>
                <div class="row" v-if="currentTab == 'report'">
                    <div class="col-md-12">
                        <table class="table table-striped table-bordered  mb-0 table-hover nowrap display" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead class="thead-default">
                                <tr>
                                    <th width="1%">ID</th>
                                    <th>Gün</th>
                                    <th>Aksiyon</th>
                                    <th>Kategori</th>
                                    <th>Toplam</th>
                                    <th>İşlem Sayısı</th>
                                    <th width="1%">İşlem</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template v-for="(bm, bmi) in reports">
                                    <tr :key="bmi">
                                        <td>{{bm.content_id}}</td>
                                        <td>{{bm.mate.actionType}}</td>
                                        <td>{{0}}</td>
                                        <td>{{0}}</td>
                                        <td>{{bm.meta.productGroup}}</td>
                                        <td>{{bm.meta.count}}</td>

                                        <td>
                                            <div class="btn-group btn-group">
                                                <button @click="$router.push('/PersonalCard/' + bmi)" class="btn btn-primary waves-effect waves-light">
                                                    <i class="far fa-eye"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                        <hr class="m-t-10 m-b-20" />
                    </div>

                </div>

            </div>
        </div>
        <div class="modal fade bs-example-modal-lg addBmModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="myLargeModalLabel">Stok İşlemi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <pre class="">
                        {{newBm}}
                        </pre>
                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="input-status" class="control-label">İşlem Türü</label>
                                    <div class="">
                                        <select class="form-control" id="input-status" v-model="newBm.actionType" name="actionType">
                                            <option value="entry">Girdi</option>
                                            <option value="exit">Çıktı</option>
                                            <option value="move">Sevk</option>
                                            <option value="update">Güncelleme</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="input-status" class="control-label">Kaynak Depo</label>
                                    <div class="">
                                        <input name="sourceDepository" v-model="newBm.sourceDepository" class="form-control" type="text" required="" placeholder="Kaynak Depo">

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="input-status" class="control-label">Hedef Depo</label>
                                    <div class="">
                                        <input name="targetDepository" v-model="newBm.targetDepository" class="form-control" type="text" required="" placeholder="Hedef Depo">

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="input-status" class="control-label" style="display: block;">
                                        Cari Listesi
                                        <div class="checkbox checkbox-primary float-right">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck1" v-model="newBm.isSource">
                                                <label class="custom-control-label" for="customCheck1"> Cari Ekle</label>
                                            </div>
                                        </div></label>
                                    <div class="">
                                        <select :disabled="!newBm.isSource" class="form-control" id="input-status" v-model="newBm.sourceId" name="status">
                                            <template v-for="(cardGroupArr, groupName) in _.groupBy($root.clientInit.accountCards, 'accountType')">
                                                <optgroup :label="groupName">
                                                    <template v-for="(card, cardId) in cardGroupArr">
                                                        <option :value="card.id">{{card.fullName}} | {{cardId}} </option>
                                                    </template>
                                                </optgroup>
                                            </template>
                                        </select>
                                    </div>
                                </div>

                                <button type="button" class="btn btn-primary btn-block waves-effect waves-light" @click="addStockActionPost()">Gönder</button>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group hide">
                                    <label for="input-status" class="control-label">Kasa Türü</label>
                                    <div class="">
                                        <select class="form-control" id="input-status" v-model="newBm.caseType" name="status">
                                            <template v-for="(caseType, arri) in $root.clientInit.accountingProperties.caseType">
                                                <option :value="caseType.id">{{caseType.value}} </option>
                                            </template>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="input-status" class="control-label">Ürün Grubu</label>
                                    <div class="">
                                        <select class="form-control" id="input-status" v-model="newBm.productGroup" name="productGroup">
                                            <template v-for="(caseType, arri) in $root.clientInit.productsGroup">
                                                <option :value="caseType.content_id">{{caseType.meta.name}} </option>
                                            </template>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Belge No</label>
                                    <div>
                                        <input name="documentNumber" v-model="newBm.documentNumber" class="form-control" type="text" required="" placeholder="Belge.No">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Miktar/Adet</label>
                                    <div>
                                        <input name="count" v-model="newBm.count" class="form-control" type="number" required="true">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="example-date-input" class="col-12 col-form-label">İşlem Tarihi</label>

                                    <div class="col-12">
                                        <input class="form-control" type="date" id="example-date-input" :max="newBm.endDate" v-model="newBm.startDate" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Açıklama</label>
                                    <div>
                                        <textarea required="" class="form-control" rows="5" name="description" v-model="newBm.description"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>
</div>
</template>

<script>
module.exports = {
    name: "StockActions",
    data() {
        return {
            items: [],
            reports: [],
            currentTab: "revenue",
            newBm: {},
            accountingLabels: {
                pending: 'Bekliyor',
                completed: 'Ödendi',
                spend: 'Para Çıkışı',
                revenue: 'Para Girişi'
            },
        };
    },
    computed: {},
    mounted() {},
    beforeCreate() {},
    created() {
      this.getData()
    },
    methods: {
        addStockAction() {
            $('.addBmModal').modal('show');
        },
        addStockActionPost() {
            //console.log(this.newBm);
            this.addContent(this.newBm, 44)

        },

        getData() {
            this.get(window.apiUrl + "/contents/" + 44, (res) => {
                this.items = res
                console.log(res)
            })
        },
        addContent(data = {}, contenttypeid = 44) {

            data.count = Number(data.count)
            data.depositoryId = 42
            let postData = {
                entity_status: 'publish',
                meta: data
            }
            this.post(window.apiUrl + "/addStockAction", postData, (res) => {
                console.log(res)
            })
        }
    },
};
</script>

<style></style>
