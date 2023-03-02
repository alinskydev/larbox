import Model from '@/core/model';

export class IndexConfig {
    model: Model;
    http: {
        path: string;
        query: object;
    };
    grid: {
        actions?: Array<string> | ((record: Object) => any);
        customActions?: Record<string, (record: object) => any>;
        rowAttributes?: (record: object) => any;
    };
    selection: {
        actions?: Array<string>;
    };

    constructor(params: IndexConfig) {
        this.model = params.model;

        this.http = params.http;
        this.http.query ??= {};

        this.grid = params.grid ?? {};
        this.grid.actions ??= ['show', 'update', 'delete'];
        this.grid.customActions ??= {};
        this.grid.rowAttributes ??= (record) => {};

        this.selection = params.selection ?? {};
        this.selection.actions ??= [];
    }
}

export class ShowConfig {
    model: Model;
    http: {
        path: string;
        query: object;
    };
    events: {
        afterResponse?: (data: Object) => any;
    };

    constructor(params: ShowConfig) {
        this.model = params.model;

        this.http = params.http;
        this.http.query ??= {};

        this.events = params.events ?? {};
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
        beforeSubmit?: (formData: FormData) => any;
        afterSubmit?: (formData: FormData, response: Object) => any;
    };

    constructor(params: CreateConfig) {
        this.model = params.model;

        this.http = params.http;
        this.http.method ??= 'POST';
        this.http.query ??= {};

        this.events = params.events ?? {};
    }
}

export class UpdateConfig {
    model: Model;
    http: {
        method: string;
        path: string;
        query: object;
    };
    events: {
        afterResponse?: (data: Object) => any;
        beforeSubmit?: (formData: FormData) => any;
        afterSubmit?: (formData: FormData, response: Object) => any;
    };

    constructor(params: UpdateConfig) {
        this.model = params.model;

        this.http = params.http;
        this.http.method ??= 'PUT';
        this.http.query ??= {};

        this.events = params.events ?? {};
    }
}
