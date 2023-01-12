<script setup>
import { Page } from '@/core/page';
import { ShowConfig } from '@/core/crud/configs';
import model from '@/modules/user/models/notification';

import PageTitle from '@/components/blocks/PageTitle.vue';
import Show from '@/components/crud/Show.vue';
</script>

<script>
export default {
    data() {
        return {
            title: this.__('routeActions->show'),
            config: new ShowConfig({
                model: model,
                http: {
                    path: 'user/notification/:pk',
                },
                events: {
                    afterResponse: (data) => {
                        this.title += ': ' + data.id;

                        new Page({
                            context: this,
                            breadcrumbs: [
                                {
                                    label: this.__('routes->user.notification'),
                                    path: 'user/notification/index',
                                },
                            ],
                        });
                    },
                },
            }),
        };
    },
};
</script>

<template>
    <PageTitle :text="title" />
    <Show :config="config" />
</template>
