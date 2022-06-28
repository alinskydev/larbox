<script setup>
import * as crudEnums from '@/app/core/crud/enums';

import Error from './_Error.vue';
</script>

<script>
export default {
    inheritAttrs: false,
    props: {
        id: {
            type: String,
            required: true,
        },
    },
    data() {
        return {
            size: this.$attrs.size,
            childsize: this.$attrs.options.size ?? crudEnums.inputSizes.md,
            label: this.$attrs.label,
            options: this.$attrs.options ?? {},
            languages: this.booted.languages.active,
            inputAttrs: {},
        };
    },
    created() {
        this.inputAttrs = {
            'name': this.$attrs.name,
            'data-error-key': this.$attrs.name.replaceAll('[', '.').replaceAll(']', ''),
            'value': this.$attrs.value,
            'id': this.id,
            'class': this.$attrs.class ?? 'form-control',
        };

        if (this.options.isLocalized) {
            this.inputAttrs['name'] += '[:locale]';
            this.inputAttrs['data-error-key'] += '.:locale';
            this.inputAttrs['id'] += '-:locale';
        }

        if (this.options.isMultiple) {
            this.inputAttrs['name'] += '[]';
            this.inputAttrs['data-error-key'] += '.*';
        }
    },
};
</script>

<template>
    <div :class="size">
        <template v-if="options.isLocalized">
            <div class="row">
                <template v-for="(language, key, index) in languages">
                    <div :class="'input-wrapper form-group ' + childsize">
                        <label v-if="label !== undefined" :for="inputAttrs['id'].replace(':locale', language.code)">
                            {{ label }}
                        </label>
                        |
                        <img :src="language.image?.w_30" class="align-text-bottom ml-1">

                        <slot :inputAttrs="{
                            'name': inputAttrs['name'].replace(':locale', language.code),
                            'data-error-key': inputAttrs['data-error-key'].replace(':locale', language.code),
                            'value': inputAttrs['value'] ? inputAttrs['value'][language.code] : '',
                            'id': inputAttrs['id'].replace(':locale', language.code),
                            'class': inputAttrs['class'],
                        }"></slot>

                        <Error />
                    </div>
                </template>
            </div>
        </template>

        <template v-else>
            <div class="input-wrapper form-group">
                <label v-if="label !== undefined" :for="inputAttrs['id']">
                    {{ label }}
                </label>

                <slot :inputAttrs="inputAttrs"></slot>

                <Error />
            </div>
        </template>
    </div>
</template>