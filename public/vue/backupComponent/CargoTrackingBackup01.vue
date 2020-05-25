<template>
<div class="content">
    <div class="container-fluid">
        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4 class="page-title">CargoTracking</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);">AnaSayfa</a>
                        </li>
                        <li class="breadcrumb-item active">
                            CargoTracking
                        </li>
                    </ol>
                </div>
            </div>
            <!-- end row -->
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="email-leftbar card" @click="filter.page = 1">

                    <div class="form-group row">
                        <label class="col-sm-12 col-form-label">Durumu</label>
                        <div class="col-sm-12">
                            <select class="form-control adstatus-selector multiselector" v-model="filter.payment_method">
                                <option value="0" selected>Hepsi</option>
                                <template v-for="(item, itemi) in $root.clientInit.paymentMethods">
                                    <option :key="itemi" :value="item.content_id">{{item.meta.name}} </option>
                                </template>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-form-label">Sehir</label>
                        <div class="col-sm-12">
                            <select class="form-control adstatus-selector multiselector" v-model="filter.city">
                                <option value="0" selected>Hepsi</option>
                                <template v-for="(item, itemi) in _.groupBy(this.$root.clientInit.cities,'country_id')[215]">
                                    <option :key="itemi" :value="item.zone_id">{{item.name}} </option>
                                </template>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-date-input" class="col-12 col-form-label">Tarih</label>
                        <label for="example-date-input" class="col-2 col-form-label"><i class="fas fa-calendar-alt"></i></label>
                        <div class="col-10">
                            <input class="form-control" type="date" id="example-date-input" :max="filter.endDate" v-model="filter.startDate" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-date-input" class="col-2 col-form-label"><i class="fas fa-calendar-alt"></i></label>
                        <div class="col-10">
                            <input class="form-control" type="date" id="example-date-input" :min="filter.startDate" v-model="filter.endDate" />
                        </div>
                    </div>
                    <button class="btn btn-primary btn-block" :disabled="refreshing">
                        <i class="fas fa-sync mr-2" :class="[refreshing ? 'fa-spin' : '']"></i> Göster</button>
                </div>
                <div class="email-rightbar mb-3 card m-b-30">
                    <div class="card-body" v-if="getFilter">
                        <table class="table table-striped table-bordered table-responsive mb-0 table-hover nowrap display" style="
                            border-collapse: collapse;
                            border-spacing: 0;
                            width: 100%;
                        ">
                            <thead class="thead-default">
                                <tr>
                                    <th width="1%">G.No</th>
                                    <th width="1%">S.No</th>
                                    <th width="1%">Durumu</th>
                                    <th width="1%">A.Adı</th>
                                    <th width="1%">A.Soyad</th>
                                    <th width="1%">Sehir</th>
                                    <th width="1%">Sube</th>
                                    <th width="1%">O.Sonuc</th>
                                    <th width="1%">Sonuc</th>
                                    <th width="1%">Tutar</th>
                                    <th width="1%">A.Tarih</th>
                                    <th width="1%">S.Tarih</th>
                                    <th width="1%">Tools</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, itemi) in items" v-if="item.meta.cargoDetail">
                                    <td @click="getCargoDetail(item)">{{ item.meta.cargoDetail.gonderino }}</td>
                                    <td @click="getCargoDetail(item)">{{ item.meta.cargoDetail.sipno }}</td>
                                    <td>{{ cargoStatusTypes[item.meta.cargoDetail.durum] }}</td>
                                    <td>{{ item.meta.cargoDetail.aliciadi }}</td>
                                    <td>{{ item.meta.cargoDetail.alicisoyad }}</td>
                                    <td>{{ item.meta.cargoDetail.sehiradi }}</td>
                                    <td>{{ item.meta.cargoDetail.sube }}</td>
                                    <td>{{ item.meta.cargoDetail.onsonuc }}</td>
                                    <td>{{ item.meta.cargoDetail.sonuc }}</td>
                                    <td>{{ item.meta.cargoDetail.tutar }}</td>
                                    <td>{{ item.meta.cargoDetail.alimtarihi }}</td>
                                    <td>{{ item.meta.cargoDetail.sonuctarihi }}</td>

                                    <td>
                                        <div class="btn-group btn-group">
                                            <button class="btn btn-primary waves-effect waves-light" @click="getCargoModal(item)">
                                                <i class="far fa-eye"></i>
                                            </button>
                                            <button class="btn btn-primary waves-effect waves-light" @click="getCargoDetail(item)">
                                                <i class="far fa-edit"></i>
                                            </button>
                                            <button class="btn btn-primary waves-effect waves-light" @click="getCargoDetail(item)">
                                                <i class="fa fa-truck"></i>
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
        <button type="button" class="btn btn-primary waves-effect waves-light hide" data-toggle="modal" data-target=".modal01">Large modal</button>
        <div class="modal fade bs-example-modal-lg modal01" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" style="max-width: 1024px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="myLargeModalLabel">Detay</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body row">
                       
                        <div class="col-md-12">

                            <div class="form-group row">
                                <label class="col-sm-2 control-label" style="text-align:left;">İşlemler</label>
                                <div class="col-sm-12" style="margin-bottom: 20px;">

                                    <select class="form-control input-sm table-filter-input actions" name="actions">
                                        <option value="">İşlemler...</option>
                                        <option value="processless" selected="selected">İşlemsiz</option>
                                        <option value="not_get_cargo">Kargo getirilmedi</option>
                                        <option value="delivered">Teslim edildi</option>
                                        <option value="not_get">İstemiyor</option>
                                        <option value="notreached">Ulaşılamadı</option>
                                        <option value="callagain">Tekrar Aranacak</option>
                                        <option value="resale">Tekrar Satış</option>
                                        <option value="redeploy">WhatsApp İletişim</option>
                                        <option value="whatsapp">WhatsApp</option>
                                        <option value="cancel">İptal</option>
                                        <option value="inprocess">İşlem Yapılıyor</option>
                                        <option value="sendedcargo">Cross</option>
                                        <option value="backoffice">Cross 2</option>
                                        <option value="wrong_number">WhatsApp Yok</option>
                                    </select>
                                    <im class="form-control-static copyfield col-sm-3" style="display:none;">
                                        <a href="http://admin.roket.live/order/3149/copy" target="_blank" class="btn btn-default btn-sm"><i class="fa fa-copy"></i> Kopya Sipariş Oluştur</a>
                                    </im>

                                </div>
                                <div class="col-sm-12">
                                    <textarea id="input-address" class="form-control notes" rows="3" placeholder="Notlar" name="notes" cols="50" style="margin-bottom: 20px;"></textarea>
                                    <button target="_blank" class="btn btn-primary btn-sm save-status" data-id="3149"><i class="fa fa-save"></i> Kaydet</button>

                                </div>
                            </div>

                            <hr />
                        </div>
                         <div class="col-md-6">
                            <dl class="row mb-0" v-if="currentCargoDetail.meta">

                                <dt class="col-sm-5">İsim</dt>
                                <dd class="col-sm-7">
                                    <div class="btn-group btn-group">
                                        <button class="btn btn-primary waves-effect waves-light">
                                            <i class="far fa-eye"></i>
                                        </button>
                                        <button class="btn btn-primary waves-effect waves-light">
                                            <i class="far fa-edit"></i>
                                        </button>
                                        <button class="btn btn-primary waves-effect waves-light">
                                            <i class="fa fa-truck"></i>
                                        </button>
                                    </div>
                                </dd>
                                <dt class="col-sm-5">Telefon</dt>
                                <dd class="col-sm-7">testvalue</dd>
                                <dt class="col-sm-5">Gönderi Kodu</dt>
                                <dd class="col-sm-7">testvalue</dd>
                                <dt class="col-sm-5">Gönderi Ödemesi</dt>
                                <dd class="col-sm-7">testvalue</dd>
                                <dt class="col-sm-5">Kargo Firması</dt>
                                <dd class="col-sm-7">testvalue</dd>
                                <dt class="col-sm-5">Tarih</dt>
                                <dd class="col-sm-7">testvalue</dd>
                                <dt class="col-sm-5">Adres</dt>
                                <dd class="col-sm-7">testvalue</dd>

                            </dl>
                        </div>
                        <div class="col-md-6">
                            <dl class="row mb-0" v-if="currentCargoDetail.meta">

                                <dt class="col-sm-5">Çıkış Tarihi</dt>
                                <dd class="col-sm-7">testvalue</dd>
                                <dt class="col-sm-5">Teslimat Durumu</dt>
                                <dd class="col-sm-7">testvalue</dd>
                                <dt class="col-sm-5">Takip Numarası</dt>
                                <dd class="col-sm-7">testvalue</dd>
                                <dt class="col-sm-5">Varış Şubesi</dt>
                                <dd class="col-sm-7">testvalue</dd>
                                <dt class="col-sm-5">Durum Açıklaması</dt>
                                <dd class="col-sm-7">testvalue</dd>
                                <dt class="col-sm-5">Fatura Numarası</dt>
                                <dd class="col-sm-7">testvalue</dd>
                                <dt class="col-sm-5">İrsaliye Numarası</dt>
                                <dd class="col-sm-7">testvalue</dd>
                                <dt class="col-sm-5">Güncelleme Tarihi</dt>
                                <dd class="col-sm-7">testvalue</dd>

                            </dl>
                        </div>
                        <div class="col-md-6 hide ">
                            <div class="form-group row">
                                <label class="col-sm-6 control-label">İsim</label>
                                <div class="col-sm-6">
                                    <p class="form-control-static">
                                        HÜSEYİN İNCE
                                    </p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 control-label">Telefon</label>
                                <div class="col-sm-8">
                                    <p class="form-control-static" style="float: left;width: 50%;">
                                        5418813480
                                    </p>
                                    <span class="input-group-btn" style="float:left;width: 25%;">
                                        <a href="http://admin.roket.live/api/order/3149/called?phone_number=5418813480" data-target=".history-container" data-method="POST" data-html="true" data-url="call:05418813480" class="btn btn-default btn-sm ajax-link popup-link" onclick="return false;" data-loading-text="Lütfen Bekleyin..."><i class="fa fa-headphones"></i></a>
                                    </span>
                                    <span class="input-group-btn" style="float:left;width: 25%;">
                                        <a data-id="3149" data-phone="905418813480" data-name="HÜSEYİN İNCE" data-order="67E8989D" data-product="Kilis Macunu" data-kargo="MNG KARGO" class="btn btn-default btn-sm btn-whatsapp" onclick="return false;" data-loading-text="Lütfen Bekleyin..."><i class="fa fa-whatsapp"></i></a>
                                        <a data-id="3149" data-phone="905418813480" data-name="HÜSEYİN İNCE" data-order="67E8989D" data-product="Kilis Macunu" data-kargo="MNG KARGO" class="btn btn-default btn-sm btn-sms" onclick="return false;" data-loading-text="Lütfen Bekleyin..."><i class="fa fa-comments"></i></a>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-6 control-label">Gönderi Kodu</label>
                                <div class="col-sm-6">
                                    <p class="form-control-static">
                                        67E8989D
                                    </p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-6 control-label">Gönderi Ödemesi</label>
                                <div class="col-sm-6">
                                    <p class="form-control-static">
                                        Gönderici Ödemeli
                                    </p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-6 control-label">Kargo Firması</label>
                                <div class="col-sm-6">
                                    <p class="form-control-static">
                                        Deposer
                                    </p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-6 control-label">Tarih</label>
                                <div class="col-sm-6">
                                    <p class="form-control-static">
                                        27.04.2020 - 16:38:14
                                    </p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 control-label text-left">Adres</label>
                                <div class="col-sm-12">
                                    <p class="form-control-static">
                                        ŞAKRAN BELDESİ UYANIK ÇAY EVİ NO:1/A(İŞ YERİ)
                                        &nbsp;
                                        Aliağa / İzmir - Türkiye
                                    </p>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6 hide">
                            <div class="form-group row">
                                <label class="col-sm-6 control-label">Çıkış Tarihi</label>
                                <div class="col-sm-6">
                                    <p class="form-control-static">
                                        27.04.2020
                                    </p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-6 control-label">Teslimat Durumu</label>
                                <div class="col-sm-6">
                                    <p class="form-control-static">
                                        <label class="label label-status label-warning"> Teslimat Şubesinde </label>
                                    </p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-6 control-label">Takip Numarası</label>
                                <div class="col-sm-6">
                                    <p class="form-control-static">
                                        952329400072
                                        <a href="http://kargotakip.deposerileti.com:90/mng2.asp?har_kod=952329400072" class="btn btn-default btn-sm ajax-link popup-link" onclick="return false;" data-method="GET" data-loading-text="Lütfen Bekleyin..."><i class="fa fa-truck" aria-hidden="true"></i></a>
                                    </p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-6 control-label">Varış Şubesi</label>
                                <div class="col-sm-6">
                                    <p class="form-control-static">
                                        MNG KARGO
                                    </p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-6 control-label">Durum Açıklaması</label>
                                <div class="col-sm-6">
                                    <p class="form-control-static">
                                        Not Bırakıldı
                                    </p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-6 control-label">Fatura Numarası</label>
                                <div class="col-sm-6">67E8989D
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-6 control-label">İrsaliye Numarası</label>
                                <div class="col-sm-6">

                                    67E8989D
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-6 control-label">Güncelleme Tarihi</label>
                                <div class="col-sm-6">

                                    07.05.2020 - 19:43:08
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12">
                              <h6>Ürünler</h6>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Ürün</th>
                                        <th>Adet</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>
                                            <div class="pull-left" style="margin-left: 15px;">
                                                <b>Kilis Macunu 1 Adet 240 Gram</b>
                                            </div>
                                        </td>
                                        <td>
                                            <b>1</b>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

