<script setup>
import MerchantLayout from '@/Layouts/MerchantLayout.vue';
</script>

<template>
    <MerchantLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-lg text-white leading-tight text-center mb-2">
                <span class="bg-gray-100 text-black p-1 text-center rounded">
                    {{ averageProgress }}%
                </span> 
            </h2>
            <h2 class="font-semibold text-lg text-white leading-tight text-center ">
                {{ new Date().toLocaleDateString('es-ES', { weekday: 'long', month: 'long', day: 'numeric' }) }}
            </h2>
        </template>
        <div class="max-w-2xl mx-auto">
            <div class="bg-white p-4">
                <div class="filters">
                    <div class="grid grid-cols-3 gap-4 mb-4">
                        <div class="shadow-md bg-gray-50 text-black rounded-lg p-4 flex flex-col items-center">
                            <i class="text-xl fa-solid fa-bullseye"></i>
                            <div class="text-sm">Objetivo</div>
                            <div class="text-2xl font-bold">{{ totalVisits }}</div>
                        </div>
                        <div class="shadow-md bg-gray-50 text-black rounded-lg p-4 flex flex-col items-center">
                            <i class="text-xl fa-regular fa-circle-check text-green-500"></i>
                            <div class="text-sm">Realizadas</div>
                            <div class="text-2xl font-bold">{{ doneVisits.length }}</div>
                        </div>
                        <div class="shadow-md bg-gray-50 text-black rounded-lg p-4 flex flex-col items-center">
                            <i class="text-xl fa-solid fa-stopwatch text-yellow-500"></i>
                            <div class="text-sm">Pendientes</div>
                            <div class="text-2xl font-bold">{{ pendingVisits.length }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="px-3 pt-6">
                <p>Visitas Pendientes</p>
                <PendingVisitsComponent v-for="pendingVisit in pendingVisits" :visit="pendingVisit"
                    @scan="toggleQrModal" />
            </div>
            <div class="px-3 pt-6">
                <p>Visitas Realizadas</p>
                <DoneVisitsComponent v-for="doneVisit in doneVisits" :visit="doneVisit" />
            </div>
            <button @click="requestLocationPermission"
                class="fixed bottom-4 right-4 bg-red-500 text-white p-4 rounded-full shadow-lg flex items-center justify-center">
                <i class="fa-solid fa-qrcode"></i>
            </button>
        </div>

        <ScanQR v-if="isQRModalVisible" @close="toggleQrModal" />
    </MerchantLayout>
</template>
<script>
import axios from 'axios';
import PendingVisitsComponent from './Visits/PendingVisitsComponent.vue';
import DoneVisitsComponent from './Visits/DoneVisitsComponent.vue';
import ScanQR from './Visits/ScanQR.vue';

export default {
    components: { DoneVisitsComponent, PendingVisitsComponent, ScanQR },
    data() {
        return {
            isQRModalVisible: false,
            pendingVisits: [],
            doneVisits: [],
            isOnVisit: null
        };
    },
    computed: {
        totalVisits() {
            return this.pendingVisits.length + this.doneVisits.length;
        },
        averageProgress() {
            if (this.totalVisits === 0) return 0;
            return ((this.doneVisits.length / this.totalVisits) * 100).toFixed(0);
        }
    },
    created() {
        this.fetchPendingVisits();
        this.fetchDoneVisits();
        this.fetchIsOnVisit();
    },
    methods: {
        toggleQrModal() {
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
        async fetchDoneVisits() {
            try {
                const response = await axios.get(route('merchant.doneVisits'));
                this.doneVisits = response.data;
            } catch (error) {
                console.error('Error fetching done visits:', error);
            }
        },
        async fetchIsOnVisit() {
            try {
                const response = await axios.post(route('merchant.isOnVisit'));
                this.isOnVisit = response.data.visit;
                console.log(response.data);
                if (response.data.isOnVisit) {
                    window.location.href = route('merchant.view.visit', { id: this.isOnVisit.id });
                }
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
                alert('Geolocation is not supported by this browser. Please ensure location services are enabled in your device settings.');
            }
        }
    }
};
</script>