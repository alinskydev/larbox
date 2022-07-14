import { Model } from '@/app/core/model';
import * as Enums from '@/app/core/enums';

export default new Model({
    list: {
        image: {
            label: null,
            value: 'image.w_100',
            type: Enums.valueTypes.image,
        },
        images_list: {
            label: null,
            value: 'images_list.0.w_100',
            type: Enums.valueTypes.image,
        },
        id: {
            type: Enums.valueTypes.text,
        },
        name: {
            value: 'name.:locale',
            type: Enums.valueTypes.text,
        },
        slug: {
            type: Enums.valueTypes.websiteLink,
            options: {
                path: 'box/:value',
            },
        },
        date: {
            type: Enums.valueTypes.text,
        },
        datetime: {
            type: Enums.valueTypes.text,
        },
        brand_id: {
            value: 'brand.name',
            type: Enums.valueTypes.text,
        },
        tags: {
            value: 'tags.*.name',
            type: Enums.valueTypes.array,
        },
        updated_at: {
            type: Enums.valueTypes.text,
        },
    },

    filters: {
        id: {
            type: Enums.inputTypes.text,
            attributes: {
                'type': 'number',
            },
        },
        name: {
            type: Enums.inputTypes.text,
        },
        slug: {
            type: Enums.inputTypes.text,
        },
        date: {
            type: Enums.inputTypes.date,
        },
        datetime: {
            type: Enums.inputTypes.date,
        },
        brand_id: {
            type: Enums.inputTypes.select2Ajax,
            options: {
                path: 'box/brand',
                field: 'name',
            },
        },
        tags: {
            name: 'tags.id',
            value: 'tags.id',
            type: Enums.inputTypes.select2Ajax,
            options: {
                path: 'box/tag',
                field: 'name',
                isMultiple: true,
            },
        },
    },

    sortings: [
        'id',
        'name',
        'date',
        'datetime',
    ],

    show: {
        image: {
            label: null,
            value: 'image.w_500',
            type: Enums.valueTypes.image,
        },
        images_list: {
            label: null,
            value: 'images_list.*.w_500',
            type: Enums.valueTypes.image,
        },
        id: {
            type: Enums.valueTypes.text,
        },
        name: {
            value: 'name.:locale',
            type: Enums.valueTypes.text,
        },
        slug: {
            type: Enums.valueTypes.websiteLink,
            options: {
                path: 'box/:value',
            },
        },
        date: {
            type: Enums.valueTypes.text,
        },
        datetime: {
            type: Enums.valueTypes.text,
        },
        brand_id: {
            value: 'brand.name',
            type: Enums.valueTypes.text,
        },
        tags: {
            value: 'tags.*.name',
            type: Enums.valueTypes.array,
        },
        variations: {
            type: Enums.valueTypes.relations,
            options: {
                fields: {
                    name: {
                        value: 'name.:locale',
                        type: Enums.valueTypes.text,
                    },
                },
            },
        },
        created_at: {
            type: Enums.valueTypes.text,
        },
        updated_at: {
            type: Enums.valueTypes.text,
        },
    },

    form: {
        'Информация': {
            name: {
                type: Enums.inputTypes.text,
                options: {
                    isLocalized: true,
                },
                size: Enums.inputSizes.xl,
            },
            date: {
                type: Enums.inputTypes.date,
            },
            datetime: {
                type: Enums.inputTypes.datetime,
            },
            brand_id: {
                type: Enums.inputTypes.select2Ajax,
                options: {
                    initValue: 'brand.name',
                    path: 'box/brand',
                    query: (context, item) => {
                        return {
                            'filter[creator_id]': context.booted.user.id,
                            'filter[is_active]': 1,
                        };
                    },
                    field: 'name',
                },
                attributes: {
                    'onchange': (event) => {
                        $('[name="tags[]"]').attr('disabled', event.target.value === '');
                    },
                },
            },
            tags: {
                value: 'tags.*.id',
                type: Enums.inputTypes.select2Ajax,
                options: {
                    initValue: 'tags.*.name',
                    path: 'box/tag',
                    field: 'name',
                    isMultiple: true,
                },
            },
            image: {
                type: Enums.inputTypes.file,
                options: {
                    preview: 'w_500',
                    download: 'original',
                    deleteUrl: 'box/box/:id/delete-file/image',
                },
                size: Enums.inputSizes.xl,
            },
            images_list: {
                type: Enums.inputTypes.file,
                options: {
                    preview: 'w_500',
                    download: 'original',
                    deleteUrl: 'box/box/:id/delete-file/images_list/:index',
                    isMultiple: true,
                },
                size: Enums.inputSizes.xl,
            },
        },
        'fields->description': {
            description: {
                type: Enums.inputTypes.textEditor,
                options: {
                    isLocalized: true,
                    size: Enums.inputSizes.xl,
                },
                size: Enums.inputSizes.xl,
            },
        },
        'Вариации': {
            variations: {
                type: Enums.inputTypes.relations,
                options: {
                    fields: {
                        name: {
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

    hasSeoMeta: true,
});