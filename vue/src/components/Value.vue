<script setup>
import App from '@/core/app';
import * as Enums from '@/core/enums';

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
    data() {
        return {
            moment: moment,
        };
    },
    created() {
        this.item.elementId = App.helpers.string.uniqueElementId();
    },
};
</script>

<template>
    <template v-if="item.type === Enums.valueTypes.array">
        <div v-for="value in item.value" v-bind="item.attributes">
            {{ value }}
        </div>
    </template>

    <template v-else-if="item.type === Enums.valueTypes.boolean">
        <span v-bind="item.attributes">
            {{ item.value ? App.t('Да') : App.t('Нет') }}
        </span>
    </template>

    <template v-else-if="item.type === Enums.valueTypes.component">
        <ComponentResolver :resolve="item.options.component.resolve(item.record)" />
    </template>

    <template v-else-if="item.type === Enums.valueTypes.date">
        <span v-bind="item.attributes">
            {{ item.value ? moment(item.value).format(App.config.formats.date) : null }}
        </span>
    </template>

    <template v-else-if="item.type === Enums.valueTypes.datetime">
        <span v-bind="item.attributes">
            {{ item.value ? moment(item.value).format(App.config.formats.datetime) : null }}
        </span>
    </template>

    <template v-else-if="item.type === Enums.valueTypes.fields">
        <div v-for="field in item.options.fields" v-bind="item.attributes">
            {{ App.t('fields->' + field) + ': ' + item.value[field] }}
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
        <pre v-html="JSON.stringify(item.value, null, 2)" v-bind="item.attributes"></pre>
    </template>

    <template v-else-if="item.type === Enums.valueTypes.link">
        <template v-if="typeof item.value === 'object'" v-for="(link, key) in item.value">
            <a :href="link" target="_blank" class="d-block" v-bind="item.attributes">
                {{ App.t('Ссылка №:index', { index: key + 1 }) }}
            </a>
        </template>

        <a v-else :href="item.value" target="_blank" v-bind="item.attributes">
            {{ App.t('Ссылка') }}
        </a>
    </template>

    <template v-else-if="item.type === Enums.valueTypes.price">
        <span v-bind="item.attributes">
            {{ item.value !== null ? new Intl.NumberFormat('ru-RU').format(item.value).replace(',', '.') : null }}
        </span>
    </template>

    <template v-else-if="item.type === Enums.valueTypes.relations">
        <Relations :item="item" />
    </template>

    <template v-else-if="item.type === Enums.valueTypes.text">
        <span class="ws-pre-wrap" v-bind="item.attributes">
            {{ item.value }}
        </span>
    </template>

    <template v-else-if="item.type === Enums.valueTypes.websiteLink">
        <a
            :href="App.config.http.websiteUrl + '/' + App.locale + '/' + item.options.websiteLink.replace(':value', item.value)"
            target="_blank"
            v-bind="item.attributes"
        >
            {{ item.value }}
        </a>
    </template>
</template>
