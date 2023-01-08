<script setup>
import { Page } from '@/core/page';
import { UpdateConfig } from '@/core/crud/config';
import model from '@/modules/system/models/language';

import PageTitle from '@/components/blocks/PageTitle.vue';
import Buttons from '@/components/crud/form/Buttons.vue';
import Update from '@/components/crud/Update.vue';
</script>

<script>
export default {
    data() {
        return {
            page: new Page({
                context: this,
                title: this.__('routeActions->update'),
                breadcrumbs: [
                    {
                        label: this.__('routes->system.language'),
                        path: 'system/language/index',
                    },
                ],
            }),
            config: new UpdateConfig({
                model: model,
                title: 'name',
                http: {
                    path: 'system/language/:pk',
                    query: {
                        'with[0]': 'brand',
                        'with[1]': 'tags',
                        'with[2]': 'variations',
                    },
                },
                events: {
                    afterSubmit: (formData, response) => {
                        toastr.success(this.__('Сохранение прошло успешно'));
                        this.booted.components.app.childKey++;
                        this.page.goUp();
                    },
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
