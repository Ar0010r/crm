<template>
    <div id="growls-tr"  @click="ok" >
        <div class="growl growl-error growl-medium" :class="{ 'growl-outgoing': !show}">
            <div class="growl-close">×</div>
            <div class="growl-title">{{message.message}}</div>
            <div class="growl-message" v-for="error in message.errors">{{error[0]}}</div>
        </div>
    </div>
</template>
<script>
    import {useStore} from 'vuex';
    import {computed, ref} from 'vue';

    export default {
        setup() {
            const store = useStore();

            return {
                show: computed(() => store.getters.getShowNotification),
                message: computed(() => store.getters.getNotificationMessage),
                ok : async () => store.dispatch('notification/deactivate')
            }
        },
    };
</script>


