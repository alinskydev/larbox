<script setup>
import { Page } from '@/core/page';
import { UpdateConfig } from '@/core/crud/config';
import model from '@/modules/box/models/box';

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
                title: this.__('routeActions->update'),
                breadcrumbs: [
                    {
                        label: this.__('routes->box.box'),
                        path: 'box/box',
                    },
                ],
            }),
            config: new UpdateConfig({
                model: model,
                title: 'name.:locale',
                http: {
                    path: 'box/box/:id',
                    query: {
                        'with[0]': 'brand',
                        'with[1]': 'categories',
                        'with[2]': 'tags',
                        'with[3]': 'variations',
                    },
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
};
</script>

<template>
    <PageTitle :text="page.title">
        <Buttons />
    </PageTitle>

    <Update />
</template>
