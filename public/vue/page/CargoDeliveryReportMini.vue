<template>
<div class="content">
    <div class="container-fluid">
        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4 class="page-title">Teslimat Raporları Özet</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);">AnaSayfa</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Teslimat Raporları Özet
                        </li>
                    </ol>
                </div>
            </div>
            <!-- end row -->
        </div>
    <div class="table-responsive">


        <table class="table table-striped table-hover" data-url="http://admin.roket.live/shipment/mini">
            <thead class="totalTable" style="">
                <tr>
                    <th class="text-center">&nbsp;</th>
                    <th class="text-center thunknown"><a data-order-id="unknown" class="btn btn-sm btn-default set-cargo edit" data-toggle="modal" data-target="#new-size-form" title="Detay">Bilinmiyor</a></th>

                    <th class="text-center thpacking"><a data-order-id="packing" class="btn btn-sm btn-default set-cargo edit" data-toggle="modal" data-target="#new-size-form" title="Detay">Paketleme</a></th>

                    <th class="text-center thon_the_way"><a data-order-id="on_the_way" class="btn btn-sm btn-default set-cargo edit" data-toggle="modal" data-target="#new-size-form" title="Detay">Yolda</a></th>

                    <th class="text-center that_departure_unit"><a data-order-id="at_departure_unit" class="btn btn-sm btn-default set-cargo edit" data-toggle="modal" data-target="#new-size-form" title="Detay">Çıkış Şubesinde</a></th>

                    <th class="text-center that_arrival_unit"><a data-order-id="at_arrival_unit" class="btn btn-sm btn-default set-cargo edit" data-toggle="modal" data-target="#new-size-form" title="Detay">Teslimat Şubesinde</a></th>

                    <th class="text-center thmessage"><a data-order-id="message" class="btn btn-sm btn-default set-cargo edit" data-toggle="modal" data-target="#new-size-form" title="Detay">Uğrama Notlu</a></th>

                    <th class="text-center thredirected"><a data-order-id="redirected" class="btn btn-sm btn-default set-cargo edit" data-toggle="modal" data-target="#new-size-form" title="Detay">Yönlendirildi</a></th>

                    <th class="text-center thwrong_adress"><a data-order-id="wrong_adress" class="btn btn-sm btn-default set-cargo edit" data-toggle="modal" data-target="#new-size-form" title="Detay">Hatalı Adres</a></th>

                    <th class="text-center thproblem"><a data-order-id="problem" class="btn btn-sm btn-default set-cargo edit" data-toggle="modal" data-target="#new-size-form" title="Detay">Sorunlu</a></th>

                    <th class="text-center thon_delivery"><a data-order-id="on_delivery" class="btn btn-sm btn-default set-cargo edit" data-toggle="modal" data-target="#new-size-form" title="Detay">Teslimatta</a></th>

                    <th class="text-center thdelivered"><a data-order-id="delivered" class="btn btn-sm btn-default set-cargo edit" data-toggle="modal" data-target="#new-size-form" title="Detay">Teslim Edildi</a></th>

                    <th class="text-center threturning"><a data-order-id="returning" class="btn btn-sm btn-default set-cargo edit" data-toggle="modal" data-target="#new-size-form" title="Detay">İade Geliyor</a></th>

                    <th class="text-center threturned"><a data-order-id="returned" class="btn btn-sm btn-default set-cargo edit" data-toggle="modal" data-target="#new-size-form" title="Detay">İade</a></th>

                    <th class="text-center">Toplam</th>
                </tr>
            </thead>
            <tbody class="totalTable" style="">
                <tr>
                    <td class="text-center">&nbsp;</td>
                    <td class="text-center th2unknown">208</td>
                    <td class="text-center th2packing">244</td>
                    <td class="text-center th2on_the_way">0</td>
                    <td class="text-center th2at_departure_unit">20</td>
                    <td class="text-center th2at_arrival_unit">99</td>
                    <td class="text-center th2message">0</td>
                    <td class="text-center th2redirected">0</td>
                    <td class="text-center th2wrong_adress">0</td>
                    <td class="text-center th2problem">93</td>
                    <td class="text-center th2on_delivery">946</td>
                    <td class="text-center th2delivered">1110</td>
                    <td class="text-center th2returning">0</td>
                    <td class="text-center th2returned">284</td>
                    <td class="text-center">3004</td>
                </tr>
                <tr>
                    <td class="text-center">&nbsp;</td>
                    <td class="text-center th2unknown">%6.92</td>
                    <td class="text-center th2packing">%8.12</td>
                    <td class="text-center th2on_the_way">%0</td>
                    <td class="text-center th2at_departure_unit">%0.67</td>
                    <td class="text-center th2at_arrival_unit">%3.3</td>
                    <td class="text-center th2message">%0</td>
                    <td class="text-center th2redirected">%0</td>
                    <td class="text-center th2wrong_adress">%0</td>
                    <td class="text-center th2problem">%3.1</td>
                    <td class="text-center th2on_delivery">%31.49</td>
                    <td class="text-center th2delivered">%36.95</td>
                    <td class="text-center th2returning">%0</td>
                    <td class="text-center th2returned">%9.45</td>
                    <td class="text-center">%100</td>
                </tr>
                <tr>
                    <td class="text-center">&nbsp;</td>
                    <td class="text-center th2unknown">20,546 TRY</td>
                    <td class="text-center th2packing">22,933 TRY</td>
                    <td class="text-center th2on_the_way">0 TRY</td>
                    <td class="text-center th2at_departure_unit">2,136 TRY</td>
                    <td class="text-center th2at_arrival_unit">10,247 TRY</td>
                    <td class="text-center th2message">0 TRY</td>
                    <td class="text-center th2redirected">0 TRY</td>
                    <td class="text-center th2wrong_adress">0 TRY</td>
                    <td class="text-center th2problem">10,227 TRY</td>
                    <td class="text-center th2on_delivery">96,113 TRY</td>
                    <td class="text-center th2delivered">119,633 TRY</td>
                    <td class="text-center th2returning">0 TRY</td>
                    <td class="text-center th2returned">31,482 TRY</td>
                    <td class="text-center">313,317 TRY</td>
                </tr>
            </tbody>

            <thead class="dateTable" style="">
                <tr>
                    <th colspan="7" style="padding:0px;">
                        <hr>
                    </th>
                    <th align="center" style="text-align: center;padding: 10px;">Tarih</th>
                    <th colspan="99" style="padding:0px;">
                        <hr>
                    </th>
                </tr>
                <tr>
                </tr>
                <tr>
                    <th class="text-center">Tarih</th>
                    <th class="text-center thunknown">Bilinmiyor</th>
                    <th class="text-center thpacking">Paketleme</th>
                    <th class="text-center thon_the_way">Yolda</th>
                    <th class="text-center that_departure_unit">Çıkış Şubesinde</th>
                    <th class="text-center that_arrival_unit">Teslimat Şubesinde</th>
                    <th class="text-center thmessage">Uğrama Notlu</th>
                    <th class="text-center thredirected">Yönlendirildi</th>
                    <th class="text-center thwrong_adress">Hatalı Adres</th>
                    <th class="text-center thproblem">Sorunlu</th>
                    <th class="text-center thon_delivery">Teslimatta</th>
                    <th class="text-center thdelivered">Teslim Edildi</th>
                    <th class="text-center threturning">İade Geliyor</th>
                    <th class="text-center threturned">İade</th>
                    <th class="text-center">Toplam</th>
                    <th class="text-center">Toplam (TRY)</th>
                </tr>
            </thead>
            <tbody class="dateTable" style="">
                <tr>
                    <th class="text-center">2020-04-08</th>
                    <td class="text-center th2unknown">0
                        (%0 )
                    </td>
                    <td class="text-center th2packing">1
                        (%3.7 )
                    </td>
                    <td class="text-center th2on_the_way">0
                        (%0 )
                    </td>
                    <td class="text-center th2at_departure_unit">0
                        (%0 )
                    </td>
                    <td class="text-center th2at_arrival_unit">0
                        (%0 )
                    </td>
                    <td class="text-center th2message">0
                        (%0 )
                    </td>
                    <td class="text-center th2redirected">0
                        (%0 )
                    </td>
                    <td class="text-center th2wrong_adress">0
                        (%0 )
                    </td>
                    <td class="text-center th2problem">1
                        (%3.7 )
                    </td>
                    <td class="text-center th2on_delivery">6
                        ( <b> %22.22 </b> )
                    </td>
                    <td class="text-center th2delivered">13
                        ( <b> %48.15 </b> )
                    </td>
                    <td class="text-center th2returning">0
                        (%0 )
                    </td>
                    <td class="text-center th2returned">6
                        ( <b> %22.22 </b> )
                    </td>
                    <td class="text-center">27 (%0.9 )</td>
                    <td class="text-center">3,151 TRY</td>
                </tr>
                <tr>
                    <th class="text-center">2020-04-09</th>
                    <td class="text-center th2unknown">0
                        (%0 )
                    </td>
                    <td class="text-center th2packing">1
                        (%3.03 )
                    </td>
                    <td class="text-center th2on_the_way">0
                        (%0 )
                    </td>
                    <td class="text-center th2at_departure_unit">0
                        (%0 )
                    </td>
                    <td class="text-center th2at_arrival_unit">1
                        (%3.03 )
                    </td>
                    <td class="text-center th2message">0
                        (%0 )
                    </td>
                    <td class="text-center th2redirected">0
                        (%0 )
                    </td>
                    <td class="text-center th2wrong_adress">0
                        (%0 )
                    </td>
                    <td class="text-center th2problem">1
                        (%3.03 )
                    </td>
                    <td class="text-center th2on_delivery">5
                        (%15.15 )
                    </td>
                    <td class="text-center th2delivered">22
                        ( <b> %66.67 </b> )
                    </td>
                    <td class="text-center th2returning">0
                        (%0 )
                    </td>
                    <td class="text-center th2returned">3
                        (%9.09 )
                    </td>
                    <td class="text-center">33 (%1.1 )</td>
                    <td class="text-center">3,614 TRY</td>
                </tr>
                <tr>
                    <th class="text-center">2020-04-10</th>
                    <td class="text-center th2unknown">0
                        (%0 )
                    </td>
                    <td class="text-center th2packing">0
                        (%0 )
                    </td>
                    <td class="text-center th2on_the_way">0
                        (%0 )
                    </td>
                    <td class="text-center th2at_departure_unit">0
                        (%0 )
                    </td>
                    <td class="text-center th2at_arrival_unit">0
                        (%0 )
                    </td>
                    <td class="text-center th2message">0
                        (%0 )
                    </td>
                    <td class="text-center th2redirected">0
                        (%0 )
                    </td>
                    <td class="text-center th2wrong_adress">0
                        (%0 )
                    </td>
                    <td class="text-center th2problem">1
                        (%11.11 )
                    </td>
                    <td class="text-center th2on_delivery">2
                        ( <b> %22.22 </b> )
                    </td>
                    <td class="text-center th2delivered">3
                        ( <b> %33.33 </b> )
                    </td>
                    <td class="text-center th2returning">0
                        (%0 )
                    </td>
                    <td class="text-center th2returned">3
                        ( <b> %33.33 </b> )
                    </td>
                    <td class="text-center">9 (%0.3 )</td>
                    <td class="text-center">864 TRY</td>
                </tr>
                <tr>
                    <th class="text-center">2020-04-11</th>
                    <td class="text-center th2unknown">0
                        (%0 )
                    </td>
                    <td class="text-center th2packing">0
                        (%0 )
                    </td>
                    <td class="text-center th2on_the_way">0
                        (%0 )
                    </td>
                    <td class="text-center th2at_departure_unit">0
                        (%0 )
                    </td>
                    <td class="text-center th2at_arrival_unit">0
                        (%0 )
                    </td>
                    <td class="text-center th2message">0
                        (%0 )
                    </td>
                    <td class="text-center th2redirected">0
                        (%0 )
                    </td>
                    <td class="text-center th2wrong_adress">0
                        (%0 )
                    </td>
                    <td class="text-center th2problem">0
                        (%0 )
                    </td>
                    <td class="text-center th2on_delivery">0
                        (%0 )
                    </td>
                    <td class="text-center th2delivered">1
                        ( <b> %50 </b> )
                    </td>
                    <td class="text-center th2returning">0
                        (%0 )
                    </td>
                    <td class="text-center th2returned">1
                        ( <b> %50 </b> )
                    </td>
                    <td class="text-center">2 (%0.07 )</td>
                    <td class="text-center">211 TRY</td>
                </tr>
                <tr>
                    <th class="text-center">2020-04-12</th>
                    <td class="text-center th2unknown">0
                        (%0 )
                    </td>
                    <td class="text-center th2packing">1
                        (%7.14 )
                    </td>
                    <td class="text-center th2on_the_way">0
                        (%0 )
                    </td>
                    <td class="text-center th2at_departure_unit">0
                        (%0 )
                    </td>
                    <td class="text-center th2at_arrival_unit">0
                        (%0 )
                    </td>
                    <td class="text-center th2message">0
                        (%0 )
                    </td>
                    <td class="text-center th2redirected">0
                        (%0 )
                    </td>
                    <td class="text-center th2wrong_adress">0
                        (%0 )
                    </td>
                    <td class="text-center th2problem">0
                        (%0 )
                    </td>
                    <td class="text-center th2on_delivery">0
                        (%0 )
                    </td>
                    <td class="text-center th2delivered">9
                        ( <b> %64.29 </b> )
                    </td>
                    <td class="text-center th2returning">0
                        (%0 )
                    </td>
                    <td class="text-center th2returned">4
                        ( <b> %28.57 </b> )
                    </td>
                    <td class="text-center">14 (%0.47 )</td>
                    <td class="text-center">1,476 TRY</td>
                </tr>
                <tr>
                    <th class="text-center">2020-04-19</th>
                    <td class="text-center th2unknown">0
                        (%0 )
                    </td>
                    <td class="text-center th2packing">0
                        (%0 )
                    </td>
                    <td class="text-center th2on_the_way">0
                        (%0 )
                    </td>
                    <td class="text-center th2at_departure_unit">0
                        (%0 )
                    </td>
                    <td class="text-center th2at_arrival_unit">0
                        (%0 )
                    </td>
                    <td class="text-center th2message">0
                        (%0 )
                    </td>
                    <td class="text-center th2redirected">0
                        (%0 )
                    </td>
                    <td class="text-center th2wrong_adress">0
                        (%0 )
                    </td>
                    <td class="text-center th2problem">0
                        (%0 )
                    </td>
                    <td class="text-center th2on_delivery">0
                        (%0 )
                    </td>
                    <td class="text-center th2delivered">6
                        ( <b> %75 </b> )
                    </td>
                    <td class="text-center th2returning">0
                        (%0 )
                    </td>
                    <td class="text-center th2returned">2
                        ( <b> %25 </b> )
                    </td>
                    <td class="text-center">8 (%0.27 )</td>
                    <td class="text-center">1,115 TRY</td>
                </tr>
                <tr>
                    <th class="text-center">2020-04-20</th>
                    <td class="text-center th2unknown">0
                        (%0 )
                    </td>
                    <td class="text-center th2packing">3
                        (%3.3 )
                    </td>
                    <td class="text-center th2on_the_way">0
                        (%0 )
                    </td>
                    <td class="text-center th2at_departure_unit">0
                        (%0 )
                    </td>
                    <td class="text-center th2at_arrival_unit">1
                        (%1.1 )
                    </td>
                    <td class="text-center th2message">0
                        (%0 )
                    </td>
                    <td class="text-center th2redirected">0
                        (%0 )
                    </td>
                    <td class="text-center th2wrong_adress">0
                        (%0 )
                    </td>
                    <td class="text-center th2problem">0
                        (%0 )
                    </td>
                    <td class="text-center th2on_delivery">4
                        (%4.4 )
                    </td>
                    <td class="text-center th2delivered">60
                        ( <b> %65.93 </b> )
                    </td>
                    <td class="text-center th2returning">0
                        (%0 )
                    </td>
                    <td class="text-center th2returned">23
                        ( <b> %25.27 </b> )
                    </td>
                    <td class="text-center">91 (%3.03 )</td>
                    <td class="text-center">10,703 TRY</td>
                </tr>
                <tr>
                    <th class="text-center">2020-04-21</th>
                    <td class="text-center th2unknown">1
                        (%0.26 )
                    </td>
                    <td class="text-center th2packing">1
                        (%0.26 )
                    </td>
                    <td class="text-center th2on_the_way">0
                        (%0 )
                    </td>
                    <td class="text-center th2at_departure_unit">0
                        (%0 )
                    </td>
                    <td class="text-center th2at_arrival_unit">5
                        (%1.31 )
                    </td>
                    <td class="text-center th2message">0
                        (%0 )
                    </td>
                    <td class="text-center th2redirected">0
                        (%0 )
                    </td>
                    <td class="text-center th2wrong_adress">0
                        (%0 )
                    </td>
                    <td class="text-center th2problem">2
                        (%0.52 )
                    </td>
                    <td class="text-center th2on_delivery">15
                        (%3.93 )
                    </td>
                    <td class="text-center th2delivered">236
                        ( <b> %61.78 </b> )
                    </td>
                    <td class="text-center th2returning">0
                        (%0 )
                    </td>
                    <td class="text-center th2returned">122
                        ( <b> %31.94 </b> )
                    </td>
                    <td class="text-center">382 (%12.72 )</td>
                    <td class="text-center">41,671 TRY</td>
                </tr>
                <tr>
                    <th class="text-center">2020-04-22</th>
                    <td class="text-center th2unknown">0
                        (%0 )
                    </td>
                    <td class="text-center th2packing">1
                        (%0.92 )
                    </td>
                    <td class="text-center th2on_the_way">0
                        (%0 )
                    </td>
                    <td class="text-center th2at_departure_unit">1
                        (%0.92 )
                    </td>
                    <td class="text-center th2at_arrival_unit">1
                        (%0.92 )
                    </td>
                    <td class="text-center th2message">0
                        (%0 )
                    </td>
                    <td class="text-center th2redirected">0
                        (%0 )
                    </td>
                    <td class="text-center th2wrong_adress">0
                        (%0 )
                    </td>
                    <td class="text-center th2problem">0
                        (%0 )
                    </td>
                    <td class="text-center th2on_delivery">8
                        (%7.34 )
                    </td>
                    <td class="text-center th2delivered">65
                        ( <b> %59.63 </b> )
                    </td>
                    <td class="text-center th2returning">0
                        (%0 )
                    </td>
                    <td class="text-center th2returned">33
                        ( <b> %30.28 </b> )
                    </td>
                    <td class="text-center">109 (%3.63 )</td>
                    <td class="text-center">12,010 TRY</td>
                </tr>
                <tr>
                    <th class="text-center">2020-04-24</th>
                    <td class="text-center th2unknown">0
                        (%0 )
                    </td>
                    <td class="text-center th2packing">0
                        (%0 )
                    </td>
                    <td class="text-center th2on_the_way">0
                        (%0 )
                    </td>
                    <td class="text-center th2at_departure_unit">0
                        (%0 )
                    </td>
                    <td class="text-center th2at_arrival_unit">1
                        ( <b> %33.33 </b> )
                    </td>
                    <td class="text-center th2message">0
                        (%0 )
                    </td>
                    <td class="text-center th2redirected">0
                        (%0 )
                    </td>
                    <td class="text-center th2wrong_adress">0
                        (%0 )
                    </td>
                    <td class="text-center th2problem">0
                        (%0 )
                    </td>
                    <td class="text-center th2on_delivery">0
                        (%0 )
                    </td>
                    <td class="text-center th2delivered">2
                        ( <b> %66.67 </b> )
                    </td>
                    <td class="text-center th2returning">0
                        (%0 )
                    </td>
                    <td class="text-center th2returned">0
                        (%0 )
                    </td>
                    <td class="text-center">3 (%0.1 )</td>
                    <td class="text-center">291 TRY</td>
                </tr>
                <tr>
                    <th class="text-center">2020-04-27</th>
                    <td class="text-center th2unknown">2
                        (%0.82 )
                    </td>
                    <td class="text-center th2packing">2
                        (%0.82 )
                    </td>
                    <td class="text-center th2on_the_way">0
                        (%0 )
                    </td>
                    <td class="text-center th2at_departure_unit">0
                        (%0 )
                    </td>
                    <td class="text-center th2at_arrival_unit">11
                        (%4.49 )
                    </td>
                    <td class="text-center th2message">0
                        (%0 )
                    </td>
                    <td class="text-center th2redirected">0
                        (%0 )
                    </td>
                    <td class="text-center th2wrong_adress">0
                        (%0 )
                    </td>
                    <td class="text-center th2problem">10
                        (%4.08 )
                    </td>
                    <td class="text-center th2on_delivery">50
                        ( <b> %20.41 </b> )
                    </td>
                    <td class="text-center th2delivered">128
                        ( <b> %52.24 </b> )
                    </td>
                    <td class="text-center th2returning">0
                        (%0 )
                    </td>
                    <td class="text-center th2returned">42
                        (%17.14 )
                    </td>
                    <td class="text-center">245 (%8.16 )</td>
                    <td class="text-center">25,163 TRY</td>
                </tr>
                <tr>
                    <th class="text-center">2020-04-28</th>
                    <td class="text-center th2unknown">0
                        (%0 )
                    </td>
                    <td class="text-center th2packing">0
                        (%0 )
                    </td>
                    <td class="text-center th2on_the_way">0
                        (%0 )
                    </td>
                    <td class="text-center th2at_departure_unit">0
                        (%0 )
                    </td>
                    <td class="text-center th2at_arrival_unit">9
                        (%4.59 )
                    </td>
                    <td class="text-center th2message">0
                        (%0 )
                    </td>
                    <td class="text-center th2redirected">0
                        (%0 )
                    </td>
                    <td class="text-center th2wrong_adress">0
                        (%0 )
                    </td>
                    <td class="text-center th2problem">8
                        (%4.08 )
                    </td>
                    <td class="text-center th2on_delivery">35
                        (%17.86 )
                    </td>
                    <td class="text-center th2delivered">118
                        ( <b> %60.2 </b> )
                    </td>
                    <td class="text-center th2returning">0
                        (%0 )
                    </td>
                    <td class="text-center th2returned">26
                        (%13.27 )
                    </td>
                    <td class="text-center">196 (%6.52 )</td>
                    <td class="text-center">21,220 TRY</td>
                </tr>
                <tr>
                    <th class="text-center">2020-04-29</th>
                    <td class="text-center th2unknown">1
                        (%0.35 )
                    </td>
                    <td class="text-center th2packing">1
                        (%0.35 )
                    </td>
                    <td class="text-center th2on_the_way">0
                        (%0 )
                    </td>
                    <td class="text-center th2at_departure_unit">1
                        (%0.35 )
                    </td>
                    <td class="text-center th2at_arrival_unit">25
                        (%8.8 )
                    </td>
                    <td class="text-center th2message">0
                        (%0 )
                    </td>
                    <td class="text-center th2redirected">0
                        (%0 )
                    </td>
                    <td class="text-center th2wrong_adress">0
                        (%0 )
                    </td>
                    <td class="text-center th2problem">11
                        (%3.87 )
                    </td>
                    <td class="text-center th2on_delivery">66
                        ( <b> %23.24 </b> )
                    </td>
                    <td class="text-center th2delivered">164
                        ( <b> %57.75 </b> )
                    </td>
                    <td class="text-center th2returning">0
                        (%0 )
                    </td>
                    <td class="text-center th2returned">15
                        (%5.28 )
                    </td>
                    <td class="text-center">284 (%9.45 )</td>
                    <td class="text-center">29,986 TRY</td>
                </tr>
                <tr>
                    <th class="text-center">2020-04-30</th>
                    <td class="text-center th2unknown">2
                        (%1.63 )
                    </td>
                    <td class="text-center th2packing">0
                        (%0 )
                    </td>
                    <td class="text-center th2on_the_way">0
                        (%0 )
                    </td>
                    <td class="text-center th2at_departure_unit">0
                        (%0 )
                    </td>
                    <td class="text-center th2at_arrival_unit">12
                        (%9.76 )
                    </td>
                    <td class="text-center th2message">0
                        (%0 )
                    </td>
                    <td class="text-center th2redirected">0
                        (%0 )
                    </td>
                    <td class="text-center th2wrong_adress">0
                        (%0 )
                    </td>
                    <td class="text-center th2problem">3
                        (%2.44 )
                    </td>
                    <td class="text-center th2on_delivery">39
                        ( <b> %31.71 </b> )
                    </td>
                    <td class="text-center th2delivered">66
                        ( <b> %53.66 </b> )
                    </td>
                    <td class="text-center th2returning">0
                        (%0 )
                    </td>
                    <td class="text-center th2returned">1
                        (%0.81 )
                    </td>
                    <td class="text-center">123 (%4.09 )</td>
                    <td class="text-center">12,343 TRY</td>
                </tr>
                <tr>
                    <th class="text-center">2020-05-01</th>
                    <td class="text-center th2unknown">1
                        (%5.56 )
                    </td>
                    <td class="text-center th2packing">0
                        (%0 )
                    </td>
                    <td class="text-center th2on_the_way">0
                        (%0 )
                    </td>
                    <td class="text-center th2at_departure_unit">0
                        (%0 )
                    </td>
                    <td class="text-center th2at_arrival_unit">2
                        (%11.11 )
                    </td>
                    <td class="text-center th2message">0
                        (%0 )
                    </td>
                    <td class="text-center th2redirected">0
                        (%0 )
                    </td>
                    <td class="text-center th2wrong_adress">0
                        (%0 )
                    </td>
                    <td class="text-center th2problem">0
                        (%0 )
                    </td>
                    <td class="text-center th2on_delivery">10
                        ( <b> %55.56 </b> )
                    </td>
                    <td class="text-center th2delivered">5
                        ( <b> %27.78 </b> )
                    </td>
                    <td class="text-center th2returning">0
                        (%0 )
                    </td>
                    <td class="text-center th2returned">0
                        (%0 )
                    </td>
                    <td class="text-center">18 (%0.6 )</td>
                    <td class="text-center">1,867 TRY</td>
                </tr>
                <tr>
                    <th class="text-center">2020-05-02</th>
                    <td class="text-center th2unknown">7
                        (%3.74 )
                    </td>
                    <td class="text-center th2packing">1
                        (%0.53 )
                    </td>
                    <td class="text-center th2on_the_way">0
                        (%0 )
                    </td>
                    <td class="text-center th2at_departure_unit">2
                        (%1.07 )
                    </td>
                    <td class="text-center th2at_arrival_unit">11
                        (%5.88 )
                    </td>
                    <td class="text-center th2message">0
                        (%0 )
                    </td>
                    <td class="text-center th2redirected">0
                        (%0 )
                    </td>
                    <td class="text-center th2wrong_adress">0
                        (%0 )
                    </td>
                    <td class="text-center th2problem">5
                        (%2.67 )
                    </td>
                    <td class="text-center th2on_delivery">102
                        ( <b> %54.55 </b> )
                    </td>
                    <td class="text-center th2delivered">58
                        ( <b> %31.02 </b> )
                    </td>
                    <td class="text-center th2returning">0
                        (%0 )
                    </td>
                    <td class="text-center th2returned">1
                        (%0.53 )
                    </td>
                    <td class="text-center">187 (%6.23 )</td>
                    <td class="text-center">19,714 TRY</td>
                </tr>
                <tr>
                    <th class="text-center">2020-05-03</th>
                    <td class="text-center th2unknown">1
                        (%0.4 )
                    </td>
                    <td class="text-center th2packing">4
                        (%1.62 )
                    </td>
                    <td class="text-center th2on_the_way">0
                        (%0 )
                    </td>
                    <td class="text-center th2at_departure_unit">1
                        (%0.4 )
                    </td>
                    <td class="text-center th2at_arrival_unit">8
                        (%3.24 )
                    </td>
                    <td class="text-center th2message">0
                        (%0 )
                    </td>
                    <td class="text-center th2redirected">0
                        (%0 )
                    </td>
                    <td class="text-center th2wrong_adress">0
                        (%0 )
                    </td>
                    <td class="text-center th2problem">9
                        (%3.64 )
                    </td>
                    <td class="text-center th2on_delivery">156
                        ( <b> %63.16 </b> )
                    </td>
                    <td class="text-center th2delivered">67
                        ( <b> %27.13 </b> )
                    </td>
                    <td class="text-center th2returning">0
                        (%0 )
                    </td>
                    <td class="text-center th2returned">1
                        (%0.4 )
                    </td>
                    <td class="text-center">247 (%8.22 )</td>
                    <td class="text-center">24,820 TRY</td>
                </tr>
                <tr>
                    <th class="text-center">2020-05-04</th>
                    <td class="text-center th2unknown">4
                        (%1.47 )
                    </td>
                    <td class="text-center th2packing">2
                        (%0.74 )
                    </td>
                    <td class="text-center th2on_the_way">0
                        (%0 )
                    </td>
                    <td class="text-center th2at_departure_unit">1
                        (%0.37 )
                    </td>
                    <td class="text-center th2at_arrival_unit">11
                        (%4.04 )
                    </td>
                    <td class="text-center th2message">0
                        (%0 )
                    </td>
                    <td class="text-center th2redirected">0
                        (%0 )
                    </td>
                    <td class="text-center th2wrong_adress">0
                        (%0 )
                    </td>
                    <td class="text-center th2problem">24
                        (%8.82 )
                    </td>
                    <td class="text-center th2on_delivery">172
                        ( <b> %63.24 </b> )
                    </td>
                    <td class="text-center th2delivered">58
                        ( <b> %21.32 </b> )
                    </td>
                    <td class="text-center th2returning">0
                        (%0 )
                    </td>
                    <td class="text-center th2returned">0
                        (%0 )
                    </td>
                    <td class="text-center">272 (%9.05 )</td>
                    <td class="text-center">27,819 TRY</td>
                </tr>
                <tr>
                    <th class="text-center">2020-05-05</th>
                    <td class="text-center th2unknown">2
                        (%0.69 )
                    </td>
                    <td class="text-center th2packing">34
                        (%11.68 )
                    </td>
                    <td class="text-center th2on_the_way">0
                        (%0 )
                    </td>
                    <td class="text-center th2at_departure_unit">4
                        (%1.37 )
                    </td>
                    <td class="text-center th2at_arrival_unit">1
                        (%0.34 )
                    </td>
                    <td class="text-center th2message">0
                        (%0 )
                    </td>
                    <td class="text-center th2redirected">0
                        (%0 )
                    </td>
                    <td class="text-center th2wrong_adress">0
                        (%0 )
                    </td>
                    <td class="text-center th2problem">18
                        (%6.19 )
                    </td>
                    <td class="text-center th2on_delivery">202
                        ( <b> %69.42 </b> )
                    </td>
                    <td class="text-center th2delivered">29
                        (%9.97 )
                    </td>
                    <td class="text-center th2returning">0
                        (%0 )
                    </td>
                    <td class="text-center th2returned">1
                        (%0.34 )
                    </td>
                    <td class="text-center">291 (%9.69 )</td>
                    <td class="text-center">30,365 TRY</td>
                </tr>
                <tr>
                    <th class="text-center">2020-05-06</th>
                    <td class="text-center th2unknown">8
                        (%4.06 )
                    </td>
                    <td class="text-center th2packing">106
                        ( <b> %53.81 </b> )
                    </td>
                    <td class="text-center th2on_the_way">0
                        (%0 )
                    </td>
                    <td class="text-center th2at_departure_unit">9
                        (%4.57 )
                    </td>
                    <td class="text-center th2at_arrival_unit">0
                        (%0 )
                    </td>
                    <td class="text-center th2message">0
                        (%0 )
                    </td>
                    <td class="text-center th2redirected">0
                        (%0 )
                    </td>
                    <td class="text-center th2wrong_adress">0
                        (%0 )
                    </td>
                    <td class="text-center th2problem">0
                        (%0 )
                    </td>
                    <td class="text-center th2on_delivery">74
                        ( <b> %37.56 </b> )
                    </td>
                    <td class="text-center th2delivered">0
                        (%0 )
                    </td>
                    <td class="text-center th2returning">0
                        (%0 )
                    </td>
                    <td class="text-center th2returned">0
                        (%0 )
                    </td>
                    <td class="text-center">197 (%6.56 )</td>
                    <td class="text-center">19,071 TRY</td>
                </tr>
                <tr>
                    <th class="text-center">2020-05-07</th>
                    <td class="text-center th2unknown">82
                        ( <b> %48.52 </b> )
                    </td>
                    <td class="text-center th2packing">86
                        ( <b> %50.89 </b> )
                    </td>
                    <td class="text-center th2on_the_way">0
                        (%0 )
                    </td>
                    <td class="text-center th2at_departure_unit">1
                        (%0.59 )
                    </td>
                    <td class="text-center th2at_arrival_unit">0
                        (%0 )
                    </td>
                    <td class="text-center th2message">0
                        (%0 )
                    </td>
                    <td class="text-center th2redirected">0
                        (%0 )
                    </td>
                    <td class="text-center th2wrong_adress">0
                        (%0 )
                    </td>
                    <td class="text-center th2problem">0
                        (%0 )
                    </td>
                    <td class="text-center th2on_delivery">0
                        (%0 )
                    </td>
                    <td class="text-center th2delivered">0
                        (%0 )
                    </td>
                    <td class="text-center th2returning">0
                        (%0 )
                    </td>
                    <td class="text-center th2returned">0
                        (%0 )
                    </td>
                    <td class="text-center">169 (%5.63 )</td>
                    <td class="text-center">16,491 TRY</td>
                </tr>
                <tr>
                    <th class="text-center">2020-05-08</th>
                    <td class="text-center th2unknown">97
                        ( <b> %100 </b> )
                    </td>
                    <td class="text-center th2packing">0
                        (%0 )
                    </td>
                    <td class="text-center th2on_the_way">0
                        (%0 )
                    </td>
                    <td class="text-center th2at_departure_unit">0
                        (%0 )
                    </td>
                    <td class="text-center th2at_arrival_unit">0
                        (%0 )
                    </td>
                    <td class="text-center th2message">0
                        (%0 )
                    </td>
                    <td class="text-center th2redirected">0
                        (%0 )
                    </td>
                    <td class="text-center th2wrong_adress">0
                        (%0 )
                    </td>
                    <td class="text-center th2problem">0
                        (%0 )
                    </td>
                    <td class="text-center th2on_delivery">0
                        (%0 )
                    </td>
                    <td class="text-center th2delivered">0
                        (%0 )
                    </td>
                    <td class="text-center th2returning">0
                        (%0 )
                    </td>
                    <td class="text-center th2returned">0
                        (%0 )
                    </td>
                    <td class="text-center">97 (%3.23 )</td>
                    <td class="text-center">9,352 TRY</td>
                </tr>
            </tbody>

            <thead class="productGroup" style="">
                <tr>
                    <th colspan="7" style="padding:0px;">
                        <hr>
                    </th>
                    <th align="center" style="text-align: center;padding: 10px;">Ürün Grubu</th>
                    <th colspan="99" style="padding:0px;">
                        <hr>
                    </th>
                </tr>
                <tr>
                </tr>
                <tr>
                    <th class="text-center">Ürün Grubu</th>
                    <th class="text-center thunknown">Bilinmiyor</th>
                    <th class="text-center thpacking">Paketleme</th>
                    <th class="text-center thon_the_way">Yolda</th>
                    <th class="text-center that_departure_unit">Çıkış Şubesinde</th>
                    <th class="text-center that_arrival_unit">Teslimat Şubesinde</th>
                    <th class="text-center thmessage">Uğrama Notlu</th>
                    <th class="text-center thredirected">Yönlendirildi</th>
                    <th class="text-center thwrong_adress">Hatalı Adres</th>
                    <th class="text-center thproblem">Sorunlu</th>
                    <th class="text-center thon_delivery">Teslimatta</th>
                    <th class="text-center thdelivered">Teslim Edildi</th>
                    <th class="text-center threturning">İade Geliyor</th>
                    <th class="text-center threturned">İade</th>
                    <th class="text-center">Toplam</th>
                    <th class="text-center">Toplam (TRY)</th>
                </tr>
            </thead>
            <tbody class="productGroup" style="">
                <tr>
                    <th class="text-center"><a href="http://admin.roket.live/shipment/mini?filter%5Bproduct_group%5D%5B0%5D=4&amp;filter%5Bproduct_group%5D%5B%5D=4" target="_blank">Kilis Macunu</a></th>
                    <td class="text-center th2unknown">208
                        (%6.92 )
                    </td>
                    <td class="text-center th2packing">244
                        (%8.12 )
                    </td>
                    <td class="text-center th2on_the_way">0
                        (%0 )
                    </td>
                    <td class="text-center th2at_departure_unit">20
                        (%0.67 )
                    </td>
                    <td class="text-center th2at_arrival_unit">99
                        (%3.3 )
                    </td>
                    <td class="text-center th2message">0
                        (%0 )
                    </td>
                    <td class="text-center th2redirected">0
                        (%0 )
                    </td>
                    <td class="text-center th2wrong_adress">0
                        (%0 )
                    </td>
                    <td class="text-center th2problem">93
                        (%3.1 )
                    </td>
                    <td class="text-center th2on_delivery">946
                        ( <b> %31.49 </b> )
                    </td>
                    <td class="text-center th2delivered">1110
                        ( <b> %36.95 </b> )
                    </td>
                    <td class="text-center th2returning">0
                        (%0 )
                    </td>
                    <td class="text-center th2returned">284
                        (%9.45 )
                    </td>
                    <td class="text-center">3004 ( <b> %100 </b> )</td>
                    <td class="text-center">313,317 TRY</td>
                </tr>
            </tbody>

            <thead class="productGroup" style="">
                <tr>
                    <th colspan="7" style="padding:0px;">
                        <hr>
                    </th>
                    <th align="center" style="text-align: center;padding: 10px;">Kaynak Grubu</th>
                    <th colspan="99" style="padding:0px;">
                        <hr>
                    </th>
                </tr>
                <tr>
                </tr>
                <tr>
                    <th class="text-center">Kaynak Grubu</th>
                    <th class="text-center thunknown">Bilinmiyor</th>
                    <th class="text-center thpacking">Paketleme</th>
                    <th class="text-center thon_the_way">Yolda</th>
                    <th class="text-center that_departure_unit">Çıkış Şubesinde</th>
                    <th class="text-center that_arrival_unit">Teslimat Şubesinde</th>
                    <th class="text-center thmessage">Uğrama Notlu</th>
                    <th class="text-center thredirected">Yönlendirildi</th>
                    <th class="text-center thwrong_adress">Hatalı Adres</th>
                    <th class="text-center thproblem">Sorunlu</th>
                    <th class="text-center thon_delivery">Teslimatta</th>
                    <th class="text-center thdelivered">Teslim Edildi</th>
                    <th class="text-center threturning">İade Geliyor</th>
                    <th class="text-center threturned">İade</th>
                    <th class="text-center">Toplam</th>
                    <th class="text-center">Toplam (TRY)</th>
                </tr>
            </thead>
            <tbody class="productGroup" style="">
                <tr>
                    <th class="text-center"><a href="http://admin.roket.live/shipment/mini?filter%5Bproduct_group%5D%5B0%5D=4&amp;filter%5Bsource%5D%5B%5D=6" target="_blank">Web</a></th>
                    <td class="text-center th2unknown">164
                        (%5.79 )
                    </td>
                    <td class="text-center th2packing">243
                        (%8.58 )
                    </td>
                    <td class="text-center th2on_the_way">0
                        (%0 )
                    </td>
                    <td class="text-center th2at_departure_unit">20
                        (%0.71 )
                    </td>
                    <td class="text-center th2at_arrival_unit">83
                        (%2.93 )
                    </td>
                    <td class="text-center th2message">0
                        (%0 )
                    </td>
                    <td class="text-center th2redirected">0
                        (%0 )
                    </td>
                    <td class="text-center th2wrong_adress">0
                        (%0 )
                    </td>
                    <td class="text-center th2problem">89
                        (%3.14 )
                    </td>
                    <td class="text-center th2on_delivery">869
                        ( <b> %30.67 </b> )
                    </td>
                    <td class="text-center th2delivered">1081
                        ( <b> %38.16 </b> )
                    </td>
                    <td class="text-center th2returning">0
                        (%0 )
                    </td>
                    <td class="text-center th2returned">284
                        (%10.02 )
                    </td>
                    <td class="text-center">2833 ( <b> %94.31 </b> )</td>
                    <td class="text-center">292,450 TRY</td>
                </tr>
                <tr>
                    <th class="text-center"><a href="http://admin.roket.live/shipment/mini?filter%5Bproduct_group%5D%5B0%5D=4&amp;filter%5Bsource%5D%5B%5D=27" target="_blank">B Elle Onay</a></th>
                    <td class="text-center th2unknown">44
                        ( <b> %25.73 </b> )
                    </td>
                    <td class="text-center th2packing">1
                        (%0.58 )
                    </td>
                    <td class="text-center th2on_the_way">0
                        (%0 )
                    </td>
                    <td class="text-center th2at_departure_unit">0
                        (%0 )
                    </td>
                    <td class="text-center th2at_arrival_unit">16
                        (%9.36 )
                    </td>
                    <td class="text-center th2message">0
                        (%0 )
                    </td>
                    <td class="text-center th2redirected">0
                        (%0 )
                    </td>
                    <td class="text-center th2wrong_adress">0
                        (%0 )
                    </td>
                    <td class="text-center th2problem">4
                        (%2.34 )
                    </td>
                    <td class="text-center th2on_delivery">77
                        ( <b> %45.03 </b> )
                    </td>
                    <td class="text-center th2delivered">29
                        (%16.96 )
                    </td>
                    <td class="text-center th2returning">0
                        (%0 )
                    </td>
                    <td class="text-center th2returned">0
                        (%0 )
                    </td>
                    <td class="text-center">171 (%5.69 )</td>
                    <td class="text-center">20,867 TRY</td>
                </tr>
            </tbody>

        </table>
