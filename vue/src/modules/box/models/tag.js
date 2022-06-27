import { Model } from '@/app/core/crud/model';
import * as crudEnums from '@/app/core/crud/enums';

export default new Model({
    showDeleted: true,

    list: {
        id: {
            value: 'id',
            type: crudEnums.valueTypes.text,
        },
        name: {
            value: 'name',
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
            type: crudEnums.inputTypes.text,
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
            value: 'id',
            type: crudEnums.valueTypes.text,
        },
        name: {
            value: 'name',
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

    form: {
        'Информация': {
            name: {
                type: crudEnums.inputTypes.text,
            },
        },
    },
});