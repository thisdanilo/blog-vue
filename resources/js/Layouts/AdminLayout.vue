<template>

    <body class="sidebar-mini layout-fixed" cz-shortcut-listen="true" style="height: auto;">
        <div class="wrapper">
            <Navbar />
            <Sidebar />
            <div class="content-wrapper">
                <section class="content">
                    <div class="container-fluid">
                        <slot></slot>
                    </div>
                </section>
            </div>
            <Footer />
        </div>
    </body>
</template>

<script setup>
import Navbar from '@/Components/Navbar.vue';
import Sidebar from '@/Components/Sidebar.vue';
import Footer from '@/Components/Footer.vue';

</script>

<style scoped></style>