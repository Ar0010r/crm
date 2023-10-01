<template>
    <Line
        id="my-chart-idy4464647"
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
    name: "IndexChart",
    components: {Line, Bar},
    setup() {

        const store = useStore();
        const data = computed(() => store.getters.getIndexAnalytics)
        return {
            data,
            chartData: computed(function () {
                return {
                    labels: data.value.days,
                    //labels: ['10.01', '', '', '', '', '','10.01', '', '', '', '', '','10.01', '', '', '', '', '','10.01', '', '', '', '', '','10.01', '', '', '', '', '','10.01', '', '', '', '', ''],
                    datasets: [
                        {
                            label: 'relative index',
                            data: data.value.relative_index,
                            borderColor: 'rgb(54, 162, 235)',
                           // borderColor: 'rgb(75, 192, 192)',
                            //backgroundColor: 'rgb(75, 192, 192)',
                            backgroundColor: 'rgb(54, 162, 235, 0.5)',
                            fill: false,
                            cubicInterpolationMode: 'monotone',
                            tension: 0.4,
                            type: 'line',
                            order: 2,
                            radius: 1
                        },
                        {
                            label: 'relative conversion',
                            data: data.value.relative_conversion,
                            borderColor: 'rgb(75, 192, 192)',
                            //borderColor: 'rgb(75,126,192)',
                            backgroundColor: 'rgb(75, 192, 192, 0.5)',
                            fill: false,
                            cubicInterpolationMode: 'monotone',
                            tension: 0.4,
                            type: 'line',
                            order: 3,
                            radius: 1
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
                            label: 'bounce',
                            data: data.value.bounce,
                            borderColor: 'rgb(220,157,120)',
                            backgroundColor: 'rgb(220,157,120)',
                            fill: false,
                            cubicInterpolationMode: 'monotone',
                            tension: 0.8,
                            order: 1,
                            radius: 1
                        },
                        {
                            label: 'conversion',
                            data: data.value.conversion,
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

                                return label;
                            }
                        }
                    }
                },
                scales: {
                   /* x: {
                        ticks: {
                            // For a category axis, the val is the index so the lookup via getLabelForValue is needed
                            callback: function (val, index) {
                                // Hide every 2nd tick label
                                return index % 10 === 0 ? this.getLabelForValue(val) : '';
                            }
                        }
                    }*/
                }
            }
        }
    }
}
</script>
