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
                    <div class="grid grid-cols-3 gap-4 mb-4">
                        <div class="bg-red-500 text-white rounded-lg p-4 flex flex-col items-center">
                            <div class="text-2xl font-bold">{{ objetive }}</div>
                            <div class="text-sm">Objetivo</div>
                        </div>
                        <div class="bg-green-500 text-white rounded-lg p-4 flex flex-col items-center">
                            <div class="text-2xl font-bold">{{ done }}</div>
                            <div class="text-sm">Realizadas</div>
                        </div>
                        <div class="bg-yellow-500 text-white rounded-lg p-4 flex flex-col items-center">
                            <div class="text-2xl font-bold">{{ pending }}</div>
                            <div class="text-sm">Pendientes</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="px-3 pt-6">
                <VisitComponent v-for="i in 3" />
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

            objetive: 10,
            done: 3,
            pending: 7,
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
        },
        goBack() {
            this.$inertia.get(route('admin.overviewMerchants'));
        },
    }
};
</script>