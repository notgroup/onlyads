<template>
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">Reklam Hesapları</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Ana Sayfa</a></li>
                            <li class="breadcrumb-item active">Reklam Hesapları</li>
                        </ol>
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end page-title -->

            <!-- START ROW -->
            <div class="row">

                <div class="col-xl-12">
                    <div class="email-leftbar card">


                        <h6 class="">Dönüşümler</h6>


                        <div class="mail-list m-t-10">
                            <a href="#"><span class="harcama float-right">0</span>Harcama: </a>
                            <a href="#"><span class="clicks float-right">0</span>Clicks: </a>
                            <a href="#"><span class="donusum float-right">0</span>Donusum: </a>
                        </div>

                        <h6 class="m-t-20">Filtreler</h6>
                        <div class="form-group row">
                            <label class="col-sm-12 col-form-label">BM Hesabı</label>
                            <div class="col-sm-12">
                                <select class="form-control bm-selector" multiple>
                                    <option value="">Hepsi</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-12 col-form-label">Reklam Hesabı</label>
                            <div class="col-sm-12">
                                <select class="form-control account-selector" multiple>
                                    <option value="">Hepsi</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-12 col-form-label">Hesap Durumu</label>
                            <div class="col-sm-12">
                                <select class="form-control status-selector" multiple>
                                    <option value="">Hepsi</option>
                                </select>
                            </div>
                        </div>
                        <div class="mail-list m-t-10 hide">
                            <a href="#"><span class="mdi mdi-label-outline text-danger mr-2"></span>Freelance</a>
                            <a href="#"><span class="mdi mdi-label-outline text-info mr-2"></span>Social</a>
                            <a href="#"><span class="mdi mdi-label-outline text-primary mr-2"></span>Friends</a>
                            <a href="#"><span class="mdi mdi-label-outline text-success mr-2"></span>Family</a>
                        </div>

                    </div>
                    <div class="email-rightbar mb-3 card m-b-30">
                        <div class="card-body">
                            <h4 class="mt-0 header-title mb-4 hide">Active Deals</h4>
                            <div class="table-responsive">
                                <table id="datatable" class="table table-striped table-bordered  mb-0 table-hover nowrap display" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead class="thead-default">
                                       <tr>
                                        <th width="0">#</th>
                                        <th width="0">Hes.İs.</th>
                                        <th width="0">BM</th>
                                        <th width="0" style="display:none;">Hesap İsmi</th>
                                        <th class="filter-select filter-exact" data-placeholder="Durum Seçiniz">Durumu</th>
                                        <th>Harc.</th>
                                        <th width="0">Click</th>
                                        <th width="0">Cpc</th>
                                        <th width="0">Dön.</th>
                                        <th>D.Mal.</th>
                                        <th style="display:none;">1st. Öncesi</th>
                                        <th style="display:none;">2st. Öncesi</th>
                                        <th>H.Büt</th>
                                        <th class="no-sort hide">Pixel</th>
                                        <th class="filter-select filter-exact" data-placeholder="Kampanya Detayı">K.Det.</th>
                                        <th class="filter-select filter-exact" data-placeholder="Set Detayı">S.Det.</th>
                                        <th class="filter-select filter-exact" data-placeholder="Reklam Detayı">R.Det.</th>
                                        <th class="filter-select filter-exact no-sort" data-placeholder="Reklam Detayı">Tools</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template v-for="(bs, bkey) in adAccounts">
                                        <tr>
                                            <td>{{bkey}}</td>
                                            <td>
                                                <a :href="'https://business.facebook.com/adsmanager/manage/campaigns?act=' + bs.account_id + '&business_id='+ bs.business.id +'&tool=MANAGE_ADS'">
                                                    {{bs.name.substr(0,15)}}
                                                </a>
                                            </td>
                                            <td>{{bs.business.name}}</td>
                                            <td style="display:none;">{{bs.name.substr(0,15)}}</td>
                                            <td>

                                               {{reasons[bs.disable_reason]}}

                                           </td>
                                           <td>{{bs.insights ? bs.insights[0].spend : 0}}</td>
                                           <td>{{bs.insights ? bs.insights[0].clicks : 0}}</td>
                                           <td>{{bs.insights ? parseFloat(bs.insights[0].cpc).toFixed(2) : 0}}</td>
                                           <td>{{bs.insights ? (_.indexBy(bs.insights[0].unique_actions, 'action_type').omni_purchase? _.indexBy(bs.insights[0].unique_actions, 'action_type').omni_purchase.value : 0) : 0}}</td>
                                           <td>{{bs.insights ? (_.indexBy(bs.insights[0].cost_per_unique_action_type, 'action_type').omni_purchase? parseFloat(_.indexBy(bs.insights[0].cost_per_unique_action_type, 'action_type').omni_purchase.value).toFixed(2) : 0) : 0}}</td>
                                           <td style="display:none;">{{0}}</td>
                                           <td style="display:none;">{{0}}</td>
                                           <td>{{bs.balance}}</td>
                                           <td class="hide">{{bs.adspixels[0].name}}</td>
                                           <td>{{_.countBy(bs.campaigns, 'effective_status').ACTIVE ? 'Aktif: ' + _.countBy(bs.campaigns, 'effective_status').ACTIVE : ''}}
                                            {{_.countBy(bs.campaigns, 'effective_status').PAUSED ? 'Pasif: ' + _.countBy(bs.campaigns, 'effective_status').PAUSED : ''}}
                                        </td>

                                        <td>{{_.countBy(bs.adsets, 'effective_status').ACTIVE ? 'Aktif: ' + _.countBy(bs.adsets, 'effective_status').ACTIVE : ''}}
                                            {{_.countBy(bs.adsets, 'effective_status').PAUSED ? 'Durdu: ' + _.countBy(bs.adsets, 'effective_status').PAUSED : ''}}
                                            {{_.countBy(bs.adsets, 'effective_status').WITH_ISSUES ? 'Sorun: ' + _.countBy(bs.adsets, 'effective_status').WITH_ISSUES : ''}}
                                        </td>

                                        <td>{{_.countBy(bs.ads, 'effective_status').ACTIVE ? 'Aktif: ' + _.countBy(bs.ads, 'effective_status').ACTIVE : ''}}
                                            {{_.countBy(bs.ads, 'effective_status').PAUSED ? 'Pasif: ' + _.countBy(bs.ads, 'effective_status').PAUSED : ''}}
                                            {{_.countBy(bs.ads, 'effective_status').ADSET_PAUSED ? 'Pasif: ' + _.countBy(bs.ads, 'effective_status').ADSET_PAUSED : ''}}
                                            {{_.countBy(bs.ads, 'effective_status').DISAPPROVED ? 'Red: ' + _.countBy(bs.ads, 'effective_status').DISAPPROVED : ''}}
                                        </td>

                                        <td>
                                            <div class="btn-group btn-group">
                                                <label class="btn btn-primary waves-effect waves-light"   @click="addModal(bs.account_id, bs.name, bs.business.name)">
                                                    <i class="far fa-sticky-note"></i>

                                                </label>
                                                <label class="btn btn-primary waves-effect waves-light">
                                                 <i class="far fa-eye"></i>
                                             </label>
                                             <label class="btn btn-primary waves-effect waves-light">
                                                 <i class="fas fa-bell"></i>
                                             </label>
                                         </div>
                                     </td>



                                 </tr>
                             </template>

                         </tbody>
                         <tfoot>
                            <tr>
                              <th width="0">#</th>
                              <th width="0">Hesap İsmi</th>
                              <th width="0">BM</th>
                              <th width="0" style="display:none;">Hesap İsmi</th>
                              <th class="filter-select filter-exact" data-placeholder="Durum Seçiniz">Durumu</th>
                              <th>Harcama</th>
                              <th width="0">Click</th>
                              <th width="0">Cpc</th>
                              <th width="0">Dön.</th>
                              <th>D.Mal.</th>
                              <th style="display:none;">1st. Öncesi</th>
                              <th style="display:none;">2st. Öncesi</th>
                              <th>H.Büt</th>
                              <th>Pixel</th>
                              <th class="filter-select filter-exact" data-placeholder="Kampanya Detayı">K.Detayı</th>
                              <th class="filter-select filter-exact" data-placeholder="Set Detayı">S.Detayı</th>
                              <th class="filter-select filter-exact" data-placeholder="Reklam Detayı">R.Detayı</th>
                          </tr>
                      </tfoot>
                  </table>
              </div>

          </div>
      </div>
  </div>

