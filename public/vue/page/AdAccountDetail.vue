<template>
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">{{adAccount.business ? adAccount.business.name : ''}} / {{adAccount.name}}</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Admin</a></li>
                            <li class="breadcrumb-item active">Reklam Hesap Detayı</li>
                        </ol>
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end page-title -->

            <!-- START ROW -->
            <div class="row">
                <div class="col-xl-12">
                                <div class="card1 m-b-30">
                                    <div class="card-body1">
                                        <!-- Nav tabs -->
                                        <ul class="nav nav-pills nav-justified" role="tablist">
                                            <li class="nav-item waves-effect waves-light" v-if="adAccount.activities && adAccount.activities.length">
                                                <a class="nav-link active" data-toggle="tab" href="#tab-activities" role="tab">
                                                    <span class="d-none d-md-block">Aktivite</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span> 
                                                </a>
                                            </li>
                                            <li class="nav-item waves-effect waves-light" v-if="adAccount.ads && adAccount.ads.length">
                                                <a class="nav-link" data-toggle="tab" href="#tab-feedback" role="tab">
                                                    <span class="d-none d-md-block">Feedback</span><span class="d-block d-md-none"><i class="mdi mdi-account h5"></i></span>
                                                </a>
                                            </li>
                                            <li class="nav-item waves-effect waves-light hide">
                                                <a class="nav-link" data-toggle="tab" href="#messages-1" role="tab">
                                                    <span class="d-none d-md-block">Messages</span><span class="d-block d-md-none"><i class="mdi mdi-email h5"></i></span>
                                                </a>
                                            </li>
                                            <li class="nav-item waves-effect waves-light hide">
                                                <a class="nav-link" data-toggle="tab" href="#settings-1" role="tab">
                                                    <span class="d-none d-md-block">Settings</span><span class="d-block d-md-none"><i class="mdi mdi-settings h5"></i></span>
                                                </a>
                                            </li>
                                        </ul>
        
                                        <!-- Tab panes -->
                                        <div class="tab-content">
                                            <div class="tab-pane active p-3" id="tab-activities" role="tabpanel">
<table class="table table-striped table-bordered  mb-0 table-hover nowrap display" style="border-collapse: collapse; border-spacing: 0; width: 100%;"  v-if="adAccount.activities && adAccount.activities.length">
              <thead class="thead-default">
                <tr>
                  <th>Tür</th>
                  <th>Detay</th>
                  <th>Grup</th>
                  <th>Aktör</th>
                  <th>Tarih</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(act, ai) in adAccount.activities">
                  <td><b>{{act.translated_event_type}}</b><br>{{act.event_type}} </td>
                  <td>
                      <span v-for="(da, di) in JSON.parse(act.extra_data)" v-if="!['update_ad_set_target_spec'].includes(di)">
                         
                          <small v-if="((typeof  da) != 'string') && da">
                          {{di}}:   {{da}}<br/>
                          </small>
                          <span v-if="((typeof  da) == 'string') && da">
                             {{di}}: {{da}}<br/>
                          </span>

                         
                      </span>
                     


                  </td>
                  <td>{{act.object_type}}</td>
                  <td>{{act.actor_name}}</td>
                  <td>{{act.date_time_in_timezone}}</td>

               </tr>
             </tbody>
           </table>
                                            </div>
                                            <div class="tab-pane p-3" id="tab-feedback" role="tabpanel">
<div class="row">

<div v-if="adAccount.ads && adAccount.ads.length" v-for="(ad, ai) in adAccount.ads" class="col-md-6">
                                    <div class="card m-b-30">
                                    <div class="card-body">
<b>effective_status</b>: {{ad.effective_status}}<br/>
<b>status</b>: {{ad.status}}<br/>
<b>configured_status</b>: {{ad.configured_status}}<br/>
<b>ad_review_feedback</b>: {{ad.ad_review_feedback ? ad.ad_review_feedback.global : ''}}
</div>
</div>
</div>
</div>
                                            </div>
                                            <div class="tab-pane p-3" id="messages-1" role="tabpanel">
                                                <p class="mb-0">
                                                    Etsy mixtape wayfarers, ethical wes anderson tofu before they
                                                    sold out mcsweeney's organic lomo retro fanny pack lo-fi
                                                    farm-to-table readymade. Messenger bag gentrify pitchfork
                                                    tattooed craft beer, iphone skateboard locavore carles etsy
                                                    salvia banksy hoodie helvetica. DIY synth PBR banksy irony.
                                                    Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh
                                                    mi whatever gluten-free, carles pitchfork biodiesel fixie etsy
                                                    retro mlkshk vice blog. Scenester cred you probably haven't
                                                    heard of them, vinyl craft beer blog stumptown. Pitchfork
                                                    sustainable tofu synth chambray yr.
                                                </p>
                                            </div>
                                            <div class="tab-pane p-3" id="settings-1" role="tabpanel">
                                                <p class="mb-0">
                                                    Trust fund seitan letterpress, keytar raw denim keffiyeh etsy
                                                    art party before they sold out master cleanse gluten-free squid
                                                    scenester freegan cosby sweater. Fanny pack portland seitan DIY,
                                                    art party locavore wolf cliche high life echo park Austin. Cred
                                                    vinyl keffiyeh DIY salvia PBR, banh mi before they sold out
                                                    farm-to-table VHS viral locavore cosby sweater. Lomo wolf viral,
                                                    mustache readymade thundercats keffiyeh craft beer marfa
                                                    ethical. Wolf salvia freegan, sartorial keffiyeh echo park
                                                    vegan.
                                                </p>
                                            </div>
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
    name: "AdAccountDetail",
    props: ["accountId"],
    data() {
        return {
          adAccount: {}
      };
  },
  computed: {},
  mounted() {
    this.get('/adAccountDetail/' + this.accountId, (res) => {

this.adAccount = res
})
},
beforeCreate() {},
created() {},
methods: {}
}
</script>
<style>
</style>

