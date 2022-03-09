<template>
    <thead>
    <tr>
        <th><Checkbox/></th>
        <th class="text-left  font-weight-bold">Created</th>
        <th class="text-left  font-weight-bold">Company</th>
        <th class="text-left  font-weight-bold">Identity</th>
        <th class="text-left  font-weight-bold">Contacts</th>
        <th class="text-left  font-weight-bold">Address</th>
        <th class="text-left  font-weight-bold">Status</th>
        <th class="text-left  font-weight-bold">Actions</th>
    </tr>
    </thead>
</template>
<script>
import Checkbox from './HeadCheckbox';
export default {
    components: {
        Checkbox
    }
}
</script>
