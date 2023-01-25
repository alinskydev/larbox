<script setup>
import { RouterView } from 'vue-router';
import App from '@/core/app';

import Breadcrumbs from './main/Breadcrumbs.vue';
import Languages from './main/Languages.vue';
import Logo from './main/Logo.vue';
import NavBar from './main/NavBar.vue';
import Notifications from './main/Notifications.vue';
import Profile from './main/Profile.vue';
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
        <header id="page-topbar">
            <div class="navbar-header">
                <div class="container-fluid">
                    <Logo />

                    <div class="float-end">
                        <Languages :key="templateKey" />
                        <Notifications />
                        <Profile />
                    </div>
                </div>
            </div>

            <div class="top-navigation">
                <Breadcrumbs :key="templateKey" />
                <NavBar :key="templateKey" />
            </div>
        </header>

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <RouterView />
                </div>
            </div>
        </div>

        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        Copyright &copy; {{ new Date().getFullYear() }}
                        <span class="d-none d-sm-inline-block"> All rights reserved </span>
                    </div>
                </div>
            </div>
        </footer>
    </template>
</template>
