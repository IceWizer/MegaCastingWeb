<template>
    <div>
        <h1>Détails de l'offre</h1>
        <div class="bg-gray p-2 rounded">

            <h2>{{ item.label || "Error" }}</h2>
            <div class="ms-2 mt-2">
                <h3>Nombre d'offre d'emploi : {{ item.jobNumber }}</h3>
                <h3>Date de début du contrat : {{ formatDate(item.contractStartDate) }}</h3>
                <div class="border border-1 border-secondary rounded p-2 mb-2">
                    <h3>Description de l'offre</h3>
                    <p>{{ item.jobDescription }}</p>
                </div>
                <div class="border border-1 border-secondary rounded p-2">
                    <h3>Description du profil recherché</h3>
                    <p>{{ item.profilDescription }}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import castingOfferStore from "@store/modules/stores/castingOfferStore";
import {useModules} from "@store/utils";

import {onBeforeUnmount} from "vue";

export default {
    name: "Show",
    data() {
        return {
            item: {}
        }
    },
    setup() {
        const modules = [
            {
                store: castingOfferStore.store,
                name: castingOfferStore.name,
            }
        ]

        const {unmount} = useModules(modules)

        onBeforeUnmount(unmount)
    },
    mounted() {
        this.$store
            .dispatch('casting_offers_store/fetchItem', {id: this.$route.params.id})
            .then((response) => {
                this.item = response.data;
            })
    },
    methods: {
        // Format date
        formatDate(date) {
            return new Date(date).toLocaleDateString();
        }
    }
}
</script>

<style scoped>

</style>
