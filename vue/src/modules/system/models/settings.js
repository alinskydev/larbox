import App from '@/core/app';
import Model from '@/core/model';
import * as Enums from '@/core/enums';

export default new Model({
    config: {
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
    },
});
