<template>
    <div>
        <component
            :is="'BIcon' + type"
            class="h-100 my-auto"
            :class="'text-' + variant"
            :style="'width: ' + size + 'px; height: ' + size + 'px;'"
        ></component>
    </div>
</template>

<script>

export default {
    name: "icon",
    props: {
        type: {
            type: String,
            required: true
        },
        size: {
            type: Number,
            default: 24
        },
        variant: {
            type: String,
            default: 'secondary'
        }
    },
}
</script>
