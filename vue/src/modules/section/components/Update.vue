<script setup>
import { Page } from '@/core/page';
import { UpdateConfig } from '@/core/crud/config';

import { Model } from '@/core/model';

import PageTitle from '@/components/blocks/PageTitle.vue';
import Buttons from '@/components/crud/form/particles/Buttons.vue';
import Update from '@/components/crud/Update.vue';
</script>

<script>
export default {
    inheritAttrs: false,
    props: {
        name: {
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
                title: this.__('routeActions->update') + ': ' + this.__('routes->section.' + this.name),
            }),
            config: new UpdateConfig({
                model: this.model,
                http: {
                    path: 'section/' + this.name,
                },
                events: {
                    afterSubmit: (formData, response) => {
                        toastr.success(this.__('Сохранение прошло успешно'));
                        this.booted.components.app.childKey++;
                    },
                },
            }),
        };
    },
};
</script>

<template>
    <PageTitle :text="page.title">
        <Buttons v-if="booted.helpers.user.checkRoute(booted.components.app, 'section/update')" :actions="['save']" />
    </PageTitle>

    <Update />
</template>
