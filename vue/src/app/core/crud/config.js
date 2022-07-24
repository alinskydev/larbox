export class IndexConfig {
    model;
    http;
    actions;
    extraActions;
    hasSoftDelete;

    constructor({
        model,
        http,
        actions,
        extraActions,
        hasSoftDelete,
    }) {
        this.model = model;
        this.http = http;
        this.actions = actions ?? ['show', 'update', 'delete', 'restore'];
        this.extraActions = extraActions ?? {};
        this.hasSoftDelete = hasSoftDelete ?? false;
    }
}

export class ShowConfig {
    model;
    http;
    titleField;

    constructor({
        model,
        http,
        titleField,
    }) {
        this.model = model;
        this.http = http;
        this.titleField = titleField;
    }
}

export class CreateConfig {
    model;
    http;
    method;
    redirectPath;

    beforeSubmit;
    afterSubmit;

    constructor({
        model,
        http,
        method,
        redirectPath,

        beforeSubmit,
        afterSubmit,
    }) {
        this.model = model;
        this.http = http;
        this.method = method ?? 'POST';
        this.redirectPath = redirectPath;

        this.beforeSubmit = beforeSubmit ?? function (context, formData) { };
        this.afterSubmit = afterSubmit ?? function (context, formData, responsey) {
            toastr.success(context.__('Запись успешно сохранена'));
        };
    }
}

export class UpdateConfig {
    model;
    http;
    method;
    titleField;
    redirectPath;

    beforeSubmit;
    afterSubmit;

    constructor({
        model,
        http,
        method,
        titleField,
        redirectPath,

        beforeSubmit,
        afterSubmit,
    }) {
        this.model = model;
        this.http = http;
        this.method = method ?? 'PUT';
        this.titleField = titleField;
        this.redirectPath = redirectPath;

        this.beforeSubmit = beforeSubmit ?? function (context, formData) { };
        this.afterSubmit = afterSubmit ?? function (context, formData, response) {
            toastr.success(context.__('Запись успешно сохранена'));
        };
    }
}