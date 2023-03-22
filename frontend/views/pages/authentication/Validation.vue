<template>
    <div>
    </div>
</template>

<script>
export default {
    name: "Validation",
    mounted() {
        this.$store.dispatch('authStore/validate', this.$route.params.token)
            .then((response) => {

            })
            .catch((error) => {
                this.$router.push({ name: 'login' });
            })
    }
}
</script>

<style scoped>

</style>
