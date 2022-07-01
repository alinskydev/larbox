<script setup>
import { Page } from '@/app/core/page';
import { IndexConfig } from '@/app/core/crud/config';
import model from '@/modules/box/models/brand';

import PageTitle from '@/app/components/blocks/PageTitle.vue';
import RouterLink from "@/app/components/blocks/RouterLink.vue";
import Index from '@/app/components/crud/Index.vue';
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
                actions: ['boxes', 'show', 'update', 'delete', 'restore'],
                extraActions: {
                    boxes: {
                        path: 'box/box?filter[brand_id]=:id',
                        buttonOptions: {
                            title: this.__('Boxes'),
                            class: 'btn btn-info',
                        },
                        iconOptions: {
                            class: 'fas fa-boxes',
                        },
                    },
                },
            }),
        };
    },
};
</script>

<template>
    <PageTitle :text="page.title">
        <RouterLink to="box/brand/create" class="btn btn-success">
            {{ __('Создать') }}
        </RouterLink>
    </PageTitle>

    <Index />
</template>
