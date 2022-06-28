export class Model {
    showDeleted;
    list;
    filters;
    sortings;
    show;
    form;

    constructor({
        showDeleted,
        list,
        filters,
        sortings,
        show,
        form,
    }) {
        this.showDeleted = showDeleted ?? false;
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
                value = field.value;

            if (typeof field.value === 'function') {
                value = value(context, item);
            } else {
                value = value.replace(':locale', context.booted.locale);
                value = context.booted.helpers.iterator.searchByPath(item, value);
            }

            result[key] = {
                label: field.label !== undefined ? context.__(field.label) : context.__('fields->' + key),
                value: value,
                type: field.type,
                options: field.options ?? {},
            };
        }

        return result;
    }
}