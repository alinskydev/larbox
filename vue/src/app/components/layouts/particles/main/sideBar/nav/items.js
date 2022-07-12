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
        path: 'section/page',
        children: [
            {
                label: 'Home',
                path: 'section/page/home',
            },
            {
                label: 'Contact',
                path: 'section/page/contact',
            },
            {
                label: 'Boxes',
                path: 'section/page/boxes',
            },
        ],
    },
    {
        label: 'Секции',
        icon: 'fas fa-th-large',
        path: 'section/section',
        children: [
            {
                label: 'Layout',
                path: 'section/section/layout',
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
