<script setup>
import { Page } from '@/core/page';
import { UpdateConfig } from '@/core/crud/configs';
import model from '@/modules/system/models/language';

import PageTitle from '@/components/blocks/PageTitle.vue';
import Buttons from '@/components/crud/form/Buttons.vue';
import Update from '@/components/crud/Update.vue';
</script>

<script>
export default {
    data() {
        return {
            title: this.__('routeActions->update'),
            config: new UpdateConfig({
                model: model,
                http: {
                    path: 'system/language/:pk',
                    query: {
                        'with[0]': 'brand',
                        'with[1]': 'tags',
                        'with[2]': 'variations',
                    },
                },
                events: {
                    afterResponse: (data) => {
                        this.title += ': ' + data.name;

                        new Page({
                            context: this,
                            breadcrumbs: [
                                {
                                    label: this.__('routes->system.language'),
                                    path: 'system/language/index',
                                },
                            ],
                        });
                    },
                    afterSubmit: (formData, response) => {
                        toastr.success(this.__('Сохранение прошло успешно'));
                        this.booted.components.app.childKey++;
                        this.booted.page.goUp();
                    },
                },
            }),
        };
    },
};
</script>

<template>
    <PageTitle :text="title">
        <Buttons />
    </PageTitle>

    <Update :config="config" />
</template>
