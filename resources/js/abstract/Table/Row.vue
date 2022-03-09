<template>
    <tr role="row">
        <slot></slot>
        <td>
            <div class="d-flex justify-content-between align-items-center ">
                <slot name="actions"></slot>
            </div>
        </td>
    </tr>
</template>
