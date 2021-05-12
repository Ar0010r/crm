<template>
    <thead>
    <tr>
        <th class="text-left font-weight-bold ">Created</th>
        <th class="text-left font-weight-bold ">Personal manager</th>
        <th class="text-left font-weight-bold ">Name</th>
        <th class="text-left font-weight-bold ">Domain</th>
        <th class="text-left font-weight-bold ">Email</th>
        <th class="text-left font-weight-bold" v-if="profile.role === 'admin'">Actions</th>
    </tr>
    </thead>
</template>

<script>
    import {computed} from 'vue';
    import {useStore} from 'vuex';

    export default {
        setup() {
            const store = useStore();
            return {profile: computed(() => store.getters.getProfile)}
        }
    };
</script>
