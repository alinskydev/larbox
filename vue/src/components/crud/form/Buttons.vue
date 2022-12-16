<script>
export default {
    props: {
        actions: {
            type: Array,
            default: ['cancel', 'save'],
        },
    },
};
</script>

<template>
    <template v-for="action in actions">
        <button v-if="action === 'cancel'" type="button" @click="booted.components.current.page.goUp()" class="btn btn-danger">
            {{ __('Отменить') }}
        </button>

        <button v-if="action === 'save'" type="submit" form="crud-form" class="btn btn-success">
            {{ __('Сохранить') }}
        </button>
    </template>
</template>
