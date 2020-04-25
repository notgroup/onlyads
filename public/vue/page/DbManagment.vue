<template>
    <div class="content">
        <div class="container-fluid">
            <!-- Page-Title -->
            <div class="page-title-box hide">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">DBMAnagment</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item">
                                <a href="javascript:void(0);">AnaSayfa</a>
                            </li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
                <!-- end row -->
            </div>

            <iframe
            style="padding-top: 20px;"
                src="/manage/adminer.php?sqlite=&username=admin"
                frameborder="0"
                height="1600px"
                scrolling="yes"
                width="100%"
            ></iframe>
        </div>
    </div>
</template>
<script>

module.exports = {
    name: "DbManagment",
    data() {
        return {};
    },
    computed: {},
    mounted() {},
    beforeCreate() {},
    created() {},
    methods: {},
};
</script>
<style></style>
