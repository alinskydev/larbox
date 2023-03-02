<script setup>
import App from '@/core/app';
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
            options: this.item.options,
            inputOptions: this.item.options.select2Ajax ?? {},
            items: {},
            pk: null,
            field: null,
            isLocalized: false,
        };
    },
    created() {
        this.pk = this.inputOptions.pk ?? 'id';
        this.inputOptions.query ??= {};

        if (this.inputOptions.field.includes(':locale')) {
            this.isLocalized = true;
            this.field = this.inputOptions.field.replace('.:locale', '');
        } else {
            this.field = this.inputOptions.field;
        }

        let value = this.item.value;

        if (value === undefined || value === null || value.length === 0) return;

        if (this.inputOptions.initValue) {
            let initValue = this.inputOptions.initValue.replace(':locale', App.locale);

            initValue = App.helpers.iterator.get(this.item.record, initValue);

            if (this.options.isMultiple) {
                for (let key in value) {
                    this.items[value[key]] = initValue[key];
                }
            } else {
                this.items[value] = initValue;
            }
        } else {
            let query = Object.assign({}, this.inputOptions.query);

            if (typeof query === 'function') {
                query = query(this.item.record);
            }

            if (typeof value === 'object') {
                for (let key in value) {
                    query['filter[' + this.pk + '][' + key + ']'] = value[key];
                }
            } else {
                query['filter[' + this.pk + ']'] = value;
            }

            App.helpers.http
                .send({
                    method: 'GET',
                    path: this.inputOptions.path,
                    query: query,
                })
                .then((response) => {
                    if (response.statusType === 'success') {
                        for (let key in response.data.data) {
                            let dataItem = response.data.data[key],
                                dataItemPk = dataItem[this.pk];

                            if (this.isLocalized) {
                                this.items[dataItemPk] = dataItem[this.field][App.locale];
                            } else {
                                this.items[dataItemPk] = dataItem[this.field];
                            }
                        }
                    }
                });
        }
    },
    mounted() {
        $('#' + this.item.elementId)
            .select2({
                allowClear: true,
                placeholder: this.$attrs.placeholder ?? '',
                ajax: {
                    headers: App.config.http.headers,
                    url: () => {
                        let url = new URL(App.config.http.url + '/' + this.inputOptions.path),
                            query = Object.assign({}, this.inputOptions.query);

                        if (typeof query === 'function') {
                            query = query(this.item.record);
                        }

                        for (let key in query) {
                            url.searchParams.append(key, query[key]);
                        }

                        return url;
                    },
                    dataType: 'json',
                    delay: 300,
                    data: (params) => {
                        let query = {};

                        query['page'] = params.page;
                        query['filter[' + this.field + ']'] = params.term;

                        return query;
                    },
                    processResults: (data, params) => {
                        let results = data.data.map((value) => {
                            return {
                                id: value[this.pk],
                                text: this.isLocalized ? value[this.field][App.locale] : value[this.field],
                            };
                        });

                        return {
                            results: results,
                            pagination: {
                                more: results.length > 0,
                            },
                        };
                    },
                },
            })
            .on('select2:open', () => {
                $('.select2-search__field[aria-controls="select2-' + this.item.elementId + '-results"]')
                    .get(0)
                    .focus();
            });
    },
};
</script>

<template>
    <select :multiple="options.isMultiple" style="width: 100%">
        <option v-if="!options.isMultiple"></option>
        <option v-for="(selectItem, key) in items" :value="key" selected>
            {{ selectItem }}
        </option>
    </select>
</template>
