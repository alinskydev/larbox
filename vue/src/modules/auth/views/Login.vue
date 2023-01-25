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
        <div class="account-pages my-5 pt-sm-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card overflow-hidden">
                            <div class="card-body p-5">
                                <div class="text-center">
                                    <img src="/assets/media/logo.png" alt="" height="50" class="auth-logo-dark" />
                                </div>

                                <h4 class="text-muted font-size-18 text-center my-4">
                                    {{ title }}
                                </h4>

                                <form @submit.prevent="submit" class="form-horizontal">
                                    <Input :item="inputs.username" />
                                    <Input :item="inputs.password" />

                                    <div class="text-end mt-4">
                                        <button type="submit" class="btn btn-primary w-md waves-effect waves-light">
                                            {{ App.t('Авторизоваться') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </template>
</template>
