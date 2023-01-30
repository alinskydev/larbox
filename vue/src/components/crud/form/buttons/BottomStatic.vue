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
        elementId: {
            type: String,
            required: true,
        },
    },
    data() {
        return {};
    },
};
</script>

<template>
    <div class="d-flex justify-content-center gap-3 mt-4">
        <template v-for="action in actions">
            <button v-if="action === 'cancel'" type="button" @click="App.page.goUp()" class="btn btn-danger w-100">
                {{ App.t('Отменить') }}
            </button>

            <button v-if="action === 'save'" type="submit" :form="elementId" class="btn btn-primary w-100">
                {{ App.t('Сохранить') }}
            </button>
        </template>
    </div>
</template>
