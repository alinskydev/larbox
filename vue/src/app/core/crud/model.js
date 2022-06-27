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
}