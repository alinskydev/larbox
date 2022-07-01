<script setup>
import { Page } from '@/app/core/page';
import { UpdateConfig } from '@/app/core/crud/config';
import model from '@/modules/system/models/language';

import PageTitle from '@/app/components/blocks/PageTitle.vue';
import Buttons from '@/app/components/crud/form/_Buttons.vue';
import Item from '@/app/components/crud/http/Item.vue';
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
                afterSubmit: (context, form, responseBody) => {
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

    <Item child="form" />
</template>
