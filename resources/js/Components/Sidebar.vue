<template>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">

        <Link href="/" class="brand-link">
        <img :src="'/assets/img/logo.png'" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">App Base</span>
        </Link>

        <div class="sidebar">
            <div class="user-panel mt-3 pb-3 mb-3 text-center">
                <div class="image">
                    <img :src="'/assets/img/logo.png'" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{ $page.props.auth.user.name }}</a>
                </div>
            </div>

            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <li class="nav-item">
                        <Link :href="route('dashboard')"
                            :class="['nav-link', { active: $page.component === 'Dashboard' }]">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Dashboard
                        </p>
                        </Link>
                    </li>
                    <li class="nav-item">
                        <Link :href="route('categories.index')" :class="['nav-link', {
                            active: $page.component === 'Categories/Index' ||
                                $page.component === 'Categories/Create' ||
                                $page.component === 'Categories/Edit'
                        }]">
                        <i class="nav-icon fas fa-list"></i>
                        <p>
                            Categorias
                        </p>
                        </Link>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<style scoped></style>