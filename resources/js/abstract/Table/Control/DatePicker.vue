<template>
    <div class="col-md mb-4">
        <label class="form-label">{{ title }}</label>
        <Datepicker :format="format" placeholder="Any" :modelValue="vmodel" @update:modelValue="setDate">
        </Datepicker>
    </div>
</template>

<script>
import Datepicker from 'vue3-date-time-picker';
import 'vue3-date-time-picker/dist/main.css'
import {useStore} from "vuex";

export default {
    props: {
        title: String,
        vmodel: String,
        commit: String,
        param: String
    },
    components: {Datepicker},
    setup(props) {
        const store = useStore();

        const format = (date) => {
            if (date == null) return null

            let dd = date.getDate();
            let mm = date.getMonth() + 1;
            let yyyy = date.getFullYear();
            if (dd < 10) dd = '0' + dd;
            if (mm < 10) mm = '0' + mm;

            return yyyy + '-' + mm + '-' + dd;
        }

        return {
            format,
            setDate: function (value) {
                let wtf = value == null ? null : new Date(value)
                store.commit(props.commit, {'key': props.param, 'value': format(wtf)})
            },
        }
    }
};
</script>

<style>
.dp__input::placeholder {
    color: #babbbc;
    font-size: .894rem;
    font-weight: 400;
    line-height: 1.54;
}
</style>
