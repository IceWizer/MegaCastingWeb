<template>
    <div>
        <h1>Mon profil</h1>
        <div>
            <h2 v-if="offers.length !== 0">Mes offres postulées</h2>
            <h2 v-else>Vous n'avez pas encore postulé à une offre</h2>
            <div v-if="offers.length !== 0" class="d-flex flex-wrap justify-content-start mt-4 p-3 bg-light rounded border border-1">
                <item
                    :item="offer"
                    v-for="offer in offers"
                    :key="offer.id"
                ></item>
            </div>
        </div>
    </div>
</template>

<script>
import Item from "../casting-offers/Item.vue";

export default {
    name: "Profil",
    components: {
        Item
    },
    data() {
        return {
            offers: [],
        }
    },
    mounted() {
        this.$store
            .dispatch('users_store/fetchProfile', 1)
            .then((response) => {
                this.offers = response.profile.offers;
            })
    }
}
</script>

<style scoped>

</style>
