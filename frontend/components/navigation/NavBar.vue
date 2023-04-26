<template>
    <div class="list-unstyled w-100 nav flex-column">
        <div v-for="item in menu">
            <nav-item :key="getId()" :item="item" class="w-100"></nav-item>
        </div>
    </div>
</template>

<script>
import navItem from "./navItem";

export default {
    name: "NavBar",
    components: {
        navItem
    },
    props: {
        menu: {
            type: Array,
            required: true
        }
    },
    data() {
        return {
            id: 0
        }
    },
    methods: {
        getId() {
            return this.id++;
        }
    }
}
</script>

<style scoped>

</style>
