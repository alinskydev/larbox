import App from '@/core/app';

class Page {
    title: string;
    breadcrumbs: Array<{
        label: string;
        path?: string | null;
    }>;
    showBreadcrumbs: boolean;

    static init(params: Page) {
        let instance = new Page();

        instance.title = params.title;
        instance.breadcrumbs = params.breadcrumbs ?? [];
        instance.showBreadcrumbs = params.showBreadcrumbs ?? true;

        if (instance.title !== undefined) {
            document.title = instance.title;
            instance.breadcrumbs.push({ label: instance.title });
        }

        if (!instance.showBreadcrumbs) instance.breadcrumbs = [];

        App.components.layout?.refresh();
        App.page = instance;
    }

    goUp() {
        App.components.app.$router.push({
            path: '/' + App.locale + '/' + this.breadcrumbs[this.breadcrumbs.length - 2].path,
        });
    }
}

export default Page;
