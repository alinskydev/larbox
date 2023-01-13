import App from '@/core/app';
import Model from '@/core/model';
import * as Enums from '@/core/enums';

import Tree from '@/modules/user/components/role/Tree.vue';

export default new Model({
    config: {
        index: {
            id: {
                type: Enums.valueTypes.text,
            },
            name: {
                value: 'name.:locale',
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
                    value: 'name.:locale',
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
                    options: {
                        isLocalized: true,
                    },
                    size: Enums.inputSizes.xl,
                },
            },
            Права: {
                routes: {
                    type: Enums.inputTypes.component,
                    options: {
                        component: {
                            resolve: (record) => {
                                return {
                                    component: Tree,
                                    params: [
                                        {
                                            prefix: 'admin',
                                            value: record.routes,
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
