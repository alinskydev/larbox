<script setup>
import App from '@/core/app';
import Page from '@/core/page';
import Model from '@/modules/box/models/box';
import { ShowConfig } from '@/core/crud/configs';

import PageTitle from '@/components/blocks/PageTitle.vue';
import Show from '@/components/crud/Show.vue';
</script>

<script>
export default {
    data() {
        return {
            title: App.t('routeActions->show'),
            config: new ShowConfig({
                model: Model,
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
                        this.title += ': ' + data.name[App.locale];

                        Page.init({
                            title: this.title,
                            breadcrumbs: [
                                {
                                    label: App.t('routes->box.box'),
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
