<template>
    <div v-if="showRemoveModal" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/2">
            <h2 class="text-lg font-semibold mb-4">Remove Merchant</h2>
            <p>Are you sure you want to remove {{ selectedMerchant.name }}?</p>
            <div class="flex justify-end mt-4">
                <button @click="showRemoveModal = false"
                    class="bg-gray-500 text-white px-4 py-2 rounded-md mr-2">Cancel</button>
                <button @click="removeMerchant" class="bg-red-500 text-white px-4 py-2 rounded-md">Remove</button>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios';
export default {
    data() {
        return {
        }
    },
    methods: {
        confirmRemove(merchant) {
            this.selectedMerchant = merchant;
            this.showRemoveModal = true;
        },
        removeMerchant() {
            axios.delete(`/admin/merchants/${this.selectedMerchant.id}`)
                .then(response => {
                    this.merchants = this.merchants.filter(m => m.id !== this.selectedMerchant.id);
                    this.showRemoveModal = false;
                    this.selectedMerchant = null;
                })
                .catch(error => {
                    console.error('Error removing merchant:', error);
                });
        }
    }
}
</script>