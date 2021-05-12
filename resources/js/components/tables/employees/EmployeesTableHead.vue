<template>
    <thead>
    <tr>
        <th><Checkbox/></th>
        <th class="text-left  font-weight-bold">Created</th>
        <th class="text-left  font-weight-bold">HR</th>
        <th class="text-left  font-weight-bold">Company</th>
        <th class="text-left  font-weight-bold">Identity</th>
        <th class="text-left  font-weight-bold">Email/PayPal</th>
        <th class="text-left  font-weight-bold">Address</th>
        <th class="text-left  font-weight-bold">Phones</th>
        <th class="text-left  font-weight-bold">Status</th>
        <th class="text-left  font-weight-bold">Actions</th>
    </tr>
    </thead>
</template>
<script>
    import Checkbox from './actions/HeadCheckbox';
    export default {
        components: {
            Checkbox
        }
    }
</script>
