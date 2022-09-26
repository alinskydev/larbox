<script>
export default {
    data() {
        return {
            title: this.__('Ошибка'),
        };
    },
    created() {
        document.title = this.title;
    },
};
</script>

<template>
    <div class="error-page">
        <h2 class="headline text-warning">404</h2>

        <div class="ml-5">
            <h3>
                <i class="fas fa-exclamation-triangle text-warning"></i>
                {{ __('Страница не найдена') }}
            </h3>

            <a href="/" class="btn btn-warning">
                {{ __('На главную') }}
            </a>
        </div>
    </div>
</template>
