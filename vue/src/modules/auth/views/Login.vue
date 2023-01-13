<script setup>
import App from '@/core/app';
import Page from '@/core/page';
import Form from '@/modules/auth/forms/login';

import Input from '@/components/Input.vue';
</script>

<script>
export default {
    data() {
        return {
            title: App.t('routes->auth.login'),
            inputs: Form.fillData().data.form[0],
            isReady: false,
        };
    },
    created() {
        Page.init({
            title: this.title,
        });

        if (localStorage.getItem('authToken')) {
            App.helpers.http
                .send({
                    method: 'GET',
                    path: 'user/profile',
                })
                .then((response) => {
                    if (response.statusType === 'success') {
                        this.$router.push('/' + App.locale);
                    } else {
                        App.helpers.user.logout();
                    }
                });
        } else {
            this.isReady = true;
        }
    },
    methods: {
        submit(event) {
            let formData = new FormData(event.target);

            App.helpers.http
                .send({
                    method: 'POST',
                    path: '../common/auth/login',
                    body: formData,
                })
                .then((response) => {
                    if (response.statusType === 'success') {
                        App.helpers.user.login(response.data.token);

                        this.$router.push('/' + App.locale).then(() => {
                            App.components.app.refresh();
                        });
                    }
                });
        },
    },
};
</script>

<template>
    <template v-if="isReady">
        <div class="login-page">
            <div class="login-box">
                <div class="login-logo">
                    <b>{{ title }}</b>
                </div>

                <div class="card">
                    <div class="card-body login-card-body">
                        <form @submit.prevent="submit">
                            <Input :item="inputs.username" />
                            <Input :item="inputs.password" />

                            <button type="submit" class="btn btn-primary btn-block mt-4">
                                {{ App.t('Авторизоваться') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </template>
</template>
