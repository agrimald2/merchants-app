<template>
    <AdminLayout title="POS">
        <template #header>
            <div class="flex items-center justify-between w-full">
                <!-- Back Button-->
                <button @click="goBack" class="text-white">
                    <i class="fa-solid fa-circle-chevron-left"></i>
                </button>
                <h2 class="font-semibold text-lg text-white leading-tight mx-auto">
                    Asignación de Visitas
                </h2>
                <div class="w-8"></div>
            </div>
        </template>

        <div class="max-w-3xl mx-auto p-4">
            <div class="bg-white p-4 mb-2">
                <div class="filters">
                    <div class="grid grid-cols-3 gap-4 mb-4">
                        <div>
                            <label for="region" class="block text-sm font-medium text-gray-700">Región</label>
                            <select id="region" v-model="selectedRegion"
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                                @change="filterAsignedVisits">
                                <option value="">Todos</option>
                                <option v-for="region in regions" :key="region.id" :value="region.id">{{ region.name }}
                                </option>
                            </select>
                        </div>
                        <div>
                            <label for="location" class="block text-sm font-medium text-gray-700">Locación</label>
                            <select id="location" v-model="selectedLocation"
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                                @change="filterAsignedVisits">
                                <option value="">Todos</option>
                                <option v-for="location in locations" :key="location.id" :value="location.id">
                                    {{ location.name }}
                                </option>
                            </select>
                        </div>
                        <div>
                            <label for="frequency" class="block text-sm font-medium text-gray-700">Frecuencia</label>
                            <select id="frequency" v-model="selectedFrequency"
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                                @change="filterAsignedVisits">
                                <option value="">Todos</option>
                                <option value="1">Lunes</option>
                                <option value="2">Martes</option>
                                <option value="3">Miércoles</option>
                                <option value="4">Jueves</option>
                                <option value="5">Viernes</option>
                                <option value="6">Sábado</option>
                                <option value="7">Domingo</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="merchantSearch" class="block text-sm font-medium text-gray-700">Buscar Mercaderista</label>
                        <input type="text" id="merchantSearch" v-model="searchQuery"
                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                            placeholder="Buscar por Nombre" @input="filterAsignedVisits">
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
            <div class="overflow-x-auto lg:block">
                <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="py-3 px-4 text-left">#</th>
                            <th class="py-3 px-4 text-left">Mercaderista</th>
                            <th class="py-3 px-4 text-left">PDV</th>
                            <th class="py-3 px-4 text-left">Locación</th>
                            <th class="py-3 px-4 text-left">Región</th>
                            <th class="py-3 px-4 text-left">Frecuencia</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(visit, key) in filteredAsignedVisits" :key="visit.id" class="border-b hover:bg-gray-100">
                            <td class="py-3 px-4">{{ key+1 }}</td>
                            <td class="py-3 px-4">{{ visit.merchant }}</td>
                            <td class="py-3 px-4">{{ visit.pos }}</td>
                            <td class="py-3 px-4">{{ visit.location }}</td>
                            <td class="py-3 px-4">{{ visit.region }}</td>
                            <td class="py-3 px-4">{{ getDayName(visit.frequency) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AdminLayout>
</template>

<script>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import axios from 'axios';

export default {
    components: {
        AdminLayout,
    },
    data() {
        return {
            asignedVisits: [],
            regions: [],
            locations: [],
            selectedRegion: '',
            selectedLocation: '',
            selectedFrequency: '',
            searchQuery: ''
        };
    },
    computed: {
        filteredAsignedVisits() {
            return this.asignedVisits.filter(visit => {
                return (
                    (this.selectedRegion === '' || visit.region_id === this.selectedRegion) &&
                    (this.selectedLocation === '' || visit.location_id === this.selectedLocation) &&
                    (this.selectedFrequency === '' || visit.frequency === parseInt(this.selectedFrequency)) &&
                    (this.searchQuery === '' || visit.merchant.toLowerCase().includes(this.searchQuery.toLowerCase()))
                );
            });
        }
    },
    mounted() {
        this.getRegions();
        this.getLocations();
        this.getAsignedVisits();
    },
    methods: {
        goBack() {
            this.$inertia.get(route('admin.uploadData'));
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
        async getAsignedVisits() {
            try {
                const response = await axios.get('/admin/getAsignedVisits');
                this.asignedVisits = response.data;
            } catch (error) {
                console.error('Error fetching asigned visits:', error);
            }
        },
        triggerFileInput() {
            this.$refs.fileInput.click();
        },
        handleFileUpload(event) {
            const file = event.target.files[0];
            if (file) {
                const formData = new FormData();
                formData.append('file', file);

                axios.post('/admin/merchants-pointOfSales/upload', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(response => {
                    this.getAsignedVisits();
                    alert('Archivo subido exitosamente');
                })
                .catch(error => {
                    console.error('Error uploading file:', error);
                    alert('Error al subir el archivo');
                });
            }
        },
        getDayName(dayNumber) {
            const days = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
            return days[dayNumber - 1];
        },
        filterAsignedVisits() {
            // This method is intentionally left blank as the filtering is handled by the computed property
        },
        exportToExcel() {
            const filteredData = this.filteredAsignedVisits.map(visit => ({
                Mercaderista: visit.merchant,
                Mercaderista_DNI: visit.merchant_dni,
                PDV: visit.pos,
                PDV_Código: visit.pos_code,
                Locación: visit.location,
                Región: visit.region,
                Frecuencia: visit.frequency
            }));

            let csvContent = "\uFEFF";
            csvContent += "Mercaderista,Mercaderista_DNI,PDV,PDV_Código,Locación,Región,Frecuencia\n";

            filteredData.forEach(row => {
                const rowData = Object.values(row).join(",");
                csvContent += rowData + "\n";
            });

            const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
            const link = document.createElement("a");
            const url = URL.createObjectURL(blob);
            link.setAttribute("href", url);
            link.setAttribute("download", "asignación_visitas.csv");
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
    }
};
</script>