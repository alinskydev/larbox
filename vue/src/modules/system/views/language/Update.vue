<script setup>
import { Page } from '@/core/base/page';
import { UpdateConfig } from '@/core/base/crud/config';
import model from '@/modules/system/models/language';

import PageTitle from '@/components/blocks/PageTitle.vue';
import Buttons from '@/components/crud/form/particles/Buttons.vue';
import Update from '@/components/crud/Update.vue';
</script>

<script>
export default {
    data() {
        return {
            page: new Page({
                context: this,
                title: this.__('Редактирование'),
                breadcrumbs: [
                    {
                        label: this.__('Языки'),
                        path: 'system/language',
                    },
                ],
            }),
            config: new UpdateConfig({
                model: model,
                http: {
                    path: 'system/language/:id',
                    query: {
                        'with[0]': 'brand',
                        'with[1]': 'tags',
                        'with[2]': 'variations',
                    },
                },
                titleField: 'name',
                redirectPath: 'system/language',
                afterSubmit: (context, formData, response) => {
                    toastr.success(context.__('Запись успешно сохранена'));
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
