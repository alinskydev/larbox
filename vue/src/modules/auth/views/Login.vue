<script setup>
import { Page } from '@/core/page';
import model from '@/modules/auth/models/login';
import Input from '@/components/Input.vue';
</script>

<script>
export default {
    data() {
        return {
            page: new Page({
                context: this,
                title: this.__('Авторизация'),
            }),
            inputs: model.prepareInputs(this, model.form),
            isReady: false,
        };
    },
    created() {
        if (localStorage.getItem('auth_username')) {
            this.booted.helpers.http.send(this, {
                method: 'GET',
                path: 'user/profile',
            }).then((response) => {
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

            this.booted.helpers.http.send(this, {
                method: 'POST',
                path: '../auth/login',
                body: formData,
            }).then((response) => {
                if (response.statusType === 'success') {
                    this.$router.push({
                        path: '/' + this.booted.locale,
                    }).then(() => {
                        this.booted.helpers.user.login(this, formData.get('username'), formData.get('password'));
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
