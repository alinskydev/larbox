import { Model } from '@/app/core/crud/model';
import * as crudEnums from '@/app/core/crud/enums';

import Custom from '@/modules/box/components/Custom.vue';

export default new Model({
    hasSoftDelete: true,

    list: {
        id: {
            type: crudEnums.valueTypes.text,
        },
        name: {
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
        name: {
            type: crudEnums.inputTypes.text,
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
        name: {
            type: crudEnums.valueTypes.text,
        },
        created_at: {
            type: crudEnums.valueTypes.text,
        },
        updated_at: {
            type: crudEnums.valueTypes.text,
        },
        built_in_component: {
            label: null,
            type: crudEnums.valueTypes.component,
            options: {
                resolve: (context, item) => {
                    return {
                        component: 'h3',
                        params: [
                            {
                                class: 'text-primary m-0',
                                innerHTML: context.__('Встроенный компонент'),
                            },
                        ],
                    };
                },
            },
        },
        custom_component: {
            label: null,
            type: crudEnums.valueTypes.component,
            options: {
                resolve: (context, item) => {
                    return {
                        component: Custom,
                        params: [
                            {
                                text: context.__('Кастомный компонент'),
                            },
                        ],
                    };
                },
            },
        },
    },

    form: {
        'Информация': {
            name: {
                type: crudEnums.inputTypes.text,
            },
        },
        'Компоненты': {
            built_in_component: {
                label: null,
                type: crudEnums.inputTypes.component,
                options: {
                    resolve: (context, item) => {
                        return {
                            component: 'h3',
                            params: [
                                {
                                    class: 'w-100 text-primary',
                                    innerHTML: context.__('Встроенный компонент'),
                                },
                            ],
                        };
                    },
                },
            },
            custom_component: {
                type: crudEnums.inputTypes.component,
                options: {
                    resolve: (context, item) => {
                        return {
                            component: Custom,
                            params: [
                                {
                                    text: context.__('Кастомный компонент'),
                                },
                            ],
                        };
                    },
                },
            },
        },
    },
});