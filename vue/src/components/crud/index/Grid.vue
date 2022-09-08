<script setup>
import * as Enums from '@/core/base/enums';

import Value from '@/components/Value.vue';

import Selection from './particles/Selection.vue';
import Actions from './particles/Actions.vue';
import Pagination from './particles/Pagination.vue';
</script>

<script>
export default {
    data() {
        return {
            config: this.booted.components.current.config,
            model: this.booted.components.current.config.model,
            fields: {},
            items: [],
            meta: {},
        };
    },
    created() {
        this.booted.helpers.http
            .send(this, {
                method: 'GET',
                path: this.config.http.path,
                query: {
                    ...(this.config.http.query ?? {}),
                    ...this.$route.query,
                },
            })
            .then((response) => {
                if (response.statusType === 'success') {
                    this.fields = this.model.prepareFields(this, this.model.list);

                    for (let dataKey in response.data.data) {
                        this.items[dataKey] = this.model.prepareValues(this, this.model.list, response.data.data[dataKey]);
                        this.items[dataKey]['is_deleted'] = response.data.data[dataKey]['is_deleted'];
                    }

                    this.meta = response.data.meta;
                }
            });
    },
};
</script>

<template>
    <div class="card card-primary crud-index-data">
        <div class="card-header">
            <h3 class="card-title">
                {{ __('Данные') }}
            </h3>
        </div>

        <div class="card-body">
            <template v-if="items.length > 0">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <Selection type="tableHead" />

                                <template v-for="(field, key) in fields">
                                    <th v-if="!config.gridHiddenFields.includes(key)">
                                        {{ field.label }}
                                    </th>
                                </template>

                                <template v-if="config.actions.length > 0">
                                    <th></th>
                                </template>
                            </tr>
                        </thead>

                        <tbody>
                            <tr v-for="item in items" v-bind="config.gridRowAttributes(item)">
                                <Selection type="tableBody" :id="item.id.value" />

                                <template v-for="(field, key) in fields">
                                    <template v-if="!config.gridHiddenFields.includes(key)">
                                        <template v-if="item[key].type === Enums.valueTypes.image">
                                            <td style="width: 130px">
                                                <Value :item="item[key]" :id="item.id.value" />
                                            </td>
                                        </template>

                                        <template
                                            v-else-if="
                                                item[key].type === Enums.valueTypes.httpSelect ||
                                                item[key].type === Enums.valueTypes.httpSwitcher
                                            "
                                        >
                                            <td :set="(item[key].attributes['disabled'] = item.is_deleted === true)">
                                                <Value :item="item[key]" :id="item.id.value" />
                                            </td>
                                        </template>

                                        <template v-else>
                                            <td>
                                                <Value :item="item[key]" :id="item.id.value" />
                                            </td>
                                        </template>
                                    </template>
                                </template>

                                <template v-if="config.actions.length > 0">
                                    <td class="text-right" style="width: 50px">
                                        <Actions :item="item" />
                                    </td>
                                </template>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <Selection type="actions" />
            </template>

            <template v-else>
                <h5 class="m-0">
                    {{ __('Нет данных') }}
                </h5>
            </template>
        </div>

        <div class="card-footer">
            <template v-if="items.length > 0">
                <Pagination :meta="meta" />
            </template>
        </div>
    </div>
</template>
