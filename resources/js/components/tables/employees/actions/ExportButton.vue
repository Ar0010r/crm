<template>
    <a v-if="profileIsPersonnel || profileIsAdmin" type="button" class="fas fa-paper-plane p-0 bg-transparent border-0"
            data-toggle="tooltip" data-placement="right"
    ></a>
</template>

<script>
    import {computed} from 'vue';
    import{useStore} from 'vuex';
    export default {
        props: {
            employee: Object
        },
        setup(){
            const store = useStore();
            return {
                profileIsAdmin: computed(() => {
                    return store.getters.getProfile.role === 'admin'
                }),
                profileIsPersonnel: computed(() => {
                    return store.getters.getProfile.role === 'personnel'
                }),

            }

        }
    };
</script>
