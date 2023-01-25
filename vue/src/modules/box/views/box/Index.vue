<script setup>
import App from '@/core/app';
import Page from '@/core/page';
import Model from '@/modules/box/models/box';
import { IndexConfig } from '@/core/crud/configs';

import PageTitle from '@/components/blocks/PageTitle.vue';
import RouterLink from '@/components/blocks/RouterLink.vue';
import Index from '@/components/crud/Index.vue';
</script>

<script>
export default {
    data() {
        return {
            title: App.t('routes->box.box'),
            config: new IndexConfig({
                model: Model,
                http: {
                    path: 'box/box',
                    query: {
                        'with[0]': 'brand',
                        'with[1]': 'categories.parents',
                        'with[2]': 'tags',
                    },
                },
                selection: {
                    actions: ['deleteMultiple'],
                },
            }),
        };
    },
    created() {
        Page.init({
            title: this.title,
        });
    },
};
</script>

<template>
    <PageTitle :text="title">
        <RouterLink to="box/box/create" class="btn btn-primary">
            {{ App.t('routeActions->create') }}
        </RouterLink>
    </PageTitle>

    <Index :config="config" />
</template>
