<script setup>
import App from '@/core/app';
import { CreateConfig } from '@/core/crud/configs';
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
            type: CreateConfig,
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
            model: Object.assign({}, this.config.model.fillData()),
            elementId: App.helpers.string.uniqueElementId(),
        };
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
