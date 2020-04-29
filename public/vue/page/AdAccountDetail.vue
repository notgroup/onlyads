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
                        <li class="breadcrumb-item"><a href="javascript:;">Admin</a></li>
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
                                <table class="table table-striped table-bordered  mb-0 table-hover nowrap display" style="border-collapse: collapse; border-spacing: 0; width: 100%;" v-if="adAccount.activities && adAccount.activities.length">
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
                                        <tr v-for="(act, ai) in adAccount.activities" v-if="!['update_ad_set_target_spec1'].includes(act.event_type)">
                                            <td><b>{{act.translated_event_type}}</b><br>{{act.event_type}} </td>
                                            <td>
                                                <span  v-for="(da, di) in JSON.parse(act.extra_data)" >

                                                    <span v-if="((typeof  da) != 'string') && da">
                                                        <strong>{{di}}:</strong>
                                                        <span v-if="act.event_type == 'ad_account_billing_charge' && di == 'new_value'">
                                                            {{da/100}} <br/>
                                                        </span>
                                                         <span v-else>
                                                            
                                                            <span v-if="(typeof  da) == 'object' && di == 'new_value'">
                                                                <template v-for="(da1, di1) in da">
                                                                   <br/> <b>{{di1}}:</b> {{di1 == 'new_value' ? da1/100 : da1}}
                                                                </template>
                                                            <br/>
                                                        </span>
                                                            <span v-else>
                                                            {{da}} <br/>
                                                        </span>
                                                        </span>
                                                    </span>

                                                    <span v-if="((typeof  da) == 'string') && da">
                                                        <strong>{{di}}:</strong>
                                                        
                                                  
                                                        <span v-if="di == 'image_url'">
                                                            <br />
                                                            <img :src="da" alt="" width="300"><br />
                                                        </span>
                                                        <span v-else>
                                                            {{da}}<br />
                                                        </span>
                                                        
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
                                        <div class="card m-b-30" >
                                            <div class="card-body">
                                                <b>effective_status</b>: {{ad.effective_status}}<br />
                                                <b>status</b>: {{ad.status}}<br />
                                                <b>configured_status</b>: {{ad.configured_status}}<br />
                                                <b>ad_review_feedback</b>: {{ad.ad_review_feedback ? ad.ad_review_feedback.global : ''}}
                                            </div>
                                        </div>
                                    </div>
                                                                        <div v-if="adAccount.ads && adAccount.ads[0] && adAccount.ads[0].recommendations" v-for="(ad, ai) in adAccount.ads[0].recommendations" class="col-md-6">
                                        <div class="card m-b-30">
                                            <div class="card-body">
                                                <b>title</b>: {{ad.title}}<br />
                                                <b>message</b>: {{ad.message}}<br />
                                            </div>
                                        </div>
                                    </div>
                      <div v-if="adAccount.ads && adAccount.ads[0] && adAccount.ads[0].issues_info" v-for="(ad, ai) in adAccount.ads[0].issues_info" class="col-md-6">
                                        <div class="card m-b-30">
                                            <div class="card-body">
                                                <b>level</b>: {{ad.level}}<br />
                                                <b>error_type</b>: {{ad.error_type}}<br />
                                                <b>error_summary</b>: {{ad.error_summary}}<br />
                                                <b>error_sumerror_messagemary</b>: {{ad.error_message}}<br />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane p-3" id="tab-recommendations" role="tabpanel">
                                                               <div class="row" v-if="1 == 0">

                     
                                </div>
                            </div>
                            <div class="tab-pane p-3" id="settings-1" role="tabpanel">
                                <p class="mb-0">..
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
