<template>
    <div
        class="border-2 rounded mb-2 mx-auto border border-1"
        style="width: 400px; height: 200px"
    >
        <b-row>
            <b-col cols="2" class="p-0 m-0 ps-4">
                <icon type="Box" :size=24 variant="primary" class="h-100 my-auto"></icon>
            </b-col>
            <b-col class="p-0 m-0 pe-4">
                <h3 class="h3 fw-bold">{{ item.label }}</h3>
            </b-col>
        </b-row>
        <b-row>
            <h5 class="h5">- {{ item.duration }} jours</h5>
            <h5 class="h5">- {{ item.castingNumber }} Offre de casting</h5>
            <h3 class="h3">Pour {{ item.price }}€</h3>
        </b-row>
    </div>
</template>

<script>
export default {
    name: "Item",
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
