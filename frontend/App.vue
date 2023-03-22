<template>
    <div class="container-fluid h-100">
        <div class="col-md-2 overflow-hidden h-100" v-if="$route.meta.layout == 'default'">
            <SidebarMenu :menu="menu" />
        </div>
        <div class="col h-100">
            <RouterView />
        </div>
    </div>
</template>

<script>
import { RouterView } from 'vue-router'
import SidebarMenu from './navigation/vertical/SidebarMenu.vue'
import menu from './navigation/vertical'

export default {
    name: "App.vue",
    components: {
        RouterView,
        SidebarMenu
    },
    data() {
        return {
            window: {
                width: 0,
                height: 0
            }
        }
    },
    setup() {
        return {
            menu
        }
    },
    created() {
        window.addEventListener('resize', this.handleResize);
        this.handleResize();
    },
    destroyed() {
        window.removeEventListener('resize', this.handleResize);
    },
    methods: {
        handleResize() {
            this.window.width = window.innerWidth;
            this.window.height = window.innerHeight;
        }
    }
}
</script>

<style lang="scss">
html, body, #app {
    height: 100%;
}
</style>
