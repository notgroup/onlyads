<template>
<div>
<notification v-if="1 == 0" :details="{type: 'danger', title: 'başarılı', content: 'başarılı bir şekilde eklendi'}"></notification>
<footer class="footer hide">

    © 2020 RoketMedia <span class="d-none d-sm-inline-block"> - Crafted with <i class="mdi mdi-heart text-danger"></i> by RoketMedia</span>.
</footer>
</div>

</template>

<script>
module.exports = {
    name: "footer-base",
    mounted() {
        setTimeout(() => {

            $.MainApp.init();
        }, 700)
    }
}
</script>

<style>
.notifications {
    position: fixed;
    bottom: 0;
    right: 20px;
}
</style>
