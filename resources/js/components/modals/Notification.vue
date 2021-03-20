<template>
    <transition name="fade" appear>
        <div class="notification-overlay" v-if="show" @click="showModal"></div>
    </transition>
    <div v-if="show" class="notification" >
        <transition name="slide" class="modal-dialog m-0" appear>
            <form class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Notification
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-row mb-2 d-flex flex-column p-0">

                        <div class=" p-0 form-group col mb-0 d-flex align-items-center justify-content-between flex-wrap">
                            <p class="">{{message}}</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button  type="button" class="btn btn-primary"
                            @click="ok">Ok
                    </button>
                </div>
            </form>
        </transition>
    </div>
</template>

<script>
    import {useStore} from 'vuex';
    import {computed, inject, ref} from 'vue';

    export default {
        setup() {
            const store = useStore();
            const container = inject('container');

            async function ok() {
                store.commit('notification/setShow', false);
                store.commit('notification/setMessage', "");

            }

            return {
                ok, show: computed(() => store.getters.getShowNotification),
                message: computed(() => store.getters.getNotificationMessage)
            }
        },
    };
</script>

<style>
    .notification-overlay {
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        z-index: 1300;
        min-height: 100vh;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
    }

    .notification {
        position: fixed;
        top: 20%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: white;
        min-height: 130px;
        min-width: 350px;
        z-index: 1500;

    }


    .fade-enter-active,
    .fade-leave-active {
        transition: opacity .7s;
    }

    .fade-enter,
    .fade-leave-to {
        opacity: 0;
    }

    .slide-enter-active,
    .slide-leave-active {
        transition: transform .7s;
    }

    .slide-enter,
    .slide-leave-to {
        transform: translateY(-50%) translateX(100vw);
    }
</style>

