<script setup>
import { Page } from '@/core/page';
import { UpdateConfig } from '@/core/crud/config';
import model from '@/modules/user/models/role';

import PageTitle from '@/components/blocks/PageTitle.vue';
import Buttons from '@/components/crud/form/Buttons.vue';
import Update from '@/components/crud/Update.vue';
</script>

<script>
export default {
    data() {
        return {
            page: new Page({
                context: this,
                title: this.__('routeActions->update'),
                breadcrumbs: [
                    {
                        label: this.__('routes->user.role'),
                        path: 'user/role/index',
                    },
                ],
            }),
            config: new UpdateConfig({
                model: model,
                title: 'name.:locale',
                http: {
                    path: 'user/role/:pk',
                },
            }),
        };
    },
};
</script>

<template>
    <PageTitle :text="page.title">
        <Buttons />
    </PageTitle>

    <Update />
</template>
