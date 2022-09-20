<script setup>
import { Page } from '@/core/base/page';
import { ShowConfig } from '@/core/base/crud/config';
import model from '@/modules/system/models/language';

import PageTitle from '@/components/blocks/PageTitle.vue';
import Show from '@/components/crud/Show.vue';
</script>

<script>
export default {
    data() {
        return {
            page: new Page({
                context: this,
                title: this.__('routeActions->show'),
                breadcrumbs: [
                    {
                        label: this.__('routes->system.language'),
                        path: 'system/language',
                    },
                ],
            }),
            config: new ShowConfig({
                model: model,
                title: 'name',
                http: {
                    path: 'system/language/:id',
                },
            }),
        };
    },
};
</script>

<template>
    <PageTitle :text="page.title" />
    <Show />
</template>
