import App from '@/core/app';
import Model from '@/core/model';
import * as Enums from '@/core/enums';

import Custom from '@/modules/box/components/Custom.vue';

export default new Model({
    hasSoftDelete: true,

    config: {
        index: {
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
            Информация: {
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
            Компоненты: {
                built_in_component: {
                    label: null,
                    type: Enums.valueTypes.component,
                    options: {
                        component: {
                            resolve: (record) => {
                                return {
                                    component: 'h3',
                                    params: [
                                        {
                                            class: 'text-primary m-0',
                                            innerHTML: App.t('Встроенный компонент'),
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
                            resolve: (record) => {
                                return {
                                    component: Custom,
                                    params: [
                                        {
                                            text: App.t('Кастомный компонент'),
                                        },
                                    ],
                                };
                            },
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
                            resolve: (record) => {
                                return {
                                    component: 'h3',
                                    params: [
                                        {
                                            class: 'w-100 text-primary',
                                            innerHTML: App.t('Встроенный компонент'),
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
                            resolve: (record) => {
                                return {
                                    component: Custom,
                                    params: [
                                        {
                                            text: App.t('Кастомный компонент'),
                                        },
                                    ],
                                };
                            },
                        },
                    },
                },
            },
        },
    },
});
