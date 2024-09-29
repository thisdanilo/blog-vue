<template>

    <Head title="Dashboard" />
    <admin-layout>
        <div class="row mt-4">
            <div class="col-lg-6 col-6">

                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ categories }}</h3>
                        <p>Categorias</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-list"></i>
                    </div>
                    <Link :href="route('categories.index')" class="small-box-footer">Mais informações <i
                        class="fas fa-arrow-circle-right"></i></Link>
                </div>
            </div>
            <div class="col-lg-6 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ posts }}</h3>
                        <p>Posts</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-file-alt"></i>
                    </div>
                    <Link :href="route('posts.index')" class="small-box-footer">Mais informações <i
                        class="fas fa-arrow-circle-right"></i></Link>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Cadastros de Categorias por Mês</h3>
                    </div>
                    <div class="card-body">
                        <canvas ref="chartRefCategory"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Posts por Categoria</h3>
                    </div>
                    <div class="card-body">
                        <canvas ref="chartRefPostsByCategory"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </admin-layout>
</template>

<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';
import Chart from 'chart.js/dist/Chart.min.js';

const props = defineProps({
    categories: Number,
    categoryData: Array,
    posts: Number,
    postData: Array,
    postsByCategoryData: Object,
});

const chartRefCategory = ref(null);
const chartRefPostsByCategory = ref(null);

onMounted(() => {
    const ctxCategory = chartRefCategory.value.getContext('2d');
    new Chart(ctxCategory, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
            datasets: [{
                label: 'Cadastros de Categorias por Mês',
                data: props.categoryData,
                backgroundColor: 'rgba(75, 192, 192, 0.6)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    const ctxPostsByCategory = chartRefPostsByCategory.value.getContext('2d');

    if (Object.keys(props.postsByCategoryData).length > 0) {
        new Chart(ctxPostsByCategory, {
            type: 'doughnut',
            data: {
                labels: Object.keys(props.postsByCategoryData),
                datasets: [{
                    label: 'Posts por Categoria',
                    data: Object.values(props.postsByCategoryData),
                    backgroundColor: Object.keys(props.postsByCategoryData).map(() =>
                        `rgba(${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, 0.6)`
                    ),
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                return `Posts: ${context.raw}`;
                            }
                        }
                    }
                }
            }
        });
    } else {
        console.error('No data available for postsByCategoryData');
    }
});
</script>

<style scoped></style>
