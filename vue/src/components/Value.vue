<script setup>
import * as Enums from '@/core/enums';

import Wrapper from '@/components/value/particles/Wrapper.vue';

import ComponentResolver from '@/components/decorators/ComponentResolver.vue';
import HttpSelect from '@/components/value/HttpSelect.vue';
import HttpSwitcher from '@/components/value/HttpSwitcher.vue';
import Images from '@/components/value/Images.vue';
import Relations from '@/components/value/Relations.vue';
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
        this.item.elementId = this.booted.helpers.string.uniqueElementId();

        if (typeof this.item.attributes === 'function') {
            this.item.attributes = this.item.attributes(this, this.item);
        } else {
            this.item.attributes = this.item.attributes;
        }
    },
};
</script>

<template>
    <Wrapper :item="item">
        <template v-if="item.type === Enums.valueTypes.array">
            <div v-for="value in item.value">
                {{ value }}
            </div>
        </template>

        <template v-else-if="item.type === Enums.valueTypes.boolean">
            {{ item.value ? __('Да') : __('Нет') }}
        </template>

        <template v-else-if="item.type === Enums.valueTypes.component">
            <ComponentResolver :resolve="item.options.component.resolve(booted.components.app, item)" />
        </template>

        <template v-else-if="item.type === Enums.valueTypes.fields">
            <div v-for="field in item.options.fields">
                {{ __('fields->' + field) + ': ' + item.value[field] }}
            </div>
        </template>

        <template v-else-if="item.type === Enums.valueTypes.html">
            <div v-html="item.value" v-bind="item.attributes"></div>
        </template>

        <template v-else-if="item.type === Enums.valueTypes.httpSelect">
            <HttpSelect :item="item" />
        </template>

        <template v-else-if="item.type === Enums.valueTypes.httpSwitcher">
            <HttpSwitcher :item="item" />
        </template>

        <template v-else-if="item.type === Enums.valueTypes.image">
            <Images v-if="typeof item.value === 'object'" :item="item" />
            <img v-else :src="item.value" v-bind="item.attributes" />
        </template>

        <template v-else-if="item.type === Enums.valueTypes.json">
            <pre v-html="JSON.stringify(item.value, null, 2)"></pre>
        </template>

        <template v-else-if="item.type === Enums.valueTypes.link">
            <template v-if="typeof item.value === 'object'" v-for="(link, key) in item.value">
                <a :href="link" target="_blank" class="d-block">
                    {{ __('Ссылка №:index', { index: key + 1 }) }}
                </a>
            </template>

            <a v-else :href="item.value" target="_blank">
                {{ __('Ссылка') }}
            </a>
        </template>

        <template v-else-if="item.type === Enums.valueTypes.price">
            {{ item.value !== null ? new Intl.NumberFormat('ru-RU').format(item.value).replace(',', '.') : null }}
        </template>

        <template v-else-if="item.type === Enums.valueTypes.relations">
            <Relations :item="item" />
        </template>

        <template v-else-if="item.type === Enums.valueTypes.text">
            <span style="white-space: pre-wrap">
                {{ item.value }}
            </span>
        </template>

        <template v-else-if="item.type === Enums.valueTypes.websiteLink">
            <a
                :href="
                    booted.config.http.websiteUrl +
                    '/' +
                    booted.locale +
                    '/' +
                    item.options.websiteLink.replace(':value', item.value)
                "
                target="_blank"
            >
                {{ item.value }}
            </a>
        </template>
    </Wrapper>
</template>
