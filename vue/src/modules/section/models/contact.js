import { Model } from '@/core/model';
import * as Enums from '@/core/enums';

export default new Model({
    form: {
        Social: {
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
        Branches: {
            branches: {
                type: Enums.inputTypes.relations,
                options: {
                    relations: {
                        name: {
                            type: Enums.inputTypes.text,
                        },
                        phones: {
                            type: Enums.inputTypes.select2Array,
                        },
                        description: {
                            type: Enums.inputTypes.textarea,
                            options: {
                                isLocalized: true,
                                size: Enums.inputSizes.xl,
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
