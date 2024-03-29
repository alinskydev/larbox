import App from '@/core/app';
import Model from '@/core/model';
import * as Enums from '@/core/enums';

export default new Model({
    hasSoftDelete: true,
    hasSeoMeta: true,

    config: {
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
                        items: {
                            0: App.t('Нет'),
                            1: App.t('Да'),
                        },
                    },
                },
            },
            boxes_count: {
                type: Enums.valueTypes.text,
            },
            created_at: {
                type: Enums.valueTypes.datetime,
            },
            updated_at: {
                type: Enums.valueTypes.datetime,
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
                        items: {
                            0: App.t('Нет'),
                            1: App.t('Да'),
                        },
                        hasPrompt: true,
                    },
                },
            },
            is_active: {
                type: Enums.inputTypes.select,
                options: {
                    select: {
                        items: {
                            0: App.t('Нет'),
                            1: App.t('Да'),
                        },
                        hasPrompt: true,
                    },
                },
            },
        },

        sortings: ['id', 'name'],

        show: {
            'Информация': {
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
                    type: Enums.valueTypes.datetime,
                },
                updated_at: {
                    type: Enums.valueTypes.datetime,
                },
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
    },
});
