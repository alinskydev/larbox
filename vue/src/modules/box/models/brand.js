import { Model } from '@/app/core/model';
import * as Enums from '@/app/core/enums';

export default new Model({
    list: {
        id: {
            type: Enums.valueTypes.text,
        },
        creator_id: {
            value: 'creator.username',
            type: Enums.valueTypes.text,
        },
        name: {
            type: Enums.valueTypes.text,
        },
        slug: {
            type: Enums.valueTypes.websiteLink,
            options: {
                path: 'box/brand/:value',
            },
        },
        show_on_the_home_page: {
            type: Enums.valueTypes.boolean,
        },
        is_active: {
            type: Enums.valueTypes.httpSwitcher,
            options: {
                path: 'box/brand/:id/set-active/:value',
            },
        },
        // is_active: {
        //     type: Enums.valueTypes.httpSelect,
        //     options: {
        //         path: 'box/brand/:id/set-active/:value',
        //         items: (context) => {
        //             return {
        //                 0: context.__('Нет'),
        //                 1: context.__('Да'),
        //             };
        //         },
        //         isBoolean: true,
        //     },
        // },
        boxes_count: {
            type: Enums.valueTypes.text,
        },
        created_at: {
            type: Enums.valueTypes.text,
        },
        updated_at: {
            type: Enums.valueTypes.text,
        },
    },

    filters: {
        id: {
            type: Enums.inputTypes.text,
            attributes: {
                'type': 'number',
            },
        },
        creator_id: {
            type: Enums.inputTypes.select2Ajax,
            options: {
                path: 'user/user',
                query: {
                    'show[0]': 'with-deleted',
                },
                field: 'username',
            },
        },
        name: {
            type: Enums.inputTypes.text,
        },
        show_on_the_home_page: {
            type: Enums.inputTypes.select,
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
            type: Enums.inputTypes.select,
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
            type: Enums.valueTypes.text,
        },
        creator_id: {
            value: 'creator.username',
            type: Enums.valueTypes.text,
        },
        name: {
            type: Enums.valueTypes.text,
        },
        slug: {
            type: Enums.valueTypes.websiteLink,
            options: {
                path: 'box/brand/:value',
            },
        },
        file: {
            type: Enums.valueTypes.link,
        },
        files_list: {
            type: Enums.valueTypes.link,
        },
        show_on_the_home_page: {
            type: Enums.valueTypes.boolean,
        },
        is_active: {
            type: Enums.valueTypes.boolean,
        },
        boxes_count: {
            type: Enums.valueTypes.text,
        },
        created_at: {
            type: Enums.valueTypes.text,
        },
        updated_at: {
            type: Enums.valueTypes.text,
        },
    },

    form: {
        'Информация': {
            name: {
                type: Enums.inputTypes.text,
            },
            show_on_the_home_page: {
                type: Enums.inputTypes.switcher,
            },
            // show_on_the_home_page: {
            //     type: Enums.inputTypes.select,
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
                type: Enums.inputTypes.file,
                options: {
                    deleteUrl: 'box/brand/:id/delete-file/file',
                },
                size: Enums.inputSizes.xl,
            },
            files_list: {
                type: Enums.inputTypes.file,
                options: {
                    deleteUrl: 'box/brand/:id/delete-file/files_list/:index',
                    isMultiple: true,
                },
                size: Enums.inputSizes.xl,
            },
        },
    },

    hasSeoMeta: true,
});