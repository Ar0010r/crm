<template>
    <h3>{{ record.head.title }}</h3>
    <h5>Personnel: {{ record.head.personnel }} | Mails: {{ record.head.letters }} </h5>
    <div class="d-flex justify-content-between">
        <table class="datatables-demo table table-striped table-bordered col-6">
            <thead>
            <tr>
                <th class="text-left font-weight-bold">Hr</th>
                <th class="text-left font-weight-bold">Mails</th>
                <th class="text-left font-weight-bold">Ready</th>
                <th class="text-left font-weight-bold">Rate</th>
            </tr>
            </thead>
            <tbody>
            <tr class="odd gradeX" v-for="hr in record.hrs">
                <td>{{ hr.login }}</td>
                <td>{{ hr.letters }}</td>
                <td>{{ hr.hired }}</td>
                <td> {{(hr.hired/hr.letters * 100).toFixed(2)}}%</td>
            </tr>
            </tbody>
        </table>
        <table class="datatables-demo table table-striped table-bordered col-2">
            <thead>
            <tr>
                <th class="text-left font-weight-bold">Applicants</th>
                <th class="text-left font-weight-bold">Count</th>
            </tr>
            </thead>
            <tbody>
            <tr class="odd gradeX">
                <td>Bad</td>
                <td>{{ record.applicants.bad }}</td>
            </tr>
            <tr class="odd gradeX">
                <td>Need data</td>
                <td>{{ record.applicants.need_data }}</td>
            </tr>
            <tr class="odd gradeX">
                <td>Ready</td>
                <td>{{ record.applicants.ready }}</td>
            </tr>
            <tr class="odd gradeX">
                <td>Invited</td>
                <td>{{ record.applicants.invited }}</td>
            </tr>
            <tr class="odd gradeX">
                <td>Exported</td>
                <td>{{ record.applicants.exported }}</td>
            </tr>
            <tr class="odd gradeX">
                <td>Total</td>
                <td>{{ record.applicants.total }}</td>
            </tr>
            </tbody>
        </table>
        <table class="datatables-demo table table-striped table-bordered col-2">
            <thead>
            <tr>
                <th class="text-left font-weight-bold">Rate</th>
                <th class="text-left font-weight-bold">Value</th>
            </tr>
            </thead>
            <tbody>
            <tr class="odd gradeX">
                <td>mails/ready</td>
                <td> {{(record.applicants.good/record.head.letters * 100).toFixed(2)}}%</td>
            </tr>
            <tr class="odd gradeX">
                <td>mails/exported</td>
                <td> {{(record.applicants.exported/record.head.letters * 100).toFixed(2)}}%</td>
            </tr>
            <tr class="odd gradeX">
                <td>total/ready</td>
                <td> {{(record.applicants.good/record.applicants.total * 100).toFixed(2)}}%</td>
            </tr>
            <tr class="odd gradeX">
                <td>ready/exported</td>
                <td> {{(record.applicants.exported/record.applicants.good * 100).toFixed(2)}}%</td>
            </tr>
            <tr class="odd gradeX">
                <td>total/exported</td>
                <td> {{(record.applicants.exported/record.applicants.total * 100).toFixed(2)}}%</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    props: {record: Object},
};
</script>

