<script setup>
import { Page } from '@/core/page';
import { UpdateConfig } from '@/core/crud/configs';
import model from '@/modules/system/models/settings';

import PageTitle from '@/components/blocks/PageTitle.vue';
import Buttons from '@/components/crud/form/Buttons.vue';
import Update from '@/components/crud/Update.vue';
</script>

<script>
export default {
    data() {
        return {
            title: this.__('routes->system.settings'),
            config: new UpdateConfig({
                model: model,
                http: {
                    path: 'system/settings',
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
    created() {
        new Page({
            context: this,
        });
    },
};
</script>

<template>
    <PageTitle :text="title">
        <Buttons :actions="['save']" />
    </PageTitle>

    <Update :config="config" />
</template>
