<script setup>
import { Page } from '@/core/page';
import { IndexConfig } from '@/core/crud/configs';
import model from '@/modules/user/models/role';

import PageTitle from '@/components/blocks/PageTitle.vue';
import RouterLink from '@/components/blocks/RouterLink.vue';
import Index from '@/components/crud/Index.vue';
</script>

<script>
export default {
    data() {
        return {
            title: this.__('routes->user.role'),
            config: new IndexConfig({
                model: model,
                http: {
                    path: 'user/role',
                },
                grid: {
                    actions: ['show', 'updateAlt', 'delete'],
                    customActions: {
                        updateAlt: (record) => {
                            return {
                                path: 'user/role/' + record.id + '/update',
                                linkAttributes: {
                                    'title': this.__('routeActions->update'),
                                    'class': 'btn btn-warning' + (record.id === 1 ? ' disabled' : ''),
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
    created() {
        new Page({
            context: this,
        });
    },
};
</script>

<template>
    <PageTitle :text="title">
        <RouterLink to="user/role/create" class="btn btn-success">
            {{ __('routeActions->create') }}
        </RouterLink>
    </PageTitle>

    <Index :config="config" />
</template>
