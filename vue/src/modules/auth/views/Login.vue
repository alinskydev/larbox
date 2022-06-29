<script setup>
import model from '@/modules/auth/models/login';

import Input from '@/app/components/Input.vue';
</script>

<script>
export default {
    data() {
        return {
            title: this.__('Авторизация'),
            inputs: model.prepareInputs(this, model.form),
            isReady: false,
        };
    },
    created() {
        document.title = this.title;
        document.getElementById('favicon').href = this.booted.settings.favicon;

        if (this.booted.config.http.headers['Authorization']) {
            fetch(this.booted.config.http.url + '/user/profile', {
                method: "GET",
                headers: this.booted.config.http.headers,
            }).then((response) => {
                if (response.status === 200) {
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
                    response.json().then((body) => {
                        this.$router.push({
                            path: '/' + this.booted.locale,
                        }).then(() => {
                            this.booted.helpers.user.login(this, formData.get('username'), formData.get('password'));
                        });
                    });
                } else if (response.statusType === 'validationFailed') {
                    response.json().then((body) => {
                        toastr.warning(body.message);

                        $('.input-error').addClass('d-none');

                        for (let key in body.errors) {
                            let error = body.errors[key].join("\n"),
                                altKey = null;

                            if (key.includes('.')) {
                                altKey = key.slice(0, key.lastIndexOf('.')) + '.*';
                            } else {
                                altKey = key + '.*';
                            }

                            $('[data-error-key="' + key + '"], [data-error-key="' + altKey + '"]')
                                .closest('.input-wrapper')
                                .find('.input-error')
                                .text(error)
                                .removeClass('d-none');
                        }
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
                                {{ __('Авторизоваться') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </template>
</template>
