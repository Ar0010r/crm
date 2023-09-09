<template>
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center">
<!--                <p class="">lnr lnr-cart display-4 text-success</p>-->
                <div :class="style"></div>
                <div class="ml-3">
                    <div class="text-muted small">{{label}}</div>
                    <div class="text-large">{{value}}</div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {Line, Bar,} from "vue-chartjs";

export default {
    components: {Line, Bar},
    props: {
        label: {
            type: String,
        },
        value: String,
        style: String,
    }
}
</script>
