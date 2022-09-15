export class Page {
    context: any;
    title: string;
    breadcrumbs: Array<{
        label: string;
        path?: string | null;
    }>;
    showBreadcrumbs: boolean;

    constructor(config: {
        context: any;
        title: string;
        breadcrumbs: Array<{
            label: string;
            path?: string;
        }>;
        showBreadcrumbs: boolean;
    }) {
        this.context = config.context;
        this.title = config.title;
        this.breadcrumbs = config.breadcrumbs ?? [];
        this.showBreadcrumbs = config.showBreadcrumbs ?? true;

        this.context.booted.components.current = this.context;
    }

    init() {
        if (this.title !== undefined) {
            document.title = this.title;
            this.breadcrumbs.push({ label: this.title });
        }

        if (!this.showBreadcrumbs) this.breadcrumbs = [];

        if (this.context.booted.components.layout) {
            this.context.booted.components.layout.templateKey++;
        }
    }

    goUp() {
        this.context.$router.push({
            path: '/' + this.context.booted.locale + '/' + this.breadcrumbs[this.breadcrumbs.length - 2].path,
        });
    }
}
