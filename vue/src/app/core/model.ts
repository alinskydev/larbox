import * as Enums from '@/app/core/enums';

export class Model {
    list: Record<string, any>;
    filters: Record<string, any>;
    sortings: Array<string>;
    show: Record<string, any>;
    form: Record<string, any>;

    constructor(
        config: {
            list: Record<string, {
                label: any,
                value: any,
                type: Enums.valueTypes,
                options: Object,
                attributes: Object,
            }>,
            filters: Record<string, {
                label: any,
                value: any,
                type: Enums.inputTypes,
                options: Object,
                attributes: Object,
                size: Enums.inputSizes,
            }>,
            sortings: Array<string>,
            show: Record<string, {
                label: any,
                value: any,
                type: Enums.valueTypes,
                options: Object,
                attributes: Object,
            }>,
            form: Record<string, {
                label: any,
                value: any,
                type: Enums.inputTypes,
                options: Object,
                attributes: Object,
                size: Enums.inputSizes,
            }>,
        },
    ) {
        this.list = config.list ?? {};
        this.filters = config.filters ?? {};
        this.sortings = config.sortings ?? [];
        this.show = config.show ?? {};
        this.form = config.form ?? {};
    }

    prepareFields(context, list) {
        let result = {};

        for (let key in list) {
            let field = list[key];

            result[key] = {
                label: field.label !== undefined ? context.__(field.label) : context.__('fields->' + key),
                options: field.options ?? {},
            };
        }

        return result;
    }

    prepareValues(context, list, item = {}) {
        let result = {};

        for (let key in list) {
            let field = list[key],
                value = field.value ?? key;

            if (typeof value === 'function') {
                value = value(context, item);
            } else {
                value = value.replace(':locale', context.booted.locale);
                value = context.booted.helpers.iterator.get(item, value);
            }

            result[key] = {
                label: field.label !== undefined ? context.__(field.label) : context.__('fields->' + key),
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
                name = field.name ?? key,
                value = field.value ?? key;

            if (typeof value === 'function') {
                value = value(context, item);
            } else {
                value = item[value];
            }

            result[key] = {
                label: field.label !== undefined ? context.__(field.label) : context.__('fields->' + key),
                name: 'filter[' + name + ']',
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
                initValue = context.booted.helpers.iterator.get(item, options.initValue);
            }

            result[key] = {
                label: field.label !== undefined ? context.__(field.label) : context.__('fields->' + key),
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