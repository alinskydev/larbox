<script setup>
import { Page } from '@/app/core/page';
import { UpdateConfig } from '@/app/core/crud/config';
import model from '@/modules/system/models/settings';

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
                title: this.__('Настройки'),
                breadcrumbs: [
                    {
                        label: this.__('Boxes'),
                        path: 'box/box',
                    },
                ],
            }),
            config: new UpdateConfig({
                model: model,
                http: {
                    path: 'system/settings',
                },
                redirectPath: 'system/settings',
                afterSubmit: (context, form, responseBody) => {
                    toastr.success(context.__('Настройки успешно сохранены'));
                    context.booted.components.app.childKey++;
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

    <Item child="form" />
</template>
