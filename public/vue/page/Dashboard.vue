<template>
<div>


</div>
</template>

<script>
var DefaultDashboard = httpVueLoader('/vue/components/dashboards/Default.vue');
var RootDashboard = httpVueLoader('/vue/components/dashboards/Root.vue');
var AdminDashboard = httpVueLoader('/vue/components/dashboards/Admin.vue');
var AgencyDashboard = httpVueLoader('/vue/components/dashboards/Agency.vue');
var ManagerDashboard = httpVueLoader('/vue/components/dashboards/Manager.vue');
var AgentDashboard = httpVueLoader('/vue/components/dashboards/Agent.vue');

module.exports = {
    components:{AdminDashboard, DefaultDashboard, ManagerDashboard, RootDashboard, AgencyDashboard, AgentDashboard},
    name: "Dashboard",
    data() {
        return {};
    },
    computed: {},
    mounted() {
        this.$router.push('/business-accounts')
    },
    beforeCreate() {},
    created() {},
    methods: {},
};
</script>

<style></style>
