<script setup>
import { Page } from '@/core/base/page';
import { UpdateConfig } from '@/core/base/crud/config';
import model from '@/modules/user/models/role';

import PageTitle from '@/components/blocks/PageTitle.vue';
import Buttons from '@/components/crud/form/particles/Buttons.vue';
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
                        path: 'user/role',
                    },
                ],
            }),
            config: new UpdateConfig({
                model: model,
                title: 'name.:locale',
                http: {
                    path: 'user/role/:id',
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
