<script setup>
import { Page } from '@/app/core/page';
import { CreateConfig } from '@/app/core/crud/config';
import model from '@/modules/user/models/user';

import PageTitle from '@/app/components/blocks/PageTitle.vue';
import Buttons from '@/app/components/crud/form/particles/Buttons.vue';
import Create from '@/app/components/crud/Create.vue';
</script>

<script>
export default {
    data() {
        return {
            page: new Page({
                context: this,
                title: this.__('Создание'),
                breadcrumbs: [
                    {
                        label: this.__('Пользователи'),
                        path: 'user/user',
                    },
                ],
            }),
            config: new CreateConfig({
                model: model,
                http: {
                    path: 'user/user',
                },
                redirectPath: 'user/user',
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
