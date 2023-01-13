<script setup>
import App from '@/core/app';
import Page from '@/core/page';
import Model from '@/modules/system/models/language';
import { UpdateConfig } from '@/core/crud/configs';

import PageTitle from '@/components/blocks/PageTitle.vue';
import Buttons from '@/components/crud/form/Buttons.vue';
import Update from '@/components/crud/Update.vue';
</script>

<script>
export default {
    data() {
        return {
            title: App.t('routeActions->update'),
            config: new UpdateConfig({
                model: Model,
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

                        Page.init({
                            title: this.title,
                            breadcrumbs: [
                                {
                                    label: App.t('routes->system.language'),
                                    path: 'system/language/index',
                                },
                            ],
                        });
                    },
                    afterSubmit: (formData, response) => {
                        toastr.success(App.t('Сохранение прошло успешно'));
                        App.components.app.refresh();
                        App.page.goUp();
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
