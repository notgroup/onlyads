<template>
    <div class="content">
        <div class="container-fluid">
            <!-- Page-Title -->
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">MyProfile</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item">
                                <a href="javascript:void(0);">AnaSayfa</a>
                            </li>
                            <li class="breadcrumb-item active">MyProfile</li>
                        </ol>
                    </div>
                </div>
                <!-- end row -->
            </div>
            <div class="row">
<div class="col-md-3"></div>
<div class="col-md-9">
{{$root.userData}}

</div>
            </div>


        </div>
    </div>
</template>
<script>

module.exports = {
    name: "MyProfile",
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
