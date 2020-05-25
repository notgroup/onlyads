<template>
<div class="content">
    <div class="container-fluid">
        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4 class="page-title">Muhasebe Ayarları</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);">AnaSayfa</a>
                        </li>
                        <li class="breadcrumb-item active">Muhasebe Ayarları</li>
                    </ol>
                </div>
            </div>
            <!-- end row -->
        </div>
        <div class="row">
            <div class="col-md-2  align-items-center text-white">
                <button class="btn btn-block btn-primary" @click="currentEditType = 'case'">Kasa Türleri</button>
                <button class="btn btn-block btn-primary" @click="currentEditType = 'department'">Departmanlar</button>
                <button class="btn btn-block btn-primary" @click="currentEditType = 'spend'">Gider Kategorileri</button>
                <button class="btn btn-block btn-primary" @click="currentEditType = 'revenue'">Gelir Kategorileri</button>
            </div>
            <div class="col-md-10">

                <div class="row" v-if="currentEditType == 'case'">
                    <div class="col-md-5">

                        <div class="card m-b-30">
                            <div class="card-header bg-primary text-white">
                                Yeni Kasa Ekle
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
                                    <label for="input-name" class=" control-label">İsim</label>
                                    <div class="">
                                        <input id="input-name" class="form-control" placeholder="İsim" v-model="item.name" name="name" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="input-description" class=" control-label">Açıklama</label>
                                    <div class="">
                                        <input id="input-description" class="form-control" placeholder="Açıklama" v-model="item.description" name="description" type="text">
                                    </div>
                                </div>
                                <div role="group" aria-label="Basic example" class="btn-group  float-right rounded">
                                    <button class="btn btn-primary">Ekle</button>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-7">
                        <div class="card m-b-30">
                            <div class="card-header bg-primary text-white" style="line-height: 30px;">
                                Mevcut Kasalar

                            </div>
                            <div class="card-body">
                                <table class="table table-striped table-bordered  mb-0 table-hover nowrap display" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead class="thead-default">
                                        <tr>
                                            <th width="1%">ID</th>
                                            <th>İsim</th>
                                            <th width="1%">İşlem</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item, itemi) in 4">
                                            <td>{{itemi}}</td>
                                            <td>Ana Kasa</td>

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
                <div class="row" v-if="currentEditType == 'department'">
                    <div class="col-md-5">

                        <div class="card m-b-30">
                            <div class="card-header bg-primary text-white">
                                Yeni Departman Ekle
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
                                    <label for="input-name" class=" control-label">İsim</label>
                                    <div class="">
                                        <input id="input-name" class="form-control" placeholder="İsim" v-model="item.name" name="name" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="input-description" class=" control-label">Açıklama</label>
                                    <div class="">
                                        <input id="input-description" class="form-control" placeholder="Açıklama" v-model="item.description" name="description" type="text">
                                    </div>
                                </div>
                                <div role="group" aria-label="Basic example" class="btn-group  float-right rounded">
                                    <button class="btn btn-primary">Ekle</button>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-7">
                        <div class="card m-b-30">
                            <div class="card-header bg-primary text-white" style="line-height: 30px;">
                                Mevcut Departmanlar
                            </div>
                            <div class="card-body">
                                <table class="table table-striped table-bordered  mb-0 table-hover nowrap display" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead class="thead-default">
                                        <tr>
                                            <th width="1%">ID</th>
                                            <th>İsim</th>
                                            <th width="1%">İşlem</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item, itemi) in 4">
                                            <td>{{itemi}}</td>
                                            <td>Temsilci</td>

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
                <div class="row" v-if="currentEditType == 'spend'">
                    <div class="col-md-5">

                        <div class="card m-b-30">
                            <div class="card-header bg-primary text-white">
                                Yeni Gider Türü
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
                                    <label for="input-name" class=" control-label">İsim</label>
                                    <div class="">
                                        <input id="input-name" class="form-control" placeholder="İsim" v-model="item.name" name="name" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="input-description" class=" control-label">Açıklama</label>
                                    <div class="">
                                        <input id="input-description" class="form-control" placeholder="Açıklama" v-model="item.description" name="description" type="text">
                                    </div>
                                </div>
                                <div role="group" aria-label="Basic example" class="btn-group  float-right rounded">
                                    <button class="btn btn-primary">Ekle</button>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-7">
                        <div class="card m-b-30">
                            <div class="card-header bg-primary text-white" style="line-height: 30px;">
                                Mevcut Gider Türleri
                            </div>
                            <div class="card-body">
                                <table class="table table-striped table-bordered  mb-0 table-hover nowrap display" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead class="thead-default">
                                        <tr>
                                            <th width="1%">ID</th>
                                            <th>İsim</th>
                                            <th width="1%">İşlem</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item, itemi) in 4">
                                            <td>{{itemi}}</td>
                                            <td>Mutfak Harcaması</td>

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
                <div class="row" v-if="currentEditType == 'revenue'">
                    <div class="col-md-5">

                        <div class="card m-b-30">
                            <div class="card-header bg-primary text-white">
                                Yeni Gelir Türü
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
                                    <label for="input-name" class=" control-label">İsim</label>
                                    <div class="">
                                        <input id="input-name" class="form-control" placeholder="İsim" v-model="item.name" name="name" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="input-description" class=" control-label">Açıklama</label>
                                    <div class="">
                                        <input id="input-description" class="form-control" placeholder="Açıklama" v-model="item.description" name="description" type="text">
                                    </div>
                                </div>
                                <div role="group" aria-label="Basic example" class="btn-group  float-right rounded">
                                    <button class="btn btn-primary">Ekle</button>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-7">
                        <div class="card m-b-30">
                            <div class="card-header bg-primary text-white" style="line-height: 30px;">
                                Mevcut Gelir Türleri
                            </div>
                            <div class="card-body">
                                <table class="table table-striped table-bordered  mb-0 table-hover nowrap display" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead class="thead-default">
                                        <tr>
                                            <th width="1%">ID</th>
                                            <th>İsim</th>
                                            <th width="1%">İşlem</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item, itemi) in 4">
                                            <td>{{itemi}}</td>
                                            <td>Mutfak Harcaması</td>

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
</template>

<script>
module.exports = {
    name: "AccountingSettings",
    data() {
        return {
            editTypeLabels: {
                "case": "Gelir",
                "department": "Departman",
                "spend": "Gider",
                "revenue": "Gelir",
            },
            currentEditType: 'case',
            item: {}
        };
    },
    computed: {},
    mounted() {},
    beforeCreate() {},
    created() {},
    methods: {},
};
</script>

<style></style>
