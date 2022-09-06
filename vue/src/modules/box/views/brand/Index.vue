<script setup>
import { Page } from '@/core/page';
import { IndexConfig } from '@/core/crud/config';
import model from '@/modules/box/models/brand';

import PageTitle from '@/components/blocks/PageTitle.vue';
import RouterLink from "@/components/blocks/RouterLink.vue";
import Index from '@/components/crud/Index.vue';
</script>

<script>
export default {
    data() {
        return {
            page: new Page({
                context: this,
                title: this.__('Brands'),
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
                selectionActions: ['deleteAll', 'restoreAll'],
                actions: ['boxes', 'show', 'update', 'delete', 'restore'],
                extraActions: {
                    boxes: (item) => {
                        return {
                            path: 'box/box?filter[brand_id]=' + item.id.value,
                            linkAttributes: {
                                'title': this.__('Boxes'),
                                'class': 'btn btn-info',
                            },
                            iconAttributes: {
                                'class': 'fas fa-boxes',
                            },
                        };
                    },
                },
                hasSoftDelete: true,
            }),
        };
    },
};
</script>

<template>
    <PageTitle :text="page.title">
        <RouterLink to="box/brand/create" class="btn btn-success">
            {{  __('Создать')  }}
        </RouterLink>
    </PageTitle>

    <Index />
</template>
