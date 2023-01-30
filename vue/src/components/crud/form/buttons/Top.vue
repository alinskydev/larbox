<script setup>
import App from '@/core/app';
import PageTitleButtons from '@/components/blocks/PageTitleButtons.vue';
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
    <PageTitleButtons>
        <template v-for="action in actions">
            <button v-if="action === 'cancel'" type="button" @click="App.page.goUp()" class="btn btn-danger">
                {{ App.t('Отменить') }}
            </button>

            <button v-if="action === 'save'" type="submit" :form="elementId" class="btn btn-primary">
                {{ App.t('Сохранить') }}
            </button>
        </template>
    </PageTitleButtons>
</template>
