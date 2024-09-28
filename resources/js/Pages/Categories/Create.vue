<template>
    <Head title="Cadastrar Categoria" />
    <admin-layout>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Adicionar Categoria</h3>
            </div>
            <div class="card-body">
                <form @submit.prevent="store">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="name">Nome</label>
                            <input type="text" class="form-control" id="name" v-model="form.name">
                            <span v-if="form.errors.name" class="text-danger">{{ form.errors.name }}</span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="slug">Slug</label>
                            <input type="text" class="form-control" id="slug" v-model="form.slug">
                            <span v-if="form.errors.slug" class="text-danger">{{ form.errors.slug }}</span>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="description">Descrição</label>
                            <input type="text" class="form-control" id="description" v-model="form.description">
                            <span v-if="form.errors.description" class="text-danger">{{ form.errors.description }}</span>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3" :disabled="form.processing">Salvar</button>
                </form>
            </div>
        </div>
    </admin-layout>
</template>

<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { watch } from 'vue';
import toastr from 'toastr';
import 'toastr/build/toastr.min.css';

const form = useForm({
    name: '',
    slug: '',
    description: ''
});

function generateSlug(text) {
    return text
        .toString()
        .normalize('NFD')
        .replace(/[\u0300-\u036f]/g, '')
        .toLowerCase()
        .trim()
        .replace(/\s+/g, '-')
        .replace(/[^\w-]+/g, '')
        .replace(/--+/g, '-');
}

watch(() => form.name, (newValue) => {
    form.slug = generateSlug(newValue);
});

function store() {
    form.post(route('categories.store'), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
            toastr.success('Categoria criada com sucesso!');
        },
    });
}

</script>

<style lang="scss" scoped>

</style>