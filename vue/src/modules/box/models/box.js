import { CrudModel } from '@/app/core/models/model';

import * as crudEnums from '@/app/enums/crud';
import * as inputEnums from '@/app/enums/input';

export default new CrudModel({
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
            type: inputEnums.types.text,
        },
        name: {
            type: inputEnums.types.text,
        },
        date: {
            type: inputEnums.types.date,
        },
        datetime: {
            type: inputEnums.types.date,
        },
        brand_id: {
            type: inputEnums.types.select2Ajax,
            options: {
                path: 'box/brand',
                field: 'name',
            },
        },
        'tags.id': {
            type: inputEnums.types.select2Ajax,
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
                type: inputEnums.types.text,
                options: {
                    isLocalized: true,
                },
                wrapperSize: inputEnums.wrapperSizes.xl,
            },
            date: {
                type: inputEnums.types.date,
            },
            datetime: {
                type: inputEnums.types.datetime,
            },
            brand_id: {
                type: inputEnums.types.select2Ajax,
                select2Value: 'brand.name',
                options: {
                    path: 'box/brand',
                    field: 'name',
                },
            },
            tags: {
                value: (value) => Object.values(value).map((value) => value.id),
                select2Value: 'tags',
                type: inputEnums.types.select2Ajax,
                options: {
                    path: 'box/tag',
                    field: 'name',
                    isMultiple: true,
                    select2SubValue: 'name',
                },
            },
            image: {
                type: inputEnums.types.file,
                options: {
                    previewPath: 'w_500',
                    downloadPath: 'original',
                    deletePath: 'box/box/:id/delete-file/image',
                },
                wrapperSize: inputEnums.wrapperSizes.xl,
            },
            images_list: {
                type: inputEnums.types.file,
                options: {
                    previewPath: 'w_500',
                    downloadPath: 'original',
                    deletePath: 'box/box/:id/delete-file/images_list/:index',
                    isMultiple: true,
                },
                wrapperSize: inputEnums.wrapperSizes.xl,
            },
        },
        'Variations': {
            variations: {
                type: inputEnums.types.relations,
                options: {
                    fields: {
                        name: {
                            type: inputEnums.types.text,
                            options: {
                                isLocalized: true,
                            },
                            wrapperSize: inputEnums.wrapperSizes.xl,
                        },
                    },
                },
            },
        },
    },
});