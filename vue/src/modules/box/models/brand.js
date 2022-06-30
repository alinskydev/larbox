import { Model } from '@/app/core/crud/model';
import * as crudEnums from '@/app/core/crud/enums';

export default new Model({
    hasSoftDelete: true,

    list: {
        id: {
            type: crudEnums.valueTypes.text,
        },
        creator_id: {
            value: 'creator.username',
            type: crudEnums.valueTypes.text,
        },
        name: {
            type: crudEnums.valueTypes.text,
        },
        slug: {
            type: crudEnums.valueTypes.websiteLink,
            options: {
                path: 'brand/:value',
            },
        },
        show_on_the_home_page: {
            type: crudEnums.valueTypes.boolean,
        },
        is_active: {
            type: crudEnums.valueTypes.httpSwitcher,
            options: {
                path: 'box/brand/:id/set-active/:value',
            },
        },
        boxes_count: {
            type: crudEnums.valueTypes.text,
        },
        created_at: {
            type: crudEnums.valueTypes.text,
        },
        updated_at: {
            type: crudEnums.valueTypes.text,
        },
    },

    filters: {
        id: {
            type: crudEnums.inputTypes.text,
            attributes: {
                'type': 'number',
            },
        },
        creator_id: {
            type: crudEnums.inputTypes.select2Ajax,
            options: {
                path: 'user/user',
                field: 'username',
            },
        },
        name: {
            type: crudEnums.inputTypes.text,
        },
        slug: {
            type: crudEnums.valueTypes.text,
        },
        show_on_the_home_page: {
            type: crudEnums.inputTypes.select,
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
        is_active: {
            type: crudEnums.inputTypes.select,
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
            type: crudEnums.valueTypes.text,
        },
        creator_id: {
            value: 'creator.username',
            type: crudEnums.valueTypes.text,
        },
        name: {
            type: crudEnums.valueTypes.text,
        },
        slug: {
            type: crudEnums.valueTypes.websiteLink,
            options: {
                path: 'brand/:value',
            },
        },
        file: {
            type: crudEnums.valueTypes.file,
        },
        files_list: {
            type: crudEnums.valueTypes.file,
        },
        show_on_the_home_page: {
            type: crudEnums.valueTypes.boolean,
        },
        is_active: {
            type: crudEnums.valueTypes.boolean,
        },
        boxes_count: {
            type: crudEnums.valueTypes.text,
        },
        created_at: {
            type: crudEnums.valueTypes.text,
        },
        updated_at: {
            type: crudEnums.valueTypes.text,
        },
    },

    form: {
        'Информация': {
            name: {
                type: crudEnums.inputTypes.text,
            },
            show_on_the_home_page: {
                type: crudEnums.inputTypes.switcher,
            },
            // show_on_the_home_page: {
            //     type: crudEnums.inputTypes.select,
            //     options: {
            //         items: (context) => {
            //             return {
            //                 0: context.__('Нет'),
            //                 1: context.__('Да'),
            //             };
            //         },
            //         isBoolean: true,
            //     },
            // },
            file: {
                type: crudEnums.inputTypes.file,
                options: {
                    deleteUrl: 'box/brand/:id/delete-file/file',
                },
                size: crudEnums.inputSizes.xl,
            },
            files_list: {
                type: crudEnums.inputTypes.file,
                options: {
                    deleteUrl: 'box/brand/:id/delete-file/files_list/:index',
                    isMultiple: true,
                },
                size: crudEnums.inputSizes.xl,
            },
        },
    },
});