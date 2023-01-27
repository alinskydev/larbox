<script setup>
import App from '@/core/app';
import Hint from '@/components/input/particles/Hint.vue';
import Error from '@/components/input/particles/Error.vue';
import DisabledMask from '@/components/input/particles/DisabledMask.vue';

import * as Enums from '@/core/enums';
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
            errorKey: this.item.name.replaceAll('[', '.').replaceAll(']', ''),
        };
    },
    created() {
        this.inputAttrs = {
            'name': this.item.name,
            'value': this.item.value,
            'id': this.item.elementId,
            'class': 'form-control',
        };

        if (this.item.options.isLocalized) {
            this.inputAttrs['name'] += '[:locale]';
            this.inputAttrs['id'] += '-:locale';

            this.errorKey += '.:locale';
        }

        if (this.item.options.isMultiple) {
            this.inputAttrs['name'] += '[]';

            this.errorKey += '.*';
        }
    },
};
</script>

<template>
    <div
        v-if="
            item.type !== Enums.inputTypes.component &&
            item.type !== Enums.inputTypes.hidden &&
            item.type !== Enums.inputTypes.relations
        "
        :class="item.size"
    >
        <template v-if="item.options.isLocalized">
            <div class="row">
                <template v-for="language in App.languages.all">
                    <div :class="'input-wrapper mb-3 ' + (item.options.size ?? Enums.inputSizes.md)">
                        <label v-if="item.label" :for="inputAttrs['id'].replace(':locale', language.code)" v-html="item.label" />
                        |
                        <img :src="language.image.widen_25.webp" class="align-text-bottom ms-1" />

                        <slot
                            :inputAttrs="{
                                ...{
                                    'name': inputAttrs['name'].replace(':locale', language.code),
                                    'value': inputAttrs['value'] ? inputAttrs['value'][language.code] : '',
                                    'id': inputAttrs['id'].replace(':locale', language.code),
                                    'class': inputAttrs['class'],
                                },
                                ...item.attributes,
                            }"
                        ></slot>

                        <Hint v-if="item.hint" :text="item.hint" />
                        <Error :errorKey="errorKey.replace(':locale', language.code)" />
                        <DisabledMask :attributes="item.attributes" />
                    </div>
                </template>
            </div>
        </template>

        <template v-else>
            <div class="input-wrapper mb-3">
                <label v-if="item.label" :for="inputAttrs['id']" v-html="item.label" />

                <slot
                    :inputAttrs="{
                        ...inputAttrs,
                        ...item.attributes,
                    }"
                ></slot>

                <Hint v-if="item.hint" :text="item.hint" />
                <Error :errorKey="errorKey" />
                <DisabledMask :attributes="item.attributes" />
            </div>
        </template>
    </div>

    <slot v-else />
</template>
