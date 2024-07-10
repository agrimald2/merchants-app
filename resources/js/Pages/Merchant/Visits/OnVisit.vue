<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
</script>

<template>
    <AdminLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-lg text-white leading-tight text-center ">
                {{ new Date().toLocaleDateString('es-ES', { weekday: 'long', month: 'long', day: 'numeric' }) }}
            </h2>
        </template>
        <div class="max-w-2xl mx-auto">
            <div class="bg-white p-4">
                <div class="filters">
                    <div class="grid grid-cols-3 gap-4 mb-4">
                        <div class="bg-red-500 text-white rounded-lg p-4 flex flex-col items-center">
                            <div class="text-2xl font-bold">10</div>
                            <div class="text-sm">Objetivo</div>
                        </div>
                        <div class="bg-green-500 text-white rounded-lg p-4 flex flex-col items-center">
                            <div class="text-2xl font-bold">5</div>
                            <div class="text-sm">Realizadas</div>
                        </div>
                        <div class="bg-yellow-500 text-white rounded-lg p-4 flex flex-col items-center">
                            <div class="text-2xl font-bold">5</div>
                            <div class="text-sm">Pendientes</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="px-3 pt-6">
                <p>Visitas Pendientes</p>
                <PendingVisitsComponent v-for="pendingVisist in pendingVisits" :visit="pendingVisist"
                    @scan="toggleQrModal" />
            </div>
            <div class="px-3 pt-6">
                <p>Visitas Realizadas</p>
                <DoneVisitsComponent v-for="i in 3" />
            </div>

            <button @click="requestLocationPermission"
                class="fixed bottom-4 right-4 bg-red-500 text-white p-4 rounded-full shadow-lg flex items-center justify-center">
                <i class="fa-solid fa-qrcode"></i>
            </button>
        </div>

        <ScanQR v-if="isQRModalVisible" @close="toggleQrModal" />
    </AdminLayout>
</template>
<script>
import axios from 'axios';


export default {
    components: { DoneVisitsComponent, PendingVisitsComponent, ScanQR },
    data() {
        return {

        };
    },
    created() {
        this.fetchPendingVisits();
        this.fetchIsOnVisit();
    },
    methods: {
        toggleQrModal() {
            console.log("Hola 2");
            this.isQRModalVisible = !this.isQRModalVisible;
        },
        async fetchPendingVisits() {
            try {
                const response = await axios.get(route('merchant.pendingVisits'));
                this.pendingVisits = response.data;
            } catch (error) {
                console.error('Error fetching pending visits:', error);
            }
        },
        async fetchIsOnVisit() {
            try {
                const response = await axios.post(route('merchant.isOnVisit'));
                console.log(response.data);
            } catch (error) {
                console.error('Error fetching is on visit:', error);
            }
        },
        requestLocationPermission() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    () => {
                        this.toggleQrModal();
                    },
                    (error) => {
                        if (error.code === error.PERMISSION_DENIED) {
                            alert('Location permission is required to start a visit. Please enable location services.');
                        }
                    }
                );
            } else {
                alert('Geolocation is not supported by this browser.');
            }
        }
    }
};
</script>