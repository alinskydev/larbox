<script setup>
import App from '@/core/app';
import Page from '@/core/page';
import Model from '@/modules/box/models/brand';
import { UpdateConfig } from '@/core/crud/configs';

import PageTitle from '@/components/blocks/PageTitle.vue';
import Update from '@/components/crud/Update.vue';
</script>

<script>
export default {
    data() {
        return {
            title: App.t('routeActions->update'),
            config: new UpdateConfig({
                model: Model,
                http: {
                    path: 'box/brand/:pk',
                },
                events: {
                    afterResponse: (data) => {
                        this.title += ': ' + data.name;

                        Page.init({
                            title: this.title,
                            breadcrumbs: [
                                {
                                    label: App.t('routes->box.brand'),
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
    <Update :config="config" />
</template>
