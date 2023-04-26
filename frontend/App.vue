<template>
    <div class="container-fluid h-100 p-0">
        <b-row class="h-100 w-100 p-0 m-0">
            <b-col
                class="p-0 col-12 col-xl-2 border"
                :class="collapse ? 'sticky-top border-bottom border-0' : 'position-sticky vh-100 border-end border-0'"
                v-if="$route.meta.layout === 'default'"
            >
                <SidebarMenu :menu="menu"/>
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
    computed: {
        collapse() {
            return this.$store.getters['app_store/isSmall'];
        }
    },
    components: {
        RouterView,
        SidebarMenu
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
            this.$store.dispatch('app_store/setWidth', window.innerWidth);
            this.$store.dispatch('app_store/setHeight', window.innerHeight);
        }
    },
}
</script>

<style lang="scss">
</style>
