import { Model } from '@/app/core/model';
import * as Enums from '@/app/core/enums';

import inputHelper from '@/app/core/helpers/inputHelper';

export default new Model({
    form: {
        'First': {
            first_text_1: {
                type: Enums.inputTypes.text,
                size: Enums.inputSizes.xl,
            },
            first_text_1_localized: {
                type: Enums.inputTypes.text,
                options: {
                    isLocalized: true,
                },
                size: Enums.inputSizes.xl,
            },
            first_text_2: {
                type: Enums.inputTypes.textarea,
                size: Enums.inputSizes.xl,
            },
            first_text_2_localized: {
                type: Enums.inputTypes.textarea,
                options: {
                    isLocalized: true,
                },
                size: Enums.inputSizes.xl,
            },
            first_text_3: {
                type: Enums.inputTypes.textEditor,
                size: Enums.inputSizes.xl,
            },
            first_text_3_localized: {
                type: Enums.inputTypes.textEditor,
                options: {
                    isLocalized: true,
                    size: Enums.inputSizes.xl,
                },
                size: Enums.inputSizes.xl,
            },
        },
        'Second': {
            ...{
                second_image: {
                    type: Enums.inputTypes.file,
                    options: {
                        preview: 'w_500',
                        download: 'original',
                        override: true,
                    },
                    size: Enums.inputSizes.xl,
                },
                second_images_list: {
                    type: Enums.inputTypes.file,
                    options: {
                        preview: 'w_500',
                        download: 'original',
                        isMultiple: true,
                        override: true,
                    },
                    size: Enums.inputSizes.xl,
                },
            },
            ...inputHelper.localizedTypedFile({
                key: 'second_image',
                type: Enums.inputTypes.file,
                options: {
                    preview: 'w_500',
                    download: 'original',
                    override: true,
                },
                size: Enums.inputSizes.md,
            }),
        },
        'Relations 1': {
            relations_1: {
                type: Enums.inputTypes.relations,
                options: {
                    fields: {
                        text: {
                            type: Enums.inputTypes.text,
                            size: Enums.inputSizes.xl,
                        },
                        image: {
                            type: Enums.inputTypes.file,
                            options: {
                                preview: 'w_500',
                                download: 'original',
                                override: true,
                            },
                            size: Enums.inputSizes.xl,
                        },
                        images_list: {
                            type: Enums.inputTypes.file,
                            options: {
                                preview: 'w_500',
                                download: 'original',
                                isMultiple: true,
                                override: true,
                            },
                            size: Enums.inputSizes.xl,
                        },
                    },
                },
            },
        },
        'Relations 2': {
            relations_2: {
                type: Enums.inputTypes.relations,
                options: {
                    fields: {
                        ...inputHelper.localizedTypedFile({
                            key: 'image',
                            type: Enums.inputTypes.file,
                            options: {
                                preview: 'w_500',
                                download: 'original',
                                override: true,
                            },
                            size: Enums.inputSizes.md,
                        }),
                        ...{
                            text_localized: {
                                type: Enums.inputTypes.text,
                                options: {
                                    isLocalized: true,
                                },
                                size: Enums.inputSizes.xl,
                            },
                        },
                    },
                },
            },
        },
    },

    hasSeoMeta: true,
});