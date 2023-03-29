<template>
    <div class="container-fluid h-100 p-0">
        <b-row class="h-100 w-100 p-0 m-0">
            <b-col class="h-100 pb-1 px-0 col-md-2 border border-end border-0" v-if="$route.meta.layout == 'default'">
                <SidebarMenu :menu="menu" />
            </b-col>
            <b-col class="h-100 p-2 mx-2">
                <RouterView />
            </b-col>
        </b-row>
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
