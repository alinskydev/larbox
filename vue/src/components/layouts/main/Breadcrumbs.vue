<script setup>
import App from '@/core/app';
import RouterLink from '@/components/blocks/RouterLink.vue';
</script>

<script>
export default {
    data() {
        return {
            items: App.page?.breadcrumbs ?? [],
        };
    },
};
</script>

<template>
    <div class="page-title-content">
        <div class="container-fluid">
            <div class="page-title-box">
                <ol class="breadcrumb m-0">
                    <template v-if="items.length > 0">
                        <li class="breadcrumb-item">
                            <RouterLink to="">
                                {{ App.t('routes->home') }}
                            </RouterLink>
                        </li>

                        <template v-for="item in items">
                            <li v-if="item.path" class="breadcrumb-item">
                                <RouterLink :to="item.path">
                                    {{ item.label }}
                                </RouterLink>
                            </li>

                            <li v-else class="breadcrumb-item active">
                                {{ item.label }}
                            </li>
                        </template>
                    </template>

                    <li v-else class="breadcrumb-item active">
                        {{ App.t('routes->home') }}
                    </li>
                </ol>
            </div>
        </div>
    </div>
</template>
