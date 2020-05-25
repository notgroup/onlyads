<template>
<div class="content">
    <div class="container-fluid">
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4 class="page-title">Personel Cari Kart</h4>
                </div>
                <div class="col-sm-6">
                    <button @click="addContent(item)" class="btn btn-primary rounded btn-custom waves-effect waves-light float-right">Kaydet</button>
                </div>
            </div>
        </div>
        {{item}}
        <div class="row">
            <div class="col-md-2  align-items-center text-white">
                <button class="btn btn-block btn-primary" @click="currentTab = 'edit'">Düzenleme</button>
                <button v-if="cardId > 0" class="btn btn-block btn-primary" @click="currentTab = 'vacation'">İzinler</button>
                <button v-if="cardId > 0" class="btn btn-block btn-primary" @click="currentTab = 'payEvent'">Ödeme Geçmişi</button>
                <button v-if="cardId > 0" class="btn btn-block btn-primary" @click="currentTab = 'report'">Raporlar</button>
            </div>
            <div class="col-md-10">

                <div class="row" v-if="currentTab == 'edit'">

                    <div class="col-lg-6">

                        <div class="card m-b-30">
                            <div class="card-header bg-primary text-white">
                                Personel Cari Bilgileri
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="input-quantity" class="control-label">Aylık Düzenli Ödeme ?</label>
                                    <div class="">
                                        <select class="form-control" id="input-status" v-model="item.isMonthlyPay" name="isMonthlyPay">
                                            <option value="1">Var</option>
                                            <option value="0">Yok</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="input-name" class="control-label">Aylık Ücret</label>
                                    <div class="">
                                        <input id="input-name" class="form-control" placeholder="" v-model="item.monthlyPay" name="monthlyPay" type="number">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="input-quantity" class="control-label">Çalışma Durumu</label>
                                    <div class="">
                                        <select class="form-control" id="input-status" v-model="item.status" name="status">
                                            <option value="active">Aktif</option>
                                            <option value="vacation">İzinde</option>
                                            <option value="leaving">Ayrıldı</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="input-name" class="control-label">İşe Başlama Tarihi</label>
                                    <div class="">
                                        <input id="input-name" class="form-control" placeholder="Başlama Tarihi" v-model="item.startDate" name="startDate" type="date">
                                    </div>
                                </div>
                                <div class="form-group" v-if="item.status == 'leaving'">
                                    <label for="input-name" class="control-label">Ayrılış Tarihi (Çalışma durumu ayrıldı ise gösterilecek)</label>
                                    <div class="">
                                        <input id="input-name" class="form-control" placeholder="Ayrılış Tarihi" v-model="item.leavingDate" name="leavingDate" type="date">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="input-quantity" class="control-label">Departman</label>
                                    <div class="">
                                        <select class="form-control" id="input-status" v-model="item.departmentType" name="department">
                                            <template v-for="(department, arri) in $root.clientInit.accountingProperties.departmentType">
                                                <option :value="department.id">{{department.value}} </option>
                                            </template>
                                           
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">

                        <div class="card m-b-30">
                            <div class="card-header bg-primary text-white">
                                Personel Detayları
                            </div>
                            <div class="card-body">
                                                                <div class="form-group">
                                    <label for="input-description" class="control-label">Ad Soyad</label>
                                    <div class="">
                                        <input id="input-description" class="form-control" placeholder="Ad Soyad" v-model="item.fullName" name="fullName" type="text">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="input-name" class="control-label">TC NO</label>
                                    <div class="">
                                        <input id="input-name" class="form-control" placeholder="TCNO" v-model="item.inumber" name="inumber" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="input-name" class="control-label">Şehir</label>
                                    <div class="">
                                        <input id="input-name" class="form-control" placeholder="Şehir" v-model="item.sehir" name="sehir" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="input-name" class="control-label">İlçe</label>
                                    <div class="">
                                        <input id="input-name" class="form-control" placeholder="İlçe" v-model="item.ilce" name="ilce" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="input-name" class="control-label">Adres</label>
                                    <div class="">
                                  <textarea required="" class="form-control" rows="5" name="adress" v-model="item.adress"></textarea>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="input-name" class="control-label">Telefon</label>
                                    <div class="">
                                        <input id="input-name" class="form-control" placeholder="055**" v-model="item.phone" name="phone" type="number">
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>

                </div>

                <div class="row" v-if="currentTab == 'payEvent'">
                    <div class="col-md-12">
                        <div class="card m-b-30">
                            <div class="card-header bg-primary text-white" style="line-height: 30px;">
                                İşlem Geçmişi
                                <div role="group" aria-label="Basic example" class="btn-group  float-right rounded">
                                    <button class="btn bg-white">İşlem Ekle</button>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped table-bordered  mb-0 table-hover nowrap display" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead class="thead-default">
                                        <tr>
                                            <th width="1%">ID</th>
                                            <th>İşlem Türü</th>
                                            <th>İşlem Kategori</th>
                                            <th>Miktar</th>
                                            <th>Tarih</th>
                                            <th width="1%">İşlem</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item, itemi) in history">
                                            <td>{{itemi}}</td>
                                            <td>{{item.actionType}}</td>
                                            <td>{{item.spendType}}</td>
                                            <td>{{item.price}} .TL</td>
                                            <td>{{item.startDate}}</td>

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

                <div class="row" v-if="currentTab == 'vacation'">
                    <div class="col-md-12">
                        <div class="card m-b-30">
                            <div class="card-header bg-primary text-white" style="line-height: 30px;">
                                İzin Geçmişi
                                <div role="group" aria-label="Basic example" class="btn-group  float-right rounded">
                                    <button class="btn bg-white">İzin Ekle</button>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped table-bordered  mb-0 table-hover nowrap display" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead class="thead-default">
                                        <tr>
                                            <th width="1%">ID</th>
                                            <th>Gerekçe</th>
                                            <th>Çıkış Tarihi</th>
                                            <th>Dönüş Tarihi</th>
                                            <th>Kalan Süre</th>
                                            <th>İzin Türü</th>
                                            <th width="1%">İşlem</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item, itemi) in 0">
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
        </div>

    </div>

</div>
</div>
</template>

<script>
module.exports = {
    name: "PersonalCard",
    props: ['cardId'],
    data() {
        return {
            currentTab: 'edit',
            item: {},
            history: [],
        };
    },
    computed: {},
    mounted() {
        if (this.cardId > 0) {
            this.getCard(this.cardId);
        }
    },
    beforeCreate() {},
    created() {},
    methods: {
        addContent(data = {}, contenttypeid = 42) {
            data.accountType = 'personal';

            let postData = {
                entity_status: 'pending',
                meta: data
            }
            this.post(window.apiUrl + "/addAccountCard", postData.meta, (res) => {
                console.log(res)
            })
        },
        addContent2(data = {}, contenttypeid = 42) {
            data.accountType = 'personal';

            let postData = {
                entity_status: 'pending',
                meta: data
            }
            this.post(window.apiUrl + "/addContent/" + contenttypeid, postData, (res) => {
                console.log(res)
            })
        },
        addUser(item = {}) {
            this.post(window.apiUrl + "/addUser", item, (res) => {
                if (item.id) {
                    alertify.success("Kullanıcı bilgilerini güncellediniz.");
                } else {
                    alertify.success("Yeni kullanıcı eklendi.");
                }
                this.item = res
                console.log(res)
            })
        },
        getCard(cardId) {
            this.get(window.apiUrl + "/getAccountCard/" + cardId, (res) => {
                this.item = res.card;
                this.history = res.history;
                console.log(res);

            })
        }
    }
}
</script>

<style>
</style>
