import { Model } from '@/core/model';
import * as Enums from '@/core/enums';

import Custom from '@/modules/box/components/Custom.vue';

export default new Model({
    list: {
        id: {
            type: Enums.valueTypes.text,
        },
        name: {
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
        name: {
            type: Enums.inputTypes.text,
        },
    },

    sortings: ['id', 'name'],

    show: {
        id: {
            type: Enums.valueTypes.text,
        },
        name: {
            type: Enums.valueTypes.text,
        },
        created_at: {
            type: Enums.valueTypes.text,
        },
        updated_at: {
            type: Enums.valueTypes.text,
        },
        built_in_component: {
            label: null,
            type: Enums.valueTypes.component,
            options: {
                component: {
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
        },
        custom_component: {
            label: null,
            type: Enums.valueTypes.component,
            options: {
                component: {
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

    form: {
        Информация: {
            name: {
                type: Enums.inputTypes.text,
            },
        },
        Компоненты: {
            built_in_component: {
                label: null,
                type: Enums.inputTypes.component,
                options: {
                    component: {
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
            },
            custom_component: {
                type: Enums.inputTypes.component,
                options: {
                    component: {
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
    },
});
