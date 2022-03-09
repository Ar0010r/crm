<template>
    <div class="container-fluid flex-grow-1 container-p-y">
        <h4 class="font-weight-bold"
            :class="styling"
        >
            {{ title }}
        </h4>
        <slot name="control"></slot>
        <div class="card">
            <div class="card-datatable table-responsive" id="table">
                <slot name="table"></slot>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            title: String,
            styling: {
                type: String,
                default: 'py-3 mb-4'
            }
        },
    };
</script>
