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
        label: 'Страницы',
        icon: 'fas fa-file-alt',
        path: 'page',
        children: [
            {
                label: 'Главная',
                path: 'page/home',
            },
            {
                label: 'Контакты',
                path: 'page/contact',
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
