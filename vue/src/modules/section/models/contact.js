import { Model } from '@/app/core/model';
import * as Enums from '@/app/core/enums';

export default new Model({
    form: {
        'Social': {
            socials_facebook: {
                type: Enums.inputTypes.text,
                size: Enums.inputSizes.md,
            },
            socials_instagram: {
                type: Enums.inputTypes.text,
                size: Enums.inputSizes.md,
            },
            socials_youtube: {
                type: Enums.inputTypes.text,
                size: Enums.inputSizes.md,
            },
        },
        'Branches': {
            branches: {
                type: Enums.inputTypes.relations,
                options: {
                    fields: {
                        name: {
                            type: Enums.inputTypes.text,
                        },
                        phone: {
                            type: Enums.inputTypes.text,
                        },
                        description: {
                            type: Enums.inputTypes.textarea,
                            options: {
                                isLocalized: true,
                                size: Enums.inputSizes.xl,
                            },
                            attributes: {
                                'rows': 10,
                            },
                            size: Enums.inputSizes.xl,
                        },
                    },
                },
            },
        },
    },

    hasSeoMeta: true,
});