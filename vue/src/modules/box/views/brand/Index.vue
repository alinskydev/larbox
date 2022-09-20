<script setup>
import { Page } from '@/core/base/page';
import { IndexConfig } from '@/core/base/crud/config';
import model from '@/modules/box/models/brand';

import PageTitle from '@/components/blocks/PageTitle.vue';
import RouterLink from '@/components/blocks/RouterLink.vue';
import Index from '@/components/crud/Index.vue';
</script>

<script>
export default {
    data() {
        return {
            page: new Page({
                context: this,
                title: this.__('routes->box.brand'),
            }),
            config: new IndexConfig({
                model: model,
                http: {
                    path: 'box/brand',
                    query: {
                        'show[0]': 'boxes_count',
                        'with[0]': 'creator',
                    },
                },
                filter: {
                    hasSoftDelete: true,
                },
                grid: {
                    actions: ['boxes', 'show', 'update', 'delete', 'restore'],
                    customActions: {
                        boxes: (item) => {
                            if (!this.booted.helpers.user.checkRoute(this, 'box/box/index')) return null;

                            return {
                                path: 'box/box?filter[brand_id]=' + item.id.value,
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
                    actions: ['deleteAll', 'restoreAll'],
                },
            }),
        };
    },
};
</script>

<template>
    <PageTitle :text="page.title">
        <RouterLink to="box/brand/create" class="btn btn-success">
            {{ __('routeActions->create') }}
        </RouterLink>
    </PageTitle>

    <Index />
</template>
