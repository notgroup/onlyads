<template>

        <!-- ========== Left Sidebar Start ========== -->
        <div class="left side-menu">
            <div class="slimscroll-menu" id="remove-scroll">

                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <!-- Left Menu Start -->
                    <ul class="metismenu" id="side-menu">
                        <li class="menu-title">Menu</li>
                        <li>
                            <a href="#/" class="waves-effect">
                                <i class="icon-accelerator"></i><span class="badge badge-success badge-pill float-right">9+</span> <span> Dashboard </span>
                            </a>
                        </li>

                        <li>
                            <a href="javascript:void(0);" class="waves-effect"><i class="icon-mail-open"></i><span> Reklam <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                            <ul class="submenu">
                                <li><a href="#/business-accounts">Şirket Hesapları</a></li>
                                <li><a href="#/ad-accounts">Reklam Hesapları</a></li>
                                <li><a href="#/ref-prefix">Ref Önek</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="#/settings" class="waves-effect"><i class="icon-calendar"></i><span> Settings </span></a>
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
module.exports =  {
  name: 'HeaderSort',
  props: {
    msg: String
  }
}
</script>
<style scoped>
</style>
