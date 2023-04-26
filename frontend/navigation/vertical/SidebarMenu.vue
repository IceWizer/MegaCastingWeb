<template>
    <div
        class="h-100 bg-light"
    >
        <img
            :src="require('@/assets/images/logo.png')"
            alt="Logo"
            class="w-100"
            v-if="!small"
        >
        <div class="w-100">
            <div class="d-flex flex-row justify-content-between">
                <h3 class="text-muted ms-1">{{ appName }}</h3>
                <b-button variant="link" class="m-1 p-1" v-if="small" @click="isOpen = !isOpen">
                    <icon type="List" variant="dark"></icon>
                </b-button>
            </div>
            <nav-bar :menu="menuItems" class="w-100 p-1" v-if="isOpen || !small"></nav-bar>
        </div>
    </div>
</template>

<script>
import navBar from "../../components/navigation/NavBar";
import { watch } from "vue";

export default {
    name: "SidebarMenu",
    components: {
        navBar
    },
    data() {
        return {
            isOpen: false,
            menuItems: []
        }
    },
    props: {
        menu: {
            type: Function,
            required: true
        },
    },
    computed: {
        small() {
            return this.$store.getters['app_store/isSmall'];
        },
    },
    setup(props) {
        watch(props.menu, (newVal) => {
            this.menuItems = newVal;
        })

        return {
            appName: process.env.APP_NAME || "Symfony"
        }
    },
    mounted() {
        this.menuItems = this.menu();
    }
}
</script>

<style scoped>

</style>
