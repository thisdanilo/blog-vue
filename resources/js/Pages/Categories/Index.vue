<template>

    <Head title="Categories" />
    <admin-layout>
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Categorias</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <Link :href="route('dashboard')">Dashboard</Link>
                            </li>
                            <li class="breadcrumb-item active">Categorias</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Lista de Categorias</h3>
                                <Link :href="route('categories.create')" class="btn btn-primary float-right">
                                <i class="fas fa-plus"></i>
                                Adicionar
                                </Link>
                            </div>
                            <div class="card-body">
                                <table ref="dataTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nome</th>
                                            <th>Slug</th>
                                            <th>Descrição</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="category in categories" :key="category.id">
                                            <td>{{ category.id }}</td>
                                            <td>{{ category.name }}</td>
                                            <td>{{ category.slug }}</td>
                                            <td>{{ category.description }}</td>
                                            <td>
                                                <!-- Add action buttons here -->
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </admin-layout>
</template>

<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';

const props = defineProps({
    categories: Array,
});

const dataTable = ref(null);

onMounted(() => {
    if (props.categories && props.categories.length > 0) {
        $(dataTable.value).DataTable({
            responsive: true,
            lengthChange: true,
            autoWidth: false,
        });
    }
});
</script>

<style scoped></style>