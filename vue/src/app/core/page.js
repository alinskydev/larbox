export class Page {
    context;
    title;
    breadcrumbs;
    hideBreadcrumbs;

    constructor({
        context,
        title,
        breadcrumbs,
        hideBreadcrumbs,
    }) {
        this.context = context;
        this.title = title;
        this.breadcrumbs = breadcrumbs ?? [];
        this.hideBreadcrumbs = hideBreadcrumbs ?? false;

        this.context.booted.components.page = this.context;
    }

    init() {
        this.context.booted.components.languages.$forceUpdate();
        this.context.booted.components.nav.$forceUpdate();

        if (this.title !== undefined) {
            document.title = this.title;
            this.breadcrumbs.push({ label: this.title });
        }

        this.context.booted.components.breadcrumbs.items = this.hideBreadcrumbs ? [] : this.breadcrumbs;
    }
}