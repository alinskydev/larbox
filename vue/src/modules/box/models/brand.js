import { CrudModel } from '@/app/core/models/model';

import * as crudEnums from '@/app/enums/crud';
import * as inputEnums from '@/app/enums/input';

export default new CrudModel({
    list: {
        id: {
            value: 'id',
            type: crudEnums.valueTypes.text,
        },
        creator_id: {
            value: 'creator.username',
            type: crudEnums.valueTypes.text,
        },
        name: {
            value: 'name',
            type: crudEnums.valueTypes.text,
        },
        slug: {
            value: 'slug',
            type: crudEnums.valueTypes.text,
        },
        is_active: {
            value: 'is_active',
            type: crudEnums.valueTypes.httpSwitcher,
            options: {
                path: 'box/brand/:id/set-active/:value',
            },
        },
        boxes_count: {
            value: 'boxes_count',
            type: crudEnums.valueTypes.text,
        },
        created_at: {
            value: 'created_at',
            type: crudEnums.valueTypes.text,
        },
        updated_at: {
            value: 'updated_at',
            type: crudEnums.valueTypes.text,
        },
    },

    filters: {
        id: {
            type: inputEnums.types.text,
        },
        creator_id: {
            type: inputEnums.types.select2Ajax,
            options: {
                path: 'user/user',
                field: 'username',
            },
        },
        name: {
            type: inputEnums.types.text,
        },
        slug: {
            value: 'slug',
            type: crudEnums.valueTypes.text,
        },
        is_active: {
            type: inputEnums.types.select,
            options: {
                items: (context) => {
                    return {
                        0: context.__('Нет'),
                        1: context.__('Да'),
                    };
                },
                withPrompt: true,
            },
        },
    },

    sortings: [
        'id',
        'name',
    ],

    show: {
        id: {
            value: 'id',
            type: crudEnums.valueTypes.text,
        },
        creator_id: {
            value: 'creator.username',
            type: crudEnums.valueTypes.text,
        },
        name: {
            value: 'name',
            type: crudEnums.valueTypes.text,
        },
        slug: {
            value: 'slug',
            type: crudEnums.valueTypes.text,
        },
        file: {
            value: 'file',
            type: crudEnums.valueTypes.file,
        },
        files_list: {
            value: 'files_list',
            type: crudEnums.valueTypes.file,
            options: {
                isMultiple: true,
            },
        },
        is_active: {
            value: 'is_active',
            type: crudEnums.valueTypes.boolean,
        },
        boxes_count: {
            value: 'boxes_count',
            type: crudEnums.valueTypes.text,
        },
        created_at: {
            value: 'updated_at',
            type: crudEnums.valueTypes.text,
        },
        updated_at: {
            value: 'updated_at',
            type: crudEnums.valueTypes.text,
        },
    },

    form: {
        'Информация': {
            name: {
                type: inputEnums.types.text,
            },
            file: {
                type: inputEnums.types.file,
                options: {
                    deletePath: 'box/brand/:id/delete-file/file',
                },
                wrapperSize: inputEnums.wrapperSizes.xl,
            },
            files_list: {
                type: inputEnums.types.file,
                options: {
                    deletePath: 'box/brand/:id/delete-file/files_list/:index',
                    isMultiple: true,
                },
                wrapperSize: inputEnums.wrapperSizes.xl,
            },
        },
    },
});