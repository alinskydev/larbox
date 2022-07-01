export default [
    {
        label: 'Главная',
        icon: 'fas fa-tachometer-alt',
        path: '',
    },
    {
        label: 'Пользователи',
        icon: 'fas fa-users',
        path: 'user/user',
    },
    {
        label: 'Box',
        icon: 'fas fa-boxes',
        path: 'box',
        children: [
            {
                label: 'Boxes',
                path: 'box/box',
            },
            {
                label: 'Brands',
                path: 'box/brand',
            },
            {
                label: 'Tags',
                path: 'box/tag',
            },
        ],
    },
    {
        label: 'Система',
        icon: 'fas fa-cogs',
        path: 'system',
        children: [
            {
                label: 'Настройки',
                path: 'system/settings',
            },
            {
                label: 'Языки',
                path: 'system/language',
            },
        ],
    },
];
