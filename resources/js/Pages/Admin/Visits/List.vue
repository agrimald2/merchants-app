<template>
    <AdminLayout title="Dashboard">
        <template #header>
            <div class="flex items-center justify-between w-full">
                <!-- Back Button-->
                <button @click="goBack" class="text-white">
                    <i class="fa-solid fa-circle-chevron-left"></i>
                </button>
                <h2 class="font-semibold text-lg text-white leading-tight mx-auto">
                    VISITAS / {{merchant.user.name}}
                </h2>
                <div class="w-8"></div> <!-- Placeholder to balance the flex layout -->
            </div>
        </template>

        <div class="max-w-2xl mx-auto">
            <div class="bg-white p-4">
                <div class="filters">
                    <div class="grid grid-cols-3 gap-4 mb-4">
                        <div class="bg-gray-50 text-black rounded-lg p-4 flex flex-col items-center shadow-md">
                            <i class="fa-solid fa-bullseye text-xl"></i>
                            <div class="text-sm">Objetivo</div>
                            <div class="text-2xl font-bold">{{ visits.length }}</div>
                        </div>
                        <div class="bg-gray-50 text-black rounded-lg p-4 flex flex-col items-center shadow-md">
                            <i class="fa-regular fa-circle-check text-xl text-green-500"></i>
                            <div class="text-sm">Realizadas</div>
                            <div class="text-2xl font-bold">{{ done_visits.length }}</div>
                        </div>
                        <div class="bg-gray-50 text-black rounded-lg p-4 flex flex-col items-center shadow-md">
                            <i class="fa-solid fa-stopwatch text-xl text-yellow-500"></i>
                            <div class="text-sm">Pendientes</div>
                            <div class="text-2xl font-bold">{{ Object.keys(pending_visits).length }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="px-3 pt-6">
                <p class="text-xl font-semibold text-gray-800">Visitas Pendientes</p>
                <PendingVisitsComponent v-for="pending_visit in pending_visits" :visit="pending_visit"
                    @scan="toggleQrModal" />
            </div>
            <div class="px-3 pt-6">
                <p class="text-xl font-semibold text-gray-800">Visitas Realizadas</p>
                <DoneVisitsComponent v-for="done_visit in done_visits" :visit="done_visit" />
            </div>
        </div>
    </AdminLayout>
</template>

<script>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import VisitComponent from './VisitComponent.vue';
import PendingVisitsComponent from './PendingVisitsComponent.vue';
import DoneVisitsComponent from './DoneVisitsComponent.vue';
import axios from 'axios';

export default {
    components: { AdminLayout, VisitComponent, PendingVisitsComponent, DoneVisitsComponent },
    props: [ 'merchant', 'visits', 'pending_visits', 'done_visits', 'date' ],
    data() {
        return {
            objetive: 10,
            done: 3,
            pending: 7,
            selectedDate: new Date().toISOString().substr(0, 10),
        };
    },
    mounted() {
    },
    methods: {
        goBack() {
            this.$inertia.get(route('admin.overviewMerchants'));
        },
    }
};
</script>