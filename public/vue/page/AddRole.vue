<template>
<div class="content">
    <div class="container-fluid">
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4 class="page-title">AddRole</h4>
                </div>
                <div class="col-sm-6">
                    <button @click="addRole(item)" class="btn btn-success rounded btn-custom waves-effect waves-light float-right" >Kaydet</button>
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
                        Yetki detayları
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="input-status" class="control-label">Durum</label>
                            <div class="">
                                <select class="form-control" id="input-status" v-model="item.status" name="status">
                                    <option value="1">Aktif</option>
                                    <option value="0">Pasif</option>
                                </select>
                            </div>
                        </div>
    

                        <div class="form-group">
                            <label for="input-name" class="control-label">Name</label>
                            <div class="">
                                <input id="input-name" class="form-control" placeholder="Name" v-model="item.name" name="title" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-name" class="control-label">Slug</label>
                            <div class="">
                                <input id="input-name" class="form-control" placeholder="Slug" v-model="item.slug" name="slug" type="text">
                            </div>
                        </div>



                    </div>
                </div>
            </div>
                        <div class="col-lg-6">

                <div class="card m-b-30">
                                        <div class="card-header bg-primary text-white">
                        Yetki Seçimleri
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="input-domains">Yetkiler</label>
                            <div class="col-sm-12">
                                <select class="form-control" multiple="" style="min-height: 300px;" v-model="item.permissions" name="permissions">
                                    <option>role.create</option>
                                    <option>role.save</option>
                                    <option>role.delete</option>
                                    <option>role.view</option>
                                    <option>order.create</option>
                                    <option>order.save</option>
                                    <option>order.delete</option>
                                    <option>order.view</option>
                                    <option>product.create</option>
                                    <option>product.save</option>
                                    <option>product.delete</option>
                                    <option>product.view</option>
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
    name: "AddRole",
    props: ['primaryId', 'contenttypeid'],
    data() {
        return {
            item: {meta:{}},
        };
    },
    computed: {},
    mounted() {
        if (this.primaryId) {
            this.getData(this.primaryId);
        }
    },
    beforeCreate() {},
    created() {},
    methods: {
        addRole(item = {}) {
        },
        addContent(item = {}, contenttypeid = 0) {
            this.post(window.apiUrl + "/addContent/" + contenttypeid, this.item, (res) => {
                console.log(res)
            })
        },
        getData(primaryid) {
            this.get(window.apiUrl + "/getRole/" + primaryid, (res) => {
                this.item = res;

            })
        }
    }
}
</script>

<style>
</style>
