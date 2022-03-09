<template>
    <div class="form-row mb-2">
        <div class="form-group col mb-0 d-flex align-items-center flex-wrap" :class="style">
            <label class="form-label m-0">{{ label }}</label>
            <input class="form-check form-check-inline m-0 ml-1" type="checkbox"
                   v-model="vmodel"
                   true-value=1
                   false-value=0
                   v-bind="{
                       ...$attrs,
                       onChange: ($event) => {$emit('update:vmodel', $event.target.value)}
                    }"
            >
        </div>
    </div>
</template>

<script>

export default {
    props: {
        label: String,
        style: {
            type: String,
            default: "justify-content-end"
        },
        vmodel: String,
    },
};
</script>

