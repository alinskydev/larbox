import { Model } from '@/core/model';
import * as Enums from '@/core/enums';

export default new Model({
    hasSeoMeta: true,

    index: {
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
                websiteLink: 'box/brand/:value',
            },
        },
        show_on_the_home_page: {
            type: Enums.valueTypes.boolean,
        },
        is_active: {
            type: Enums.valueTypes.httpSelect,
            options: {
                httpSelect: {
                    path: 'box/brand/:pk/set-active/:value',
                    isBoolean: true,
                    items: (context) => {
                        return {
                            0: context.__('Нет'),
                            1: context.__('Да'),
                        };
                    },
                },
            },
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

    filters: {
        id: {
            type: Enums.inputTypes.text,
            attributes: {
                type: 'number',
            },
        },
        creator_id: {
            type: Enums.inputTypes.select2Ajax,
            options: {
                select2Ajax: {
                    path: 'user/user',
                    query: {
                        'show[0]': 'with-deleted',
                    },
                    field: 'username',
                },
            },
        },
        name: {
            type: Enums.inputTypes.text,
        },
        show_on_the_home_page: {
            type: Enums.inputTypes.select,
            options: {
                select: {
                    items: (context) => {
                        return {
                            0: context.__('Нет'),
                            1: context.__('Да'),
                        };
                    },
                    hasPrompt: true,
                },
            },
        },
        is_active: {
            type: Enums.inputTypes.select,
            options: {
                select: {
                    items: (context) => {
                        return {
                            0: context.__('Нет'),
                            1: context.__('Да'),
                        };
                    },
                    hasPrompt: true,
                },
            },
        },
    },

    sortings: ['id', 'name'],

    show: {
        Информация: {
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
                    websiteLink: 'box/brand/:value',
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
    },

    form: {
        Информация: {
            name: {
                type: Enums.inputTypes.text,
            },
            show_on_the_home_page: {
                type: Enums.inputTypes.switcher,
            },
            file: {
                type: Enums.inputTypes.file,
                options: {
                    file: {
                        showDelete: true,
                    },
                },
                size: Enums.inputSizes.xl,
            },
            files_list: {
                type: Enums.inputTypes.file,
                options: {
                    isMultiple: true,
                    file: {
                        showDelete: true,
                        showDrag: true,
                    },
                },
                size: Enums.inputSizes.xl,
            },
        },
    },
});
