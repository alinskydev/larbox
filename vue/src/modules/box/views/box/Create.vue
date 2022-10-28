<script setup>
import { Page } from '@/core/page';
import { CreateConfig } from '@/core/crud/config';
import model from '@/modules/box/models/box';

import PageTitle from '@/components/blocks/PageTitle.vue';
import Buttons from '@/components/crud/form/particles/Buttons.vue';
import Create from '@/components/crud/Create.vue';
</script>

<script>
export default {
    data() {
        return {
            page: new Page({
                context: this,
                title: this.__('routeActions->create'),
                breadcrumbs: [
                    {
                        label: this.__('routes->box.box'),
                        path: 'box/box',
                    },
                ],
            }),
            config: new CreateConfig({
                model: model,
                http: {
                    path: 'box/box',
                },
                events: {
                    beforeSubmit: (context, formData) => {
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
    <PageTitle :text="page.title">
        <Buttons />
    </PageTitle>

    <Create />
</template>
