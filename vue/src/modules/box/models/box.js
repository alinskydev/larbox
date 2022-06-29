import { Model } from '@/app/core/crud/model';
import * as crudEnums from '@/app/core/crud/enums';

export default new Model({
    showDeleted: true,

    list: {
        image: {
            label: null,
            value: 'image.w_100',
            type: crudEnums.valueTypes.image,
        },
        images_list: {
            label: null,
            value: 'images_list.0.w_100',
            type: crudEnums.valueTypes.image,
        },
        id: {
            value: 'id',
            type: crudEnums.valueTypes.text,
        },
        name: {
            value: 'name.:locale',
            type: crudEnums.valueTypes.text,
        },
        slug: {
            value: 'slug',
            type: crudEnums.valueTypes.text,
        },
        date: {
            value: 'date',
            type: crudEnums.valueTypes.text,
        },
        datetime: {
            value: 'datetime',
            type: crudEnums.valueTypes.text,
        },
        brand_id: {
            value: 'brand.name',
            type: crudEnums.valueTypes.text,
        },
        tags: {
            value: 'tags.*.name',
            type: crudEnums.valueTypes.array,
        },
        updated_at: {
            value: 'updated_at',
            type: crudEnums.valueTypes.text,
        },
    },

    filters: {
        id: {
            type: crudEnums.inputTypes.text,
            attributes: {
                'type': 'number',
            },
        },
        name: {
            type: crudEnums.inputTypes.text,
        },
        date: {
            type: crudEnums.inputTypes.date,
        },
        datetime: {
            type: crudEnums.inputTypes.date,
        },
        brand_id: {
            type: crudEnums.inputTypes.select2Ajax,
            options: {
                path: 'box/brand',
                field: 'name',
            },
        },
        tags: {
            name: 'tags.id',
            value: 'tags.id',
            type: crudEnums.inputTypes.select2Ajax,
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
            type: crudEnums.valueTypes.image,
        },
        images_list: {
            label: null,
            value: 'images_list.*.w_500',
            type: crudEnums.valueTypes.image,
        },
        id: {
            value: 'id',
            type: crudEnums.valueTypes.text,
        },
        name: {
            value: 'name.:locale',
            type: crudEnums.valueTypes.text,
        },
        slug: {
            value: 'slug',
            type: crudEnums.valueTypes.text,
        },
        date: {
            value: 'date',
            type: crudEnums.valueTypes.text,
        },
        datetime: {
            value: 'datetime',
            type: crudEnums.valueTypes.text,
        },
        brand_id: {
            value: 'brand.name',
            type: crudEnums.valueTypes.text,
        },
        tags: {
            value: 'tags.*.name',
            type: crudEnums.valueTypes.array,
        },
        variations: {
            value: 'variations',
            type: crudEnums.valueTypes.relations,
            options: {
                fields: {
                    name: {
                        value: 'name.:locale',
                        type: crudEnums.valueTypes.text,
                    },
                },
            },
        },
        created_at: {
            value: 'created_at',
            type: crudEnums.valueTypes.text,
        },
        updated_at: {
            value: 'updated_at',
            type: crudEnums.valueTypes.text,
        },
    },

    form: {
        'Информация': {
            name: {
                type: crudEnums.inputTypes.text,
                options: {
                    isLocalized: true,
                },
                size: crudEnums.inputSizes.xl,
            },
            date: {
                type: crudEnums.inputTypes.date,
            },
            datetime: {
                type: crudEnums.inputTypes.datetime,
            },
            brand_id: {
                type: crudEnums.inputTypes.select2Ajax,
                options: {
                    initValue: 'brand.name',
                    path: 'box/brand',
                    query: (context, $el) => {
                        return {
                            'filter[creator_id]': context.booted.user.id,
                        };
                    },
                    field: 'name',
                },
            },
            tags: {
                value: 'tags.*.id',
                type: crudEnums.inputTypes.select2Ajax,
                options: {
                    initValue: 'tags.*.name',
                    path: 'box/tag',
                    field: 'name',
                    isMultiple: true,
                },
            },
            image: {
                type: crudEnums.inputTypes.file,
                options: {
                    previewPath: 'w_500',
                    downloadPath: 'original',
                    deletePath: 'box/box/:id/delete-file/image',
                },
                size: crudEnums.inputSizes.xl,
            },
            images_list: {
                type: crudEnums.inputTypes.file,
                options: {
                    previewPath: 'w_500',
                    downloadPath: 'original',
                    deletePath: 'box/box/:id/delete-file/images_list/:index',
                    isMultiple: true,
                },
                size: crudEnums.inputSizes.xl,
            },
        },
        'Variations': {
            variations: {
                type: crudEnums.inputTypes.relations,
                options: {
                    fields: {
                        name: {
                            type: crudEnums.inputTypes.text,
                            options: {
                                isLocalized: true,
                            },
                            size: crudEnums.inputSizes.xl,
                        },
                    },
                },
            },
        },
    },
});