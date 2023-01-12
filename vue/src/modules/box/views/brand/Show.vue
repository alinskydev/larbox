<script setup>
import { Page } from '@/core/page';
import { ShowConfig } from '@/core/crud/configs';
import model from '@/modules/box/models/brand';

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
                    path: 'box/brand/:pk',
                    query: {
                        'show[0]': 'boxes_count',
                        'with[0]': 'creator',
                    },
                },
                events: {
                    afterResponse: (data) => {
                        this.title += ': ' + data.name;

                        new Page({
                            context: this,
                            breadcrumbs: [
                                {
                                    label: this.__('routes->box.brand'),
                                    path: 'box/brand/index',
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
