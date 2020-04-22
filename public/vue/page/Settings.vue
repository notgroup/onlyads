<template>
    <div class="content">
        <div class="container-fluid">
            <!-- Page-Title -->
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">Settings</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">AnaSayfa</a></li>
                            <li class="breadcrumb-item active">Settings</li>
                        </ol>
                    </div>
                </div>
                <!-- end row -->
            </div>

            <div class="row">
              <div class="col-md-12">
                <table class="table table-striped table-bordered  mb-0 table-hover nowrap display" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                  <thead class="thead-default">
                    <tr>
                      <th width="20%">İsim</th>
                      <th>Değer</th>
                      <th width="1%">Autoload</th>
                      <th width="1%">İşlem</th>
                  </tr>
              </thead>
              <tbody>
                <tr v-for="(set, si) in settings">
                  <td>{{set.option_name}} </td>
                  <td>
<input type="text" :name="'option_value'" required="" class="form-control" :value="set.option_value" v-model="settings[si].option_value">

                  </td>
                  <td>{{set.autoload}}</td>
                  <td><button class="btn btn-primary waves-effect waves-light">
                   <i class="far fa-trash-alt"></i>
               </button></td>
           </tr>
       </tbody>
   </table>
   <hr class="m-t-10 m-b-20" />
</div>

<div class="col-md-6">

  <div class="form-group">
    <label>Auto Load</label>
    <div>
      <select class="form-control" v-model="currentSettings.autoload">
        <option value="">Lütfen Seçiniz</option>
        <option value="1">Açık</option>
        <option value="0">Kapalı</option>
    </select>
</div>
</div>
<button type="button" class="btn btn-primary btn-block waves-effect waves-light" @click="addSetting()">Gönder</button>
</div>
<div class="col-md-6">
  <div class="form-group">
    <label>Meta Key</label>
    <div>
      <input type="text" name="option_name" required="" class="form-control" v-model="currentSettings.option_name">
  </div>
</div>          <div class="form-group">
    <label>Meta Value</label>
    <div>
      <input type="text" name="option_value" required="" class="form-control" v-model="currentSettings.option_value">
  </div>
</div>
</div>
</div>

</div>
</div>
</template>
<script>
module.exports = {
    name: "home",
    data() {
        return {
            settings: [],
            currentSettings: {
                autoload: ''
            }
        };
    },
    computed: {},
    mounted() {
        this.getSettings()
    },
    beforeCreate() {},
    created() {},
    methods: {
        addSetting(){
          this.post(window.apiUrl + "/addSetting", this.currentSettings, (res) => {
            this.currentSettings = {}
            this.settings = res
        })
      },
        getSettings(){
          this.get(window.apiUrl + "/getSettings", (res) => {

            this.settings = res
        })
      }
  }
}
</script>
<style>
</style>

