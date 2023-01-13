<script setup>
import { RouterView } from 'vue-router';
import App from '@/core/app';

import TopBar from './main/TopBar.vue';
import SideBar from './main/SideBar.vue';
</script>

<script>
export default {
    data() {
        return {
            isReady: false,
            templateKey: 0,
        };
    },
    created() {
        App.components.layout = this;

        App.helpers.http
            .send({
                method: 'GET',
                path: 'user/profile',
            })
            .then((response) => {
                if (response.statusType === 'success') {
                    App.user = response.data;
                    this.isReady = true;
                } else if (response.statusType === 'forbidden') {
                    App.helpers.user.logout();
                }
            });
    },
    methods: {
        refresh() {
            this.templateKey++;
        },
    },
};
</script>

<template>
    <template v-if="isReady">
        <TopBar :templateKey="templateKey" />
        <SideBar :templateKey="templateKey" />

        <div class="content-wrapper">
            <section class="content">
                <div class="container-fluid">
                    <RouterView />
                </div>
            </section>
        </div>

        <footer class="main-footer">
            <b>Copyright &copy; {{ new Date().getFullYear() }}</b>
            <div class="float-right d-none d-sm-inline-block">All rights reserved</div>
        </footer>
    </template>
</template>
