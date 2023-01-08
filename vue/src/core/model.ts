import * as Enums from './enums';
import * as ModelTypes from './types/modelTypes';

export class Model {
    primaryKey: string;
    hasSeoMeta: boolean;
    hasUpdatedAtConflictCheck: boolean;

    index: Record<string, ModelTypes.valueParams>;
    filters: Record<string, ModelTypes.inputParams>;
    sortings: Array<string>;
    show: Record<string, any>;
    form: Record<string, any>;

    constructor(config: {
        primaryKey: string;
        hasSeoMeta: boolean;
        hasUpdatedAtConflictCheck: boolean;
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
    }) {
        this.primaryKey = config.primaryKey ?? 'id';
        this.hasSeoMeta = config.hasSeoMeta ?? false;
        this.hasUpdatedAtConflictCheck = config.hasUpdatedAtConflictCheck ?? true;

        this.index = config.index ?? {};
        this.filters = config.filters ?? {};
        this.sortings = config.sortings ?? [];
        this.show = config.show ?? {};
        this.form = config.form ?? {};

        if (this.hasSeoMeta) {
            this.form['SEO meta'] = {
                seo_meta: {
                    value: (context, item) => {
                        let value = item.seo_meta,
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

    prepareFields(context, fields) {
        let result = {};

        for (let key in fields) {
            let field = fields[key],
                label = field.label !== undefined ? field.label : 'fields->' + key;

            result[key] = {
                label: typeof label === 'function' ? label(context) : context.__(label),
                options: field.options ?? {},
            };
        }

        return result;
    }

    prepareValues(context, fields, item = {}) {
        let result = {};

        for (let key in fields) {
            let field = fields[key],
                label = field.label !== undefined ? field.label : 'fields->' + key,
                value = field.value ?? key;

            if (typeof value === 'function') {
                value = value(context, item);
            } else {
                value = value.replace(':locale', context.booted.locale);
                value = context.booted.helpers.iterator.get(item, value);
            }

            result[key] = {
                attributes: field.attributes ?? {},
                label: typeof label === 'function' ? label(context) : context.__(label),
                options: field.options ?? {},
                pk: item[this.primaryKey],
                record: item,
                type: field.type,
                value: value,
            };
        }

        return result;
    }

    prepareFilters(context, fields, item = {}) {
        let result = {};

        for (let key in fields) {
            let field = fields[key],
                label = field.label !== undefined ? field.label : 'fields->' + key,
                hint = field.hint !== undefined ? field.hint : null,
                name = field.name ?? key,
                value = field.value ?? key;

            name = name.replaceAll('[', '][');
            name = name.replace(/]$/, '');
            name = 'filter[' + name + ']';

            if (typeof value === 'function') {
                value = value(context, item);
            } else {
                value = value.replace(':locale', context.booted.locale);
                value = context.booted.helpers.iterator.get(item, value, '->');
            }

            result[key] = {
                attributes: field.attributes ?? {},
                hint: typeof hint === 'function' ? hint(context) : context.__(hint),
                label: typeof label === 'function' ? label(context) : context.__(label),
                name: name,
                options: field.options ?? {},
                size: field.size ?? Enums.inputSizes.sm,
                type: field.type,
                value: value,
            };
        }

        return result;
    }

    prepareInputs(context, fields, item = {}) {
        let result = {};

        for (let key in fields) {
            let field = fields[key],
                label = field.label !== undefined ? field.label : 'fields->' + key,
                hint = field.hint !== undefined ? field.hint : null,
                value = field.value ?? key;

            if (typeof value === 'function') {
                value = value(context, item);
            } else {
                value = context.booted.helpers.iterator.get(item, value);
            }

            result[key] = {
                attributes: field.attributes ?? {},
                hint: typeof hint === 'function' ? hint(context) : context.__(hint),
                label: typeof label === 'function' ? label(context) : context.__(label),
                name: field.name ?? key,
                options: field.options ?? {},
                pk: item[this.primaryKey],
                record: item,
                size: field.size ?? Enums.inputSizes.lg,
                type: field.type,
                value: value,
            };
        }

        return result;
    }

    prepareRelationsInputs(context, fields, item, namePrefix, relationKey) {
        let result = this.prepareInputs(context, fields, item);

        for (let key in result) {
            let name = result[key].name;

            name = name.replace('[', '][');
            name = name.replace(/]$/, '');

            result[key].name = namePrefix + '[' + relationKey + '][' + name + ']';
        }

        return result;
    }
}
