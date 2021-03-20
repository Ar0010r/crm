<template>
    <thead>
    <tr>
        <th class="text-left">Created</th>
        <th class="text-left">Personal manager</th>
        <th class="text-left">Name</th>
        <th class="text-left">Domain</th>
        <th class="text-left">Email</th>
        <th v-if="profile.role === 'admin'" class="text-left">Actions</th>
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
