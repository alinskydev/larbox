import * as Enums from '../enums';

export type valueParams = {
    label: string | ((context: any) => any);
    value: string | ((context: any, item: Object) => any);
    type: Enums.valueTypes;
    options: {
        component: {
            resolve: (context: any, item: Object) => any;
        };
        fields: Array<string>;
        httpSelect: {
            path: string;
            items: Object | ((context: any) => any);
            isBoolean: boolean;
            onSuccess: (context: any, value: any) => any;
        };
        httpSwitcher: {
            path: string;
            onSuccess: (context: any, value: any) => any;
        };
        websiteLink: string;
    };
    attributes: Object | ((context: any, item: Object) => any);
};

export type inputParams = {
    label: string | ((context: any) => any);
    hint: string | ((context: any) => any);
    name: string;
    value: string | ((context: any, item: Object) => any);
    type: Enums.inputTypes;
    options: {
        isLocalized: boolean;
        size: Enums.inputSizes;
        isMultiple: boolean;
        component: {
            resolve: (context: any, item: Object) => any;
        };
        file: {
            previewPath: string;
            downloadPath: string;
            showDelete: boolean;
            showDrag: boolean;
            willOverride: boolean;
        };
        select: {
            items: Object | ((context: any) => any);
            hasPrompt: boolean;
        };
        select2Ajax: {
            path: string;
            query: Object | ((context: any, item: Object) => any);
            field: string;
            pk: string;
            initValue: string;
            hasPrompt: boolean;
        };
    };
    attributes: Object | ((context: any, item: Object) => any);
    size: Enums.inputSizes;
};
