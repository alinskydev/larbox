<script setup>
import * as crudEnums from '@/app/core/crud/enums';

import HttpSelect from '@/app/components/inputs/HttpSelect.vue';
import HttpSwitcher from '@/app/components/inputs/HttpSwitcher.vue';
import Relations from './value/Relations.vue';
import Images from './value/Images.vue';
import ComponentResolver from '@/app/components/decorators/ComponentResolver.vue';
</script>

<script>
export default {
    props: {
        item: {
            type: Object,
            required: true,
        },
        id: {
            type: Number,
            required: true,
        },
    },
};
</script>

<template>
    <template v-if="item.type === crudEnums.valueTypes.text">
        {{ item.value }}
    </template>

    <template v-else-if="item.type === crudEnums.valueTypes.boolean">
        {{ item.value ? __('Да') : __('Нет') }}
    </template>

    <template v-else-if="item.type === crudEnums.valueTypes.array">
        <div v-for="value in item.value">
            {{ value }}
        </div>
    </template>

    <template v-else-if="item.type === crudEnums.valueTypes.image">
        <Images v-if="typeof item.value === 'object'" :item="item" />
        <img v-else :src="item.value">
    </template>

    <template v-else-if="item.type === crudEnums.valueTypes.httpSelect">
        <HttpSelect :value="item.value"
                    :options="item.options"
                    :modelId="id" />
    </template>

    <template v-else-if="item.type === crudEnums.valueTypes.httpSwitcher">
        <HttpSwitcher :value="item.value"
                      :options="item.options"
                      :modelId="id" />
    </template>

    <template v-else-if="item.type === crudEnums.valueTypes.relations">
        <Relations :relationItem="item" :id="id" />
    </template>

    <template v-else-if="item.type === crudEnums.valueTypes.component">
        <ComponentResolver :resolve="item.options.resolve(booted.components.page, item)" />
    </template>
</template>