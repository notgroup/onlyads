<template>
<div class="row">
    <div class="col-md-12">
        <table class="table table-striped table-bordered  mb-0 table-hover nowrap display" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead class="thead-default">
                <tr>
                    <th width="1%">ID</th>
                    <th>Başlık</th>
                    <th>Ürün Adeti</th>
                    <th>Kutu Adeti</th>
                    <th>Ürün Fiyatı</th>
                    <th>Kargo Ücreti</th>
                    <th width="1%">İşlem</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, itemi) in items">
                    <td>{{item.content_id}}</td>
                    <td>{{item.meta.name || item.meta.title}}</td>
                    <td>{{item.meta.product_quantity}}</td>
                    <td>{{item.meta.quantity}}</td>
                    <td>{{item.meta.price}}</td>
                    <td>{{item.meta.shipment_cost}}</td>

                    <td>
                        <div class="btn-group btn-group">

                            <button @click="$router.push('/ContenDetail/' + item.entity_type_id + '/' +item.content_id)" class="btn btn-primary waves-effect waves-light">
                                <i class="far fa-eye"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <hr class="m-t-10 m-b-20" />
    </div>

</div>
</template>

<script>
module.exports = {
    name: "ProductList",
    props: ['typeId'],
    data() {
        return {
            items: [],
            currentSettings: {
                autoload: ''
            }
        };
    },
    computed: {},
    mounted() {
        this.getData(this.typeId)
    },
    beforeCreate() {},
    created() {},
    methods: {
        getData(typeId) {
            this.get(window.apiUrl + "/contents/" + typeId, (res) => {

                this.items = res
            })
        }
    }
}
</script>

<style>
</style>
