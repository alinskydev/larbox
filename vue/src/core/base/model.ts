import * as Enums from './enums';
import * as Params from './model/params';

export class Model {
    list: Record<string, Params.value>;
    filters: Record<string, Params.input>;
    sortings: Array<string>;
    show: Record<string, any>;
    form: Record<string, any>;

    constructor(config: {
        list: Record<string, Params.value>;
        filters: Record<string, Params.input>;
        sortings: Array<string>;
        show: Record<
            string,
            Params.value & {
                options: {
                    relations: Record<string, Params.value>;
                };
            }
        >;
        form: Record<
            string,
            Record<
                string,
                Params.input & {
                    options: {
                        relations: Record<string, Params.input>;
                    };
                }
            >
        >;
        hasSeoMeta: boolean;
    }) {
        this.list = config.list ?? {};
        this.filters = config.filters ?? {};
        this.sortings = config.sortings ?? [];
        this.show = config.show ?? {};
        this.form = config.form ?? {};

        if (config.hasSeoMeta) {
            this.form['SEO meta'] = {
                head: {
                    label: 'fields->seo_meta.head',
                    name: 'seo_meta[head]',
                    value: 'seo_meta.head',
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

    prepareFields(context, list) {
        let result = {};

        for (let key in list) {
            let field = list[key],
                label = field.label !== undefined ? field.label : 'fields->' + key;

            result[key] = {
                label: typeof label === 'function' ? label(context) : context.__(label),
                options: field.options ?? {},
            };
        }

        return result;
    }

    prepareValues(context, list, item = {}) {
        let result = {};

        for (let key in list) {
            let field = list[key],
                label = field.label !== undefined ? field.label : 'fields->' + key,
                value = field.value ?? key;

            if (typeof value === 'function') {
                value = value(context, item);
            } else {
                value = value.replace(':locale', context.booted.locale);
                value = context.booted.helpers.iterator.get(item, value);
            }

            result[key] = {
                label: typeof label === 'function' ? label(context) : context.__(label),
                value: value,
                type: field.type,
                options: field.options ?? {},
                attributes: field.attributes ?? {},
            };
        }

        return result;
    }

    prepareFilters(context, list, item = {}) {
        let result = {};

        for (let key in list) {
            let field = list[key],
                label = field.label !== undefined ? field.label : 'fields->' + key,
                hint = field.hint !== undefined ? field.hint : null,
                name = field.name ?? key,
                value = field.value ?? key;

            name = name.replaceAll('[', '][');
            name = name.replace(new RegExp(']$'), '');
            name = 'filter[' + name + ']';

            if (typeof value === 'function') {
                value = value(context, item);
            } else {
                value = value.replace(':locale', context.booted.locale);
                value = context.booted.helpers.iterator.get(item, value, '->');
            }

            result[key] = {
                label: typeof label === 'function' ? label(context) : context.__(label),
                hint: typeof hint === 'function' ? hint(context) : context.__(hint),
                name: name,
                value: value,
                type: field.type,
                options: field.options ?? {},
                attributes: field.attributes ?? {},
                size: field.size ?? Enums.inputSizes.sm,
            };
        }

        return result;
    }

    prepareInputs(context, list, item = {}) {
        let result = {};

        for (let key in list) {
            let field = list[key],
                label = field.label !== undefined ? field.label : 'fields->' + key,
                hint = field.hint !== undefined ? field.hint : null,
                value = field.value ?? key,
                options = field.options ?? {},
                initValue = null;

            if (typeof value === 'function') {
                value = value(context, item);
            } else {
                value = context.booted.helpers.iterator.get(item, value);
            }

            if (options.initValue) {
                initValue = options.initValue.replace(':locale', context.booted.locale);
                initValue = context.booted.helpers.iterator.get(item, initValue);
            }

            result[key] = {
                label: typeof label === 'function' ? label(context) : context.__(label),
                hint: typeof hint === 'function' ? hint(context) : context.__(hint),
                name: field.name ?? key,
                value: value,
                type: field.type,
                options: {
                    ...options,
                    ...{ initValue: initValue },
                },
                attributes: field.attributes ?? {},
                size: field.size ?? Enums.inputSizes.lg,
            };
        }

        return result;
    }

    prepareRelationsInputs(context, list, item, namePrefix, relationKey) {
        let result = this.prepareInputs(context, list, item);

        for (let key in result) {
            let name = result[key].name;

            name = name.replace('[', '][');
            name = name.replace(new RegExp(']$'), '');

            result[key].name = namePrefix + '[' + relationKey + '][' + name + ']';
        }

        return result;
    }
}
