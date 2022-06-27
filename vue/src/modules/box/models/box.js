import { Model } from '@/app/core/crud/model';
import * as crudEnums from '@/app/core/crud/enums';

export default new Model({
    showDeleted: true,

    list: {
        image: {
            value: 'image.w_100',
            type: crudEnums.valueTypes.image,
            options: {
                hideLabel: true,
            },
        },
        images_list: {
            value: 'images_list.0.w_100',
            type: crudEnums.valueTypes.image,
            options: {
                hideLabel: true,
            },
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
            value: 'tags',
            type: crudEnums.valueTypes.array,
            options: {
                path: 'name',
            },
        },
        updated_at: {
            value: 'updated_at',
            type: crudEnums.valueTypes.text,
        },
    },

    filters: {
        id: {
            type: crudEnums.inputTypes.text,
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
        'tags.id': {
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
            value: 'image.w_500',
            type: crudEnums.valueTypes.image,
            options: {
                hideLabel: true,
            },
        },
        images_list: {
            value: 'images_list',
            type: crudEnums.valueTypes.image,
            options: {
                isMultiple: true,
                path: 'w_500',
                hideLabel: true,
            },
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
            value: 'tags',
            type: crudEnums.valueTypes.array,
            options: {
                path: 'name',
            },
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
                wrapperSize: crudEnums.wrapperSizes.xl,
            },
            date: {
                type: crudEnums.inputTypes.date,
            },
            datetime: {
                type: crudEnums.inputTypes.datetime,
            },
            brand_id: {
                type: crudEnums.inputTypes.select2Ajax,
                select2Value: 'brand.name',
                options: {
                    path: 'box/brand',
                    field: 'name',
                },
            },
            tags: {
                value: (value) => Object.values(value).map((value) => value.id),
                select2Value: 'tags',
                type: crudEnums.inputTypes.select2Ajax,
                options: {
                    path: 'box/tag',
                    field: 'name',
                    isMultiple: true,
                    select2SubValue: 'name',
                },
            },
            image: {
                type: crudEnums.inputTypes.file,
                options: {
                    previewPath: 'w_500',
                    downloadPath: 'original',
                    deletePath: 'box/box/:id/delete-file/image',
                },
                wrapperSize: crudEnums.wrapperSizes.xl,
            },
            images_list: {
                type: crudEnums.inputTypes.file,
                options: {
                    previewPath: 'w_500',
                    downloadPath: 'original',
                    deletePath: 'box/box/:id/delete-file/images_list/:index',
                    isMultiple: true,
                },
                wrapperSize: crudEnums.wrapperSizes.xl,
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
                            wrapperSize: crudEnums.wrapperSizes.xl,
                        },
                    },
                },
            },
        },
    },
});