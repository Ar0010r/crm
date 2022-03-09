<template>
    <div class="progress">
        <div  :class="[ 'progress-bar', parseInt(progress) > 100 ? 'bg-success' : 'bg-warning',]"
              :style="{'width': showProgress + '%'}">
            {{showProgress}}%
        </div>
    </div>
    <div style="margin: 3px 0; font-size: 70%" class="d-flex justify-content-between">
        <div>
            <small v-for="star in parseInt(stars)" class="ion ion-ios-star"></small>
            <small v-if="parseInt(progress) % 100 > 0 && parseInt(progress) > 100" class="ion ion-ios-star-half"></small>
        </div>
        <small>{{mail.processed}}</small>
    </div>
</template>

<script>
    import {computed} from 'vue';

    export default {
        props: {mail: Object},
        setup(props){
            let total = computed(() =>
                parseInt(props.mail.google) +
                parseInt(props.mail.outlook) +
                parseInt(props.mail.yahoo) +
                parseInt(props.mail.other)
            );

            let progress = computed(() => {
                return props.mail.processed == 0 ? 0 : (props.mail.processed/total.value * 100).toFixed(2)
            });
            let stars = computed(() => {
                return props.mail.processed == 0 ? 0 :  (parseInt((progress.value/100) - 1).toString().charAt(0))
            });

            return {
                total, progress, stars,
                showProgress: computed(() => {
                    if(stars.value > 0 && progress.value % 100 == 0) {
                        return 100;
                    }

                    if(props.mail.processed == total.value) {
                        return 100;
                    }

                    return (progress.value % 100).toFixed(0)
                })
            }
        }
    };
</script>
