<template>
    <footer class="main-footer">
        <div class="float-right d-none d-sm-inline">
            App Base
        </div>
        <strong>Copyright &copy; {{ year }}</strong>
    </footer>
</template>

<script setup>

let year = new Date().getFullYear();

</script>

<style scoped></style>