<script setup>
import { Page } from '@/core/page';
import form from '@/modules/auth/forms/login';
import Input from '@/components/Input.vue';
</script>

<script>
export default {
    data() {
        return {
            page: new Page({
                context: this,
                title: this.__('routes->auth.login'),
            }),
            inputs: form.fillData(this).data.form[0],
            isReady: false,
        };
    },
    created() {

        this.page.init();

        if (localStorage.getItem('authToken')) {
            this.booted.helpers.http
                .send(this, {
                    method: 'GET',
                    path: 'user/profile',
                })
                .then((response) => {
                    if (response.statusType === 'success') {
                        this.$router.push({
                            path: '/' + this.booted.locale,
                        });
                    } else {
                        this.isReady = true;
                    }
                });
        } else {
            this.isReady = true;
        }
    },
    methods: {
        submit(event) {
            let formData = new FormData(event.target);

            this.booted.helpers.http
                .send(this, {
                    method: 'POST',
                    path: '../common/auth/login',
                    body: formData,
                })
                .then((response) => {
                    if (response.statusType === 'success') {
                        this.$router
                            .push({
                                path: '/' + this.booted.locale,
                            })
                            .then(() => {
                                this.booted.helpers.user.login(this, response.data.token);
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
                    <b>{{ page.title }}</b>
                </div>

                <div class="card">
                    <div class="card-body login-card-body">
                        <form @submit.prevent="submit">
                            <Input :item="inputs.username" />
                            <Input :item="inputs.password" />

                            <button type="submit" class="btn btn-primary btn-block mt-4">
                                {{ __('Авторизоваться') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </template>
</template>
