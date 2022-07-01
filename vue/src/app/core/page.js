export class Page {
    context;
    title;
    breadcrumbs;
    showBreadcrumbs;

    constructor({
        context,
        title,
        breadcrumbs,
        showBreadcrumbs,
    }) {
        this.context = context;
        this.title = title;
        this.breadcrumbs = breadcrumbs ?? [];
        this.showBreadcrumbs = showBreadcrumbs ?? true;

        this.context.booted.components.current = this.context;
    }

    init() {
        if (this.title !== undefined) {
            document.title = this.title;
            this.breadcrumbs.push({ label: this.title });
        }

        if (!this.showBreadcrumbs) this.breadcrumbs = [];

        if (this.context.booted.components.layout) {
            this.context.booted.components.layout.childKey++;
        }
    }
}