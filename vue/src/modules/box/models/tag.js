import { CrudModel } from '@/app/core/models/model';

import * as crudEnums from '@/app/enums/crud';
import * as inputEnums from '@/app/enums/input';

export default new CrudModel({
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
            type: inputEnums.types.text,
        },
        name: {
            type: inputEnums.types.text,
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
        },
    },
});