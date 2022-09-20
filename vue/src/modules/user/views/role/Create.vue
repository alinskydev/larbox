<script setup>
import { Page } from '@/core/base/page';
import { CreateConfig } from '@/core/base/crud/config';
import model from '@/modules/user/models/role';

import PageTitle from '@/components/blocks/PageTitle.vue';
import Buttons from '@/components/crud/form/particles/Buttons.vue';
import Create from '@/components/crud/Create.vue';
</script>

<script>
export default {
    data() {
        return {
            page: new Page({
                context: this,
                title: this.__('routeActions->create'),
                breadcrumbs: [
                    {
                        label: this.__('routes->user.role'),
                        path: 'user/role',
                    },
                ],
            }),
            config: new CreateConfig({
                model: model,
                http: {
                    path: 'user/role',
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

    <Create />
</template>
