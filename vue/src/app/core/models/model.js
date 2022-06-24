export class CrudModel {
    list;
    filters;
    sortings;
    show;
    form;

    constructor({
        list,
        filters,
        sortings,
        show,
        form,
    }) {
        this.list = list ?? {};
        this.filters = filters ?? {};
        this.sortings = sortings ?? [];
        this.show = show ?? {};
        this.form = form ?? {};
    }
}