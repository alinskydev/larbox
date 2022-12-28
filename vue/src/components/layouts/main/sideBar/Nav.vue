<script setup>
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

                    if (this.booted.helpers.user.checkRoute(this, itemChild.name ?? itemChild.path)) {
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
                if (this.booted.helpers.user.checkRoute(this, item.name ?? item.path)) {
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
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li v-for="(item, key) in items" class="nav-item">
                <template v-if="item.children">
                    <a
                        data-toggle="collapse"
                        :href="'#nav-' + key"
                        :class="'nav-link ' + (activeItems.includes(item.path) ? 'active' : 'collapsed')"
                    >
                        <i :class="'nav-icon ' + item.icon"></i>
                        <p>
                            {{ __('routes->' + item.label) }}
                            <i class="right fas fa-caret-right nav-icon-caret"></i>
                        </p>
                    </a>

                    <ul
                        :id="'nav-' + key"
                        :class="'nav nav-treeview collapse ' + (activeItems.includes(item.path) ? 'show' : '')"
                    >
                        <li v-for="itemChild in item.children" class="nav-item">
                            <RouterLink
                                :to="itemChild.path"
                                :class="'nav-link ' + (activeItems.includes(itemChild.path) ? 'active' : '')"
                            >
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('routes->' + itemChild.label) }}</p>
                            </RouterLink>
                        </li>
                    </ul>
                </template>

                <template v-else>
                    <RouterLink :to="item.path" :class="'nav-link ' + (activeItems.includes(item.path) ? 'active' : '')">
                        <i :class="'nav-icon ' + item.icon"></i>
                        <p>{{ __('routes->' + item.label) }}</p>
                    </RouterLink>
                </template>
            </li>
        </ul>
    </nav>
</template>
