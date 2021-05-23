<template>
    <div v-if="profile.role === 'admin'" style="justify-self: end" class="ml-3">
        <p v-if="profile.admin_employees_count > 0"> <i>conversion :</i> {{Math.round(profile.exported_admin_employees_count/profile.admin_employees_count * 100)}}%</p>
        <p v-else> <i>conversion :</i> 0%</p>
    </div>
    <div v-if="profile.role === 'hr'" style="justify-self: end" class="ml-3">
        <p v-if="profile.hr_employees_count > 0"> <i>conversion :</i> {{Math.round(profile.good_hr_employees_count/profile.hr_employees_count * 100)}}%</p>
        <p v-else> <i>conversion :</i> 0%</p>
    </div>
    <div v-if="profile.role === 'top hr'" style="justify-self: end" class="ml-3">
    <p v-if="profile.top_hr_employees_count > 0"><i>conversion :</i> {{Math.round(profile.good_top_hr_employees_count/profile.top_hr_employees_count * 100)}}%</p>
        <p v-else> <i>conversion :</i> 0%</p>
    </div>
    <div v-if="profile.role === 'personnel'" style="justify-self: end" class="ml-3">
        <p v-if="profile.personnel_employees_count > 0"> <i>conversion :</i> {{Math.round(profile.exported_personnel_employees_count/profile.personnel_employees_count * 100)}}%</p>
        <p v-else> <i>conversion :</i> 0%</p>
    </div>
</template>

<script>
    import {useStore} from 'vuex';
    import {computed} from 'vue';
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