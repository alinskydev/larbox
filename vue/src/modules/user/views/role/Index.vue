<script setup>
import { Page } from '@/core/base/page';
import { IndexConfig } from '@/core/base/crud/config';
import model from '@/modules/user/models/role';

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
                title: this.__('routes->user.role'),
            }),
            config: new IndexConfig({
                model: model,
                http: {
                    path: 'user/role',
                },
                grid: {
                    actions: ['show', 'updateAlt', 'delete'],
                    customActions: {
                        updateAlt: (item) => {
                            return {
                                path: 'user/role/' + item.id.value + '/update',
                                linkAttributes: {
                                    'title': this.__('routeActions->update'),
                                    'class': 'btn btn-warning' + (item.id.value === 1 ? ' disabled' : ''),
                                },
                                iconAttributes: {
                                    'class': 'fas fa-edit',
                                },
                            };
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
        <RouterLink to="user/role/create" class="btn btn-success">
            {{ __('routeActions->store') }}
        </RouterLink>
    </PageTitle>

    <Index />
</template>
