<template>
    <div class="dataTables_wrapper dt-bootstrap4 no-footer">
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <slot name="take"></slot>
            </div>
            <div class="col-sm-12 col-md-6">
                <slot name="search"></slot>
            </div>
        </div>
        <div class="row">
            <table class="table table-striped table-bordered">
                <slot name="head"></slot>
                <slot name="body"></slot>
                <tbody v-if="total == 0 || !total">
                <tr class="odd">
                    <td valign="top" colspan="9" class="dataTables_empty text-center">No data</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-5">
                <div class="dataTables_info" role="status" aria-live="polite">Showing {{ from ?? 0 }} to {{to ?? 0}} of {{total ?? 0}} records</div>
            </div>
            <div class="col-sm-12 col-md-7">
                <div class="dataTables_paginate paging_simple_numbers" id="user-list_paginate">
                    <slot name="pagination"></slot>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        from: String | Number,
        to: String | Number,
        total: String | Number,
    },
};
</script>

