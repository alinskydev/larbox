<script setup>
import { Page } from '@/core/page';
import { ShowConfig } from '@/core/crud/configs';
import model from '@/modules/feedback/models/callback';

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
                    path: 'feedback/callback/:pk',
                },
                events: {
                    afterResponse: (data) => {
                        this.title += ': ' + data.id;

                        new Page({
                            context: this,
                            breadcrumbs: [
                                {
                                    label: this.__('routes->feedback.callback'),
                                    path: 'feedback/callback/index',
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
