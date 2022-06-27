import { Page } from '@/app/core/page';

export class IndexPage extends Page {
    model;
    http;
    actions;
    extraActions;

    constructor({
        context,
        title,
        breadcrumbs,
        hideBreadcrumbs,

        model,
        http,
        actions,
        extraActions,
    }) {
        super({
            context: context,
            title: title,
            breadcrumbs: breadcrumbs,
            hideBreadcrumbs: hideBreadcrumbs,
        });

        this.model = model;
        this.http = http;
        this.actions = actions ?? [];
        this.extraActions = extraActions ?? [];
    }
}

export class ShowPage extends Page {
    titleField;
    model;
    http;

    constructor({
        context,
        title,
        breadcrumbs,
        hideBreadcrumbs,

        titleField,
        model,
        http,
    }) {
        super({
            context: context,
            title: title,
            breadcrumbs: breadcrumbs,
            hideBreadcrumbs: hideBreadcrumbs,
        });

        this.titleField = titleField;
        this.model = model;
        this.http = http;
    }
}

export class CreatePage extends Page {
    model;
    http;
    redirectPath;

    beforeSubmit;
    afterSubmit;

    constructor({
        context,
        title,
        breadcrumbs,
        hideBreadcrumbs,

        model,
        http,
        redirectPath,

        beforeSubmit,
        afterSubmit,
    }) {
        super({
            context: context,
            title: title,
            breadcrumbs: breadcrumbs,
            hideBreadcrumbs: hideBreadcrumbs,
        });

        this.model = model;
        this.http = http;
        this.redirectPath = redirectPath;

        this.beforeSubmit = beforeSubmit ?? function (context, form) { };
        this.afterSubmit = afterSubmit ?? function (context, form, responseBody) {
            toastr.success(context.__('Запись успешно сохранена'));
        };
    }
}

export class UpdatePage extends Page {
    titleField;
    model;
    http;
    redirectPath;

    beforeSubmit;
    afterSubmit;

    constructor({
        context,
        title,
        breadcrumbs,
        hideBreadcrumbs,

        titleField,
        model,
        http,
        redirectPath,

        beforeSubmit,
        afterSubmit,
    }) {
        super({
            context: context,
            title: title,
            breadcrumbs: breadcrumbs,
            hideBreadcrumbs: hideBreadcrumbs,
        });

        this.titleField = titleField;
        this.model = model;
        this.http = http;
        this.redirectPath = redirectPath;

        this.beforeSubmit = beforeSubmit ?? function (context, form) { };
        this.afterSubmit = afterSubmit ?? function (context, form, responseBody) {
            toastr.success(context.__('Запись успешно сохранена'));
        };
    }
}