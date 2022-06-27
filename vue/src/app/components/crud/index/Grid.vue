<script setup>
import * as crudEnums from '@/app/core/crud/enums';

import Value from '@/app/components/crud/particles/Value.vue';
import Actions from './_Actions.vue';
import Pagination from './_Pagination.vue';
</script>

<script>
export default {
    data() {
        return {
            page: this.booted.components.page,
            fields: [],
            items: [],
            meta: {},
            isReady: false,
        };
    },
    created() {
        let model = this.page.model,
            http = this.page.http;

        let query = {
            ...(http.query ?? {}),
            ...this.$route.query,
        };

        this.booted.helpers.http.send(this, {
            method: 'GET',
            path: http.path,
            query: query,
        }).then((response) => {
            if (response.statusType === 'success') {
                response.json().then((body) => {
                    let data = body.data,
                        fields = model.list,
                        items = [];

                    for (let fieldKey in fields) {
                        let field = fields[fieldKey],
                            value = field.value;

                        field.label = this.__('fields->' + fieldKey);
                        field.options ??= {};

                        value = value.replace(':locale', this.booted.locale);

                        for (let dataKey in data) {
                            items[dataKey] ??= {};

                            items[dataKey][fieldKey] = {
                                value: this.booted.helpers.iterator.searchByPath(data[dataKey], value),
                                type: field.type,
                                options: field.options ?? {},
                            };

                            items[dataKey]['is_deleted'] = data[dataKey]['is_deleted'];

                            if (field.options?.onComplete) {
                                items[dataKey][fieldKey].value = field.options.onComplete(this, items[dataKey][fieldKey].value);
                            }
                        }
                    }

                    this.fields = fields;
                    this.items = items;
                    this.meta = body.meta;

                    this.isReady = true;
                });
            }
        });
    },
};
</script>

<template>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">
                {{ __('Данные') }}
            </h3>
        </div>

        <div class="card-body">
            <template v-if="isReady">
                <template v-if="items.length > 0">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th v-for="field in fields">
                                        {{ field.options.hideLabel ? '' : field.label }}
                                    </th>

                                    <template v-if="page.actions.length > 0">
                                        <th></th>
                                    </template>
                                </tr>
                            </thead>

                            <tbody>
                                <tr v-for="item in items">
                                    <template v-for="(field, key) in fields">
                                        <template v-if="item[key].type === crudEnums.valueTypes.image">
                                            <td style="width: 130px;">
                                                <Value :item="item[key]" :id="item.id.value" />
                                            </td>
                                        </template>

                                        <template v-else>
                                            <td>
                                                <Value :item="item[key]" :id="item.id.value" />
                                            </td>
                                        </template>
                                    </template>

                                    <template v-if="page.actions.length > 0">
                                        <td style="width: 50px;">
                                            <Actions :item="item"
                                                     :http="page.http"
                                                     :actions="page.actions"
                                                     :extraActions="page.extraActions" />
                                        </td>
                                    </template>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </template>

                <template v-else>
                    <h5 class="m-0">
                        {{ __('Нет данных') }}
                    </h5>
                </template>
            </template>
        </div>

        <div class="card-footer">
            <template v-if="items.length > 0">
                <Pagination :meta="meta" />
            </template>
        </div>
    </div>
</template>