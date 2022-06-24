<script setup>
import { RouterView } from "vue-router";
import http from "@/app/bootstrap/http";

import TopBar from '@/app/components/layout/TopBar.vue';
import SideBar from '@/app/components/layout/SideBar.vue';
</script>

<script>
export default {
    data() {
        return {
            isReady: false,
        };
    },
    beforeCreate() {
        $('#preloader').addClass('active');

        http.init(this)
            .then(() => {
                document.documentElement.setAttribute('lang', this.booted.locale);
                document.getElementById('favicon').href = this.booted.settings.favicon;

                this.booted.helpers.http.send(this, {
                    method: 'GET',
                    path: 'user/profile',
                }).then((response) => {
                    if (response.statusType === 'success') {
                        response.json().then((body) => {
                            this.booted.user = body;

                            $('#preloader').removeClass('active');
                            this.isReady = true;
                        });
                    }
                });
            });
    },
};
</script>

<template>
    <template v-if="isReady">
        <TopBar />
        <SideBar />

        <div class="content-wrapper">
            <section class="content">
                <div class="container-fluid">
                    <RouterView />
                </div>
            </section>
        </div>

        <footer class="main-footer">
            <b>Copyright &copy; {{ new Date().getFullYear() }}</b>
            <div class="float-right d-none d-sm-inline-block">
                All rights reserved
            </div>
        </footer>
    </template>
</template>
