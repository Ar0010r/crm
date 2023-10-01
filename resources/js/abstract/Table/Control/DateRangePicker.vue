<template>
    <Datepicker v-model="date" format="yyyy-MM-dd" date-picker range multi-calendars multi-calendars-solo/>
</template>

<script>
import Datepicker from '@vuepic/vue-datepicker';
import 'vue3-date-time-picker/dist/main.css'
import {ref} from "vue";

export default {
    components: {Datepicker},
    setup() {
        const startDate = new Date();
        const endDate = new Date(new Date().setDate(startDate.getDate() + 7));
        const date = ref();

        date.value = [startDate, endDate];

        const format = (dates) => {

            //let r = "Date range : "
            let r = ""
            dates.forEach(function (datetime){
                let day = datetime.getDay();
                let month = datetime.getMonth();
                let year = datetime.getFullYear();

               // day = day < 10 ? "0" + String(day) : day;
                //month = month < 10 ? "0" +  String(month) : month;

               // r = r === "" ? `${day}-${month}-${year}` : r + ` -- ${day}-${month}-${year}`;
                r += `${day}-${month}-${year} `;
            });

            return "Date range : " + r;
           /* const day = date.getDate();
            const month = date.getMonth() + 1;
            const year = date.getFullYear();

            return `Selected date is ${day}/${month}/${year}`;*/
        }

        return {
            date, format
        }
    }
};
</script>
