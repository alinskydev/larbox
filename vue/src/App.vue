<script setup>
import { RouterView } from 'vue-router';
import App from '@/core/app';
import init from '@/app/init';
</script>

<script>
export default {
    data() {
        return {
            preloaderIsActive: true,
            childKey: 0,
        };
    },
    created() {
        // Resolve conflict in jQuery UI tooltip with Bootstrap tooltip
        // $.widget.bridge('uibutton', $.ui.button);

        document.documentElement.setAttribute('lang', App.locale);
        document.getElementById('favicon').href = App.settings.favicon;

        App.components.app = this;

        setTimeout(() => {
            this.preloaderIsActive = false;
        }, 500);
    },
    methods: {
        refresh() {
            this.preloaderIsActive = true;

            init().then(() => {
                document.documentElement.setAttribute('lang', App.locale);
                document.getElementById('favicon').href = App.settings.favicon;

                this.preloaderIsActive = false;
                this.childKey++;
            });
        },
    },
};
</script>

<template>
    <RouterView :key="childKey" />

    <div id="preloader" :class="preloaderIsActive ? 'active' : ''">
        <div id="status">
            <div class="spinner-chase">
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
            </div>
        </div>
    </div>

    <div id="no-interaction-mask" class="d-none"></div>
</template>
