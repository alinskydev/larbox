import App from '@/core/app';

import * as Enums from './enums';
import * as ModelTypes from './types/modelTypes';

class Model {
    pk: string;

    hasSoftDelete: boolean;
    hasSeoMeta: boolean;
    hasUpdatedAtConflictCheck: boolean;

    config: {
        index: Record<string, ModelTypes.ValueParams>;
        filters: Record<string, ModelTypes.InputParams>;
        sortings: Array<string>;
        show: Record<string, any>;
        form: Record<string, any>;
    };

    data: {
        record: any;
        pk: any;
        index: any;
        filters: any;
        show: any;
        form: any;
    };

    constructor(params: {
        pk: string;

        hasSoftDelete: boolean;
        hasSeoMeta: boolean;
        hasUpdatedAtConflictCheck: boolean;

        config: {
            index: Record<string, ModelTypes.ValueParams>;
            filters: Record<string, ModelTypes.InputParams>;
            sortings: Array<string>;
            show: Record<
                string,
                Record<
                    string,
                    ModelTypes.ValueParams & {
                        options: {
                            relations: Record<string, ModelTypes.ValueParams>;
                        };
                    }
                >
            >;
            form: Record<
                string,
                Record<
                    string,
                    ModelTypes.InputParams & {
                        options: {
                            relations: Record<string, ModelTypes.InputParams>;
                        };
                    }
                >
            >;
        };
    }) {
        this.pk = params.pk ?? 'id';

        this.hasSoftDelete = params.hasSoftDelete ?? false;
        this.hasSeoMeta = params.hasSeoMeta ?? false;
        this.hasUpdatedAtConflictCheck = params.hasUpdatedAtConflictCheck ?? true;

        this.config = {
            index: params.config?.index ?? {},
            filters: params.config?.filters ?? {},
            sortings: params.config?.sortings ?? [],
            show: params.config?.show ?? {},
            form: params.config?.form ?? {},
        };

        if (this.hasSeoMeta) {
            this.config.form['SEO meta'] = {
                seo_meta: {
                    value: (record) => {
                        let value = record.seo_meta,
                            result = [];

                        if (!value) return null;

                        for (let language in App.languages.all) {
                            result[language] =
                                value[language] ??
                                [
                                    // '<meta name="description" content="" />',
                                    // '<meta name="keywords" content="" />',
                                    // '<meta property="og:description" content="" />',
                                ].join('\n');
                        }

                        return result;
                    },
                    type: Enums.inputTypes.textarea,
                    options: {
                        isLocalized: true,
                        size: Enums.inputSizes.xl,
                    },
                    attributes: {
                        rows: 10,
                    },
                    size: Enums.inputSizes.xl,
                },
            };
        }
    }

    fillData(record: Object = {}) {
        this.data = {
            record: record,
            pk: record[this.pk],
            index: this.prepareValues(this.config.index, record),
            filters: this.prepareFilters(this.config.filters, record),
            show: {},
            form: {},
        };

        for (let key in this.config.show) {
            this.data.show[key] = this.prepareValues(this.config.show[key], record);
        }

        for (let key in this.config.form) {
            if (this.hasUpdatedAtConflictCheck && key === Object.keys(this.config.form)[0]) {
                this.config.form[key].updated_at = {
                    type: Enums.inputTypes.hidden,
                };
            }

            this.data.form[key] = this.prepareInputs(this.config.form[key], record);
        }

        return this;
    }

    private prepareValues(fields: Object, record: Object) {
        let result = {};

        for (let key in fields) {
            let field = fields[key],
                value = field.value ?? key,
                attributes = field.attributes ?? {};

            if (typeof value === 'function') {
                value = value(record);
            } else {
                value = value.replace(':locale', App.locale);
                value = App.helpers.iterator.get(record, value);
            }

            if (field.type === Enums.valueTypes.relations) {
                value = value?.map((v) => this.prepareValues(field.options.relations, v));
            }

            result[key] = {
                attributes: typeof attributes === 'function' ? attributes(record) : attributes,
                label: field.label !== undefined ? field.label : App.t('fields->' + key),
                options: field.options ?? {},
                pk: record[this.pk],
                record: record,
                type: field.type,
                value: value,
            };
        }

        return result;
    }

    private prepareFilters(fields: Object, record: Object) {
        let result = {};

        for (let key in fields) {
            let field = fields[key],
                name = field.name ?? key,
                value = field.value ?? key,
                attributes = field.attributes ?? {};

            name = name.replaceAll('[', '][');
            name = name.replace(/]$/, '');
            name = 'filter[' + name + ']';

            if (typeof value === 'function') {
                value = value(record);
            } else {
                value = value.replace(':locale', App.locale);
                value = App.helpers.iterator.get(record, value, '->');
            }

            result[key] = {
                attributes: typeof attributes === 'function' ? attributes(record) : attributes,
                hint: field.hint,
                label: field.label !== undefined ? field.label : App.t('fields->' + key),
                name: name,
                options: field.options ?? {},
                pk: record[this.pk],
                record: record,
                size: field.size ?? Enums.inputSizes.sm,
                type: field.type,
                value: value,
            };
        }

        return result;
    }

    private prepareInputs(fields: Object, record: Object) {
        let result = {};

        for (let key in fields) {
            let field = fields[key],
                name = field.name ?? key,
                value = field.value ?? key,
                attributes = field.attributes ?? {};

            if (typeof value === 'function') {
                value = value(record);
            } else {
                value = App.helpers.iterator.get(record, value);
            }

            if (field.type === Enums.inputTypes.relations) {
                field.options.relations.id = {
                    type: Enums.inputTypes.hidden,
                };

                value = value?.map((v, k) => this.prepareRelationalInputs(field.options.relations, v, name, k)) ?? [];
            }

            result[key] = {
                attributes: typeof attributes === 'function' ? attributes(record) : attributes,
                hint: field.hint,
                label: field.label !== undefined ? field.label : App.t('fields->' + key),
                name: name,
                options: field.options ?? {},
                pk: record[this.pk],
                record: record,
                size: field.size ?? Enums.inputSizes.lg,
                type: field.type,
                value: value,
            };
        }

        return result;
    }

    prepareRelationalInputs(fields: Object, record: Object, namePrefix: string, relationKey: string) {
        let result = this.prepareInputs(fields, record);

        for (let key in result) {
            let name = result[key].name;

            name = name.replace('[', '][');
            name = name.replace(/]$/, '');

            result[key].name = namePrefix + '[' + relationKey + '][' + name + ']';
        }

        return result;
    }
}

export default Model;
