<script setup>
import { Page } from '@/core/base/page';
import { UpdateConfig } from '@/core/base/crud/config';

import { Model } from '@/core/base/model';

import PageTitle from '@/components/blocks/PageTitle.vue';
import Buttons from '@/components/crud/form/particles/Buttons.vue';
import Update from '@/components/crud/Update.vue';
</script>

<script>
export default {
    inheritAttrs: false,
    props: {
        title: {
            type: String,
            required: true,
        },
        name: {
            type: String,
            required: true,
        },
        type: {
            type: String,
            required: true,
        },
        model: {
            type: Model,
            required: true,
        },
    },
    data() {
        return {
            page: new Page({
                context: this,
                title: this.__('Страница: :name', {
                    name: this.title,
                }),
            }),
            config: new UpdateConfig({
                model: this.model,
                http: {
                    path: 'section/' + this.name,
                },
                events: {
                    afterSubmit: (context, formData, response) => {
                        toastr.success(context.__('Страница успешно сохранена'));
                        context.booted.components.app.childKey++;
                    },
                },
            }),
        };
    },
};
</script>

<template>
    <PageTitle :text="page.title">
        <Buttons :actions="['save']" />
    </PageTitle>

    <Update />
</template>