<div class="col-sm-12 hide" style="
    max-height: 300px;
    overflow-y: auto;
">
  <h6>Geçmiş</h6>
    


<table class="table table-striped table-hover table-fixed">
            <thead>
                <tr>
                    <th style="width: 15%;">Tarih</th>
                    <th style="width: 20%;">Durum</th>
                    <th style="width: 20%;">Açıklama</th>
                    <th style="width: 15%;">E-posta</th>
                    <th style="width: 15%;">SMS</th>
                    <th style="width: 15%;">Yönetici</th>
                </tr>
            </thead>
            <tbody>
                        <tr>
                <td style="width: 15%;">29.04.2020 - 09:57:42</td>
                <td style="width: 20%;">Görüntülendi</td>
                <td style="width: 20%;"></td>
                <td style="width: 15%;">
                                        ---
                                    </td>
                <td style="width: 15%;">
                                        ---
                                    </td>
                <td style="width: 15%;">İBRAHİM ÖKSÜZ (ibrahimo)</td>
            </tr>
                        <tr>
                <td style="width: 15%;">29.04.2020 - 09:57:45</td>
                <td style="width: 20%;">Ulaşılamadı</td>
                <td style="width: 20%;"></td>
                <td style="width: 15%;">
                                        ---
                                    </td>
                <td style="width: 15%;">
                                        ---
                                    </td>
                <td style="width: 15%;">İBRAHİM ÖKSÜZ (ibrahimo)</td>
            </tr>
                        <tr>
                <td style="width: 15%;">29.04.2020 - 10:57:27</td>
                <td style="width: 20%;">Yeni Sipariş</td>
                <td style="width: 20%;"></td>
                <td style="width: 15%;">
                                        ---
                                    </td>
                <td style="width: 15%;">
                                        ---
                                    </td>
                <td style="width: 15%;">FE FE (FE)</td>
            </tr>
                        <tr>
                <td style="width: 15%;">29.04.2020 - 11:12:25</td>
                <td style="width: 20%;">Görüntülendi</td>
                <td style="width: 20%;"></td>
                <td style="width: 15%;">
                                        ---
                                    </td>
                <td style="width: 15%;">
                                        ---
                                    </td>
                <td style="width: 15%;">Erkan Arslanoğlu (erkana)</td>
            </tr>
                        <tr>
                <td style="width: 15%;">29.04.2020 - 11:12:49</td>
                <td style="width: 20%;">Ulaşılamadı</td>
                <td style="width: 20%;"></td>
                <td style="width: 15%;">
                                        ---
                                    </td>
                <td style="width: 15%;">
                                        ---
                                    </td>
                <td style="width: 15%;">Erkan Arslanoğlu (erkana)</td>
            </tr>
                        <tr>
                <td style="width: 15%;">29.04.2020 - 11:52:12</td>
                <td style="width: 20%;">Yeni Sipariş</td>
                <td style="width: 20%;"></td>
                <td style="width: 15%;">
                                        ---
                                    </td>
                <td style="width: 15%;">
                                        ---
                                    </td>
                <td style="width: 15%;">FE FE (FE)</td>
            </tr>
                        <tr>
                <td style="width: 15%;">29.04.2020 - 12:08:48</td>
                <td style="width: 20%;">Görüntülendi</td>
                <td style="width: 20%;"></td>
                <td style="width: 15%;">
                                        ---
                                    </td>
                <td style="width: 15%;">
                                        ---
                                    </td>
                <td style="width: 15%;">Erkan Arslanoğlu (erkana)</td>
            </tr>
                        <tr>
                <td style="width: 15%;">29.04.2020 - 12:10:22</td>
                <td style="width: 20%;">Güncellendi</td>
                <td style="width: 20%;"></td>
                <td style="width: 15%;">
                                        ---
                                    </td>
                <td style="width: 15%;">
                                        ---
                                    </td>
                <td style="width: 15%;">Erkan Arslanoğlu (erkana)</td>
            </tr>
                        <tr>
                <td style="width: 15%;">29.04.2020 - 12:10:24</td>
                <td style="width: 20%;">Onaylandı</td>
                <td style="width: 20%;"></td>
                <td style="width: 15%;">
                                        ---
                                    </td>
                <td style="width: 15%;">
                                        29.04.2020 - 12:10:24
                                                        </td>
                <td style="width: 15%;">Erkan Arslanoğlu (erkana)</td>
            </tr>
                        <tr>
                <td style="width: 15%;">29.04.2020 - 12:10:27</td>
                <td style="width: 20%;">Güncellendi</td>
                <td style="width: 20%;"></td>
                <td style="width: 15%;">
                                        ---
                                    </td>
                <td style="width: 15%;">
                                        ---
                                    </td>
                <td style="width: 15%;">Erkan Arslanoğlu (erkana)</td>
            </tr>
                        <tr>
                <td style="width: 15%;">29.04.2020 - 12:10:27</td>
                <td style="width: 20%;">Güncellendi</td>
                <td style="width: 20%;"></td>
                <td style="width: 15%;">
                                        ---
                                    </td>
                <td style="width: 15%;">
                                        ---
                                    </td>
                <td style="width: 15%;">Erkan Arslanoğlu (erkana)</td>
            </tr>
                        <tr>
                <td style="width: 15%;">29.04.2020 - 16:16:38</td>
                <td style="width: 20%;">Kargoya Verildi</td>
                <td style="width: 20%;"></td>
                <td style="width: 15%;">
                                        ---
                                    </td>
                <td style="width: 15%;">
                                        ---
                                    </td>
                <td style="width: 15%;">Aysun Eke (aysuneke)</td>
            </tr>
                        <tr>
                <td style="width: 15%;">08.05.2020 - 10:09:44</td>
                <td style="width: 20%;">Kargo işlemi yapıldı</td>
                <td style="width: 20%;">İşlem Yapılıyor</td>
                <td style="width: 15%;">
                                        ---
                                    </td>
                <td style="width: 15%;">
                                        ---
                                    </td>
                <td style="width: 15%;">Gökhan Çelik (gkhan)</td>
            </tr>
                        <tr>
                <td style="width: 15%;">08.05.2020 - 10:09:52</td>
                <td style="width: 20%;">Kargo işlemi yapıldı</td>
                <td style="width: 20%;">İşlemsiz</td>
                <td style="width: 15%;">
                                        ---
                                    </td>
                <td style="width: 15%;">
                                        ---
                                    </td>
                <td style="width: 15%;">Gökhan Çelik (gkhan)</td>
            </tr>
                        </tbody>
        </table></div>


                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>
</div>
</template>

<script>
var todayDate = new Date().toLocaleDateString().split('.').reverse().join('-');
module.exports = {
    name: "CargoTracking",
    props: ["typeId"],
    data() {
        return {
            refreshing: false,
            currentCargoDetail: {},
            facets: {

            },
            filter: {
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
                "6": "Sorunlu",
                "1,2,6": "Teslim,İade ve Sorunlu kargolar",
            },
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
                this.items = res.item;
                this.refreshing = false;
            });
        },
        getCargoDetail(order) {
            this.currentCargoDetail = {}
            this.get(window.apiUrl + "/CargoTracking/" + order.meta.cargoDetail.sipno, (res) => {
                window.open(res.url, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=200,left=300,width=800,height=600");
                this.currentCargoDetail = Object.assign(order, res);
                //  
                console.log(res)

            });
        },
        getCargoModal(order) {
            this.currentCargoDetail = order
            console.log(this.currentCargoDetail);

            $('.modal01').modal('show');
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
</style>
