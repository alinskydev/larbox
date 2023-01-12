<script setup>
import { Page } from '@/core/page';
import { UpdateConfig } from '@/core/crud/configs';
import model from '@/modules/user/models/user';

import PageTitle from '@/components/blocks/PageTitle.vue';
import Buttons from '@/components/crud/form/Buttons.vue';
import Update from '@/components/crud/Update.vue';
</script>

<script>
export default {
    data() {
        return {
            title: this.__('routeActions->update'),
            config: new UpdateConfig({
                model: model,
                http: {
                    path: 'user/user/:pk',
                },
                events: {
                    afterResponse: (data) => {
                        this.title += ': ' + data.username;

                        new Page({
                            context: this,
                            breadcrumbs: [
                                {
                                    label: this.__('routes->user.user'),
                                    path: 'user/user/index',
                                },
                            ],
                        });
                    },
                    afterSubmit: (formData, response) => {
                        toastr.success(this.__('Сохранение прошло успешно'));

                        if (response.data.token) {
                            this.booted.helpers.user.login(this, response.data.token);
                        }

                        this.booted.page.goUp();
                    },
                },
            }),
        };
    },
};
</script>

<template>
    <PageTitle :text="title">
        <Buttons />
    </PageTitle>

    <Update :config="config" />
</template>
