<script setup>
import App from '@/core/app';
import Page from '@/core/page';
import Model from '@/modules/user/models/role';
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
                    path: 'user/role/:pk',
                },
                events: {
                    afterResponse: (data) => {
                        this.title += ': ' + data.name[App.locale];

                        Page.init({
                            title: this.title,
                            breadcrumbs: [
                                {
                                    label: App.t('routes->user.role'),
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
