import { CrudModel } from '@/app/core/models/model';

import * as crudEnums from '@/app/enums/crud';
import * as inputEnums from '@/app/enums/input';

export default new CrudModel({
    form: {
        'Информация': {
            project_name: {
                type: inputEnums.types.text,
            },
            admin_email: {
                type: inputEnums.types.text,
            },
            logo: {
                type: inputEnums.types.file,
                wrapperSize: inputEnums.wrapperSizes.lg,
            },
            favicon: {
                type: inputEnums.types.file,
                wrapperSize: inputEnums.wrapperSizes.lg,
            },
            delete_old_files: {
                type: inputEnums.types.switcher,
            },
        },
    },
});