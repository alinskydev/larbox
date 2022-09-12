import * as Enums from '../enums';

export type value = {
    label: string | ((context: any) => any);
    value: string | ((context: any, item: Object) => any);
    type: Enums.valueTypes;
    options: {
        component: {
            resolve: (context: any, item: Object) => any;
        };
        httpSelect: {
            path: string;
            items: Object | ((context: any) => any);
            onSuccess: (context: any, value: any) => any;
        };
        httpSwitcher: {
            path: string;
            onSuccess: (context: any, value: any) => any;
        };
        websiteLink: {
            path: string;
        };
    };
    attributes: Object;
};

export type input = {
    label: string | ((context: any) => any);
    hint: string | ((context: any) => any);
    name: string;
    value: string | ((context: any, item: Object) => any);
    type: Enums.inputTypes;
    options: {
        isLocalized: boolean;
        size: Enums.inputSizes;
        isMultiple: boolean;
        initValue: string;
        component: {
            resolve: (context: any, item: Object) => any;
        };
        file: {
            previewPath: string;
            downloadPath: string;
            deleteUrl: string;
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
            hasPrompt: boolean;
        };
    };
    attributes: Object;
    size: Enums.inputSizes;
};
