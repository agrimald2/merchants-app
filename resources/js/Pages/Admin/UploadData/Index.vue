<template>
    <AdminLayout title="Data">
        <template #header>
            <div class="flex items-center justify-between w-full">
                <!-- Back Button-->
                <button @click="goBack" class="text-white">
                    <i class="fa-solid fa-circle-chevron-left"></i>
                </button>
                <h2 class="font-semibold text-lg text-white leading-tight mx-auto">
                    Subir Data
                </h2>
                <div class="w-8"></div> <!-- Placeholder to balance the flex layout -->
            </div>
        </template>

        <div class="pt-10">
            <h3 class="text-center mb-4">
                En esta sección podrás subir la data para alimentar al sistema.
            </h3>
            <div class="max-w-3xl mx-auto sm:px-4 lg:px-6">
                <div class="overflow-hidden sm:rounded-lg flex justify-center items-center h-full">
                    <div class="grid grid-cols-1 gap-4 w-full px-4">
                        <button @click="() => $inertia.get(route('admin.visits'))"
                            class="bg-red-ac text-white font-bold py-3 px-4 rounded-lg w-full">Asignar Visitas</button>
                        <button @click="() => $inertia.get(route('admin.merchants'))"
                            class="bg-red-ac text-white font-bold py-3 px-4 rounded-lg w-full">Mercaderistas</button>
                        <button @click="() => $inertia.get(route('admin.uploadData'))"
                            class="bg-red-ac text-white font-bold py-3 px-4 rounded-lg w-full">Puntos de Venta</button>
                        <button @click="() => $inertia.get(route('admin.uploadData'))"
                            class="bg-red-ac text-white font-bold py-3 px-4 rounded-lg w-full">Locación</button>
                    </div>
                </div>
            </div>
        </div>

    </AdminLayout>
</template>

<script>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import axios from 'axios';

export default {
    components: { AdminLayout },
    props: [''],
    data() {
        return {

        };
    },
    mounted() {

    },
    methods: {
        goBack() {
            this.$inertia.get(route('dashboard'));
        }
    }
};
</script>