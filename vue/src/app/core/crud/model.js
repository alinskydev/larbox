import * as crudEnums from '@/app/core/crud/enums';

export class Model {
    hasSoftDelete;
    list;
    filters;
    sortings;
    show;
    form;

    constructor({
        hasSoftDelete,
        list,
        filters,
        sortings,
        show,
        form,
    }) {
        this.hasSoftDelete = hasSoftDelete ?? false;
        this.list = list ?? {};
        this.filters = filters ?? {};
        this.sortings = sortings ?? [];
        this.show = show ?? {};
        this.form = form ?? {};
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
                size: field.size ?? crudEnums.inputSizes.sm,
                attributes: field.attributes ?? {},
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
                size: field.size ?? crudEnums.inputSizes.lg,
                attributes: field.attributes ?? {},
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