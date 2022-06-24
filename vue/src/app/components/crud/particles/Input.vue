<script setup>
import * as inputEnums from '@/app/enums/input';

import Date from '@/app/components/inputs/Date.vue';
import Datetime from '@/app/components/inputs/Datetime.vue';
import File from '@/app/components/inputs/File.vue';
import Hidden from '@/app/components/inputs/Hidden.vue';
import Password from '@/app/components/inputs/Password.vue';
import Select from '@/app/components/inputs/Select.vue';
import Select2Ajax from '@/app/components/inputs/Select2Ajax.vue';
import Switcher from '@/app/components/inputs/Switcher.vue';
import Text from '@/app/components/inputs/Text.vue';
import Textarea from '@/app/components/inputs/Textarea.vue';
import Time from '@/app/components/inputs/Time.vue';

import Relations from './input/Relations.vue';
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
};
</script>

<template>
    <template v-if="item.type === inputEnums.types.text">
        <Text :name="item.name"
              :value="item.value"
              :label="item.label"
              :options="item.options"
              :wrapperSize="item.wrapperSize" />
    </template>

    <template v-else-if="item.type === inputEnums.types.textarea">
        <Textarea :name="item.name"
                  :value="item.value"
                  :label="item.label"
                  :options="item.options"
                  :wrapperSize="item.wrapperSize" />
    </template>

    <template v-else-if="item.type === inputEnums.types.password">
        <Password :name="item.name"
                  :value="item.value"
                  :label="item.label"
                  :options="item.options"
                  :wrapperSize="item.wrapperSize" />
    </template>

    <template v-else-if="item.type === inputEnums.types.date">
        <Date :name="item.name"
              :value="item.value"
              :label="item.label"
              :options="item.options"
              :wrapperSize="item.wrapperSize" />
    </template>

    <template v-else-if="item.type === inputEnums.types.datetime">
        <Datetime :name="item.name"
                  :value="item.value"
                  :label="item.label"
                  :options="item.options"
                  :wrapperSize="item.wrapperSize" />
    </template>

    <template v-else-if="item.type === inputEnums.types.time">
        <Time :name="item.name"
              :value="item.value"
              :label="item.label"
              :options="item.options"
              :wrapperSize="item.wrapperSize" />
    </template>

    <template v-else-if="item.type === inputEnums.types.hidden">
        <Hidden :name="item.name"
                :value="item.value" />
    </template>

    <template v-else-if="item.type === inputEnums.types.select">
        <Select :name="item.name"
                :value="item.value"
                :label="item.label"
                :options="item.options"
                :wrapperSize="item.wrapperSize" />
    </template>

    <template v-else-if="item.type === inputEnums.types.select2Ajax">
        <Select2Ajax :name="item.name"
                     :value="item.value"
                     :select2Value="item.select2Value"
                     :label="item.label"
                     :options="item.options"
                     :wrapperSize="item.wrapperSize" />
    </template>

    <template v-else-if="item.type === inputEnums.types.switcher">
        <Switcher :name="item.name"
                  :value="item.value"
                  :label="item.label"
                  :options="item.options"
                  :wrapperSize="item.wrapperSize" />
    </template>

    <template v-else-if="item.type === inputEnums.types.file">
        <File :name="item.name"
              :value="item.value"
              :label="item.label"
              :options="item.options"
              :wrapperSize="item.wrapperSize" />
    </template>

    <template v-else-if="item.type === inputEnums.types.relations">
        <Relations :namePrefix="item.name"
                   :relations="item.value"
                   :options="item.options" />
    </template>

    <template v-else-if="item.type === inputEnums.types.component">
        <ComponentResolver :resolve="item.options.resolve(booted.components.page, item)" />
    </template>
</template>