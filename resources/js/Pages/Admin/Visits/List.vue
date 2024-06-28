<template>
    <AdminLayout title="Dashboard">
        <template #header>
            <div class="flex items-center justify-between w-full">
                <!-- Back Button-->
                <button @click="goBack" class="text-white">
                    <i class="fa-solid fa-circle-chevron-left"></i>
                </button>
                <h2 class="font-semibold text-lg text-white leading-tight mx-auto">
                    VISITAS / SALVADOR
                </h2>
                <div class="w-8"></div> <!-- Placeholder to balance the flex layout -->
            </div>
        </template>

        <div class="max-w-2xl mx-auto">
            <div class="bg-white p-4">
                <div class="filters">
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="region" class="block text-sm font-medium text-gray-700">Región</label>
                            <select id="region" v-model="selectedRegion"
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <option value="">Todos</option>
                                <option v-for="region in regions" :key="region.id" :value="region.id">{{ region.name }}
                                </option>
                            </select>
                        </div>
                        <div>
                            <label for="location" class="block text-sm font-medium text-gray-700">Locación</label>
                            <select id="location" v-model="selectedLocation"
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <option value="">Todos</option>
                                <option v-for="location in locations" :key="location.id" :value="location.id">{{
                    location.name }}
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-4 mb-4">
                        <div class="bg-green-500 text-white rounded-lg p-4 flex flex-col items-center">
                            <div class="text-2xl font-bold">{{ objetive }}</div>
                            <div class="text-sm">Objetivo</div>
                        </div>
                        <div class="bg-green-500 text-white rounded-lg p-4 flex flex-col items-center">
                            <div class="text-2xl font-bold">{{ done }}</div>
                            <div class="text-sm">Realizadas</div>
                        </div>
                        <div class="bg-green-500 text-white rounded-lg p-4 flex flex-col items-center">
                            <div class="text-2xl font-bold">{{ pending }}</div>
                            <div class="text-sm">Pendientes</div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="merchant" class="block text-sm font-medium text-gray-700">Seleccionar
                            Mercaderista</label>
                        <select id="merchant" v-model="selectedMerchant"
                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                            <option value="">Todos</option>
                            <option v-for="merchant in merchants" :key="merchant.id" :value="merchant.id">{{
                    merchant.name
                }}
                            </option>
                        </select>
                    </div>

                    <div>
                        <label for="date" class="block text-sm font-medium text-gray-700">Elige una fecha</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-4 14h.01M12 21v-5m0 0H9m3 0h3m-3 0V3m0 16h.01M8 7V3m8 4V3m-4 14h.01M12 21v-5m0 0H9m3 0h3m-3 0V3m0 16h.01" />
                                </svg>
                            </div>
                            <input type="date" id="date" v-model="selectedDate"
                                class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                placeholder="Elige una fecha" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="px-3 pt-6">
                <VisitComponent v-for="i in 20" />
            </div>
        </div>
    </AdminLayout>
</template>

<script>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import VisitComponent from './VisitComponent.vue';
import axios from 'axios';

export default {
    components: { AdminLayout, VisitComponent },
    props: ['visits'],
    data() {
        return {
            regions: [],
            locations: [],
            merchants: [],

            objetive: 0,
            done: 0,
            pending: 0,
            selectedRegion: '',
            selectedLocation: '',
            selectedMerchant: '',
            selectedDate: new Date().toISOString().substr(0, 10),
        };
    },
    mounted() {
        this.getRegions();
        this.getLocations();
        this.getMerchants();
    },
    methods: {
        async getRegions() {
            try {
                const response = await axios.get('/api/regions');
                this.regions = response.data;
            } catch (error) {
                console.error('Error fetching regions:', error);
            }
        },
        async getLocations() {
            try {
                const response = await axios.get('/api/locations');
                this.locations = response.data;
            } catch (error) {
                console.error('Error fetching locations:', error);
            }
        },
        async getMerchants() {
            try {
                const response = await axios.get('/admin/merchants/all');
                this.merchants = response.data;
            } catch (error) {
                console.error('Error fetching merchants:', error);
            }
        }
    }
};
</script>