<script setup>
import { Page } from '@/core/page';
import { ShowConfig } from '@/core/crud/configs';
import model from '@/modules/box/models/box';

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
                    path: 'box/box/:pk',
                    query: {
                        'with[0]': 'brand',
                        'with[1]': 'categories.parents',
                        'with[2]': 'tags',
                        'with[3]': 'variations',
                    },
                },
                events: {
                    afterResponse: (data) => {
                        this.title += ': ' + data.name[this.booted.locale];

                        new Page({
                            context: this,
                            breadcrumbs: [
                                {
                                    label: this.__('routes->box.box'),
                                    path: 'box/box/index',
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
