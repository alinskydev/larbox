<script setup>
import App from '@/core/app';
import { IndexConfig } from '@/core/crud/configs';

import Filter from './index/Filter.vue';
import Data from './index/Data.vue';
</script>

<script>
export default {
    props: {
        config: {
            type: IndexConfig,
            required: true,
        },
    },
    data() {
        return {
            dataKey: 0,
        };
    },
};
</script>

<template>
    <Filter :config="config" />
    <Data :config="config" :key="dataKey" />
</template>
