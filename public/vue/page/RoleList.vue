<template>
<div class="content">
    <div class="container-fluid">
        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4 class="page-title">Kullanıcı Rolleri</h4>
                </div>
                <div class="col-sm-6">
                    <a :href="'#/AddRole/0'" class="btn btn-primary rounded btn-custom waves-effect waves-light float-right"><i class="fa fa-plus" style="margin-right:10px;"></i> Ekle</a>
                </div>
            </div>
            <!-- end row -->
        </div>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-bordered  mb-0 table-hover nowrap display" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead class="thead-default">
                        <tr>
                            <th width="1%">ID</th>
                            <th>Name</th>
                            <th width="1%">Slug</th>
                            <th width="1%">İşlem</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, itemi) in items">
                            <td>{{item.id}}</td>
                            <td>{{item.name}}</td>
                            <td>{{item.slug}}</td>

                            <td>
                                <div class="btn-group btn-group">

                                    <button @click="$router.push('/AddRole/' + item.id)" class="btn btn-primary waves-effect waves-light">
                                        <i class="far fa-eye"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <hr class="m-t-10 m-b-20" />
            </div>

        </div>

    </div>
</div>
</template>

<script>
module.exports = {
    name: "RoleList",
    props: [],
    data() {
        return {
            contentTypeId: 0,
            items: [],
            currentSettings: {
                autoload: ''
            }
        };
    },
    computed: {
        contentTypeId2() {
            this.getData(this.typeId)
            return this.typeId
        }
    },
    mounted() {
        this.getRoles()
    },
    beforeCreate() {},
    created() {},
    methods: {
        addSetting() {
            this.post(window.apiUrl + "/addSetting", this.currentSettings, (res) => {
                this.currentSettings = {}
                this.settings = res
            })
        },
        getRoles() {
            this.get(window.apiUrl + "/getRoles", (res) => {
                this.items = res;

            })
        }
    }
}
</script>

<style>
</style>