</div>
<!-- END ROW -->

</div>
<!-- container-fluid -->
<button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target=".modal01">Large modal</button>
<div class="modal fade bs-example-modal-lg modal01" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myLargeModalLabel">{{currentAccount.businessName}} - {{currentAccount.name}} Notları</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped table-bordered  mb-0 table-hover nowrap display" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead class="thead-default">
                                <tr>
                                    <th>Türü</th>
                                    <th>Not</th>
                                    <th>Tarih</th>
                                    <th width="0">İşlem</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(not, ni) in notes">
                                    <td>{{not.type}} </td>
                                    <td>{{not.note}}</td>
                                    <td>{{not.updateTime}}</td>
                                    <td><button class="btn btn-primary waves-effect waves-light">
                                     <i class="far fa-trash-alt"></i>
                                 </button></td>
                             </tr>
                         </tbody>
                     </table>
                     <hr class="m-t-10 m-b-20" />
                 </div>
<input type="hidden" name="objectId" v-model="currentNote.objectId">
                 <div class="col-md-6">

                    <div class="form-group">
                        <label>Türü</label>
                        <div>
                            <select class="form-control" v-model="currentNote.type">
                                <option>Select</option>
                                <option>İnceleme</option>
                                <option>Ödeme Yapılacak</option>
                            </select>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary btn-block waves-effect waves-light" @click="addNote()">Gönder</button>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Not</label>
                        <div>
                            <textarea required="" class="form-control" rows="5" v-model="currentNote.note"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</div>
