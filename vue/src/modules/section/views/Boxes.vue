<script setup>
import model from '@/modules/section/models/empty';
import View from '@/modules/section/components/View.vue';
</script>

<template>
    <View :pageTitle="__('Boxes')" name="boxes" type="page" :model="model" />
</template>

