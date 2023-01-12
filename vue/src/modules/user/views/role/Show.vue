<script setup>
import { Page } from '@/core/page';
import { ShowConfig } from '@/core/crud/configs';
import model from '@/modules/user/models/role';

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
                    path: 'user/role/:pk',
                },
                events: {
                    afterResponse: (data) => {
                        this.title += ': ' + data.name[this.booted.locale];

                        new Page({
                            context: this,
                            breadcrumbs: [
                                {
                                    label: this.__('routes->user.role'),
                                    path: 'user/role/index',
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
