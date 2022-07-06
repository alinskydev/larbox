<script setup>
import * as Enums from '@/app/core/enums';

import Hint from '@/app/components/input/particles/Hint.vue';
import Error from '@/app/components/input/particles/Error.vue';
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
            inputAttrs: {},
            extraAttrs: typeof this.item.attributes === 'function' ? this.item.attributes(this) : this.item.attributes,
        };
    },
    created() {
        this.inputAttrs = {
            'name': this.item.name,
            'data-error-key': this.item.name.replaceAll('[', '.').replaceAll(']', ''),
            'value': this.item.value,
            'id': this.item.id,
            'class': 'form-control',
        };

        if (this.item.options.isLocalized) {
            this.inputAttrs['name'] += '[:locale]';
            this.inputAttrs['data-error-key'] += '.:locale';
            this.inputAttrs['id'] += '-:locale';
        }

        if (this.item.options.isMultiple) {
            this.inputAttrs['name'] += '[]';
            this.inputAttrs['data-error-key'] += '.*';
        }
    },
};
</script>

<template>
    <div :class="item.size">
        <template v-if="item.options.isLocalized">
            <div class="row">
                <template v-for="(language, key, index) in booted.languages.active">
                    <div :class="'input-wrapper form-group ' + (item.options.size ?? Enums.inputSizes.md)">
                        <label v-if="item.label" :for="inputAttrs['id'].replace(':locale', language.code)">
                            {{ item.label }}
                        </label>
                        |
                        <img :src="language.image?.w_30" class="align-text-bottom ml-1">

                        <slot :inputAttrs="{
                            ...{
                                'name': inputAttrs['name'].replace(':locale', language.code),
                                'data-error-key': inputAttrs['data-error-key'].replace(':locale', language.code),
                                'value': inputAttrs['value'] ? inputAttrs['value'][language.code] : '',
                                'id': inputAttrs['id'].replace(':locale', language.code),
                                'class': inputAttrs['class'],
                            },
                            ...extraAttrs,
                        }"></slot>

                        <Hint v-if="item.hint" :text="item.hint" />
                        <Error />
                    </div>
                </template>
            </div>
        </template>

        <template v-else>
            <div class="input-wrapper form-group">
                <label v-if="item.label" :for="inputAttrs['id']">
                    {{ item.label }}
                </label>

                <slot :inputAttrs="{
                    ...inputAttrs,
                    ...extraAttrs,
                }"></slot>

                <Hint v-if="item.hint" :text="item.hint" />
                <Error />
            </div>
        </template>
    </div>
</template>