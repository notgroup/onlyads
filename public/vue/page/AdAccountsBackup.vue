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

<button class="btn btn-primary btn-block" @click="getAdAccounts()" :disabled="refreshing">
 <i class="fas fa-sync mr-2" :class="[refreshing ? 'fa-spin' : '']"></i> 
  Yenile</button>
           

            <h6 class="m-t-20 hide">Filtreler</h6>
            <div class="form-group row">
              <label for="example-date-input" class="col-12 col-form-label">Tarih</label>
              <label for="example-date-input" class="col-2 col-form-label"><i class="fas fa-calendar-alt"></i></label>
              <div class="col-10">
                <input class="form-control" type="date" id="example-date-input" :max="filterDateEnd" v-model="filterDate" @change="newDateRequest()" />
              </div>
            </div>
            <div class="form-group row">
              <label for="example-date-input" class="col-2 col-form-label"><i class="fas fa-calendar-alt"></i></label>
              <div class="col-10">
                <input class="form-control" type="date" id="example-date-input" :min="filterDate" v-model="filterDateEnd" @change="newDateRequest()" />
              </div>
            </div>


            <div class="form-group row">
              <label class="col-sm-12 col-form-label">Hesap Durumu</label>
              <div class="col-sm-12">
                <select class="form-control status-selector multiselector" multiple>
                  <option value="">Hepsi</option>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-12 col-form-label">Reklam Durumu</label>
              <div class="col-sm-12">
                <select class="form-control adstatus-selector multiselector" multiple>
                  <option value="">Hepsi</option>
                  <option value="ACTIVE">Aktif</option>
                  <option value="PAUSED">Durdu</option>
                  <option value="Yok">Yok</option>
                  <option value="DISAPPROVED">Reddedildi</option>
                  <option value="WITH_ISSUES">Sorun Var</option>
                  <option value="ADSET_PAUSED">Set Durdu</option>
                </select>
              </div>
            </div>

 <h6 class="">Dönüşümler</h6>


            <div class="mail-list m-t-10">
              <a href="#"><span class="tarih float-right">{{filterDate}}</span>Tarih: </a>
              <a href="#"><span class="harcama float-right">0</span>Harcama: </a>
              <a href="#"><span class="clicks float-right">0</span>Clicks: </a>
              <a href="#"><span class="donusum float-right">0</span>Donusum: </a>
              <a href="#"><span class="donusumOrtalamasi float-right">0</span>D.Ort: </a>
            </div>




            <div class="form-group row hide">
              <label class="col-sm-12 col-form-label">BM Hesabı</label>
              <div class="col-sm-12">
                <select class="form-control bm-selector" multiple>
                  <option value="">Hepsi</option>
                </select>
              </div>
            </div>

            <div class="form-group row hide">
              <label class="col-sm-12 col-form-label">Reklam Hesabı</label>
              <div class="col-sm-12">
                <select class="form-control account-selector" multiple>
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

              <div class="table-responsive">
                <table id="datatable" class="table table-striped table-bordered  mb-0 table-hover nowrap display row-reorder" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                  <thead class="thead-default">
                   <tr>
                    <th width="0" row-reordered class="row-reordered reordered reorder row-reorder">#</th>
                    <th width="0">Hes.İs.</th>
                    <th width="0">BM</th>
                    <th width="0" class="">Bütçe</th>
                    <th width="0">Durumu</th>
                    <th width="0">Harc.</th>
                    <th width="0">Click</th>
                    <th width="0">Cpc</th>
                    <th width="0">Dön.</th>
                    <th width="0">D.Mal.</th>
                    <th class="hide">H.Büt</th>
                    <th width="0">R.Det.</th>
                    <th width="0">Not</th>
                    <th width="0" class="hide">sort</th>
                    <th  width="0" class="no-sort">Tools</th>
                  </tr>
                </thead>
                <tbody>
                  <template v-for="(bs, bkey) in adAccounts">
                    <tr :class="[bs.account_status > 1 ? 'bg-danger-table' : 'bg-success-table']">
                      <td class="keyi"></td>
                      <td :class="[bs.is_prepay_account ? 'bg-success' : '']">{{bs.name.toLocaleLowerCase('tr')}}</td>
                      <td>{{(bs.business_name || bs.business.name).toLocaleLowerCase('tr')}}</td>
                      <td>{{bs.campaigns ? (bs.campaigns[0].daily_budget/100) : '0'}} </td>
                      <td>{{bs.disable_reason ? reasons[bs.disable_reason] + '/' : ''}}{{accountLang[bs.account_status]}} </td>
                      <td>{{bs.insights ? parseFloat(bs.insights[0].spend).toFixed(2) : 0}}</td>
                      <td>{{bs.insights ? bs.insights[0].unique_clicks : 0}}</td>
                      <td>{{bs.insights ? parseFloat(bs.insights[0].cost_per_unique_click).toFixed(2) : 0}}</td>
                      <td>{{bs.insights ? (_.indexBy(bs.insights[0].unique_actions, 'action_type').omni_purchase? _.indexBy(bs.insights[0].unique_actions, 'action_type').omni_purchase.value : 0) : 0}}</td>
                      <td>{{bs.insights ? (_.indexBy(bs.insights[0].cost_per_unique_action_type, 'action_type').omni_purchase? parseFloat(_.indexBy(bs.insights[0].cost_per_unique_action_type, 'action_type').omni_purchase.value).toFixed(2) : 0) : 0}}</td>
                      <td class="hide">0</td>
                      <td :class="[!(_.pluck(bs.ads, 'effective_status').includes('ACTIVE')) ? 'bg-warning' : '']">
                        {{(bs.ads ? _.pluck(bs.ads, 'effective_status').join(',') : 'Yok')}}
                        </td>
                                              <td>{{(allNotes[bs.account_id] ? (allNotes[bs.account_id].note ? allNotes[bs.account_id].note : allNotes[bs.account_id].type) : 'Yok')}}</td>
                                              <td class="hide">{{(bs.disable_reason || bs.account_status > 1) ? 10 : (!(_.pluck(bs.ads, 'effective_status').includes('ACTIVE')) ? 9 : 0)}}</td>

                      <td>
                        <div class="btn-group btn-group">
                          <label class="btn btn-default waves-effect waves-light"   @click="addModal(bs.account_id, bs.name, bs.business_name || bs.business.name)">
                            <i class="far fa-sticky-note"></i>

                          </label>
                          <label class="btn btn-default waves-effect waves-light" :class="[]">
                           <i class="far fa-credit-card"></i>
                         </label>
                         <label class="btn btn-default waves-effect waves-light" >
                           <i class="fas fa-cog"></i>
                         </label>
                       </div>
                     </td>
                   </tr>
                 </template>

               </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>

  </div>
  <!-- END ROW -->

