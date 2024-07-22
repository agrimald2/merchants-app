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
                                class="bg-blue-500 text-white px-5 py-1 rounded-md inline-flex items-center w-full font-bold"
                                @click="exportToExcel">
                                <i class="fa-solid fa-file-excel mr-2"></i>
                                Exportar Excel
                            </button>
                        </div>
                        <div>
                            <input type="file" ref="fileInput" @change="handleFileUpload" class="hidden">
                            <button
                                class="bg-green-700 text-white px-5 py-1 rounded-md inline-flex items-center w-full font-bold"
                                @click="triggerFileInput">
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
                            <th class="py-3 px-4 text-left">On/Off</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="merchant in filteredMerchants" :key="merchant.id" class="border-b hover:bg-gray-100">
                            <td class="py-3 px-4">{{ merchant.name }}</td>
                            <td class="py-3 px-4">{{ merchant.dni }}</td>
                            <td class="py-3 px-4">{{ merchant.phone }}</td>
                            <td class="py-3 px-4">{{ merchant.location.name }}</td>
                            <td class="py-3 px-4 flex space-x-2">
                                <label class="inline-flex items-center cursor-pointer">
                                    <input type="checkbox" v-model="merchant.isActive" @change="toggleMerchantStatus(merchant)" class="sr-only">
                                    <span class="relative">
                                        <span class="block w-10 h-6 bg-gray-300 rounded-full shadow-inner"></span>
                                        <span :class="{'translate-x-4': merchant.isActive, 'translate-x-0': !merchant.isActive}" class="absolute block w-4 h-4 mt-1 ml-1 transform bg-white rounded-full shadow inset-y-0 left-0 transition-transform duration-200 ease-in-out"></span>
                                    </span>
                                </label>
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
        <LoaderModal v-if="loading" />
    </AdminLayout>
</template>

<script>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import AddMerchantModal from './AddMerchantModal.vue';
import MerchantDetailsModal from './MerchantDetailsModal.vue';
import RemoveMerchantModal from './RemoveMerchantModal.vue';
import LoaderModal from '@/Components/LoaderModal.vue';

import axios from 'axios';

export default {
    components: {
        AdminLayout,
        AddMerchantModal,
        MerchantDetailsModal,
        RemoveMerchantModal,
        LoaderModal
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
            searchQuery: '',
            loading: false
        };
    },
    mounted() {
        this.fetchMerchants();
        this.getRegions();
        this.getLocations();
    },
    methods: {
        goBack() {
            this.$inertia.get(route('admin.uploadData'));
        },
        fetchMerchants() {
            this.loading = true;
            axios.get('/admin/merchants/all')
                .then(response => {
                    this.merchants = response.data;
                    this.filterMerchants();
                })
                .catch(error => {
                    console.error('Error fetching merchants:', error);
                })
                .finally(() => {
                    this.loading = false;
                });
        },
        viewDetails(merchant) {
            this.selectedMerchant = merchant;
            this.showDetailsModal = true;
        },
        async getRegions() {
            this.loading = true;
            try {
                const response = await axios.get('/api/regions');
                this.regions = response.data;
            } catch (error) {
                console.error('Error fetching regions:', error);
            } finally {
                this.loading = false;
            }
        },
        async getLocations() {
            this.loading = true;
            try {
                const response = await axios.get('/api/locations');
                this.locations = response.data;
            } catch (error) {
                console.error('Error fetching locations:', error);
            } finally {
                this.loading = false;
            }
        },
        filterMerchants() {
            this.filteredMerchants = this.merchants.filter(merchant => {
                const matchesRegion = this.selectedRegion ? merchant.location.sub_region.region.id === this.selectedRegion : true;
                const matchesLocation = this.selectedLocation ? merchant.location.id === this.selectedLocation : true;
                const matchesSearch = this.searchQuery ? (merchant.name.toLowerCase().includes(this.searchQuery.toLowerCase()) || merchant.dni.includes(this.searchQuery)) : true;
                return matchesRegion && matchesLocation && matchesSearch;
            });
        },
        triggerFileInput() {
            this.$refs.fileInput.click();
        },
        handleFileUpload(event) {
            const file = event.target.files[0];
            if (file) {
                const formData = new FormData();
                formData.append('file', file);

                this.loading = true;
                axios.post('/admin/merchants/upload', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(response => {
                    this.fetchMerchants();
                    if (response.data.errors && response.data.errors.length > 0) {
                        let errorMessages = response.data.errors.map(error => `DNI: ${error.dni}, Nombre: ${error.name}, Mensaje: ${error.text}`).join('\n');
                        alert(`Errores al subir el archivo:\n${errorMessages}`);
                    } else {
                        alert('Archivo subido exitosamente');
                    }
                })
                .catch(error => {
                    console.error('Error uploading file:', error);
                    alert('Error al subir el archivo');
                })
                .finally(() => {
                    this.loading = false;
                });
            }
        },
        exportToExcel() {
            const filteredData = this.filteredMerchants.map(merchant => ({
                Name: merchant.name,
                DNI: merchant.dni,
                Phone: merchant.phone,
                Location: merchant.location.name
            }));

            let csvContent = "\uFEFF"; // Adding BOM for UTF-8 encoding
            csvContent += "Nombre,DNI,Celular,Locación\n";

            filteredData.forEach(row => {
                csvContent += `${row.Name},${row.DNI},${row.Phone},${row.Location}\n`;
            });

            const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
            const link = document.createElement("a");
            const url = URL.createObjectURL(blob);
            link.setAttribute("href", url);
            link.setAttribute("download", "lista_mercaderistas.csv");
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
    }
};
</script>