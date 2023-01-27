<script setup>
import * as Lodash from 'lodash';
import App from '@/core/app';
import { IndexConfig } from '@/core/crud/configs';

import Sort from './filter/Sort.vue';
import SoftDelete from './filter/SoftDelete.vue';

import Input from '@/components/Input.vue';
</script>

<script>
export default {
    props: {
        config: {
            type: IndexConfig,
            required: true,
        },
    },
    data() {
        return {
            elementId: App.helpers.string.uniqueElementId(),
            model: this.config.model,
            filters: {},
        };
    },
    created() {
        let query = this.$route.query,
            values = {};

        query = Object.fromEntries(Object.entries(query).filter(([key, value]) => key.includes('filter[')));

        for (let key in query) {
            key = key.replace('filter[', '', key);

            if (key.includes('][')) {
                let keyArr = key.split('][');

                let firstKey = keyArr[0];
                let lastKey = keyArr[1].replace(']', '');

                values[firstKey] ??= {};
                values[firstKey][lastKey] = query['filter[' + key];
            } else {
                values[key.replace(']', '')] = query['filter[' + key];
            }
        }

        this.filters = this.model.fillData(values).data.filters;
    },
    methods: {
        submit(event) {
            let formData = new FormData(event.target),
                query = {},
                queryIndex = 0;

            formData.forEach((value, key) => {
                if (key.includes('[]')) {
                    key = key.replace('[]', '[' + queryIndex + ']');
                    queryIndex++;
                }

                query[key] = value;
            });

            this.$router
                .push({
                    path: this.$route.path,
                    query: Lodash.pickBy(query),
                })
                .then(() => {
                    this.$parent.$data.dataKey++;
                });
        },
        reset(event) {
            this.$router
                .push({
                    path: this.$route.path,
                })
                .then(() => {
                    $(event.target).find('input, textarea, select').val('').trigger('change');
                    this.$parent.$data.dataKey++;
                });
        },
    },
};
</script>

<template>
    <div
        v-if="filters.length > 0 || model.config.sortings.length > 0 || model.hasSoftDelete"
        class="accordion card"
    >
        <button class="accordion-button card-header" type="button" data-bs-toggle="collapse" :data-bs-target="'#' + elementId">
            {{ App.t('Фильтр') }}
        </button>

        <div :id="elementId" class="collapse show">
            <form @submit.prevent="submit" @reset.prevent="reset">
                <div class="card-body">
                    <div class="row">
                        <template v-for="filter in filters">
                            <Input :item="filter" />
                        </template>

                        <Sort v-if="model.config.sortings.length > 0" :fields="model.config.sortings" />
                        <SoftDelete v-if="model.hasSoftDelete" />
                    </div>
                </div>

                <div class="card-footer text-end">
                    <div class="btn-group">
                        <button type="reset" class="btn btn-danger">
                            {{ App.t('Сбросить') }}
                        </button>

                        <button type="submit" class="btn btn-primary">
                            {{ App.t('Применить') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>
