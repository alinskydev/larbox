import { Model } from '@/core/base/model';
import * as Enums from '@/core/base/enums';

export default new Model({
    form: {
        Информация: {
            project_name: {
                type: Enums.inputTypes.text,
            },
            admin_email: {
                type: Enums.inputTypes.text,
            },
            logo: {
                type: Enums.inputTypes.file,
            },
            favicon: {
                type: Enums.inputTypes.file,
            },
            delete_old_files: {
                type: Enums.inputTypes.switcher,
            },
        },
    },
});
