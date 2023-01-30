<script setup>
import App from '@/core/app';
import { UpdateConfig } from '@/core/crud/configs';
import * as Enums from '@/core/enums';

import Data from './form/Data.vue';
import TopButtons from './form/buttons/Top.vue';
import BottomStaticButtons from './form/buttons/BottomStatic.vue';
import BottomFixedButtons from './form/buttons/BottomFixed.vue';
</script>

<script>
export default {
    props: {
        config: {
            type: UpdateConfig,
            required: true,
        },
        actions: {
            type: Array,
        },
        dataLayout: {
            type: Number,
            default: Enums.crudFormDataLayouts.tabs,
        },
        buttonsLayout: {
            type: Number,
            default: Enums.crudFormButtonsLayouts.top,
        },
    },
    data() {
        return {
            model: null,
            elementId: App.helpers.string.uniqueElementId(),
        };
    },
    created() {
        let http = this.config.http;

        http.path = http.path.replace(':pk', this.$route.params.pk).replace(':slug', this.$route.params.slug);

        App.helpers.http
            .send({
                method: 'GET',
                path: http.path,
                query: http.query,
            })
            .then((response) => {
                if (response.statusType === 'success') {
                    if (this.config.events.afterResponse) {
                        this.config.events.afterResponse(response.data);
                    }

                    this.model = Object.assign({}, this.config.model.fillData(response.data));
                } else {
                    this.$router.back();
                }
            });
    },
};
</script>

<template>
    <TopButtons v-if="buttonsLayout === Enums.crudFormButtonsLayouts.top" :actions="actions" :elementId="elementId" />

    <Data v-if="model" :config="config" :model="model" :layout="dataLayout" :elementId="elementId" />

    <BottomStaticButtons
        v-if="buttonsLayout === Enums.crudFormButtonsLayouts.bottomStatic"
        :actions="actions"
        :elementId="elementId"
    />

    <BottomFixedButtons
        v-if="buttonsLayout === Enums.crudFormButtonsLayouts.bottomFixed"
        :actions="actions"
        :elementId="elementId"
    />
</template>
