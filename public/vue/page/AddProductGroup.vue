<template>
<div class="content">
    <div class="container-fluid">
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4 class="page-title">AddProductGroup</h4>
                </div>
                <div class="col-sm-6">
                    <button @click="addContent(item, contenttypeid)" class="btn btn-success rounded btn-custom waves-effect waves-light float-right" >Kaydet</button>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-lg-12">

                <div class="card m-b-30">
                    <div class="card-body">

                        <h4 class="mt-0 header-title">Domain</h4>
                        <p class="sub-title">subtitle..</p>

                        <div class="form-group">
                            <label for="input-status" class="col-sm-2 control-label">Durum</label>
                            <div class="col-sm-2">
                                <select class="form-control" id="input-status" v-model="item.meta.status" name="status">
                                    <option value="active">Aktif</option>
                                    <option value="passive">Pasif</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-description" class="col-sm-2 control-label">Açıklama</label>
                            <div class="col-sm-5 col-md-4 col-lg-3">
                                <input id="input-description" class="form-control" placeholder="Açıklama" v-model="item.meta.description" name="description" type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-name" class="col-sm-2 control-label">İsim</label>
                            <div class="col-sm-5 col-md-4 col-lg-3">
                                <input id="input-name" class="form-control" placeholder="İsim" v-model="item.meta.title" name="title" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-quantity" class="col-sm-2 control-label">Adet</label>
                            <div class="col-sm-5 col-md-4 col-lg-3">
                                <input id="input-quantity" class="form-control" placeholder="Adet" v-model="item.meta.quantity" name="quantity" type="number">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-sku" class="col-sm-2 control-label">Ürün Kodu</label>
                            <div class="col-sm-5 col-md-4 col-lg-3">
                                <input id="input-sku" class="form-control" placeholder="Ürün Kodu" v-model="item.meta.sku" name="sku" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-status" class="col-sm-2 control-label">SMS Görevi</label>
                            <div class="col-sm-2">
                                <select class="form-control" id="input-status" v-model="item.meta.sms" name="sms">
                                    <option value="active">Aktif</option>
                                    <option value="passive">Pasif</option>
                                </select>
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
    name: "AddProductGroup",
    props: ['primaryid', 'contenttypeid'],
    data() {
        return {
            item: {},
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
