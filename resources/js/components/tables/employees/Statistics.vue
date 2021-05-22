<template>
    <div v-if="profile.role === 'admin'" style="justify-self: end" class="ml-3">
        <p> <i>conversion :</i> {{Math.round(profile.exported_admin_employees_count/profile.admin_employees_count * 100)}}%</p>
    </div>
    <div v-if="profile.role === 'hr'" style="justify-self: end" class="ml-3">
        <p> <i>conversion :</i> {{Math.round(profile.good_hr_employees_count/profile.hr_employees_count * 100)}}%</p>
    </div>
    <div v-if="profile.role === 'top hr'" style="justify-self: end" class="ml-3">
    <p> <i>conversion :</i> {{Math.round(profile.good_top_hr_employees_count/profile.top_hr_employees_count * 100)}}%</p>
    </div>
    <div v-if="profile.role === 'personnel'" style="justify-self: end" class="ml-3">
        <p> <i>conversion :</i> {{Math.round(profile.exported_personnel_employees_count/profile.personnel_employees_count * 100)}}%</p>
    </div>
</template>

<script>
    import {useStore} from 'vuex';
    import {computed, reactive, watch, inject} from 'vue';
    export default {
        name: "Statistics",
        setup(){
            let store = useStore();
            return {
                profile: computed(() => store.getters.getProfile),
            }
        }
    }
</script>