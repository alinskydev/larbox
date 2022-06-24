<script setup>
import { UpdatePage } from '@/app/core/pages/crud';
import model from '@/modules/system/models/language';

import PageTitle from '@/app/components/blocks/PageTitle.vue';
import Buttons from '@/app/components/crud/form/_Buttons.vue';
import Item from '@/app/components/crud/http/Item.vue';
</script>

<script>
export default {
    data() {
        return new UpdatePage({
            context: this,
            title: this.__('Редактирование'),
            titleField: 'name',
            breadcrumbs: [
                {
                    label: this.__('Языки'),
                    path: 'system/language',
                },
            ],
            model: model,
            http: {
                method: 'PATCH',
                path: 'system/language/:id',
            },
            redirectPath: 'system/language',
            afterSubmit: (context, form, responseBody) => {
                toastr.success(context.__('Запись успешно сохранена'));
                context.booted.components.app.$data.appChildKey++;
            },
        });
    },
};
</script>

<template>
    <PageTitle :text="title">
        <Buttons :actions="['cancel', 'save']" />
    </PageTitle>

    <Item child="form" />
</template>
