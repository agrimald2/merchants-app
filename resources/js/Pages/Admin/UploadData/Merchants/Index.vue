<template>
    <AdminLayout title="Mercaderistas">
        <template #header>
            <div class="flex items-center justify-between w-full">
                <!-- Back Button-->
                <button @click="goBack" class="text-white">
                    <i class="fa-solid fa-circle-chevron-left"></i>
                </button>
                <h2 class="font-semibold text-lg text-white leading-tight mx-auto">
                    Mercaderistas
                </h2>
                <div class="w-8"></div> <!-- Placeholder to balance the flex layout -->
            </div>
        </template>

        <div class="max-w-3xl mx-auto p-4">
            <div class="bg-white p-4 mb-2">
                <div class="filters">
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="region" class="block text-sm font-medium text-gray-700">Región</label>
                            <select id="region" v-model="selectedRegion"
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                                @change="filterMerchants">
                                <option value="">Todos</option>
                                <option v-for="region in regions" :key="region.id" :value="region.id">{{ region.name }}
                                </option>
                            </select>
                        </div>
                        <div>
                            <label for="location" class="block text-sm font-medium text-gray-700">Locación</label>
                            <select id="location" v-model="selectedLocation"
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                                @change="filterMerchants">
                                <option value="">Todos</option>
                                <option v-for="location in locations" :key="location.id" :value="location.id">
                                    {{ location.name }}
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="merchantSearch" class="block text-sm font-medium text-gray-700">Buscar
                            Mercaderista</label>
                        <input type="text" id="merchantSearch" v-model="searchQuery"
                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                            placeholder="Buscar por nombre o DNI" @input="filterMerchants">
                    </div>

                    <div class="grid grid-cols-2 sm:grid-cols-2 gap-4">
                        <div>
                            <button
                                class="bg-red-ac text-white px-5 py-1 rounded-md inline-flex items-center w-full font-bold"
                                @click="showAddModal = true">
                                <i class="fa-solid fa-circle-plus mr-2"></i>
                                Añadir
                            </button>
                        </div>
                        <div>
                            <button
                                class="bg-green-700 text-white px-5 py-1 rounded-md inline-flex items-center w-full font-bold"
                                @click="showAddModal = true">
                                <i class="fa-solid fa-file-excel mr-2"></i>
                                Importar Excel
                            </button>
                        </div>
                    </div>

                </div>
            </div>
            <div class="overflow-x-auto hidden lg:block">
                <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="py-3 px-4 text-left">Name</th>
                            <th class="py-3 px-4 text-left">DNI</th>
                            <th class="py-3 px-4 text-left">Celular</th>
                            <th class="py-3 px-4 text-left">Locación</th>
                            <th class="py-3 px-4 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="merchant in filteredMerchants" :key="merchant.id" class="border-b hover:bg-gray-100">
                            <td class="py-3 px-4">{{ merchant.name }}</td>
                            <td class="py-3 px-4">{{ merchant.dni }}</td>
                            <td class="py-3 px-4">{{ merchant.phone }}</td>
                            <td class="py-3 px-4">{{ merchant.location.name }}</td>
                            <td class="py-3 px-4 flex space-x-2">
                                <button @click="viewDetails(merchant)"
                                    class="bg-green-500 text-white px-3 py-1 rounded-md hover:bg-green-600 transition">
                                    <i class="fa-solid fa-circle-info"></i>
                                </button>
                                <button @click="confirmRemove(merchant)"
                                    class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600 transition">
                                    <i class="fa-solid fa-circle-minus"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 lg:hidden">
                <div v-for="merchant in filteredMerchants" :key="merchant.id" class="bg-white shadow-md rounded-lg p-4">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold">{{ merchant.name }} - {{ merchant.dni }}</h3>
                        <div class="flex space-x-2">
                            <button @click="viewDetails(merchant)"
                                class="bg-green-500 text-white px-3 py-1 rounded-md hover:bg-green-600 transition">
                                <i class="fa-solid fa-circle-info"></i>
                            </button>
                            <button @click="confirmRemove(merchant)"
                                class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600 transition">
                                <i class="fa-solid fa-circle-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="text-sm text-gray-700">
                        <p><strong>Loc:</strong> {{ merchant.location.name }}</p>
                        <p><strong>Phone:</strong> {{ merchant.phone }}</p>
                    </div>
                </div>
            </div>
        </div>
        <AddMerchantModal :locations="locations" @closeAddMerchantModal="showAddModal = false" v-if="showAddModal" />
    </AdminLayout>
</template>

<script>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import AddMerchantModal from './AddMerchantModal.vue';
import MerchantDetailsModal from './MerchantDetailsModal.vue';
import RemoveMerchantModal from './RemoveMerchantModal.vue';

import axios from 'axios';

export default {
    components: {
        AdminLayout,
        AddMerchantModal,
        MerchantDetailsModal,
        RemoveMerchantModal
    },
    data() {
        return {
            merchants: [],
            filteredMerchants: [],
            showAddModal: false,
            showDetailsModal: false,
            showRemoveModal: false,
            newMerchant: {
                name: '',
                username: '',
                dni: '',
                phone: ''
            },
            selectedMerchant: null,
            regions: [],
            locations: [],
            selectedRegion: '',
            selectedLocation: '',
            searchQuery: ''
        };
    },
    mounted() {
        this.fetchMerchants();
        this.getRegions();
        this.getLocations();
    },
    methods: {
        goBack() {
            this.$inertia.get(route('dashboard'));
        },
        fetchMerchants() {
            axios.get('/admin/merchants/all')
                .then(response => {
                    this.merchants = response.data;
                    this.filterMerchants();
                })
                .catch(error => {
                    console.error('Error fetching merchants:', error);
                });
        },
        viewDetails(merchant) {
            this.selectedMerchant = merchant;
            this.showDetailsModal = true;
        },
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
        filterMerchants() {
            this.filteredMerchants = this.merchants.filter(merchant => {
                const matchesRegion = this.selectedRegion ? merchant.location.sub_region.region.id === this.selectedRegion : true;
                const matchesLocation = this.selectedLocation ? merchant.location.id === this.selectedLocation : true;
                const matchesSearch = this.searchQuery ? (merchant.name.toLowerCase().includes(this.searchQuery.toLowerCase()) || merchant.dni.includes(this.searchQuery)) : true;
                return matchesRegion && matchesLocation && matchesSearch;
            });
        }
    }
};
</script>