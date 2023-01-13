<script setup>
import App from '@/core/app';
import Page from '@/core/page';
import PageTitle from '@/components/blocks/PageTitle.vue';
</script>

<script>
export default {
    data() {
        return {
            title: App.t('routes->home'),
        };
    },
    created() {
        Page.init({
            title: this.title,
            showBreadcrumbs: false,
        });
    },
};
</script>

<template>
    <PageTitle :text="title" />
</template>
