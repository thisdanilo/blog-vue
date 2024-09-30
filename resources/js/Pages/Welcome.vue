<template>

    <Head title="Bem vindo" />
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="#">My Blog</a>
                <div class="navbar-nav ms-auto">
                    <template v-if="canLogin">
                        <Link v-if="$page.props.auth.user" :href="route('dashboard')" class="nav-link">
                        Dashboard
                        </Link>
                        <template v-else>
                            <Link :href="route('login')" class="nav-link">
                            Login
                            </Link>
                            <Link v-if="canRegister" :href="route('register')" class="nav-link">
                            Registrar
                            </Link>
                        </template>
                    </template>
                </div>
            </div>
        </nav>

        <main class="container mt-4">
            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        <template v-for="post in posts.data" :key="post.id">
                            <div class="card col-12 col-md-6 mb-4">
                                <img :src="getPostImage(post.image)" class="card-img-top" alt="Blog post image">
                                <div class="card-body">
                                    <h2 class="card-title">{{ post.title }}</h2>
                                    <p class="card-text">{{ post.content }}</p>
                                    <a href="#" class="btn btn-primary">Ver mais</a>
                                </div>
                                <div class="card-footer text-muted">
                                    {{ formatDate(post.created_at) }}
                                    <br>
                                    Autor:
                                    <strong>
                                        {{ post.user.name }}
                                    </strong>
                                </div>
                            </div>
                        </template>
                    </div>
                    <div class="d-flex justify-content-center">
                        <nav aria-label="Page navigation">
                            <ul class="pagination">
                                <li v-for="link in posts.links" :key="link.url" class="page-item"
                                    :class="{ 'active': link.active }">
                                    <Link v-if="link.url" :href="link.url" class="page-link" v-html="link.label" />
                                    <span v-else class="page-link" v-html="link.label"></span>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>

                <div class="col-md-4">
                    <!-- Sidebar -->
                    <div class="card mb-4">
                        <div class="card-header">Pesquisar</div>
                        <div class="card-body">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Pesquisar...">
                                <button class="btn btn-secondary" type="button">Buscar</button>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header">Categorias</div>
                        <div class="card-body">
                            <ul class="list-unstyled mb-0">
                                <template v-for="category in categories" :key="category.id">
                                    <li><a href="#">{{ category.name }}</a></li>
                                </template>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <footer class="bg-light text-center py-4 mt-4">
            <p>{{ year }}</p>
        </footer>
    </div>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },

    categories: Array,
    posts: Object,
});

let year = new Date().getFullYear();

function formatDate(date) {
    return new Date(date).toLocaleDateString('pt-BR', {
        day: '2-digit',
        month: 'long',
        year: 'numeric',
    });
}

const getPostImage = (imagePath) => {
    if (imagePath) {
        return '../storage/' + imagePath;
    }
    return '../storage/default.jpg';
};
</script>

<style scoped></style>