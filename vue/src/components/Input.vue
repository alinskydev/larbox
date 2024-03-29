<script setup>
import App from '@/core/app';
import * as Enums from '@/core/enums';

import Wrapper from '@/components/input/particles/Wrapper.vue';

import Date from '@/components/input/Date.vue';
import Datetime from '@/components/input/Datetime.vue';
import File from '@/components/input/File.vue';
import Hidden from '@/components/input/Hidden.vue';
import Phone from '@/components/input/Phone.vue';
import Relations from '@/components/input/Relations.vue';
import Select from '@/components/input/Select.vue';
import Select2 from '@/components/input/Select2.vue';
import Select2Ajax from '@/components/input/Select2Ajax.vue';
import Switcher from '@/components/input/Switcher.vue';
import Text from '@/components/input/Text.vue';
import Textarea from '@/components/input/Textarea.vue';
import TextEditor from '@/components/input/TextEditor.vue';
import Time from '@/components/input/Time.vue';

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
    data() {
        return {};
    },
    created() {
        this.item.elementId = App.helpers.string.uniqueElementId();
    },
};
</script>

<template>
    <Wrapper v-if="!item.isHidden" :item="item" v-slot="wrapper">
        <template v-if="item.type === Enums.inputTypes.component">
            <ComponentResolver :resolve="item.options.component.resolve(item.record)" />
        </template>

        <template v-else-if="item.type === Enums.inputTypes.date">
            <Date :item="item" v-bind="wrapper.inputAttrs" />
        </template>

        <template v-else-if="item.type === Enums.inputTypes.datetime">
            <Datetime :item="item" v-bind="wrapper.inputAttrs" />
        </template>

        <template v-else-if="item.type === Enums.inputTypes.file">
            <File :set="delete wrapper.inputAttrs.value" :item="item" v-bind="wrapper.inputAttrs" />
        </template>

        <template v-else-if="item.type === Enums.inputTypes.hidden">
            <Hidden :item="item" />
        </template>

        <template v-else-if="item.type === Enums.inputTypes.phone">
            <Phone :item="item" v-bind="wrapper.inputAttrs" />
        </template>

        <template v-else-if="item.type === Enums.inputTypes.relations">
            <Relations :item="item" />
        </template>

        <template v-else-if="item.type === Enums.inputTypes.select">
            <Select :item="item" v-bind="wrapper.inputAttrs" />
        </template>

        <template v-else-if="item.type === Enums.inputTypes.select2">
            <Select2 :set="delete wrapper.inputAttrs.value" :item="item" v-bind="wrapper.inputAttrs" />
        </template>

        <template v-else-if="item.type === Enums.inputTypes.select2Ajax">
            <Select2Ajax :set="delete wrapper.inputAttrs.value" :item="item" v-bind="wrapper.inputAttrs" />
        </template>

        <template v-else-if="item.type === Enums.inputTypes.switcher">
            <Switcher :item="item" v-bind="wrapper.inputAttrs" />
        </template>

        <template v-else-if="item.type === Enums.inputTypes.text">
            <Text :item="item" v-bind="wrapper.inputAttrs" />
        </template>

        <template v-else-if="item.type === Enums.inputTypes.textarea">
            <Textarea :item="item" v-bind="wrapper.inputAttrs" />
        </template>

        <template v-else-if="item.type === Enums.inputTypes.textEditor">
            <TextEditor :item="item" v-bind="wrapper.inputAttrs" />
        </template>

        <template v-else-if="item.type === Enums.inputTypes.time">
            <Time :item="item" v-bind="wrapper.inputAttrs" />
        </template>
    </Wrapper>
</template>