</template>
<script>
function sortColumn(api, page = 'all', columnId = 0, init = 0){
    if (init) {

        $( '.harcama').html(
            parseFloat(api.column( 5, {page:page} ).data().sum()).toFixed(2)
            );

        $( '.clicks').html(
            api.column( 6, {page:page} ).data().sum()
            );

        $( '.donusum').html(
            api.column( 8, {page:page} ).data().sum()
            );
    } else {
        if (columnId == 2) {
            api.column( 3, {page:'all'} ).search( '', false, false )
            .draw();
            api.column( 4, {page:'all'} ).search( '', false, false )
            .draw();

        }




        if (!columnId || columnId != 4) {
            var select4 = $('.status-selector').empty().append('<option value="">Hepsi</option>');
            api.column( 4, {page:page} ).data().unique().sort().each( function ( d, j ) {
                select4.append( '<option value="'+d+'">'+d+'</option>' )
            } );
        };
        if (!columnId || columnId != 3 || columnId == 2) {
            var select3 = $('.account-selector').empty().append('<option value="">Hepsi</option>');
            api.column( 3, {page:page} ).data().unique().sort().each( function ( d, j ) {
                select3.append( '<option value="'+d+'">'+d+'</option>' )
            } );

        }


        if (!columnId) {
            var select2 = $('.bm-selector').empty().append('<option value="">Hepsi</option>');
            api.column( 2, {page:page} ).data().unique().sort().each( function ( d, j ) {
                select2.append( '<option value="'+d+'">'+d+'</option>' )
            } );
        }

    }


}
module.exports = {
    name: "AdAccounts",
    data() {
        return {
            addNoteModal: 1,
            notes: [],
            currentNote:{},
            currentAccount:{},
            adAccounts: [],
            accountLang: {
                "1": "Aktif",
                "2": "Kapalı",
                "3": "UNSETTLED",
                "7": "PENDING_RISK_REVIEW",
                "8": "PENDING_SETTLEMENT",
                "9": "IN_GRACE_PERIOD",
                "100": "PENDING_CLOSURE",
                "101": "CLOSED",
                "201": "ANY_ACTIVE",
                "202": "ANY_CLOSED"
            },
            reasons:{
                "0":"Aktif",
                "1":"Reklam İlkesi",
                "2":"Reklam İp İnceleme",
                "3":"Ödeme Riski",
                "4":"GRAY_ACCOUNT_SHUT_DOWN",
                "5":"ADS_AFC_REVIEW",
                "6":"BUSINESS_INTEGRITY_RAR",
                "7":"PERMANENT_CLOSE",
                "8":"UNUSED_RESELLER_ACCOUNT",
                "9":"UNUSED_ACCOUNT",
            }
        };
    },
    methods: {
        addModal(objectId, accountName, businessName){
            this.currentAccount.name = accountName
            this.currentAccount.businessName = businessName
            this.currentNote = {}
            this.addNoteModal = 1
            $('.modal01').modal('show');
            this.currentNote.objectId = objectId
            this.getNotes(objectId)

        },
        addNote(){
          this.post(window.apiUrl + "/addNote", this.currentNote, (res) => {
            console.log(res);
            delete this.currentNote.note
            delete this.currentNote.type
            this.notes = res
        })
      },
      getNotes(objectId){
          this.get(window.apiUrl + "/getNotes/" + objectId, (res) => {
            console.log(res);
            this.notes = res
        })
      }
  },
  computed: {},
  mounted() {
    this.get('/adAccounts', (res) => {
      if (res) {
       // console.log(res.client_ad_accounts.length, res.owned_ad_accounts);
       let accounts = {}
       let pixels = {}
       let campaigns = []
       let adSets = []
       let ads = []
       let adcreatives = []
       let insights = []
       this.adAccounts = res
        //this.adAccounts = [].concat(res.client_ad_accounts, res.owned_ad_accounts)
        _.each(this.adAccounts, (adAccount) => {
            let account = {

            }
            accounts[adAccount.account_id] = _.pick(adAccount, ['id','name','balance','amount_spent','business','account_id','adspixels'])
           /* if (adAccount.adspixels) {
                pixels[adAccount.account_id] = adAccount.adspixels[0]
            };*/

            if (adAccount.campaigns) {
               campaigns =  campaigns.concat(adAccount.campaigns)
               adSets =  adSets.concat(adAccount.adsets)
               ads =  ads.concat(adAccount.ads)
               adcreatives =  adcreatives.concat(adAccount.adcreatives)
               insights =  insights.concat(adAccount.insights)
           };

       })
        setTimeout(() => {
            console.log(campaigns)
            console.log(adSets)
            console.log(ads)
            console.log(adcreatives)
            console.log(_.indexBy(insights, 'account_id'))


            $('#datatable').DataTable( {
                "pageLength": 50,
                "columnDefs": [ {
                  "targets": 'no-sort',
                  "orderable": false,
              } ],
              drawCallback: function (settings) {
                var api = this.api();
                sortColumn(api, 'current',2, 1);
            },
            initComplete: function () {

                var api = this.api();


                api.column( 2, {page:'all'} ).every( function () {
                    var column = this;
                    var select = $('.bm-selector')
                    .on( 'change', function () {
                        console.log($(this).val())
                        var val = $(this).val().join('|');

                        column
                        .search( val ? '^'+val+'$' : '', true, false )
                        .draw();
                        sortColumn(api, val ? 'current' : 'all',2);
                    } );


                } );

                api.column( 3, {page:'all'} ).every( function () {
                    var column = this;
                    var select = $('.account-selector')
                    .on( 'change', function () {
                        console.log($(this).val())
                        var val = $(this).val().join('|');


                        column
                        .search( val ? '^'+val+'$' : '', true, false )
                        .draw();
                        sortColumn(api, val ? 'current' : 'all', 3);


                    } );


                } );

                api.column( 4, {page:'all'} ).every( function () {
                    var column = this;
                    var select = $('.status-selector')
                    .on( 'change', function () {
                        console.log($(this).val())
                        var val = $(this).val().join('|');

                        column
                        .search( val ? '^'+val+'$' : '', true, false )
                        .draw();
                        sortColumn(api, val ? 'current' : 'all', 4);
                    } );


                } );
                sortColumn(api, 'all', 0);


            }
        } );





        },100);

    }

})
},
beforeCreate() {},
created() {}
}
</script>
<style>
@import "/assets/plugins/datatables/dataTables.bootstrap4.min.css";
@import "/assets/plugins/datatables/buttons.bootstrap4.min.css";
@import "/assets/plugins/datatables/responsive.bootstrap4.min.css";
</style>

