<script setup>
import RouterLink from '@/components/blocks/RouterLink.vue';
</script>

<script>
export default {
    data() {
        return {
            items: this.booted.components.current?.page.breadcrumbs ?? [],
        };
    },
};
</script>

<template>
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                <i class="fas fa-bars"></i>
            </a>
        </li>
    </ul>

    <ul class="navbar-nav breadcrumbs">
        <template v-if="items.length > 0">
            <li class="nav-item d-none d-sm-inline-block">
                <RouterLink to="" class="nav-link">
                    {{ __('Главная') }}
                </RouterLink>
            </li>

            <li v-for="item in items" class="nav-item d-none d-sm-inline-block">
                <i class="fas fa-angle-right"></i>

                <RouterLink v-if="item.path" :to="item.path" class="nav-link">
                    {{ item.label }}
                </RouterLink>
                <span v-else class="nav-link">
                    {{ item.label }}
                </span>
            </li>
        </template>
    </ul>
</template>