</div>
<div id="result"></div>
<!-- container-fluid -->
<button type="button" class="btn btn-primary waves-effect waves-light hide" data-toggle="modal" data-target=".modal01">Large modal</button>
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
                  <td>
                    <button class="btn btn-primary waves-effect waves-light" @click="deleteNote(not.id)">
                     <i class="far fa-trash-alt"></i>
                   </button>
                 </td>
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
                <option>Diğer</option>
                <option>PLANLANDI</option>
                <option>5Lİ HAZIR</option>
                <option>Kampanya Aktif</option>
                <option>Kampanya Revize </option>
                <option>Değerlendirme Talebi</option>
                <option>İlke İtiraz</option>
                <option>Sıradışı İtiraz</option>
                <option>İnceleme Bekliyor</option>
                <option>İşletme Engellendi</option>
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


/*

 {{bs.ads && bs.ads[0].ad_review_feedback ? adLangs[_.keys(bs.ads[0].ad_review_feedback.global)[0]] : ''}}
{{_.countBy(bs.ads, 'effective_status').ACTIVE ? 'Akt.: ' + _.countBy(bs.ads, 'effective_status').ACTIVE : ''}}
{{_.countBy(bs.ads, 'effective_status').PAUSED ? 'Dur.: ' + _.countBy(bs.ads, 'effective_status').PAUSED : ''}}
{{_.countBy(bs.ads, 'effective_status').ADSET_PAUSED ? 'Dur.: ' + _.countBy(bs.ads, 'effective_status').ADSET_PAUSED : ''}}
{{_.countBy(bs.ads, 'effective_status').DISAPPROVED ? 'Red: ' + _.countBy(bs.ads, 'effective_status').DISAPPROVED : ''}}
{{_.countBy(bs.ads, 'effective_status').WITH_ISSUES ? 'Sor.: ' + _.countBy(bs.ads, 'effective_status').WITH_ISSUES : ''}}
//account_status
1 = ACTIVE
2 = DISABLED
3 = UNSETTLED
7 = PENDING_RISK_REVIEW
8 = PENDING_SETTLEMENT
9 = IN_GRACE_PERIOD
100 = PENDING_CLOSURE
101 = CLOSED
201 = ANY_ACTIVE
202 = ANY_CLOSED



//disable_reason
0 = NONE
1 = ADS_INTEGRITY_POLICY
2 = ADS_IP_REVIEW
3 = RISK_PAYMENT
4 = GRAY_ACCOUNT_SHUT_DOWN
5 = ADS_AFC_REVIEW
6 = BUSINESS_INTEGRITY_RAR
7 = PERMANENT_CLOSE
8 = UNUSED_RESELLER_ACCOUNT
9 = UNUSED_ACCOUNT



//funding_source_details
0 = UNSET
1 = CREDIT_CARD
2 = FACEBOOK_WALLET
3 = FACEBOOK_PAID_CREDIT
4 = FACEBOOK_EXTENDED_CREDIT
5 = ORDER
6 = INVOICE
7 = FACEBOOK_TOKEN
8 = EXTERNAL_FUNDING
9 = FEE
10 = FX
11 = DISCOUNT
12 = PAYPAL_TOKEN
13 = PAYPAL_BILLING_AGREEMENT
14 = FS_NULL
15 = EXTERNAL_DEPOSIT
16 = TAX
17 = DIRECT_DEBIT
18 = DUMMY
19 = ALTPAY
20 = STORED_BALANCE

:href="'https://business.facebook.com/adsmanager/manage/campaigns?act=' + bs.account_id + '&business_id='+ bs.business.id +'&tool=MANAGE_ADS'"

*/
function sortColumn(api, page = 'all', columnId = 0, init = 0){
  if (init) {

    let totalHarcam = parseFloat(api.column( 5, {page:page} ).data().sum()).toFixed(2);
    let totalClick = api.column( 6, {page:page} ).data().sum();
    let totalDonusum = api.column( 8, {page:page} ).data().sum();
    $( '.harcama').html(
      totalHarcam
      );

    $( '.clicks').html(
      totalClick
      );
    $( '.donusumOrtalamasi').html(
      totalDonusum ? parseFloat(totalHarcam/(totalDonusum || 1)).toFixed(2) : totalHarcam
      );

    $( '.donusum').html(
      totalDonusum
      );
    $('.keyi').each( function ( d, j) {
      $(j).html(d+1);
    } );
  } else {
    if (columnId == 2) {
      api.column( 1, {page:'all'} ).search( '', false, false )
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
      api.column( 1, {page:page} ).data().unique().sort().each( function ( d, j ) {
        d = d ? d : 'Yok'
        select3.append( '<option value="'+d+'">'+d+'</option>' )
      } );

    }


    if (!columnId) {
      var select2 = $('.bm-selector').empty().append('<option value="">Hepsi</option>');
      api.column( 2, {page:page} ).data().unique().sort().each( function ( d, j ) {
        d = d ? d : 'Yok'
        select2.append( '<option value="'+d+'">'+d+'</option>' )
      } );

    api.column( 13, {page:'all'} )
    .order( 'asc' )
    .draw();

    }

  }

}

