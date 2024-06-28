<template>
    <div class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-10">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden w-11/12 max-w-2xl">
            <div class="p-4 border-b">
                <div class="flex justify-between items-center">
                    <h2 class="text-lg font-semibold">Añadir Mercaderista</h2>
                    <button class="text-black" @click="$emit('closeAddMerchantModal')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="px-4 py-4">
                <form @submit.prevent="addMerchant" class="space-y-4">
                    <div>
                        <label class="block text-gray-700 mb-1" for="name">Name</label>
                        <input v-model="newMerchant.name" id="name" type="text"
                            class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-blue-200 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-1" for="dni">DNI / CE</label>
                        <input v-model="newMerchant.dni" id="dni" type="tel"
                            class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-blue-200 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-1" for="phone">Celular</label>
                        <input v-model="newMerchant.phone" id="phone" type="tel"
                            class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-blue-200 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-1" for="location">Locación</label>
                        <select v-model="newMerchant.location_id" id="location"
                            class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-blue-200 focus:border-blue-500">
                            <option value="" disabled>Elige una Locación</option>
                            <option v-for="location in locations" :key="location.id" :value="location.id">{{
                        location.name
                    }}</option>
                        </select>
                    </div>
                </form>
                <div class="flex justify-center mt-5">
                    <button type="submit"
                        class="bg-red-ac text-white w-full px-4 py-2 rounded-md hover:bg-red-600 transition font-bold">Añadir Mercaderista</button>
                </div>
            </div>

        </div>
    </div>
</template>
<script>
import axios from 'axios';
export default {
    props: ['locations'],
    data() {
        return {
            newMerchant: {
                name: '',
                dni: '',
                phone: '',
                location_id: '',
            }

        }
    },
    methods: {
        addMerchant() {
            axios.post('/admin/merchants', this.newMerchant)
                .then(response => {
                    this.merchants.push(response.data);
                    this.showAddModal = false;
                    this.newMerchant = { name: '', dni: '', phone: '' };
                })
                .catch(error => {
                    console.error('Error adding merchant:', error);
                });
        },
    }
}
</script>