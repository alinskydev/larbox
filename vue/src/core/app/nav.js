export default [
    {
        label: 'home',
        icon: 'fas fa-tachometer-alt',
        path: '',
    },
    {
        label: 'user',
        icon: 'fas fa-users',
        path: 'user',
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
        label: 'box',
        icon: 'fas fa-boxes',
        path: 'box',
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
                label: 'box.tag',
                path: 'box/tag',
            },
        ],
    },
    {
        label: 'section',
        icon: 'fas fa-th-large',
        path: 'section',
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
        icon: 'fas fa-cogs',
        path: 'system',
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