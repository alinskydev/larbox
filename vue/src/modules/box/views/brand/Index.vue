<script setup>
import App from '@/core/app';
import Page from '@/core/page';
import Model from '@/modules/box/models/brand';
import { IndexConfig } from '@/core/crud/configs';

import PageTitle from '@/components/blocks/PageTitle.vue';
import PageTitleButtons from '@/components/blocks/PageTitleButtons.vue';
import RouterLink from '@/components/blocks/RouterLink.vue';
import Index from '@/components/crud/Index.vue';
</script>

<script>
export default {
    data() {
        return {
            title: App.t('routes->box.brand'),
            config: new IndexConfig({
                model: Model,
                http: {
                    path: 'box/brand',
                    query: {
                        'show[0]': 'boxes_count',
                        'with[0]': 'creator',
                    },
                },
                grid: {
                    actions: ['boxes', 'show', 'update', 'delete'],
                    customActions: {
                        boxes: (record) => {
                            return {
                                path: 'box/box/index?filter[brand_id]=' + record.id,
                                linkAttributes: {
                                    title: App.t('routes->box.box'),
                                    class: 'btn btn-info' + (record.is_deleted ? ' d-none' : ''),
                                },
                                iconAttributes: {
                                    class: 'fas fa-boxes',
                                },
                            };
                        },
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
    <PageTitle :text="title" />

    <PageTitleButtons>
        <RouterLink to="box/brand/create" class="btn btn-primary">
            {{ App.t('routeActions->create') }}
        </RouterLink>
    </PageTitleButtons>

    <Index :config="config" />
</template>
