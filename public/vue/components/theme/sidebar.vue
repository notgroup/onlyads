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

                <li class="">
                    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-cog"></i><span>
                            Reklam
                            <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu">
                        <li class="">
                            <a href="#/business-accounts">BM Hesapları</a>
                        </li>
                        <li class="hide">
                            <a href="#/ad-accounts">Reklam Hesapları</a>
                        </li>
                        <li class="hide"><a href="#/ref-prefix">Ref Önek</a></li>
                        <li class="hide"><a href="#/ref-prefix">Events</a></li>
                    </ul>
                </li>

                <li class="hide">
                    <a href="#/settings" class="waves-effect"><i class="fa fa-cog"></i><span> Envanter </span></a>
                </li>
                <li class="">
                    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-cog"></i><span>
                            Araçlar
                            <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu">
                        <li class=""><a href="#/LandingBuilder">Landing Builder</a></li>
                        <li class=""><a href="#/DomainManagment">Domain Yönetimi</a></li>
                        <li class=""><a href="#/ServerManagment">Sunucu Yönetimi</a></li>
                        <li class=""><a href="#/BlogManagment">Blog Yönetimi</a></li>
                        <li class=""><a target="_blank" href="/manage/adminer-4.7.6-en.php">DB Yönetimi</a></li>
                    </ul>
                </li>
                <li class="hide">
                    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-cog"></i><span>
                            Portföy
                            <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu">
                        <li class="">
                            <a href="/#/ContentTypeList/34">Müşteriler</a>
                        </li>
                        <li class="hide">
                            <a href="#/">Bayiler</a>
                        </li>
                    </ul>
                </li>
                <li class="">
                    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-cog"></i><span>
                            Sipariş Yönetimi
                            <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu">
                        <li class="">
                            <a href="#/ContentTypeList/33">Siparişler</a>
                        </li>
                        <li class="hide">
                            <a href="#/">Para İadeleri</a>
                        </li>
                    </ul>
                </li>
                <li class="">
                    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-cog"></i><span>
                            Ürün Yönetimi
                            <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu">
                        <li class="">
                            <a href="/#/ContentTypeList/4">Ürünler</a>
                        </li>
                        <li class="">
                            <a href="/#/ContentTypeList/32">Ürün Grupları</a>
                        </li>
                        <li class="hide">
                            <a href="#/">Envanter</a>
                        </li>
                        <li class="hide">
                            <a href="#/">Ürün Reklam Maliyeti</a>
                        </li>
                        <li class="hide">
                            <a href="#/">Kargo Oranları</a>
                        </li>
                    </ul>
                </li>
                <li class="hide">
                    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-cog"></i><span>
                            Sms
                            <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu">
                        <li class="">
                            <a href="/#">
                                <i class="fa fa-mobile"></i> Sms Metinleri
                            </a>
                        </li>
                        <li class="">
                            <a href="/#">
                                <i class="fa fa-mobile"></i> Toplu Sms
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="">
                    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-cog"></i><span>
                            Kargo
                            <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu">
                        <li class="hide">
                            <a href="#/">Ç.M İşlemleri</a>
                        </li>
                        <li class="">
                            <a href="#/CargoTracking">Teslimat Raporu</a>
                        </li>
                        <li class="hide">
                            <a href="#/">Teslimat Raporu (Mini)</a>
                        </li>
                    </ul>
                </li>
                <li class="hide">
                    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-cog"></i><span>
                            Raporlar
                            <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu">
                        <li class="">
                            <a href="#/">Satış</a>
                        </li>
                        <li class="">
                            <a href="#/">Satış Grafikleri</a>
                        </li>
                        <li class="">
                            <a href="#/">Agent Raporları</a>
                        </li>
                        <li class="">
                            <a href="#/">Arama Raporları</a>
                        </li>
                        <li class="">
                            <a href="#/">Saatlik</a>
                        </li>
                        <li class="">
                            <a href="#/">Yönetici</a>
                        </li>
                        <li class="">
                            <a href="#/">Maliyet Raporları</a>
                        </li>
                        <li class="">
                            <a href="#/">Onay Değerleri</a>
                        </li>
                        <li class="">
                            <a href="#/">Onay Değerleri (Detaylı)</a>
                        </li>
                        <li class="">
                            <a href="#/">Primler</a>
                        </li>
                    </ul>
                </li>
                <li class="hide">
                    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-cog"></i><span>
                            Gider Yönetimi
                            <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu">
                        <li class="">
                            <a href="#/">Reklam Maliyetleri</a>
                        </li>
                        <li class="">
                            <a href="#/">Teslim Oranları</a>
                        </li>
                        <li class="">
                            <a href="#/">Ürün Maliyetleri</a>
                        </li>
                        <li class="">
                            <a href="#/">Genel Gider</a>
                        </li>
                    </ul>
                </li>
                <li class="">
                    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-cog"></i><span>
                            Sistem
                            <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu">
                        <li class="">
                            <a href="/#/ContentTypeList/35">Ödeme Metodları</a>
                        </li>
                        <li class="">
                            <a href="/#/ContentTypeList/36">Kargo Firmaları</a>
                        </li>
                        <li class="">
                            <a href="#/UserList">Yöneticiler</a>
                        </li>
                        <li class="">
                            <a href="#/RoleList">Roller</a>
                        </li>
                        <li class="hide">
                            <a href="#/">Callcenter Ayarları</a>
                        </li>
                        <li class="">
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
