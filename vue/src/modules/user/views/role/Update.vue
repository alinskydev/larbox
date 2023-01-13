<script setup>
import App from '@/core/app';
import Page from '@/core/page';
import Model from '@/modules/user/models/role';
import { UpdateConfig } from '@/core/crud/configs';

import PageTitle from '@/components/blocks/PageTitle.vue';
import Buttons from '@/components/crud/form/Buttons.vue';
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
    <PageTitle :text="title">
        <Buttons />
    </PageTitle>

    <Update :config="config" />
</template>