var todayDate = new Date().toLocaleDateString().split('.').reverse().join('-');

module.exports = {
  name: "AdAccounts",
  props:['bmId'],
  data() {
    return {
      table: undefined,
      filterDate: todayDate,
      filterDateEnd: todayDate,
      addNoteModal: 1,
      refreshing: true,
      notes: [],
      allNotes: [],
      currentNote:{},
      currentAccount:{},
      adAccounts: [],
      adLangs: {
        "ADULT_CONTENT": "Adult.",
        "PORN": "Porn."
      },
      accountLang: {
        "1": "Aktif",
        "2": "Kapalı",
        "3": "Ödeme Sorunu",
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
        "3":"Sıradışı",
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
    newDateRequest(filterDate = this.filterDate, filterDateEnd = this.filterDateEnd){
      this.getAdAccounts(filterDate, filterDateEnd)
    },
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
        //console.log(res);
        delete this.currentNote.note
        delete this.currentNote.type
        this.notes = res
      })
    },
    deleteNote(notId){
      this.get(window.apiUrl + "/deleteNote/" + notId, (res) => {
        this.notes = res.reverse();
        this.getAllNotes();
      })
    },
    getNotes(objectId){
      this.get(window.apiUrl + "/getNotes/" + objectId, (res) => {
        //console.log(res);
        this.notes = res.reverse();
      })
    },
    getAllNotes(){
      this.get(window.apiUrl + "/getAllNotes", (res) => {
        //console.log(res);
        this.allNotes = _.indexBy(res, 'objectId')
      })
    },
    getAdAccounts(filterDate = this.filterDate, filterDateEnd = this.filterDateEnd){
      this.refreshing = true;
      this.get('/adAccounts?bmId='+this.bmId+'&startDate=' + filterDate+'&endDate='+filterDateEnd, (res) => {
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
          accounts[adAccount.account_id] = _.pick(adAccount, ['id','name','balance','amount_spent','business_name','account_id','adspixels'])
           /* if (adAccount.adspixels) {
                pixels[adAccount.account_id] = adAccount.adspixels[0]
              };*/

              if (adAccount.campaigns) {
            //   campaigns =  campaigns.concat(adAccount.campaigns)
            //   adSets =  adSets.concat(adAccount.adsets)
            ads =  ads.concat(adAccount.ads)
             //  adcreatives =  adcreatives.concat(adAccount.adcreatives)
             insights =  insights.concat(adAccount.insights)
           };

         })
        if (this.table) {

          this.table.destroy();
        }
        setTimeout(() => {




          this.table = $('#datatable').DataTable( {
            pageLength: 300,
            destroy: true,
            ordering: true,
            colReorder: {
              enable: true,
              realtime: true
            },
            "processing": true,
            rowReorder: true,
            columnDefs: [
            {
              searchable: false,
              orderable: true,
              visible: true,
              targets: 0,
            }, {
              "targets": 'no-sort',
              "orderable": false,
            } ],
            "lengthMenu": [ 100, 200, 300, 500, 1000 ],
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
                  //console.log($(this).val())
                  var val = $(this).val().join('|');

                  column
                  .search( val ? '^'+val+'$' : '', true, false )
                  .draw();
                  sortColumn(api, val ? 'current' : 'all',2);
                } );


              } );
              api.column( 11, {page:'all'} ).every( function () {
                var column = this;
                var select = $('.adstatus-selector')
                .on( 'change', function () {
                  //console.log($(this).val())
                  var val = $(this).val().join('|');

                  column
                  .search(val, true, false )
                  .draw();
             sortColumn(api, val ? 'current' : 'all',2);
                } );


              } );

              api.column( 1, {page:'all'} ).every( function () {
                var column = this;
                var select = $('.account-selector')
                .on( 'change', function () {
                  var val = $(this).val().join('|');


                  column
                  .search( val ? '^'+val+'$' : '', true, false )
                  .draw();
                  sortColumn(api, val ? 'current' : 'all', 1);


                } );


              } );

              api.column( 4, {page:'all'} ).every( function () {
                var column = this;
                var select = $('.status-selector')
                .on( 'change', function () {
                 // console.log($(this).val())
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
                this.refreshing = false;
        },0);

      }

    })
    }
  },
  computed: {},
  mounted() {

    this.getAdAccounts()

    this.getAllNotes();
  },
  beforeCreate() {},
  created() {},
  destroyed() {

  }
}
</script>
<style>
@import "/assets/plugins/datatables/dataTables.bootstrap4.min.css";
@import "/assets/plugins/datatables/buttons.bootstrap4.min.css";
@import "/assets/plugins/datatables/responsive.bootstrap4.min.css";
.bg-danger-table{
  background-color: #fc54544f !important;
}
.bg-warning-table{
  background-color: #fc545478 !important;
}

.bg-success-table{
  background-color: #37bc955e !important;
}
#datatable tr td {
  padding: 0px 5px!important;
}
.multiselector{
  min-height: 150px;
}
table td {
  text-transform: lowercase!important;
}
option {
    text-transform: uppercase;
}
</style>

