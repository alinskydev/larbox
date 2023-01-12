<script setup>
import { Page } from '@/core/page';
import { UpdateConfig } from '@/core/crud/configs';
import model from '@/modules/user/models/profile';

import PageTitle from '@/components/blocks/PageTitle.vue';
import Buttons from '@/components/crud/form/Buttons.vue';
import Update from '@/components/crud/Update.vue';
</script>

<script>
export default {
    data() {
        return {
            title: this.__('routes->user.profile'),
            config: new UpdateConfig({
                model: model,
                http: {
                    path: 'user/profile',
                },
                events: {
                    afterSubmit: (formData, response) => {
                        toastr.success(this.__('Сохранение прошло успешно'));

                        if (response.data.token) {
                            this.booted.helpers.user.login(this, response.data.token);
                        }

                        this.$router.push('/');
                    },
                },
            }),
        };
    },
    created() {
        new Page({
            context: this,
        });
    },
};
</script>

<template>
    <PageTitle :text="title">
        <Buttons :actions="['save']" />
    </PageTitle>

    <Update :config="config" />
</template>
