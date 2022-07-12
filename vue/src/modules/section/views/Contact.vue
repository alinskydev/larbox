<script setup>
import { Page } from '@/app/core/page';
import { UpdateConfig } from '@/app/core/crud/config';

import model from '@/modules/section/models/contact';

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
                    name: this.booted.enums.section.contact.label,
                }),
            }),
            config: new UpdateConfig({
                model: model,
                http: {
                    path: 'section/contact',
                },
                redirectPath: 'section/page/contact',
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
