<template>
    <button v-if="profileIsHr" class="fas fa-user-clock cursor-pointer border-0 bg-transparent" @click="updateEmployee"/>
</template>
<script>
import {useStore} from 'vuex'
import {inject, computed} from 'vue';

export default {
    setup(props) {
        const store = useStore();
        const emitter = inject("emitter");

        return {
            profileIsHr: computed(() => {
                return store.getters.getProfile.role === 'hr' || store.getters.getProfile.role === 'top hr'
            }),

            updateEmployee: async function () {
                let applicant = {...props.applicant};
                await store.dispatch('applicant/update', applicant)

                emitter.emit('notification-success', ' applicant was updated');
            }

        }
    },
    props: {
        applicant: Object
    },
};
</script>
