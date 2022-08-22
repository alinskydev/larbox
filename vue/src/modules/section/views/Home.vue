<script setup>
import model from '@/modules/section/models/home';
import View from '@/modules/section/components/View.vue';
</script>

<template>
    <View :pageTitle="__('Home')" name="home" type="page" :model="model" />
</template>