</div>
    </div>
</div>
</template>

<script>
var todayDate = new Date().toLocaleDateString().split('.').reverse().join('-');
var CargoDetailModal = httpVueLoader('/vue/components/part/CargoDetailModal.vue');
module.exports = {
    name: "CargoDeliveryReportMini",
    components: {
        CargoDetailModal
    },
    props: ["typeId"],
    data() {
        return {
            refreshing: false,
            currentCargoDetail: 0,
            rawData: {

            },
            facets: {

            },
            filter: {
                cargoStatus: '0',
                agentStatus: 'processless',
                status: 0,
                payment_method: 0,
                city: 0,
                startDate: todayDate,
                endDate: todayDate,
                page: 1
            },
            cargoStatusTypes: {
                "0": "Paketleme",
                "1": "Teslimler",
                "2": "İadeler",
                "3": "Haber Formları",
                "4": "Dağıtımda",
                "5": "Kayıp",
                "6": "Sorunlu"
            },
            facetsCargoStatus: {},
            facetsAgentAction: {},
            items: [],
        };
    },
    computed: {
        getFilter() {

            this.getData();
            return this.filter;
        }
    },
    mounted() {
        var todayDate = new Date().toLocaleDateString().split('.').join('/');
        console.log(todayDate);

        //this.getData();
    },
    beforeCreate() {},
    created() {},
    methods: {
        getData() {
            this.refreshing = true;
            this.get(window.apiUrl + "/CargoTracking" + this.$root.getString(this.filter), (res) => {
                this.items = res.data;
                this.facetsCargoStatus = res.facetsCargoStatus;
                this.facetsAgentAction = res.facetsAgentAction;
                this.refreshing = false;
                this.rawData = res;
            });
        },

        getCargoModal(order) {
            this.currentCargoDetail = 0;
            setTimeout(() => {
                this.currentCargoDetail = order
                console.log(this.currentCargoDetail);
            }, 600);

        },
    },
};
</script>

<style scoped>
.modal-lg,
.modal-xl {
    max-width: 1024px;
}

.modal-body.row .form-group.row {
    margin-bottom: 0;
}

.table th, .table th {
    vertical-align: top !important;
}

.table td, .table th {
    padding: 5px;
}
.table td, .table th {
    padding: 5px;
        font-size: 12px;
}
</style>
