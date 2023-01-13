<script setup>
import App from '@/core/app';
import Page from '@/core/page';
import Model from '@/modules/box/models/box';
import { CreateConfig } from '@/core/crud/configs';

import PageTitle from '@/components/blocks/PageTitle.vue';
import Buttons from '@/components/crud/form/Buttons.vue';
import Create from '@/components/crud/Create.vue';
</script>

<script>
export default {
    data() {
        return {
            title: App.t('routeActions->create'),
            config: new CreateConfig({
                model: Model,
                http: {
                    path: 'box/box',
                },
                events: {
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
    created() {
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
};
</script>

<template>
    <PageTitle :text="title">
        <Buttons />
    </PageTitle>

    <Create :config="config" />
</template>
