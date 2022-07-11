<script setup>
import { Page } from '@/app/core/page';
import { UpdateConfig } from '@/app/core/crud/config';

import model from '@/modules/page/models/home';

import PageTitle from '@/app/components/blocks/PageTitle.vue';
import Buttons from '@/app/components/crud/form/particles/Buttons.vue';
import Update from '@/app/components/crud/Update.vue';
</script>

<script>
export default {
    data() {
        return {
            page: new Page({
                context: this,
                title: this.__('Страница: :name', {
                    name: this.__('Home'),
                }),
            }),
            config: new UpdateConfig({
                model: model,
                http: {
                    path: 'page/:name',
                },
                redirectPath: 'page/' + this.$route.params.name,
                afterSubmit: (context, formData, response) => {
                    toastr.success(context.__('Страница успешно сохранена'));
                    context.booted.components.app.childKey++;
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
