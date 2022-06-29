<script setup>
import * as crudEnums from '@/app/core/crud/enums';

import Main from '@/app/components/input/layouts/Main.vue';

import Date from '@/app/components/input/Date.vue';
import Datetime from '@/app/components/input/Datetime.vue';
import File from '@/app/components/input/File.vue';
import Hidden from '@/app/components/input/Hidden.vue';
import Select from '@/app/components/input/Select.vue';
import Select2Ajax from '@/app/components/input/Select2Ajax.vue';
import Switcher from '@/app/components/input/Switcher.vue';
import Text from '@/app/components/input/Text.vue';
import Textarea from '@/app/components/input/Textarea.vue';
import Time from '@/app/components/input/Time.vue';

import Relations from '@/app/components/input/Relations.vue';
import ComponentResolver from '@/app/components/decorators/ComponentResolver.vue';
</script>

<script>
export default {
    props: {
        item: {
            type: Object,
            required: true,
        },
    },
    created() {
        this.item.id = 'input-' + this.booted.helpers.string.uniqueId();
    },
};
</script>

<template>
    <Main v-if="item.type !== crudEnums.inputTypes.hidden
    && item.type !== crudEnums.inputTypes.relations
    && item.type !== crudEnums.inputTypes.component"
          :item="item" v-slot="main">
        <template v-if="item.type === crudEnums.inputTypes.text">
            <Text :item="item" v-bind="main.inputAttrs" />
        </template>

        <template v-else-if="item.type === crudEnums.inputTypes.textarea">
            <Textarea :item="item" v-bind="main.inputAttrs" />
        </template>

        <template v-else-if="item.type === crudEnums.inputTypes.date">
            <Date :item="item" v-bind="main.inputAttrs" />
        </template>

        <template v-else-if="item.type === crudEnums.inputTypes.datetime">
            <Datetime :item="item" v-bind="main.inputAttrs" />
        </template>

        <template v-else-if="item.type === crudEnums.inputTypes.time">
            <Time :item="item" v-bind="main.inputAttrs" />
        </template>

        <template v-else-if="item.type === crudEnums.inputTypes.select">
            <Select :item="item" v-bind="main.inputAttrs" />
        </template>

        <template v-else-if="item.type === crudEnums.inputTypes.select2Ajax">
            <Select2Ajax :set="delete main.inputAttrs.value" :item="item" v-bind="main.inputAttrs" />
        </template>

        <template v-else-if="item.type === crudEnums.inputTypes.switcher">
            <Switcher :item="item" v-bind="main.inputAttrs" />
        </template>

        <template v-else-if="item.type === crudEnums.inputTypes.file">
            <File :set="delete main.inputAttrs.value" :item="item" v-bind="main.inputAttrs" />
        </template>
    </Main>

    <template v-else-if="item.type === crudEnums.inputTypes.hidden">
        <Hidden :item="item" />
    </template>

    <template v-else-if="item.type === crudEnums.inputTypes.relations">
        <Relations :item="item" />
    </template>

    <template v-else-if="item.type === crudEnums.inputTypes.component">
        <ComponentResolver :resolve="item.options.resolve(booted.components.page, item)" />
    </template>
</template>