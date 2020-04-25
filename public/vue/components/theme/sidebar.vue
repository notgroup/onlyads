<template>
    <!-- ========== Left Sidebar Start ========== -->
    <div class="left side-menu">
        <div class="slimscroll-menu1" id="remove-scroll1">
            <!--- Sidemenu -->
            <div id="sidebar-menu">
                <!-- Left Menu Start -->
                <ul class="metismenu" id="side-menu">
                    <li class="menu-title">Menu</li>
                    <li>
                        <a href="#/" class="waves-effect">
                            <i class="fa fa-cog"></i
                            >
                            <span> Dashboard </span>
                        </a>
                    </li>

                    <li>
                        <a href="javascript:void(0);" class="waves-effect"
                            ><i class="fa fa-cog"></i
                            ><span>
                                Reklam
                                <span class="float-right menu-arrow"
                                    ><i class="mdi mdi-chevron-right"></i
                                ></span> </span
                        ></a>
                        <ul class="submenu">
                            <li>
                                <a href="#/business-accounts"
                                    >BM Hesapları</a
                                >
                            </li>
                            <li>
                                <a href="#/ad-accounts">Reklam Hesapları</a>
                            </li>
                            <li><a href="#/ref-prefix">Ref Önek</a></li>
                            <li><a href="#/ref-prefix">Events</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="#/settings" class="waves-effect"
                            ><i class="fa fa-cog"></i
                            ><span> Envanter </span></a
                        >
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="waves-effect"
                            ><i class="fa fa-cog"></i
                            ><span>
                                Araçlar
                                <span class="float-right menu-arrow"
                                    ><i class="mdi mdi-chevron-right"></i
                                ></span> </span
                        ></a>
                        <ul class="submenu">
                            <li><a href="#/">Landing Builder</a></li>
                            <li><a href="#/DomainManagment">Domain Yönetimi</a></li>
                            <li><a href="#/">Sunucu Yönetimi</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="waves-effect"
                            ><i class="fa fa-cog"></i
                            ><span>
                                Portföy
                                <span class="float-right menu-arrow"
                                    ><i class="mdi mdi-chevron-right"></i
                                ></span> </span
                        ></a>
                        <ul class="submenu">
                            <li>
                                <a href="/#/ContentTypeList/34">Müşteriler</a>
                            </li>
                            <li>
                                <a href="#/">Bayiler</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="waves-effect"
                            ><i class="fa fa-cog"></i
                            ><span>
                                Sipariş Yönetimi
                                <span class="float-right menu-arrow"
                                    ><i class="mdi mdi-chevron-right"></i
                                ></span> </span
                        ></a>
                        <ul class="submenu">
                            <li>
                                <a href="#/ContentTypeList/33">Siparişler</a>
                            </li>
                            <li>
                                <a href="#/order/refund">Para İadeleri</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="waves-effect"
                            ><i class="fa fa-cog"></i
                            ><span>
                                Ürün Yönetimi
                                <span class="float-right menu-arrow"
                                    ><i class="mdi mdi-chevron-right"></i
                                ></span> </span
                        ></a>
                        <ul class="submenu">
                            <li>
                                <a href="/#/ContentTypeList/4">Ürünler</a>
                            </li>
                            <li>
                                <a href="/#/ContentTypeList/32">Ürün Grupları</a>
                            </li>
                            <li>
                                <a href="#/Envanter">Envanter</a>
                            </li>
                            <li>
                                <a href="#/manage/ads">Ürün Reklam Maliyeti</a>
                            </li>
                            <li>
                                <a href="#/product_cargo">Kargo Oranları</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="waves-effect"
                            ><i class="fa fa-cog"></i
                            ><span>
                                Sms
                                <span class="float-right menu-arrow"
                                    ><i class="mdi mdi-chevron-right"></i
                                ></span> </span
                        ></a>
                        <ul class="submenu">
                            <li>
                                <a href="/sms/settings">
                                    <i class="fa fa-mobile"></i> Sms Metinleri
                                </a>
                            </li>
                            <li>
                                <a href="/sms/bulk">
                                    <i class="fa fa-mobile"></i> Toplu Sms
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="waves-effect"
                            ><i class="fa fa-cog"></i
                            ><span>
                                Kargo
                                <span class="float-right menu-arrow"
                                    ><i class="mdi mdi-chevron-right"></i
                                ></span> </span
                        ></a>
                        <ul class="submenu">
                            <li>
                                <a href="#/shipment/air">Ç.M İşlemleri</a>
                            </li>
                            <li>
                                <a href="#/shipment/report">Teslimat Raporu</a>
                            </li>
                            <li>
                                <a href="#/shipment/mini"
                                    >Teslimat Raporu (Mini)</a
                                >
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="waves-effect"
                            ><i class="fa fa-cog"></i
                            ><span>
                                Raporlar
                                <span class="float-right menu-arrow"
                                    ><i class="mdi mdi-chevron-right"></i
                                ></span> </span
                        ></a>
                        <ul class="submenu">
                            <li>
                                <a href="#/report/sales">Satış</a>
                            </li>
                            <li>
                                <a href="#/report/chart">Satış Grafikleri</a>
                            </li>
                            <li>
                                <a href="#/report/agent">Agent Raporları</a>
                            </li>
                            <li>
                                <a href="#/report/call">Arama Raporları</a>
                            </li>
                            <li>
                                <a href="#/report/hour">Saatlik</a>
                            </li>
                            <li>
                                <a href="#/admin/detail">Yönetici</a>
                            </li>
                            <li>
                                <a href="#/report/ads">Maliyet Raporları</a>
                            </li>
                            <li>
                                <a href="#/report/order">Onay Değerleri</a>
                            </li>
                            <li>
                                <a href="#/report/confirm"
                                    >Onay Değerleri (Detaylı)</a
                                >
                            </li>
                            <li>
                                <a href="#/report/prim">Primler</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="waves-effect"
                            ><i class="fa fa-cog"></i
                            ><span>
                                Gider Yönetimi
                                <span class="float-right menu-arrow"
                                    ><i class="mdi mdi-chevron-right"></i
                                ></span> </span
                        ></a>
                        <ul class="submenu">
                            <li>
                                <a href="#/manage/ads">Reklam Maliyetleri</a>
                            </li>
                            <li>
                                <a href="#/manage/cargo">Teslim Oranları</a>
                            </li>
                            <li>
                                <a href="#/manage/product">Ürün Maliyetleri</a>
                            </li>
                            <li>
                                <a href="#/manage/over">Genel Gider</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="waves-effect"
                            ><i class="fa fa-cog"></i
                            ><span>
                                Sistem
                                <span class="float-right menu-arrow"
                                    ><i class="mdi mdi-chevron-right"></i
                                ></span> </span
                        ></a>
                        <ul class="submenu">
                            <li>
                                <a href="#/system/payment/method"
                                    >Ödeme Metodları</a
                                >
                            </li>
                            <li>
                                <a href="#/system/shipment/method"
                                    >Kargo Firmaları</a
                                >
                            </li>
                            <li>
                                <a href="#/system/domain">Domain</a>
                            </li>
                            <li>
                                <a href="#/system/admin">Yöneticiler</a>
                            </li>
                            <li>
                                <a href="#/system/role">Roller</a>
                            </li>
                            <li>
                                <a href="#/callcenter/settings"
                                    >Callcenter Ayarları</a
                                >
                            </li>
                            <li>
                                <a href="#/settings">
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
<style scoped></style>
