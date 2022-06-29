import { Model } from '@/app/core/crud/model';
import * as crudEnums from '@/app/core/crud/enums';

export default new Model({
    form: {
        'Информация': {
            project_name: {
                type: crudEnums.inputTypes.text,
            },
            admin_email: {
                type: crudEnums.inputTypes.text,
            },
            logo: {
                type: crudEnums.inputTypes.file,
            },
            favicon: {
                type: crudEnums.inputTypes.file,
            },
            delete_old_files: {
                type: crudEnums.inputTypes.switcher,
            },
        },
    },
});