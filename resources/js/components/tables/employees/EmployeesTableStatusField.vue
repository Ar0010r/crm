<template>
    <div class="btn-group  w-100">
        <button type="button" class="btn btn dropdown-toggle" :class="this.statuses[empStatus]"
                data-toggle="dropdown">{{empStatus}}
        </button>
        <div class="dropdown-menu m-0 p-0 w-100 text-center">
            <a @click='updateStatus("New")' class="dropdown-item btn-light" href="javascript:void(0)"> New</a>
            <a @click='updateStatus("Waiting agreement")' class="dropdown-item btn-primary" href="javascript:void(0)">Waiting
                agreement</a>
            <a @click='updateStatus("Need call")' class="dropdown-item btn-info" href="javascript:void(0)">Need call</a>
            <a @click='updateStatus("Need info request")' class="dropdown-item btn-info" href="javascript:void(0)">Need
                info request</a>
            <a @click='updateStatus("No answer")' class="dropdown-item btn-warning" href="javascript: void(0)">No
                answer</a>
            <a @click='updateStatus("Bad")' class="dropdown-item btn-danger" href="javascript:void(0)">Bad</a>
            <a @click='updateStatus("Ready")' class="dropdown-item btn-success" href="javascript:void(0)">Ready</a>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        data() {
            let statuses = {
                'New': 'btn-white',
                'Waiting agreement': 'btn-primary',
                'Need call': 'btn-info',
                'Need info request': 'btn-info',
                'No answer': 'btn-warning',
                'Bad': 'btn-danger',
                'Ready': 'btn-success',
            };


            return {statuses: statuses, empStatus: this.status}
        },

        methods: {
            async updateStatus(status) {
                this.empStatus = status;
                if(this.updateOnSelect === true) {
                    axios.put('api/employees/' + this.id, {status: this.empStatus});
                }
            }
        },
        props: ['status', 'id', 'updateOnSelect'],
    };
</script>

