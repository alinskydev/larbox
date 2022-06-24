<script setup>
import { RouterView } from "vue-router";
</script>

<script>
export default {
    beforeCreate() {
        this.booted.components.app = this;

        // Resolve conflict in jQuery UI tooltip with Bootstrap tooltip
        $.widget.bridge("uibutton", $.ui.button);
    },
    data() {
        return {
            appChildKey: 0,
        };
    },
};
</script>

<template>
    <div id="preloader" class="active">
        <img class="animation__shake" src="/assets/dist/img/AdminLTELogo.png" />
    </div>

    <RouterView :key="appChildKey" />
</template>
