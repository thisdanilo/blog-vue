<template>

    <Head title="Cadastrar Post" />
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
                            <li class="breadcrumb-item active">Cadastrar</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Adicionar Post</h3>
            </div>
            <div class="card-body">
                <form @submit.prevent="store">
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="title">Título</label>
                            <input type="text" class="form-control" id="title" v-model="form.title" required>
                            <span v-if="form.errors.title" class="text-danger">{{ form.errors.title }}</span>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="slug">Slug</label>
                            <input type="text" class="form-control" id="slug" v-model="form.slug" required>
                            <span v-if="form.errors.slug" class="text-danger">{{ form.errors.slug }}</span>
                        </div>  
                        <div class="form-group col-md-3">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" v-model="form.status">
                                <option value="1">Ativo</option>
                                <option value="0">Inativo</option>
                            </select>
                            <span v-if="form.errors.status" class="text-danger">{{ form.errors.status }}</span>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="category_id">Categoria</label>
                            <select class="form-control" id="category_id" v-model="form.category_id">
                                <option v-for="category in categories" :value="category.id" :key="category.id">{{ category.name }}</option>
                            </select>
                            <span v-if="form.errors.category_id" class="text-danger">{{ form.errors.category_id }}</span>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="content">Conteúdo</label>
                            <input type="text" class="form-control" id="content" v-model="form.content">
                            <span v-if="form.errors.content" class="text-danger">{{ form.errors.content }}</span>
                        </div>
                    </div>
                    <Link :href="route('posts.index')" class="btn btn-default mt-3 mr-2">Voltar</Link>
                    <button type="submit" class="btn btn-primary mt-3" :disabled="form.processing">Salvar</button>
                </form>
            </div>
        </div>
    </admin-layout>
</template>

<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';
import { watch } from 'vue';
import toastr from 'toastr';
import 'toastr/build/toastr.min.css';
import { generateSlug } from '@/Utils.js';

const props = defineProps({
    categories: Array
});

const form = useForm({
    title: '',
    slug: '',
    status: '',
    content: '',
    category_id: ''
});

watch(() => form.title, (newValue) => {
    form.slug = generateSlug(newValue);
});

function store() {
    form.post(route('posts.store'), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
            toastr.success('Post criado com sucesso!');
        },
    });
}

</script>

<style lang="scss" scoped></style>