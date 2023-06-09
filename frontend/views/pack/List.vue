<template>
    <div>
        <h1>Liste des packs</h1>
        <div class="bg-light rounded border border-1 p-3 mt-4">
            <div class="d-flex flex-wrap justify-content-start my-4 p-3 rounded border border-1">
                <item
                    :item="object"
                    v-for="object in objects"
                    :key="object.id"
                    class="m-1"
                ></item>
            </div>
        </div>
    </div>
</template>

<script>
import Item from "../pack/Item.vue";

export default {
    name: "List",
    components: {Item},
    data() {
        return {
            objects: [],
        }
    },
    mounted() {
        this.$store.dispatch("packs_store/fetchItems")
            .then((response) => {
                this.objects = response;
            });
    },
}
</script>

<style scoped>

</style>
