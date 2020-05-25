<template>
<div class="content">
    <div class="container-fluid">
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4 class="page-title">{{item.username || 'Kullanıcı Ekle'}}</h4>
                </div>
                <div class="col-sm-6">
                    <button @click="addUser(item)" class="btn btn-primary rounded btn-custom waves-effect waves-light float-right">Kaydet</button>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-lg-6">

                <div class="card m-b-30">
                    <div class="card-header bg-primary text-white">
                        Kullanıcı Bilgileri
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label for="input-description" class="control-label">UserName</label>
                            <div class="">
                                <input id="input-description" class="form-control" placeholder="username" v-model="item.username" name="username" type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-name" class="control-label">Email</label>
                            <div class="">
                                <input id="input-name" class="form-control" placeholder="Email" v-model="item.email" name="email" type="email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-name" class="control-label">Parola</label>
                            <div class="">
                                <input id="input-name" class="form-control" placeholder="Parola giriniz" v-model="item.password" name="password" type="password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-quantity" class="control-label">Role</label>
                            <div class="">
                                <select class="form-control" id="input-status" v-model="item.role" name="role">
                                    <option value="member">Member</option>
                                    <option value="admin">Admin</option>
                                    <option value="manager">Manager</option>
                                    <option value="agent">Agent</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">

                <div class="card m-b-30">
                    <div class="card-header bg-primary text-white">
                        Kullanıcı Detayları
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

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</template>

<script>
module.exports = {
    name: "AddUser",
    props: ['userId'],
    data() {
        return {
            item: {},
        };
    },
    computed: {},
    mounted() {
        if (this.userId > 0) {
            this.getUser(this.userId);
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
        getUser(userId) {
            this.get(window.apiUrl + "/getUser/" + userId, (res) => {
                this.item = res;
                console.log(res);

            })
        }
    }
}
</script>

<style>
</style>
