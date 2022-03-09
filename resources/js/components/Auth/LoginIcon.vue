<template>
    <div class="d-flex justify-content-center align-items-center">
        <div class="ui-w-60">
            <div class="w-100 position-relative d-flex justify-content-center">
                <div class="bg-primary form-group d-flex align-items-center justify-content-center m-0"
                     style="border-radius: 50%; width: 75px">
                    <img src="idea.png" style="width: 75px; height: 75px">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        document.getElementById('layout-sidenav').style = 'display: none';
        document.getElementById('layout-navbar').style = 'display: none';
    }
};
</script>
