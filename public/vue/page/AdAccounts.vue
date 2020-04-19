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
                    <div class="card m-b-30">
                        <div class="card-body">
                            <h4 class="mt-0 header-title mb-4 hide">Active Deals</h4>
                                                                   <div class="table-responsive">
                                            <table class="table table-striped table-bordered  mb-0 table-hover">
                                    <thead class="thead-default">
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
                            <th>Güncellenme</th>
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
                                                <span class="badge" :class="bs.account_status>1 ? 'badge-danger' : 'badge-success'">{{accountLang[bs.account_status]}}</span><br/>
                                                 <span class="badge" :class="bs.account_status>1 ? 'badge-danger' : 'badge-success'">{{bs.disable_reason ? '' + reasons[bs.disable_reason] : ''}}</span>

                                                </td>
                                                <td>{{bs.insights ? bs.insights[0].spend : 0}}</td>
                                                <td>{{bs.insights ? bs.insights[0].clicks : 0}}</td>
                                                <td>{{bs.insights ? parseFloat(bs.insights[0].cpc).toFixed(2) : 0}}</td>
                                                <td>{{bs.insights ? (_.indexBy(bs.insights[0].unique_actions, 'action_type').omni_purchase? _.indexBy(bs.insights[0].unique_actions, 'action_type').omni_purchase.value : 0) : 0}}</td>
                                                <td>{{bs.insights ? (_.indexBy(bs.insights[0].cost_per_unique_action_type, 'action_type').omni_purchase? parseFloat(_.indexBy(bs.insights[0].cost_per_unique_action_type, 'action_type').omni_purchase.value).toFixed(2) : 0) : 0}}</td>
                                                <td style="display:none;">{{0}}</td>
                                                <td style="display:none;">{{0}}</td>
                                                <td>{{bs.balance}}</td>
                                                <td>{{bs.adspixels[0].name}}</td>
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

                                                <td>0</td>
                                                <td class="hide">15/1/2018</td>

                                                <td class="hide">
                                                    <div>
                                                        <a href="#" class="btn btn-primary btn-sm">Edit</a>
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
        <!-- container-fluid -->

    </div>
</template>
<script>
module.exports = {
    name: "AdAccounts",
    data() {
        return {
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
            "0":"NONE",
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

},100)

    }

})
},
beforeCreate() {},
created() {},
methods: {}
}
</script>
<style>
</style>

