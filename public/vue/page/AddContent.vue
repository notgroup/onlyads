<template>
<div v-if="contentTypeId">
    <add-product v-if="contentTypeId == 4" :contentTypeId="contentTypeId" :primaryId="primaryId"></add-product>
    <add-product-group v-if="contentTypeId == 32" :contentTypeId="contentTypeId" :primaryId="primaryId"></add-product-group>
    <add-customer v-if="contentTypeId == 34" :contentTypeId="contentTypeId" :primaryId="primaryId"></add-customer>
    <add-order v-if="contentTypeId == 33" :contentTypeId="contentTypeId" :primaryId="primaryId"></add-order>
    <add-payment v-if="contentTypeId == 35" :contentTypeId="contentTypeId" :primaryId="primaryId"></add-payment>
    <add-shipment v-if="contentTypeId == 36" :contentTypeId="contentTypeId" :primaryId="primaryId"></add-shipment>
</div>

</template>

<script>
var AddProduct = httpVueLoader('/vue/page/AddProduct.vue');
var AddProductGroup = httpVueLoader('/vue/page/AddProductGroup.vue');
var AddCustomer = httpVueLoader('/vue/page/AddCustomer.vue');
var AddOrder = httpVueLoader('/vue/page/AddOrder.vue');
var AddPayment = httpVueLoader('/vue/page/AddPayment.vue');
var AddShipment = httpVueLoader('/vue/page/AddShipment.vue');
module.exports = {
    components: {AddProduct,AddProductGroup,AddCustomer,AddOrder,AddPayment,AddShipment},
    name: "AddContent",
    props: ['contentTypeId','primaryId'],
    data() {
        return {
            item: {}
        };
    },
    computed: {},
    mounted() {
        // this.getData();
    },
    beforeCreate() {},
    created() {},
    methods: {
        addSetting() {
            this.post(window.apiUrl + "/addSetting", this.currentSettings, (res) => {
                this.currentSettings = {}
                this.settings = res
            })
        },
        getData() {
            this.get(window.apiUrl + "/content/" + this.primaryId, (res) => {

                this.item = res
            })
        }
    }
}
</script>

<style>
</style>
