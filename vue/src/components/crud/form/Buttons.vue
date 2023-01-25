<script setup>
import App from '@/core/app';
</script>

<script>
export default {
    props: {
        actions: {
            type: Array,
            default: ['cancel', 'save'],
        },
    },
    data() {
        return {};
    },
};
</script>

<template>
    <template v-for="action in actions">
        <button v-if="action === 'cancel'" type="button" @click="App.page.goUp()" class="btn btn-danger">
            {{ App.t('Отменить') }}
        </button>

        <button v-if="action === 'save'" type="submit" form="crud-form" class="btn btn-primary">
            {{ App.t('Сохранить') }}
        </button>
    </template>
</template>
