<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
</script>

<template>
    <AdminLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-lg text-white leading-tight text-center">
                ¿Qué deseas hacer hoy?
            </h2> 
        </template>

        <div class="pt-48">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden sm:rounded-lg flex justify-center items-center h-full">
                    <div class="grid grid-cols-1 gap-4 w-full px-6">
                        <button @click="() => $inertia.get(route('admin.visits'))" class="bg-red-ac text-white font-bold py-3 px-4 rounded-lg w-full">Visitas</button>
                        <button class="bg-red-ac text-white font-bold py-3 px-4 rounded-lg w-full">Puntos de Venta</button>
                        <button class="bg-red-ac text-white font-bold py-3 px-4 rounded-lg w-full">Mercaderistas</button>
                        <button class="bg-red-ac text-white font-bold py-3 px-4 rounded-lg w-full">Estadísticas</button>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
