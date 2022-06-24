<script setup>
import Wrapper from './_Wrapper.vue';
</script>

<script>
export default {
    data() {
        return {
            id: 'input-' + this.booted.helpers.string.uniqueId(),
            options: this.$attrs.options,
            select2Value: this.$attrs.select2Value,
            select2SubValue: this.$attrs.options?.select2SubValue,
            items: {},
            field: null,
            isLocalized: false,
        };
    },
    created() {
        if (this.options.field.includes(':locale')) {
            this.isLocalized = true;
            this.field = this.options.field.replace(':locale', '');
        } else {
            this.field = this.options.field;
        }

        let value = this.$attrs.value;

        if (value === undefined || value.length === 0) return;

        if (this.select2Value) {
            if (this.options.isMultiple) {
                for (let key in this.select2Value) {
                    let itemValue = this.select2Value[key],
                        subValue = this.select2SubValue;

                    if (subValue) {
                        subValue = subValue.replace(':locale', this.booted.locale);
                        subValue = this.booted.helpers.iterator.searchByPath(itemValue, subValue);
                    }

                    this.items[itemValue.id] = subValue;
                }
            } else {
                this.items[value] = this.select2Value;
            }
        } else {
            let query = this.options.query ?? {};

            if (typeof query === 'function') {
                query = query($('#' + this.id));
            }

            query = Object.create(query);

            if (typeof value === 'object') {
                for (let key in value) {
                    query['filter[id][' + key + ']'] = value[key];
                }
            } else {
                query['filter[id]'] = value;
            }

            query['show[]'] = 'with-deleted';

            this.booted.helpers.http.send(this, {
                method: 'GET',
                path: this.options.path,
                query: query,
            }).then((response) => {
                if (response.statusType === 'success') {
                    response.json().then((body) => {
                        for (let key in body.data) {
                            let item = body.data[key];

                            if (this.isLocalized) {
                                this.items[item.id] = item[this.field][this.booted.locale];
                            } else {
                                this.items[item.id] = item[this.field];
                            }
                        }
                    });
                }
            });
        }
    },
    mounted() {
        $('#' + this.id).select2({
            allowClear: true,
            placeholder: ' ',
            ajax: {
                headers: this.booted.config.http.headers,
                url: () => {
                    let url = new URL(this.booted.config.http.url + '/' + this.options.path),
                        query = this.options.query ?? {};

                    if (typeof query === 'function') {
                        query = query($('#' + this.id));
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
                    let valueField = this.options.valueField ?? this.field,
                        results = [];

                    for (let key in data.data) {
                        results[key] = {};
                        results[key]['id'] = data.data[key]['id'];
                        results[key]['text'] = data.data[key][valueField];

                        if (this.isLocalized) {
                            results[key]['text'] = results[key]['text'][this.booted.locale];
                        }
                    }

                    return {
                        results: results,
                        pagination: {
                            more: results.length > 0,
                        },
                    };
                },
            },
        });

        if (this.options.onChange) this.options.onChange($('#' + this.id));

        $('#' + this.id).on('change', () => {
            if (this.options.onChange) this.options.onChange($('#' + this.id));
        });
    },
};
</script>

<template>
    <Wrapper :id="id" v-slot="main">
        <select :set="delete main.inputAttrs.value" v-bind="main.inputAttrs" :multiple="options.isMultiple">
            <option :value="null"></option>
            <option v-for="(item, key) in items" :value="key" selected>
                {{ item }}
            </option>
        </select>
    </Wrapper>
</template>