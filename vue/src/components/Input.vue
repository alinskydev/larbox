<script setup>
import * as Enums from '@/core/base/enums';

import Main from '@/components/input/layouts/Main.vue';

import Date from '@/components/input/Date.vue';
import Datetime from '@/components/input/Datetime.vue';
import File from '@/components/input/File.vue';
import Hidden from '@/components/input/Hidden.vue';
import Phone from '@/components/input/Phone.vue';
import Select from '@/components/input/Select.vue';
import Select2Ajax from '@/components/input/Select2Ajax.vue';
import Select2Array from '@/components/input/Select2Array.vue';
import Switcher from '@/components/input/Switcher.vue';
import Text from '@/components/input/Text.vue';
import Textarea from '@/components/input/Textarea.vue';
import TextEditor from '@/components/input/TextEditor.vue';
import Time from '@/components/input/Time.vue';

import Relations from '@/components/input/Relations.vue';
import ComponentResolver from '@/components/decorators/ComponentResolver.vue';
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
        this.item.id = 'el-' + this.booted.helpers.string.uniqueId();
    },
};
</script>

<template>
    <Main
        v-if="item.type !== Enums.inputTypes.hidden && item.type !== Enums.inputTypes.relations && item.type !== Enums.inputTypes.component"
        :item="item"
        v-slot="main"
    >
        <template v-if="item.type === Enums.inputTypes.date">
            <Date :item="item" v-bind="main.inputAttrs" />
        </template>

        <template v-else-if="item.type === Enums.inputTypes.datetime">
            <Datetime :item="item" v-bind="main.inputAttrs" />
        </template>

        <template v-else-if="item.type === Enums.inputTypes.file">
            <File :set="delete main.inputAttrs.value" :item="item" v-bind="main.inputAttrs" />
        </template>

        <template v-else-if="item.type === Enums.inputTypes.phone">
            <Phone :item="item" v-bind="main.inputAttrs" />
        </template>

        <template v-else-if="item.type === Enums.inputTypes.select">
            <Select :item="item" v-bind="main.inputAttrs" />
        </template>

        <template v-else-if="item.type === Enums.inputTypes.select2Ajax">
            <Select2Ajax :set="delete main.inputAttrs.value" :item="item" v-bind="main.inputAttrs" />
        </template>

        <template v-else-if="item.type === Enums.inputTypes.select2Array">
            <Select2Array :set="delete main.inputAttrs.value" :item="item" v-bind="main.inputAttrs" />
        </template>

        <template v-else-if="item.type === Enums.inputTypes.switcher">
            <Switcher :item="item" v-bind="main.inputAttrs" />
        </template>

        <template v-else-if="item.type === Enums.inputTypes.text">
            <Text :item="item" v-bind="main.inputAttrs" />
        </template>

        <template v-else-if="item.type === Enums.inputTypes.textarea">
            <Textarea :item="item" v-bind="main.inputAttrs" />
        </template>

        <template v-else-if="item.type === Enums.inputTypes.textEditor">
            <TextEditor :item="item" v-bind="main.inputAttrs" />
        </template>

        <template v-else-if="item.type === Enums.inputTypes.time">
            <Time :item="item" v-bind="main.inputAttrs" />
        </template>
    </Main>

    <template v-else-if="item.type === Enums.inputTypes.component">
        <ComponentResolver :resolve="item.options.resolve(booted.components.current, item)" />
    </template>

    <template v-else-if="item.type === Enums.inputTypes.hidden">
        <Hidden :item="item" />
    </template>

    <template v-else-if="item.type === Enums.inputTypes.relations">
        <Relations :item="item" />
    </template>
</template>
