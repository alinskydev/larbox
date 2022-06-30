import { Model } from '@/app/core/crud/model';
import * as crudEnums from '@/app/core/crud/enums';

export default new Model({
    form: {
        username: {
            type: crudEnums.inputTypes.text,
            size: crudEnums.inputSizes.xl,
            attributes: {
                'autofocus': true,
            },
        },
        password: {
            type: crudEnums.inputTypes.text,
            size: crudEnums.inputSizes.xl,
            attributes: {
                'type': 'password',
            },
        },
    },
});