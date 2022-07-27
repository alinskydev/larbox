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

        let value = this.item.value;

        if (value === undefined || value.length === 0) return;

        if (this.options.initValue) {
            if (this.options.isMultiple) {
                for (let key in value) {
                    this.items[value[key]] = this.options.initValue[key];
                }
            } else {
                this.items[value] = this.options.initValue;
            }
        } else {
            let query = this.options.query ?? {};

            if (typeof query === 'function') {
                query = query(this, this.item);
            }

            query['show[]'] = 'with-deleted';

            if (typeof value === 'object') {
                for (let key in value) {
                    query['filter[id][' + key + ']'] = value[key];
                }
            } else {
                query['filter[id]'] = value;
            }

            this.booted.helpers.http.send(this, {
                method: 'GET',
                path: this.options.path,
                query: query,
            }).then((response) => {
                if (response.statusType === 'success') {
                    for (let key in response.data.data) {
                        let dataItem = response.data.data[key];

                        if (this.isLocalized) {
                            this.items[dataItem.id] = dataItem[this.field][this.booted.locale];
                        } else {
                            this.items[dataItem.id] = dataItem[this.field];
                        }
                    }
                }
            });
        }
    },
    mounted() {
        $('#' + this.item.id).select2({
            allowClear: true,
            placeholder: '',
            ajax: {
                headers: this.booted.config.http.headers,
                url: () => {
                    let url = new URL(this.booted.config.http.url + '/' + this.options.path),
                        query = this.options.query ?? {};

                    if (typeof query === 'function') {
                        query = query(this, this.item);
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
                            id: value.id,
                            text: this.isLocalized ? value[this.field][this.booted.locale] : value[this.field],
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
        });
    },
};
</script>

<template>
    <select :multiple="options.isMultiple">
        <option v-for="(selectItem, key) in items" :value="key" selected>
            {{ selectItem }}
        </option>
    </select>
</template>