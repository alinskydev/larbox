<script setup>
import { UpdatePage } from '@/app/core/crud/page';
import model from '@/modules/system/models/settings';

import PageTitle from '@/app/components/blocks/PageTitle.vue';
import Buttons from '@/app/components/crud/form/_Buttons.vue';
import Item from '@/app/components/crud/http/Item.vue';
</script>

<script>
export default {
    data() {
        return new UpdatePage({
            context: this,
            title: this.__('Настройки'),
            titleField: 'project_name',
            model: model,
            http: {
                method: 'PATCH',
                path: 'system/settings',
            },
            redirectPath: 'system/settings',
            afterSubmit: (context, form, responseBody) => {
                toastr.success(context.__('Настройки успешно сохранены'));
                context.booted.components.app.$data.appChildKey++;
            },
        });
    },
};
</script>

<template>
    <PageTitle :text="title">
        <Buttons :actions="['save']" />
    </PageTitle>

    <Item child="form" />
</template>
