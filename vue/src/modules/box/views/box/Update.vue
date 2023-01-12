<script setup>
import { Page } from '@/core/page';
import { UpdateConfig } from '@/core/crud/configs';
import model from '@/modules/box/models/box';

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
                        this.title += ': ' + data.name[this.booted.locale];

                        new Page({
                            context: this,
                            breadcrumbs: [
                                {
                                    label: this.__('routes->box.box'),
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
