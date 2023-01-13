<script setup>
import App from '@/core/app';
import Model from '@/modules/box/models/category';
import { ShowConfig } from '@/core/crud/configs';

import Show from '@/components/crud/Show.vue';
</script>

<script>
export default {
    props: {
        elementId: {
            type: String,
            required: true,
        },
    },
    data() {
        return {
            title: App.t('routeActions->show'),
            config: new ShowConfig({
                model: Model,
                http: {
                    path: 'box/category/:pk',
                },
                events: {
                    afterResponse: (data) => {
                        this.title += ': ' + data.name[App.locale];
                    },
                },
            }),
        };
    },
};
</script>

<template>
    <div class="modal-header">
        <h4 class="modal-title">
            {{ title }}
        </h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>

    <div class="modal-body">
        <Show :config="config" />
    </div>
</template>
