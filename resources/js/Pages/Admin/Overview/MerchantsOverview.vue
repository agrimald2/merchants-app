<template>
    <AdminLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-lg text-white leading-tight text-center">
                Visitas <!-- <span class="ml-2 bg-white-ac text-black px-2 py-1 rounded">{{ averageProgress }}%</span>-->
            </h2>
        </template>
        <div class="bg-white p-4 max-w-3xl mx-auto">
            <div class="filters">
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="region" class="block text-sm font-medium text-gray-700">Región</label>
                        <select id="region" v-model="selectedRegion"
                            @change="filterData; filterLocations"
                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                            <option value="">Todos</option>
                            <option v-for="region in regions" :key="region.id" :value="region.id">{{ region.name }}
                            </option>
                        </select>
                    </div>
                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700">Locación</label>
                        <select id="location" v-model="selectedLocation"
                            @change="filterData"
                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                            <option value="">Todos</option>
                            <option v-for="location in filteredLocations" :key="location.id" :value="location.id">{{
                            location.name }}
                            </option>
                        </select>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="merchant" class="block text-sm font-medium text-gray-700">Seleccionar
                        Mercaderista</label>
                    <select id="merchant" v-model="selectedMerchant"
                        @change="filterData"
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
                            @change="filterData"
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
                :key="merchantProgress.merchant_id"
                :merchantProgress="merchantProgress" :date="selectedDate"/>
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
            filteredLocations: [],
            merchants: [],
            merchantProgresses: [],
            selectedRegion: '',
            selectedLocation: '',
            selectedMerchant: '',
            selectedDate: new Date().toISOString().substr(0, 10),
            averageProgress: 0,
        };
    },
    mounted() {
        this.getRegions();
        this.getLocations();
        this.getMerchants();
        this.getMerchantProgresses();
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
                this.filteredLocations = this.locations;
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
        async getMerchantProgresses() {
            try {
                const response = await axios.get(`/admin/generalVisitProgress/${this.selectedDate}`);
                this.merchantProgresses = response.data;
                this.calculateAverageProgress();
            } catch (error) {
                console.error('Error fetching merchant progresses:', error);
            }
        },
        async filterData() {
            try {
                const response = await axios.get(`/admin/generalVisitProgress/${this.selectedDate}`, {
                    params: {
                        region_id: this.selectedRegion,
                        location_id: this.selectedLocation,
                        merchant_id: this.selectedMerchant
                    }
                });
                this.merchantProgresses = response.data;
                this.calculateAverageProgress();
            } catch (error) {
                console.error('Error filtering data:', error);
            }
        },
        filterLocations() {
            if (this.selectedRegion) {
                this.filteredLocations = this.locations.filter(location => location.region_id === this.selectedRegion);
            } else {
                this.filteredLocations = this.locations;
            }
        },
        calculateAverageProgress() {
            if (this.merchantProgresses.length > 0) {
                const totalProgress = this.merchantProgresses.reduce((sum, progress) => sum + progress.progress, 0);
                this.averageProgress = (totalProgress / this.merchantProgresses.length).toFixed(2);
            } else {
                this.averageProgress = 0;
            }
        }
    }
};
</script>