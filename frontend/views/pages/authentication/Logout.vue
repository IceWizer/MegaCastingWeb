<template>

</template>

<script>
import {logout} from "@/auth/utils/connection";

export default {
    name: "Logout",
    setup() {
        return {

        }
    },
    created() {
        this.logout();
    },
    methods: {
        logout() {
            this.$store.dispatch('auth_store/logout')
                .then((response) => {
                    logout();
                    this.$router.push({ name: 'dashboard' });
                })
                .catch((error) => {
                    console.log(error);
                });
        }
    }
}
</script>
