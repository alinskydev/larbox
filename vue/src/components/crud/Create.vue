<script setup>
import App from '@/core/app';
import { CreateConfig } from '@/core/crud/configs';

import Data from './form/Data.vue';
import AccordionsButtons from './form/accordions/Buttons.vue';
import TabsButtons from './form/tabs/Buttons.vue';
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
        layout: {
            type: String,
            default: 'tabs',
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
    <TabsButtons v-if="layout === 'tabs'" :actions="actions" :elementId="elementId" />
    <Data v-if="model" :config="config" :model="model" :layout="layout" :elementId="elementId" />
    <AccordionsButtons v-if="layout === 'accordions'" :actions="actions" :elementId="elementId" />
</template>
