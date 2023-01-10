import * as Enums from './enums';
import * as ModelTypes from './types/modelTypes';

export class Model {
    pk: string;

    hasSoftDelete: boolean;
    hasSeoMeta: boolean;
    hasUpdatedAtConflictCheck: boolean;

    config: {
        index: Record<string, ModelTypes.valueParams>;
        filters: Record<string, ModelTypes.inputParams>;
        sortings: Array<string>;
        show: Record<string, any>;
        form: Record<string, any>;
    };

    data: Record<string, any>;

    constructor(params: {
        pk: string;

        hasSoftDelete: boolean;
        hasSeoMeta: boolean;
        hasUpdatedAtConflictCheck: boolean;

        config: {
            index: Record<string, ModelTypes.valueParams>;
            filters: Record<string, ModelTypes.inputParams>;
            sortings: Array<string>;
            show: Record<
                string,
                Record<
                    string,
                    ModelTypes.valueParams & {
                        options: {
                            relations: Record<string, ModelTypes.valueParams>;
                        };
                    }
                >
            >;
            form: Record<
                string,
                Record<
                    string,
                    ModelTypes.inputParams & {
                        options: {
                            relations: Record<string, ModelTypes.inputParams>;
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
                    value: (context, record) => {
                        let value = record.seo_meta,
                            result = [];

                        if (!value) return null;

                        for (let language in context.booted.languages.all) {
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

    fillData(context, record = {}) {
        this.data = {
            record: record,
            pk: record[this.pk],
            index: this.prepareValues(context, this.config.index, record),
            filters: this.prepareFilters(context, this.config.filters, record),
            show: {},
            form: {},
        };

        for (let key in this.config.show) {
            this.data.show[key] = this.prepareValues(context, this.config.show[key], record);
        }

        for (let key in this.config.form) {
            if (this.hasUpdatedAtConflictCheck) {
                this.config.form[key].updated_at = {
                    type: Enums.inputTypes.hidden,
                };
            }

            this.data.form[key] = this.prepareInputs(context, this.config.form[key], record);
        }

        return this;
    }

    private prepareValues(context, fields, record) {
        let result = {};

        for (let key in fields) {
            let field = fields[key],
                label = field.label !== undefined ? field.label : 'fields->' + key,
                value = field.value ?? key,
                attributes = field.attributes ?? {};

            if (typeof value === 'function') {
                value = value(context, record);
            } else {
                value = value.replace(':locale', context.booted.locale);
                value = context.booted.helpers.iterator.get(record, value);
            }

            if (field.type === Enums.valueTypes.relations) {
                value = value?.map((v) => this.prepareValues(context, field.options.relations, v));
            }

            result[key] = {
                attributes: typeof attributes === 'function' ? attributes(context, record) : attributes,
                label: typeof label === 'function' ? label(context) : context.__(label),
                options: field.options ?? {},
                pk: record[this.pk],
                record: record,
                type: field.type,
                value: value,
            };
        }

        return result;
    }

    private prepareFilters(context, fields, record) {
        let result = {};

        for (let key in fields) {
            let field = fields[key],
                label = field.label !== undefined ? field.label : 'fields->' + key,
                hint = field.hint !== undefined ? field.hint : null,
                name = field.name ?? key,
                value = field.value ?? key,
                attributes = field.attributes ?? {};

            name = name.replaceAll('[', '][');
            name = name.replace(/]$/, '');
            name = 'filter[' + name + ']';

            if (typeof value === 'function') {
                value = value(context, record);
            } else {
                value = value.replace(':locale', context.booted.locale);
                value = context.booted.helpers.iterator.get(record, value, '->');
            }

            result[key] = {
                attributes: typeof attributes === 'function' ? attributes(context, record) : attributes,
                hint: typeof hint === 'function' ? hint(context) : context.__(hint),
                label: typeof label === 'function' ? label(context) : context.__(label),
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

    private prepareInputs(context, fields, record) {
        let result = {};

        for (let key in fields) {
            let field = fields[key],
                label = field.label !== undefined ? field.label : 'fields->' + key,
                name = field.name ?? key,
                hint = field.hint !== undefined ? field.hint : null,
                value = field.value ?? key,
                attributes = field.attributes ?? {};

            if (typeof value === 'function') {
                value = value(context, record);
            } else {
                value = context.booted.helpers.iterator.get(record, value);
            }

            if (field.type === Enums.inputTypes.relations) {
                field.options.relations.id = {
                    type: Enums.inputTypes.hidden,
                };

                value = value?.map((v) => this.prepareRelationalInputs(context, field.options.relations, v, name, v.id));
            }

            result[key] = {
                attributes: typeof attributes === 'function' ? attributes(context, record) : attributes,
                hint: typeof hint === 'function' ? hint(context) : context.__(hint),
                label: typeof label === 'function' ? label(context) : context.__(label),
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

    prepareRelationalInputs(context, fields, record, namePrefix, relationKey) {
        let result = this.prepareInputs(context, fields, record);

        for (let key in result) {
            let name = result[key].name;

            name = name.replace('[', '][');
            name = name.replace(/]$/, '');

            result[key].name = namePrefix + '[' + relationKey + '][' + name + ']';
        }

        return result;
    }
}
