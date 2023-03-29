<template>
    <h1>Accueil</h1>
    <div class="d-flex flex-wrap justify-content-start mt-4 p-3 bg-light rounded border border-1">
        <item
            :item="object"
            v-for="object in objects"
            :key="object.id"
        ></item>
    </div>
</template>

<script>
import Item from "../casting-offers/Item.vue";
import {useModules} from "@store/utils";

// Modules
import castingOffersStore from "../../store/modules/stores/castingOfferStore";
import {onBeforeUnmount} from "vue";

export default {
    name: "Dashboard",
    components: {
        Item
    },
    data() {
        return {
            objects: [],
        }
    },
    setup() {
        const modules = [
            {
                store: castingOffersStore.store,
                name: castingOffersStore.name
            }
        ]

        const { unmount } = useModules(modules)

        onBeforeUnmount(unmount)
    },
    mounted() {
        this.$store
            .dispatch('casting_offers_store/fetchItems')
            .then((response) => {
                this.objects = response.data;
            })
    }
}
</script>

<style scoped>

</style>
