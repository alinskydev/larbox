<script setup>
import App from '@/core/app';
import Page from '@/core/page';
import Model from '@/modules/user/models/role';
import { IndexConfig } from '@/core/crud/configs';

import PageTitle from '@/components/blocks/PageTitle.vue';
import RouterLink from '@/components/blocks/RouterLink.vue';
import Index from '@/components/crud/Index.vue';
</script>

<script>
export default {
    data() {
        return {
            title: App.t('routes->user.role'),
            config: new IndexConfig({
                model: Model,
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
                                    'title': App.t('routeActions->update'),
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
        Page.init({
            title: this.title,
        });
    },
};
</script>

<template>
    <PageTitle :text="title">
        <RouterLink to="user/role/create" class="btn btn-primary">
            {{ App.t('routeActions->create') }}
        </RouterLink>
    </PageTitle>

    <Index :config="config" />
</template>
