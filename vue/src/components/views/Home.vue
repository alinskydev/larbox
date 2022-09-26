<script setup>
import { Page } from '@/core/page';
import PageTitle from '@/components/blocks/PageTitle.vue';
</script>

<script>
export default {
    data() {
        return {
            page: new Page({
                context: this,
                title: this.__('routes->home'),
                showBreadcrumbs: false,
            }),
        };
    },
    created() {
        this.page.init();
    },
};
</script>

<template>
    <PageTitle :text="page.title" />
</template>
