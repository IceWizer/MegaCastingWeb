<template>
    <router-link
        :to="{ name: 'casting-offers-item', params: { id: item.id }}"
        class="border-2 rounded mb-2 mx-auto border border-1"
        :class="item.sponsor ? 'bg-info' : 'bg-gray'"
        style="width: 400px; height: 200px"
    >
        <b-row>
            <b-col cols="2" class="p-0 m-0 ps-4">
                <icon type="Person" :size=24 variant="primary" class="h-100 my-auto"></icon>
            </b-col>
            <b-col class="p-0 m-0 pe-4">
                <h3 class="h3 fw-bold">{{ item.label }}</h3>
            </b-col>
        </b-row>
        <b-row>
            <h5 class="h5">Proposé par : {{ item.customer.label }}</h5>
        </b-row>
    </router-link>
</template>

<script>
export default {
    name: "item",
    props: {
        item: {
            type: Object,
            required: true
        }
    },
}
</script>

<style scoped>

</style>
