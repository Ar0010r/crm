<template>
    <Line
        id="my-chart-idy4464646"
        :options="chartOptions"
        :data="chartData"
        style="height: 100%; width: 100%"
    />
</template>

<script>
import {Line, Bar} from "vue-chartjs";
import {ref, computed} from "vue";
import {
    BarElement,
    CategoryScale,
    Chart,
    Legend,
    LinearScale,
    Title,
    LineElement,
    PointElement,
    Tooltip,
} from "chart.js";
import {useStore} from "vuex";

Chart.register(Title, Legend, BarElement, CategoryScale, LinearScale, LineElement, PointElement, Tooltip)
export default {
    name: "StatsChart",
    components: {Line, Bar},
    setup() {

        const store = useStore();
        const data = computed(() => store.getters.getDailyAnalytics)
        return {
            data,
            chartData: computed(function () {
                return {
                    labels: data.value.days,
                    //labels: ['10.01', '', '', '', '', '','10.01', '', '', '', '', '','10.01', '', '', '', '', '','10.01', '', '', '', '', '','10.01', '', '', '', '', '','10.01', '', '', '', '', ''],
                    datasets: [
                        {
                            label: '1st wave',
                            data: data.value.sent_1,
                            borderColor: 'rgb(54, 162, 235)',
                           // borderColor: 'rgb(75, 192, 192)',
                            //backgroundColor: 'rgb(75, 192, 192)',
                            backgroundColor: 'rgb(54, 162, 235, 0.5)',
                            fill: false,
                            cubicInterpolationMode: 'monotone',
                            tension: 0.4,
                            type: 'bar',
                            order: 2
                        },
                        {
                            label: '2nd wave',
                            data: data.value.sent_2,
                            borderColor: 'rgb(75, 192, 192)',
                            //borderColor: 'rgb(75,126,192)',
                            backgroundColor: 'rgb(75, 192, 192, 0.5)',
                            fill: false,
                            cubicInterpolationMode: 'monotone',
                            tension: 0.4,
                            type: 'bar',
                            order: 3,
                        },
                        {
                            label: 'bounce',
                            data: data.value.bounce,
                            borderColor: 'rgb(104,192,75)',
                            backgroundColor: 'rgb(104,192,75)',
                            fill: false,
                            cubicInterpolationMode: 'monotone',
                            tension: 0.4,
                            order: 4,
                        },
                        {
                            label: 'hired',
                            data: data.value.hired,
                            borderColor: 'rgb(220,157,120)',
                            backgroundColor: 'rgb(220,157,120)',
                            fill: false,
                            cubicInterpolationMode: 'monotone',
                            tension: 0.4,
                            order: 0
                        },
                        {
                            label: 'new',
                            data: data.value.new,
                            borderColor: 'rgb(54, 162, 235)',
                            backgroundColor: 'rgb(54, 162, 235)',
                            fill: false,
                            cubicInterpolationMode: 'monotone',
                            tension: 0.8,
                            order: 1
                        },
                        {
                            label: 'index',
                            data: data.value.index,
                            borderColor: 'rgb(36,44,49)',
                            backgroundColor: 'rgb(36,44,49)',
                            fill: false,
                            cubicInterpolationMode: 'monotone',
                            tension: 0.8,
                            order: 1,
                            radius: 1
                        },
                        {
                            label: 'total_bounce',
                            data: data.value.total_bounce,
                            borderColor: 'rgb(220,157,120)',
                            backgroundColor: 'rgb(220,157,120)',
                            fill: false,
                            cubicInterpolationMode: 'monotone',
                            tension: 0.8,
                            order: 1,
                            radius: 1
                        },
                        {
                            label: 'total_conversion',
                            data: data.value.total_conversion,
                            borderColor: 'rgb(171,81,85)',
                            backgroundColor: 'rgb(171,81,85)',
                            fill: false,
                            cubicInterpolationMode: 'monotone',
                            tension: 0.8,
                            order: 1,
                            radius: 1
                        }
                    ]
                }
            }),
            chartOptions: {
                type: 'line',
                responsive: true,
                plugins: {
                    tooltip: {
                        backgroundColor: "#227799",
                        callbacks: {
                            label: function (context) {
                                let label = context.dataset.label || '';

                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed.y !== null) {
                                    label += new Intl.NumberFormat('en-US', ).format(context.parsed.y);
                                }

                                console.log(context.dataset);
                                return label;
                            }
                        }
                    }
                },
                scales: {
                    x: {
                       /* ticks: {
                            // For a category axis, the val is the index so the lookup via getLabelForValue is needed
                            callback: function (val, index) {
                                // Hide every 2nd tick label
                                return index % 2 === 0 ? this.getLabelForValue(val) : '';
                            }
                        }*/
                    }
                }
            }
        }
    }
}
</script>
