import { Model } from '@/core/model';
import * as Enums from '@/core/enums';

import inputHelper from '@/core/helpers/inputHelper';

export default new Model({
    form: {
        First: {
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
        Second: {
            ...{
                second_image: {
                    type: Enums.inputTypes.file,
                    options: {
                        file: {
                            previewPath: 'w_500',
                            downloadPath: 'original',
                            willOverride: true,
                        },
                    },
                    size: Enums.inputSizes.xl,
                },
                second_images_list: {
                    type: Enums.inputTypes.file,
                    options: {
                        isMultiple: true,
                        file: {
                            previewPath: 'w_500',
                            downloadPath: 'original',
                            willOverride: true,
                        },
                    },
                    size: Enums.inputSizes.xl,
                },
            },
            ...inputHelper.localizedTypedFile({
                key: 'second_image',
                type: Enums.inputTypes.file,
                options: {
                    file: {
                        previewPath: 'w_500',
                        downloadPath: 'original',
                        willOverride: true,
                    },
                },
                size: Enums.inputSizes.md,
            }),
        },
        'Relations 1': {
            relations_1: {
                type: Enums.inputTypes.relations,
                options: {
                    relations: {
                        text: {
                            type: Enums.inputTypes.text,
                            size: Enums.inputSizes.xl,
                        },
                        image: {
                            type: Enums.inputTypes.file,
                            options: {
                                file: {
                                    previewPath: 'w_500',
                                    downloadPath: 'original',
                                    willOverride: true,
                                },
                            },
                            size: Enums.inputSizes.xl,
                        },
                        images_list: {
                            type: Enums.inputTypes.file,
                            options: {
                                isMultiple: true,
                                file: {
                                    previewPath: 'w_500',
                                    downloadPath: 'original',
                                    willOverride: true,
                                },
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
                    relations: {
                        ...inputHelper.localizedTypedFile({
                            key: 'image',
                            type: Enums.inputTypes.file,
                            options: {
                                file: {
                                    previewPath: 'w_500',
                                    downloadPath: 'original',
                                    willOverride: true,
                                },
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
