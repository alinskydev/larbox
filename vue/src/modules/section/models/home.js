import { Model } from '@/app/core/model';
import * as Enums from '@/app/core/enums';

export default new Model({
    form: {
        'Welcome': {
            welcome_title: {
                type: Enums.inputTypes.text,
                options: {
                    isLocalized: true,
                },
                size: Enums.inputSizes.xl,
            },
            welcome_slogan: {
                type: Enums.inputTypes.text,
                size: Enums.inputSizes.xl,
            },
            welcome_description: {
                type: Enums.inputTypes.textarea,
                options: {
                    isLocalized: true,
                    size: Enums.inputSizes.xl,
                },
                size: Enums.inputSizes.xl,
            },
            welcome_image: {
                type: Enums.inputTypes.file,
                options: {
                    preview: 'w_500',
                    download: 'original',
                    override: true,
                },
                size: Enums.inputSizes.xl,
            },
            welcome_images_list: {
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
        'Slider': {
            slider: {
                type: Enums.inputTypes.relations,
                options: {
                    fields: {
                        title: {
                            type: Enums.inputTypes.text,
                            options: {
                                isLocalized: true,
                            },
                            size: Enums.inputSizes.xl,
                        },
                        subtitle: {
                            type: Enums.inputTypes.text,
                            options: {
                                isLocalized: true,
                            },
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
                    },
                },
            },
        },
        'Portfolio': {
            portfolio: {
                type: Enums.inputTypes.relations,
                options: {
                    fields: {
                        name: {
                            type: Enums.inputTypes.text,
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
                        description: {
                            type: Enums.inputTypes.textEditor,
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