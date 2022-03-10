<template>
    <button class="fas fa-money-bill cursor-pointer border-0 bg-transparent" @click="updateSubscription"/>
</template>
<script>
import {useStore} from 'vuex'
import {inject} from 'vue';

export default {
    setup(props) {
        const store = useStore();
        const emitter = inject("emitter");

        function now() {
            let today = new Date();
            let dd = today.getDate();
            let mm = today.getMonth() + 1;
            let yyyy = today.getFullYear();
            if (dd < 10) dd = '0' + dd;
            if (mm < 10) mm = '0' + mm;

            return yyyy + '-' + mm + '-' + dd;
        }


        return {
            updateSubscription: async function () {
                let subscription = {...props.subscription};
                subscription.last_payment = now();
                await store.dispatch('subscription/update', subscription)

                emitter.emit('notification-success', ' subscription was updated');
            }

        }
    },
    props: {
        subscription: Object
    },
};
</script>
