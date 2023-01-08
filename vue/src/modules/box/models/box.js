import { Model } from '@/core/model';
import * as Enums from '@/core/enums';

import CategoriesTree from '@/modules/box/components/box/CategoriesTree.vue';

export default new Model({
    hasSeoMeta: true,

    index: {
        image: {
            label: null,
            value: 'image.widen_100.webp',
            type: Enums.valueTypes.image,
        },
        images_list: {
            label: null,
            value: 'images_list.0.widen_100.webp',
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
                websiteLink: 'box/box/:value',
            },
        },
        price: {
            type: Enums.valueTypes.price,
        },
        dates: {
            value: (context, item) => item,
            type: Enums.valueTypes.fields,
            options: {
                fields: ['date', 'datetime'],
            },
        },
        brand_id: {
            value: 'brand.name',
            type: Enums.valueTypes.html,
        },
        // categories: {
        //     value: (context, item) => {
        //         let result = item.categories.map((value, index) => {
        //             return '<div title="' + value.full_text + '">' + value.text + '</div>';
        //         });

        //         return result.join('');
        //     },
        //     type: Enums.valueTypes.html,
        // },
        categories: {
            value: 'categories.*.full_text',
            type: Enums.valueTypes.array,
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
        date_from: {
            name: 'date[0]',
            value: 'date->0',
            type: Enums.inputTypes.date,
        },
        date_to: {
            name: 'date[1]',
            value: 'date->1',
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
        categories: {
            name: 'categories.id',
            value: 'categories.id',
            hint: 'Поиск произвонится только по самому нижнему уровню',
            type: Enums.inputTypes.select2Ajax,
            options: {
                select2Ajax: {
                    path: 'box/category',
                    query: {
                        'show[0]': 'with-deleted',
                    },
                    field: 'full_text',
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
        Информация: {
            image: {
                value: 'image.widen_500.webp',
                type: Enums.valueTypes.image,
            },
            images_list: {
                value: 'images_list.*.widen_500.webp',
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
                    websiteLink: 'box/box/:value',
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
            categories: {
                value: 'categories.*.full_text',
                type: Enums.valueTypes.array,
            },
            tags: {
                value: 'tags.*.name',
                type: Enums.valueTypes.array,
            },
            description: {
                value: 'description.:locale',
                type: Enums.valueTypes.html,
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
    },

    form: {
        Categories: {
            categories: {
                label: null,
                type: Enums.inputTypes.component,
                options: {
                    component: {
                        resolve: (context, item) => {
                            return {
                                component: CategoriesTree,
                                params: [
                                    {
                                        value: item.value ? item.value.map((value) => value.id) : [],
                                        httpPath: 'box/category-tree',
                                    },
                                ],
                            };
                        },
                    },
                },
            },
        },
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
                    select2Ajax: {
                        path: 'box/brand',
                        query: (context, item) => {
                            return {
                                'filter[creator_id]': context.booted.user.id,
                                'filter[is_active]': 1,
                            };
                        },
                        field: 'name',
                        initValue: 'brand.name',
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
                    isMultiple: true,
                    select2Ajax: {
                        path: 'box/tag',
                        field: 'name',
                        initValue: 'tags.*.name',
                    },
                },
            },
            image: {
                type: Enums.inputTypes.file,
                options: {
                    file: {
                        previewPath: 'widen_500.webp',
                        downloadPath: 'original.raw',
                        showDelete: true,
                    },
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
                        showDelete: true,
                        showDrag: true,
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
        Variations: {
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
                        image: {
                            type: Enums.inputTypes.file,
                            options: {
                                file: {
                                    previewPath: 'widen_500.webp',
                                    downloadPath: 'original.raw',
                                    showDelete: true,
                                    showDrag: true,
                                },
                            },
                            size: Enums.inputSizes.xl,
                        },
                    },
                },
            },
        },
    },
});
