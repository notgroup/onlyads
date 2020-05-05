<template>
<div>

    <div class="notifications hide">
            <div class="alert alert-primary alert-dismissible fade show" role="alert" v-if="goster">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Well done!</strong> You successfully read this important alert message.
    </div>
        <div class="alert" :class="['alert-' + (getDetails.type || 'success')]" role="alert">
            <strong>{{getDetails.title}} </strong> {{getDetails.content}}.
        </div>
    </div>
</div>
</template>

<script>
module.exports = {
    name: "notification",
    props:['details'],
    data() {
        return {
            goster:0
        };
    },
    computed: {
        getDetails(){
           return this.details || {};
        }
    },
    mounted() {
                    alertify.logPosition("bottom right");
            alertify.log("bottom right");
       /* alertify.success("You've clicked OK");
                alertify.confirm("Confirm?").then((resolvedValue) => {
            // The click event is in the
            // event variable, so you can use
            // it here.
            resolvedValue.event.preventDefault();
            alertify.alert("You clicked the " + resolvedValue.buttonClicked + " button!");
        });*/
        /*
        alertify
            .delay(10000)
            .okBtn("Accept")
            .cancelBtn("Deny")
            .confirm("Confirm dialog with custom button labels", (ev) => {
                ev.preventDefault();
                alertify.success("You've clicked OK");
            }, (ev) => {
                ev.preventDefault();
                alertify.error("You've clicked Cancel");
            });

        alertify.confirm("Confirm?").then((resolvedValue) => {
            // The click event is in the
            // event variable, so you can use
            // it here.
            resolvedValue.event.preventDefault();
            alertify.alert("You clicked the " + resolvedValue.buttonClicked + " button!");
        });




                alertify.confirm("This is a confirm dialog", (ev) => {
            ev.preventDefault();
            this.goster = 1
            alertify.success("You've clicked OK");
        }, (ev) => {
            ev.preventDefault();
            this.goster = 1
            alertify.error("You've clicked Cancel");
        });*/
    },
    beforeCreate() {},
    created() {},
    methods: {},
};
</script>

<style></style>
