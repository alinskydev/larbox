<script setup>
import App from '@/core/app';
import allItems from '@/app/nav';

import RouterLink from '@/components/blocks/RouterLink.vue';
</script>

<script>
export default {
    data() {
        return {
            items: [],
            activeItems: [],
        };
    },
    created() {
        // All items

        for (let itemsKey in allItems) {
            let item = allItems[itemsKey];

            if (item.children) {
                for (let itemChildKey in item.children) {
                    let itemChild = item.children[itemChildKey];

                    if (App.helpers.user.checkRoute(itemChild.name ?? itemChild.path)) {
                        this.items[itemsKey] ??= {
                            label: item.label,
                            icon: item.icon,
                            path: item.path,
                        };

                        this.items[itemsKey].children ??= [];
                        this.items[itemsKey].children[itemChildKey] = itemChild;
                        this.items[itemsKey].children = Object.values(this.items[itemsKey].children);
                    }
                }
            } else {
                if (App.helpers.user.checkRoute(item.name ?? item.path)) {
                    this.items[itemsKey] = item;
                }
            }
        }

        this.items = Object.values(this.items);

        // Active items

        let matched = [...this.$route.matched];

        matched.shift();

        this.activeItems = matched.map((value) => {
            let result = value.path.replace(':locale', '').replace('//', '/').replace('/', '');
            return [result, result + '/index'];
        });

        this.activeItems = this.activeItems.flat();
    },
    mounted() {},
};
</script>

<template>
    <div class="container-fluid">
        <div class="topnav">
            <nav class="navbar navbar-light navbar-expand-lg topnav-menu">
                <div class="collapse navbar-collapse" id="topnav-menu-content">
                    <ul class="navbar-nav">
                        <template v-for="(item, key) in items" class="nav-item">
                            <li v-if="item.children" class="nav-item dropdown">
                                <a
                                    href="#"
                                    :id="'topnav-' + key"
                                    role="button"
                                    data-bs-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                    :class="
                                        'nav-link dropdown-toggle arrow-none ' + (activeItems.includes(item.path) ? 'active' : '')
                                    "
                                >
                                    <i :class="item.icon"></i>
                                    {{ App.t('routes->' + item.label) }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-left" :aria-labelledby="'topnav-' + key">
                                    <RouterLink
                                        v-for="itemChild in item.children"
                                        :to="itemChild.path"
                                        :class="'dropdown-item ' + (activeItems.includes(itemChild.path) ? 'active' : '')"
                                    >
                                        {{ App.t('routes->' + itemChild.label) }}
                                    </RouterLink>
                                </div>
                            </li>

                            <li v-else class="nav-item">
                                <RouterLink
                                    :to="item.path"
                                    :class="'nav-link ' + (activeItems.includes(item.path) ? 'active' : '')"
                                >
                                    <i :class="item.icon"></i>
                                    {{ App.t('routes->' + item.label) }}
                                </RouterLink>
                            </li>
                        </template>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</template>
