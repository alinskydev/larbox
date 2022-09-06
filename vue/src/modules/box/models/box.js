import { Model } from '@/core/model';
import * as Enums from '@/core/enums';

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
                path: 'box/box/:value',
            },
        },
        price: {
            type: Enums.valueTypes.price,
        },
        date: {
            label: 'fields->dates',
            value: (context, item) => {
                let result = [context.__('fields->date') + ' ' + item.date, context.__('fields->datetime') + ' ' + item.datetime];

                return result.join('<br>');
            },
            type: Enums.valueTypes.html,
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
                type: 'number',
            },
        },
        name: {
            type: Enums.inputTypes.text,
        },
        price_from: {
            name: 'price[0]',
            value: 'price->0',
            type: Enums.inputTypes.text,
            attributes: {
                type: 'number',
            },
        },
        price_to: {
            name: 'price[1]',
            value: 'price->1',
            type: Enums.inputTypes.text,
            attributes: {
                type: 'number',
            },
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
                select2Ajax: {
                    path: 'box/brand',
                    query: {
                        'show[0]': 'with-deleted',
                    },
                    field: 'name',
                },
            },
        },
        tags: {
            name: 'tags.id',
            value: 'tags.id',
            type: Enums.inputTypes.select2Ajax,
            options: {
                isMultiple: true,
                select2Ajax: {
                    path: 'box/tag',
                    query: {
                        'show[0]': 'with-deleted',
                    },
                    field: 'name',
                },
            },
        },
    },

    sortings: ['id', 'name', 'date', 'datetime'],

    show: {
        image: {
            value: 'image.w_500',
            type: Enums.valueTypes.image,
        },
        images_list: {
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
                path: 'box/box/:value',
            },
        },
        price: {
            type: Enums.valueTypes.price,
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
                relations: {
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
        Информация: {
            name: {
                type: Enums.inputTypes.text,
                options: {
                    isLocalized: true,
                },
                size: Enums.inputSizes.xl,
            },
            price: {
                type: Enums.inputTypes.text,
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
                    select2Ajax: {
                        path: 'box/brand',
                        query: (context, item) => {
                            return {
                                'filter[creator_id]': context.booted.user.id,
                                'filter[is_active]': 1,
                            };
                        },
                        field: 'name',
                    },
                },
                attributes: {
                    onchange: (event) => {
                        $('[name="tags[]"]').attr('disabled', event.target.value === '');
                    },
                },
            },
            tags: {
                value: 'tags.*.id',
                type: Enums.inputTypes.select2Ajax,
                options: {
                    initValue: 'tags.*.name',
                    isMultiple: true,
                    select2Ajax: {
                        path: 'box/tag',
                        field: 'name',
                    },
                },
            },
            image: {
                type: Enums.inputTypes.file,
                options: {
                    file: {
                        previewPath: 'w_500',
                        downloadPath: 'original',
                        deleteUrl: 'box/box/:id/delete-file/image',
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
                        deleteUrl: 'box/box/:id/delete-file/images_list/:index',
                    },
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
        Вариации: {
            variations: {
                type: Enums.inputTypes.relations,
                options: {
                    relations: {
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
