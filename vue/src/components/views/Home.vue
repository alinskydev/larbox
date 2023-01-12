<script setup>
import { Page } from '@/core/page';
import PageTitle from '@/components/blocks/PageTitle.vue';
</script>

<script>
export default {
    data() {
        return {
            title: this.__('routes->home'),
        };
    },
    created() {
        new Page({
            context: this,
            showBreadcrumbs: false,
        });
    },
};
</script>

<template>
    <PageTitle :text="title" />
</template>
