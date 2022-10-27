import { Model } from '@/core/model';
import * as Enums from '@/core/enums';

export default new Model({
    show: {
        id: {
            type: Enums.valueTypes.text,
        },
        name: {
            value: 'name.:locale',
            type: Enums.valueTypes.text,
        },
        full_slug: {
            type: Enums.valueTypes.websiteLink,
            options: {
                websiteLink: 'box/category/:value',
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
    },

    hasSeoMeta: true,
});
