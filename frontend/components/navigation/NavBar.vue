<template>
    <div class="list-unstyled w-100 nav flex-column">
        <div v-for="(item, index) in menu">
            <nav-item :key="index" :item="item" class="w-100" :previous-id="index"></nav-item>
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
}
</script>

<style scoped>

</style>
