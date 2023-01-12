import Larbox from '@/core/larbox';

export class Page {
    context: any;
    breadcrumbs: Array<{
        label: string;
        path?: string | null;
    }>;
    showBreadcrumbs: boolean;

    constructor(params: Page) {
        this.context = params.context;
        this.breadcrumbs = params.breadcrumbs ?? [];
        this.showBreadcrumbs = params.showBreadcrumbs ?? true;

        this.context.booted.page = this;

        this.init();

        console.log(this.context.booted);
    }

    private init() {
        let title = this.context.title;

        if (title !== undefined) {
            document.title = title;
            this.breadcrumbs.push({ label: title });
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
