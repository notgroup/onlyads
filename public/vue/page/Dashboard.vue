<template>
<div>

<manager-dashboard v-if="$root.userData.role == 'manager'"></manager-dashboard>
<admin-dashboard v-if="$root.userData.role == 'admin'"></admin-dashboard>
<default-dashboard v-if="$root.userData.role == 'root1'"></default-dashboard>
<root-dashboard v-if="$root.userData.role == 'root'"></root-dashboard>
</div>
</template>

<script>
var DefaultDashboard = httpVueLoader('/vue/components/dashboards/Default.vue');
var RootDashboard = httpVueLoader('/vue/components/dashboards/Root.vue');
var AdminDashboard = httpVueLoader('/vue/components/dashboards/Admin.vue');
var ManagerDashboard = httpVueLoader('/vue/components/dashboards/Manager.vue');

module.exports = {
    components:{AdminDashboard, DefaultDashboard, ManagerDashboard, RootDashboard},
    name: "Dashboard",
    data() {
        return {};
    },
    computed: {},
    mounted() {},
    beforeCreate() {},
    created() {},
    methods: {},
};
</script>

<style></style>
