<template>
<div class="content">
    <div class="container-fluid">
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4 class="page-title">{{item.meta.name || 'Ödeme Metodu'}}</h4>
                </div>
                <div class="col-sm-6">
                    <button @click="addContent(item, contenttypeid)" class="btn btn-primary rounded btn-custom waves-effect waves-light float-right">Kaydet</button>
                </div>
            </div>
        </div>
        <pre>
        {{item}}
        </pre>
        <div class="row">

            <div class="col-lg-6">

                <div class="card m-b-30">
                    <div class="card-header bg-primary text-white">
                        Ödeme Yöntemi Detayları
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="input-status" class="control-label">Durum</label>
                            <div class="">
                                <select class="form-control" id="input-status" v-model="item.entity_status" name="status">
                                    <option value="1">Aktif</option>
                                    <option value="0">Pasif</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-name" class="control-label">İsim</label>
                            <div class="">
                                <input id="input-name" class="form-control" placeholder="Ödeme Yöntemi Adı" v-model="item.meta.name" name="title" type="text">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-6">

                <div class="card m-b-30">
                    <div class="card-header bg-primary text-white">
                        Detay/Açıklama
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="input-name" class="control-label">Açıklama</label>
                            <div class="">
                                <textarea rows="3" class="textarea form-control" v-model="item.meta.description"></textarea>
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
    name: "AddCustomer",
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
