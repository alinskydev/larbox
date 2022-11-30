<script setup>
import { RouterView } from 'vue-router';
</script>

<script>
export default {
    beforeCreate() {
        this.booted.components.app = this;

        // Resolve conflict in jQuery UI tooltip with Bootstrap tooltip
        $.widget.bridge('uibutton', $.ui.button);
    },
    data() {
        return {
            childKey: 0,
        };
    },
};
</script>

<template>
    <RouterView :key="childKey" />

    <div id="preloader" class="active">
        <img class="animation__shake" src="/assets/custom/media/logo.png" />
    </div>

    <div id="no-interaction-mask" class="d-none"></div>
</template>
