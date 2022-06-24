<script setup>
import nav from "@/app/bootstrap/nav";
import RouterLink from "@/app/components/vue/RouterLink.vue";
</script>

<script>
export default {
    data() {
        return {
            items: [],
            activeItems: [],
        };
    },
    beforeCreate() {
        this.booted.components.nav = this;
    },
    beforeUpdate() {
        let items = nav;
        let matched = this.$route.matched;
        let activeItems = [];

        matched.shift();

        for (let match in matched) {
            let path = matched[match]['path'];

            path = path.replace(':locale', '', path)
                .replace('//', '/', path)
                .replace('/', '', path);

            activeItems[match] = path;
        }

        this.$data.items = items;
        this.$data.activeItems = activeItems;
    },
};
</script>

<template>
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column"
            data-widget="treeview"
            role="menu"
            data-accordion="false">

            <template v-for="(item, key) in items">
                <template v-if="item.children === undefined">
                    <li class="nav-item">
                        <RouterLink :to="item.path"
                                    :class="'nav-link ' + (activeItems.includes(item.path) ? 'active' : '')">

                            <i :class="'nav-icon ' + item.icon"></i>
                            <p>{{ __(item.label) }}</p>
                        </RouterLink>
                    </li>
                </template>

                <template v-else>
                    <li class="nav-item">
                        <a :href="'#nav-' + key"
                           data-toggle="collapse"
                           :class="'nav-link ' + (activeItems.includes(item.path) ? 'active' : '')">

                            <i :class="'nav-icon ' + item.icon"></i>
                            <p>
                                {{ __(item.label) }}
                                <i class="right fas fa-plus"></i>
                            </p>
                        </a>

                        <ul :id="'nav-' + key"
                            :class="'nav nav-treeview collapse ' + (activeItems.includes(item.path) ? 'show' : '')">

                            <template v-for="itemChild in item.children">
                                <li class="nav-item">
                                    <RouterLink :to="itemChild.path"
                                                :class="'nav-link ' + (activeItems.includes(itemChild.path) ? 'active' : '')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ __(itemChild.label) }}</p>
                                    </RouterLink>
                                </li>
                            </template>
                        </ul>
                    </li>
                </template>
            </template>
        </ul>
    </nav>
</template>