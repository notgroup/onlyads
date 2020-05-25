<template>
<div class="content">
    <div class="container-fluid">
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4 class="page-title">Ürün Grubu</h4>
                </div>
                <div class="col-sm-6">
                    <div class="btn-group  float-right rounded" role="group" aria-label="Basic example">

                        <button @click="addContent(item, contenttypeid)" class="btn btn-primary">Kaydet</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-lg-4">

                <div class="card m-b-30">
                    <div class="card-header bg-primary text-white">
                        Ürün Grubu Detayları
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label for="input-status" class=" control-label">Durum</label>
                            <div class="">
                                <select class="form-control" id="input-status" v-model="item.entity_status" name="status">
                                    <option value="active">Aktif</option>
                                    <option value="passive">Pasif</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-description" class=" control-label">Açıklama</label>
                            <div class="">
                                <input id="input-description" class="form-control" placeholder="Açıklama" v-model="item.meta.description" name="description" type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-name" class=" control-label">İsim</label>
                            <div class="">
                                <input id="input-name" class="form-control" placeholder="İsim" v-model="item.meta.name" name="name" type="text">
                            </div>
                        </div>
                        <div class="form-group hide">
                            <label for="input-quantity" class=" control-label">Stok Adet</label>
                            <div class="">
                                <input id="input-quantity" class="form-control" placeholder="Stok Adet" v-model="item.meta.quantity" name="quantity" type="number">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-sku" class=" control-label">Ürün Kodu</label>
                            <div class="">
                                <input id="input-sku" class="form-control" placeholder="Ürün Kodu" v-model="item.meta.sku" name="sku" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-sku" class=" control-label">Adet Maliyeti</label>
                            <div class="">
                                <input id="input-sku" class="form-control" placeholder="Adet Maliyeti" v-model="item.meta.cost" name="cost" type="number">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-status" class=" control-label">SMS Görevi</label>
                            <div class="">
                                <select class="form-control" id="input-status" v-model="item.meta.sms" name="sms">
                                    <option value="active">Aktif</option>
                                    <option value="passive">Pasif</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card m-b-30">
                            <div class="card-header bg-primary text-white">
                                Ürün Yerleri
                            </div>
                            <div class="card-body">
                                <table class="table table-striped table-bordered  mb-0 table-hover nowrap display" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead class="thead-default">
                                        <tr>

                                            <th>Konum</th>
                                            <th>Adet</th>
                                            <th>Tarih</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Depoda</td>
                                            <td>100</td>
                                            <td>2020-05-17</td>
                                        </tr>
                                        <tr>
                                            <td>Dağıtımda</td>
                                            <td>100</td>
                                            <td>2020-05-17</td>
                                        </tr>
                                        <tr>
                                            <td>Paketleme</td>
                                            <td>100</td>
                                            <td>2020-05-17</td>
                                        </tr>
                                        <tr>
                                            <td>İade</td>
                                            <td>100</td>
                                            <td>2020-05-17</td>
                                        </tr>
                                        <tr>
                                            <td>Kargoda</td>
                                            <td>100</td>
                                            <td>2020-05-17</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-12">
                <div class="card m-b-30">
                    <div class="card-header bg-primary text-white" style="line-height: 30px;">
                        İşlem Geçmişi
                        <div role="group" aria-label="Basic example" class="btn-group  float-right rounded">
                            <button class="btn bg-white">Stok İşlemi</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered  mb-0 table-hover nowrap display" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead class="thead-default">
                                <tr>
                                    <th width="1%">ID</th>
                                    <th>Tedarik Firması</th>
                                    <th>Gelen</th>
                                    <th>Giden</th>
                                    <th>Stok</th>
                                    <th>Tarih</th>
                                    <th width="1%">İşlem</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, itemi) in 10">
                                    <td>{{itemi}}</td>
                                    <td>Bilge İlaç</td>
                                    <td>300</td>
                                    <td>0</td>
                                    <td>300</td>
                                    <td>2020-05-17</td>

                                    <td>
                                        <div class="btn-group btn-group">

                                            <button class="btn btn-primary waves-effect waves-light">
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
    </div>
</template>

<script>
module.exports = {
    name: "AddProductGroup",
    props: ['primaryid', 'contenttypeid'],
    data() {
        return {
            item: {
                meta: {}
            },
        };
    },
    computed: {},
    mounted() {
        if (this.primaryid) {
            this.getData(this.primaryid);
        }
    },
    beforeCreate() {},
    created() {},
    methods: {
        addContent(item = {}, contenttypeid = 0) {
            this.post(window.apiUrl + "/addContent/" + contenttypeid, this.item, (res) => {
                console.log(res)
            })
        },
        getData(primaryid) {
            this.get(window.apiUrl + "/content/" + primaryid, (res) => {
                this.item = res;
                console.log(res);

            })
        }
    }
}
</script>

<style>
</style>
