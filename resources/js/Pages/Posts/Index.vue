<template>

    <Head title="Posts" />
    <admin-layout>
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Posts</h1>
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
                                <h3 class="card-title">Lista de Posts</h3>
                                <Link :href="route('posts.create')" class="btn btn-primary float-right">
                                <i class="fas fa-plus"></i>
                                Adicionar
                                </Link>
                            </div>
                            <div class="card-body">
                                <table ref="dataTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Título</th>
                                            <th>Slug</th>
                                            <th>Descrição</th>
                                            <th>Categoria</th>
                                            <th>Status</th>
                                            <th width="100">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="post in posts" :key="post.id">
                                            <td>{{ post.id }}</td>
                                            <td>{{ post.title }}</td>
                                            <td>{{ post.slug }}</td>
                                            <td>{{ post.content }}</td>
                                            <td>{{ post.category.name }}</td>
                                            <td>
                                                <span :class="['badge', post.status ? 'bg-success' : 'bg-danger']">
                                                    {{ post.status ? 'Ativo' : 'Inativo' }}
                                                </span>
                                            </td>
                                            <td class="d-flex justify-content-end">
                                                <Link :href="route('posts.edit', post.id)"
                                                    class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i>
                                                </Link>
                                                <button @click="openDeleteModal(post)"
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
            :confirm-button-class="'btn btn-danger'" @close="closeDeleteModal" @confirm="deletePost">
            <p>Tem certeza que deseja excluir o post "{{ postToDelete?.title }}"?</p>
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
    posts: Array,
});

const dataTable = ref(null);

const showDeleteModal = ref(false);
const postToDelete = ref(null);

const openDeleteModal = (post) => {
    postToDelete.value = post;
    showDeleteModal.value = true;
};

const closeDeleteModal = () => {
    showDeleteModal.value = false;
    postToDelete.value = null;
};

const deletePost = () => {
    if (postToDelete.value) {
        router.delete(route('posts.delete', postToDelete.value.id));
        closeDeleteModal();
        toastr.success('Post deletado com sucesso');
    }
};

onMounted(() => {
    if (props.posts && props.posts.length > 0) {
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