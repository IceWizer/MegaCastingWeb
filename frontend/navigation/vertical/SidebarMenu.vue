<template>
    <div
        class="h-100 bg-light"
    >
        <img
            :src="require('@/assets/images/logo.png')"
            alt="Logo"
            class="w-100"
        >
        <div class="w-100">
            <h3 class="text-muted ms-1">{{ appName }}</h3>
            <nav-bar :menu="menu()" class="w-100 p-1"></nav-bar>
        </div>
    </div>
</template>

<script>
import navBar from "../../components/navigation/NavBar";
export default {
    name: "SidebarMenu",
    components: {
        navBar
    },
    props: {
        menu: {
            type: Function,
            required: true
        }
    },
    setup() {
        return {
            appName: process.env.APP_NAME || "Symfony"
        }
    }
}
</script>

<style scoped>

</style>
