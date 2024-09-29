<template>

    <Head title="Editar Categoria" />
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
                            <li class="breadcrumb-item active">Editar</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Editar Categoria</h3>
            </div>
            <div class="card-body">
                <form @submit.prevent="update">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="name">Nome</label>
                            <input type="text" class="form-control" id="name" v-model="form.name" required>
                            <span v-if="form.errors.name" class="text-danger">{{ form.errors.name }}</span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="slug">Slug</label>
                            <input type="text" class="form-control" id="slug" v-model="form.slug" required>
                            <span v-if="form.errors.slug" class="text-danger">{{ form.errors.slug }}</span>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="description">Descrição</label>
                            <input type="text" class="form-control" id="description" v-model="form.description">
                            <span v-if="form.errors.description" class="text-danger">{{ form.errors.description
                                }}</span>
                        </div>
                    </div>
                    <Link :href="route('categories.index')" class="btn btn-default mt-3 mr-2">Voltar</Link>
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
    category: Object
});

const form = useForm({
    name: props.category.name,
    slug: props.category.slug,
    description: props.category.description
});

watch(() => form.name, (newValue) => {
    form.slug = generateSlug(newValue);
});

function update() {
    form.put(route('categories.update', props.category.id), {
        preserveScroll: true,
        onSuccess: () => {
            toastr.success('Categoria atualizada com sucesso!');
        },
    });
}

</script>

<style lang="scss" scoped></style>