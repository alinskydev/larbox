<script setup>
import items from '@/core/app/nav';
import RouterLink from '@/components/blocks/RouterLink.vue';
</script>

<script>
export default {
    data() {
        return {
            activeItems: [],
        };
    },
    created() {
        let matched = [...this.$route.matched];

        matched.shift();

        this.activeItems = matched.map((value) => {
            return value.path.replace(':locale', '').replace('//', '/').replace('/', '');
        });
    },
};
</script>

<template>
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li v-for="(item, key) in items" class="nav-item">
                <template v-if="item.children">
                    <a
                        :href="'#nav-' + key"
                        data-toggle="collapse"
                        :class="'nav-link ' + (activeItems.includes(item.path) ? 'active' : 'collapsed')"
                    >
                        <i :class="'nav-icon ' + item.icon"></i>
                        <p>
                            {{ __(item.label) }}
                            <i class="right fas fa-caret-right nav-icon-caret"></i>
                        </p>
                    </a>

                    <ul :id="'nav-' + key" :class="'nav nav-treeview collapse ' + (activeItems.includes(item.path) ? 'show' : '')">
                        <li v-for="itemChild in item.children" class="nav-item">
                            <RouterLink :to="itemChild.path" :class="'nav-link ' + (activeItems.includes(itemChild.path) ? 'active' : '')">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __(itemChild.label) }}</p>
                            </RouterLink>
                        </li>
                    </ul>
                </template>

                <RouterLink v-else :to="item.path" :class="'nav-link ' + (activeItems.includes(item.path) ? 'active' : '')">
                    <i :class="'nav-icon ' + item.icon"></i>
                    <p>{{ __(item.label) }}</p>
                </RouterLink>
            </li>
        </ul>
    </nav>
</template>
