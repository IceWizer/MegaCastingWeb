<template>
    <div
        class="h-100 bg-light"
    >
        <img
            :src="require('@/assets/images/logo.jpg')"
            alt="Logo"
            class="p-1 w-100"
        >
        <div class="w-100">
            <h3 class="text-muted ms-1">{{ appName }}</h3>
            <nav-bar :menu="menu()" class="w-100 ms-2"></nav-bar>
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
    setup(props) {
        return {
            appName: process.env.APP_NAME || "Symfony"
        }
    }
}
</script>

<style scoped>

</style>
