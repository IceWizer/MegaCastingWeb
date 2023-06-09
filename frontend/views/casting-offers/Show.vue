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
            <b-button v-if="isUserLoggedIn()" variant="primary" @click="item.postuler ? depostuler() : postuler()">{{ item.postuler ? "Dépostuler" : "Postuler" }}</b-button>
        </div>
    </div>
</template>

<script>
import {isUserLoggedIn} from "@/auth/utils/useUserData";
import {getUserId} from "../../auth/utils/connection";

export default {
    name: "Show",
    data() {
        return {
            item: {},
        }
    },
    setup() {
        return {
            isUserLoggedIn,
            getUserId
        }
    },
    mounted() {
        this.$store
            .dispatch('casting_offers_store/fetchItem', {id: this.$route.params.id})
            .then((response) => {
                this.item = response;
                if (response?.users && response.users.length > 0) {
                    response.users.forEach(user => {
                        if (user.id === Number(getUserId())) {
                            this.isPostuler = true;
                        }
                    })
                }
            })
    },
    methods: {
        // Format date
        formatDate(date) {
            return new Date(date).toLocaleDateString();
        },
        // Postuler
        postuler() {
            this.$store
                .dispatch('users_store/postuler', this.$route.params.id)
                .then((response) => {
                    this.item.postuler = true;
                })
        },
        // Depostuler
        depostuler() {
            this.$store
                .dispatch('users_store/depostuler', this.$route.params.id)
                .then((response) => {
                    this.item.postuler = false;
                })
        }
    }
}
</script>

<style scoped>

</style>
