import { Model } from '@/app/core/model';
import * as Enums from '@/app/core/enums';

export default new Model({
    form: {
        'Header': {
            header_phone: {
                type: Enums.inputTypes.text,
                size: Enums.inputSizes.xl,
            },
        },
        'Footer': {
            footer_phone: {
                type: Enums.inputTypes.text,
                size: Enums.inputSizes.xl,
            },
            footer_copyright: {
                type: Enums.inputTypes.text,
                options: {
                    isLocalized: true,
                },
                size: Enums.inputSizes.xl,
            },
        },
    },
});