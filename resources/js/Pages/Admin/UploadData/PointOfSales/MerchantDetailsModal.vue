<template>
    <div class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/2">
            <h2 class="text-lg font-semibold mb-4">Merchant Details</h2>
            <div class="mb-4">
                <label class="block text-gray-700">Name</label>
                <p>{{ selectedMerchant.name }}</p>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Username</label>
                <p>{{ selectedMerchant.username }}</p>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">DNI</label>
                <p>{{ selectedMerchant.dni }}</p>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Phone</label>
                <p>{{ selectedMerchant.phone }}</p>
            </div>
            <div class="flex justify-end">
                <button @click="showDetailsModal = false"
                    class="bg-gray-500 text-white px-4 py-2 rounded-md">Close</button>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios';
export default {
    data() {
        return {
            name: '',
            username: '',
            dni: '',
            phone: ''
        }
    },
    methods: {
        addMerchant() {
            axios.post('/admin/merchants', this.newMerchant)
                .then(response => {
                    this.merchants.push(response.data);
                    this.showAddModal = false;
                    this.newMerchant = { name: '', username: '', dni: '', phone: '' };
                })
                .catch(error => {
                    console.error('Error adding merchant:', error);
                });
        },
    }
}
</script>