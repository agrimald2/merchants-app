<template>
    <AdminLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-lg text-white leading-tight text-center">
                Visitas <span class="ml-2 bg-white-ac text-black px-2 py-1 rounded">35%</span>
            </h2>
        </template>

        <div class="bg-white p-4 max-w-3xl mx-auto">
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
                <div class="mb-4">
                    <label for="merchant" class="block text-sm font-medium text-gray-700">Seleccionar
                        Mercaderista</label>
                    <select id="merchant" v-model="selectedMerchant"
                        class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                        <option value="">Todos</option>
                        <option v-for="merchant in merchants" :key="merchant.id" :value="merchant.id">{{ merchant.name
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
        <div class="px-3 pt-2 max-w-3xl mx-auto">
            <div
                class="bg-white pt-2 pb-2 px-3 rounded-lg shadow-md flex items-center justify-between space-x-4 my-3 w-full">
                <div class="grid grid-cols-8 w-full py-1">
                    <div class="col-span-4 text-left font-bold text-red-800 text-lg">
                        Mercaderista
                    </div>
                    <div class="col-span-2 text-left font-bold text-red-800 text-lg">
                        Objetivo
                    </div>
                    <div class="col-span-2 text-left font-bold text-red-800 text-lg">
                        Avance
                    </div>
                </div>
            </div>
            <MerchantProgressComponent v-for="merchantProgress in merchantProgresses"
                :merchantProgress="merchantProgress" />
        </div>
    </AdminLayout>
</template>

<script>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import MerchantProgressComponent from './MerchantProgressComponent.vue'
import axios from 'axios';

export default {
    components: { AdminLayout, MerchantProgressComponent },
    props: ['visits'],
    data() {
        return {
            regions: [],
            locations: [],
            merchants: [],
            merchantProgresses: [
                { name: "Alan García Perez", done: 7, total: 12 },
                { name: "José A. Le Tongué", done: 5, total: 8 },
                { name: "Abner Vargas", done: 9, total: 15 },
                { name: "Dina Boluarte", done: 4, total: 9 },
                { name: "Tupac Amaru II", done: 12, total: 14 },
                { name: "Abimael Guzmán", done: 5, total: 7 },
                { name: "Abner DameLuz Gonzales", done: 1, total: 15 },
                { name: "Paolo Guerrero", done: 11, total: 11 },
                { name: "Yahaira Plasencia", done: 7, total: 13 },
                { name: "Amacharo Auxilio", done: 6, total: 12 },
                { name: "Jefferson F. Farfan", done: 9, total: 14 },
                { name: "Nicolás Maduro", done: 5, total: 6 },
                { name: "Olivia Rodrigo", done: 8, total: 10 }
            ],
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
        this.sortMerchantProgresses();
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
        },
        sortMerchantProgresses() {
            this.merchantProgresses.sort((a, b) => (a.done / a.total) - (b.done / b.total));
        }
    }
};
</script>