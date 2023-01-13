<script setup>
import App from '@/core/app';
import Page from '@/core/page';
import Model from '@/modules/box/models/box';
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
                    path: 'box/box/:pk',
                    query: {
                        'with[0]': 'brand',
                        'with[1]': 'categories',
                        'with[2]': 'tags',
                        'with[3]': 'variations',
                    },
                },
                events: {
                    afterResponse: (data) => {
                        this.title += ': ' + data.name[App.locale];

                        Page.init({
                            title: this.title,
                            breadcrumbs: [
                                {
                                    label: App.t('routes->box.box'),
                                    path: 'box/box/index',
                                },
                            ],
                        });
                    },
                    beforeSubmit: (formData) => {
                        let checked = $('#box-categories-tree').jstree(true).get_checked();

                        checked.forEach((value) => {
                            formData.append('categories[]', value);
                        });
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
