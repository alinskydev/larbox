<script setup>
import { IndexPage } from '@/app/core/crud/page';
import model from '@/modules/box/models/brand';

import PageTitle from '@/app/components/blocks/PageTitle.vue';
import RouterLink from "@/app/components/blocks/RouterLink.vue";
import Index from '@/app/components/crud/Index.vue';
</script>

<script>
export default {
    data() {
        return new IndexPage({
            context: this,
            title: this.__('Brands'),
            model: model,
            http: {
                path: 'box/brand',
                query: {
                    'show[0]': 'boxes_count',
                    'with[0]': 'creator',
                },
            },
            actions: ['show', 'update', 'delete', 'restore'],
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
        });
    },
};
</script>

<template>
    <PageTitle :text="title">
        <RouterLink to="box/brand/create" class="btn btn-success">
            {{ __('Создать') }}
        </RouterLink>
    </PageTitle>

    <Index />
</template>
