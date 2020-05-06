<template>
<div class="content">
    <div class="container-fluid">
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4 class="page-title">AddRole</h4>
                </div>
                <div class="col-sm-6">
                    <button @click="addRole(item)" class="btn btn-success rounded btn-custom waves-effect waves-light float-right">Kaydet</button>
                </div>
            </div>
        </div>
        <pre class="logdetail">
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
                                <select class="form-control" multiple="" style="min-height: 500px;" v-model="item.permissions" name="permissions">
                                    <template v-for="(perms, perg) in permissions">

                                        <optgroup :key="perg" :label="perg">
                                            <template v-for="(per, peri) in perms">
                                                <option :key="peri" :value="per">{{per.split('.')[1]}}</option>
                                            </template>
                                        </optgroup>
                                    </template>
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
            permissions: {
                role: ["role.create",
                    "role.edit",
                    "role.delete",
                    "role.view"
                ],
                order: ["order.create",
                    "order.edit",
                    "order.delete",
                    "order.view"
                ],
                ads: ["ads.create",
                    "ads.edit",
                    "ads.delete",
                    "ads.view"
                ],
                product: ["product.create",
                    "product.edit",
                    "product.delete",
                    "product.view"
                ],
                productGroup: ["productGroup.create",
                    "productGroup.edit",
                    "productGroup.delete",
                    "productGroup.view"
                ],
                settings: ["settings.create",
                    "settings.edit",
                    "settings.delete",
                    "settings.view"
                ],
                shipment: ["shipment.create",
                    "shipment.edit",
                    "shipment.delete",
                    "shipment.view"
                ],
                dashboard: ["dashboard.create",
                    "dashboard.edit",
                    "dashboard.delete",
                    "dashboard.view"
                ],
                payment: ["payment.create",
                    "payment.edit",
                    "payment.delete",
                    "payment.view"
                ],
                report: ["report.create",
                    "report.edit",
                    "report.delete",
                    "report.view"
                ],
                user: ["user.create",
                    "user.edit",
                    "user.selfedit",
                    "user.login",
                    "user.delete",
                    "user.view"
                ]
            },
            item: {
                permissions: []
            },
        };
    },
    computed: {},
    mounted() {
        if (this.primaryId) {
            this.getRole(this.primaryId);
        }
    },
    beforeCreate() {},
    created() {},
    methods: {
        addRole(item = {}, contenttypeid = 0) {
            this.post(window.apiUrl + "/addRole", this.item, (res) => {
                if (this.item.id) {
                    alertify.success("Kullanıcı rolü bilgilerini güncellediniz.");
                } else {
                    alertify.success("Yeni kullanıcı rolü eklendi");

                }
                console.log(res)
            })
        },

        getRole(primaryid) {
            this.get(window.apiUrl + "/getRole/" + primaryid, (res) => {
                this.item = res;

            })
        }
    }
}
</script>

<style>
</style>
