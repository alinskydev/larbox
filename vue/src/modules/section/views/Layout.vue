<script setup>
import model from '@/modules/section/models/layout';
import View from '@/modules/section/components/View.vue';
</script>

<template>
    <View :pageTitle="__('Layout')" name="layout" type="section" :model="model" />
</template>
