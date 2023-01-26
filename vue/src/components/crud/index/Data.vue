<script setup>
import App from '@/core/app';
import { IndexConfig } from '@/core/crud/configs';
import * as Enums from '@/core/enums';

import Selection from './data/Selection.vue';
import Actions from './data/Actions.vue';
import Pagination from './data/Pagination.vue';

import Value from '@/components/Value.vue';
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
            models: [],
            meta: {},
        };
    },
    created() {
        App.helpers.http
            .send({
                method: 'GET',
                path: this.config.http.path,
                query: {
                    ...(this.config.http.query ?? {}),
                    ...this.$route.query,
                },
            })
            .then((response) => {
                if (response.statusType === 'success') {
                    for (let dataKey in response.data.data) {
                        this.models[dataKey] = Object.assign({}, this.config.model.fillData(response.data.data[dataKey]));
                    }

                    this.meta = response.data.meta;
                }
            });
    },
};
</script>

<template>
    <div class="crud-index-data accordion card">
        <button class="accordion-button card-header" type="button" data-bs-toggle="collapse" :data-bs-target="'#' + elementId">
            {{ App.t('Данные') }}
        </button>

        <div :id="elementId" class="collapse show">
            <div class="card-body">
                <template v-if="models.length > 0">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <Selection :config="config" type="tableHead" />

                                    <template v-for="item in models[0].data.index">
                                        <th>
                                            {{ item.label }}
                                        </th>
                                    </template>

                                    <template v-if="config.grid.actions.length > 0">
                                        <th></th>
                                    </template>
                                </tr>
                            </thead>

                            <tbody>
                                <tr v-for="model in models" v-bind="config.grid.rowAttributes(model.data.record)">
                                    <Selection :config="config" type="tableBody" :pk="model.data.pk" />

                                    <template v-for="data in model.data.index">
                                        <template v-if="data.type === Enums.valueTypes.image">
                                            <td style="width: 130px">
                                                <Value :item="data" />
                                            </td>
                                        </template>

                                        <template
                                            v-else-if="
                                                data.type === Enums.valueTypes.httpSelect ||
                                                data.type === Enums.valueTypes.httpSwitcher
                                            "
                                        >
                                            <td :set="(data.attributes['disabled'] = Boolean(model.data.record.is_deleted))">
                                                <Value :item="data" />
                                            </td>
                                        </template>

                                        <template v-else>
                                            <td>
                                                <Value :item="data" />
                                            </td>
                                        </template>
                                    </template>

                                    <template v-if="config.grid.actions.length > 0">
                                        <td style="width: 50px">
                                            <Actions :config="config" :model="model" />
                                        </td>
                                    </template>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <Selection :config="config" type="actions" />
                </template>

                <template v-else>
                    <h5 class="m-0">
                        {{ App.t('Нет данных') }}
                    </h5>
                </template>
            </div>

            <div class="card-footer">
                <template v-if="models.length > 0">
                    <Pagination :meta="meta" />
                </template>
            </div>
        </div>
    </div>
</template>
