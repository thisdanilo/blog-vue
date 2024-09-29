

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
                        <div class="card col-12 col-md-6 mb-4">
                            <img src="https://via.placeholder.com/750x300" class="card-img-top" alt="Blog post image">
                            <div class="card-body">
                                <h2 class="card-title">Blog Post Title</h2>
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis non
                                    nulla nec
                                    nunc ultrices tincidunt.</p>
                                <a href="#" class="btn btn-primary">Read More</a>
                            </div>
                            <div class="card-footer text-muted">
                                Posted on January 1, 2023 by Author
                            </div>
                        </div>
                        <div class="card col-12 col-md-6 mb-4">
                            <img src="https://via.placeholder.com/750x300" class="card-img-top" alt="Blog post image">
                            <div class="card-body">
                                <h2 class="card-title">Blog Post Title</h2>
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis non
                                    nulla nec
                                    nunc ultrices tincidunt.</p>
                                <a href="#" class="btn btn-primary">Read More</a>
                            </div>
                            <div class="card-footer text-muted">
                                Posted on January 1, 2023 by Author
                            </div>
                        </div>
                        <div class="card col-12 col-md-6 mb-4">
                            <img src="https://via.placeholder.com/750x300" class="card-img-top" alt="Blog post image">
                            <div class="card-body">
                                <h2 class="card-title">Blog Post Title</h2>
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis non
                                    nulla nec
                                    nunc ultrices tincidunt.</p>
                                <a href="#" class="btn btn-primary">Read More</a>
                            </div>
                            <div class="card-footer text-muted">
                                Posted on January 1, 2023 by Author
                            </div>
                        </div>
                        <div class="card col-12 col-md-6 mb-4">
                            <img src="https://via.placeholder.com/750x300" class="card-img-top" alt="Blog post image">
                            <div class="card-body">
                                <h2 class="card-title">Blog Post Title</h2>
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis non
                                    nulla nec
                                    nunc ultrices tincidunt.</p>
                                <a href="#" class="btn btn-primary">Read More</a>
                            </div>
                            <div class="card-footer text-muted">
                                Posted on January 1, 2023 by Author
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">Next</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>

                <div class="col-md-4">
                    <!-- Sidebar -->
                    <div class="card mb-4">
                        <div class="card-header">Search</div>
                        <div class="card-body">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search for...">
                                <button class="btn btn-secondary" type="button">Go!</button>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header">Categories</div>
                        <div class="card-body">
                            <ul class="list-unstyled mb-0">
                                <li><a href="#">Web Design</a></li>
                                <li><a href="#">HTML</a></li>
                                <li><a href="#">CSS</a></li>
                                <li><a href="#">JavaScript</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <footer class="bg-light text-center py-4 mt-4">
            <p>© 2023 My Blog. All rights reserved.</p>
        </footer>
    </div>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});

function handleImageError() {
    document.getElementById('screenshot-container')?.classList.add('!hidden');
    document.getElementById('docs-card')?.classList.add('!row-span-1');
    document.getElementById('docs-card-content')?.classList.add('!flex-row');
    document.getElementById('background')?.classList.add('!hidden');
}
</script>

<style scoped>
</style>