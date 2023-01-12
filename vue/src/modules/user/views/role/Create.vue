<script setup>
import { Page } from '@/core/page';
import { CreateConfig } from '@/core/crud/configs';
import model from '@/modules/user/models/role';

import PageTitle from '@/components/blocks/PageTitle.vue';
import Buttons from '@/components/crud/form/Buttons.vue';
import Create from '@/components/crud/Create.vue';
</script>

<script>
export default {
    data() {
        return {
            title: this.__('routeActions->create'),
            config: new CreateConfig({
                model: model,
                http: {
                    path: 'user/role',
                },
            }),
        };
    },
    created() {
        new Page({
            context: this,
            breadcrumbs: [
                {
                    label: this.__('routes->user.role'),
                    path: 'user/role/index',
                },
            ],
        });
    },
};
</script>

<template>
    <PageTitle :text="title">
        <Buttons />
    </PageTitle>

    <Create :config="config" />
</template>
