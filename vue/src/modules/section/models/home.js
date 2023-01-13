import App from '@/core/app';
import Model from '@/core/model';
import * as Enums from '@/core/enums';

export default new Model({
    hasSeoMeta: true,

    config: {
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
                second_image_desktop: {
                    type: Enums.inputTypes.file,
                    options: {
                        file: {
                            previewPath: 'widen_500.webp',
                            downloadPath: 'original.raw',
                            willOverride: true,
                        },
                    },
                    size: Enums.inputSizes.md,
                },
                second_image_tablet: {
                    type: Enums.inputTypes.file,
                    options: {
                        file: {
                            previewPath: 'widen_500.webp',
                            downloadPath: 'original.raw',
                            willOverride: true,
                        },
                    },
                    size: Enums.inputSizes.md,
                },
                second_image_mobile: {
                    type: Enums.inputTypes.file,
                    options: {
                        file: {
                            previewPath: 'widen_500.webp',
                            downloadPath: 'original.raw',
                            willOverride: true,
                        },
                    },
                    size: Enums.inputSizes.md,
                },
                second_images_list: {
                    type: Enums.inputTypes.file,
                    options: {
                        isMultiple: true,
                        file: {
                            previewPath: 'widen_500.webp',
                            downloadPath: 'original.raw',
                            willOverride: true,
                        },
                    },
                    size: Enums.inputSizes.xl,
                },
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
                                        previewPath: 'widen_500.webp',
                                        downloadPath: 'original.raw',
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
                            text_localized: {
                                type: Enums.inputTypes.text,
                                options: {
                                    isLocalized: true,
                                },
                                size: Enums.inputSizes.xl,
                            },
                            images_list: {
                                type: Enums.inputTypes.file,
                                options: {
                                    isMultiple: true,
                                    file: {
                                        previewPath: 'widen_500.webp',
                                        downloadPath: 'original.raw',
                                        willOverride: true,
                                    },
                                },
                                size: Enums.inputSizes.xl,
                            },
                        },
                    },
                },
            },
        },
    },
});
