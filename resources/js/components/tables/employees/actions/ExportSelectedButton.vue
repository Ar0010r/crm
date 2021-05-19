<template>
    <div v-if="profileIsPersonnel || profileIsAdmin" class="d-flex align-items-center cursor-pointer ml-2">
        <div class="bs-bars float-left">
            <button class="btn btn-primary">
                <i class="far fa-paper-plane"></i> Export
            </button>
        </div>
    </div>
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