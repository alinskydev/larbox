import * as Enums from '@/core/enums';

export type ValueParams = {
    label?: string;
    value: string | ((record: Object) => any);
    type: Enums.valueTypes;
    options: {
        component: {
            resolve: (record: Object) => any;
        };
        fields: Array<string>;
        httpSelect: {
            path: string;
            items: Object;
            onSuccess: (value: any) => any;
        };
        httpSwitcher: {
            path: string;
            onSuccess: (value: any) => any;
        };
        websiteLink: string;
    };
    attributes: Object | ((record: Object) => any);
    isHidden: (record: Object) => any;
};

export type InputParams = {
    label?: string;
    hint?: string;
    name: string;
    value: string | ((record: Object) => any);
    type: Enums.inputTypes;
    options: {
        isLocalized: boolean;
        size: Enums.inputSizes;
        isMultiple: boolean;
        component: {
            resolve: (record: Object) => any;
        };
        file: {
            previewPath: string;
            downloadPath: string;
            showDelete: boolean;
            showDrag: boolean;
            willOverride: boolean;
        };
        select: {
            items: Object;
            hasPrompt: boolean;
        };
        select2Ajax: {
            path: string;
            query: Object | ((item: Object) => any);
            field: string;
            pk: string;
            initValue: string;
        };
    };
    attributes: Object | ((record: Object) => any);
    size: Enums.inputSizes;
    isHidden: (record: Object) => any;
};
