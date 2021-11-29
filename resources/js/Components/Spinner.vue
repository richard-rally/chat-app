<template>
    <div class="d-flex justify-content-center">
        <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status" v-if="state.loading">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
</template>

<script>
export default {
    name: "Spinner",

    props: {
        state: {
            default() {
                return {
                    loading: false,
                    complete: false,
                    error: false,
                }
            }
        }
    }
}
</script>

<style scoped>

</style>