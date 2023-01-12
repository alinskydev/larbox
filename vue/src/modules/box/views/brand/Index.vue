<script setup>
import { Page } from '@/core/page';
import { IndexConfig } from '@/core/crud/configs';
import model from '@/modules/box/models/brand';

import PageTitle from '@/components/blocks/PageTitle.vue';
import RouterLink from '@/components/blocks/RouterLink.vue';
import Index from '@/components/crud/Index.vue';
</script>

<script>
export default {
    data() {
        return {
            title: this.__('routes->box.brand'),
            config: new IndexConfig({
                model: model,
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
                                    title: this.__('routes->box.box'),
                                    class: 'btn btn-info',
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
        new Page({
            context: this,
        });
    },
};
</script>

<template>
    <PageTitle :text="title">
        <RouterLink to="box/brand/create" class="btn btn-success">
            {{ __('routeActions->create') }}
        </RouterLink>
    </PageTitle>

    <Index :config="config" />
</template>
