import { Model } from '@/core/model';
import * as Enums from '@/core/enums';

export default new Model({
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
    },

    hasSeoMeta: true,
});
