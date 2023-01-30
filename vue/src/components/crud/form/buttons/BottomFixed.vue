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
    <div class="crud-fixed-bottom-buttons">
        <div class="card m-0">
            <div class="card-header">
                {{ App.t('Действия') }}
            </div>

            <div class="card-body d-flex gap-2">
                <template v-for="action in actions">
                    <button v-if="action === 'cancel'" type="button" @click="App.page.goUp()" class="btn btn-danger text-start">
                        <i class="fas fa-undo me-1"></i>
                        {{ App.t('Отменить') }}
                    </button>

                    <button v-if="action === 'save'" type="submit" :form="elementId" class="btn btn-primary text-start">
                        <i class="fas fa-save me-1"></i>
                        {{ App.t('Сохранить') }}
                    </button>
                </template>
            </div>
        </div>
    </div>
</template>
