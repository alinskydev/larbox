import { Model } from '../model';

export class IndexConfig {
    model: Model;
    http: {
        path: string;
        query: object;
    };
    filter: {
        hasSoftDelete: boolean;
    };
    grid: {
        hiddenFields: Array<string>;
        actions: Array<string>;
        customActions: Record<string, (item: object) => any>;
        rowAttributes: (context: any, item: object) => any;
    };
    selection: {
        actions: Array<string>;
    };

    constructor(config: IndexConfig) {
        this.model = config.model;

        this.http = config.http;
        this.http.query ??= {};

        this.filter = config.filter ?? {};
        this.filter.hasSoftDelete ??= false;

        this.grid = config.grid ?? {};
        this.grid.hiddenFields ??= [];
        this.grid.actions ??= ['show', 'update', 'delete'];
        this.grid.customActions ??= {};
        this.grid.rowAttributes ??= (context, item) => {};

        this.selection = config.selection ?? {};
        this.selection.actions ??= [];
    }
}

export class ShowConfig {
    model: Model;
    title: string;
    http: {
        path: string;
        query: object;
    };

    constructor(config: ShowConfig) {
        this.model = config.model;
        this.title = config.title;

        this.http = config.http;
        this.http.query ??= {};
    }
}

export class CreateConfig {
    model: Model;
    http: {
        method: string;
        path: string;
        query: object;
    };
    events: {
        beforeSubmit: (formData: FormData) => any;
        afterSubmit: (formData: FormData, response: Object) => any;
    };

    constructor(config: CreateConfig) {
        this.model = config.model;

        this.http = config.http;
        this.http.method ??= 'POST';
        this.http.query ??= {};

        this.events = config.events ?? {};
    }
}

export class UpdateConfig {
    model: Model;
    title: string;
    http: {
        method: string;
        path: string;
        query: object;
    };
    events: {
        beforeSubmit: (formData: FormData) => any;
        afterSubmit: (formData: FormData, response: Object) => any;
    };

    constructor(config: UpdateConfig) {
        this.model = config.model;
        this.title = config.title;

        this.http = config.http;
        this.http.method ??= 'PUT';
        this.http.query ??= {};

        this.events = config.events ?? {};
    }
}
