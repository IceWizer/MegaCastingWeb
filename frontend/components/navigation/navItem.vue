<template>
    <div
        class="nav-item w-100 p-2 me-1 mb-1 border border-1 border-dark rounded"
        :class="isHover ? 'bg-secondary' : 'bg-light'"
        @mouseover="isHover = true"
        @mouseleave="isHover = false"
    >
        <router-link :to="{name: item.routeName}" class="d-flex text-decoration-none" @click="drop = !drop">
            <icon :type="(item.icon ? item.icon : 'PersonCircle')" :size=24 class="nav-icon" variant="dark"></icon>
            <p
                class="m-0 ms-1 me-auto text-decoration-none align-self-center"
                :class="isHover ? 'text-light' : 'text-dark'"
            >
                {{ item.title }}
            </p>
            <icon :type="drop ? 'ChevronDown' : 'ChevronRight'" :size=24 v-if="!item.routeName && item.children" variant="dark"></icon>
        </router-link>
        <div class="list-unstyled ms-3 mt-1" v-if="!item.routeName && item.children && drop">
            <nav-item v-for="(child, index) in item.children" :key="index" :item="child" dropped></nav-item>
        </div>
    </div>
</template>

<script>
export default {
    name: "navItem",
    props: {
        item: {
            type: Object,
            required: true,
        },
        dropped: {
            type: Boolean,
            default: false
        }
    },
    data() {
        return {
            drop: false,
            isHover: false
        }
    },
}
</script>

<style scoped>

</style>
