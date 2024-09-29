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
                            <li class="breadcrumb-item active">Listagem</li>
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
                                            <th width="100">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="category in categories" :key="category.id">
                                            <td>{{ category.id }}</td>
                                            <td>{{ category.name }}</td>
                                            <td>{{ category.slug }}</td>
                                            <td>{{ category.description }}</td>
                                            <td class="d-flex justify-content-end">
                                                <Link :href="route('categories.edit', category.id)" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i>
                                                </Link>
                                                <button @click="openDeleteModal(category)"
                                                    class="btn btn-danger btn-sm ml-1">
                                                    <i class="fas fa-trash"></i>
                                                </button>
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

        <Modal :show="showDeleteModal" title="Confirmar Exclusão" size="md" confirm-text="Excluir"
            :confirm-button-class="'btn btn-danger'" @close="closeDeleteModal" @confirm="deleteCategory">
            <p>Tem certeza que deseja excluir a categoria "{{ categoryToDelete?.name }}"?</p>
        </Modal>
    </admin-layout>

</template>

<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';
import Modal from '@/Components/Modal.vue';
import { router } from '@inertiajs/vue3';
import toastr from 'toastr';
import 'toastr/build/toastr.min.css';

const props = defineProps({
    categories: Array,
});

const dataTable = ref(null);

const showDeleteModal = ref(false);
const categoryToDelete = ref(null);

const openDeleteModal = (category) => {
    categoryToDelete.value = category;
    showDeleteModal.value = true;
};

const closeDeleteModal = () => {
    showDeleteModal.value = false;
    categoryToDelete.value = null;
};

const deleteCategory = () => {
    if (categoryToDelete.value) {
        router.delete(route('categories.delete', categoryToDelete.value.id));
        closeDeleteModal();
        toastr.success('Categoria deletada com sucesso');
    }
};

onMounted(() => {
    if (props.categories && props.categories.length > 0) {
        $(dataTable.value).DataTable({
            responsive: true,
            lengthChange: true,
            autoWidth: false,
            columnDefs: [
                { orderable: false, targets: 4 }
            ]
        });
    }
});
</script>

<style scoped></style>