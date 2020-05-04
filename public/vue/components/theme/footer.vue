<template>
<footer class="footer hide">
    <div class="notifications hide">
        <div role="alert" class="alert alert-success"><strong>Başarılı!</strong> Nesne onaylandı olarak işaretlendi.
        </div>
    </div>
    © 2020 RoketMedia <span class="d-none d-sm-inline-block"> - Crafted with <i class="mdi mdi-heart text-danger"></i> by RoketMedia</span>.
</footer>
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
