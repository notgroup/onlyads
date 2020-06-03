<template>
<!-- ========== Left Sidebar Start ========== -->
<div class="left side-menu">
    <div class="slimscroll-menu1" id="remove-scroll1">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu" id="side-menu">
                <li class="menu-title">Menu</li>
                <li class="">
                    <a href="#/" class="waves-effect">
                        <i class="fa fa-cog"></i>
                        <span> Dashboard </span>
                    </a>
                </li>

                <li class="" v-if="checkRole(['admin','root','agency','manager'])">
                    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-cog"></i><span>
                            Reklam
                            <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu">
                        <li class="">
                            <a href="#/business-accounts">BM Hesapları</a>
                        </li>

                    </ul>
                </li>


                <li class="" v-if="checkRole(['admin','root','manager'])">
                    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-cog"></i><span>
                            Sistem
                            <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu">

                        <li class="">
                            <a href="#/UserList">Yöneticiler</a>
                        </li>
                        <li class="">
                            <a href="#/RoleList">Roller</a>
                        </li>
                        <li class=""  v-if="checkRole(['root'])">
                            <a href="#/Settings">
                                <span> Settings </span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>
    </div>
    <!-- Sidebar -left -->
</div>
<!-- Left Sidebar End -->
</template>

<script>
module.exports = {
    name: "HeaderSort",
    props: {
        msg: String,
    },
};
</script>

<style scoped>
.left.side-menu {
    overflow-y: auto;
}
</style>
