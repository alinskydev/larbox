<script setup>
import init from '@/app/init';

import { RouterView } from 'vue-router';
import TopBar from './main/TopBar.vue';
import SideBar from './main/SideBar.vue';
</script>

<script>
export default {
    data() {
        return {
            templateKey: 0,
            isReady: false,
        };
    },
    beforeCreate() {
        this.booted.components.layout = this;
    },
    created() {
        $('#preloader').addClass('active');

        init(this).then(() => {
            document.documentElement.setAttribute('lang', this.booted.locale);
            document.getElementById('favicon').href = this.booted.settings.favicon;

            this.booted.helpers.http
                .send(this, {
                    method: 'GET',
                    path: 'user/profile',
                })
                .then((response) => {
                    if (response.statusType === 'success') {
                        this.booted.user = response.data;
                        this.isReady = true;

                        $('#preloader').removeClass('active');
                    } else if (response.statusType === 'forbidden') {
                        this.booted.helpers.user.logout(this);
                    }
                });
        });
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
