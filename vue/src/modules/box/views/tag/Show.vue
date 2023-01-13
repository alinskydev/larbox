<script setup>
import App from '@/core/app';
import Page from '@/core/page';
import Model from '@/modules/box/models/tag';
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
                    path: 'box/tag/:pk',
                },
                events: {
                    afterResponse: (data) => {
                        this.title += ': ' + data.name;

                        Page.init({
                            title: this.title,
                            breadcrumbs: [
                                {
                                    label: App.t('routes->box.tag'),
                                    path: 'box/tag/index',
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
