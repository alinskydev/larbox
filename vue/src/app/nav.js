export default [
    {
        label: 'home',
        path: '',
        icon: 'fas fa-tachometer-alt',
    },
    {
        label: 'user',
        path: 'user',
        icon: 'fas fa-users',
        children: [
            {
                label: 'user.user',
                path: 'user/user',
            },
            {
                label: 'user.role',
                path: 'user/role',
            },
        ],
    },
    {
        label: 'feedback',
        path: 'feedback',
        icon: 'fas fa-address-card',
        children: [
            {
                label: 'feedback.callback',
                path: 'feedback/callback',
            },
        ],
    },
    {
        label: 'box',
        path: 'box',
        icon: 'fas fa-boxes',
        children: [
            {
                label: 'box.box',
                path: 'box/box',
            },
            {
                label: 'box.brand',
                path: 'box/brand',
            },
            {
                label: 'box.category',
                path: 'box/category/tree',
            },
            {
                label: 'box.tag',
                path: 'box/tag',
            },
        ],
    },
    {
        label: 'section',
        path: 'section',
        icon: 'fas fa-th-large',
        children: [
            {
                label: 'section.home',
                path: 'section/home',
                name: 'section/show',
            },
            {
                label: 'section.contact',
                path: 'section/contact',
                name: 'section/show',
            },
            {
                label: 'section.boxes',
                path: 'section/boxes',
                name: 'section/show',
            },
            {
                label: 'section.layout',
                path: 'section/layout',
                name: 'section/show',
            },
        ],
    },
    {
        label: 'system',
        path: 'system',
        icon: 'fas fa-cogs',
        children: [
            {
                label: 'system.settings',
                path: 'system/settings',
            },
            {
                label: 'system.language',
                path: 'system/language',
            },
        ],
    },
];
